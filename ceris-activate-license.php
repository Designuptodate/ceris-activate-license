<?php
    /*
    Plugin Name: Ceris Activate License
    Plugin URI: https://themesific.com
    Description: Ceris Activate License
    Author: BKNinja
    Version: 1.2
    Author URI: https://themesific.com
    */
?>
<?php
define( 'CERIS_REGISTRATION_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CERIS_REGISTRATION_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

require_once (CERIS_REGISTRATION_PLUGIN_DIR.'templates/registration.php');
require_once (CERIS_REGISTRATION_PLUGIN_DIR.'library/ajax_check.php');


if ( ! function_exists( 'bk_registration_panel_scripts_method' ) ) {
    function bk_registration_panel_scripts_method() {
        wp_enqueue_style( 'registration-style', CERIS_REGISTRATION_PLUGIN_DIR_URL . 'css/style.css', array(), '' );
        wp_enqueue_script( 'verify_purchase', CERIS_REGISTRATION_PLUGIN_DIR_URL . 'js/verify_purchase.js', array('jquery-ui-sortable'), '', true );
    }
}
add_action('admin_enqueue_scripts', 'bk_registration_panel_scripts_method');

/**-------------------------------------------------------------------------------------------------------------------------
 * register ajax
 */
if ( ! function_exists( 'bk_registration_enqueue_ajax_url' ) ) {
	function bk_registration_enqueue_ajax_url() {
        echo '<script type="application/javascript">var ajaxurl = "' . esc_url(admin_url( 'admin-ajax.php' )) . '"</script>';
	}
	add_action( 'admin_enqueue_scripts', 'bk_registration_enqueue_ajax_url' );
}

function ceris_theme_registration() {
	// Check that the user is allowed to update options  
	if (current_user_can('manage_options')) {  
        add_menu_page(esc_html__('Registration', 'bkninja'), esc_html__('Ceris Registration', 'bkninja'), 'edit_theme_options', 'ceris-theme-registration', 'ceris_registration_template', 'dashicons-admin-network', 2 );
    }
}
add_action('admin_menu', 'ceris_theme_registration');