/**
 * Pitucas Homepage Animations
 * GSAP 3.x + ScrollTrigger
 */

(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
            console.warn('GSAP or ScrollTrigger not loaded');
            return;
        }
        
        gsap.registerPlugin(ScrollTrigger);
        
        // Hero animations (play once on load)
        gsap.from('.hero-image', {
            duration: 1.2,
            opacity: 0,
            scale: 1.1,
            ease: 'power3.out'
        });
        
        gsap.from('.hero-overlay', {
            duration: 1,
            opacity: 0,
            ease: 'power3.out',
            delay: 0.5
        });
        
        gsap.from('.hero-subtitle', {
            duration: 0.8,
            y: 30,
            opacity: 0,
            ease: 'power3.out',
            delay: 0.6
        });
        
        gsap.from('.hero-title', {
            duration: 1,
            y: 100,
            opacity: 0,
            ease: 'power3.out',
            delay: 0.8
        });
        
        gsap.from('.hero-description', {
            duration: 0.8,
            y: 30,
            opacity: 0,
            ease: 'power3.out',
            delay: 1
        });
        
        var heroBtn = document.querySelector('.hero-section .hero-btn');
        if (heroBtn) {
            gsap.from(heroBtn, {
                duration: 0.8,
                y: 30,
                opacity: 0,
                ease: 'power3.out',
                delay: 1.2,
                onComplete: function() {
                    heroBtn.style.opacity = '1';
                }
            });
        }
        

        
        // Section animations (scroll-triggered, play once)
        var sections = [
            { trigger: '.new-in-section', start: 'top 80%' },
            { trigger: '.lifestyle-section', start: 'top 70%' },
            { trigger: '.categories-section', start: 'top 75%' },
            { trigger: '.shop-look-section', start: 'top 75%' },
            { trigger: '.urban-elegance-section', start: 'top 70%' },
            { trigger: '.magazine-section', start: 'top 75%' },
            { trigger: '.newsletter-section', start: 'top 80%' }
        ];
        
        sections.forEach(function(section) {
            var elements = document.querySelectorAll(section.trigger + ' .section-title, ' + section.trigger + ' .section-subtitle');
            if (elements.length) {
                gsap.from(elements, {
                    scrollTrigger: {
                        trigger: section.trigger,
                        start: section.start,
                        toggleActions: 'play none none reverse'
                    },
                    duration: 0.8,
                    y: 30,
                    opacity: 0,
                    stagger: 0.1,
                    ease: 'power2.out'
                });
            }
        });
        
        // Product cards
        var productCards = document.querySelectorAll('.product-card');
        if (productCards.length) {
            gsap.fromTo(productCards, 
                { opacity: 0, y: 40 },
                {
                    scrollTrigger: {
                        trigger: '.products-grid',
                        start: 'top 80%',
                        toggleActions: 'play none none reverse'
                    },
                    duration: 0.6,
                    y: 0,
                    opacity: 1,
                    stagger: 0.1,
                    ease: 'power2.out'
                }
            );
        }
        
        // Category cards
        var categoryCards = document.querySelectorAll('.category-card');
        if (categoryCards.length) {
            gsap.from(categoryCards, {
                scrollTrigger: {
                    trigger: '.categories-grid',
                    start: 'top 75%',
                    toggleActions: 'play none none reverse'
                },
                duration: 0.8,
                y: 60,
                opacity: 0,
                stagger: 0.1,
                ease: 'power3.out'
            });
        }
        
        // Look products
        var lookProducts = document.querySelectorAll('.look-product-card');
        if (lookProducts.length) {
            gsap.from(lookProducts, {
                scrollTrigger: {
                    trigger: '.shop-look-section',
                    start: 'top 75%',
                    toggleActions: 'play none none reverse'
                },
                duration: 0.6,
                x: 30,
                opacity: 0,
                stagger: 0.15,
                ease: 'power2.out'
            });
        }
        
        // Magazine cards
        var magazineCards = document.querySelectorAll('.magazine-card');
        if (magazineCards.length) {
            gsap.from(magazineCards, {
                scrollTrigger: {
                    trigger: '.magazine-section',
                    start: 'top 75%',
                    toggleActions: 'play none none reverse'
                },
                duration: 0.6,
                scale: 0.8,
                opacity: 0,
                stagger: 0.1,
                ease: 'back.out(1.4)'
            });
        }
        
        // Parallax effects (optional, subtle)
        var parallaxImages = document.querySelectorAll('.urban-elegance-image img, .lifestyle-image img');
        if (parallaxImages.length) {
            gsap.to(parallaxImages, {
                scrollTrigger: {
                    trigger: '.urban-elegance-section',
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: 1
                },
                y: '10%',
                ease: 'none'
            });
        }
        
        // Hover effects (CSS-based, no JS needed for basic functionality)
    });
    
})();