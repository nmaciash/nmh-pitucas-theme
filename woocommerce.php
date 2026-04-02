<?php
/**
 * WooCommerce Template Wrapper
 */

get_header(); ?>

<main id="main-content" class="pitucas-shop-page">

    <section class="shop-hero section-padding">
        <div class="container">
            <div class="section-header centered">
                <span class="section-label">Colección</span>
                <h1 class="section-title">
                    <?php
                    if (is_shop()) {
                        echo 'Nuestra Tienda';
                    } elseif (is_product_category()) {
                        single_cat_title();
                    } elseif (is_product_tag()) {
                        single_tag_title();
                    } else {
                        woocommerce_page_title();
                    }
                    ?>
                </h1>
            </div>
        </div>
    </section>

    <section class="shop-content">
        <div class="container">
            <?php woocommerce_content(); ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>