/**
 * Services Single Interactions
 * Handles all GSAP animations for the single-services templates:
 * aduaneros, aereo, maritimo, terrestre, internacional, multimodal
 */

export function initInteractionServicesSingle() {

    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP or ScrollTrigger not loaded. Services single animations disabled.');
        return;
    }

    gsap.registerPlugin(ScrollTrigger);

    /**
     * Hero
     */

    // gsap.from('.hero__title', {
    //     opacity: 0,
    //     y: 40,
    //     duration: 0.8,
    //     ease: 'power2.out',
    // });

    // gsap.from('.hero__description', {
    //     opacity: 0,
    //     y: 40,
    //     duration: 0.8,
    //     delay: 0.2,
    //     ease: 'power2.out',
    // });

    // gsap.from('.hero__cta', {
    //     opacity: 0,
    //     y: 20,
    //     duration: 0.6,
    //     delay: 0.4,
    //     ease: 'power2.out',
    // });

    /**
     * Page title (h1 + breadcrumb)
     */

    gsap.from('[class*="services-t-"] h1', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '[class*="services-t-"]',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Box Intro (aereo, maritimo, terrestre, internacional, multimodal)
     */

    gsap.from('.box-intro__image', {
        opacity: 0,
        x: -50,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.box-intro',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    gsap.from('.box-intro__card', {
        opacity: 0,
        x: 50,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.box-intro',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Ventajas Grid (aduaneros)
     */

    gsap.from('.ventajas-grid__title', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.ventajas-grid',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    gsap.from('.ventajas-grid__item', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        stagger: 0.08,
        scrollTrigger: {
            trigger: '.ventajas-grid__list',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Gestion En (aduaneros)
     */

    gsap.from('.gestion-en', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.gestion-en',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Our Services rows + items (aereo, maritimo, terrestre)
     */

    gsap.from('.our-services__title', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.our-services',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    gsap.from('.our-services__item', {
        opacity: 0,
        y: 20,
        ease: 'power2.out',
        stagger: 0.07,
        scrollTrigger: {
            trigger: '.our-services__list',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Our Services Cards (terrestre, internacional, multimodal)
     */

    gsap.from('.our-services-cards__title', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.our-services-cards',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    gsap.from('.our-services-cards__card', {
        opacity: 0,
        y: 40,
        ease: 'power2.out',
        stagger: 0.12,
        scrollTrigger: {
            trigger: '.our-services-cards__grid',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Our Services Banner (multimodal)
     */

    gsap.from('.our-services-banner__title', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.our-services-banner',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    gsap.from('.our-services-banner__img', {
        opacity: 0,
        scale: 0.97,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.our-services-banner',
            start: 'top 80%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Servicios Ventajas (internacional)
     */

    gsap.from('.servicios-ventajas', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.servicios-ventajas',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Quote (aereo)
     */

    gsap.from('.quote', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.quote',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });
}
