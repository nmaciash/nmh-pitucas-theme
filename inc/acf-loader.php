<?php
function nmh_acf_init() {
    if ( ! function_exists( 'acf' ) ) {
        return;
    }
    
    $show_admin = getenv( 'ACF_SHOW_ADMIN' );
    
    if ( $show_admin === 'true' ) {
        acf_update_setting( 'show_admin', true );
    } else {
        acf_update_setting( 'show_admin', false );
    }
    
    $json_save = get_template_directory() . '/inc/acf-json';
    if ( is_dir( $json_save ) ) {
        acf_update_setting( 'json', $json_save );
    }
    
    $json_load = get_stylesheet_directory() . '/inc/acf-json';
    if ( is_dir( $json_load ) ) {
        acf_update_setting( 'json_load_paths', array( $json_load ) );
    }
}
add_action( 'acf/init', 'nmh_acf_init' );

function nmh_acf_hide_admin() {
    if ( ! function_exists( 'acf' ) ) {
        return;
    }
    
    $show_admin = getenv( 'ACF_SHOW_ADMIN' );
    
    if ( $show_admin !== 'true' ) {
        add_filter( 'acf/settings/show_admin', '__return_false' );
    }
}
add_action( 'init', 'nmh_acf_hide_admin' );

function nmh_get_acf_field( $field_name, $default = '', $post_id = null ) {
    if ( ! function_exists( 'acf' ) || ! function_exists( 'get_field' ) ) {
        return $default;
    }
    
    $front_page_id = get_option( 'page_on_front' );
    if ( ! $post_id && $front_page_id ) {
        $post_id = $front_page_id;
    }
    
    if ( ! $post_id ) {
        return $default;
    }
    
    $value = get_field( $field_name, $post_id );
    
    if ( $value === false || $value === null || $value === '' ) {
        return $default;
    }
    
    return $value;
}

function nmh_get_acf_option( $option_name, $default = '' ) {
    if ( ! function_exists( 'get_field' ) ) {
        return $default;
    }
    
    $value = get_field( $option_name, 'option' );
    return $value !== false ? $value : $default;
}

/**
 * Get ACF field from dedicated 'Footer' page
 */
function nmh_get_footer_field( $field_name, $default = '' ) {
    if ( ! function_exists( 'acf' ) || ! function_exists( 'get_field' ) ) {
        return $default;
    }
    
    // Find page by template 'template-footer.php'
    $args = array(
        'post_type'  => 'page',
        'meta_key'   => '_wp_page_template',
        'meta_value' => 'template-footer.php',
        'posts_per_page' => 1
    );
    $footer_pages = get_posts( $args );
    $footer_page_id = ! empty( $footer_pages ) ? $footer_pages[0]->ID : null;
    
    if ( ! $footer_page_id ) {
        // Fallback to front page for backward compatibility
        return nmh_get_acf_field( $field_name, $default );
    }
    
    $value = get_field( $field_name, $footer_page_id );
    
    if ( $value === false || $value === null || $value === '' ) {
        return $default;
    }
    
    return $value;
}