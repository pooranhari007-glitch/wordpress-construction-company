<?php
/**
 * Template Name: Serviços (Figma)
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

$pgroup_new_servicos_template = get_stylesheet_directory() . '/page-servicos-new.php';
if (file_exists($pgroup_new_servicos_template)) {
    include $pgroup_new_servicos_template;
    return;
}

add_filter('body_class', function ($classes) {
    $classes[] = 'pgroup-overlay-about';
    $classes[] = 'pgroup-services-page';
    return array_values(array_unique($classes));
});

get_header();

$hero_title = pgroup_get_field_safe('services_hero_title', 'Construção Civil e Infraestruturas');
$hero_bg_candidates = array(
    get_stylesheet_directory() . '/assets/images/servicos-hero-concrete.png',
    get_stylesheet_directory() . '/assets/images/servicos-hero-new.png',
);
$hero_bg_path = '';
$hero_bg_url = '';
foreach ($hero_bg_candidates as $hero_candidate_path) {
    if (file_exists($hero_candidate_path)) {
        $hero_bg_path = $hero_candidate_path;
        $hero_bg_url = get_stylesheet_directory_uri() . '/assets/images/' . basename($hero_candidate_path);
        $hero_bg_url .= '?v=' . (string) filemtime($hero_candidate_path);
        break;
    }
}
if ($hero_bg_url !== '') {
    $hero_bg_layers = 'linear-gradient(180deg, rgba(23,31,36,0.32) 0%, rgba(23,31,36,0.72) 100%), url(' . esc_url($hero_bg_url) . ')';
} else {
    $hero_bg_layers = 'linear-gradient(180deg, #2a5a82 0%, #171f24 100%)';
}

$about_title = pgroup_get_field_safe(
    'services_about_title',
    'Excelência e rigor em construção civil e obras públicas'
);
$about_points = array(
    pgroup_get_field_safe('services_about_point_1', 'Construção de raiz e reabilitações'),
    pgroup_get_field_safe('services_about_point_2', 'Rigor técnico e acompanhamento especializado'),
    pgroup_get_field_safe('services_about_point_3', 'Cumprimento de prazos'),
    pgroup_get_field_safe('services_about_point_4', 'Soluções seguras e sustentáveis'),
    pgroup_get_field_safe('services_about_point_5', 'Planeamento detalhado do início à entrega'),
);
$about_img_field = function_exists('get_field') ? get_field('services_about_image') : null;
$about_img_url = pgroup_resolve_acf_image_url($about_img_field, 'large');
if ($about_img_url === '') {
    $about_img_path = get_stylesheet_directory() . '/assets/images/servicos-sobre-obra.png';
    $about_img_url = get_stylesheet_directory_uri() . '/assets/images/servicos-sobre-obra.png';
    if (file_exists($about_img_path)) {
        $about_img_url .= '?v=' . (string) filemtime($about_img_path);
    }
}

$services_title = pgroup_get_field_safe('services_section_title', 'Áreas de Atuação');
$services_intro = pgroup_get_field_safe(
    'services_section_intro',
    'Reunimos empresas especializadas em vias de comunicação, construção, gestão e promoção imobiliária e gestão de recursos humanos.'
);
$services_link_label = pgroup_get_field_safe('services_section_link_label', 'Saber mais');
$services_link_url = pgroup_get_field_safe('services_section_link_url', pgroup_get_servicos_landing_url());
$services_count = (int) pgroup_get_field_safe('services_section_count', 3);
$services_count = $services_count > 0 ? $services_count : 3;
$process_title = pgroup_get_field_safe('services_process_title', 'Transparência, planeamento e rigor');
$process_text = pgroup_get_field_safe(
    'services_process_text',
    'Acreditamos que o sucesso de cada projeto nasce de um processo bem estruturado. Cada obra, cada cliente e cada detalhe são acompanhados com planeamento rigoroso, comunicação constante e compromisso total com a qualidade.'
);
$process_steps = array(
    array('title' => pgroup_get_field_safe('services_process_1_title', 'Análise e Planeamento'), 'icon' => 'search'),
    array('title' => pgroup_get_field_safe('services_process_2_title', 'Projeto e Orçamentação'), 'icon' => 'document'),
    array('title' => pgroup_get_field_safe('services_process_3_title', 'Execução e Acompanhamento'), 'icon' => 'tools'),
    array('title' => pgroup_get_field_safe('services_process_4_title', 'Entrega e Pós-Obra'), 'icon' => 'check'),
);
$contact_title = pgroup_get_field_safe('services_contact_title', 'Vamos trabalhar no seu projeto');
$contact_text = pgroup_get_field_safe('services_contact_text', 'Envie-nos o seu pedido.');
$testimonials_title = pgroup_get_field_safe('services_testimonials_title', 'O que dizem os nossos clientes');
$testimonials_text = pgroup_get_field_safe('services_testimonials_text', 'A confiança dos nossos clientes é o reflexo do nosso trabalho.');
$testimonials = array(
    pgroup_get_field_safe('services_testimonial_1', 'A PGroup cumpriu todos os prazos e excedeu as nossas expectativas. A equipa demonstrou grande profissionalismo em cada fase do projeto.'),
    pgroup_get_field_safe('services_testimonial_2', 'Profissionais de confiança, com experiência técnica sólida. Recomendo a PGroup para qualquer projeto de construção ou engenharia.'),
    pgroup_get_field_safe('services_testimonial_3', 'Desde o primeiro contacto até à entrega final, sentimos que cada detalhe foi tratado com atenção. Excelente parceiro para obras públicas.'),
);
$testimonials_title_markup = preg_replace('/(nossos clientes)/iu', '<span class="pgroup-testimonials-highlight">$1</span>', esc_html($testimonials_title), 1);
if (!is_string($testimonials_title_markup) || $testimonials_title_markup === '') {
    $testimonials_title_markup = esc_html($testimonials_title);
}
$blog_title = pgroup_get_field_safe('services_blog_title', 'O nosso blog - tendências e novidades');
$blog_link_label = pgroup_get_field_safe('services_blog_link_label', 'Saber mais');
$blog_link_url = pgroup_get_field_safe('services_blog_link_url', get_permalink(get_option('page_for_posts')) ?: home_url('/blog/'));
$newsletter_title = pgroup_get_field_safe('services_newsletter_title', 'Receba novidades da PGroup');
$newsletter_text = pgroup_get_field_safe('services_newsletter_text', 'Subscreva a nossa newsletter e fique a par de projetos, soluções e tendências em engenharia, construção e equipamentos industriais.');
$blog_items = array(
    array(
        'url' => $blog_link_url,
        'title' => 'Como escolher a Empresa de Engenharia e Construção ideal para o seu projeto',
        'date' => '5 de Abril',
        'img' => get_stylesheet_directory_uri() . '/assets/images/sobre-nos-blog-1.png',
    ),
    array(
        'url' => $blog_link_url,
        'title' => '5 Tendências em Construção e Obras Públicas para 2025',
        'date' => '5 de Abril',
        'img' => get_stylesheet_directory_uri() . '/assets/images/sobre-nos-blog-2.png',
    ),
    array(
        'url' => $blog_link_url,
        'title' => 'Como planeamos e executamos um Projeto na PGroup',
        'date' => '5 de Abril',
        'img' => get_stylesheet_directory_uri() . '/assets/images/sobre-nos-blog-3.png',
    ),
);
?>

<main id="primary" class="pgroup-services-page-main">
    <section
        class="pgroup-hero pgroup-services-hero"
        style="background-image: <?php echo esc_attr($hero_bg_layers); ?>; background-color: #171f24;"
        aria-label="<?php echo esc_attr($hero_title); ?>"
    >
        <div class="pgroup-services-hero-inner">
            <h1><?php echo esc_html($hero_title); ?></h1>
        </div>
    </section>

    <section id="pgroup-servicos-sobre" class="pgroup-section pgroup-services-about" aria-labelledby="pgroup-services-about-heading">
        <div class="pgroup-container pgroup-services-about-inner">
            <div class="pgroup-services-about-grid">
                <div class="pgroup-services-about-copy">
                    <h2 id="pgroup-services-about-heading"><?php echo esc_html($about_title); ?></h2>
                    <ul class="pgroup-services-about-list">
                        <?php foreach ($about_points as $point) : ?>
                            <?php
                            if (!is_string($point) || trim($point) === '') {
                                continue;
                            }
                            ?>
                            <li><?php echo esc_html($point); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="pgroup-services-about-media">
                    <?php if ($about_img_url !== '') : ?>
                        <img
                            src="<?php echo esc_url($about_img_url); ?>"
                            alt="<?php echo esc_attr(sprintf(__('Equipa em obra — %s', 'pgroup-child'), get_bloginfo('name'))); ?>"
                            width="560"
                            height="700"
                            loading="lazy"
                            decoding="async"
                        >
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="pgroup-servicos-areas" class="pgroup-section pgroup-services-areas">
        <div class="pgroup-container">
            <div class="pgroup-section-head">
                <div>
                    <h2><?php echo esc_html($services_title); ?></h2>
                    <?php if (!empty($services_intro)) : ?>
                        <p class="pgroup-section-intro"><?php echo esc_html($services_intro); ?></p>
                    <?php endif; ?>
                </div>
                <a class="pgroup-more-link" href="<?php echo esc_url($services_link_url); ?>">
                    <?php echo esc_html($services_link_label); ?>
                    <span aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
                            <path d="M4 7H10" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 5L10 7L8 9" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </a>
            </div>

            <div class="pgroup-grid pgroup-services-grid pgroup-services-grid--page">
                <?php
                $services = new WP_Query(array(
                    'post_type' => 'servico',
                    'posts_per_page' => $services_count,
                ));
                if ($services->have_posts()) :
                    $pgroup_service_icon_i = 0;
                    $pgroup_service_image_fallbacks = array(
                        get_stylesheet_directory_uri() . '/assets/images/service-card-1.png',
                        get_stylesheet_directory_uri() . '/assets/images/service-card-2.png',
                        get_stylesheet_directory_uri() . '/assets/images/service-card-3.png',
                        get_stylesheet_directory_uri() . '/assets/images/service-card-4.png',
                        get_stylesheet_directory_uri() . '/assets/images/service-card-5.png',
                    );
                    while ($services->have_posts()) :
                        $services->the_post();
                        $pgroup_icon_fallbacks = array('construcao', 'equipamentos', 'imobiliario');
                        $pgroup_icon_variant = '';
                        $pgroup_service_image_index = $pgroup_service_icon_i % count($pgroup_service_image_fallbacks);
                        $pgroup_service_fallback_image = $pgroup_service_image_fallbacks[$pgroup_service_image_index];
                        if (function_exists('get_field')) {
                            $pgroup_icon_variant = get_field('servico_icon_variant');
                        }
                        if (!is_string($pgroup_icon_variant) || $pgroup_icon_variant === '' || !in_array($pgroup_icon_variant, $pgroup_icon_fallbacks, true)) {
                            $pgroup_icon_variant = $pgroup_icon_fallbacks[$pgroup_service_icon_i % 3];
                        }
                        $pgroup_service_icon_i++;
                        ?>
                        <article <?php post_class('pgroup-card pgroup-service-card'); ?>>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large'); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url($pgroup_service_fallback_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" decoding="async">
                                <?php endif; ?>
                                <div class="pgroup-service-overlay">
                                    <?php pgroup_render_service_icon($pgroup_icon_variant); ?>
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo esc_html(pgroup_get_field_safe('servico_resumo', get_the_excerpt())); ?></p>
                                </div>
                            </a>
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

    <section id="pgroup-servicos-processo" class="pgroup-section pgroup-services-process">
        <div class="pgroup-container">
            <h2><?php echo esc_html($process_title); ?></h2>
            <p class="pgroup-services-process-intro"><?php echo esc_html($process_text); ?></p>
            <div class="pgroup-services-process-steps">
                <?php foreach ($process_steps as $step) : ?>
                    <article class="pgroup-services-process-step">
                        <span class="pgroup-services-process-icon" aria-hidden="true">
                            <?php if ($step['icon'] === 'search') : ?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="1.4"/><path d="M16 16L21 21" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                            <?php elseif ($step['icon'] === 'document') : ?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="5" y="3" width="14" height="18" rx="1.8" stroke="currentColor" stroke-width="1.4"/><path d="M8.5 8.5H15.5M8.5 12H15.5M8.5 15.5H13.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                            <?php elseif ($step['icon'] === 'tools') : ?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 6L18 10M5 19L10 14M11.5 12.5L19 5L20.5 6.5L13 14L11.5 12.5Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.5 6.5L10 10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                            <?php else : ?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 12.5L10 16.5L18.5 8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <?php endif; ?>
                        </span>
                        <h3><?php echo esc_html($step['title']); ?></h3>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="pgroup-servicos-contacto" class="pgroup-about-contact-section pgroup-services-contact-section">
        <div class="pgroup-container pgroup-contact-block">
            <div class="pgroup-about-contact-copy">
                <h2><?php echo esc_html($contact_title); ?></h2>
                <p><?php echo esc_html($contact_text); ?></p>
            </div>
            <div class="pgroup-contact-form">
                <form method="post" action="#" class="pgroup-contact-fallback-form" onsubmit="return false;">
                    <p>
                        <label for="pgroup-services-contact-name">Nome</label>
                        <input id="pgroup-services-contact-name" name="contact_name" type="text" autocomplete="name">
                    </p>
                    <p>
                        <label for="pgroup-services-contact-email">E-mail</label>
                        <input id="pgroup-services-contact-email" name="contact_email" type="email" autocomplete="email">
                    </p>
                    <p>
                        <label for="pgroup-services-contact-phone">Telemóvel</label>
                        <input id="pgroup-services-contact-phone" name="contact_phone" type="tel" autocomplete="tel">
                    </p>
                    <p>
                        <label for="pgroup-services-contact-message">Mensagem</label>
                        <textarea id="pgroup-services-contact-message" name="contact_message" rows="3"></textarea>
                    </p>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </section>

    <section class="pgroup-section pgroup-testimonials pgroup-testimonials-section pgroup-services-testimonials">
        <div class="pgroup-container">
            <h2 class="pgroup-center"><?php echo wp_kses($testimonials_title_markup, array('span' => array('class' => array()))); ?></h2>
            <p class="pgroup-center pgroup-testimonials-sub"><?php echo esc_html($testimonials_text); ?></p>
            <div class="pgroup-testimonials-grid">
                <?php foreach ($testimonials as $quote) : ?>
                    <article class="pgroup-testimonial-card">
                        <p><?php echo esc_html($quote); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="pgroup-section pgroup-blog-section pgroup-services-blog-section" aria-labelledby="pgroup-services-blog-heading">
        <div class="pgroup-container">
            <div class="pgroup-section-head pgroup-blog-section-head">
                <div>
                    <h2 id="pgroup-services-blog-heading"><?php echo esc_html($blog_title); ?></h2>
                </div>
                <a class="pgroup-more-link pgroup-blog-more-link" href="<?php echo esc_url($blog_link_url); ?>">
                    <?php echo esc_html($blog_link_label); ?>
                    <span class="pgroup-blog-more-link-icon" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
                            <path d="M4 7H10" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 5L10 7L8 9" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </a>
            </div>
            <div class="pgroup-blog-grid" role="list">
                <?php foreach ($blog_items as $bi => $blog_item) : ?>
                    <article class="pgroup-blog-card pgroup-blog-card--slot-<?php echo (int) $bi + 1; ?>" role="listitem">
                        <a class="pgroup-blog-card-link" href="<?php echo esc_url($blog_item['url']); ?>">
                            <img src="<?php echo esc_url($blog_item['img']); ?>" alt="<?php echo esc_attr(wp_strip_all_tags((string) $blog_item['title'])); ?>" loading="lazy" decoding="async">
                            <span class="pgroup-blog-card-body">
                                <span class="pgroup-blog-card-title"><?php echo esc_html($blog_item['title']); ?></span>
                                <span class="pgroup-blog-meta"><?php echo esc_html($blog_item['date']); ?></span>
                                <span class="pgroup-blog-card-cta">
                                    <?php esc_html_e('Ler mais', 'pgroup-child'); ?>
                                    <span class="pgroup-blog-card-cta-icon" aria-hidden="true">
                                        <svg width="11" height="11" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
                                            <path d="M4 7H10" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8 5L10 7L8 9" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </span>
                            </span>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="pgroup-newsletter pgroup-services-newsletter">
        <div class="pgroup-container pgroup-newsletter-inner">
            <div>
                <h3><?php echo esc_html($newsletter_title); ?></h3>
                <p><?php echo esc_html($newsletter_text); ?></p>
            </div>
            <div class="pgroup-newsletter-form">
                <form method="post" action="#" onsubmit="return false;">
                    <input type="email" placeholder="O seu e-mail" aria-label="O seu e-mail">
                    <button type="submit"><?php esc_html_e('Enviar', 'pgroup-child'); ?></button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
