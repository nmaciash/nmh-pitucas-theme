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
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background' );

    register_nav_menus( array(
        'header-menu' => esc_html__( 'Header Menu', 'nmh-pitucas' ),
        'footer-menu' => esc_html__( 'Footer Menu', 'nmh-pitucas' ),
    ) );
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

foreach ( glob( get_template_directory() . '/inc/*.php' ) as $file ) {
    if ( basename( $file ) !== 'env-loader.php' ) {
        require_once $file;
    }
}