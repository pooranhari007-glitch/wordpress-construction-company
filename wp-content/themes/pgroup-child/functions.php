<?php
/**
 * PGroup Child theme functions.
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

define('PGROUP_CHILD_VERSION', '1.0.0');

require_once get_stylesheet_directory() . '/inc/setup.php';
require_once get_stylesheet_directory() . '/inc/cpt.php';
require_once get_stylesheet_directory() . '/inc/helpers.php';
require_once get_stylesheet_directory() . '/inc/acf.php';

add_action('template_redirect', 'pgroup_force_home_hero_image', 1);
function pgroup_force_home_hero_image()
{
    if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return;
    }

    if (!is_front_page() && !is_home()) {
        return;
    }

    ob_start('pgroup_replace_legacy_hero_image_url');
}

function pgroup_replace_legacy_hero_image_url($html)
{
    $legacy_pattern = '#https://images\.unsplash\.com/photo-1484154218962-a197022b5858[^"\')<]*#';
    $target_url = get_stylesheet_directory_uri() . '/assets/images/hero-banner-default.png';
    $target_url .= '?v=' . (string) filemtime(get_stylesheet_directory() . '/assets/images/hero-banner-default.png');

    return (string) preg_replace($legacy_pattern, $target_url, (string) $html);
}
