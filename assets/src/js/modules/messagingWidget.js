export function initMessagingWidget() {
    const widget = document.querySelector('[data-messaging-widget]');

    if (!widget) return;

    const toggleButton = widget.querySelector('[data-messaging-toggle]');
    const optionButtons = widget.querySelectorAll('[data-messaging-option]');

    if (!toggleButton) return;

    let isExpanded = false;

    function toggleWidget() {
        isExpanded = !isExpanded;

        if (isExpanded) {
            widget.classList.add('messaging-widget--expanded');
            toggleButton.setAttribute('aria-expanded', 'true');
        } else {
            widget.classList.remove('messaging-widget--expanded');
            toggleButton.setAttribute('aria-expanded', 'false');
        }
    }

    function closeWidget() {
        if (isExpanded) {
            isExpanded = false;
            widget.classList.remove('messaging-widget--expanded');
            toggleButton.setAttribute('aria-expanded', 'false');
        }
    }

    // Toggle on button click
    toggleButton.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleWidget();
    });

    // Close when clicking outside
    document.addEventListener('click', (e) => {
        if (!widget.contains(e.target)) {
            closeWidget();
        }
    });

    // Close on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeWidget();
        }
    });

    // Close when clicking on option buttons (they navigate away)
    optionButtons.forEach(button => {
        button.addEventListener('click', () => {
            closeWidget();
        });
    });
}
