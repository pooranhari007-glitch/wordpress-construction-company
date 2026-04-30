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

add_action('template_redirect', 'pgroup_render_servicos_fallback', 0);
function pgroup_render_servicos_fallback()
{
    if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return;
    }

    $request_path = isset($_SERVER['REQUEST_URI']) ? (string) wp_parse_url(wp_unslash($_SERVER['REQUEST_URI']), PHP_URL_PATH) : '';
    $request_path = trim($request_path, '/');

    $is_servicos_query = isset($_GET['pg_servicos']) && (string) $_GET['pg_servicos'] === '1';
    if ($request_path !== 'servicos' && !$is_servicos_query) {
        return;
    }

    if (!$is_servicos_query && !is_404()) {
        return;
    }

    $new_template_path = get_stylesheet_directory() . '/page-servicos-new.php';
    $template_path = file_exists($new_template_path)
        ? $new_template_path
        : get_stylesheet_directory() . '/page-servicos.php';
    if (!file_exists($template_path)) {
        return;
    }

    global $wp_query;
    if (isset($wp_query) && $wp_query instanceof WP_Query) {
        $wp_query->is_404 = false;
        status_header(200);
        nocache_headers();
    }

    include $template_path;
    exit;
}

add_action('template_redirect', 'pgroup_render_servicos_new_fallback', 0);
function pgroup_render_servicos_new_fallback()
{
    if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return;
    }

    $request_path = isset($_SERVER['REQUEST_URI']) ? (string) wp_parse_url(wp_unslash($_SERVER['REQUEST_URI']), PHP_URL_PATH) : '';
    $request_path = trim($request_path, '/');
    $is_new_services_query = isset($_GET['pg_servicos_new']) && (string) $_GET['pg_servicos_new'] === '1';
    $is_new_services_pretty = $request_path === 'service-construction-civil-infrastructure';
    if (!$is_new_services_query && !$is_new_services_pretty) {
        return;
    }

    if ($is_new_services_pretty && !is_404()) {
        return;
    }

    $template_path = get_stylesheet_directory() . '/page-servicos-new.php';
    if (!file_exists($template_path)) {
        return;
    }

    global $wp_query;
    if (isset($wp_query) && $wp_query instanceof WP_Query) {
        $wp_query->is_404 = false;
        status_header(200);
        nocache_headers();
    }

    include $template_path;
    exit;
}

add_action('template_redirect', 'pgroup_render_construcao_servico_design_page', 0);
function pgroup_render_construcao_servico_design_page()
{
    if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return;
    }

    if (!is_singular('servico')) {
        return;
    }

    $post = get_queried_object();
    if (!$post instanceof WP_Post) {
        return;
    }

    if ((string) $post->post_name !== 'construcao-civil-e-infraestruturas') {
        return;
    }

    $template_path = get_stylesheet_directory() . '/page-servicos-new.php';
    if (!file_exists($template_path)) {
        return;
    }

    status_header(200);
    nocache_headers();
    include $template_path;
    exit;
}

add_filter('template_include', 'pgroup_force_construcao_servico_template', 999);
function pgroup_force_construcao_servico_template($template)
{
    if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return $template;
    }

    $target_slug = 'construcao-civil-e-infraestruturas';
    $request_path = isset($_SERVER['REQUEST_URI']) ? (string) wp_parse_url(wp_unslash($_SERVER['REQUEST_URI']), PHP_URL_PATH) : '';
    $request_path = trim($request_path, '/');
    $query_servico = isset($_GET['servico']) ? sanitize_title((string) wp_unslash($_GET['servico'])) : '';
    $request_has_slug = strpos($request_path, $target_slug) !== false;
    $query_matches = $query_servico === $target_slug;

    $queried = get_queried_object();
    $object_matches = $queried instanceof WP_Post && (string) $queried->post_name === $target_slug;

    if (!$request_has_slug && !$query_matches && !$object_matches) {
        return $template;
    }

    $custom_template = get_stylesheet_directory() . '/page-servicos-new.php';
    if (file_exists($custom_template)) {
        return $custom_template;
    }

    return $template;
}

add_filter('nav_menu_link_attributes', 'pgroup_force_servicos_nav_url', 10, 4);
function pgroup_force_servicos_nav_url($atts, $menu_item, $args, $depth)
{
    if (!is_array($atts) || !isset($atts['href'])) {
        return $atts;
    }

    $item_title = isset($menu_item->title) ? strtolower(remove_accents((string) $menu_item->title)) : '';
    $item_url = strtolower((string) $atts['href']);
    $is_servicos_item = strpos($item_title, 'servicos') !== false
        || preg_match('#/servicos/?$#', (string) wp_parse_url($item_url, PHP_URL_PATH));

    if ($is_servicos_item) {
        $atts['href'] = pgroup_get_servicos_landing_url();
    }

    return $atts;
}

add_filter('wp_nav_menu_items', 'pgroup_force_servicos_menu_item_html', 10, 2);
function pgroup_force_servicos_menu_item_html($items, $args)
{
    if (!is_string($items) || $items === '') {
        return $items;
    }

    $servicos_pretty = home_url('/servicos/');
    $servicos_plain = home_url('/servicos');
    $servicos_target = pgroup_get_servicos_landing_url();

    $items = str_replace('href="' . esc_url($servicos_pretty) . '"', 'href="' . esc_url($servicos_target) . '"', $items);
    $items = str_replace('href="' . esc_url($servicos_plain) . '"', 'href="' . esc_url($servicos_target) . '"', $items);

    return $items;
}
