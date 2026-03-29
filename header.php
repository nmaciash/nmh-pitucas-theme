<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'nmh-pitucas' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <!-- Desktop Header -->
            <div class="header-desktop">
                <div class="header-left">
                    <div class="site-branding">
                        <?php if ( has_custom_logo() ) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                <img id="pitucas-logo" 
                                     class="pitucas-logo" 
                                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-black.png" 
                                     alt="<?php bloginfo( 'name' ); ?>">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="header-center">
                    <nav class="desktop-nav">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'header-menu',
                                'menu_id'        => 'header-menu',
                                'container'      => false,
                            )
                        );
                        ?>
                    </nav>
                </div>

                <div class="header-right">
                    <div class="header-actions">
                        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'search' ) ) ); ?>" class="search-toggle" aria-label="Buscar">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </a>
                        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'cart' ) ) ); ?>" class="cart-toggle" aria-label="Carrito">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile Header -->
            <div class="header-mobile">
                <button class="menu-toggle" aria-label="Menú">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>

                <div class="site-branding-mobile">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <img class="pitucas-logo" 
                             src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-black.png" 
                             alt="<?php bloginfo( 'name' ); ?>">
                    </a>
                </div>

                <div class="header-actions">
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'search' ) ) ); ?>" class="search-toggle" aria-label="Buscar">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'cart' ) ) ); ?>" class="cart-toggle" aria-label="Carrito">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (slide from left) -->
        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'header-menu',
                    'menu_id'        => 'mobile-menu',
                    'container'      => false,
                )
            );
            ?>
        </nav>
    </header>

    <div class="mobile-menu-overlay"></div>