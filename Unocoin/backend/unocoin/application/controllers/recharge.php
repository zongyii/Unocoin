<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recharge extends CI_Controller {
	public $tables = array();
	function __construct() {
		parent::__construct();
		$tables['deposits'] = 'deposits';
		$tables['transactions'] = 'transactions';
		$tables['admin_settings'] = 'admin_settings';

		$this->tables = $tables;
		date_default_timezone_set('Asia/Shanghai');
	}

	public function index() {
		$userinfo = $this->session->userdata('userinfo');

		if(!isset($userinfo['id']) || empty($userinfo['id'])) {
			redirect('dashboard', 'refresh');
		}


		$settings = $this->mongo_db
			->find_one($this->tables['admin_settings']);
		$is_available_recharge = TRUE;	

		if(isset($settings['_id']) && !empty($settings['_id'])) {
			if(isset($settings['total_amount']) && !empty($settings['total_amount'])) {
				$available_amount = $settings['total_amount'];
				$alert_amount = $settings['alert_amount'];
				$coin_per_amount = $settings['coin_per_amount'];
				if(isset($settings['count_down']) && !empty($settings['count_down'])) {
					$count_down = $settings['count_down'];
				} else {
					$count_down = time() + 86780;
				}
				if($available_amount <= $alert_amount) {
					$is_available_recharge = FALSE;
					$data['message'] = $this->lang->line('alert_coin_amount_message');
					$data['count_down'] = date('Y-m-d H:i:s', $count_down);
				}
			} else {
				$is_available_recharge = FALSE;
				$data['message'] = $this->lang->line('alert_coin_amount_message');
				$data['count_down'] = date('Y-m-d H:i:s', $count_down);
			}
		} else {
			$is_available_recharge = FALSE;
			$data['message'] = $this->lang->line('unavailable_recharging_message');
			$data['count_down'] = date('Y-m-d H:i:s', $count_down);
		}

		$data['is_available'] = $is_available_recharge;

		$data['userinfo'] = $userinfo;
		$data_header['category'] = 1;
		$data_header['userinfo'] = $userinfo;
		$data['header'] = $this->load->view('header', $data_header, TRUE);
		$data['coin_per_amount'] = $coin_per_amount;

		if($is_available_recharge)
			$this->load->view('recharge', $data);
		else 
			$this->load->view('coming_soon', $data);
	}



	public function payment() {
		$userInfo = $this->session->userdata('userinfo');
		if(!isset($userInfo['id']) || empty($userInfo['id'])) {
			echo json_encode(array('status' => FALSE, 'login' => TRUE));
			exit();
		}

		$this->form_validation->set_rules('cc_number' , 'CC Number' , 'required|numeric');
		$this->form_validation->set_rules('cvc' , 'CVC' , 'required|numeric');
		$this->form_validation->set_rules('exp_month' , 'Exp Month' , 'required|numeric');
		$this->form_validation->set_rules('exp_year' , 'Exp Year' , 'required|numeric');	
		$this->form_validation->set_rules('amount' , 'Amount' , 'required|numeric');

		if ($this->form_validation->run() == true) {
			$cc_number = $this->input->post('cc_number');
			$cvc = $this->input->post('cvc');
			$exp_month = $this->input->post('exp_month');
			$exp_year = $this->input->post('exp_year');
			$amount = $this->input->post('amount');

			$coin_status = $this->get_coin_status($userInfo, $amount);

			if(!$coin_status) {
				echo json_encode(array('status' => FALSE, 'message' => $this->lang->line('alert_coin_amount_message')));
				exit();				
			}


			$settings = $this->mongo_db
				->find_one($this->tables['admin_settings']);

			if(isset($settings['_id']) && !empty($settings['_id'])) {
				if(isset($settings['coin_per_amount']) && !empty($settings['coin_per_amount'])) {
					$coin_per_amount = $settings['coin_per_amount'];
				} else {
						echo json_encode(array('status' => FALSE, 'message' => 'Could not find coin settings.', 'login' => FALSE));
						exit();						
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'Could not find coin settings.', 'login' => FALSE));
				exit();					
			}


			$real_amount = $amount * $coin_per_amount;



//Make the CC payment via Stripe
			$this->load->library('my_stripe');
			$settings = $this->mongo_db->find_one($this->tables['admin_settings']);
				
			if(isset($settings['_id']) && !empty($settings['_id'])) {
				$stripe_public_key = $settings['stripe_app_key'];
				$stripe_secret_key = $settings['stripe_app_secret'];

			} else {
				return array('status' => FALSE, 'message' => 'Could not connect to the Stripe account.');
			}

			// Generate Stripe CC token
			$token_array = $this->my_stripe->generate_token($cc_number, $cvc, $exp_month, $exp_year, $stripe_public_key, $stripe_secret_key);
		
			if(!$token_array['status']) {
				echo json_encode($token_array);
				exit();
			}

			$token = $token_array['message'];

			//Create a transaction of the Stripe Charge
			$response = $this->my_stripe->create_payment($token, $real_amount);


/*
$response['status'] = TRUE;
$response['message'] = "Suceess";
*/

			if($response['status']) {
				//Get the USD amount per a coin				
				$settings = $this->mongo_db
					->find_one($this->tables['admin_settings']);

				if(isset($settings['_id']) && !empty($settings['_id'])) {
					if(isset($settings['coin_per_amount']) && !empty($settings['coin_per_amount'])) {
						$setting_id = $settings['_id']->{'$id'};
						$coin_per_amount = $settings['coin_per_amount'];
						$mch_appkey = $settings['mch_app_key'];
						$mch_appSecret = $settings['mch_app_secret'];
						$total_coin_amount = $settings['total_amount'];
						$admin_phone_number = $settings['alert_phone'];
						$admin_email = $settings['alert_email'];
					} else {
						echo json_encode(array('status' => FALSE, 'message' => 'Could not find coin settings.', 'login' => FALSE));
						exit();						
					}
				} else {
					echo json_encode(array('status' => FALSE, 'message' => 'Could not find coin settings.', 'login' => FALSE));
					exit();					
				}


/*
				//Save Deposits to DB					
				$deposits = $this->mongo_db
						->where(array('user_id' => $userInfo['id']))
						->where(array('username' => $userInfo['username']))
						->where(array('kingmic_account' => $userInfo['kingmic_account']))
						->find_one($this->tables['deposits']);					


				if(isset($deposits['_id']) && !empty($deposits['_id'])) {
					$deposit_id = $deposits['_id']->{'$id'};
					$deposited_amount = $deposits['amount'];

					$total_amount = $amount * 100 + $deposited_amount;

					//Calculate the available amount of coin 
					$available_coin_amount = floor($total_amount / ($coin_per_amount * 100));
					$rest_amount = $total_amount - $coin_per_amount * $available_coin_amount * 100;

					
					$status = TRUE;
					if($rest_amount > 0) {

						$object_id = new MongoId($deposit_id);
						//$deposited_amount = $deposited_amount + $rest_amount;


						$status = $this->mongo_db
								->where(array('_id' => $object_id))
								->set('amount', $rest_amount)
								->set('update_time', time())
								->update($this->tables['deposits']);
					} else {
						$object_id = new MongoId($deposit_id);
						//$deposited_amount = $deposited_amount + $rest_amount;


						$status = $this->mongo_db
								->where(array('_id' => $object_id))
								->set('amount', 0)
								->set('update_time', time())
								->update($this->tables['deposits']);						
					}	


				} else {
					//Calculate the available amount of coin 
					$available_coin_amount = floor($amount / $coin_per_amount);
					$rest_amount = ($amount - $coin_per_amount * $available_coin_amount) * 100;

					$additional_data = array(
						'user_id' => $userInfo['id'],
						'username' => $userInfo['username'],
						'kingmic_account' => $userInfo['kingmic_account'],
						'amount' => $rest_amount,
						'created_at' => time(),
						'update_time' => time()
					);

					$status = $this->mongo_db->insert($this->tables['deposits'], $additional_data);
				}


				if(!$status) {
					echo json_encode(array('status' => FALSE, 'message' => 'Could not save deposits to DB.', 'code' => $response_unochat['code'], 'login' => FALSE));
					exit();
				}
*/
				
				$this->config->load('unochat');
				$unochat_app_key = $this->config->item('unochat_app_key');
				$unochat_app_secret = $this->config->item('unochat_app_secret');

				$this->load->library('my_unochat');
				$this->my_unochat->init($unochat_app_key, $unochat_app_secret, $mch_appkey, $mch_appSecret);



				//$response_unochat = $this->my_unochat->input($available_coin_amount, $userInfo, "recharge");
				$response_unochat = $this->my_unochat->input($amount, $userInfo, "recharge");

/*
$response_unochat = array('code' => 200, 'message' => "111");
*/



				if(!isset($response_unochat['code']) || empty($response_unochat['code'])) {
					echo json_encode(array('status' => FALSE, 'message' => 'Web service does not response.', 'code' => $response_unochat['code'], 'login' => FALSE));
					exit();				
				}		                      

				if($response_unochat['code'] != 200) {
					echo json_encode(array('status' => FALSE, 'message' => $response_unochat['message'], 'code' => $response_unochat['code'], 'login' => FALSE));
					exit();				
				}


				$additional_data = array(
					'user_id' => $userInfo['id'],
					'username' => $userInfo['username'],
					'kingmic_account' => $userInfo['kingmic_account'],
					'portrait' => $userInfo['portrait'],
					'amount' => $amount * $coin_per_amount * 100,
					'amount_coin' => $amount,
					'created_at' => time(),
					'update_time' => time(),
					'type' => 0 	//0: Payment,  1: Recharge
				);


				$this->mongo_db->insert($this->tables['transactions'], $additional_data);

				$setting_object_id = new MongoId($setting_id);


				$status = $this->mongo_db
						->where(array('_id' => $setting_object_id))
						->set('total_amount', $total_coin_amount - $amount)
						->set('update_time', time())
						->update($this->tables['admin_settings']);



				$coin_status = $this->get_coin_status($userInfo);


				if(!$coin_status) {
					//Send SMS and email to Administrator
					//Set the Count Down of admin_settings table
					$this->send_sms_to_add_coin($admin_phone_number);
					$this->send_email_to_add_coin($admin_email);

					$count_down = time() + 86400;

					$setting_object_id = new MongoId($setting_id);
					$status = $this->mongo_db
							->where(array('_id' => $setting_object_id))
							->set('count_down', $count_down)
							->set('update_time', time())
							->update($this->tables['admin_settings']);	
				}

				echo json_encode(array(
					'status' => TRUE, 
					'code' => $response_unochat['code'], 
					'message' => $response_unochat['message'],
					'coin_amount' => $amount,
					//'deposit_amount' => number_format($rest_amount / 100, 2) 	
				));
				exit();					

			} else {
				$response['login'] = FALSE;
				echo json_encode($response);
				exit();
			}			

		} else {
			$response = array('status' => FALSE, 'message' => validation_errors(), 'login' => FALSE);
			echo json_encode($response);			
			exit();			
		}
	}


	private function send_sms_to_add_coin($phonenumber) {
		$this->load->library('twilio');
		$sms_string = $this->lang->line('alert_sms_email_message');
		$this->load->config('twilio', TRUE);
		$from = $this->config->item('from_phone_number', 'twilio');		
					
		try {
				$message = $this->twilio->sendSMS($from, $phonenumber, $sms_string);
				$response = array();

				if($message->error_code === null) {
					return TRUE;
				} else {
					return FALSE;
				}

			} catch(Services_Twilio_RestException $e) {
				$response_message = $e->getMessage(); 
				return FALSE;
			}
	}


	public function send_email_to_add_coin($email) {
		$subject = $this->lang->line('alert_sms_email_subject');
		$contents = $this->lang->line('alert_sms_email_message');
		$data_email = array('subject' => $subject, 'contents' => $contents);
		$html_contents = $this->load->view('emails/admin_default_email', $data_email, TRUE);

		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		$this->email->from('unocoin@unochat.com', '');
		$this->email->to($email); 
		$this->email->subject($subject);
		$this->email->message($html_contents);
		$this->email->send();		

		return TRUE;
	}



	private function get_coin_status($userInfo, $amount = 0) {
		$settings = $this->mongo_db
			->find_one($this->tables['admin_settings']);

		if(isset($settings['_id']) && !empty($settings['_id'])) {
			if(isset($settings['coin_per_amount']) && !empty($settings['coin_per_amount'])) {
				$coin_per_amount = $settings['coin_per_amount'];
				$coin_amount = $settings['total_amount'];
				$alert_amount = $settings['alert_amount']; 
			} else {
				return FALSE;
			}
		} else {
			return FALSE;					
		}

		if($amount > 0) {
			if($amount > $coin_amount) {
				return FALSE;
			}			
		} else {
			if($coin_amount <= $alert_amount)
				return FALSE;
		}

		return TRUE;
	}



	// private function get_coin_status($userInfo, $amount = 0) {
	// 	$settings = $this->mongo_db
	// 		->find_one($this->tables['admin_settings']);

	// 	if(isset($settings['_id']) && !empty($settings['_id'])) {
	// 		if(isset($settings['coin_per_amount']) && !empty($settings['coin_per_amount'])) {
	// 			$coin_per_amount = $settings['coin_per_amount'];
	// 			$coin_amount = $settings['total_amount'];
	// 			$alert_amount = $settings['alert_amount']; 
	// 		} else {
	// 			return FALSE;
	// 		}
	// 	} else {
	// 		return FALSE;					
	// 	}

	// 	if($amount > 0) {
	// 		$deposits = $this->mongo_db
	// 			->where(array('user_id' => $userInfo['id']))
	// 			->where(array('username' => $userInfo['username']))
	// 			->where(array('kingmic_account' => $userInfo['kingmic_account']))
	// 			->find_one($this->tables['deposits']);					

		
	// 		if(isset($deposits['_id']) && !empty($deposits['_id'])) {
	// 			$deposit_id = $deposits['_id']->{'$id'};
	// 			$deposited_amount = $deposits['amount'];

	// 			$total_amount = $amount * 100 + $deposited_amount;
	// 			$available_coin_amount = floor($total_amount / ($coin_per_amount * 100));	
	// 		} else {
	// 			$available_coin_amount = floor($amount / $coin_per_amount);
	// 		}	

	// 		if($available_coin_amount > $coin_amount) {
	// 			return FALSE;
	// 		}			
	// 	} else {
	// 		if($coin_amount <= $alert_amount)
	// 			return FALSE;
	// 	}

	// 	return TRUE;
	// }
}
