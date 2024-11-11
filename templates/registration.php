<?php
if (!function_exists('ceris_registration_template')) {
    function ceris_registration_template() {
        $isLH = '';
        if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1' || substr($_SERVER['REMOTE_ADDR'], 0, 4) == '127.' || $_SERVER['REMOTE_ADDR'] == '::1') {
            $isLH = 1;
            $activateStatus = get_option('ceris_validateCode');
        } else {
            $isLH = 0;
        }
    ?>
    <div class="page-wrap">
        <div class="ceris-registration-wrap">
        	<div class="hndle" style="padding: 15px 30px;">
                <h3 class="ceris-registration-heading-text"><?php esc_html_e('Ceris Registration', 'bkninja'); ?></h3>
                <p class="bk-admin-notice">
        			Thank you for choosing our Ceris theme! It's now installed and ready for you to use. </br>
                    Please insert your purchase code into the field to activate your license.
        		</p>
            </div>
            <div class="envato-purchase-code-form">
                <?php 
                    $homeURL = get_home_url();
                    $homeURLwithoutHTTPS = preg_replace('#^https?://#i', '', $homeURL);
                    
                    $ceris_validation = get_option( 'ceris_validation');
                ?>
            	<form method="post" data-islh="<?php echo $isLH;?>" data-itemid="26452254" data-homeurl="<?php echo $homeURL;?>">
            		
            		<?php
            		    if($ceris_validation == 'ceris_valid') {
                            $ceris_validateCode = get_option( 'ceris_validateCode');
                            $ceris_buyer_email = get_option( 'ceris_buyer_email');
                            $userLicense = get_option('ceris_userInfo');
                            ?>
                            <div class="purchase-code-col">
                                <label>Purchase Code: </label>
                                <input id="purchase_code_input" type="text" name="purchase_code" placeholder="Type or paste the buyer's purchase code here" value="<?php echo $ceris_validateCode;?>" readonly><br>
                            </div>
                            <div class="buyer-email-col">
                                <label>Email: <span>(Optional)</span></label>
                                <input id="buyer_email_input" type="text" name="buyer_email_input" placeholder="Optional" value="<?php echo $ceris_buyer_email;?>" readonly><br>
                            </div>
                            <div class="activation-button-col">
                                <input class="purchase_code_submit ceris-hide-btn" type="submit" value="Active">
                        		<div class="loading-status ceris-hide-btn"><div class="val-ajax-loader"></div></div>
                        		<input class="ceris-deactive-license" type="submit" class="like" value="Deactive" />
                            </div>
                            <?php
                        }else {
                            ?>
                            <div class="purchase-code-col">
                                <label>Purchase Code: </label>
                                <input id="purchase_code_input" type="text" name="purchase_code" placeholder="Type or paste the buyer's purchase code here"><br>
                            </div>
                            <div class="buyer-email-col">
                                <label>Email: <span>(Optional)</span></label>
                                <input id="buyer_email_input" type="text" name="buyer_email_input" placeholder="Type your email here"><br>
                            </div>
                                <div class="activation-button-col">
                                <input class="purchase_code_submit" type="submit" value="Active">
                        		<div class="loading-status ceris-hide-btn"><div class="val-ajax-loader"></div></div>
                        		<input class="ceris-deactive-license ceris-hide-btn" type="submit" class="like" value="Deactive" />
                            </div>
                            <?php
                        }
            		?>
            	</form>
            	
            </div>
            <?php 
                if(!empty($userLicense)) {
                    echo '<div class="envato-purchase-code-information-wrap">'.stripslashes($userLicense).'</div>';
                }else {
                    echo '<div class="envato-purchase-code-information-wrap"></div>';
                }
            ?>
            <div class="introduce clearfix">
                <div class="bk-screenshot">
                    <img src="<?php echo (CERIS_REGISTRATION_PLUGIN_DIR_URL . 'images/item-preview.png');?>"/>
                </div>
            </div>
        </div>
    	
    	<br class="clear"/>
    
    </div>
    
    <?php
    }
}