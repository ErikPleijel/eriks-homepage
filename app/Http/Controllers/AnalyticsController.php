<?php

namespace App\Http\Controllers;

use App\Models\BookInterestSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function show(Request $request)
    {
        if ($request->query('key') !== config('site.analytics_key')) {
            abort(404);
        }

        $now = now(); // UTC, matching config('app.timezone')

        // ── Top stat row ──────────────────────────────────────────────────────
        $totalSubscribers  = BookInterestSubscriber::count();
        $newSubscribers24h = BookInterestSubscriber::where('created_at', '>=', $now->copy()->subHours(24))->count();
        $pageviews3h       = DB::table('site_events')->where('event_type', 'pageview')->where('created_at', '>=', $now->copy()->subHours(3))->count();
        $pageviews24h      = DB::table('site_events')->where('event_type', 'pageview')->where('created_at', '>=', $now->copy()->subHours(24))->count();

        // ── Daily breakdown — last 10 calendar days (UTC), newest first ───────
        // Home paths: both locales, with and without trailing slash.
        $homePaths = ['/en', '/en/', '/sv', '/sv/'];
        $cutoff    = $now->copy()->subDays(9)->startOfDay();

        $dailyRaw = DB::table('site_events')
            ->selectRaw("
                DATE(created_at) as day,
                SUM(CASE WHEN event_type = 'pageview' AND path IN (?, ?, ?, ?) THEN 1 ELSE 0 END) as home_views,
                SUM(CASE WHEN event_type = 'pageview' AND path NOT IN (?, ?, ?, ?) THEN 1 ELSE 0 END) as other_views,
                SUM(CASE WHEN event_type = 'click' THEN 1 ELSE 0 END) as clicks
            ", array_merge($homePaths, $homePaths))
            ->where('created_at', '>=', $cutoff)
            ->groupByRaw('DATE(created_at)')
            ->get()
            ->keyBy('day');

        $dailyRows = [];
        for ($i = 0; $i < 10; $i++) {
            $date      = $now->copy()->subDays($i)->startOfDay();
            $dayKey    = $date->format('Y-m-d');
            $row       = $dailyRaw[$dayKey] ?? null;
            $dailyRows[] = [
                'label'     => $date->format('M j, D'),
                'is_sunday' => $date->dayOfWeek === 0,
                'home'      => (int) ($row->home_views  ?? 0),
                'other'     => (int) ($row->other_views ?? 0),
                'clicks'    => (int) ($row->clicks      ?? 0),
            ];
        }

        // ── Locale breakdown — all event types ────────────────────────────────
        // Group by the raw column so ONLY_FULL_GROUP_BY is satisfied; null/empty
        // label is resolved to 'unknown' in the view.
        $localeBreakdown = DB::table('site_events')
            ->select('locale', DB::raw('COUNT(*) as total'))
            ->groupBy('locale')
            ->orderByDesc('total')
            ->get();

        $referrerBreakdown = DB::table('site_events')
            ->select('referrer_host', DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $now->copy()->subHours(24))
            ->whereNotNull('referrer_host')
            ->where('referrer_host', '!=', '')
            ->groupBy('referrer_host')
            ->orderByDesc('total')
            ->get();

        return view('analytics', compact(
            'now',
            'totalSubscribers',
            'newSubscribers24h',
            'pageviews3h',
            'pageviews24h',
            'dailyRows',
            'localeBreakdown',
            'referrerBreakdown',
        ));
    }
}
