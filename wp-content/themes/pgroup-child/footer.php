<?php
/**
 * Custom footer.
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

$footer_logo_uri = get_stylesheet_directory_uri() . '/assets/images/footer-logo-pgroup.png';
$footer_logo_path = get_stylesheet_directory() . '/assets/images/footer-logo-pgroup.png';
if (file_exists($footer_logo_path)) {
    $footer_logo_uri .= '?v=' . (string) filemtime($footer_logo_path);
}

$privacy_url = home_url('/politica-de-privacidade/');
$complaints_url = home_url('/livro-de-reclamacoes/');
$blog_url = get_option('page_for_posts')
    ? get_permalink((int) get_option('page_for_posts'))
    : home_url('/blog/');
$portfolio_url = home_url('/projetos/');
$servicos_landing_url = pgroup_get_servicos_landing_url();
$equipments_url = $servicos_landing_url;
$service_civil_infra_url = home_url('/?pg_servicos=1');
?>
    <footer class="pgroup-footer">
        <div class="pgroup-container pgroup-footer-main">
            <div class="pgroup-footer-brand-col">
                <a class="pgroup-footer-logo-link" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    <img class="pgroup-footer-logo" src="<?php echo esc_url($footer_logo_uri); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                </a>
                <div class="pgroup-footer-social" aria-label="<?php esc_attr_e('Redes sociais', 'pgroup-child'); ?>">
                    <a href="#" aria-label="LinkedIn">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
                            <path d="M6.75 9H3.75V20.25H6.75V9Z" fill="currentColor"/>
                            <path d="M5.25 7.5C6.28553 7.5 7.125 6.66053 7.125 5.625C7.125 4.58947 6.28553 3.75 5.25 3.75C4.21447 3.75 3.375 4.58947 3.375 5.625C3.375 6.66053 4.21447 7.5 5.25 7.5Z" fill="currentColor"/>
                            <path d="M20.25 13.845C20.25 10.815 18.48 9 15.84 9C14.595 9 13.785 9.675 13.32 10.155V9H10.32V20.25H13.32V14.175C13.32 12.57 14.055 11.625 15.21 11.625C16.32 11.625 16.95 12.42 16.95 14.025V20.25H19.95V13.68C20.055 13.74 20.16 13.8 20.25 13.845Z" fill="currentColor"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
                            <rect x="3.75" y="3.75" width="16.5" height="16.5" rx="4.5" stroke="currentColor" stroke-width="1.8"/>
                            <circle cx="12" cy="12" r="3.75" stroke="currentColor" stroke-width="1.8"/>
                            <circle cx="17.25" cy="6.75" r="1.2" fill="currentColor"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Facebook">
                        <svg width="10" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
                            <path d="M14.25 8.25V6.75C14.25 6.12868 14.6287 5.625 15.0963 5.625H16.5V2.625H13.6875C11.0987 2.625 9 4.89188 9 7.6875V8.25H6.75V11.25H9V21.375H12.75V11.25H15.5625L16.5 8.25H14.25Z" fill="currentColor"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="pgroup-footer-links-col">
                <h4>PGroup</h4>
                <ul class="pgroup-footer-menu" aria-label="PGroup links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/sobre-nos/')); ?>">Sobre Nós</a></li>
                    <li><a href="<?php echo esc_url($servicos_landing_url); ?>">Serviços</a></li>
                    <li><a href="<?php echo esc_url($equipments_url); ?>">Equipamentos</a></li>
                    <li><a href="<?php echo esc_url($portfolio_url); ?>">Portfólio</a></li>
                    <li><a href="<?php echo esc_url($blog_url); ?>">Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contactos/')); ?>">Contactos</a></li>
                </ul>
            </div>
            <div class="pgroup-footer-contact-col">
                <h4><?php esc_html_e('Contactos', 'pgroup-child'); ?></h4>
                <p><?php esc_html_e('Avenida, Vila Verde', 'pgroup-child'); ?></p>
                <p><a href="tel:+351253089469">(+351) 253 089 469</a></p>
                <p><a href="mailto:geral@p-group.pt">geral@p-group.pt</a></p>
                <p><a class="pgroup-footer-newpage-btn" href="<?php echo esc_url($service_civil_infra_url); ?>"><?php esc_html_e('Service Civil Infra', 'pgroup-child'); ?></a></p>
            </div>
        </div>
        <div class="pgroup-container pgroup-footer-grid">
            <div>
                <div class="pgroup-footer-brand"><?php bloginfo('name'); ?></div>
            </div>
            <div>
                <ul class="pgroup-footer-menu" aria-label="PGroup links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/sobre-nos/')); ?>">Sobre Nós</a></li>
                    <li><a href="<?php echo esc_url($servicos_landing_url); ?>">Serviços</a></li>
                    <li><a href="<?php echo esc_url($service_civil_infra_url); ?>">Service Civil Infra</a></li>
                    <li><a href="<?php echo esc_url($equipments_url); ?>">Equipamentos</a></li>
                    <li><a href="<?php echo esc_url($portfolio_url); ?>">Portfólio</a></li>
                    <li><a href="<?php echo esc_url($blog_url); ?>">Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contactos/')); ?>">Contactos</a></li>
                </ul>
            </div>
            <div>
                <h4><?php esc_html_e('Contactos', 'pgroup-child'); ?></h4>
                <p><?php bloginfo('description'); ?></p>
            </div>
        </div>
        <div class="pgroup-container pgroup-footer-bottom">
            <p><?php echo esc_html__('PGroup', 'pgroup-child') . ' © 2025'; ?> | <?php esc_html_e('Desenvolvido por adn digital partner.', 'pgroup-child'); ?></p>
            <a href="<?php echo esc_url($privacy_url); ?>"><?php esc_html_e('Política de Privacidade', 'pgroup-child'); ?></a>
            <a href="<?php echo esc_url($complaints_url); ?>"><?php esc_html_e('Livro de Reclamações', 'pgroup-child'); ?></a>
        </div>
    </footer>
<?php wp_footer(); ?>
</body>
</html>
