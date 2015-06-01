<?php
/*
Plugin Name: Great Falls CSV Export	
Description: Extends WooCommerce (v2.1.1) to Export Orders
Version: 2.01
Plugin URI:
Author: Dan Taylor	
Author URI: http://www.3doordigital.com
License: Under GPL2   

*/

//define('WP_USE_THEMES', false);
//require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php');

add_action('init', 'process_post');

function process_post(){
 	if(isset($_GET['run_gf_export']) && $_GET['run_gf_export'] ==1 ) {
			require('great_falls.php');
			require_once('class-wc-api-client.php');
			
			$consumer_key = 'ck_fb5621d2f30f84033291c7d226413fd7'; // Add your own Consumer Key here
			$consumer_secret = 'cs_52b3c5093ea6ec7d79caefd627c28cc5'; // Add your own Consumer Secret here
			$store_url = 'http://lipogen.3doordigital.com/'; // Add the home URL to the store you want to connect to here
			
			// Initialize the class
			$wc_api = new WC_API_Client( $consumer_key, $consumer_secret, $store_url );
			$date = date('Y-m-d', strtotime(' -1 day'));
			//$date = date("Y-m-d");
			//$date = '2014-12-15';
			$orders = $wc_api->get_orders( array( 'status' => 'processing', 'filter[created_at_min]' => $date.'T00:00:00', 'filter[created_at_max]' => $date.'T23:59:59' ) );
				// Output the order object retrieved from the API
            //echo '<pre>'.print_r($orders, true).'</pre>';
			$csv = array();
			$csv[] = array(
				'Web Order Number', 
				'Date Ordered', 
				'Billing First Name', 
				'Billing Last Name', 
				'Billing Address 1', 
				'Billing Address 2', 
				'Billing City', 
				'Billing State', 
				'Billing Zip', 
				'Billing Country', 
				'Phone', 
				'Email', 
				'Shipping First Name', 
				'Shipping Last Name', 
				'Shipping Address 1', 
				'Shipping Address 2', 
				'Shipping City', 
				'Shipping State', 
				'Shipping Zip', 
				'Shipping Country', 
				'Order Shipping Total', 
				'Order Tax Total', 
				'Order Total', 
				'Payment Method', 
				'Card Holder\'s Name', 
				'Credit Card Number', 
				'Credit Card Expiration', 
				'CSV', 
				'Credit Card Type', 
				'Amount Captured', 
				'Transaction ID', 
				'Bank Name', 
				'Routing Number', 
				'Account Number', 
				'Account Type', 
				'Check Number', 
				'Processed Date', 
				'Date Shipped', 
				'Carrier', 
				'Tracking Number', 
				'Order Notes', 
				'Item Code 1', 
				'Item Qty 1', 
				'Item Price 1', 
				'Item Code 2', 
				'Item Qty 2', 
				'Item Price 2', 
				'Item Code 3', 
				'Item Qty 3', 
				'Item Price 3', 
				'Item Code 4', 
				'Item Qty 4', 
				'Item Price 4', 
				'Item Code 5', 
				'Item Qty 5', 
				'Item Price 5', 
				'Item Code 6', 
				'Item Qty 6', 
				'Item Price 6', 
				'Item Code 7', 
				'Item Qty 7', 
				'Item Price 7', 
				'Item Code 8', 
				'Item Qty 8', 
				'Item Price 8', 
				'Item Code 9', 
				'Item Qty 9', 
				'Item Price 9', 
				'Item Code 10', 
				'Item Qty 10', 
				'Item Price 10', 
				'Continuity Program', 
				'Newsletter', 
				'Custom 3', 
				'Custom 4', 
				'Custom 5'
			);
			
			foreach($orders as $orders2) {
				foreach($orders2 as $order) {
					//echo '<pre>'.print_r($order, true).'</pre>';
					//$order = $order[0];
					$cardnum = get_post_meta( $order->id, '_card_number', true);
					$cardexpiry = get_post_meta( $order->id, '_card_expiry', true);
					$cardcvv = get_post_meta( $order->id, '_card_cvv', true);
					$transid = get_post_meta( $order->id, '_transaction_id', true);
					$cont = get_post_meta( $order->id, '_account_continuity', true);
					$news = get_post_meta( $order->id, '_account_newsletter', true);
					
					//echo '<pre>'.print_r($order, true).'</pre>';
					$csv[] = array(
						$order->id, 
						$order->created_at, 
						$order->billing_address->first_name, 
						$order->billing_address->last_name, 
						$order->billing_address->address_1, 
						$order->billing_address->address_2, 
						$order->billing_address->city, 
						$order->billing_address->state, 
						$order->billing_address->postcode, 
						'US', 
						$order->billing_address->phone, 
						$order->billing_address->email, 
						$order->shipping_address->first_name, 
						$order->shipping_address->last_name, 
						$order->shipping_address->address_1, 
						$order->shipping_address->address_2, 
						$order->shipping_address->city, 
						$order->shipping_address->state, 
						$order->shipping_address->postcode, 
						'US', 
						$order->total_shipping, 
						$order->tax_total, 
						$order->total, 
						$order->payment_details->method_title, 
						$order->billing_address->first_name.' '.$order->billing_address->last_name, 
						$cardnum, 
						$cardexpiry, 
						$cardcvv, 
						'', 
						$order->total, 
						$transid, 
						'', 
						'', 
						'', 
						'', 
						'', 
						$order->completed_at, 
						'', 
						'', 
						'', 
						$order->note, 
						(isset($order->line_items[0]) ? $order->line_items[0]->sku : ''), 
						(isset($order->line_items[0]) ? $order->line_items[0]->quantity : ''), 
						(isset($order->line_items[0]) ? $order->line_items[0]->price : ''),
						(isset($order->line_items[1]) ? $order->line_items[1]->sku : ''), 
						(isset($order->line_items[1]) ? $order->line_items[1]->quantity : ''), 
						(isset($order->line_items[1]) ? $order->line_items[1]->price : ''),
						(isset($order->line_items[2]) ? $order->line_items[2]->sku : ''), 
						(isset($order->line_items[2]) ? $order->line_items[2]->quantity : ''), 
						(isset($order->line_items[2]) ? $order->line_items[2]->price : ''), 
						(isset($order->line_items[3]) ? $order->line_items[3]->sku : ''), 
						(isset($order->line_items[3]) ? $order->line_items[3]->quantity : ''), 
						(isset($order->line_items[3]) ? $order->line_items[3]->price : ''), 
						(isset($order->line_items[4]) ? $order->line_items[4]->sku : ''), 
						(isset($order->line_items[4]) ? $order->line_items[4]->quantity : ''), 
						(isset($order->line_items[4]) ? $order->line_items[4]->price : ''), 
						(isset($order->line_items[5]) ? $order->line_items[5]->sku : ''), 
						(isset($order->line_items[5]) ? $order->line_items[5]->quantity : ''), 
						(isset($order->line_items[5]) ? $order->line_items[5]->price : ''), 
						(isset($order->line_items[6]) ? $order->line_items[6]->sku : ''), 
						(isset($order->line_items[6]) ? $order->line_items[6]->quantity : ''), 
						(isset($order->line_items[6]) ? $order->line_items[6]->price : ''),  
						(isset($order->line_items[7]) ? $order->line_items[7]->sku : ''), 
						(isset($order->line_items[7]) ? $order->line_items[7]->quantity : ''), 
						(isset($order->line_items[7]) ? $order->line_items[7]->price : ''),  
						(isset($order->line_items[8]) ? $order->line_items[8]->sku : ''), 
						(isset($order->line_items[8]) ? $order->line_items[8]->quantity : ''), 
						(isset($order->line_items[8]) ? $order->line_items[8]->price : ''), 
						(isset($order->line_items[9]) ? $order->line_items[9]->sku : ''), 
						(isset($order->line_items[9]) ? $order->line_items[9]->quantity : ''), 
						(isset($order->line_items[9]) ? $order->line_items[9]->price : ''),  
						($cont == 1 ? 'Yes' : 'No'), 
						($news == 1 ? 'Yes' : 'No'), 
						'', 
						'', 
						''
					);	
				}
			}
            //echo '<pre>'.print_r($csv, true).'</pre>';
			//mkdir($_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/exportcsv/", 0777, true);
			$cdate = date('Y-m-d');
			$filename = $cdate."-lipogen-orders.csv";
			$filenameenc = $cdate."-lipogen-orders-encoded.csv";
			$fileloc = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/exportcsv/".$filename;
			$newloc = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/exportcsv/".$filenameenc;
			$file = fopen($fileloc,"w");
			
			foreach ($csv as $line) {
				
				fputcsv($file,$line);
			}
			
			fclose($file); 
			$username = 'LipogenWeb';
			$password = 'mRFa9cT2u8iPaIMw';
			$server = '66.186.178.129';
			
			//$upload = new GreatFalls;
			//echo $test->test();
			//$upload->upload($fileloc, $filename);
			$ftp = new FTP_Implicit_SSL($username, $password, $server, 990);
			$ftp->encode($fileloc, $newloc);
			$ftp->upload($filenameenc, $newloc);
			
			//echo '<pre>'.print_r($csv, true).'</pre>';
 
	} 
}
