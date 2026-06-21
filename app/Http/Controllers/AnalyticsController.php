<?php

namespace App\Http\Controllers;

use App\Models\BookInterestSubscriber;
use App\Support\ChapterData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    // Never query data older than this date (UTC).
    private const FLOOR_DATE = '2026-06-21 00:00:00';

    private const RANGE_OPTIONS = ['30m', '3h', '24h', '7d', '28d', '3mo', '6mo', '12mo'];

    public function show(Request $request)
    {
        if ($request->query('key') !== config('site.analytics_key')) {
            abort(404);
        }

        $now   = now(); // UTC, matching config('app.timezone')
        $floor = Carbon::parse(self::FLOOR_DATE, 'UTC');

        // ── Range selector ────────────────────────────────────────────────────
        $range = in_array($request->query('range'), self::RANGE_OPTIONS, true)
            ? $request->query('range')
            : '24h';

        $relativeCutoff = $this->rangeCutoff($now, $range);
        // Use whichever is more recent: the relative cutoff or the hard floor.
        $rangeCutoff = $relativeCutoff->lt($floor) ? $floor->copy() : $relativeCutoff;

        // ── Allow-list of real page paths ─────────────────────────────────────
        $allowedPaths = $this->buildAllowList();

        // ── Top stat row ──────────────────────────────────────────────────────
        $totalSubscribers  = BookInterestSubscriber::count();
        $newSubscribers24h = BookInterestSubscriber::where('created_at', '>=', $now->copy()->subHours(24))->count();
        $pageviews3h  = DB::table('site_events')->where('event_type', 'pageview')->where('created_at', '>=', $now->copy()->subHours(3))->whereIn('path', $allowedPaths)->count();
        $pageviews24h = DB::table('site_events')->where('event_type', 'pageview')->where('created_at', '>=', $now->copy()->subHours(24))->whereIn('path', $allowedPaths)->count();

        // ── Daily breakdown — last 10 calendar days (UTC), newest first ───────
        // Fixed window; not affected by the dropdown.
        $relDailyCutoff = $now->copy()->subDays(9)->startOfDay();
        $dailyCutoff    = $relDailyCutoff->lt($floor) ? $floor->copy() : $relDailyCutoff;

        $dailyRaw = DB::table('site_events')
            ->selectRaw("
                DATE(created_at) as day,
                SUM(CASE WHEN event_type = 'pageview' AND path = '/' THEN 1 ELSE 0 END) as home_views,
                SUM(CASE WHEN event_type = 'pageview' AND path != '/' THEN 1 ELSE 0 END) as other_views
            ")
            ->where('created_at', '>=', $dailyCutoff)
            ->whereIn('path', $allowedPaths)
            ->groupByRaw('DATE(created_at)')
            ->get()
            ->keyBy('day');

        $dailyRows = [];
        for ($i = 0; $i < 10; $i++) {
            $date        = $now->copy()->subDays($i)->startOfDay();
            $dayKey      = $date->format('Y-m-d');
            $row         = $dailyRaw[$dayKey] ?? null;
            $dailyRows[] = [
                'label'     => $date->format('M j, D'),
                'is_sunday' => $date->dayOfWeek === 0,
                'home'      => (int) ($row->home_views  ?? 0),
                'other'     => (int) ($row->other_views ?? 0),
            ];
        }

        // ── Excluded-path diagnostic (same 10-day window as daily table) ──────
        $excl = DB::table('site_events')
            ->selectRaw('COUNT(DISTINCT path) as distinct_paths, COUNT(*) as events')
            ->where('created_at', '>=', $dailyCutoff)
            ->whereNotIn('path', $allowedPaths)
            ->first();

        $excludedStats = [
            'distinct_paths' => (int) ($excl->distinct_paths ?? 0),
            'events'         => (int) ($excl->events         ?? 0),
        ];

        // ── Visited pages — dropdown-scoped, allow-listed ─────────────────────
        $visitedPages = DB::table('site_events')
            ->select('path', DB::raw('COUNT(*) as total'))
            ->where('event_type', 'pageview')
            ->where('created_at', '>=', $rangeCutoff)
            ->whereIn('path', $allowedPaths)
            ->groupBy('path')
            ->orderByDesc('total')
            ->get();

        // ── Visitors by country — dropdown-scoped, allow-listed ───────────────
        $countriesBreakdown = DB::table('site_events')
            ->select('country_code', DB::raw('COUNT(*) as total'))
            ->where('event_type', 'pageview')
            ->where('created_at', '>=', $rangeCutoff)
            ->whereIn('path', $allowedPaths)
            ->whereNotNull('country_code')
            ->groupBy('country_code')
            ->orderByDesc('total')
            ->get();

        // ── Locale breakdown — dropdown-scoped ────────────────────────────────
        $localeBreakdown = DB::table('site_events')
            ->select('locale', DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $rangeCutoff)
            ->groupBy('locale')
            ->orderByDesc('total')
            ->get();

        // ── Referrer breakdown — dropdown-scoped ──────────────────────────────
        $referrerBreakdown = DB::table('site_events')
            ->select('referrer_host', DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $rangeCutoff)
            ->whereNotNull('referrer_host')
            ->where('referrer_host', '!=', '')
            ->groupBy('referrer_host')
            ->orderByDesc('total')
            ->get();

        // ── Pageview chart — dropdown-scoped ──────────────────────────────────
        $chartPoints = $this->chartBuckets($range, $rangeCutoff, $now, $allowedPaths);

        return view('analytics', compact(
            'now',
            'range',
            'totalSubscribers',
            'newSubscribers24h',
            'pageviews3h',
            'pageviews24h',
            'dailyRows',
            'excludedStats',
            'visitedPages',
            'countriesBreakdown',
            'localeBreakdown',
            'referrerBreakdown',
            'chartPoints',
        ));
    }

    // ── Chart helpers ─────────────────────────────────────────────────────────

    private function chartBuckets(string $range, Carbon $cutoff, Carbon $now, array $allowedPaths): array
    {
        [$sqlExpr, $keyFn, $stepFn, $startFn] = $this->chartBucketConfig($range);

        $rawRows = DB::table('site_events')
            ->selectRaw("($sqlExpr) as bucket, COUNT(*) as total")
            ->where('event_type', 'pageview')
            ->where('created_at', '>=', $cutoff)
            ->whereIn('path', $allowedPaths)
            ->groupByRaw($sqlExpr)
            ->orderByRaw($sqlExpr)
            ->get()
            ->keyBy('bucket');

        $cursor = $startFn($cutoff->copy());
        $points = [];
        while ($cursor->lte($now)) {
            $key      = $keyFn($cursor->copy());
            $points[] = [
                'key'   => $key,
                'value' => (int) ($rawRows[$key]->total ?? 0),
                'label' => $this->chartLabel($range, $cursor->copy()),
            ];
            $stepFn($cursor);
        }

        return $points;
    }

    private function chartBucketConfig(string $range): array
    {
        return match ($range) {
            '30m' => [
                "DATE_FORMAT(created_at, '%Y-%m-%d %H:%i')",
                fn (Carbon $c) => $c->format('Y-m-d H:i'),
                fn (Carbon $c) => $c->addMinute(),
                fn (Carbon $c) => $c->startOfMinute(),
            ],
            '3h' => [
                "CONCAT(DATE_FORMAT(created_at,'%Y-%m-%d %H:'),LPAD(FLOOR(MINUTE(created_at)/5)*5,2,'0'))",
                fn (Carbon $c) => $c->format('Y-m-d H:') . str_pad((int) ($c->minute / 5) * 5, 2, '0', STR_PAD_LEFT),
                fn (Carbon $c) => $c->addMinutes(5),
                fn (Carbon $c) => tap($c, fn ($c) => $c->setMinute((int) ($c->minute / 5) * 5)->startOfMinute()),
            ],
            '24h' => [
                "DATE_FORMAT(created_at, '%Y-%m-%d %H:00')",
                fn (Carbon $c) => $c->format('Y-m-d H:00'),
                fn (Carbon $c) => $c->addHour(),
                fn (Carbon $c) => $c->startOfHour(),
            ],
            '7d', '28d' => [
                'DATE(created_at)',
                fn (Carbon $c) => $c->format('Y-m-d'),
                fn (Carbon $c) => $c->addDay(),
                fn (Carbon $c) => $c->startOfDay(),
            ],
            '3mo', '6mo' => [
                'DATE(DATE_SUB(created_at, INTERVAL WEEKDAY(created_at) DAY))',
                fn (Carbon $c) => $c->copy()->startOfWeek(Carbon::MONDAY)->format('Y-m-d'),
                fn (Carbon $c) => $c->addWeek(),
                fn (Carbon $c) => $c->startOfWeek(Carbon::MONDAY),
            ],
            '12mo' => [
                "DATE_FORMAT(created_at, '%Y-%m-01')",
                fn (Carbon $c) => $c->format('Y-m-01'),
                fn (Carbon $c) => $c->addMonth(),
                fn (Carbon $c) => $c->startOfMonth(),
            ],
        };
    }

    private function chartLabel(string $range, Carbon $c): string
    {
        return match (true) {
            in_array($range, ['30m', '3h'], true) => $c->format('H:i'),
            $range === '24h'                       => $c->format('H:00'),
            in_array($range, ['7d', '28d'], true)  => $c->format('M j'),
            in_array($range, ['3mo', '6mo'], true) => $c->format('M j'),
            $range === '12mo'                      => $c->format('M y'),
            default                                => $c->format('Y-m-d'),
        };
    }

    // ── Shared helpers ────────────────────────────────────────────────────────

    private function rangeCutoff(Carbon $now, string $range): Carbon
    {
        return match ($range) {
            '30m'  => $now->copy()->subMinutes(30),
            '3h'   => $now->copy()->subHours(3),
            '24h'  => $now->copy()->subHours(24),
            '7d'   => $now->copy()->subDays(7),
            '28d'  => $now->copy()->subDays(28),
            '3mo'  => $now->copy()->subMonths(3),
            '6mo'  => $now->copy()->subMonths(6),
            '12mo' => $now->copy()->subMonths(12),
        };
    }

    private function buildAllowList(): array
    {
        // Laravel's $request->path() strips the leading slash from all non-root
        // paths (root '/' stays as '/'). So paths are stored as 'about', not '/about'.
        $paths = [
            '/',              // home (root stored as '/')
            'en', 'en/',      // historical home URLs — pre-restructure DB entries
            'sv', 'sv/',
            'about',          // EN about
            'om-mig',         // SV about
            'intresseanmalan', // SV book-interest
        ];

        foreach (array_keys(ChapterData::slugMap('en')) as $slug) {
            $paths[] = $slug;
        }
        foreach (array_keys(ChapterData::slugMap('sv')) as $slug) {
            $paths[] = $slug;
        }

        return array_values(array_unique($paths));
    }
}
