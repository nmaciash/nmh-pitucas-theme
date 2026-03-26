<?php
function nmh_load_env() {
    $env_file = get_template_directory() . '/.env';
    
    if ( ! file_exists( $env_file ) ) {
        return false;
    }
    
    $lines = file( $env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
    
    foreach ( $lines as $line ) {
        if ( strpos( trim( $line ), '#' ) === 0 ) {
            continue;
        }
        
        list( $key, $value ) = explode( '=', $line, 2 );
        $key = trim( $key );
        $value = trim( $value );
        
        if ( ! empty( $key ) ) {
            putenv( "$key=$value" );
            $_ENV[ $key ] = $value;
        }
    }
    
    return true;
}