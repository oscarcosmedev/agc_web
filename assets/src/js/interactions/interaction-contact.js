/**
 * Contact Page Interactions
 * Handles all GSAP animations for the Contact page template
 */

export function initInteractionContact() {

    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP or ScrollTrigger not loaded. Contact page animations disabled.');
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
     * Contact heading
     */

    gsap.from('.contact__heading', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.contact',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Contact card: form ← | info →
     */

    gsap.from('.contact__form-col', {
        opacity: 0,
        x: -40,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.contact__card',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    gsap.from('.contact__info-col', {
        opacity: 0,
        x: 40,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.contact__card',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Contact info items stagger
     */

    gsap.from('.contact__info-item', {
        opacity: 0,
        y: 20,
        ease: 'power2.out',
        stagger: 0.1,
        scrollTrigger: {
            trigger: '.contact__info-list',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });
}
