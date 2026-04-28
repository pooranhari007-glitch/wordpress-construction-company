<?php
/**
 * Theme setup and assets.
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_enqueue_scripts', 'pgroup_child_enqueue_assets', 20);
function pgroup_child_enqueue_assets()
{
    wp_enqueue_style(
        'pgroup-child-style',
        get_stylesheet_uri(),
        array(),
        PGROUP_CHILD_VERSION
    );

    wp_enqueue_style(
        'pgroup-main-style',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        array('pgroup-child-style'),
        PGROUP_CHILD_VERSION
    );
}

add_action('after_setup_theme', 'pgroup_child_theme_setup');
function pgroup_child_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'pgroup-child'),
        'footer' => __('Footer Menu', 'pgroup-child'),
    ));
}
