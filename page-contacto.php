<?php
/**
 * Template Name: Contacto
 *
 * @package NMH_Pitucas
 */

get_header();

// Get ACF fields with helper function
$page_id = get_the_ID();
$subtitle = nmh_get_acf_field( 'contact_subtitle', 'Contacto', $page_id );
$title = nmh_get_acf_field( 'contact_title', 'Estamos aquí para ayudarte', $page_id );
$description = nmh_get_acf_field( 'contact_description', '', $page_id );
$address = nmh_get_acf_field( 'contact_address', '', $page_id );
$phone = nmh_get_acf_field( 'contact_phone', '', $page_id );
$email = nmh_get_acf_field( 'contact_email', '', $page_id );
$hours = nmh_get_acf_field( 'contact_hours', '', $page_id );
$shortcode = nmh_get_acf_field( 'contact_form_shortcode', '', $page_id );
$map_iframe = nmh_get_acf_field( 'contact_map_iframe', '', $page_id );
?>

<main id="primary" class="site-main contact-page">
    <header class="contact-hero section-padding">
        <div class="container">
            <?php if ( $subtitle ) : ?>
                <span class="section-label"><?php echo esc_html( $subtitle ); ?></span>
            <?php endif; ?>
            
            <?php if ( $title ) : ?>
                <h1 class="section-title"><?php echo esc_html( $title ); ?></h1>
            <?php endif; ?>
            
            <?php if ( $description ) : ?>
                <div class="section-subtitle">
                    <p><?php echo esc_html( $description ); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <section class="contact-content section-padding">
        <div class="container">
            <div class="contact-grid">
                <!-- Columna Izquierda: Información -->
                <div class="contact-info">
                    <div class="info-item">
                        <h3 class="info-title">Dirección</h3>
                        <p><?php echo nl2br( esc_html( $address ) ); ?></p>
                    </div>

                    <div class="info-item">
                        <h3 class="info-title">Atención al Cliente</h3>
                        <?php if ( $phone ) : ?>
                            <p><strong>Tel:</strong> <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></p>
                        <?php endif; ?>
                        <?php if ( $email ) : ?>
                            <p><strong>Email:</strong> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
                        <?php endif; ?>
                    </div>

                    <?php if ( $hours ) : ?>
                        <div class="info-item">
                            <h3 class="info-title">Horario</h3>
                            <p><?php echo nl2br( esc_html( $hours ) ); ?></p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Columna Derecha: Formulario -->
                <div class="contact-form-container">
                    <?php if ( $shortcode ) : ?>
                        <div class="form-wrapper">
                            <?php echo do_shortcode( $shortcode ); ?>
                        </div>
                    <?php else : ?>
                        <div class="form-placeholder">
                            <p>Configura el shortcode del formulario en el panel de edición de la página.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Mapa -->
    <?php if ( $map_iframe ) : ?>
        <section class="contact-map-section">
            <div class="map-container">
                <?php echo $map_iframe; // Input is expected to be raw iframe code ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
get_footer();
