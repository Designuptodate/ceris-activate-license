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
        
        die(json_encode('ceris_remove'));
    }
}