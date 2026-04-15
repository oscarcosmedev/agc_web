/**
 * Front Page Interactions
 * Handles all GSAP animations for the front-page template
 */

export function initInteractionFrontPage() {

    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP or ScrollTrigger not loaded. Front page animations disabled.');
        return;
    }

    gsap.registerPlugin(ScrollTrigger);

    /**
     * Hero
     */

    gsap.from('.hero__title', {
        opacity: 0,
        y: 40,
        duration: 0.8,
        ease: 'power2.out',
    });

    gsap.from('.hero__description', {
        opacity: 0,
        y: 40,
        duration: 0.8,
        delay: 0.2,
        ease: 'power2.out',
    });

    // gsap.from('.hero__cta', {
    //     opacity: 0,
    //     y: 20,
    //     duration: 0.6,
    //     delay: 0.4,
    //     ease: 'power2.out',
    // });

    /**
     * Box Tracking
     */

    gsap.from('.box-tracking', {
        opacity: 0,
        x: -50,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.box-tracking',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Box Two Column
     */

    gsap.from('.box-two-column__left', {
        opacity: 0,
        x: -50,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.box-two-column',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    gsap.from('.box-two-column__right', {
        opacity: 0,
        x: 50,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.box-two-column',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Noticias
     */

    gsap.from('.noticias__titulo', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.noticias',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    gsap.from('.noticia-card', {
        opacity: 0,
        y: 40,
        ease: 'power2.out',
        stagger: 0.1,
        scrollTrigger: {
            trigger: '.noticias',
            start: 'top 75%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Banner Media
     */

    gsap.from('.banner-media__panel', {
        opacity: 0,
        x: -50,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.banner-media',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    gsap.from('.banner-media__image-wrap', {
        opacity: 0,
        x: 50,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.banner-media',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * Tramites
     */

    gsap.from('.tramites__header', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.tramites',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    gsap.from('.tramite-card', {
        opacity: 0,
        y: 40,
        ease: 'power2.out',
        stagger: 0.08,
        scrollTrigger: {
            trigger: '.tramites',
            start: 'top 75%',
            toggleActions: 'play none none none',
        }
    });
}
