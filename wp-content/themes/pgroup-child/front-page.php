<?php
/**
 * Front page template.
 *
 * @package PGroupChild
 */

get_header();

$hero_title = pgroup_get_field_safe('home_hero_title', 'Engenharia e Construção');
$hero_text = pgroup_get_field_safe('home_hero_text', 'Atuamos em diferentes areas, com equipas preparadas e integradas para responder as necessidades de cada cliente.');
$hero_image = pgroup_get_field_safe('home_hero_image', array());
$hero_cta_text = pgroup_get_field_safe('home_hero_cta_text', 'Saber mais');
$hero_cta_link = pgroup_get_field_safe('home_hero_cta_link', home_url('/contactos/'));

$about_title = pgroup_get_field_safe(
    'home_about_title',
    'História e experiência em engenharia e construção'
);
$about_text_default = "Da visão de um estucador tradicional, nasceu uma empresa que cresceu com base no trabalho, confiança e proximidade. O que começou com pequenos projetos locais, rapidamente ganhou escala e reconhecimento regional. Atualmente, a PGroup é sinónimo de solidez e credibilidade em todo o Alto Minho, mantendo o mesmo espírito familiar que esteve na origem de tudo.\n\nA nossa missão é transformar desafios em projetos concretos, entregando resultados que superam as expectativas dos nossos clientes e reforçam o nosso compromisso com o desenvolvimento sustentável da região.";
$about_text = pgroup_get_field_safe('home_about_text', $about_text_default);
$about_raw = function_exists('get_field') ? get_field('home_about_image') : null;
if ($about_raw === false) {
    $about_raw = null;
}

$about_image_url = pgroup_resolve_acf_image_url($about_raw, 'large');
$about_image_alt = __('Equipa PGroup', 'pgroup-child');
if (is_array($about_raw) && !empty($about_raw['alt'])) {
    $about_image_alt = $about_raw['alt'];
}

if ($about_image_url === '') {
    $about_fallback_rel = '/assets/images/team-about-default.png';
    $about_fallback_path = get_stylesheet_directory() . $about_fallback_rel;
    $about_image_url = get_stylesheet_directory_uri() . $about_fallback_rel;
    if (file_exists($about_fallback_path)) {
        $about_image_url .= '?v=' . rawurlencode((string) filemtime($about_fallback_path));
    }
}
$about_cta_text = pgroup_get_field_safe('home_about_cta_text', 'Saber mais');
$about_cta_link = pgroup_get_field_safe('home_about_cta_link', home_url('/sobre-nos/'));

$history_title = pgroup_get_field_safe('home_history_title', 'A nossa história');
$history_gallery = array();
if (function_exists('get_field')) {
    $hg = get_field('home_history_gallery');
    if (is_array($hg)) {
        $history_gallery = $hg;
    }
}
$history_steps_default = array(
    'Origem Familiar — início com o pai, estucador tradicional.',
    'Infraestruturas de gás natural e de águas residuais.',
    'Expansão na construção.',
    'Equipamentos e imobiliário.',
    'Hoje, um grupo sólido preparado para continuar a crescer.',
);
$history_steps = array();
if (function_exists('get_field')) {
    $hr = get_field('home_history_steps');
    if (is_array($hr)) {
        foreach ($hr as $row) {
            if (!empty($row['step_text'])) {
                $history_steps[] = trim($row['step_text']);
            }
        }
    }
}
if (empty($history_steps)) {
    $history_steps = $history_steps_default;
}

$history_timeline_positions = array('above', 'below', 'above', 'below', 'below');

$commitment_title = pgroup_get_field_safe('home_commitment_title', 'O nosso compromisso');
$commitment_text_default = 'Na PGroup construímos relações de confiança e resultados duradouros. Cada projeto é uma oportunidade para continuar a nossa história e reforçar o vínculo com quem deposita em nós a sua confiança.';
$commitment_text = pgroup_get_field_safe('home_commitment_text', $commitment_text_default);
$commitment_image = pgroup_get_field_safe('home_commitment_image', array());
$commitment_bg_url = !empty($commitment_image['url'])
    ? $commitment_image['url']
    : 'https://images.unsplash.com/photo-1497366216548-375260702974?auto=format&fit=crop&w=1920&q=80';

