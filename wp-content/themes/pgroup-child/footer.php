<?php
/**
 * Custom footer.
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
    <footer class="pgroup-footer">
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
            <p><?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?></p>
            <a href="<?php echo esc_url(home_url('/politica-de-privacidade/')); ?>"><?php esc_html_e('Politica de Privacidade', 'pgroup-child'); ?></a>
        </div>
    </footer>
<?php wp_footer(); ?>
</body>
</html>
