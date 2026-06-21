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
    {{ $attributes->merge(['class' => 'my-8 rounded-lg border border-stone-200 bg-[#FBF0D9]']) }}
>
    <div class="flex items-stretch">
        {{-- Prev button — own column, never overlaps text --}}
        <button type="button" @click="prev()" aria-label="Previous slide"
                class="flex w-14 shrink-0 cursor-pointer items-center justify-center rounded-l-lg text-4xl text-stone-600 hover:bg-black/5">
            ❮
        </button>

        {{-- Track --}}
        <div class="flex-1 overflow-hidden">
            <div
                x-ref="track"
                class="flex transition-transform duration-500 ease-out [&>*]:w-full [&>*]:shrink-0"
                :style="`transform: translateX(-${current * 100}%)`"
            >
                {{ $slot }}
            </div>
        </div>

        {{-- Next button — own column, never overlaps text --}}
        <button type="button" @click="next()" aria-label="Next slide"
                class="flex w-14 shrink-0 cursor-pointer items-center justify-center rounded-r-lg text-4xl text-stone-600 hover:bg-black/5">
            ❯
        </button>
    </div>

    {{-- Dots --}}
    <div class="flex justify-center gap-2 py-2">
        <template x-for="i in count" :key="i">
            <button type="button"
                    @click="go(i - 1)"
                    :aria-label="`Go to slide ${i}`"
                    :class="current === i - 1 ? 'bg-amber-500' : 'bg-stone-300'"
                    class="h-2 w-2 cursor-pointer rounded-full"></button>
        </template>
    </div>
</div>
