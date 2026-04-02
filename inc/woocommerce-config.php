<?php
/**
 * WooCommerce Custom Configuration for NMH Pitucas Theme
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    return;
}

// 1. Change number of products per row to 4
add_filter( 'loop_shop_columns', 'nmh_loop_columns', 999 );
function nmh_loop_columns() {
    return 4;
}

// 2. Wrap product loop in theme containers if needed (handled in woocommerce.php)

// 3. Customize Product Loop Item markup to match Home Page
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// Also remove default thumbnail to control it manually
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// Add our custom markup
add_action( 'woocommerce_before_shop_loop_item', 'nmh_template_loop_product_card_open', 5 );
function nmh_template_loop_product_card_open() {
    echo '<div class="product-card gsap-fade-up">';
}

add_action( 'woocommerce_before_shop_loop_item', 'nmh_template_loop_product_image_open', 10 );
function nmh_template_loop_product_image_open() {
    echo '<div class="product-image">';
    echo '<a href="' . get_the_permalink() . '">';
    // Use 'full' size as in front-page.php
    echo get_the_post_thumbnail( get_the_ID(), 'full' );
    echo '</a>';
    echo '</div>'; // close product-image
    echo '<div class="product-info">';
}

// Since we closed it in the previous hook, we remove the close hook
// remove_action( 'woocommerce_before_shop_loop_item_title', 'nmh_template_loop_product_image_close', 15 );

add_action( 'woocommerce_shop_loop_item_title', 'nmh_template_loop_product_title', 10 );
function nmh_template_loop_product_title() {
    echo '<h3 class="product-name">';
    echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
    echo '</h3>';
}

add_action( 'woocommerce_after_shop_loop_item_title', 'nmh_template_loop_product_price', 10 );
function nmh_template_loop_product_price() {
    global $product;
    echo '<span class="product-price">' . $product->get_price_html() . '</span>';
}

add_action( 'woocommerce_after_shop_loop_item', 'nmh_template_loop_product_card_close', 20 );
function nmh_template_loop_product_card_close() {
    echo '</div>'; // close product-info
    echo '</div>'; // close product-card
}

// 4. Remove WooCommerce breadcrumbs and other elements to match theme look
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// 5. Change number of products displayed per page
add_filter( 'loop_shop_per_page', 'nmh_products_per_page', 999 );
function nmh_products_per_page( $cols ) {
    return 12; // 3 rows of 4
}
