<?php
function nmh_enqueue_assets() {
    $template_dir = get_template_directory_uri();
    
    wp_enqueue_style(
        'nmh-main-style',
        $template_dir . '/assets/css/main.css',
        array(),
        filemtime( get_template_directory() . '/assets/css/main.css' )
    );
    
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', true );
    wp_enqueue_script( 'jquery' );
    
    wp_enqueue_script(
        'gsap-core',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        array(),
        '3.12.5',
        true
    );
    
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        array( 'gsap-core' ),
        '3.12.5',
        true
    );
    
    wp_enqueue_script(
        'nmh-animations',
        $template_dir . '/assets/js/animations.js',
        array( 'gsap-core', 'gsap-scrolltrigger' ),
        filemtime( get_template_directory() . '/assets/js/animations.js' ),
        true
    );
    
    wp_enqueue_script(
        'nmh-main-script',
        $template_dir . '/assets/js/main.js',
        array( 'jquery', 'gsap-core', 'gsap-scrolltrigger' ),
        filemtime( get_template_directory() . '/assets/js/main.js' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'nmh_enqueue_assets' );