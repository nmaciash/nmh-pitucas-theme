<?php
get_header();
?>

<main id="primary" class="site-main">
    <?php
    if ( have_posts() ) :
        if ( is_home() && ! is_front_page() ) :
            ?>
            <header>
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header>
            <?php
        endif;

        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
    else :
        ?>
        <section class="no-results not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'nmh-pitucas' ); ?></h1>
            </header>
            <div class="page-content">
                <p><?php esc_html_e( 'Sorry, no content found.', 'nmh-pitucas' ); ?></p>
            </div>
        </section>
        <?php
    endif;
    ?>
</main>

<?php
get_footer();