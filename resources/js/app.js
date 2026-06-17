import './bootstrap';

// Alpine.js — guarded so we never double-initialize if another bundle/CDN
// already set window.Alpine (mirrors the redcross_volunteers convention).
import Alpine from 'alpinejs';

// Footnote state lives in a single Alpine component mounted on the layout
// root (<body x-data="footnotes">). Because every footnote-trigger and the
// single footnote-modal are descendants of that root, they all share this
// one scope — so one modal serves every footnote on the page.
document.addEventListener('alpine:init', () => {
    Alpine.data('footnotes', () => ({
        open: false,
        label: '',
        body: '',
        show(label, body) {
            this.label = label;
            this.body = body;
            this.open = true;
        },
        close() {
            this.open = false;
        },
    }));
});

if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}
