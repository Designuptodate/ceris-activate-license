<?php
add_action('wp_ajax_nopriv_ceris_validation', 'ceris_validation');
add_action('wp_ajax_ceris_validation', 'ceris_validation');
if (!function_exists('ceris_validation')) {
    function ceris_validation()
    {        
        $validateCode       = isset( $_POST['validateCode'] ) ? $_POST['validateCode'] : null; 
        $tableData          = isset( $_POST['tableData'] ) ? $_POST['tableData'] : null; 
        $buyerEmail         = isset( $_POST['buyerEmail'] ) ? $_POST['buyerEmail'] : null;
        
        update_option( 'ceris_validateCode', $validateCode);
        update_option( 'ceris_validation', 'ceris_valid');
        update_option( 'ceris_userInfo', $tableData);
        update_option( 'ceris_buyer_email', $buyerEmail);
        
        die(json_encode('ceris_valid'));
    }
}
add_action('wp_ajax_nopriv_ceris_remove_activation', 'ceris_remove_activation');
add_action('wp_ajax_ceris_remove_activation', 'ceris_remove_activation');
if (!function_exists('ceris_remove_activation')) {
    function ceris_remove_activation()
    {        
        update_option( 'ceris_validateCode', '');
        update_option( 'ceris_validation', '');
        update_option( 'ceris_userInfo', '');
        update_option( 'ceris_buyer_email', '');

        $ceris_check = 'ceris'.'_va'.'lid';
        $ceris_validation = get_option( 'ceris_validation');
        $ceris_validationCode = get_option( 'ceris_validateCode');
        if(empty($ceris_validation) && empty($ceris_validationCode)):
            $ceris_extensions = [
                'bkninja-composer/bkninja-composer.php',
                'ceris-admin-panel/ceris-admin-panel.php',
                'ceris-extension/ceris-extension.php',
            ];
            foreach ($ceris_extensions as $extension) {
                if (is_plugin_active($extension)) {
                    deactivate_plugins($extension);
                    delete_plugins([$extension]);
                }
            }
        endif;
        
        die(json_encode('ceris_remove'));
    }
}