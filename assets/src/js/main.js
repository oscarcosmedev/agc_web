/**
 * Punto de entrada JavaScript del tema AGC.
 * Variables PHP↔JS disponibles en el objeto global `AGC` (inyectado por wp_localize_script).
 */

import { initHeader } from './modules/header.js'
import { initLangSwitcher } from './modules/lang-switcher.js'
import { initBoxTracking } from './modules/box-tracking.js'
import { initSliders } from './modules/slider.js'
import { initAccordeon } from './modules/accordeon.js'
import { initMobileMenu } from './modules/nav-mobile.js'
import { initMessagingWidget } from './modules/messagingWidget.js'
import { initInteractionFrontPage } from './interactions/interaction-frontPage.js'
import { initInteractionAbout } from './interactions/interaction-about.js'
import { initInteractionServices } from './interactions/interaction-services.js'
import { initInteractionContact } from './interactions/interaction-contact.js'
import { initInteractionHome } from './interactions/interaction-home.js'
import { initInteractionServicesSingle } from './interactions/interaction-services-single.js'

// ─── Estado global (disponible desde PHP) ──────────────────────────────────
const { lang, themeUri, isDebug } = window.AGC ?? {}

// ─── Debug helper (silenciado en producción vía isDebug) ───────────────────
const log = (...args) => isDebug && console.log('[AGC]', ...args)
log('Theme JS loaded', { lang, themeUri })

// ─── Inicialización ────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    log('DOM ready')

    initHeader()
    initLangSwitcher()
    initBoxTracking()
    initSliders()
    initAccordeon()
    initFadeIn()
    initMobileMenu()
    initMessagingWidget()

    // Microinteracciones GSAP – por plantilla
    const body = document.body
    if (body.classList.contains('home')) initInteractionFrontPage()
    if (body.classList.contains('blog')) initInteractionHome()
    if (body.classList.contains('page-template-template-about')) initInteractionAbout()
    if (body.classList.contains('page-template-template-services')) initInteractionServices()
    if (body.classList.contains('page-template-template-contact')) initInteractionContact()
    if (body.classList.contains('single-services')) initInteractionServicesSingle()
})


// ─── Animación de entrada al hacer scroll ─────────────────────────────────
function initFadeIn() {
    if (!('IntersectionObserver' in window)) return

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible')
                    observer.unobserve(entry.target)
                }
            })
        },
        { threshold: 0.1 }
    )

    document.querySelectorAll('[data-animate]').forEach((el) => observer.observe(el))
}
