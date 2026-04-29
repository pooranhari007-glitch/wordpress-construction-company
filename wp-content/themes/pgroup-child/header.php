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
            <?php if ($header_logo_path !== '') : ?>
                <a class="pgroup-header-logo-image" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    <img src="<?php echo esc_url($header_logo_uri); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                </a>
            <?php elseif (has_custom_logo()) : ?>
                <span class="pgroup-header-logo-custom"><?php the_custom_logo(); ?></span>
            <?php else : ?>
                <a class="pgroup-header-logo-text" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    <span class="pgroup-logo-mark"><?php echo esc_html_x('P', 'Logo initial', 'pgroup-child'); ?></span>
                    <span class="pgroup-logo-word"><?php echo esc_html_x('GROUP', 'Logo wordmark', 'pgroup-child'); ?></span>
                </a>
            <?php endif; ?>
        </div>

        <nav class="pgroup-header-nav" aria-label="<?php esc_attr_e('Principal', 'pgroup-child'); ?>">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'pgroup-header-menu',
                'fallback_cb' => 'pgroup_header_menu_fallback',
            ));
            ?>
        </nav>

        <div class="pgroup-header-actions">
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
