// ─── Menú móvil ─────────────────────────────────────────────────────────────
export function initMobileMenu() {
    const toggle = document.querySelector('[data-menu-toggle]');
    const closeBtn = document.querySelector('[data-menu-close]');
    const panel = document.querySelector('[data-nav-mobile]');

    if (!toggle || !panel) return;

    function openMenu() {
        panel.classList.add('is-open');
        panel.setAttribute('aria-hidden', 'false');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.classList.add('menu-open');
    }

    function closeMenu() {
        panel.classList.remove('is-open');
        panel.setAttribute('aria-hidden', 'true');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('menu-open');
    }

    toggle.addEventListener('click', () => {
        panel.classList.contains('is-open') ? closeMenu() : openMenu();
    });

    closeBtn?.addEventListener('click', closeMenu);

    // Cerrar con Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && panel.classList.contains('is-open')) closeMenu();
    });
}
