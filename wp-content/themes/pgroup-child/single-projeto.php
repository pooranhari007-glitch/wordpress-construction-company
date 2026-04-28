<?php
/**
 * Single template for Projeto.
 *
 * @package PGroupChild
 */

get_header();
?>
<main class="pgroup-section">
    <div class="pgroup-container">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                <ul class="pgroup-meta">
                    <?php $cliente = pgroup_get_field_safe('projeto_cliente'); ?>
                    <?php if ($cliente) : ?>
                        <li><strong><?php esc_html_e('Cliente:', 'pgroup-child'); ?></strong> <?php echo esc_html($cliente); ?></li>
                    <?php endif; ?>
                    <?php $data = pgroup_get_field_safe('projeto_data'); ?>
                    <?php if ($data) : ?>
                        <li><strong><?php esc_html_e('Data:', 'pgroup-child'); ?></strong> <?php echo esc_html($data); ?></li>
                    <?php endif; ?>
                    <?php $local = pgroup_get_field_safe('projeto_local'); ?>
                    <?php if ($local) : ?>
                        <li><strong><?php esc_html_e('Local:', 'pgroup-child'); ?></strong> <?php echo esc_html($local); ?></li>
                    <?php endif; ?>
                </ul>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="pgroup-hero-image"><?php the_post_thumbnail('full'); ?></div>
                <?php endif; ?>

                <div class="pgroup-content"><?php the_content(); ?></div>

                <?php $gallery = pgroup_get_field_safe('projeto_galeria', array()); ?>
                <?php if (!empty($gallery) && is_array($gallery)) : ?>
                    <div class="pgroup-grid">
                        <?php foreach ($gallery as $image) : ?>
                            <figure class="pgroup-card">
                                <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>">
                            </figure>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    </div>
</main>
<?php get_footer(); ?>
