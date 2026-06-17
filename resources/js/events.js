// Cookie-free click logging helper.
//
// window.logEvent('Some label') POSTs {label, path} to /events/click, where
// path is the current page path. CSRF is satisfied with the session token from
// the <meta name="csrf-token"> tag (no new cookie). Fire-and-forget: failures
// are swallowed so analytics can never break the page. Uses fetch with
// keepalive so the request still completes if the click triggers a navigation.
window.logEvent = function logEvent(label) {
    const token = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content');

    if (!token) {
        return;
    }

    fetch('/events/click', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({
            label: label,
            path: window.location.pathname.replace(/^\//, ''),
        }),
        keepalive: true,
    }).catch(() => {
        // Analytics is best-effort; never surface errors to the visitor.
    });
};
