<?php

namespace App\Http\Controllers;

use App\Models\SiteEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Cookie-free click logging. The client posts {label, path}; we store a
 * 'click' SiteEvent. CSRF protection is unchanged (the token rides the existing
 * session — no new cookie). The endpoint is rate-limited at the route level.
 */
class EventController extends Controller
{
    public function click(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'path' => ['required', 'string', 'max:2048'],
        ]);

        SiteEvent::create([
            'event_type' => 'click',
            'path' => $validated['path'],
            'locale' => $this->localeFromPath($validated['path']),
            'referrer_host' => null,
            'label' => $validated['label'],
        ]);

        return response()->json(['ok' => true], 201);
    }

    /**
     * The click endpoint isn't locale-prefixed, so derive the locale from the
     * first segment of the page path the client reported, validated against the
     * configured locales (falling back to the default). Keeps the click's
     * locale meaningful rather than always the app default.
     */
    private function localeFromPath(string $path): string
    {
        $segment = explode('/', ltrim($path, '/'))[0] ?? '';

        return array_key_exists($segment, config('site.locales'))
            ? $segment
            : config('site.default_locale');
    }
}
