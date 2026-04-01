<?php
/**
 * Template Name: Footer Settings Template
 * 
 * Esta plantilla se utiliza exclusivamente para gestionar los campos del Footer
 * a través de ACF. No está destinada a ser visualizada por los usuarios.
 */

// Redirigir a la página de inicio si alguien intenta ver esta página directamente
wp_safe_redirect( home_url() );
exit;
