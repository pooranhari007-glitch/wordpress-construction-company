<?php
/**
 * Local ACF groups for service/project content.
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', 'pgroup_register_acf_fields');
function pgroup_register_acf_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_pgroup_servico',
        'title' => 'Servico - Campos',
        'fields' => array(
            array(
                'key' => 'field_servico_subtitulo',
                'label' => 'Subtitulo',
                'name' => 'servico_subtitulo',
                'type' => 'text',
            ),
            array(
                'key' => 'field_servico_resumo',
                'label' => 'Resumo curto',
                'name' => 'servico_resumo',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_servico_cta_texto',
                'label' => 'Texto do botao',
                'name' => 'servico_cta_texto',
                'type' => 'text',
                'default_value' => 'Fale connosco',
            ),
            array(
                'key' => 'field_servico_cta_link',
                'label' => 'Link do botao',
                'name' => 'servico_cta_link',
                'type' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'servico',
                ),
            ),
        ),
    ));

    acf_add_local_field_group(array(
        'key' => 'group_pgroup_projeto',
        'title' => 'Projeto - Campos',
        'fields' => array(
            array(
                'key' => 'field_projeto_cliente',
                'label' => 'Cliente',
                'name' => 'projeto_cliente',
                'type' => 'text',
            ),
            array(
                'key' => 'field_projeto_data',
                'label' => 'Data do projeto',
                'name' => 'projeto_data',
                'type' => 'date_picker',
                'display_format' => 'd/m/Y',
                'return_format' => 'Y-m-d',
            ),
            array(
                'key' => 'field_projeto_local',
                'label' => 'Local',
                'name' => 'projeto_local',
                'type' => 'text',
            ),
            array(
                'key' => 'field_projeto_galeria',
                'label' => 'Galeria',
                'name' => 'projeto_galeria',
                'type' => 'gallery',
                'preview_size' => 'medium',
                'library' => 'all',
                'return_format' => 'array',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'projeto',
                ),
            ),
        ),
    ));
}
