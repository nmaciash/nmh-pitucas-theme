<?php
/**
 * Template Name: Página Legal
 *
 * @package NMH_Pitucas
 */

get_header();

// Get page data
$page_id = get_the_ID();
$title = get_the_title( $page_id );
?>

<main id="primary" class="site-main legal-page">
    <header class="legal-hero section-padding">
        <div class="container">
            <h1 class="section-title"><?php echo esc_html( $title ); ?></h1>
        </div>
    </header>

    <section class="legal-content-section">
        <div class="container">
            <div class="legal-page-content">
                <?php
                while ( have_posts() ) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
