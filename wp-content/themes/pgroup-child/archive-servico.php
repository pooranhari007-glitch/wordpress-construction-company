<?php
/**
 * Archive template for Servicos.
 *
 * @package PGroupChild
 */

get_header();
?>
<main class="pgroup-section">
    <div class="pgroup-container">
        <h1><?php post_type_archive_title(); ?></h1>
        <?php if (have_posts()) : ?>
            <div class="pgroup-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('pgroup-card'); ?>>
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php endif; ?>
                            <h2><?php the_title(); ?></h2>
                        </a>
                        <p><?php echo esc_html(pgroup_get_field_safe('servico_resumo', get_the_excerpt())); ?></p>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p><?php esc_html_e('Sem servicos para mostrar.', 'pgroup-child'); ?></p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
