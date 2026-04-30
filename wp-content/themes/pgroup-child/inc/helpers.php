<?php
/**
 * Small reusable template helpers.
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns ACF value when available, else fallback.
 *
 * @param string $key Field name.
 * @param mixed  $fallback Fallback value.
 *
 * @return mixed
 */
function pgroup_get_field_safe($key, $fallback = '')
{
    if (function_exists('get_field')) {
        $value = get_field($key);
        if ($value !== null && $value !== false && $value !== '') {
            return $value;
        }
    }

    return $fallback;
}

/**
 * Resolves an ACF image field to a URL (array, attachment ID, or URL string).
 *
 * @param mixed  $field_value Value from get_field().
 * @param string $size Image size slug.
 *
 * @return string
 */
function pgroup_resolve_acf_image_url($field_value, $size = 'large')
{
    if ($field_value === null || $field_value === '' || $field_value === false) {
        return '';
    }

    if (is_numeric($field_value)) {
        $src = wp_get_attachment_image_src((int) $field_value, $size);
        return $src && !empty($src[0]) ? $src[0] : '';
    }

    if (is_array($field_value)) {
        if (!empty($field_value['sizes'][$size])) {
            return $field_value['sizes'][$size];
        }
        if (!empty($field_value['url'])) {
            return $field_value['url'];
        }
        if (!empty($field_value['ID'])) {
            $src = wp_get_attachment_image_src((int) $field_value['ID'], $size);
            return $src && !empty($src[0]) ? $src[0] : '';
        }
    }

    if (is_string($field_value) && filter_var($field_value, FILTER_VALIDATE_URL)) {
        return $field_value;
    }

    return '';
}

/**
 * URL for the Serviços landing (page template Serviços (Figma) or slug servicos), else query fallback.
 *
 * @return string
 */
function pgroup_get_servicos_landing_url()
{
    static $cached = null;
    if ($cached !== null) {
        return $cached;
    }

    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-servicos.php',
        'number' => 1,
        'post_status' => 'publish',
        'sort_column' => 'menu_order',
        'sort_order' => 'ASC',
    ));
    if (!empty($pages) && isset($pages[0]) && $pages[0] instanceof WP_Post) {
        $link = get_permalink($pages[0]);
        if (is_string($link) && $link !== '') {
            $cached = $link;
            return $cached;
        }
    }

    $by_slug = get_page_by_path('servicos');
    if ($by_slug instanceof WP_Post && $by_slug->post_status === 'publish') {
        $link = get_permalink($by_slug);
        if (is_string($link) && $link !== '') {
            $cached = $link;
            return $cached;
        }
    }

    $cached = home_url('/?pg_servicos=1');
    return $cached;
}

/**
 * Default primary nav when no menu is assigned (matches Figma labels).
 */
function pgroup_header_menu_fallback()
{
    $blog_url = get_option('page_for_posts')
        ? get_permalink((int) get_option('page_for_posts'))
        : home_url('/blog/');

    $items = array(
        array(
            'url' => pgroup_get_servicos_landing_url(),
            'label' => __('Serviços', 'pgroup-child'),
        ),
        array(
            'url' => home_url('/sobre-nos/'),
            'label' => __('Sobre Nós', 'pgroup-child'),
        ),
        array(
            'url' => get_post_type_archive_link('projeto') ?: home_url('/projetos/'),
            'label' => __('Portfólio', 'pgroup-child'),
        ),
        array(
            'url' => $blog_url ?: home_url('/'),
            'label' => __('Blog', 'pgroup-child'),
        ),
    );

    echo '<ul class="pgroup-header-menu">';
    foreach ($items as $item) {
        printf(
            '<li><a href="%s">%s</a></li>',
            esc_url($item['url']),
            esc_html($item['label'])
        );
    }
    echo '</ul>';
}

/**
 * Removes Home and Blog items from header primary nav.
 *
 * @param array    $items Menu items.
 * @param stdClass $args Menu args.
 *
 * @return array
 */
function pgroup_filter_primary_menu_items($items, $args)
{
    if (!isset($args->theme_location) || $args->theme_location !== 'primary') {
        return $items;
    }

    $home_url = home_url('/');

    $filtered = array();
    foreach ($items as $item) {
        $title = isset($item->title) ? wp_strip_all_tags((string) $item->title) : '';
        $title_key = strtolower(trim($title));
        $title_key_ascii = strtolower(trim(remove_accents($title)));
        $item_url = isset($item->url) ? untrailingslashit((string) $item->url) : '';

        $is_home_title = in_array($title_key, array('home', 'inicio', 'início'), true);
        $is_home_url = $item_url !== '' && $item_url === untrailingslashit($home_url);
        if ($is_home_title || $is_home_url) {
            continue;
        }

        if ($title_key === 'blog') {
            continue;
        }

        $is_servicos_title = strpos($title_key_ascii, 'servicos') !== false;
        $is_servicos_url = $item_url !== '' && preg_match('#/servicos$#', $item_url);
        if ($is_servicos_title || $is_servicos_url) {
            $item->url = pgroup_get_servicos_landing_url();
        }

        $posts_page_id = (int) get_option('page_for_posts');
        if ($posts_page_id > 0) {
            if (isset($item->object_id) && (int) $item->object_id === $posts_page_id) {
                continue;
            }
            $posts_url = get_permalink($posts_page_id);
            if ($posts_url && $item_url !== '' && untrailingslashit($item_url) === untrailingslashit((string) $posts_url)) {
                continue;
            }
        }

        $filtered[] = $item;
    }

    return $filtered;
}
add_filter('wp_nav_menu_objects', 'pgroup_filter_primary_menu_items', 10, 2);

/**
 * Circular service icon for homepage grid (Figma: 70px ring, white stroke pictogram).
 *
 * @param string $variant construcao|equipamentos|imobiliario
 */
function pgroup_render_service_icon($variant)
{
    $allowed = array(
        'construcao',
        'equipamentos',
        'imobiliario',
    );
    if (!in_array($variant, $allowed, true)) {
        $variant = 'construcao';
    }

    $svgs = array(
        // Construção civil / infraestruturas — edifício
        'construcao' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false"><path d="M6 22V9.5l6-3.5 6 3.5V22" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 22v-6h4v6M10 14h4M10 18h2M12 14v-2.5M9 11.5h6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        // Equipamentos — camião simplificado
        'equipamentos' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false"><path d="M2 17h12V7H2v10zM14 17h3.5l2.5 3v2H14" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="6.5" cy="17" r="2" stroke="currentColor" stroke-width="1.4"/><circle cx="17" cy="17" r="2" stroke="currentColor" stroke-width="1.4"/><path d="M4 17H1V4h13v13" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        // Imobiliário — casa
        'imobiliario' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false"><path d="M3 10.5L12 4l9 6.5V20a1 1 0 01-1 1h-5v-8H9v9H4a1 1 0 01-1-1v-9.5z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 22V12h6v10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    );

    echo '<span class="pgroup-service-icon">';
    echo $svgs[$variant];
    echo '</span>';
}
