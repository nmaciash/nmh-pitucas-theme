<?php
function nmh_disable_elementor_assets() {
    if ( ! defined( 'ELEMENTOR_TESTS' ) && ! empty( $_GET['action'] ) && $_GET['action'] === 'elementor' ) {
        return;
    }
    
    $post_id = get_the_ID();
    
    if ( $post_id && get_post_meta( $post_id, '_elementor_edit_mode', true ) ) {
        return;
    }
    
    wp_dequeue_style( 'elementor-global' );
    wp_dequeue_style( 'elementor-icons' );
    wp_dequeue_style( 'elementor-frontend' );
    wp_dequeue_style( 'elementor-post-' . absint( $post_id ) );
    
    wp_dequeue_script( 'elementor-frontend' );
    wp_dequeue_script( 'elementor-waypoints' );
    wp_dequeue_script( 'elementor-webpack-runtime' );
    wp_dequeue_script( 'elementor-webpack-runtime-modules' );
    
    add_filter( 'elementor/font_display', function( $value ) {
        return 'swap';
    } );
    
    remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
    remove_action( 'wp_footer', 'wp_enqueue_global_styles', 30 );
    
    remove_action( 'wp_enqueue_scripts', 'wp_enqueue_stylessheets' );
}
add_action( 'wp_enqueue_scripts', 'nmh_disable_elementor_assets', 100 );

function nmh_cleanup_elementor_head() {
    if ( ! is_singular() || ! class_exists( '\Elementor\Plugin' ) ) {
        return;
    }
    
    $document = \Elementor\Plugin::$instance->documents->get( get_the_ID() );
    
    if ( ! $document || ! $document->is_editable() ) {
        remove_action( 'wp_head', 'wp_resource_hints', 2 );
        remove_action( 'wp_head', array( \Elementor\Plugin::$instance->frontend, 'add_preload_fonts' ) );
    }
}
add_action( 'wp_head', 'nmh_cleanup_elementor_head', 1 );