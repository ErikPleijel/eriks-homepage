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

        // ── Top stat row ──────────────────────────────────────────────────────
        $totalSubscribers  = BookInterestSubscriber::count();
        $newSubscribers24h = BookInterestSubscriber::where('created_at', '>=', $now->copy()->subHours(24))->count();
        $pageviews3h       = DB::table('site_events')->where('event_type', 'pageview')->where('created_at', '>=', $now->copy()->subHours(3))->count();
        $pageviews24h      = DB::table('site_events')->where('event_type', 'pageview')->where('created_at', '>=', $now->copy()->subHours(24))->count();

        // ── Allow-list of real page paths ─────────────────────────────────────
        $allowedPaths = $this->buildAllowList();

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
            'localeBreakdown',
            'referrerBreakdown',
        ));
    }

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
