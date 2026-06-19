<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Static helpers for building chapter/TOC data from config/chapters.php.
 *
 * Keeping this logic here rather than inline in Blade means:
 *   - Any view can render a full TOC with just <x-toc heading="…" />
 *   - Slug/URL generation is a single source of truth for both routes and links
 *   - Config changes (e.g. title renames) propagate automatically to URLs and links
 */
class ChapterData
{
    /**
     * Build the flat TOC item list for the given locale.
     *
     * Returns a sequence of three item types for the TOC component to render:
     *   ['type' => 'intro',   'title' => '…', 'url' => '…']
     *   ['type' => 'part',    'label' => '…']
     *   ['type' => 'chapter', 'number' => N, 'title' => '…', 'url' => '…']
     */
    public static function tocItems(string $locale): array
    {
        $cfg   = config('chapters');
        $items = [];

        // Introduction (unnumbered, precedes Part I)
        $introTitle = $cfg['introduction']["title_{$locale}"];
        $items[] = [
            'type'  => 'intro',
            'title' => $introTitle,
            'url'   => self::chapterUrl('introduction', $introTitle, $locale),
        ];

        // Parts and their chapters
        foreach ($cfg['parts'] as $part) {
            $items[] = [
                'type'  => 'part',
                'label' => $part["part_label_{$locale}"],
            ];

            foreach ($part['chapters'] as $num) {
                $chapter = $cfg["chapter-{$num}"];
                $title   = $chapter["title_{$locale}"];
                $items[] = [
                    'type'   => 'chapter',
                    'number' => $num,
                    'title'  => $title,
                    'url'    => self::chapterUrl("chapter-{$num}", $title, $locale),
                ];
            }
        }

        return $items;
    }

    /**
     * Return display metadata for a single chapter view.
     *
     * @param  string $key    Config key: 'introduction' or 'chapter-N'
     * @param  string $locale Active locale ('en' | 'sv')
     * @return array{layout_title: string, kicker: string, heading: string}
     */
    public static function forView(string $key, string $locale): array
    {
        $cfg   = config("chapters.{$key}");
        $title = $cfg["title_{$locale}"];

        if ($key === 'introduction') {
            // Config stores the full "Introduction: Subtitle" / "Inledning: Underrubrik" string.
            // The kicker is the word before the colon; the h1 is everything after ": ".
            [$kicker, $heading] = explode(': ', $title, 2);

            return [
                'layout_title' => $title,
                'kicker'       => $kicker,
                'heading'      => $heading,
            ];
        }

        $number = $cfg['number'];
        $kicker = $locale === 'sv' ? "Kapitel {$number}" : "Chapter {$number}";

        return [
            'layout_title' => $title,
            'kicker'       => $kicker,
            'heading'      => $title,
        ];
    }

    /**
     * Build a slug => view-name lookup map for the given locale.
     *
     * Used by routes/web.php at boot time to register slug-based routes.
     * Each slug is Str::slug() of the chapter's title in the given locale.
     */
    public static function slugMap(string $locale): array
    {
        $cfg = config('chapters');
        $map = [];
        $key = "title_{$locale}";

        $map[Str::slug($cfg['introduction'][$key])] = 'introduction';

        foreach ($cfg['parts'] as $part) {
            foreach ($part['chapters'] as $num) {
                $map[Str::slug($cfg["chapter-{$num}"][$key])] = "chapter-{$num}";
            }
        }

        return $map;
    }

    /**
     * Generate the canonical URL for a chapter.
     *
     * EN chapters live at site root (no locale prefix): /breakout-…
     * SV chapters live under /sv/: /sv/utbrytning-…
     */
    private static function chapterUrl(string $viewKey, string $title, string $locale): string
    {
        $slug = Str::slug($title);

        return $locale === 'en'
            ? url($slug)
            : url("sv/{$slug}");
    }
}
