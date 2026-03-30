/**
 * assets/src/js/modules/lang-switcher.js
 * Dropdown de selección de idioma (globe button → lista de idiomas).
 *
 * Accesibilidad:
 *   - aria-expanded en el toggle button.
 *   - Cierre con Escape.
 *   - Cierre al hacer clic fuera del componente.
 *   - El `hidden` attribute del <ul> se gestiona junto a aria-expanded.
 */

/**
 * Inicializa todos los lang-switcher del DOM.
 * Soporta múltiples instancias si fuera necesario.
 */
export function initLangSwitcher() {
  const switchers = document.querySelectorAll('[data-lang-switcher]');
  if (!switchers.length) return;

  switchers.forEach(initSingleSwitcher);
}

/**
 * @param {HTMLElement} root — elemento [data-lang-switcher]
 */
function initSingleSwitcher(root) {
  const toggle   = root.querySelector('[data-lang-toggle]');
  const dropdown = root.querySelector('.lang-switcher__dropdown');

  if (!toggle || !dropdown) return;

  function openDropdown() {
    dropdown.hidden = false;
    toggle.setAttribute('aria-expanded', 'true');
    // Foco al primer item del dropdown
    const firstItem = dropdown.querySelector('a');
    firstItem?.focus();
  }

  function closeDropdown() {
    dropdown.hidden = true;
    toggle.setAttribute('aria-expanded', 'false');
    toggle.focus();
  }

  function toggleDropdown() {
    dropdown.hidden ? openDropdown() : closeDropdown();
  }

  toggle.addEventListener('click', toggleDropdown);

  // Cerrar con Escape
  root.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && !dropdown.hidden) {
      closeDropdown();
    }
  });

  // Cerrar al hacer clic fuera del componente
  document.addEventListener('click', (event) => {
    if (!root.contains(event.target) && !dropdown.hidden) {
      dropdown.hidden = true;
      toggle.setAttribute('aria-expanded', 'false');
    }
  });
}
