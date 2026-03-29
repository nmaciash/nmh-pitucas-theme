/* NMH Pitucas Theme - Main JavaScript */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 500);
            }
        });
        
        // Mobile menu toggle
        $('.menu-toggle').on('click', function() {
            $('.main-navigation').toggleClass('active');
            $('body').css('overflow', 'hidden');
        });
        
        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if ($('.main-navigation').hasClass('active')) {
                if (!$(e.target).closest('.main-navigation').length && !$(e.target).closest('.menu-toggle').length) {
                    $('.main-navigation').removeClass('active');
                    $('body').css('overflow', '');
                }
            }
        });
        
        // Sticky header on scroll
        var $header = $('.site-header');
        $(window).on('scroll', function() {
            var scrollTop = $(this).scrollTop();
            if (scrollTop > 100) {
                $header.addClass('sticky');
            } else {
                $header.removeClass('sticky');
            }
        });
        
        // Dynamic Logo Changer
        (function() {
            var logo = document.getElementById('pitucas-logo');
            var logoMobile = document.querySelector('.site-branding-mobile .pitucas-logo');
            if (!logo || typeof pitucasTheme === 'undefined') {
                console.log('Logo or theme config not found');
                return;
            }
            
            var logoWhite = pitucasTheme.logoWhite;
            var logoBlack = pitucasTheme.logoBlack;
            var currentLogo = '';
            
            var darkSections = [
                '.hero-section',
                '.lifestyle-section', 
                '.urban-elegance-section',
                '.newsletter-section'
            ];
            
            function updateLogo() {
                var scrollPos = $(window).scrollTop();
                var windowHeight = $(window).height();
                var foundDark = false;
                
                darkSections.forEach(function(selector) {
                    var section = $(selector);
                    if (section.length) {
                        var sectionTop = section.offset().top;
                        var sectionBottom = sectionTop + section.outerHeight();
                        
                        if (scrollPos + (windowHeight * 0.3) >= sectionTop && 
                            scrollPos + (windowHeight * 0.3) <= sectionBottom) {
                            foundDark = true;
                        }
                    }
                });
                
                var newLogo = foundDark ? logoWhite : logoBlack;
                
                if (currentLogo !== newLogo) {
                    currentLogo = newLogo;
                    logo.src = newLogo;
                    if (logoMobile) {
                        logoMobile.src = newLogo;
                    }
                }
                
                if (foundDark) {
                    $header.addClass('dark-bg').removeClass('solid-bg');
                } else {
                    $header.removeClass('dark-bg').addClass('solid-bg');
                }
            }
            
            function debounce(func, wait) {
                var timeout;
                return function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(func, wait);
                };
            }
            
            updateLogo();
            $(window).on('scroll', debounce(updateLogo, 50));
        })();
        
    });
    
})(jQuery);