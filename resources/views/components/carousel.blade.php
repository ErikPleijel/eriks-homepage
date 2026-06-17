@props([
    'label' => 'Carousel',
])

{{--
    Alpine-powered carousel. Pass each slide as a direct child in the slot:

        <x-carousel>
            <div>Slide one</div>
            <div>Slide two</div>
        </x-carousel>

    Slide count is read from the track's children at init, so any number of
    slides works without extra props.
--}}
<div
    x-data="{
        current: 0,
        count: 0,
        init() { this.count = this.$refs.track.children.length; },
        next() { this.current = (this.current + 1) % this.count; },
        prev() { this.current = (this.current - 1 + this.count) % this.count; },
        go(i) { this.current = i; },
    }"
    role="region"
    aria-roledescription="carousel"
    aria-label="{{ $label }}"
    {{ $attributes->merge(['class' => 'relative my-8 overflow-hidden rounded-lg border border-stone-200 bg-white']) }}
>
    {{-- Track: each slide is forced to full width and slid into view. --}}
    <div
        x-ref="track"
        class="flex transition-transform duration-500 ease-out [&>*]:w-full [&>*]:shrink-0"
        :style="`transform: translateX(-${current * 100}%)`"
    >
        {{ $slot }}
    </div>

    {{-- Prev / next --}}
    <button type="button" @click="prev()" aria-label="Previous slide"
            class="absolute left-2 top-1/2 -translate-y-1/2 rounded-full bg-white/80 px-3 py-2 text-stone-700 shadow hover:bg-white">
        &larr;
    </button>
    <button type="button" @click="next()" aria-label="Next slide"
            class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-white/80 px-3 py-2 text-stone-700 shadow hover:bg-white">
        &rarr;
    </button>

    {{-- Dots --}}
    <div class="absolute inset-x-0 bottom-3 flex justify-center gap-2">
        <template x-for="i in count" :key="i">
            <button type="button"
                    @click="go(i - 1)"
                    :aria-label="`Go to slide ${i}`"
                    :class="current === i - 1 ? 'bg-amber-500' : 'bg-stone-300'"
                    class="h-2 w-2 rounded-full"></button>
        </template>
    </div>
</div>
