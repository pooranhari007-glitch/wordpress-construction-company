<?php
/**
 * Front page template.
 *
 * @package PGroupChild
 */

get_header();

$hero_title = pgroup_get_field_safe('home_hero_title', 'Engenharia e Construcao');
$hero_text = pgroup_get_field_safe('home_hero_text', 'Atuamos em diferentes areas com equipas preparadas para responder as necessidades de cada cliente.');
$hero_image = pgroup_get_field_safe('home_hero_image', array());
$hero_cta_text = pgroup_get_field_safe('home_hero_cta_text', 'Fale connosco');
$hero_cta_link = pgroup_get_field_safe('home_hero_cta_link', home_url('/contactos/'));

$about_title = pgroup_get_field_safe('home_about_title', 'O nosso maior compromisso');
$about_text = pgroup_get_field_safe('home_about_text', 'Trabalhamos com foco em qualidade, rigor e cumprimento de prazos para entregar valor real em cada projeto.');
$about_image = pgroup_get_field_safe('home_about_image', array());

$services_title = pgroup_get_field_safe('home_services_title', 'Servicos');
$services_intro = pgroup_get_field_safe('home_services_intro', '');
$services_link_label = pgroup_get_field_safe('home_services_link_label', 'Saber mais');
$services_link_url = pgroup_get_field_safe('home_services_link_url', home_url('/servicos/'));
$services_count = (int) pgroup_get_field_safe('home_services_count', 6);
$projects_title = pgroup_get_field_safe('home_projects_title', 'Projetos');
$projects_intro = pgroup_get_field_safe('home_projects_intro', '');
$projects_link_label = pgroup_get_field_safe('home_projects_link_label', 'Saber mais');
$projects_link_url = pgroup_get_field_safe('home_projects_link_url', home_url('/projetos/'));
$projects_count = (int) pgroup_get_field_safe('home_projects_count', 6);
$blog_title = pgroup_get_field_safe('home_blog_title', 'Blog');
$blog_link_label = pgroup_get_field_safe('home_blog_link_label', 'Saber mais');
$blog_link_url = pgroup_get_field_safe('home_blog_link_url', home_url('/blog/'));
$why_title = pgroup_get_field_safe('home_why_title', 'Porque escolher a PGroup?');
$contact_title = pgroup_get_field_safe('home_contact_title', 'Vamos trabalhar no seu projeto');
$contact_text = pgroup_get_field_safe('home_contact_text', 'Envie-nos o seu pedido.');
$contact_form_shortcode = pgroup_get_field_safe('home_contact_form_shortcode', '');
$testimonials_title = pgroup_get_field_safe('home_testimonials_title', 'O que dizem os nossos clientes');
$testimonials_text = pgroup_get_field_safe('home_testimonials_text', 'A confianca dos nossos clientes e o reflexo do nosso trabalho.');
$newsletter_title = pgroup_get_field_safe('home_newsletter_title', 'Receba novidades da PGroup');
$newsletter_text = pgroup_get_field_safe('home_newsletter_text', '');
$newsletter_shortcode = pgroup_get_field_safe('home_newsletter_shortcode', '');

$stats = array(
    array(
        'number' => pgroup_get_field_safe('home_stat_1_number', '+10'),
        'label' => pgroup_get_field_safe('home_stat_1_label', 'Anos de experiencia'),
    ),
    array(
        'number' => pgroup_get_field_safe('home_stat_2_number', '+200'),
        'label' => pgroup_get_field_safe('home_stat_2_label', 'Empreendimentos'),
    ),
    array(
        'number' => pgroup_get_field_safe('home_stat_3_number', '+100'),
        'label' => pgroup_get_field_safe('home_stat_3_label', 'Projetos concluidos'),
    ),
    array(
        'number' => pgroup_get_field_safe('home_stat_4_number', '+500'),
        'label' => pgroup_get_field_safe('home_stat_4_label', 'Obras publicas'),
    ),
);
$testimonials = array_filter(array(
    pgroup_get_field_safe('home_testimonial_1', ''),
    pgroup_get_field_safe('home_testimonial_2', ''),
    pgroup_get_field_safe('home_testimonial_3', ''),
));

$hero_image_url = !empty($hero_image['url']) ? $hero_image['url'] : 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1920&q=80';
$services_count = $services_count > 0 ? $services_count : 6;
$projects_count = $projects_count > 0 ? $projects_count : 6;
?>

