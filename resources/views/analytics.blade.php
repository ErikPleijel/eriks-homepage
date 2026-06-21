<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Analytics</title>
    @vite(['resources/css/app.css'])
    <style>
        body { font-family: ui-monospace, 'Cascadia Code', 'Courier New', monospace; }
        .tbl th, .tbl td { padding: .3rem .75rem; border-bottom: 1px solid #e5e7eb; }
        .tbl th { font-size: .7rem; text-transform: uppercase; letter-spacing: .05em; color: #6b7280; border-bottom-color: #d1d5db; }
        .tbl td { font-size: .85rem; color: #1f2937; }
        .tbl .num { text-align: right; font-variant-numeric: tabular-nums; }
        .sun { background: #fffbeb; }
    </style>
</head>
<body style="background:#f9fafb; padding:2rem; max-width:800px; margin:0 auto;">

    @php
        $rangeLabels = [
            '30m'  => 'Last 30 minutes',
            '3h'   => 'Last 3 hours',
            '24h'  => 'Last 24 hours',
            '7d'   => 'Last 7 days',
            '28d'  => 'Last 28 days',
            '3mo'  => 'Last 3 months',
            '6mo'  => 'Last 6 months',
            '12mo' => 'Last 12 months',
        ];
    @endphp

    <div style="margin-bottom:1.5rem;">
        <h1 style="font-size:1.4rem; font-weight:700; color:#111827; margin:0 0 .2rem;">Analytics</h1>
        <p style="font-size:.75rem; color:#6b7280; margin:0;">
            {{ $now->format('D d M Y, H:i') }} UTC
            &ensp;·&ensp;
            <a href="?key={{ request()->query('key') }}&range={{ $range }}" style="color:#3b82f6;">↻ Refresh</a>
        </p>
    </div>

    {{-- ── Top stat boxes ─────────────────────────────────────────────────── --}}
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:.75rem; margin-bottom:2rem;">
        @foreach ([
            ['Total subscribers',       $totalSubscribers],
            ['New subscribers (24h)',    $newSubscribers24h],
            ['Visitors (last 3h)',       $pageviews3h],
            ['Visitors (last 24h)',      $pageviews24h],
        ] as [$label, $value])
        <div style="background:#fff; border:1px solid #e5e7eb; border-radius:6px; padding:.85rem 1rem;">
            <div style="font-size:1.6rem; font-weight:700; color:#111827; line-height:1;">{{ $value }}</div>
            <div style="font-size:.7rem; color:#6b7280; margin-top:.3rem;">{{ $label }}</div>
        </div>
        @endforeach
    </div>

    {{-- ── Range selector ─────────────────────────────────────────────────── --}}
    <div style="margin-bottom:2rem; display:flex; align-items:center; gap:.75rem;">
        <label for="range-select" style="font-size:.7rem; font-weight:600; text-transform:uppercase; letter-spacing:.05em; color:#374151; white-space:nowrap;">
            Time range
        </label>
        <select id="range-select"
                onchange="const u=new URL(window.location.href);u.searchParams.set('range',this.value);location.href=u.href"
                style="font-family:inherit; font-size:.8rem; border:1px solid #d1d5db; border-radius:4px; padding:.3rem .5rem; background:#fff; color:#111827; cursor:pointer;">
            @foreach ($rangeLabels as $value => $label)
            <option value="{{ $value }}" {{ $range === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <span style="font-size:.7rem; color:#9ca3af;">Controls: Visited pages · Locale · Referrers</span>
    </div>

    {{-- ── Visited pages — dropdown-scoped ───────────────────────────────── --}}
    <h2 style="font-size:.8rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.06em; margin-bottom:.6rem;">
        Visited pages · {{ $rangeLabels[$range] }} · pageviews · allow-listed paths only
    </h2>
    <table class="tbl" style="width:100%; border-collapse:collapse; margin-bottom:2rem; background:#fff; border:1px solid #e5e7eb; border-radius:6px; overflow:hidden;">
        <thead>
            <tr>
                <th style="text-align:left;">Path</th>
                <th class="num">Views</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($visitedPages as $row)
            <tr>
                <td>{{ $row->path }}</td>
                <td class="num">{{ number_format($row->total) }}</td>
            </tr>
            @empty
            <tr><td colspan="2" style="color:#9ca3af; text-align:center;">No pageviews in this period.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- ── Daily breakdown — fixed 10-day window ──────────────────────────── --}}
    <h2 style="font-size:.8rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.06em; margin-bottom:.6rem;">
        Last 10 days · newest first · UTC day boundaries · allow-listed paths only
    </h2>
    <table class="tbl" style="width:100%; border-collapse:collapse; margin-bottom:.4rem; background:#fff; border:1px solid #e5e7eb; border-radius:6px; overflow:hidden;">
        <thead>
            <tr>
                <th style="text-align:left;">Date</th>
                <th class="num">Home page</th>
                <th class="num">Other pages</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dailyRows as $row)
            <tr class="{{ $row['is_sunday'] ? 'sun' : '' }}">
                <td>{{ $row['label'] }}{{ $row['is_sunday'] ? ' ☀' : '' }}</td>
                <td class="num">{{ $row['home'] }}</td>
                <td class="num">{{ $row['other'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p style="font-size:.7rem; margin:0 0 2rem; {{ $excludedStats['events'] > 0 ? 'color:#b45309;' : 'color:#9ca3af;' }}">
        @if ($excludedStats['events'] > 0)
            ⚠ {{ number_format($excludedStats['events']) }} event(s) on {{ $excludedStats['distinct_paths'] }} non-allow-listed path(s) excluded from this window.
        @else
            ✓ No non-allow-listed events in this window.
        @endif
    </p>

    {{-- ── Locale breakdown — dropdown-scoped ────────────────────────────── --}}
    <h2 style="font-size:.8rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.06em; margin-bottom:.6rem;">
        Events by locale · {{ $rangeLabels[$range] }} · all event types
    </h2>
    <table class="tbl" style="width:100%; border-collapse:collapse; margin-bottom:2rem; background:#fff; border:1px solid #e5e7eb; border-radius:6px; overflow:hidden;">
        <thead>
            <tr>
                <th style="text-align:left;">Locale</th>
                <th class="num">Events</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($localeBreakdown as $row)
            <tr>
                <td>{{ $row->locale ?: 'unknown' }}</td>
                <td class="num">{{ number_format($row->total) }}</td>
            </tr>
            @empty
            <tr><td colspan="2" style="color:#9ca3af; text-align:center;">No events in this period.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- ── Referrer breakdown — dropdown-scoped ───────────────────────────── --}}
    <h2 style="font-size:.8rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.06em; margin-bottom:.6rem;">
        Referrers · {{ $rangeLabels[$range] }}
    </h2>
    <table class="tbl" style="width:100%; border-collapse:collapse; background:#fff; border:1px solid #e5e7eb; border-radius:6px; overflow:hidden;">
        <thead>
            <tr>
                <th style="text-align:left;">Referrer</th>
                <th class="num">Visits</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($referrerBreakdown as $row)
            <tr>
                <td>{{ $row->referrer_host }}</td>
                <td class="num">{{ number_format($row->total) }}</td>
            </tr>
            @empty
            <tr><td colspan="2" style="color:#9ca3af; text-align:center;">No referrer data in this period.</td></tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
