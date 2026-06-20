<?php

namespace App\Http\Controllers;

use App\Support\ChapterData;

class SitemapController extends Controller
{
    public function index(): \Illuminate\Http\Response
    {
        return response()
            ->view('sitemap', ['urls' => $this->buildUrls()])
            ->header('Content-Type', 'application/xml');
    }

    private function buildUrls(): array
    {
        $urls = [];

        // Home pages
        $enHome = route('home', ['locale' => 'en']);
        $svHome = route('home', ['locale' => 'sv']);
        $urls[] = $this->paired($enHome, $enHome, $svHome, $this->mtime('content/en/home'));
        $urls[] = $this->paired($svHome, $enHome, $svHome, $this->mtime('content/sv/home'));

        // About pages
        $enAbout = route('about.en');
        $svAbout = route('about.sv', ['locale' => 'sv']);
        $urls[] = $this->paired($enAbout, $enAbout, $svAbout, $this->mtime('content/en/about'));
        $urls[] = $this->paired($svAbout, $enAbout, $svAbout, $this->mtime('content/sv/about'));

        // Book-interest sign-up form (SV only, no EN alternate)
        $urls[] = $this->single(route('book-interest.form', ['locale' => 'sv']));

        // Chapters — pair EN and SV by position (config order is identical for both locales)
        $enSlugMap = ChapterData::slugMap('en');
        $enItems   = array_values(array_filter(ChapterData::tocItems('en'), fn($i) => isset($i['url'])));
        $svItems   = array_values(array_filter(ChapterData::tocItems('sv'), fn($i) => isset($i['url'])));

        foreach ($enItems as $idx => $enItem) {
            $enUrl   = $enItem['url'];
            $svUrl   = ($svItems[$idx] ?? null)['url'] ?? $enUrl;
            $enSlug  = basename(parse_url($enUrl, PHP_URL_PATH));
            $viewKey = $enSlugMap[$enSlug] ?? null;
            $lastmod = $viewKey ? $this->chapterMtime($viewKey) : null;

            $urls[] = $this->paired($enUrl, $enUrl, $svUrl, $lastmod);
            $urls[] = $this->paired($svUrl, $enUrl, $svUrl, $lastmod);
        }

        return $urls;
    }

    private function paired(string $loc, string $en, string $sv, ?string $lastmod): array
    {
        return ['loc' => $loc, 'en' => $en, 'sv' => $sv, 'lastmod' => $lastmod];
    }

    private function single(string $loc, ?string $lastmod = null): array
    {
        return ['loc' => $loc, 'en' => null, 'sv' => null, 'lastmod' => $lastmod];
    }

    private function mtime(string $viewPath): ?string
    {
        $path = resource_path("views/{$viewPath}.blade.php");
        return file_exists($path) ? date('Y-m-d', filemtime($path)) : null;
    }

    private function chapterMtime(string $viewKey): ?string
    {
        $mtimes = [];
        foreach (['en', 'sv'] as $locale) {
            $path = resource_path("views/content/{$locale}/chapters/{$viewKey}.blade.php");
            if (file_exists($path)) {
                $mtimes[] = filemtime($path);
            }
        }
        return $mtimes ? date('Y-m-d', max($mtimes)) : null;
    }
}
