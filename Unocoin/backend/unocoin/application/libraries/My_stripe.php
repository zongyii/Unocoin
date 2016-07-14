<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/libraries/vendor/autoload.php';

class My_stripe {
	public function generate_token($cc_number, $cvc, $exp_month, $exp_year) {
		\Stripe\Stripe::setApiKey("sk_test_XeXKEMY62hqQkpDN4VJYb3b2");	//Client Secret Key

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

