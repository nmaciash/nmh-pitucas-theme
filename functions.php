<?php
require_once get_template_directory() . '/inc/env-loader.php';
nmh_load_env();

function nmh_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    register_nav_menus( array(
        'header-menu'    => esc_html__( 'Header Menu', 'nmh-pitucas' ),
        'footer-menu'    => esc_html__( 'Footer Menu Main', 'nmh-pitucas' ),
        'footer-shop'    => esc_html__( 'Footer - Shop', 'nmh-pitucas' ),
        'footer-info'    => esc_html__( 'Footer - Información', 'nmh-pitucas' ),
        'footer-atencion' => esc_html__( 'Footer - Atención al Cliente', 'nmh-pitucas' ),
    ) );

    add_image_size( 'pitucas-product', 600, 800, true );
    add_image_size( 'pitucas-category', 500, 700, true );
    add_image_size( 'pitucas-hero', 1920, 1080, true );
    add_image_size( 'pitucas-magazine', 400, 600, true );
}
add_action( 'after_setup_theme', 'nmh_setup' );

function nmh_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'nmh-pitucas' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'nmh-pitucas' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'nmh_widgets_init' );

function nmh_enqueue_assets() {
    $template_dir = get_template_directory_uri();
    $template_path = get_template_directory();
    
    wp_enqueue_style(
        'nmh-main-style',
        $template_dir . '/assets/css/main.css',
        array(),
        filemtime( $template_path . '/assets/css/main.css' )
    );
    
    wp_enqueue_script( 'jquery' );
    
    if ( is_front_page() ) {
        wp_enqueue_style(
            'pitucas-fonts',
            'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap',
            array(),
            null
        );

        wp_enqueue_script(
            'gsap',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
            array(),
            '3.12.5',
            true
        );

        wp_enqueue_script(
            'gsap-scrolltrigger',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
            array( 'gsap' ),
            '3.12.5',
            true
        );

        wp_enqueue_script(
            'pitucas-animations',
            $template_dir . '/assets/js/pitucas-animations.js',
            array( 'gsap', 'gsap-scrolltrigger' ),
            filemtime( $template_path . '/assets/js/pitucas-animations.js' ),
            true
        );
    }
    
    wp_enqueue_script(
        'nmh-main-script',
        $template_dir . '/assets/js/main.js',
        array( 'jquery' ),
        filemtime( $template_path . '/assets/js/main.js' ),
        true
    );
    
    wp_localize_script( 'nmh-main-script', 'pitucasTheme', array(
        'templateUri' => get_template_directory_uri(),
        'logoWhite'   => get_template_directory_uri() . '/assets/images/logo-white.png',
        'logoBlack'   => get_template_directory_uri() . '/assets/images/logo-black.png'
    ));
}
add_action( 'wp_enqueue_scripts', 'nmh_enqueue_assets' );

function nmh_preload_fonts() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php
}
add_action( 'wp_head', 'nmh_preload_fonts', 1 );

function nmh_body_classes( $classes ) {
    if ( is_front_page() ) {
        $classes[] = 'pitucas-homepage';
    }
    return $classes;
}
add_filter( 'body_class', 'nmh_body_classes' );

function nmh_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'nmh_disable_emojis' );

function nmh_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'nmh_excerpt_length' );

function nmh_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'nmh_excerpt_more' );

foreach ( glob( get_template_directory() . '/inc/*.php' ) as $file ) {
    if ( basename( $file ) !== 'env-loader.php' ) {
        require_once $file;
    }
}