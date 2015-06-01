<?php
	include( $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/lipogen_theme/mailchimp.php' );

	function newsletterregister() {

		$mailchimp = new MailChimp('3a5b2622e44b6f6946b6ab6572c216aa-us10');

		//echo print_r($mailchimp->call('lists/list'), true);

		$args = array(

			'id' => '74953',

			'email' => array(

				'email' => $_POST['news_email']

			),

			'double_optin' => false

		);

		$result = $mailchimp->call('lists/subscribe', $args);

		$output = array();

		if(isset($result['status']) && $result['status'] == 'error') {

			$output['code'] = '1';

			$output['text'] = $result['error'];	

			echo json_encode($output);	

		} else {

			$output['code'] = '2';

			$output['text'] = 'Sucessfully subscribed';	

			echo json_encode($output);	

		}

	}