$future_title = pgroup_get_field_safe('home_future_title', 'Construímos o futuro');
$future_text_default = 'Com sede em Vila Verde e projetos em todo o Alto Minho, ligamos território, inovação e execução rigorosa — das grandes infraestruturas ao detalhe da remodelação.';
$future_text = pgroup_get_field_safe('home_future_text', $future_text_default);
$future_image = pgroup_get_field_safe('home_future_image', array());
$future_bg_url = !empty($future_image['url'])
    ? $future_image['url']
    : 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1920&q=80';

$services_title = pgroup_get_field_safe('home_services_title', 'Áreas de Atuação');
$services_intro = pgroup_get_field_safe(
    'home_services_intro',
    'Reunimos empresas especializadas em vias de comunicação, construção, gestão e promoção imobiliária e gestão de recursos humanos.'
);
$services_link_label = pgroup_get_field_safe('home_services_link_label', 'Saber mais');
$services_link_url = pgroup_get_field_safe('home_services_link_url', home_url('/servicos/'));
$services_count = (int) pgroup_get_field_safe('home_services_count', 3);
$projects_title = pgroup_get_field_safe('home_projects_title', 'Os nossos projetos');
$projects_intro = pgroup_get_field_safe('home_projects_intro', 'Descubra como transformamos desafios em soluções sólidas, desde obras públicas a pavilhões industriais.');
$projects_link_label = pgroup_get_field_safe('home_projects_link_label', 'Saber mais');
$projects_link_url = pgroup_get_field_safe('home_projects_link_url', home_url('/projetos/'));
$projects_count = (int) pgroup_get_field_safe('home_projects_count', 6);
$blog_title = pgroup_get_field_safe('home_blog_title', 'O nosso blog - tendencias e novidades');
$blog_link_label = pgroup_get_field_safe('home_blog_link_label', 'Saber mais');
$blog_link_url = pgroup_get_field_safe('home_blog_link_url', get_permalink(get_option('page_for_posts')) ?: home_url('/blog/'));
$why_title = pgroup_get_field_safe('home_why_title', 'Porquê escolher a PGroup?');
$why_title_markup = preg_replace('/(PGroup)/u', '<span class="pgroup-why-highlight">$1</span>', esc_html($why_title), 1);
if (!is_string($why_title_markup) || $why_title_markup === '') {
    $why_title_markup = esc_html($why_title);
}
$contact_title = pgroup_get_field_safe('home_contact_title', 'Vamos trabalhar no seu projeto');
$contact_text = pgroup_get_field_safe('home_contact_text', 'Envie-nos o seu pedido.');
$contact_form_shortcode = pgroup_get_field_safe('home_contact_form_shortcode', '');
$contact_name_label = pgroup_get_field_safe('home_contact_name_label', 'Nome');
$contact_email_label = pgroup_get_field_safe('home_contact_email_label', 'E-mail');
$contact_phone_label = pgroup_get_field_safe('home_contact_phone_label', 'Telemóvel');
$contact_message_label = pgroup_get_field_safe('home_contact_message_label', 'Mensagem');
$contact_submit_text = pgroup_get_field_safe('home_contact_submit_text', 'Enviar');
$testimonials_title = pgroup_get_field_safe('home_testimonials_title', 'O que dizem os nossos clientes');
$testimonials_text = pgroup_get_field_safe('home_testimonials_text', 'A confianca dos nossos clientes e o reflexo do nosso trabalho.');
$newsletter_title = pgroup_get_field_safe('home_newsletter_title', 'Receba novidades da PGroup');
$newsletter_text = pgroup_get_field_safe('home_newsletter_text', '');
$newsletter_shortcode = pgroup_get_field_safe('home_newsletter_shortcode', '');

$stats = array(
    array(
        'number' => pgroup_get_field_safe('home_stat_1_number', '+10'),
        'label' => pgroup_get_field_safe('home_stat_1_label', 'Anos de Experiência'),
    ),
    array(
        'number' => pgroup_get_field_safe('home_stat_2_number', '+20'),
        'label' => pgroup_get_field_safe('home_stat_2_label', 'Empreendimentos Construídos'),
    ),
    array(
        'number' => pgroup_get_field_safe('home_stat_3_number', '+100'),
        'label' => pgroup_get_field_safe('home_stat_3_label', 'Projetos Concluídos'),
    ),
    array(
        'number' => pgroup_get_field_safe('home_stat_4_number', '+500'),
        'label' => pgroup_get_field_safe('home_stat_4_label', 'Obras Públicas'),
    ),
);
$testimonials = array_filter(array(
    pgroup_get_field_safe('home_testimonial_1', ''),
    pgroup_get_field_safe('home_testimonial_2', ''),
    pgroup_get_field_safe('home_testimonial_3', ''),
));
$testimonials_title_markup = preg_replace('/(nossos clientes)/iu', '<span class="pgroup-testimonials-highlight">$1</span>', esc_html($testimonials_title), 1);
if (!is_string($testimonials_title_markup) || $testimonials_title_markup === '') {
    $testimonials_title_markup = esc_html($testimonials_title);
}

