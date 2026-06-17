@props([
    'label',
    'text',
])

{{--
    Inline footnote marker. Clicking it pushes this footnote's label + text
    into the shared footnote scope (x-data="footnotes" on the layout body),
    which the single <x-footnote-modal/> then displays. @js() safely encodes
    the PHP strings into the Alpine call.
--}}
<button
    type="button"
    @click="show(@js($label), @js($text))"
    class="align-super text-xs font-semibold text-amber-600 hover:text-amber-700"
    aria-label="Show footnote {{ $label }}"
>[{{ $label }}]</button>
