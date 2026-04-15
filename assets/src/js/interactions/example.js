/**
 * Front Page Interactions
 * Handles all GSAP animations for the front-page template
 */

export function initFrontPageInteractions() {
    // Check if we're on the front page - look for home-sections or front-page specific elements
    const homeSections = document.querySelector('.home-sections');
    const discoverSection = document.querySelector('.section__discover');

    // Only run if we're on the front page
    if (!homeSections && !discoverSection) {
        return;
    }

    // Check if GSAP and ScrollTrigger are loaded
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP or ScrollTrigger not loaded. Front page animations disabled.');
        return;
    }

    // Register ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);

    /**
     * Discover Export Section
     */

    gsap.from(".section__discover h2 span", {
        opacity: 0,
        y: 40,
        ease: "power2.out",
        stagger: 0.1,
        scrollTrigger: {
            trigger: ".section__discover",
            start: "top 90%",
            end: "bottom 70%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    gsap.from(".section__discover .container p", {
        opacity: 0,
        y: 40,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".section__discover .container p",
            start: "top 75%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    let discoverBlocks = document.querySelectorAll(".section__discover .section__discover--block");

    discoverBlocks.forEach((block, index) => {
        gsap.from(block, {
            opacity: 0,
            x: index === 0 ? -40 : 40,
            ease: "power2.out",
            scrollTrigger: {
                trigger: block,
                start: "top 90%",
                end: "bottom 70%",
                toggleActions: "play none none none",
                markers: false,
                scrub: 1,
            }
        });

        block.addEventListener("mouseenter", () => {
            const description = block.querySelector(".section__discover--block--description");
            if (description) {
                gsap.to(description, {
                    height: "auto",
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    ease: "power2.out"
                });

                const paragraph = description.querySelector("p");
                if (paragraph) {
                    gsap.to(paragraph, {
                        opacity: 1,
                        duration: 0.5,
                        delay: 0.2,
                        ease: "power2.out"
                    });
                }
            }
        });

        block.addEventListener("mouseleave", () => {
            const description = block.querySelector(".section__discover--block--description");
            if (description) {
                const paragraph = description.querySelector("p");
                if (paragraph) {
                    gsap.to(paragraph, {
                        opacity: 0,
                        duration: 0.3,
                        ease: "power2.in"
                    });
                }

                gsap.to(description, {
                    height: 0,
                    opacity: 0,
                    y: 20,
                    duration: 0.4,
                    delay: 0.2,
                    ease: "power2.in"
                });
            }
        });
    });

    /**
     * Process Timeline Section
     */

    gsap.from(".process__step__title span", {
        opacity: 0,
        y: 30,
        ease: "power2.out",
        stagger: 0.15,
        scrollTrigger: {
            trigger: ".section__process",
            start: "top 80%",
            end: "top 50%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    gsap.from(".process__step__description", {
        opacity: 0,
        y: 30,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".process__step__description",
            start: "top 85%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    // gsap.from(".process__step__cta", {
    //     opacity: 0,
    //     scale: 0.95,
    //     ease: "power2.out",
    //     scrollTrigger: {
    //         trigger: ".process__step__cta",
    //         start: "top 90%",
    //         toggleActions: "play none none none",
    //         markers: false,
    //         scrub: 1,
    //     }
    // });

    let processSteps = document.querySelectorAll(".process__step__step");
    processSteps.forEach((step) => {
        gsap.from(step, {
            opacity: 0,
            y: 40,
            scale: 0.9,
            ease: "power2.out",
            scrollTrigger: {
                trigger: step,
                start: "top 90%",
                end: "top 60%",
                toggleActions: "play none none none",
                markers: false,
                scrub: 1,
            }
        });
    });

    /**
     * Certifications Section
     */

    gsap.from(".section__certifications h2 span", {
        opacity: 0,
        y: 30,
        ease: "power2.out",
        stagger: 0.12,
        scrollTrigger: {
            trigger: ".section__certifications",
            start: "top 80%",
            end: "top 50%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    gsap.from(".section__certifications img", {
        opacity: 0,
        scale: 0.95,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".section__certifications img",
            start: "top 85%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    gsap.from(".section__certifications .max-w-4xl", {
        opacity: 0,
        y: 30,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".section__certifications .max-w-4xl",
            start: "top 85%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    let certButtons = document.querySelectorAll(".section__certifications .button--cta-primary");
    certButtons.forEach((button) => {
        gsap.from(button, {
            opacity: 0,
            y: 20,
            ease: "power2.out",
            scrollTrigger: {
                trigger: button,
                start: "top 90%",
                toggleActions: "play none none none",
                markers: false,
                scrub: 1,
            }
        });
    });

    /**
     * Trusted Supplier Banner
     */

    gsap.from(".section__trusted--supplier h2", {
        opacity: 0,
        y: 40,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".section__trusted--supplier",
            start: "top 80%",
            end: "top 50%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    let trustedButtons = document.querySelectorAll(".section__trusted--supplier .button--cta-secondary");
    gsap.from(trustedButtons, {
        opacity: 0,
        y: 30,
        scale: 0.95,
        ease: "power2.out",
        stagger: 0.1,
        scrollTrigger: {
            trigger: ".section__trusted--supplier .flex",
            start: "top 85%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    /**
     * Latest News Section
     */

    gsap.from(".section__latest h2 span", {
        opacity: 0,
        y: 30,
        ease: "power2.out",
        stagger: 0.12,
        scrollTrigger: {
            trigger: ".section__latest",
            start: "top 80%",
            end: "top 50%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    gsap.from(".latest__header .text-lg", {
        opacity: 0,
        y: 30,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".latest__header .text-lg",
            start: "top 85%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    gsap.from(".latest__header .button--cta-secondary", {
        opacity: 0,
        scale: 0.95,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".latest__header .button--cta-secondary",
            start: "top 90%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });

    gsap.from(".latest__slider-wrapper", {
        opacity: 0,
        y: 30,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".latest__slider-wrapper",
            start: "top 85%",
            end: "top 70%",
            toggleActions: "play none none none",
            markers: false,
            scrub: 1,
        }
    });
}
