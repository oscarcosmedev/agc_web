/**
 * assets/src/js/modules/accordeon.js
 * Accordion colapsable con animación max-height.
 *
 * - Un solo item abierto a la vez por accordion (comportamiento exclusivo).
 * - El ícono + rota 45° al abrir (convirtiéndose en ×).
 * - Accesible: aria-expanded en el botón, aria-controls → id del panel.
 */

export function initAccordeon() {
  const lists = document.querySelectorAll('[data-accordeon]');
  if (!lists.length) return;

  lists.forEach(initSingleAccordeon);
}

/**
 * @param {HTMLElement} list
 */
function initSingleAccordeon(list) {
  const items = list.querySelectorAll('[data-accordeon-item]');

  items.forEach((item) => {
    const trigger = item.querySelector('[data-accordeon-trigger]');
    const panel   = item.querySelector('[data-accordeon-panel]');

    if (!trigger || !panel) return;

    // Estado inicial: cerrado
    panel.style.maxHeight = '0px';

    trigger.addEventListener('click', () => {
      const isOpen = trigger.getAttribute('aria-expanded') === 'true';

      // Cerrar todos los items del mismo accordion
      items.forEach((other) => closeItem(other));

      // Si estaba cerrado, abrir el actual
      if (!isOpen) {
        openItem(item);
      }
    });
  });
}

/**
 * @param {HTMLElement} item
 */
function openItem(item) {
  const trigger = item.querySelector('[data-accordeon-trigger]');
  const panel   = item.querySelector('[data-accordeon-panel]');
  const inner   = panel.querySelector('.accordeon__panel-inner');

  trigger.setAttribute('aria-expanded', 'true');
  panel.style.maxHeight = inner.scrollHeight + 'px';
  item.classList.add('is-open');
}

/**
 * @param {HTMLElement} item
 */
function closeItem(item) {
  const trigger = item.querySelector('[data-accordeon-trigger]');
  const panel   = item.querySelector('[data-accordeon-panel]');

  trigger.setAttribute('aria-expanded', 'false');
  panel.style.maxHeight = '0px';
  item.classList.remove('is-open');
}
