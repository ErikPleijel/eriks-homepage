@php
    $locale   = app()->getLocale();
    $isSv     = $locale === 'sv';
    $aboutUrl = $isSv ? url('/om-mig') : url('/about');

    $heading  = $isSv ? 'Om mig'    : 'About me';
    $readMore = $isSv ? 'Läs mer →' : 'Read more →';
    $imgAlt   = $isSv ? 'Porträtt av Erik Pleijel' : 'Portrait of Erik Pleijel';

    $bio = $isSv
        ? 'Jag heter Erik Pleijel. Min världsbild har formats av både studier och erfarenhet, inklusive praktiskt arbete med vattenförsörjningsprojekt i Afrika och Asien. För mig är teologi och filosofi som mest värdefulla när de kan ge vägledning i vardagen.'
        : "My name is Erik Pleijel, and I'm from Sweden. My outlook has been shaped by both study and experience, including hands-on work with water supply projects in Africa and Asia. To me, theology and philosophy are most valuable when they offer guidance for everyday life.";
@endphp
<section class="mt-12 border-t border-stone-200 pt-10">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start">

        <div class="flex-shrink-0 sm:w-1/4">
            <img
                src="/images/ErikPleijelPortrait_sm.jpg"
                alt="{{ $imgAlt }}"
                class="w-full max-w-[120px] rounded object-cover"
            >
        </div>

        <div class="sm:w-3/4">
            <h2 class="chapter-heading mt-0 leading-none">{{ $heading }}</h2>
            <p class="chapter-text mt-3">{{ $bio }}</p>
            <a href="{{ $aboutUrl }}"
               class="mt-4 inline-block text-sm text-stone-600 underline underline-offset-2 transition-colors hover:text-stone-900">
                {{ $readMore }}
            </a>
        </div>

    </div>
</section>
