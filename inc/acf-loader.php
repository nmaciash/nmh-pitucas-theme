<?php
function nmh_acf_init() {
    if ( ! class_exists( 'ACF' ) ) {
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
    if ( ! class_exists( 'ACF' ) ) {
        return;
    }
    
    $show_admin = getenv( 'ACF_SHOW_ADMIN' );
    
    if ( $show_admin !== 'true' ) {
        add_filter( 'acf/settings/show_admin', '__return_false' );
    }
}
add_action( 'init', 'nmh_acf_hide_admin' );

function nmh_register_content_slot( $slug, $title, $fields = array() ) {
    if ( ! class_exists( 'ACF' ) ) {
        return false;
    }
    
    $field_group = array(
        'key'                   => 'group_nmh_slot_' . sanitize_title( $slug ),
        'title'                 => $title,
        'fields'                => $fields,
        'location'              => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'post',
                ),
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => '',
    );
    
    return $field_group;
}

function nmh_get_acf_field( $field_name, $default = '' ) {
    if ( function_exists( 'get_field' ) ) {
        $value = get_field( $field_name );
        return $value !== false ? $value : $default;
    }
    return $default;
}

function nmh_get_acf_option( $option_name, $default = '' ) {
    if ( function_exists( 'get_field' ) ) {
        $value = get_field( $option_name, 'option' );
        return $value !== false ? $value : $default;
    }
    return $default;
}