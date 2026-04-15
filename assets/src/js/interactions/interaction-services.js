/**
 * Services Page Interactions
 * Handles all GSAP animations for the Services page template
 */

export function initInteractionServices() {

    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP or ScrollTrigger not loaded. Services page animations disabled.');
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
     * Section Header
     */

    gsap.from('.services-header h2, .services-header p', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        stagger: 0.1,
        scrollTrigger: {
            trigger: '.services-grid',
            start: 'top 95%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Services Grid
     */

    gsap.from('.services-grid__item', {
        opacity: 0,
        y: 40,
        ease: 'power2.out',
        stagger: 0.1,
        scrollTrigger: {
            trigger: '.services-grid__list',
            start: 'top 80%',
            toggleActions: 'play none none none',
        }
    });
}
