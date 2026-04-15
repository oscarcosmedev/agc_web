/**
 * About Page Interactions
 * Handles all GSAP animations for the About page template
 */

export function initInteractionAbout() {

    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP or ScrollTrigger not loaded. About page animations disabled.');
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
     * Box Intro
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
     * Accordeon
     */

    gsap.from('.accordeon__item', {
        opacity: 0,
        y: 20,
        ease: 'power2.out',
        stagger: 0.08,
        scrollTrigger: {
            trigger: '.accordeon',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });
}
