<?php
/**
 * Blog index template.
 *
 * @package PGroupChild
 */

get_header();
?>
<main id="primary" class="pgroup-section">
    <div class="pgroup-container">
        <h1><?php esc_html_e('Blog', 'pgroup-child'); ?></h1>
        <?php if (have_posts()) : ?>
            <div class="pgroup-grid pgroup-archive-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('pgroup-card'); ?>>
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); endif; ?>
                            <h2><?php the_title(); ?></h2>
                        </a>
                        <p><?php echo esc_html(get_the_excerpt()); ?></p>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p><?php esc_html_e('Sem artigos para mostrar.', 'pgroup-child'); ?></p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
