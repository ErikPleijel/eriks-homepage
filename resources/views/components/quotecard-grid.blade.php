{{--
    Breaks out of the narrow article column (layout's max-w-2xl) to give
    quote cards room to sit side by side, then re-centers a wider grid
    within the full-bleed area. 1 column on mobile, 2 on desktop, with a
    trailing odd card centered on its own row.
--}}
<div class="relative left-1/2 right-1/2 -mx-[50vw] w-screen px-6">
    <div class="mx-auto grid max-w-4xl grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-10">
        {{ $slot }}
    </div>
</div>


