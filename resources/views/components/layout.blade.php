@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Site title ("The Anchor in the Storm") on every page; an optional
         per-page title is prepended. NOT the book title. --}}
    <title>{{ $title ? $title.' — '.config('site.title') : config('site.title') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- x-data="footnotes" mounts the shared footnote scope on the layout root so
     the single <x-footnote-modal/> below serves every <x-footnote-trigger/>
     rendered inside {{ $slot }}. --}}
<body x-data="footnotes" class="min-h-screen bg-stone-50 text-stone-900 antialiased font-sans">
    <header class="border-b border-stone-200 bg-white">
        <div class="mx-auto flex max-w-3xl items-center justify-between px-6 py-4">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
               class="text-xl font-semibold tracking-tight">
                {{ config('site.title') }}
            </a>
            <x-language-switcher />
        </div>
    </header>

    <main class="mx-auto max-w-3xl px-6 py-10">
        {{ $slot }}
    </main>

    <footer class="border-t border-stone-200 py-8 text-center text-sm text-stone-500">
        &copy; {{ date('Y') }} {{ config('site.title') }}
    </footer>

    {{-- One modal instance for the whole page. --}}
    <x-footnote-modal />
</body>
</html>
