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
            $('.main-navigation ul').toggleClass('active');
        });
        
        // Sticky header on scroll
        var header = $('.site-header');
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 100) {
                header.addClass('sticky');
            } else {
                header.removeClass('sticky');
            }
        });
        
    });
    
})(jQuery);