/**
 * assets/src/js/modules/box-tracking.js
 * Formulario de rastreo de envíos.
 *
 * - Valida que el campo no esté vacío.
 * - Escribe el feedback en la región aria-live (data-tracking-result).
 * - Placeholder AJAX: extender `fetchTrackingResult()` cuando el endpoint esté disponible.
 */

const CLASSES = {
  success: 'box-tracking__result--success',
  error: 'box-tracking__result--error',
  loading: 'box-tracking__result--loading',
};

/**
 * Inicializa todos los formularios de tracking del DOM.
 */
export function initBoxTracking() {
  const forms = document.querySelectorAll('[data-tracking-form]');
  if (!forms.length) return;

  forms.forEach(initSingleTrackingForm);
}

/**
 * @param {HTMLFormElement} form
 */
function initSingleTrackingForm(form) {
  const input = form.querySelector('[data-tracking-input]');
  const result = document.querySelector('[data-tracking-result]');

  if (!input || !result) return;

  form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const trackingNumber = input.value.trim();

    if (!trackingNumber) {
      showMessage(result, form.dataset.errorEmpty ?? 'Please enter a tracking number.', 'error');
      input.focus();
      return;
    }

    showMessage(result, '...', 'loading');

    try {
      const message = await fetchTrackingResult(trackingNumber);
      showMessage(result, message, 'success');
    } catch (err) {
      showMessage(result, 'No se pudo obtener información. Intente nuevamente.', 'error');
    }
  });
}

/**
 * Muestra un mensaje en la región aria-live.
 *
 * @param {HTMLElement} region
 * @param {string}      message
 * @param {'success'|'error'|'loading'} type
 */
function showMessage(region, message, type) {
  // Limpiar clases previas
  Object.values(CLASSES).forEach((cls) => region.classList.remove(cls));
  region.classList.add(CLASSES[type]);
  // textContent es seguro — no usar innerHTML con datos externos
  region.textContent = message;
}

/**
 * Placeholder para la llamada al endpoint de tracking.
 * Reemplazar `Promise.resolve()` con un `fetch()` real cuando el API esté disponible.
 *
 * @param  {string} trackingNumber
 * @returns {Promise<string>}
 */
async function fetchTrackingResult(trackingNumber) {
  // TODO: reemplazar con fetch real al endpoint de tracking
  // Ejemplo:
  // const response = await fetch(`${window.AGC?.ajaxUrl}?action=agc_track&number=${encodeURIComponent(trackingNumber)}&nonce=${window.AGC?.nonce}`);
  // if (!response.ok) throw new Error('Network error');
  // const data = await response.json();
  // return data.message;

  // Simulación temporal:
  return new Promise((resolve) => {
    setTimeout(() => resolve(`Número ${trackingNumber} recibido. Resultado próximamente.`), 500);
  });
}
