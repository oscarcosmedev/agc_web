/**
 * assets/src/js/modules/header.js
 * Lógica de scroll del header global.
 *
 * Agrega la clase `is-scrolled` al elemento [data-header] cuando
 * el usuario hace scroll más allá del threshold definido.
 */

const SCROLL_CLASS = 'is-scrolled';
const SCROLL_THRESHOLD = 10; // px

/**
 * Inicializa el comportamiento de scroll del header.
 * Safe-to-call si el header no existe en el DOM.
 */
export function initHeader() {
  const header = document.querySelector('[data-header]');
  if (!header) return;

  function updateScrollState() {
    header.classList.toggle(SCROLL_CLASS, window.scrollY > SCROLL_THRESHOLD);
  }

  window.addEventListener('scroll', updateScrollState, { passive: true });
  // Estado inicial (por si la página carga con scroll ya aplicado)
  updateScrollState();
}
