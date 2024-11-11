(function($) {
  "use strict";
  $=jQuery;
  var $optionRequirement = [];
    
    $( document ).ready( function() {
        var $ajaxSubmitPurchaseCode = $('.purchase_code_submit');
        var $ajaxDeactivatePurchaseCode = $('.ceris-deactive-license');
        /* ============================================================================
	     * AJAX 
	     * ==========================================================================*/
		$ajaxSubmitPurchaseCode.on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            $(this).addClass('ceris-hide-btn');
            $(this).siblings('.loading-status').removeClass('ceris-hide-btn');
            var container   = $(this).closest('.envato-purchase-code-form').siblings('.envato-purchase-code-information-wrap');
            var homeURL     = $(this).closest('form').data("homeurl");
            var isLH        = $(this).closest('form').data("islh");
            var themeID     = $(this).closest('form').data("itemid");
            var dataPurchaseCode = $('#purchase_code_input').val();
            var buyerEmail       = $('#buyer_email_input').val();
            $.ajax({
              url: "https://expthemes.com/verifypurchase/",
              type: 'post',
              dataType: 'text',
              data: {purchase_code: dataPurchaseCode, buyerEmail: buyerEmail, homeURL : homeURL, themeID : themeID, isLH: isLH},
            }).done(function(respond) {
                var checktable = $(respond).find('table');
                if(checktable.length != 0) {
                    var ajaxValidation = {
                        action: 'ceris_validation',
                        type: 'post',
                        dataType: 'text',
                        validateCode: dataPurchaseCode,
                        tableData: respond,
                        buyerEmail: buyerEmail,
                    };
                    $.post(ajaxurl, ajaxValidation, function (response) {
                        $('#purchase_code_input').prop('readonly', true);
                        $('#purchase_code_input').attr('value', dataPurchaseCode);
                        $('#buyer_email_input').prop('readonly', true);
                        $('#buyer_email_input').attr('value', buyerEmail);
                        location.reload();
                    });
                    $this.siblings('.loading-status').addClass('ceris-hide-btn');
                    $this.siblings('.ceris-deactive-license').removeClass('ceris-hide-btn');
                }else {
                    $this.siblings('.loading-status').addClass('ceris-hide-btn');
                    $this.removeClass('ceris-hide-btn');
                }
                container.empty();
                container.append(respond).css('opacity', 0).animate({opacity: 1}, 500);	
            });
		});
		
		$ajaxDeactivatePurchaseCode.on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            $(this).addClass('ceris-hide-btn');
            $(this).siblings('.loading-status').removeClass('ceris-hide-btn');
            var container = $(this).closest('.envato-purchase-code-form').siblings('.envato-purchase-code-information-wrap');
            var homeURL = $(this).closest('form').data("homeurl");
            var dataPurchaseCode = $('#purchase_code_input').val();
            
            $.ajax({
              url: "https://expthemes.com/verifypurchase/deactivate",
              type: 'post',
              dataType: 'text',
              data: {purchase_code: dataPurchaseCode, homeURL : homeURL},
            }).done(function(respond) {
                var ajaxValidation = {
                        action: 'ceris_remove_activation',
                        type: 'post',
                        dataType: 'text',
                    };
                    
                $.post(ajaxurl, ajaxValidation, function (response) {
                    $('#purchase_code_input').prop('readonly', false);
                    $('#purchase_code_input').attr('value', '');
                    $('#buyer_email_input').prop('readonly', false);
                    $('#buyer_email_input').attr('value', '');
                    
                    container.empty();
                    container.append(respond).css('opacity', 0).animate({opacity: 1}, 500);	
                    
                    $this.siblings('.loading-status').addClass('ceris-hide-btn');
                    $this.siblings('.purchase_code_submit').removeClass('ceris-hide-btn');
                    
                    location.reload();
                });
                
            });
		});
    });
    
})(jQuery);
