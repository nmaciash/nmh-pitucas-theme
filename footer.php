    <?php
    $footer_description = nmh_get_footer_field( 'footer_description', 'Moda femenina contemporánea con alma y propósito. Elegancia que habla por ti.' );
    $ig_url = nmh_get_footer_field( 'footer_social_instagram', 'https://instagram.com/' );
    $pt_url = nmh_get_footer_field( 'footer_social_pinterest', 'https://pinterest.com/' );
    $tk_url = nmh_get_footer_field( 'footer_social_tiktok', 'https://tiktok.com/' );
    ?>
    <footer id="colophon" class="site-footer">
        <div class="container footer-content-grid">
            <!-- Brand Column -->
            <div class="footer-col brand-col">
                <h2 class="footer-brand">PITUCAS</h2>
                <div class="footer-desc">
                    <p><?php echo esc_html( $footer_description ); ?></p>
                </div>
            </div>

            <!-- Shop Column -->
            <div class="footer-col">
                <h3 class="footer-title"><?php esc_html_e( 'SHOP', 'nmh-pitucas' ); ?></h3>
                <nav class="footer-nav">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer-shop',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ) );
                    ?>
                </nav>
            </div>

            <!-- Informacion Column -->
            <div class="footer-col">
                <h3 class="footer-title"><?php esc_html_e( 'INFORMACION', 'nmh-pitucas' ); ?></h3>
                <nav class="footer-nav">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer-info',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ) );
                    ?>
                </nav>
            </div>

            <!-- Contact & Social Column -->
            <div class="footer-col">
                <h3 class="footer-title"><?php esc_html_e( 'ATENCION AL CLIENTE', 'nmh-pitucas' ); ?></h3>
                <nav class="footer-nav">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer-atencion',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ) );
                    ?>
                </nav>

                <div class="social-section">
                    <h3 class="footer-title"><?php esc_html_e( 'SIGUENOS', 'nmh-pitucas' ); ?></h3>
                    <div class="social-links">
                        <a href="<?php echo esc_url( $ig_url ); ?>" target="_blank" rel="noopener" aria-label="Instagram"><?php esc_html_e( 'Instagram', 'nmh-pitucas' ); ?></a>
                        <a href="<?php echo esc_url( $pt_url ); ?>" target="_blank" rel="noopener" aria-label="Pinterest"><?php esc_html_e( 'Pinterest', 'nmh-pitucas' ); ?></a>
                        <a href="<?php echo esc_url( $tk_url ); ?>" target="_blank" rel="noopener" aria-label="TikTok"><?php esc_html_e( 'TikTok', 'nmh-pitucas' ); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kit Digital Logo -->
        <div class="footer-kit-digital">
            <div class="container">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kit-logo-new.png" alt="Kit Digital - Plan de Recuperación, Transformación y Resiliencia">
            </div>
        </div>

        <!-- Bottom Strip -->
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. 
                <?php esc_html_e( 'Todos los derechos reservados.', 'nmh-pitucas' ); ?></p>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>