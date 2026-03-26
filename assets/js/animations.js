/* NMH Pitucas Theme - Animations */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
            
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach(function(el) {
                gsap.fromTo(el, 
                    { opacity: 0, y: 30 },
                    {
                        opacity: 1,
                        y: 0,
                        duration: 0.8,
                        scrollTrigger: {
                            trigger: el,
                            start: 'top 80%',
                            toggleActions: 'play none none reverse'
                        }
                    }
                );
            });
        }
    });
})();