$hero_image_path = get_stylesheet_directory() . '/assets/images/hero-banner-figma.png';
$hero_image_url = get_stylesheet_directory_uri() . '/assets/images/hero-banner-figma.png';
if (!file_exists($hero_image_path)) {
    $hero_image_path = get_stylesheet_directory() . '/assets/images/hero-banner-default.png';
    $hero_image_url = get_stylesheet_directory_uri() . '/assets/images/hero-banner-default.png';
}
if (file_exists($hero_image_path)) {
    $hero_image_url .= '?v=' . (string) filemtime($hero_image_path);
}
$services_count = $services_count > 0 ? $services_count : 3;
$projects_count = $projects_count > 0 ? $projects_count : 6;
?>

<main id="primary" class="pgroup-home">
    <section class="pgroup-hero" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.3) 100%), url('<?php echo esc_url($hero_image_url); ?>');">
        <div class="pgroup-container pgroup-hero-inner">
            <h1><?php echo esc_html($hero_title); ?></h1>
            <p class="pgroup-hero-text"><?php echo esc_html($hero_text); ?></p>
            <a class="pgroup-button pgroup-button--hero" href="<?php echo esc_url($hero_cta_link); ?>">
                <span><?php echo esc_html($hero_cta_text); ?></span>
                <span class="pgroup-button-icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
                        <path d="M3 7h8M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>
    </section>

    <section class="pgroup-section pgroup-home-about-section">
        <div class="pgroup-container pgroup-about">
            <div class="pgroup-about-copy">
                <h2><?php echo esc_html($about_title); ?></h2>
                <div class="pgroup-about-text"><?php echo wp_kses_post(wpautop($about_text)); ?></div>
                <a class="pgroup-about-link" href="<?php echo esc_url($about_cta_link); ?>">
                    <span><?php echo esc_html($about_cta_text); ?></span>
                    <span class="pgroup-about-link-icon" aria-hidden="true">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
                            <path d="M4 7H10" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 5L10 7L8 9" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </a>
            </div>
            <div class="pgroup-about-image">
                <img src="<?php echo esc_url($about_image_url); ?>" alt="<?php echo esc_attr($about_image_alt); ?>" loading="lazy" decoding="async">
            </div>
        </div>
    </section>

    <section class="pgroup-section pgroup-why">
        <div class="pgroup-container">
            <h2 class="pgroup-center"><?php echo wp_kses($why_title_markup, array('span' => array('class' => array()))); ?></h2>
            <div class="pgroup-stats-grid">
                <?php foreach ($stats as $index => $stat) : ?>
                    <article class="pgroup-stat-card<?php echo ($index === 1 || $index === 3) ? ' is-gold' : ''; ?>">
                        <p class="pgroup-stat-number"><?php echo esc_html($stat['number']); ?></p>
                        <p class="pgroup-stat-label"><?php echo esc_html($stat['label']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="pgroup-section">
        <div class="pgroup-container">
            <div class="pgroup-section-head">
                <div>
                    <h2><?php echo esc_html($services_title); ?></h2>
                    <?php if (!empty($services_intro)) : ?>
                        <p class="pgroup-section-intro"><?php echo esc_html($services_intro); ?></p>
                    <?php endif; ?>
                </div>
                <a class="pgroup-more-link" href="<?php echo esc_url($services_link_url); ?>">
                    <?php echo esc_html($services_link_label); ?> <span aria-hidden="true">+</span>
                </a>
            </div>
            <div class="pgroup-grid pgroup-services-grid">
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

    <section class="pgroup-section">
        <div class="pgroup-container pgroup-projects-figma">
            <div class="pgroup-projects-figma-head">
                <div>
                    <h2><?php echo esc_html($projects_title); ?></h2>
                    <?php if (!empty($projects_intro)) : ?>
                        <p class="pgroup-section-intro"><?php echo esc_html($projects_intro); ?></p>
                    <?php endif; ?>
                </div>
                <div class="pgroup-projects-figma-arrows" aria-hidden="true">
                    <span>←</span>
                    <span>→</span>
                </div>
            </div>
            <div class="pgroup-projects-figma-list">
                <?php
                $pgroup_projects_cards = array(
                    array(
                        'title' => 'LOTEAMENTO DA PORTELA',
                        'text' => 'O Loteamento da Portela é um projeto residencial pensado para quem valoriza conforto, modernidade e bem-estar.',
                        'image' => get_stylesheet_directory_uri() . '/assets/images/project-card-2.png',
                        'link' => home_url('/?projeto=loteamento-da-portela'),
                    ),
                    array(
                        'title' => 'SANEAMENTO ATIÃES – VILA VERDE',
                        'text' => 'Desenvolvemos projetos de saneamento que garantem infraestruturas eficientes, sustentáveis e seguras.',
                        'image' => get_stylesheet_directory_uri() . '/assets/images/project-card-3.png',
                        'link' => home_url('/?projeto=saneamento-atiaes-vila-verde'),
                    ),
                    array(
                        'title' => 'SEDE DA ASSOCIAÇÃO DE BENEFICIÁRIOS DO REGADIO DO CÁVADO.',
                        'text' => 'Edifício funcional com identidade arquitetónica forte para gestão e operação do regadio.',
                        'image' => get_stylesheet_directory_uri() . '/assets/images/project-card-1.png',
                        'link' => home_url('/?projeto=sede-da-associacao-de-beneficiarios-do-regadio-do-cavado'),
                    ),
                );
                foreach ($pgroup_projects_cards as $pgroup_card) :
                    ?>
                    <article class="pgroup-card pgroup-project-card pgroup-project-card--figma">
                        <a href="<?php echo esc_url($pgroup_card['link']); ?>">
                            <img src="<?php echo esc_url($pgroup_card['image']); ?>" alt="<?php echo esc_attr($pgroup_card['title']); ?>" loading="lazy" decoding="async">
                            <div class="pgroup-project-overlay">
                                <h3><?php echo esc_html($pgroup_card['title']); ?></h3>
                                <p><?php echo esc_html($pgroup_card['text']); ?></p>
                                <span class="pgroup-project-link">
                                    <?php esc_html_e('Ver o Projeto', 'pgroup-child'); ?>
                                    <span aria-hidden="true">&rarr;</span>
                                </span>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="pgroup-section pgroup-contact-section">
        <div class="pgroup-container pgroup-contact-block">
            <div>
                <h2><?php echo esc_html($contact_title); ?></h2>
                <p><?php echo esc_html($contact_text); ?></p>
            </div>
            <div class="pgroup-contact-form">
                <?php if (!empty($contact_form_shortcode)) : ?>
                    <?php echo do_shortcode(wp_kses_post($contact_form_shortcode)); ?>
                <?php else : ?>
                    <form method="post" action="#" class="pgroup-contact-fallback-form" onsubmit="return false;">
                        <p>
                            <label for="pgroup-contact-name"><?php echo esc_html($contact_name_label); ?></label>
                            <input id="pgroup-contact-name" name="contact_name" type="text" autocomplete="name">
                        </p>
                        <p>
                            <label for="pgroup-contact-email"><?php echo esc_html($contact_email_label); ?></label>
                            <input id="pgroup-contact-email" name="contact_email" type="email" autocomplete="email">
                        </p>
                        <p>
                            <label for="pgroup-contact-phone"><?php echo esc_html($contact_phone_label); ?></label>
                            <input id="pgroup-contact-phone" name="contact_phone" type="tel" autocomplete="tel">
                        </p>
                        <p>
                            <label for="pgroup-contact-message"><?php echo esc_html($contact_message_label); ?></label>
                            <textarea id="pgroup-contact-message" name="contact_message" rows="2"></textarea>
                        </p>
                        <button type="submit"><?php echo esc_html($contact_submit_text); ?></button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="pgroup-section pgroup-testimonials pgroup-testimonials-section">
        <div class="pgroup-container">
            <h2 class="pgroup-center"><?php echo wp_kses($testimonials_title_markup, array('span' => array('class' => array()))); ?></h2>
            <p class="pgroup-center pgroup-testimonials-sub"><?php echo esc_html($testimonials_text); ?></p>
            <?php if (!empty($testimonials)) : ?>
                <div class="pgroup-testimonials-grid">
                    <?php foreach ($testimonials as $quote) : ?>
                        <article class="pgroup-testimonial-card">
                            <p><?php echo esc_html($quote); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="pgroup-section pgroup-blog-section">
        <div class="pgroup-container">
            <div class="pgroup-section-head">
                <div>
                    <h2><?php echo esc_html($blog_title); ?></h2>
                </div>
                <a class="pgroup-more-link" href="<?php echo esc_url($blog_link_url); ?>">
                    <?php echo esc_html($blog_link_label); ?> <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
            <div class="pgroup-grid pgroup-blog-grid">
                <?php
                $home_blog = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'ignore_sticky_posts' => true,
                ));
                $pgroup_blog_fallback_images = array(
                    get_stylesheet_directory_uri() . '/assets/images/blog-card-1.png',
                    get_stylesheet_directory_uri() . '/assets/images/blog-card-2.png',
                    get_stylesheet_directory_uri() . '/assets/images/blog-card-3.png',
                );
                $pgroup_blog_fallback_titles = array(
                    'Como escolher a empresa de construção certa',
                    '5 Tendências em Construção e Obras',
                    'Como planear o orçamento da sua obra',
                );
                $pgroup_blog_fallback_dates = array('10/04/2026', '05/04/2026', '29/03/2026');
                $pgroup_blog_i = 0;
                if ($home_blog->have_posts()) :
                    while ($home_blog->have_posts()) :
                        $home_blog->the_post();
                        $pgroup_blog_fallback_image = $pgroup_blog_fallback_images[$pgroup_blog_i % count($pgroup_blog_fallback_images)];
                        ?>
                        <article <?php post_class('pgroup-card pgroup-blog-card'); ?>>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large'); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url($pgroup_blog_fallback_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" decoding="async">
                                <?php endif; ?>
                                <h3><?php the_title(); ?></h3>
                                <p class="pgroup-blog-meta"><?php echo esc_html(get_the_date('d/m/Y')); ?></p>
                                <span class="pgroup-blog-more">
                                    <?php esc_html_e('Ler mais', 'pgroup-child'); ?> <span aria-hidden="true">&rarr;</span>
                                </span>
                            </a>
                        </article>
                        <?php
                        $pgroup_blog_i++;
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
                <?php for (; $pgroup_blog_i < 3; $pgroup_blog_i++) :
                    $pgroup_blog_fallback_image = $pgroup_blog_fallback_images[$pgroup_blog_i % count($pgroup_blog_fallback_images)];
                    $pgroup_blog_fallback_title = $pgroup_blog_fallback_titles[$pgroup_blog_i % count($pgroup_blog_fallback_titles)];
                    $pgroup_blog_fallback_date = $pgroup_blog_fallback_dates[$pgroup_blog_i % count($pgroup_blog_fallback_dates)];
                    ?>
                    <article class="pgroup-card pgroup-blog-card pgroup-blog-card--fallback">
                        <a href="<?php echo esc_url($blog_link_url); ?>">
                            <img src="<?php echo esc_url($pgroup_blog_fallback_image); ?>" alt="<?php echo esc_attr($pgroup_blog_fallback_title); ?>" loading="lazy" decoding="async">
                            <h3><?php echo esc_html($pgroup_blog_fallback_title); ?></h3>
                            <p class="pgroup-blog-meta"><?php echo esc_html($pgroup_blog_fallback_date); ?></p>
                            <span class="pgroup-blog-more">
                                <?php esc_html_e('Ler mais', 'pgroup-child'); ?> <span aria-hidden="true">&rarr;</span>
                            </span>
                        </a>
                    </article>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <section class="pgroup-newsletter">
        <div class="pgroup-container pgroup-newsletter-inner">
            <div>
                <h3><?php echo esc_html($newsletter_title); ?></h3>
                <p><?php echo esc_html($newsletter_text); ?></p>
            </div>
            <div class="pgroup-newsletter-form">
                <?php if (!empty($newsletter_shortcode)) : ?>
                    <?php echo do_shortcode(wp_kses_post($newsletter_shortcode)); ?>
                <?php else : ?>
                    <form method="post" action="#" onsubmit="return false;">
                        <input type="email" placeholder="O seu e-mail" aria-label="O seu e-mail">
                        <button type="submit"><?php esc_html_e('Enviar', 'pgroup-child'); ?></button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
