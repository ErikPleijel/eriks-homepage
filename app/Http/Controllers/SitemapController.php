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
        $enHome = 'https://erikpleijel.com/';
        $svHome = 'https://erikpleijel.se/';
        $urls[] = $this->paired($enHome, $enHome, $svHome, $this->mtime('content/en/home'));
        $urls[] = $this->paired($svHome, $enHome, $svHome, $this->mtime('content/sv/home'));

        // About pages
        $enAbout = 'https://erikpleijel.com/about';
        $svAbout = 'https://erikpleijel.se/om-mig';
        $urls[] = $this->paired($enAbout, $enAbout, $svAbout, $this->mtime('content/en/about'));
        $urls[] = $this->paired($svAbout, $enAbout, $svAbout, $this->mtime('content/sv/about'));

        // Book-interest sign-up form (SV only, no EN alternate)
        $urls[] = $this->single('https://erikpleijel.se/intresseanmalan');

        // Chapters — use explicit domain strings; pair by viewKey so order doesn't matter
        $enSlugMap    = ChapterData::slugMap('en');          // enSlug  => viewKey
        $svSlugByView = array_flip(ChapterData::slugMap('sv')); // viewKey => svSlug

        foreach ($enSlugMap as $enSlug => $viewKey) {
            $svSlug  = $svSlugByView[$viewKey] ?? null;
            $enUrl   = 'https://erikpleijel.com/' . $enSlug;
            $svUrl   = $svSlug ? 'https://erikpleijel.se/' . $svSlug : $enUrl;
            $lastmod = $this->chapterMtime($viewKey);

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
