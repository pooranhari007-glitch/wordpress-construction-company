<?php
/**
 * Single template for Servico.
 *
 * @package PGroupChild
 */

get_header();
?>
<main id="primary" class="pgroup-section">
    <div class="pgroup-container">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                <?php $subtitulo = pgroup_get_field_safe('servico_subtitulo'); ?>
                <?php if (!empty($subtitulo)) : ?>
                    <p class="pgroup-subtitle"><?php echo esc_html($subtitulo); ?></p>
                <?php endif; ?>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="pgroup-hero-image"><?php the_post_thumbnail('full'); ?></div>
                <?php endif; ?>

                <div class="pgroup-content"><?php the_content(); ?></div>

                <?php
                $cta_text = pgroup_get_field_safe('servico_cta_texto', 'Fale connosco');
                $cta_link = pgroup_get_field_safe('servico_cta_link', home_url('/contactos/'));
                ?>
                <p><a class="pgroup-button" href="<?php echo esc_url($cta_link); ?>"><?php echo esc_html($cta_text); ?></a></p>
            </article>
        <?php endwhile; ?>
    </div>
</main>
<?php get_footer(); ?>
