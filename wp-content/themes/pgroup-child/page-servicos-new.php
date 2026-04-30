<?php
/**
 * Template Name: Serviços Novo (Primeira Seção)
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

add_filter('body_class', function ($classes) {
    $classes[] = 'pgroup-overlay-about';
    $classes[] = 'pgroup-servicos-new-page';
    return array_values(array_unique($classes));
});

get_header();

$hero_title = pgroup_get_field_safe('services_new_hero_title', 'Construção Civil e Infraestruturas');
$hero_bg_candidates = array(
    get_stylesheet_directory() . '/assets/images/servico-construcao-hero-v2.png',
    get_stylesheet_directory() . '/assets/images/service-construction-hero.png',
    get_stylesheet_directory() . '/assets/images/servicos-hero-concrete.png',
    get_stylesheet_directory() . '/assets/images/five.png',
);
$hero_bg_url = '';
foreach ($hero_bg_candidates as $hero_bg_candidate) {
    if (file_exists($hero_bg_candidate)) {
        $hero_bg_url = get_stylesheet_directory_uri() . '/assets/images/' . basename($hero_bg_candidate);
        $hero_bg_url .= '?v=' . (string) filemtime($hero_bg_candidate);
        break;
    }
}
$hero_bg_layers = $hero_bg_url !== ''
    ? 'linear-gradient(180deg, rgba(23,31,36,0.34) 0%, rgba(23,31,36,0.74) 100%), url(' . esc_url($hero_bg_url) . ')'
    : 'linear-gradient(180deg, #2a5a82 0%, #171f24 100%)';

$about_title = pgroup_get_field_safe('services_new_about_title', 'Excelência e rigor em construção civil e obras públicas');
$about_points = array(
    pgroup_get_field_safe('services_new_about_point_1', 'Construção de raiz e reabilitações'),
    pgroup_get_field_safe('services_new_about_point_2', 'Rigor técnico e acompanhamento especializado'),
    pgroup_get_field_safe('services_new_about_point_3', 'Cumprimento de prazos'),
    pgroup_get_field_safe('services_new_about_point_4', 'Soluções seguras e sustentáveis'),
    pgroup_get_field_safe('services_new_about_point_5', 'Planeamento detalhado do início à entrega'),
);
$about_img_path = get_stylesheet_directory() . '/assets/images/servicos-sobre-obra.png';
$about_img_url = get_stylesheet_directory_uri() . '/assets/images/servicos-sobre-obra.png';
if (file_exists($about_img_path)) {
    $about_img_url .= '?v=' . (string) filemtime($about_img_path);
}

$contact_title = pgroup_get_field_safe('services_new_contact_title', 'Vamos trabalhar no seu projeto');
$contact_text = pgroup_get_field_safe('services_new_contact_text', 'Envie-nos o seu pedido.');
$testimonials_title = pgroup_get_field_safe('services_new_testimonials_title', 'O que dizem os nossos clientes');
$testimonials_text = pgroup_get_field_safe('services_new_testimonials_text', 'A confiança dos nossos clientes é o reflexo do nosso trabalho.');
$testimonials = array(
    pgroup_get_field_safe('services_new_testimonial_1', 'A PGroup cumpriu todos os prazos e excedeu as nossas expectativas. A equipa demonstrou grande profissionalismo em cada fase do projeto.'),
    pgroup_get_field_safe('services_new_testimonial_2', 'Profissionais de confiança, com experiência técnica sólida. Recomendo a PGroup para qualquer projeto de construção ou engenharia.'),
    pgroup_get_field_safe('services_new_testimonial_3', 'Desde o primeiro contacto até à entrega final, sentimos que cada detalhe foi tratado com atenção. Excelente parceiro para obras públicas.'),
);
$testimonials_title_markup = preg_replace('/(nossos clientes)/iu', '<span class="pgroup-testimonials-highlight">$1</span>', esc_html($testimonials_title), 1);
if (!is_string($testimonials_title_markup) || $testimonials_title_markup === '') {
    $testimonials_title_markup = esc_html($testimonials_title);
}

$blog_title = pgroup_get_field_safe('services_new_blog_title', 'O nosso blog - tendências e novidades');
$blog_link_label = pgroup_get_field_safe('services_new_blog_link_label', 'Saber mais');
$blog_link_url = pgroup_get_field_safe('services_new_blog_link_url', get_permalink(get_option('page_for_posts')) ?: home_url('/blog/'));
$newsletter_title = pgroup_get_field_safe('services_new_newsletter_title', 'Receba novidades da PGroup');
$newsletter_text = pgroup_get_field_safe('services_new_newsletter_text', 'Subscreva a nossa newsletter e fique a par de projetos, soluções e tendências em engenharia, construção e equipamentos industriais.');
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

    <section class="pgroup-contact-section pgroup-servicos-new-contact">
        <div class="pgroup-container">
            <div class="pgroup-contact-block">
                <div class="pgroup-about-contact-copy">
                    <h2><?php echo esc_html($contact_title); ?></h2>
                    <p><?php echo esc_html($contact_text); ?></p>
                </div>
                <div class="pgroup-contact-form">
                    <form method="post" action="#" class="pgroup-contact-fallback-form" onsubmit="return false;">
                        <p>
                            <label for="pgroup-new-contact-name"><?php esc_html_e('Nome', 'pgroup-child'); ?></label>
                            <input id="pgroup-new-contact-name" name="contact_name" type="text" autocomplete="name">
                        </p>
                        <p>
                            <label for="pgroup-new-contact-email"><?php esc_html_e('E-mail', 'pgroup-child'); ?></label>
                            <input id="pgroup-new-contact-email" name="contact_email" type="email" autocomplete="email">
                        </p>
                        <p>
                            <label for="pgroup-new-contact-phone"><?php esc_html_e('Telemóvel', 'pgroup-child'); ?></label>
                            <input id="pgroup-new-contact-phone" name="contact_phone" type="tel" autocomplete="tel">
                        </p>
                        <p>
                            <label for="pgroup-new-contact-message"><?php esc_html_e('Mensagem', 'pgroup-child'); ?></label>
                            <textarea id="pgroup-new-contact-message" name="contact_message" rows="3"></textarea>
                        </p>
                        <button type="submit"><?php esc_html_e('Enviar', 'pgroup-child'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="pgroup-section pgroup-testimonials pgroup-testimonials-section pgroup-services-testimonials pgroup-servicos-new-testimonials">
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

    <section class="pgroup-section pgroup-blog-section pgroup-services-blog-section pgroup-servicos-new-blog" aria-labelledby="pgroup-servicos-new-blog-heading">
        <div class="pgroup-container">
            <div class="pgroup-section-head pgroup-blog-section-head">
                <div>
                    <h2 id="pgroup-servicos-new-blog-heading"><?php echo esc_html($blog_title); ?></h2>
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

    <section class="pgroup-newsletter pgroup-services-newsletter pgroup-servicos-new-newsletter">
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
