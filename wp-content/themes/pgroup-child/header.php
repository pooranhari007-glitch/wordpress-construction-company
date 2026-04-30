<?php
/**
 * Site header — homepage: nav | centered logo | CTA; inner pages: logo left | nav | CTA.
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

$contact_url = apply_filters(
    'pgroup_header_contact_url',
    home_url('/contactos/')
);
$servicos_new_page_url = home_url('/?pg_servicos=1');
$header_logo_candidates = array(
    '/assets/images/header-logo-pgroup.png',
    '/assets/images/footer-logo-pgroup.png',
);
$header_logo_path = '';
$header_logo_uri = '';
foreach ($header_logo_candidates as $header_logo_rel) {
    $candidate_path = get_stylesheet_directory() . $header_logo_rel;
    if (file_exists($candidate_path)) {
        $header_logo_path = $candidate_path;
        $header_logo_uri = get_stylesheet_directory_uri() . $header_logo_rel;
        $header_logo_uri .= '?v=' . (string) filemtime($candidate_path);
        break;
    }
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="pgroup-skip-link" href="#primary"><?php esc_html_e('Saltar para o conteudo', 'pgroup-child'); ?></a>

<header class="pgroup-site-header" role="banner">
    <div class="pgroup-container pgroup-header-inner">
        <div class="pgroup-header-brand">
            <?php if (has_custom_logo()) : ?>
                <span class="pgroup-header-logo-custom"><?php the_custom_logo(); ?></span>
            <?php elseif ($header_logo_path !== '') : ?>
                <a class="pgroup-header-logo-image" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    <img src="<?php echo esc_url($header_logo_uri); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                </a>
            <?php else : ?>
                <a class="pgroup-header-logo-text" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    <span class="pgroup-logo-mark"><?php echo esc_html_x('P', 'Logo initial', 'pgroup-child'); ?></span>
                    <span class="pgroup-logo-word"><?php echo esc_html_x('GROUP', 'Logo wordmark', 'pgroup-child'); ?></span>
                </a>
            <?php endif; ?>
        </div>

        <?php
        $pg_id = (int) get_queried_object_id();
        $current_template = $pg_id ? (string) get_page_template_slug($pg_id) : '';
        $request_path = isset($_SERVER['REQUEST_URI']) ? (string) wp_parse_url(wp_unslash($_SERVER['REQUEST_URI']), PHP_URL_PATH) : '';
        $request_path = trim($request_path, '/');
        $is_sobre_nos = $pg_id === 8
            || ($current_template && basename($current_template) === 'page-sobre-nos.php')
            || is_page('sobre-nos');
        $is_servicos_query = isset($_GET['pg_servicos']) && (string) $_GET['pg_servicos'] === '1';
        $is_new_page_query = isset($_GET['pg_servicos_new']) && (string) $_GET['pg_servicos_new'] === '1';
        $is_new_page_path = $request_path === 'service-construction-civil-infrastructure';
        $is_servicos = ($current_template && basename($current_template) === 'page-servicos.php')
            || $is_servicos_query
            || is_page('servicos');
        $is_new_page = $is_new_page_query || $is_new_page_path;
        $sobre_page = get_page_by_path('sobre-nos');
        $sobre_url = $sobre_page ? get_permalink($sobre_page) : home_url('/?page_id=8');
        if ($is_sobre_nos && $pg_id > 0) {
            $sobre_url = get_permalink($pg_id);
        }
        $servicos_url = pgroup_get_servicos_landing_url();
        $projetos_page = get_page_by_path('projetos');
        $projetos_url = $projetos_page ? get_permalink($projetos_page) : home_url('/projetos/');
        $blog_url = get_option('page_for_posts')
            ? get_permalink((int) get_option('page_for_posts'))
            : home_url('/blog/');
        $posts_page_id = (int) get_option('page_for_posts');
        $is_blog = (is_home() && !is_front_page()) || ($posts_page_id > 0 && is_page($posts_page_id));
        $contactos_page = get_page_by_path('contactos');
        $contactos_url = $contactos_page ? get_permalink($contactos_page) : home_url('/?page_id=9');
        $is_contactos = $contactos_page ? is_page((int) $contactos_page->ID) : ($pg_id === 9);
        $is_projetos = $projetos_page ? is_page((int) $projetos_page->ID) : false;
        $servicos_submenu_links = array(
            array(
                'label' => __('Sobre o Serviço', 'pgroup-child'),
                'url' => trailingslashit($servicos_url) . '#pgroup-servicos-sobre',
            ),
            array(
                'label' => __('Áreas de Atuação', 'pgroup-child'),
                'url' => trailingslashit($servicos_url) . '#pgroup-servicos-areas',
            ),
            array(
                'label' => __('Processo', 'pgroup-child'),
                'url' => trailingslashit($servicos_url) . '#pgroup-servicos-processo',
            ),
            array(
                'label' => __('Contacto', 'pgroup-child'),
                'url' => trailingslashit($servicos_url) . '#pgroup-servicos-contacto',
            ),
        );
        ?>

        <nav class="pgroup-header-nav" aria-label="<?php esc_attr_e('Principal', 'pgroup-child'); ?>">
            <ul id="menu-primary" class="pgroup-header-menu">
                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children<?php echo $is_new_page ? ' current-menu-item current-menu-ancestor' : ''; ?>">
                    <a href="<?php echo esc_url($servicos_new_page_url); ?>"<?php echo $is_new_page ? ' aria-current="page"' : ''; ?>><?php esc_html_e('Service Civil Infra', 'pgroup-child'); ?></a>
                    <ul class="sub-menu" aria-label="<?php esc_attr_e('Submenu de Serviços', 'pgroup-child'); ?>">
                        <?php foreach ($servicos_submenu_links as $submenu_item) : ?>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                <a href="<?php echo esc_url($submenu_item['url']); ?>"><?php echo esc_html($submenu_item['label']); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page<?php echo $is_sobre_nos ? ' current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url($sobre_url); ?>"<?php echo $is_sobre_nos ? ' aria-current="page"' : ''; ?>><?php esc_html_e('Sobre Nós', 'pgroup-child'); ?></a>
                </li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page<?php echo $is_projetos ? ' current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url($projetos_url); ?>"<?php echo $is_projetos ? ' aria-current="page"' : ''; ?>><?php esc_html_e('Portfólio', 'pgroup-child'); ?></a>
                </li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page<?php echo $is_blog ? ' current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url($blog_url); ?>"<?php echo $is_blog ? ' aria-current="page"' : ''; ?>><?php esc_html_e('Blog', 'pgroup-child'); ?></a>
                </li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page<?php echo $is_contactos ? ' current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url($contactos_url); ?>"<?php echo $is_contactos ? ' aria-current="page"' : ''; ?>><?php esc_html_e('Contactos', 'pgroup-child'); ?></a>
                </li>
            </ul>
        </nav>

        <div class="pgroup-header-actions">
            <a class="pgroup-header-newpage-btn" href="<?php echo esc_url($servicos_new_page_url); ?>">
                <?php esc_html_e('Nova Pagina', 'pgroup-child'); ?>
            </a>
            <a class="pgroup-header-cta" href="<?php echo esc_url($contact_url); ?>">
                <?php esc_html_e('Contactar', 'pgroup-child'); ?>
                <span class="pgroup-header-icon-circle" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
                        <path d="M4 7H10" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 5L10 7L8 9" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</header>
