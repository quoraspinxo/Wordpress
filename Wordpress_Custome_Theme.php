/** WooCommerce Change Text **/
add_filter( 'gettext', function( $translated_text ) {
    if ( 'Quick Checkout' === $translated_text ) {
        $translated_text = 'Download Montage';
    }
    return $translated_text;
} );


/**
 * Custom currency and currency symbol
 */
add_filter( 'woocommerce_currencies', 'add_my_currency' );
function add_my_currency( $currencies ) {
     $currencies['Resource'] = __( 'Resource', 'woocommerce' );
     return $currencies;
}
add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
function add_my_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
		 case 'Resource': $currency_symbol = 'Resource : '; break;
     }
     return $currency_symbol;
}

/**
*   Change Proceed To Checkout Text in WooCommerce
*   Add this code in your active theme functions.php file
**/
function woocommerce_button_proceed_to_checkout() {
	
       $new_checkout_url = WC()->cart->get_checkout_url();
       ?>
       <a href="<?php echo $new_checkout_url; ?>" class="checkout-button button alt wc-forward">
	   
	   <?php _e( 'Download Montage', 'woocommerce' ); ?></a>
	   
<?php
}

add_filter( 'wc_add_to_cart_message_html', 'quadlayers_custom_add_to_cart_message' );
function quadlayers_custom_add_to_cart_message() {
$message = 'Your selected area has been added to cart! Please view your cart and download the montage' ;
return $message;
}

add_filter( 'woocommerce_order_button_text', 'vdr_custom_button_text' );
 
function vdr_custom_button_text( $button_text ) {
	return 'Get Montage'; // new text is here 
}

//Change the 'Billing details' checkout label to 'Contact Information'
function wc_billing_field_strings( $translated_text, $text, $domain ) {
switch ( $translated_text ) {
case 'Billing details' :
$translated_text = __( 'Contact Information', 'woocommerce' );
break;
}
return $translated_text;
}
add_filter( 'gettext', 'wc_billing_field_strings', 20, 3 );

/**Auto Complete all WooCommerce orders.**/
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}

/** Change thank you page **/
add_filter( 'woocommerce_thankyou_order_received_text', 'new_thank_you_subtitle', 40, 2 );

function new_thank_you_subtitle( $thank_you_title, $order ){

	return "Dear " . $order->get_billing_first_name() . ", Thank you for your interest. \r\n Please, reload this page to show the download button!";

}
/** Login Redirect **/
add_filter('wpuf_login_redirect', 'login_redirect');
function login_redirect($redirect){

 $redirect = 'https://investor-area.site/';	//home_url('/account') ;  
return $redirect;
}
