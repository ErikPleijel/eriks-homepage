<x-layout title="Intresseanmälan">
    <article class="prose-stone max-w-none">
        <nav class="mb-6 text-sm">
            <a href="{{ url('/') }}"
               class="text-amber-700 underline-offset-2 hover:underline">← Startsidan</a>
        </nav>

        <h1 class="chapter-title">Intresseanmälan</h1>

        <p class="chapter-text">
            Fyll i formuläret nedan om du vill bli meddelad när en tryckt utgåva av
            <em>Faustian Bargain? No Thanks!</em> finns tillgänglig på svenska.
        </p>

        <x-book-interest-form />
    </article>
</x-layout>
