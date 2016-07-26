<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	public $tables = array();
	function __construct() {
		parent::__construct();


		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');		
		header('HTTP/1.1 200 OK');
		header('Content-type: application/json');

		$tables['deposits'] = 'deposits';
		$tables['transactions'] = 'transactions';

		$this->tables = $tables;
		
	}


 	public function payment() {
		$this->form_validation->set_rules('app_key' , 'APP Key' , 'required');
		$this->form_validation->set_rules('app_secret' , 'APP Secret' , 'required');
		$this->form_validation->set_rules('mchapp_key' , 'Merchant APP Key' , 'required');
		$this->form_validation->set_rules('mchapp_secret' , 'Merchant APP Secret' , 'required');
		$this->form_validation->set_rules('amount' , 'Amount' , 'required|numeric');
		$this->form_validation->set_rules('auth' , 'Auth' , 'required');

		if ($this->form_validation->run() == true) {
			$app_key = $this->input->post('app_key');
			$app_secret = $this->input->post('app_secret');			
			$mchapp_key = $this->input->post('mchapp_key');
			$mchapp_secret = $this->input->post('mchapp_secret');
			$amount = $this->input->post('amount');
			$auth = $this->input->post('auth');

//Get deposited amount from user account.
			$deposits = $this->mongo_db
					->where(array('app_key' => $app_key))
					->where(array('app_secret' => $app_secret))
					->where(array('mchapp_key' => $mchapp_key))
					->where(array('mchapp_secret' => $mchapp_secret))->select(array('_id', 'amount'))->find_one($this->tables['deposits']);

			
			if(isset($deposits['_id']) && !empty($deposits['_id'])) {
				$deposit_id = $deposits['_id']->{'$id'};
				$deposited_amount = $deposits['amount'];
				if($deposited_amount < $amount) {
					echo json_encode(array('status' => FALSE, 'message' => 'Please recharge your wallet.'));
					exit();					
				}


//This part expect to get User Info from Unochat API 
				$this->load->library('my_unochat');
				$this->my_unochat->init($app_key, $app_secret, $mchapp_key, $mchapp_secret);
				$userInfo = json_decode($this->my_unochat->getinfo($auth), true);

				if(!isset($userInfo['id']) || empty($userInfo['id'])) {
					echo json_encode(array('status' => FALSE, 'message' => 'Could not get the User information.'));
					exit();
				}


				$response = $this->my_unochat->input($amount, $userInfo, "output");

				if(!isset($response['code']) || empty($response['code'])) {
					echo json_encode(array('status' => FALSE, 'message' => 'Web service does not response.'));
					exit();				
				}		                      

				if($response['code'] != 200) {
					echo json_encode(array('status' => FALSE, 'message' => $response['message']));
					exit();				
				}

//Update deposited amount
				$deposited_amount = $deposited_amount - $amount * 100;
				$object_id = new MongoId($deposit_id);

				$this->mongo_db
						->where(array('_id' => $object_id))
						->set('amount', $deposited_amount)
						->set('update_time', time())
						->update($this->tables['deposits']);


//Create a transaction history
				$additional_data = array(
					'deposit_id' => $deposit_id,
					'amount' => $amount,
					'app_key' => $app_key,
					'app_secret' => $app_secret,
					'mchapp_key' => $mchapp_key,
					'mchapp_secret' => $mchapp_secret,
					'created_at' => time(),
					'type' => 0 	//0: Payment,  1: Recharge
				);

				$this->mongo_db->insert($this->tables['transactions'], $additional_data);
	
				//$this->mongo_db

				echo json_encode(array('status' => TRUE, 'code' => $response['code'], 'message' => $response['message']));
				exit();		



			} else {

				// $additional_data = array(
				// 	'app_key' => "sZQIzvkwCI",
				// 	'app_secret' => "2M4g6YBmVR4D8ZzZTdhx",
				// 	'mchapp_key' => "DYvUZZGa4a",
				// 	'mchapp_secret' => "v3scNtmeIYJmfjys8RVA",
				// 	'amount' => 1000000,
				// 	'created_at' => time(),
				// 	'update_time' => time()

				// );

				// $this->mongo_db->insert($this->tables['deposits'], $additional_data);

				echo json_encode(array('status' => FALSE, 'message' => 'Please recharge your wallet.'));
				exit();				
			}
		} else {

		}		
 	}

	public function stripe_payment() {
		$this->form_validation->set_rules('cc_number' , 'CC Number' , 'required|numeric');
		$this->form_validation->set_rules('cvc' , 'CVC' , 'required|numeric');
		$this->form_validation->set_rules('exp_month' , 'Exp Month' , 'required|numeric');
		$this->form_validation->set_rules('exp_year' , 'Exp Year' , 'required|numeric');	
		$this->form_validation->set_rules('app_key' , 'APP Key' , 'required');
		$this->form_validation->set_rules('app_secret' , 'APP Secret' , 'required');
		$this->form_validation->set_rules('mchapp_key' , 'Merchant APP Key' , 'required');
		$this->form_validation->set_rules('mchapp_secret' , 'Merchant APP Secret' , 'required');
		$this->form_validation->set_rules('auth' , 'Auth' , 'required');

		$this->form_validation->set_rules('amount' , 'Amount' , 'required|numeric');

		if ($this->form_validation->run() == true) {
			$cc_number = $this->input->post('cc_number');
			$cvc = $this->input->post('cvc');
			$exp_month = $this->input->post('exp_month');
			$exp_year = $this->input->post('exp_year');
			$amount = $this->input->post('amount');

			$app_key = $this->input->post('app_key');
			$app_secret = $this->input->post('app_secret');			
			$mchapp_key = $this->input->post('mchapp_key');
			$mchapp_secret = $this->input->post('mchapp_secret');
			$auth = $this->input->post('auth');


			$this->load->library('my_stripe');

			// Generate Stripe CC token
			$token_array = $this->my_stripe->generate_token($cc_number, $cvc, $exp_month, $exp_year);
			if(!$token_array['status']) {
				echo json_encode($token_array);
				exit();
			}

			$token = $token_array['message'];

			//Create a transaction of the Stripe Charge
			$response = $this->my_stripe->create_payment($token, $amount);

			if($response['status']) {

				$this->load->library('my_unochat');
				$this->my_unochat->init($app_key, $app_secret, $mchapp_key, $mchapp_secret);
				$userInfo = json_decode($this->my_unochat->getinfo($auth), true);

				if(!isset($userInfo['id']) || empty($userInfo['id'])) {
					echo json_encode(array('status' => FALSE, 'message' => 'Could not get the User information.'));
					exit();
				}


				$response_unochat = $this->my_unochat->input($amount, $userInfo, "recharge");

				if(!isset($response_unochat['code']) || empty($response_unochat['code'])) {
					echo json_encode(array('status' => FALSE, 'message' => 'Web service does not response.', 'code' => $response_unochat['code']));
					exit();				
				}		                      

				if($response_unochat['code'] != 200) {
					echo json_encode(array('status' => FALSE, 'message' => $response_unochat['message'], 'code' => $response_unochat['code']));
					exit();				
				}



//Get deposited amount from user account.
				$deposits = $this->mongo_db
						->where(array('app_key' => $app_key))
						->where(array('app_secret' => $app_secret))
						->where(array('mchapp_key' => $mchapp_key))
						->where(array('mchapp_secret' => $mchapp_secret))->select(array('_id', 'amount'))->find_one($this->tables['deposits']);

				
				if(isset($deposits['_id']) && !empty($deposits['_id'])) {


					$deposit_id = $deposits['_id']->{'$id'};
					$deposited_amount = $deposits['amount'];
					$deposited_amount = $deposited_amount + $amount * 100;
					$object_id = new MongoId($deposit_id);

					$status = $this->mongo_db
							->where(array('_id' => $object_id))
							->set('amount', $deposited_amount)
							->set('update_time', time())
							->update($this->tables['deposits']);

					if($status) {
						$transaction_deposit_id = $deposit_id;
					} else {
						$transaction_deposit_id = FALSE;
					}

				} else {
					$additional_data = array(
						'app_key' => $app_key,
						'app_secret' => $app_secret,
						'mchapp_key' => $mchapp_key,
						'mchapp_secret' => $mchapp_secret,
						'amount' => $amount,
						'created_at' => time(),
						'update_time' => time()
					);

					$insert_id = $this->mongo_db->insert($this->tables['deposits'], $additional_data);					
					if($insert_id != FALSE) {
						$transaction_deposit_id = $insert_id->{'$id'};
					} else {
						$transaction_deposit_id = FALSE;
					}
				}

//Create a transaction history

				if($transaction_deposit_id != FALSE) {
					$additional_data = array(
						'deposit_id' => $transaction_deposit_id,
						'amount' => $amount,
						'app_key' => $app_key,
						'app_secret' => $app_secret,
						'mchapp_key' => $mchapp_key,
						'mchapp_secret' => $mchapp_secret,
						'created_at' => time(),
						'type' => 1 	//0: Payment,  1: Recharge
					);

					$this->mongo_db->insert($this->tables['transactions'], $additional_data);

					echo json_encode(array('status' => TRUE, 'code' => $response_unochat['code'], 'message' => $response_unochat['message']));
					exit();					

				} else {
					echo json_encode(array('status' => FALSE, 'message' => 'Failed to save the amount value to Wallet.'));
					exit();
				}

			}

			
		} else {
			$response = array('status' => FALSE, 'message' => validation_errors());
			echo json_encode($response);			
			exit();
		}	
	}
}