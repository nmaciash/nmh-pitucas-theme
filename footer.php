    </main>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="site-info">
                <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. 
                <?php esc_html_e( 'Todos los derechos reservados.', 'nmh-pitucas' ); ?></p>
            </div>

            <nav id="footer-navigation" class="footer-navigation">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer-menu',
                        'menu_id'        => 'footer-menu',
                        'container'      => false,
                        'depth'          => 1,
                    )
                );
                ?>
            </nav>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>