<main class="pgroup-home">
    <section class="pgroup-hero" style="background-image: linear-gradient(120deg, rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.2)), url('<?php echo esc_url($hero_image_url); ?>');">
        <div class="pgroup-container pgroup-hero-inner">
            <p class="pgroup-eyebrow"><?php esc_html_e('PGroup', 'pgroup-child'); ?></p>
            <h1><?php echo esc_html($hero_title); ?></h1>
            <p class="pgroup-hero-text"><?php echo esc_html($hero_text); ?></p>
            <a class="pgroup-button" href="<?php echo esc_url($hero_cta_link); ?>">
                <?php echo esc_html($hero_cta_text); ?>
            </a>
        </div>
    </section>

    <section class="pgroup-section">
        <div class="pgroup-container pgroup-about">
            <div>
                <h2><?php echo esc_html($about_title); ?></h2>
                <p class="pgroup-about-text"><?php echo esc_html($about_text); ?></p>
            </div>
            <?php if (!empty($about_image['url'])) : ?>
                <div class="pgroup-about-image">
                    <img src="<?php echo esc_url($about_image['sizes']['large'] ?? $about_image['url']); ?>" alt="<?php echo esc_attr($about_image['alt'] ?? 'Sobre nos'); ?>">
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="pgroup-section pgroup-why">
        <div class="pgroup-container">
            <h2 class="pgroup-center"><?php echo esc_html($why_title); ?></h2>
            <div class="pgroup-stats-grid">
                <?php foreach ($stats as $index => $stat) : ?>
                    <article class="pgroup-stat-card<?php echo $index === 1 ? ' is-gold' : ''; ?>">
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
                    while ($services->have_posts()) :
                        $services->the_post();
                        ?>
                        <article <?php post_class('pgroup-card pgroup-service-card'); ?>>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); endif; ?>
                                <div class="pgroup-service-overlay">
                                    <span class="pgroup-service-icon" aria-hidden="true">+</span>
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

    <section class="pgroup-section pgroup-section-alt">
        <div class="pgroup-container">
            <div class="pgroup-section-head">
                <div>
                    <h2><?php echo esc_html($projects_title); ?></h2>
                    <?php if (!empty($projects_intro)) : ?>
                        <p class="pgroup-section-intro"><?php echo esc_html($projects_intro); ?></p>
                    <?php endif; ?>
                </div>
                <a class="pgroup-more-link" href="<?php echo esc_url($projects_link_url); ?>">
                    <?php echo esc_html($projects_link_label); ?> <span aria-hidden="true">+</span>
                </a>
            </div>
            <div class="pgroup-grid pgroup-projects-grid">
                <?php
                $projects = new WP_Query(array(
                    'post_type' => 'projeto',
                    'posts_per_page' => $projects_count,
                ));
                if ($projects->have_posts()) :
                    while ($projects->have_posts()) :
                        $projects->the_post();
                        ?>
                        <article <?php post_class('pgroup-card pgroup-project-card'); ?>>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); endif; ?>
                                <div class="pgroup-project-overlay">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo esc_html(pgroup_get_field_safe('projeto_cliente', get_the_excerpt())); ?></p>
                                    <span class="pgroup-project-link">
                                        <?php esc_html_e('Ver o Projeto', 'pgroup-child'); ?>
                                        <span aria-hidden="true">+</span>
                                    </span>
                                </div>
                            </a>
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
            <div class="pgroup-section-head">
                <h2><?php echo esc_html($blog_title); ?></h2>
                <a class="pgroup-more-link" href="<?php echo esc_url($blog_link_url); ?>">
                    <?php echo esc_html($blog_link_label); ?> <span aria-hidden="true">+</span>
                </a>
            </div>
            <div class="pgroup-grid pgroup-blog-grid">
                <?php
                $posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                ));
                if ($posts->have_posts()) :
                    while ($posts->have_posts()) :
                        $posts->the_post();
                        ?>
                        <article <?php post_class('pgroup-blog-card'); ?>>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); endif; ?>
                                <h3><?php the_title(); ?></h3>
                            </a>
                            <p class="pgroup-blog-meta"><?php echo esc_html(get_the_date('j \d\e M, Y')); ?></p>
                            <a class="pgroup-blog-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Ler mais', 'pgroup-child'); ?> <span aria-hidden="true">+</span></a>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <section class="pgroup-section">
        <div class="pgroup-container pgroup-contact-block">
            <div>
                <h2><?php echo esc_html($contact_title); ?></h2>
                <p><?php echo esc_html($contact_text); ?></p>
            </div>
            <div class="pgroup-contact-form">
                <?php if (!empty($contact_form_shortcode)) : ?>
                    <?php echo do_shortcode(wp_kses_post($contact_form_shortcode)); ?>
                <?php else : ?>
                    <p><?php esc_html_e('Adicione o shortcode do formulario na homepage.', 'pgroup-child'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="pgroup-section pgroup-testimonials">
        <div class="pgroup-container">
            <h2 class="pgroup-center"><?php echo esc_html($testimonials_title); ?></h2>
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
