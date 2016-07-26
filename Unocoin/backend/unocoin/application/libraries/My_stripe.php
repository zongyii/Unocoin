<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/libraries/vendor/autoload.php';

class My_stripe {
	public function generate_token($cc_number, $cvc, $exp_month, $exp_year) {
		// $stripe_mode = $this->config->item('stripe_mode');
		// if(!isset($stripe_mode)) {
		// 	$stripe_mode = FALSE;
		// }
		// if($stripe_mode) {
		// 	$stripe_public_key = $this->config->item("stripe_live_public_key");
		// 	$stripe_secret_key = $this->config->item("stripe_live_secret_key");
		// } else {
		// 	$stripe_public_key = $this->config->item("stripe_dev_public_key");
		// 	$stripe_secret_key = $this->config->item("stripe_dev_secret_key");
		// }

		$settings = $this->mongo_db->find_one($this->tables['admin_settings']);		
		if(isset($settings['_id']) && !empty($settings['_id'])) {
			$stripe_public_key = $settings['stripe_app_key'];
			$stripe_secret_key = $settings['stripe_app_secret'];

		} else {
			return array('status' => FALSE, 'message' => 'Could not connect to the Stripe account.');
		}



		\Stripe\Stripe::setApiKey($stripe_secret_key);	//Client Secret Key

		try {
			$response = \Stripe\Token::create(array(
				"card" => array(
					"number" => $cc_number,
					"exp_month" => $exp_month,
					"exp_year" => $exp_year,
					"cvc" => $cvc
	  			)
			));

			if(isset($response['id']) && !empty($response['id'])) {
				$status = TRUE;
				$message = $response['id'];
			} else {
				$status = FALSE;
				$message = "Failed to get Token of Card.";
			}
		} catch (Exception $e) {
			$status = FALSE;
			$message = $e->getMessage();
		}

		return array('status' => $status, 'message' => $message);

	}


	public function create_payment($token, $price) {
		try {
			if (!isset($token))
				throw new Exception("The Stripe Token was not generated correctly");
			$response = \Stripe\Charge::create(array("amount" =>  round($price * 100),
										"currency" => "usd",
										"card" => $token));

			if($response['status'] == "succeeded") {
				$status = TRUE;
				$message = 'Success';
			} else {
				$status = FALSE;
				$message = "Failed to create a transaction.";
			}
			
		} catch (Exception $e) {
			$status = FALSE;
			$message = $e->getMessage();
		}

		return array('status' => $status, 'message' => $message);		
	}

}

