<?php
/**
 * Custom post types for dynamic content.
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'pgroup_register_custom_post_types');
function pgroup_register_custom_post_types()
{
    register_post_type('servico', array(
        'labels' => array(
            'name' => __('Servicos', 'pgroup-child'),
            'singular_name' => __('Servico', 'pgroup-child'),
            'add_new_item' => __('Adicionar novo servico', 'pgroup-child'),
            'edit_item' => __('Editar servico', 'pgroup-child'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'servicos'),
        'menu_icon' => 'dashicons-hammer',
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    ));

    register_post_type('projeto', array(
        'labels' => array(
            'name' => __('Projetos', 'pgroup-child'),
            'singular_name' => __('Projeto', 'pgroup-child'),
            'add_new_item' => __('Adicionar novo projeto', 'pgroup-child'),
            'edit_item' => __('Editar projeto', 'pgroup-child'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'projetos'),
        'menu_icon' => 'dashicons-portfolio',
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    ));
}
