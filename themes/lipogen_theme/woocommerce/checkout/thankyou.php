<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

        <div class="dv-order-warning-wrapper">
            <p class="p-bottom-space"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?></p>

            <p class="p-bottom-space"><?php
                if ( is_user_logged_in() )
                    _e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );
                else
                    _e( 'Please attempt your purchase again.', 'woocommerce' );
            ?></p>

            <p>
                <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
                <?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
                <?php endif; ?>
            </p>
        </div>

	<?php else : ?>
		<?php $fields = get_post_meta( $order->id); ?>
        <?php
            $output = '<iframe src="https://t.pepperjamnetwork.com/track?';
            $output .="PID=7121";
            $output .="&AMOUNT=".$fields['_order_total'][0];
            $output .="&TYPE=1";
            $output .="&OID=$order->id";
            $output .='" width="1" height="1" frameborder="0"></iframe>';
            echo $output;
        ?>

        <div class="dv-order-details-wrapper">
            <p class="p-bottom-space"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Your order was taken successfully!', 'woocommerce' ), $order ); ?></p>

            <div class="row">
                <div class="col-sm-8 dv-order-title">
                    <?php _e( 'Order Number:', 'woocommerce' ); ?>
                </div>
                <div class="col-sm-16">
                    <?php echo $order->get_order_number(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 dv-order-title">
                    <?php _e( 'Date:', 'woocommerce' ); ?>
                </div>
                <div class="col-sm-16">
                    <?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 dv-order-title">
                    <?php _e( 'Total:', 'woocommerce' ); ?>
                </div>
                <div class="col-sm-16">
                    <?php echo $order->get_formatted_order_total(); ?>
                </div>
            </div>
            <?php if ( $order->payment_method_title ) : ?>
                <div class="row">
                    <div class="col-sm-8 dv-order-title">
                        <?php _e( 'Payment method:', 'woocommerce' ); ?>
                    </div>
                    <div class="col-sm-16">
                        <?php echo $order->payment_method_title; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <p style="padding-top: 30px;">Thanks for becoming a Lipogen customer. A purchase confirmation email has been sent to your email address. If you have any questions concerning your purchase or our product/s please see our <a href="/frequently-asked-questions/">FAQs</a> section or <a href="/about-us/contact-us/">contact us directly</a>.</p>
		<div class="clear"></div>
        
	<?php endif; ?>

	<?php //do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php //do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>
    <div class="dv-order-details-wrapper">
	    <p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>
    </div>
<?php endif; ?>