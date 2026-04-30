<?php
/**
 * Single template for Servico.
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

add_filter('body_class', function ($classes) {
    $classes[] = 'pgroup-overlay-about';
    $classes[] = 'pgroup-servicos-new-page';
    $classes[] = 'pgroup-single-servico-page';
    return array_values(array_unique($classes));
});

get_header();

while (have_posts()) :
    the_post();

    $hero_title = get_the_title();
    $hero_bg_url = '';
    if (has_post_thumbnail()) {
        $hero_bg_url = (string) get_the_post_thumbnail_url(get_the_ID(), 'full');
    }
    if ($hero_bg_url === '') {
        $hero_bg_candidates = array(
            get_stylesheet_directory() . '/assets/images/servico-construcao-hero-v2.png',
            get_stylesheet_directory() . '/assets/images/single-servico-hero.png',
        );
        foreach ($hero_bg_candidates as $hero_bg_path) {
            if (file_exists($hero_bg_path)) {
                $hero_bg_url = get_stylesheet_directory_uri() . '/assets/images/' . basename($hero_bg_path);
                $hero_bg_url .= '?v=' . (string) filemtime($hero_bg_path);
                break;
            }
        }
    }
    $hero_bg_layers = $hero_bg_url !== ''
        ? 'linear-gradient(180deg, rgba(23,31,36,0.34) 0%, rgba(23,31,36,0.74) 100%), url(' . esc_url($hero_bg_url) . ')'
        : 'linear-gradient(180deg, #2a5a82 0%, #171f24 100%)';

    $about_title = pgroup_get_field_safe('servico_about_title', 'Excelência e rigor em construção civil e obras públicas');
    $about_points = array(
        pgroup_get_field_safe('servico_about_point_1', 'Construção de raiz e reabilitações'),
        pgroup_get_field_safe('servico_about_point_2', 'Rigor técnico e acompanhamento especializado'),
        pgroup_get_field_safe('servico_about_point_3', 'Cumprimento de prazos'),
        pgroup_get_field_safe('servico_about_point_4', 'Soluções seguras e sustentáveis'),
        pgroup_get_field_safe('servico_about_point_5', 'Planeamento detalhado do início à entrega'),
    );
    $about_img_path = get_stylesheet_directory() . '/assets/images/servicos-sobre-obra.png';
    $about_img_url = get_stylesheet_directory_uri() . '/assets/images/servicos-sobre-obra.png';
    if (file_exists($about_img_path)) {
        $about_img_url .= '?v=' . (string) filemtime($about_img_path);
    }
    ?>

    <main id="primary" class="pgroup-servicos-new-main">
        <section class="pgroup-servicos-new-hero-wrap">
            <div class="pgroup-servicos-new-hero" style="background-image: <?php echo esc_attr($hero_bg_layers); ?>;">
                <div class="pgroup-servicos-new-hero-copy">
                    <h1><?php echo esc_html($hero_title); ?></h1>
                </div>
            </div>
        </section>

        <section class="pgroup-servicos-new-about">
            <div class="pgroup-servicos-new-about-inner">
                <div class="pgroup-servicos-new-about-copy">
                    <h2><?php echo esc_html($about_title); ?></h2>
                    <ul>
                        <?php foreach ($about_points as $point) : ?>
                            <?php if (!is_string($point) || trim($point) === '') { continue; } ?>
                            <li><?php echo esc_html($point); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="pgroup-servicos-new-about-image">
                    <img src="<?php echo esc_url($about_img_url); ?>" alt="<?php echo esc_attr(__('Obra em execução', 'pgroup-child')); ?>" loading="lazy" decoding="async">
                </div>
            </div>
        </section>
    </main>
    <?php
endwhile;

get_footer();
