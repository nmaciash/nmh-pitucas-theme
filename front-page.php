<?php
/**
 * Template Name: Front Page
 * Description: Página de inicio personalizada para Pitucas Moda
 */

get_header(); ?>

<main id="main-content" class="pitucas-homepage">

    <!-- Hero Section -->
    <?php
    $hero_image = nmh_get_acf_field('hero_image', get_template_directory_uri() . '/assets/images/hero-new-collection.webp');
    $hero_subtitle = nmh_get_acf_field('hero_subtitle', 'New Collection');
    $hero_title = nmh_get_acf_field('hero_title', 'Elegancia que habla por ti');
    $hero_description = nmh_get_acf_field('hero_description', 'Descubre piezas que definen tu estilo con sofisticación natural y confianza');
    $hero_button_text = nmh_get_acf_field('hero_button_text', 'Descubrir ahora');
    $hero_button_url = nmh_get_acf_field('hero_button_url', get_permalink(wc_get_page_id('shop')));
    ?>
    <section class="hero-section gsap-fade-in">
        <div class="hero-image">
            <img src="<?php echo esc_url($hero_image); ?>" alt="<?php echo esc_attr($hero_title); ?>">
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
            <h2 class="hero-title"><?php echo esc_html($hero_title); ?></h2>
            <p class="hero-description"><?php echo esc_html($hero_description); ?></p>
            <a href="<?php echo esc_url($hero_button_url); ?>" class="hero-btn">
                <?php echo esc_html($hero_button_text); ?>
            </a>
        </div>
    </section>

    <!-- New In Section -->
    <?php
    $newin_subtitle = nmh_get_acf_field('newin_subtitle', 'Lo Último');
    $newin_title = nmh_get_acf_field('newin_title', 'New In');
    $newin_button_text = nmh_get_acf_field('newin_button_text', 'Ver todo');
    $newin_button_url = nmh_get_acf_field('newin_button_url', get_permalink(wc_get_page_id('shop')));
    ?>
    <section class="new-in-section section-padding">
        <div class="container">
            <div class="section-header newin-header">
                <span class="newin-subtitle"><?php echo esc_html($newin_subtitle); ?></span>
                <h2 class="section-title newin-title"><?php echo esc_html($newin_title); ?></h2>
            </div>

            <div class="products-grid gsap-stagger">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 8,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                $new_products = new WP_Query($args);

                if ($new_products->have_posts()):
                    while ($new_products->have_posts()):
                        $new_products->the_post();
                        global $product;
                        ?>
                        <div class="product-card gsap-fade-up">
                            <div class="product-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                                </a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <div class="newin-bottom-cta">
                <a href="<?php echo esc_url($newin_button_url); ?>" class="hero-btn">
                    <?php echo esc_html($newin_button_text); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Nuestra Historia Section -->
    <?php
    $historia_label = nmh_get_acf_field('historia_label', 'Nuestra historia');
    $historia_title = nmh_get_acf_field('historia_title', 'Moda con alma, estilo con propósito');
    $historia_paragraph1 = nmh_get_acf_field('historia_paragraph1', 'Pitucas nació de la pasión por vestir a la mujer contemporánea con piezas que hablan de ella: su confianza, su elegancia natural y su forma única de moverse por el mundo.');
    $historia_paragraph2 = nmh_get_acf_field('historia_paragraph2', 'Cada prenda está pensada para acompañar tus momentos, desde los más sencillos hasta los más especiales. Tejidos nobles, cortes cuidados y una paleta que respira serenidad. Porque el verdadero lujo es sentirte tú.');
    $historia_button_text = nmh_get_acf_field('historia_button_text', 'Conoce la marca');
    $historia_button_url = nmh_get_acf_field('historia_button_url', '#');
    ?>
    <section class="lifestyle-section gsap-parallax">
        <div class="container-fluid">
            <div class="lifestyle-grid">
                <div class="lifestyle-content">
                    <div class="content-wrapper">
                        <span class="section-label"><?php echo esc_html(strtoupper($historia_label)); ?></span>
                        <h2 class="lifestyle-title gsap-split-text">
                            <?php echo esc_html($historia_title); ?>
                        </h2>
                        <p class="lifestyle-description">
                            <?php echo esc_html($historia_paragraph1); ?>
                        </p>
                        <p class="lifestyle-description">
                            <?php echo esc_html($historia_paragraph2); ?>
                        </p>
                        <a href="<?php echo esc_url($historia_button_url); ?>" class="btn-secondary gsap-scale">
                            <?php echo esc_html(strtoupper($historia_button_text)); ?>
                        </a>
                    </div>
                </div>
                <div class="lifestyle-image gsap-scale-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lifestyle-image.webp"
                        alt="Moda consciente">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <?php
    $cat1_name = nmh_get_acf_field('cat1_name', 'Ropa');
    $cat1_url = nmh_get_acf_field('cat1_url', '#');
    $cat2_name = nmh_get_acf_field('cat2_name', 'Complementos');
    $cat2_url = nmh_get_acf_field('cat2_url', '#');
    $cat3_name = nmh_get_acf_field('cat3_name', 'Calzado');
    $cat3_url = nmh_get_acf_field('cat3_url', '#');
    ?>
    <section class="categories-section section-padding">
        <div class="container">
            <div class="categories-grid gsap-stagger">
                <div class="category-card gsap-hover">
                    <a href="<?php echo esc_url($cat1_url); ?>" class="category-link">
                        <div class="category-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cat01.webp"
                                alt="<?php echo esc_attr($cat1_name); ?>">
                            <div class="category-overlay"></div>
                        </div>
                        <h3 class="category-name"><?php echo esc_html($cat1_name); ?></h3>
                    </a>
                </div>
                <div class="category-card gsap-hover">
                    <a href="<?php echo esc_url($cat2_url); ?>" class="category-link">
                        <div class="category-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cat02.webp"
                                alt="<?php echo esc_attr($cat2_name); ?>">
                            <div class="category-overlay"></div>
                        </div>
                        <h3 class="category-name"><?php echo esc_html($cat2_name); ?></h3>
                    </a>
                </div>
                <div class="category-card gsap-hover">
                    <a href="<?php echo esc_url($cat3_url); ?>" class="category-link">
                        <div class="category-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cat03.webp"
                                alt="<?php echo esc_attr($cat3_name); ?>">
                            <div class="category-overlay"></div>
                        </div>
                        <h3 class="category-name"><?php echo esc_html($cat3_name); ?></h3>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop the Look Section -->
    <section class="shop-look-section section-padding hide">
        <div class="container">
            <h2 class="section-title centered">Shop the Look</h2>
            <p class="section-subtitle">Looks completos seleccionados por nuestro equipo de estilistas</p>

            <div class="look-wrapper gsap-fade-in">
                <div class="look-image gsap-scale-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/look-outfit.webp"
                        alt="Shop the Look">
                </div>
                <div class="look-products">
                    <div class="look-product-card gsap-slide-left">
                        <div class="look-product-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/look-product-1.jpg"
                                alt="Producto 1">
                        </div>
                        <div class="look-product-info">
                            <h4>SWEATER CARAMELO</h4>
                            <span class="price">125€</span>
                        </div>
                    </div>

                    <div class="look-product-card gsap-slide-left">
                        <div class="look-product-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/look-product-2.jpg"
                                alt="Producto 2">
                        </div>
                        <div class="look-product-info">
                            <h4>PANTALÓN DE VESTIR</h4>
                            <span class="price">89€</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Urban Elegance Section -->
    <section class="urban-elegance-section gsap-parallax-section">
        <div class="urban-elegance-container">
            <div class="urban-elegance-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/urban-elegance-bg.webp"
                    alt="Urban Elegance">
                <div class="urban-elegance-overlay"></div>
            </div>
            <div class="urban-elegance-content">
                <h2 class="urban-title gsap-split-text">Urban Elegance</h2>
                <p class="urban-subtitle">CAMPAÑA PRIMAVERA 2026</p>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn-white gsap-scale">
                    EXPLORAR
                </a>
            </div>
        </div>
    </section>

    <!-- Magazine Section -->
    <section class="magazine-section section-padding hide">
        <div class="container">
            <h2 class="section-title centered">#PitucasMuse</h2>
            <p class="section-subtitle">Inspiración y estilo en nuestra comunidad</p>

            <div class="magazine-grid gsap-stagger">
                <?php
                for ($i = 1; $i <= 6; $i++):
                    ?>
                    <div class="magazine-card gsap-hover">
                        <div class="magazine-frame">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/magazine-<?php echo absint($i); ?>.jpg"
                                alt="Pitucas Muse <?php echo absint($i); ?>">
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section section-padding">
        <div class="container">
            <div class="newsletter-wrapper">
                <h2 class="newsletter-title">Únete a nuestra comunidad</h2>
                <p class="newsletter-description">Recibe ofertas exclusivas, nuevas colecciones y contenido inspirador
                </p>

                <form class="newsletter-form" id="newsletter-form">
                    <input type="email" name="newsletter_email" placeholder="Correo electrónico" required
                        class="newsletter-input">
                    <button type="submit" class="btn-primary">SUSCRIBIRME</button>
                </form>
                <div id="newsletter-message"></div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>