/**
 * Home (Blog) Page Interactions
 * Handles all GSAP animations for the home.php blog template
 */

export function initInteractionHome() {

    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP or ScrollTrigger not loaded. Home blog animations disabled.');
        return;
    }

    gsap.registerPlugin(ScrollTrigger);

    /**
     * Section heading
     */

    gsap.from('.home-noticias__titulo', {
        opacity: 0,
        y: 30,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.home-noticias',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });

    /**
     * News cards stagger
     */

    gsap.from('.home-noticias__grid .noticia-card', {
        opacity: 0,
        y: 40,
        ease: 'power2.out',
        stagger: 0.1,
        scrollTrigger: {
            trigger: '.home-noticias__grid',
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    });
}
