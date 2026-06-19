<?php

// Chapter metadata for all 13 content pieces (Introduction + 12 chapters).
//
// Slugs are NOT stored here — they are generated at runtime via Str::slug()
// from title_en / title_sv, so renaming a title automatically changes the
// live URL without any extra step.
//
// Structure
// ---------
// 'introduction' — unnumbered entry that precedes Part I in the TOC
// 'parts'        — array of book sections, each listing chapter numbers
// 'chapter-N'    — one entry per chapter (keyed chapter-1 … chapter-12)

return [

    // ── Introduction ─────────────────────────────────────────────────────────

    'introduction' => [
        'number'   => null,
        'title_en' => 'Introduction: The 7 Classical Virtues as a Spiritual Immune System',
        'title_sv' => 'Inledning: De sju klassiska dygderna som ett andligt immunförsvar',
    ],

    // ── Book parts (used by TOC for grouping headings) ───────────────────────

    'parts' => [
        [
            'part_label_en' => 'Part I — Faith and the Battle Within',
            'part_label_sv' => 'Del I — Tro och den inre kampen',
            'chapters'      => [1, 2, 3, 4],
        ],
        [
            'part_label_en' => 'Part II — Bildung and Inner Formation',
            'part_label_sv' => 'Del II — Bildning och inre utveckling',
            'chapters'      => [5, 6, 7, 8],
        ],
        [
            'part_label_en' => 'Part III — Faith in a Secular Age',
            'part_label_sv' => 'Del III — Tro i en sekulär tid',
            'chapters'      => [9, 10, 11, 12],
        ],
    ],

    // ── Individual chapters ───────────────────────────────────────────────────
    // Chapter 9 was previously titled "Secular: The Christian Invention That
    // Saves Faith from Power". The title was renamed to "Impartiality: …"
    // (chapter number unchanged). Slug changes automatically with the title.

    'chapter-1' => [
        'number'   => 1,
        'title_en' => 'Breakout: Escaping the Prison of Toxic Passions',
        'title_sv' => 'Utbrytning: Att ta sig ur de giftiga passionernas fängelse',
    ],

    'chapter-2' => [
        'number'   => 2,
        'title_en' => "Reformation: The Battle at the Centre of Today's Political Storm",
        'title_sv' => 'Reformation: Kampen i centrum av dagens politiska storm',
    ],

    'chapter-3' => [
        'number'   => 3,
        'title_en' => 'Trust: A Leap of Faith Begins an Adventure and Gives Life a Direction',
        'title_sv' => 'Tillit: Trons vågspel startar ett äventyr och ger livet en riktning',
    ],

    'chapter-4' => [
        'number'   => 4,
        'title_en' => "Growth: A Cunning Snake Whispers That We Don't Need to Change",
        'title_sv' => 'Mognad: En listig orm viskar att vi inte behöver förändras',
    ],

    'chapter-5' => [
        'number'   => 5,
        'title_en' => "Wisdom: How Trusting Faith Can Be Reason's Best Friend",
        'title_sv' => 'Klokhet: Hur en tillitsfull tro kan vara förnuftets bästa vän',
    ],

    'chapter-6' => [
        'number'   => 6,
        'title_en' => 'Illumination: Education as a Way Out of the Shadowlands',
        'title_sv' => 'Illuminering: Bildning som en väg ut ur skugglandet',
    ],

    'chapter-7' => [
        'number'   => 7,
        'title_en' => 'Strength: Keep Your Head up When Everything Goes Wrong',
        'title_sv' => 'Styrka: Att hålla huvudet högt när allt ser ut att gå fel',
    ],

    'chapter-8' => [
        'number'   => 8,
        'title_en' => 'Integration: Handle Differences and the Round Squares of Life',
        'title_sv' => 'Integrering: Hantera olikheter och livets runda kvadrater',
    ],

    'chapter-9' => [
        'number'   => 9,
        'title_en' => 'Impartiality: The Invisible Bond That Holds the World Together',
        'title_sv' => 'Opartiskhet: Det osynliga band som håller världen samman',
    ],

    'chapter-10' => [
        'number'   => 10,
        'title_en' => "X-Factor: Embrace Life's Mystery and Spark a Love of Science",
        'title_sv' => 'X-Faktor: Bejaka mysteriet och uppväck en kärlek till vetenskap',
    ],

    'chapter-11' => [
        'number'   => 11,
        'title_en' => 'Resilience: Can Humanism Survive Without a Divine Spark?',
        'title_sv' => 'Bärkraft: Kan humanismen överleva utan en gudomlig gnista?',
    ],

    'chapter-12' => [
        'number'   => 12,
        'title_en' => 'Anchor: The Faith That Makes the Soul Unsellable',
        'title_sv' => 'Ankare: Tron som gör själen omöjlig att köpa',
    ],

];
