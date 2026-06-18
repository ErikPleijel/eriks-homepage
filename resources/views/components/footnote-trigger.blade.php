@props([
    'label',
    'text',
])

{{--
    Inline footnote marker. Displayed as a fixed asterisk (*) regardless of the
    `label` — the number is still passed through to the shared footnote scope
    (x-data="footnotes" on the layout body) so the single <x-footnote-modal/>
    can show "Footnote N", and is used for the accessible label. @js() safely
    encodes the PHP strings into the Alpine call.
--}}
<button
    type="button"
    @click="show(@js($label), @js($text))"
    class="align-super text-xs font-semibold text-amber-600 hover:text-amber-700"
    aria-label="Show footnote {{ $label }}"
>*</button>
