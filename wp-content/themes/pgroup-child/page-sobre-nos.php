<?php
/**
 * Template Name: Sobre Nós (Figma)
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

add_filter('body_class', function ($classes) {
    $classes[] = 'pgroup-overlay-about';
    return array_values(array_unique($classes));
});

get_header();

$hero_bg_url = get_stylesheet_directory_uri() . '/assets/images/sobre-nos-hero.png';

$hero_title = pgroup_get_field_safe('home_hero_title', 'Engenharia e construção que crescem com o tempo');
$hero_title_first = '';
$hero_title_second = '';
$hero_title_second_prefix = '';
$hero_title_second_tempo = '';

// Match Figma: split headline into explicit runs so wrapping is deterministic.
// Expected: "Engenharia e construção" + "que crescem com o tempo"
$split_pos = mb_stripos((string) $hero_title, 'que crescem');
if ($split_pos !== false) {
    $hero_title_first = trim(mb_substr((string) $hero_title, 0, $split_pos));
    $hero_title_second = trim(mb_substr((string) $hero_title, $split_pos));
} else {
    $hero_title_first = trim((string) $hero_title);
    $hero_title_second = '';
}

// In Figma, "tempo" is a separate run in the 2nd line.
if ($hero_title_second !== '') {
    if (preg_match('/^(.*?)(tempo)\\s*$/iu', $hero_title_second, $m)) {
        $hero_title_second_prefix = trim($m[1]);
        $hero_title_second_tempo = trim($m[2]);
    } else {
        $hero_title_second_prefix = $hero_title_second;
        $hero_title_second_tempo = '';
    }
}

$hero_text = pgroup_get_field_safe(
    'home_hero_text',
    'Construir com qualidade, inovar com propósito e servir com integridade.'
);

$hero_eyebrow = '';

$about_title = pgroup_get_field_safe(
    'home_about_title',
    'História e experiência em engenharia e construção'
);
$about_text_default = "Da visão de um estucador tradicional, nasceu uma empresa que cresceu com base no trabalho, confiança e proximidade. O que começou com pequenos projetos locais, rapidamente ganhou escala e reconhecimento regional. Atualmente, a PGroup é sinónimo de solidez e credibilidade em todo o Alto Minho, mantendo o mesmo espírito familiar que esteve na origem de tudo.\n\nA nossa missão é transformar desafios em projetos concretos, entregando resultados que superam as expectativas dos nossos clientes e reforçam o nosso compromisso com o desenvolvimento sustentável da região.";
$about_text = pgroup_get_field_safe('home_about_text', $about_text_default);

$about_image_url = get_stylesheet_directory_uri() . '/assets/images/sobre-nos-about.png';
$about_image_alt = __('Equipa PGroup', 'pgroup-child');
$about_cta_text = pgroup_get_field_safe('home_about_cta_text', 'Saber mais');
$about_cta_link = pgroup_get_field_safe('home_about_cta_link', home_url('/sobre-nos/'));

$history_title = pgroup_get_field_safe('home_history_title', 'A nossa história');
$commitment_title = pgroup_get_field_safe('home_commitment_title', 'O nosso compromisso');
$commitment_text = pgroup_get_field_safe(
    'home_commitment_text',
    'Na PGroup, construimos relacoes de confianca e resultados duradouros. Cada projeto e uma oportunidade para continuar a nossa historia com orgulho nas nossas origens e olhar para o futuro com ambicao e responsabilidade.'
);
$commitment_bg_url = get_stylesheet_directory_uri() . '/assets/images/sobre-nos-compromisso.png';
$contact_title = pgroup_get_field_safe('home_contact_title', 'Vamos trabalhar no seu projeto');
$contact_text = pgroup_get_field_safe('home_contact_text', 'Envie-nos o seu pedido.');
$testimonials_title = pgroup_get_field_safe('home_testimonials_title', 'O que dizem os nossos clientes');
$testimonials_text = pgroup_get_field_safe('home_testimonials_text', 'A confiança dos nossos clientes é o reflexo do nosso trabalho.');
$testimonials_title_markup = preg_replace('/(nossos clientes)/iu', '<span class="pgroup-testimonials-highlight">$1</span>', esc_html($testimonials_title), 1);
if (!is_string($testimonials_title_markup) || $testimonials_title_markup === '') {
    $testimonials_title_markup = esc_html($testimonials_title);
}
$testimonials = array_filter(array(
    pgroup_get_field_safe('home_testimonial_1', ''),
    pgroup_get_field_safe('home_testimonial_2', ''),
    pgroup_get_field_safe('home_testimonial_3', ''),
));
if (count($testimonials) < 3) {
    $testimonials = array(
        'A PGroup cumpriu todos os prazos e excedeu as nossas expectativas. A equipa demonstrou grande profissionalismo em cada fase da obra.',
        'Profissionais de confiança, com experiência técnica sólida. Recomendo a PGroup para qualquer projeto de construção ou engenharia.',
        'Desde o primeiro contacto até à entrega final, sentimos que cada detalhe foi tratado com atenção. Excelente parceiro para obra pública.',
    );
}

$blog_title = pgroup_get_field_safe('home_blog_title', 'O nosso blog - tendências e novidades');
$blog_link_label = pgroup_get_field_safe('home_blog_link_label', 'Saber mais');
$blog_link_url = pgroup_get_field_safe('home_blog_link_url', get_permalink(get_option('page_for_posts')) ?: home_url('/blog/'));
$newsletter_title = 'Receba novidades da PGroup';
$blog_items = array(
    array(
        'url' => $blog_link_url,
        'title' => 'Como escolher a Empresa de Engenharia e Construção ideal para o seu projeto',
        'date' => '5 de Abril',
        'img' => get_stylesheet_directory_uri() . '/assets/images/sobre-nos-blog-1.png',
    ),
    array(
        'url' => $blog_link_url,
        'title' => 'A importância das obras de infraestrutura para o futuro',
        'date' => '5 de Abril',
        'img' => get_stylesheet_directory_uri() . '/assets/images/sobre-nos-blog-2.png',
    ),
    array(
        'url' => $blog_link_url,
        'title' => 'Como planeamos e executamos um Projeto de Engenharia de raiz',
        'date' => '5 de Abril',
        'img' => get_stylesheet_directory_uri() . '/assets/images/sobre-nos-blog-3.png',
    ),
);

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
                $history_steps[] = trim((string) $row['step_text']);
            }
        }
    }
}
if (empty($history_steps)) {
    $history_steps = $history_steps_default;
}

$history_timeline_positions = array('above', 'below', 'above', 'below', 'below');

$gallery_imgs = array(
    get_stylesheet_directory_uri() . '/assets/images/sobre-nos-history-2.png',
    get_stylesheet_directory_uri() . '/assets/images/sobre-nos-history-1.png',
    get_stylesheet_directory_uri() . '/assets/images/sobre-nos-history-3.png',
);
?>

<main id="primary" class="pgroup-about-page">
    <section
        class="pgroup-hero pgroup-about-hero"
        style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.3) 100%), url('<?php echo esc_url($hero_bg_url); ?>');"
        aria-label="<?php echo esc_attr($hero_title); ?>"
    >
        <div class="pgroup-hero-inner">
            <?php if (!empty($hero_eyebrow)) : ?>
                <p class="pgroup-eyebrow" aria-label="<?php echo esc_attr($hero_eyebrow); ?>">
                    <span class="pgroup-eyebrow-line">NG Haria</span>
                    <span class="pgroup-eyebrow-line">Construction</span>
                </p>
            <?php endif; ?>
            <h1 class="pgroup-hero-title" aria-label="<?php echo esc_attr($hero_title); ?>">
                <?php if ($hero_title_first !== '') : ?>
                    <span class="pgroup-hero-title-line"><?php echo esc_html($hero_title_first); ?></span>
                <?php endif; ?>
                <?php if ($hero_title_second !== '') : ?>
                    <span class="pgroup-hero-title-line">
                        <?php if ($hero_title_second_tempo !== '') : ?>
                            <?php echo esc_html($hero_title_second_prefix); ?>
                            <span class="pgroup-hero-title-tempo"><?php echo esc_html($hero_title_second_tempo); ?></span>
                        <?php else : ?>
                            <?php echo esc_html($hero_title_second_prefix); ?>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </h1>
            <p class="pgroup-hero-text"><?php echo esc_html($hero_text); ?></p>
        </div>
    </section>

    <section class="pgroup-sobre-nos-about-section">
        <div class="pgroup-container">
            <div class="pgroup-about">
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
        </div>
    </section>

    <section class="pgroup-history" aria-label="<?php echo esc_attr($history_title); ?>">
        <div class="pgroup-container">
            <div class="pgroup-history-gallery-strip">
                <div class="pgroup-history-gallery" role="list">
                    <?php foreach ($gallery_imgs as $img_url) : ?>
                        <figure class="pgroup-history-gallery-item" role="listitem">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($history_title); ?>" loading="lazy" decoding="async">
                        </figure>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="pgroup-history-panel">
                <h2 class="pgroup-history-title"><?php echo esc_html($history_title); ?></h2>

                <ol class="pgroup-timeline" aria-label="Timeline">
                    <?php foreach ($history_steps as $i => $step_text) : ?>
                        <?php
                        $pos = $history_timeline_positions[$i] ?? 'below';
                        $step_class = 'pgroup-timeline-step' . ($pos === 'above' ? ' pgroup-timeline-step--label-above' : '');
                        ?>
                        <li class="<?php echo esc_attr($step_class); ?>">
                            <span class="pgroup-timeline-dot" aria-hidden="true"></span>
                            <p><?php echo esc_html($step_text); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </section>

    <section
        class="pgroup-visual-band pgroup-commitment"
        style="background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.44) 0%, rgba(0, 0, 0, 0.2) 42%, rgba(0, 0, 0, 0) 72%), url('<?php echo esc_url($commitment_bg_url); ?>');"
        aria-label="<?php echo esc_attr($commitment_title); ?>"
    >
        <div class="pgroup-container pgroup-visual-band-inner pgroup-commitment-inner">
            <h2><?php echo esc_html($commitment_title); ?></h2>
            <div class="pgroup-visual-band-text">
                <?php echo wp_kses_post(wpautop($commitment_text)); ?>
            </div>
        </div>
    </section>

    <section class="pgroup-about-contact-section">
        <div class="pgroup-container pgroup-contact-block">
            <div class="pgroup-about-contact-copy">
                <h2><?php echo esc_html($contact_title); ?></h2>
                <p><?php echo esc_html($contact_text); ?></p>
            </div>
            <div class="pgroup-contact-form">
                <form method="post" action="#" class="pgroup-contact-fallback-form" onsubmit="return false;">
                    <p>
                        <label for="pgroup-about-contact-name">Nome</label>
                        <input id="pgroup-about-contact-name" name="contact_name" type="text" autocomplete="name">
                    </p>
                    <p>
                        <label for="pgroup-about-contact-email">E-mail</label>
                        <input id="pgroup-about-contact-email" name="contact_email" type="email" autocomplete="email">
                    </p>
                    <p>
                        <label for="pgroup-about-contact-phone">Telemovel</label>
                        <input id="pgroup-about-contact-phone" name="contact_phone" type="tel" autocomplete="tel">
                    </p>
                    <p>
                        <label for="pgroup-about-contact-message">Mensagem</label>
                        <textarea id="pgroup-about-contact-message" name="contact_message" rows="3"></textarea>
                    </p>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </section>

    <section class="pgroup-section pgroup-testimonials pgroup-testimonials-section">
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

    <section class="pgroup-section pgroup-blog-section" aria-labelledby="pgroup-about-blog-heading">
        <div class="pgroup-container">
            <div class="pgroup-section-head pgroup-blog-section-head">
                <div>
                    <h2 id="pgroup-about-blog-heading"><?php echo esc_html($blog_title); ?></h2>
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

    <section class="pgroup-newsletter">
        <div class="pgroup-container pgroup-newsletter-inner">
            <div>
                <h3><?php echo esc_html($newsletter_title); ?></h3>
                <p>Subscreva a nossa newsletter e fique a par de projetos, solucoes e tendencias em engenharia, construcao e equipamentos industriais.</p>
            </div>
            <div class="pgroup-newsletter-form">
                <form method="post" action="#" onsubmit="return false;">
                    <input type="email" placeholder="Seu e-mail" aria-label="Seu e-mail">
                    <button type="submit"><?php esc_html_e('Enviar', 'pgroup-child'); ?></button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();

