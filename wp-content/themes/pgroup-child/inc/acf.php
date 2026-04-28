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

    acf_add_local_field_group(array(
        'key' => 'group_pgroup_homepage',
        'title' => 'Homepage - Campos',
        'fields' => array(
            array(
                'key' => 'field_home_hero_title',
                'label' => 'Hero titulo',
                'name' => 'home_hero_title',
                'type' => 'text',
                'default_value' => 'Engenharia e Construcao',
            ),
            array(
                'key' => 'field_home_hero_text',
                'label' => 'Hero texto',
                'name' => 'home_hero_text',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_home_hero_image',
                'label' => 'Hero imagem',
                'name' => 'home_hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
                'library' => 'all',
            ),
            array(
                'key' => 'field_home_hero_cta_text',
                'label' => 'Hero botao texto',
                'name' => 'home_hero_cta_text',
                'type' => 'text',
                'default_value' => 'Fale connosco',
            ),
            array(
                'key' => 'field_home_hero_cta_link',
                'label' => 'Hero botao link',
                'name' => 'home_hero_cta_link',
                'type' => 'url',
            ),
            array(
                'key' => 'field_home_about_title',
                'label' => 'Sobre nos titulo',
                'name' => 'home_about_title',
                'type' => 'text',
                'default_value' => 'O nosso maior compromisso',
            ),
            array(
                'key' => 'field_home_about_text',
                'label' => 'Sobre nos texto',
                'name' => 'home_about_text',
                'type' => 'textarea',
                'rows' => 4,
            ),
            array(
                'key' => 'field_home_about_image',
                'label' => 'Sobre nos imagem',
                'name' => 'home_about_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
                'library' => 'all',
            ),
            array(
                'key' => 'field_home_services_title',
                'label' => 'Areas de atuacao titulo',
                'name' => 'home_services_title',
                'type' => 'text',
                'default_value' => 'Areas de Atuacao',
            ),
            array(
                'key' => 'field_home_services_intro',
                'label' => 'Areas de atuacao texto',
                'name' => 'home_services_intro',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_home_services_link_label',
                'label' => 'Areas de atuacao link texto',
                'name' => 'home_services_link_label',
                'type' => 'text',
                'default_value' => 'Saber mais',
            ),
            array(
                'key' => 'field_home_services_link_url',
                'label' => 'Areas de atuacao link URL',
                'name' => 'home_services_link_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_home_services_count',
                'label' => 'Numero de servicos na home',
                'name' => 'home_services_count',
                'type' => 'number',
                'default_value' => 3,
                'min' => 1,
                'max' => 12,
            ),
            array(
                'key' => 'field_home_projects_title',
                'label' => 'Projetos titulo',
                'name' => 'home_projects_title',
                'type' => 'text',
                'default_value' => 'Os nossos projetos',
            ),
            array(
                'key' => 'field_home_projects_intro',
                'label' => 'Projetos texto',
                'name' => 'home_projects_intro',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_home_projects_link_label',
                'label' => 'Projetos link texto',
                'name' => 'home_projects_link_label',
                'type' => 'text',
                'default_value' => 'Saber mais',
            ),
            array(
                'key' => 'field_home_projects_link_url',
                'label' => 'Projetos link URL',
                'name' => 'home_projects_link_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_home_projects_count',
                'label' => 'Numero de projetos na home',
                'name' => 'home_projects_count',
                'type' => 'number',
                'default_value' => 6,
                'min' => 1,
                'max' => 12,
            ),
            array(
                'key' => 'field_home_blog_title',
                'label' => 'Blog titulo',
                'name' => 'home_blog_title',
                'type' => 'text',
                'default_value' => 'O nosso blog - tendencias e novidades',
            ),
            array(
                'key' => 'field_home_blog_link_label',
                'label' => 'Blog link texto',
                'name' => 'home_blog_link_label',
                'type' => 'text',
                'default_value' => 'Saber mais',
            ),
            array(
                'key' => 'field_home_blog_link_url',
                'label' => 'Blog link URL',
                'name' => 'home_blog_link_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_home_contact_title',
                'label' => 'Formulario titulo',
                'name' => 'home_contact_title',
                'type' => 'text',
                'default_value' => 'Vamos trabalhar no seu projeto',
            ),
            array(
                'key' => 'field_home_contact_text',
                'label' => 'Formulario texto',
                'name' => 'home_contact_text',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_home_contact_form_shortcode',
                'label' => 'Formulario shortcode',
                'name' => 'home_contact_form_shortcode',
                'type' => 'text',
                'default_value' => '[contact-form-7 id=\"1\" title=\"Home Contact\"]',
            ),
            array(
                'key' => 'field_home_testimonials_title',
                'label' => 'Testemunhos titulo',
                'name' => 'home_testimonials_title',
                'type' => 'text',
                'default_value' => 'O que dizem os nossos clientes',
            ),
            array(
                'key' => 'field_home_testimonials_text',
                'label' => 'Testemunhos texto',
                'name' => 'home_testimonials_text',
                'type' => 'text',
            ),
            array(
                'key' => 'field_home_testimonial_1',
                'label' => 'Testemunho 1',
                'name' => 'home_testimonial_1',
                'type' => 'textarea',
                'rows' => 4,
            ),
            array(
                'key' => 'field_home_testimonial_2',
                'label' => 'Testemunho 2',
                'name' => 'home_testimonial_2',
                'type' => 'textarea',
                'rows' => 4,
            ),
            array(
                'key' => 'field_home_testimonial_3',
                'label' => 'Testemunho 3',
                'name' => 'home_testimonial_3',
                'type' => 'textarea',
                'rows' => 4,
            ),
            array(
                'key' => 'field_home_newsletter_title',
                'label' => 'Newsletter titulo',
                'name' => 'home_newsletter_title',
                'type' => 'text',
                'default_value' => 'Receba novidades da PGroup',
            ),
            array(
                'key' => 'field_home_newsletter_text',
                'label' => 'Newsletter texto',
                'name' => 'home_newsletter_text',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_home_newsletter_shortcode',
                'label' => 'Newsletter shortcode',
                'name' => 'home_newsletter_shortcode',
                'type' => 'text',
            ),
            array(
                'key' => 'field_home_why_title',
                'label' => 'Porque escolher titulo',
                'name' => 'home_why_title',
                'type' => 'text',
                'default_value' => 'Porque escolher a PGroup?',
            ),
            array(
                'key' => 'field_home_stat_1_number',
                'label' => 'Estatistica 1 numero',
                'name' => 'home_stat_1_number',
                'type' => 'text',
                'default_value' => '+10',
            ),
            array(
                'key' => 'field_home_stat_1_label',
                'label' => 'Estatistica 1 legenda',
                'name' => 'home_stat_1_label',
                'type' => 'text',
                'default_value' => 'Anos de experiencia',
            ),
            array(
                'key' => 'field_home_stat_2_number',
                'label' => 'Estatistica 2 numero',
                'name' => 'home_stat_2_number',
                'type' => 'text',
                'default_value' => '+200',
            ),
            array(
                'key' => 'field_home_stat_2_label',
                'label' => 'Estatistica 2 legenda',
                'name' => 'home_stat_2_label',
                'type' => 'text',
                'default_value' => 'Empreendimentos',
            ),
            array(
                'key' => 'field_home_stat_3_number',
                'label' => 'Estatistica 3 numero',
                'name' => 'home_stat_3_number',
                'type' => 'text',
                'default_value' => '+100',
            ),
            array(
                'key' => 'field_home_stat_3_label',
                'label' => 'Estatistica 3 legenda',
                'name' => 'home_stat_3_label',
                'type' => 'text',
                'default_value' => 'Projetos concluidos',
            ),
            array(
                'key' => 'field_home_stat_4_number',
                'label' => 'Estatistica 4 numero',
                'name' => 'home_stat_4_number',
                'type' => 'text',
                'default_value' => '+500',
            ),
            array(
                'key' => 'field_home_stat_4_label',
                'label' => 'Estatistica 4 legenda',
                'name' => 'home_stat_4_label',
                'type' => 'text',
                'default_value' => 'Obras publicas',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
    ));
}
