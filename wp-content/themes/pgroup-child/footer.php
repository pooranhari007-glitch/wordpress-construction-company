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
?>
    <footer class="pgroup-footer">
        <div class="pgroup-container pgroup-footer-main">
            <div class="pgroup-footer-brand-col">
                <a class="pgroup-footer-logo-link" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    <img class="pgroup-footer-logo" src="<?php echo esc_url($footer_logo_uri); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                </a>
                <div class="pgroup-footer-social" aria-label="<?php esc_attr_e('Redes sociais', 'pgroup-child'); ?>">
                    <a href="#" aria-label="LinkedIn">in</a>
                    <a href="#" aria-label="Instagram">ig</a>
                    <a href="#" aria-label="Facebook">f</a>
                </div>
            </div>
            <div class="pgroup-footer-links-col">
                <h4>PGroup</h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => false,
                    'fallback_cb' => false,
                    'menu_class' => 'pgroup-footer-menu',
                ));
                ?>
            </div>
            <div class="pgroup-footer-contact-col">
                <h4><?php esc_html_e('Contactos', 'pgroup-child'); ?></h4>
                <p><?php esc_html_e('Avenida, Vila Verde', 'pgroup-child'); ?></p>
                <p><a href="tel:+351253089469">(+351) 253 089 469</a></p>
                <p><a href="mailto:geral@p-group.pt">geral@p-group.pt</a></p>
            </div>
        </div>
        <div class="pgroup-container pgroup-footer-grid">
            <div>
                <div class="pgroup-footer-brand"><?php bloginfo('name'); ?></div>
            </div>
            <div>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => false,
                    'fallback_cb' => false,
                    'menu_class' => 'pgroup-footer-menu',
                ));
                ?>
            </div>
            <div>
                <h4><?php esc_html_e('Contactos', 'pgroup-child'); ?></h4>
                <p><?php bloginfo('description'); ?></p>
            </div>
        </div>
        <div class="pgroup-container pgroup-footer-bottom">
            <p><?php echo esc_html__('PGroup', 'pgroup-child') . ' © ' . esc_html(date_i18n('Y')); ?> | <?php esc_html_e('Desenvolvido por adn digital partner.', 'pgroup-child'); ?></p>
            <a href="<?php echo esc_url($privacy_url); ?>"><?php esc_html_e('Política de Privacidade', 'pgroup-child'); ?></a>
            <a href="<?php echo esc_url($complaints_url); ?>"><?php esc_html_e('Livro de Reclamações', 'pgroup-child'); ?></a>
        </div>
    </footer>
<?php wp_footer(); ?>
</body>
</html>
