<?php
/**
 * Front page template.
 *
 * @package PGroupChild
 */

get_header();
?>

<main class="pgroup-home">
    <section class="pgroup-hero">
        <div class="pgroup-hero-overlay"></div>
        <div class="pgroup-container pgroup-hero-inner">
            <p class="pgroup-eyebrow"><?php esc_html_e('PGroup', 'pgroup-child'); ?></p>
            <h1><?php echo esc_html(pgroup_get_field_safe('home_hero_title', 'Engenharia e Construcao')); ?></h1>
            <p class="pgroup-hero-text"><?php echo esc_html(pgroup_get_field_safe('home_hero_text', 'Atuamos em diferentes areas com equipas preparadas para responder as necessidades de cada cliente.')); ?></p>
            <a class="pgroup-button" href="<?php echo esc_url(home_url('/contactos/')); ?>">
                <?php esc_html_e('Fale connosco', 'pgroup-child'); ?>
            </a>
        </div>
    </section>

    <section class="pgroup-section">
        <div class="pgroup-container">
            <h2><?php esc_html_e('Servicos', 'pgroup-child'); ?></h2>
            <div class="pgroup-grid">
                <?php
                $services = new WP_Query(array(
                    'post_type' => 'servico',
                    'posts_per_page' => 6,
                ));
                if ($services->have_posts()) :
                    while ($services->have_posts()) :
                        $services->the_post();
                        ?>
                        <article <?php post_class('pgroup-card'); ?>>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); endif; ?>
                                <h3><?php the_title(); ?></h3>
                            </a>
                            <p><?php echo esc_html(pgroup_get_field_safe('servico_resumo', get_the_excerpt())); ?></p>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p><?php esc_html_e('Adicione servicos para mostrar aqui.', 'pgroup-child'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="pgroup-section pgroup-section-alt">
        <div class="pgroup-container">
            <h2><?php esc_html_e('Projetos', 'pgroup-child'); ?></h2>
            <div class="pgroup-grid">
                <?php
                $projects = new WP_Query(array(
                    'post_type' => 'projeto',
                    'posts_per_page' => 6,
                ));
                if ($projects->have_posts()) :
                    while ($projects->have_posts()) :
                        $projects->the_post();
                        ?>
                        <article <?php post_class('pgroup-card'); ?>>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); endif; ?>
                                <h3><?php the_title(); ?></h3>
                            </a>
                            <p><?php echo esc_html(pgroup_get_field_safe('projeto_cliente', get_the_excerpt())); ?></p>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p><?php esc_html_e('Adicione projetos para mostrar aqui.', 'pgroup-child'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="pgroup-section">
        <div class="pgroup-container">
            <h2><?php esc_html_e('Blog', 'pgroup-child'); ?></h2>
            <div class="pgroup-grid">
                <?php
                $posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                ));
                if ($posts->have_posts()) :
                    while ($posts->have_posts()) :
                        $posts->the_post();
                        ?>
                        <article <?php post_class('pgroup-card'); ?>>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); endif; ?>
                                <h3><?php the_title(); ?></h3>
                            </a>
                            <p><?php echo esc_html(get_the_excerpt()); ?></p>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
