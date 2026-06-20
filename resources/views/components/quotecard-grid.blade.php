{{--
    Breaks out of the narrow article column (layout's max-w-2xl) to give
    quote cards room to sit side by side, then re-centers a wider grid
    within the full-bleed area. 1 column on mobile, 2 on desktop, with a
    trailing odd card centered on its own row.
--}}
<div class="relative left-1/2 right-1/2 -mx-[50vw] w-screen px-6">
    <div class="mx-auto flex max-w-4xl flex-wrap justify-center gap-5">
        {{ $slot }}
    </div>
</div>
