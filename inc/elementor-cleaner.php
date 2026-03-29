<?php
function nmh_disable_elementor_assets() {
    if ( is_admin() ) {
        return;
    }
    
    if ( ! empty( $_GET['action'] ) && $_GET['action'] === 'elementor' ) {
        return;
    }
    
    $post_id = get_queried_object_id();
    
    if ( $post_id && get_post_meta( $post_id, '_elementor_edit_mode', true ) ) {
        return;
    }
    
    wp_dequeue_style( 'elementor-global' );
    wp_dequeue_style( 'elementor-icons' );
    wp_dequeue_style( 'elementor-frontend' );
    
    if ( $post_id ) {
        wp_dequeue_style( 'elementor-post-' . $post_id );
    }
    
    wp_dequeue_script( 'elementor-frontend' );
    wp_dequeue_script( 'elementor-waypoints' );
    wp_dequeue_script( 'elementor-webpack-runtime' );
    wp_dequeue_script( 'elementor-webpack-runtime-modules' );
}
add_action( 'wp_enqueue_scripts', 'nmh_disable_elementor_assets', 100 );

function nmh_cleanup_elementor_head() {
    if ( ! is_singular() ) {
        return;
    }
    
    if ( ! class_exists( '\Elementor\Plugin' ) ) {
        return;
    }
    
    $post_id = get_queried_object_id();
    if ( ! $post_id ) {
        return;
    }
    
    $document = \Elementor\Plugin::$instance->documents->get( $post_id );
    
    if ( ! $document || ! $document->is_editable() ) {
        remove_action( 'wp_head', 'wp_resource_hints', 2 );
    }
}
add_action( 'wp_head', 'nmh_cleanup_elementor_head', 1 );