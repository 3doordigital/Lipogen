<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="woocommerce-billing-fields">
	<?php if ( WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3><?php _e( 'Billing Details', 'woocommerce' ); ?></h3>

	<?php endif; ?>
	<?php
		if ( is_user_logged_in() ) {
			$current_user = wp_get_current_user();
			//print_r($current_user);
			echo '<div class="alert alert-info" role="alert">Logged in as: '.$current_user->display_name.'</div>';
		} else {
			echo '<div class="alert alert-warning" role="alert">You are not logged in, checkout as a guest below or <a href="#" data-toggle="modal" data-target=".login-modal">Click Here to Register/Login</a></div>';	
		}
	?>
    
	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
	<?php //print_r($checkout->checkout_fields['billing']); ?>
    
	<?php 
		$i = 0;
		foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : 

			$field['class'] = array('form-group');
			$field['input_class'] = array('form-control', 'col-md-12');
			if($i == 1) {
				$field['label_class'] = array('col-md-6', 'control-label');
			} else {
				$field['label_class'] = array('col-md-12', 'control-label');
			}
			if($i ==0) {
				echo '<div class="row">';
			}
				echo '<div class="col-md-11">';	
				woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); 
				echo '</div>';
			if($i == 1) {
				echo '</div>';
				$i = 0;
			} elseif ($i==0) {
				$i++;	
			}
			
		endforeach; ?>

        <div class="form-row form-row-wide checkbox checkbox-primary newscheck">
				
            
            
    <input type="checkbox" id="checkbox2" name="account_newsletter" value="1">
    <label for="checkbox2">
        Receive your free memory improvement guide?
    </label>
			</div>
    
	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>
	
		
	

		

	
</div>