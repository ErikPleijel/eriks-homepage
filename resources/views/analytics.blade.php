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
                onchange="location.href='?key={{ request()->query('key') }}&range='+this.value"
                style="font-family:inherit; font-size:.8rem; border:1px solid #d1d5db; border-radius:4px; padding:.3rem .5rem; background:#fff; color:#111827; cursor:pointer;">
            @foreach ($rangeLabels as $value => $label)
            <option value="{{ $value }}" {{ $range === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <span style="font-size:.7rem; color:#9ca3af;">Controls: Chart · Visited pages · Countries · Locale · Referrers</span>
    </div>

    {{-- ── Pageview chart ──────────────────────────────────────────────────── --}}
    <h2 style="font-size:.8rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.06em; margin-bottom:.6rem;">
        Pageviews over time · {{ $rangeLabels[$range] }}
    </h2>
    <div style="background:#fff; border:1px solid #e5e7eb; border-radius:6px; padding:.75rem 1rem 1rem; margin-bottom:2rem;">
    @php
        $svgW  = 680;
        $svgH  = 140;
        $padL  = 38;
        $padR  = 12;
        $padT  = 10;
        $padB  = 26;
        $plotW = $svgW - $padL - $padR;
        $plotH = $svgH - $padT - $padB;

        $vals   = array_column($chartPoints, 'value');
        $maxVal = $vals ? max(max($vals), 1) : 1;
        $n      = count($chartPoints);

        $xOf = fn($i) => $n > 1 ? $padL + ($i / ($n - 1)) * $plotW : $padL + $plotW / 2;
        $yOf = fn($v) => $padT + $plotH - ($v / $maxVal) * $plotH;

        // Polyline points string
        $pts = [];
        foreach ($chartPoints as $i => $pt) {
            $pts[] = round($xOf($i), 1) . ',' . round($yOf($pt['value']), 1);
        }
        $polyPts = implode(' ', $pts);

        // Y-axis ticks at 0 %, 50 %, 100 % (keep it minimal)
        $yTicks = [0, 0.5, 1.0];

        // Show at most ~7 x-axis labels
        $labelEvery = max(1, (int) ceil($n / 7));
    @endphp
    <svg viewBox="0 0 {{ $svgW }} {{ $svgH }}"
         style="width:100%; height:{{ $svgH }}px; display:block; overflow:visible;"
         aria-hidden="true">

        {{-- Y gridlines and labels --}}
        @foreach ($yTicks as $frac)
            @php
                $yG = round($padT + $plotH * (1 - $frac), 1);
                $vG = (int) round($maxVal * $frac);
            @endphp
            <line x1="{{ $padL }}" y1="{{ $yG }}" x2="{{ $svgW - $padR }}" y2="{{ $yG }}"
                  stroke="#e5e7eb" stroke-width="1"/>
            <text x="{{ $padL - 4 }}" y="{{ $yG + 3.5 }}"
                  text-anchor="end" font-size="9" font-family="ui-monospace,monospace" fill="#9ca3af">{{ $vG }}</text>
        @endforeach

        {{-- X axis baseline --}}
        <line x1="{{ $padL }}" y1="{{ $padT + $plotH }}" x2="{{ $svgW - $padR }}" y2="{{ $padT + $plotH }}"
              stroke="#d1d5db" stroke-width="1"/>

        {{-- Polyline --}}
        @if ($n > 1)
        <polyline points="{{ $polyPts }}" fill="none" stroke="#3b82f6" stroke-width="1.5" stroke-linejoin="round"/>
        @elseif ($n === 1)
        <circle cx="{{ round($xOf(0), 1) }}" cy="{{ round($yOf($chartPoints[0]['value']), 1) }}"
                r="3" fill="#3b82f6"/>
        @endif

        {{-- X-axis labels --}}
        @foreach ($chartPoints as $i => $pt)
            @if ($i % $labelEvery === 0 || $i === $n - 1)
            <text x="{{ round($xOf($i), 1) }}" y="{{ $svgH - 2 }}"
                  text-anchor="middle" font-size="9" font-family="ui-monospace,monospace" fill="#9ca3af">{{ $pt['label'] }}</text>
            @endif
        @endforeach

    </svg>
    @if ($n === 0)
    <p style="font-size:.75rem; color:#9ca3af; text-align:center; margin:.5rem 0 0;">No pageviews in this period.</p>
    @endif
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

    {{-- ── Visitors by country — dropdown-scoped ─────────────────────────── --}}
    <h2 style="font-size:.8rem; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:.06em; margin-bottom:.6rem;">
        Visitors by country · {{ $rangeLabels[$range] }} · pageviews · GeoLite2
    </h2>
    <table class="tbl" style="width:100%; border-collapse:collapse; margin-bottom:2rem; background:#fff; border:1px solid #e5e7eb; border-radius:6px; overflow:hidden;">
        <thead>
            <tr>
                <th style="text-align:left;">Country</th>
                <th class="num">Views</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($countriesBreakdown as $row)
            <tr>
                <td>{{ $row->country_code }}</td>
                <td class="num">{{ number_format($row->total) }}</td>
            </tr>
            @empty
            <tr><td colspan="2" style="color:#9ca3af; text-align:center;">
                No country data yet — place GeoLite2-Country.mmdb in storage/geoip/ to enable.
            </td></tr>
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
