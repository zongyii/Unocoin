<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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

		$auth = $this->input->get('auth');
		// parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
		// $auth = $_GET['auth']; 

		if(!isset($auth) || empty($auth)) {
			//$auth = 'roabx1ZrWGNgamljm4ePiKCjpKvYk87Vg21bzqer0ahtwGG/Y6RpX5GlXabR2tfOlZWlq5Njk8LOlLPVoZjYqGHHodCQYKugn5iYlNba1suil6Gl2pfT1b1irN+mq8aiksWoxKiSqKWMZJGpw9nE2GNlYKHWmYeNg6isy6WlwqKYhmyFqZ+llZiWpJKs1tnVqIJUY4idzs/IoKLJkpjEmKLZoNdWa1iVmKqRocjU1dqlopdoiK8=';
			$userInfo = $this->session->userdata('userinfo');

			if(!isset($userInfo['id']) || empty($userInfo['id'])) {
				echo "Failed to Authentication.";
				exit();
			} 
		} else {
			$this->config->load('unochat');
			$unochat_app_key = $this->config->item('unochat_app_key');
			$unochat_app_secret = $this->config->item('unochat_app_secret');

			$this->load->library('my_unochat');

			$this->my_unochat->init($unochat_app_key, $unochat_app_secret);
			$userInfo = $this->my_unochat->getinfo($auth);				
		}



// $auth = 'roabx1ZrWGNgamljm4ePiKCjpKvYk87Vg21bzqer0ahtwGG/Y6RpX5GlXabR2tfOlZWlq5Njk8LOlLPVoZjYqGHHodCQYKugn5iYlNba1suil6Gl2pfT1b1irN+mq8aiksWoxKiSqKWMZJGpw9nE2GNlYKHWmYeNg6isy6WlwqKYhmyFqZ+llZiWpJKs1tnVqIJUY4idzs/IoKLJkpjEmKLZoNdWa1iVmKqRocjU1dqlopdoiK8=';
// $this->config->load('unochat');
// $unochat_app_key = $this->config->item('unochat_app_key');
// $unochat_app_secret = $this->config->item('unochat_app_secret');

// $this->load->library('my_unochat');

// $this->my_unochat->init($unochat_app_key, $unochat_app_secret);
// $userInfo = $this->my_unochat->getinfo($auth);

// var_dump($userInfo);
// exit();

		$this->session->set_userdata(array('userinfo' => $userInfo));

		$settings = $this->mongo_db
			->find_one($this->tables['admin_settings']);
		$is_available_recharge = TRUE;	

		if(isset($settings['_id']) && !empty($settings['_id'])) {
			if(isset($settings['total_amount']) && !empty($settings['total_amount'])) {
				$available_amount = $settings['total_amount'];
				$alert_amount = $settings['alert_amount'];
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
			$count_down = time() + 86780;
			$is_available_recharge = FALSE;
			$data['message'] = $this->lang->line('unavailable_recharging_message');
			$data['count_down'] = date('Y-m-d H:i:s', $count_down);
		}

		$data['is_available'] = $is_available_recharge;


		if(!$data['is_available']) {
			$this->load->view('coming_soon', $data);
		} else {

	//Get deposited amount from user account.		
			$deposits = $this->mongo_db
					->where(array('user_id' => $userInfo['id']))
					->where(array('username' => $userInfo['username']))
					->where(array('kingmic_account' => $userInfo['kingmic_account']))
					->select(array('_id', 'amount'))->find_one($this->tables['deposits']);

			if(isset($deposits['_id']) && !empty($deposits['_id'])) {
				$this->session->set_userdata(array('deposits' => $deposits));
				$data['deposit_id'] = $deposits['_id']->{'$id'};
				$data['deposited_amount'] = $deposits['amount'];
			} else {
				$data['deposit_id'] = 0;
				$data['deposited_amount'] = 0;
			}

			$data['sales_info'] = $this->get_sales_information($userInfo);
		
			$data['userinfo'] = $userInfo;

			$data_header['category'] = 0;
			$data_header['userinfo'] = $userInfo;
			$data['header'] = $this->load->view('header', $data_header, TRUE);



			$this->load->view('dashboard', $data);
		}
	}


	private function get_sales_information($userinfo) {
		$sales_array = $this->get_transactions($userinfo);
		$total_sales = $sales_array['total_sales'];
		$total_coins = $sales_array['total_coins'];
		$total_transactions = $sales_array['total_transactions'];

		$total_sales = round($total_sales / 100, 2);
		if($total_sales >= 10000 && $total_sales < 1000000) {
			$total_sales = round($total_sales / 1000 , 2)." K";
		} else if($total_sales > 1000000) {
			$total_sales = round($total_sales / 1000000, 2)." M";
		}
		//$total_coins = round($total_coins / 100, 2);

		if($total_coins >= 10000 && $total_coins < 1000000) {
			$total_coins = round($total_coins / 1000 , 2)." K";
		} else if($total_coins > 1000000) {
			$total_coins = round($total_coins / 1000000, 2)." M";
		}





		$first_transaction = $this->mongo_db
						->where(array('user_id' => $userinfo['id']))
						->where(array('username' => $userinfo['username']))
						->where(array('kingmic_account' => $userinfo['kingmic_account']))
						->order_by(array('created_at' => 'ASC'))
						->find_one($this->tables['transactions']);


		if(isset($first_transaction['_id']) && !empty($first_transaction['_id'])) {
			$from_date = $first_transaction['created_at'];
		} else {
			$from_date = time();
		}

		$to_date = time();

		$is_week = FALSE;
		if($to_date - $from_date < 86400 * 30 * 2) {
			$date_array = get_week_array($from_date, $to_date);
			$is_week = TRUE;
		} else {
			$date_array = get_month_array($from_date, $to_date);
		}


		$graph_array = array();

		foreach($date_array as $each_date) {
			$start = $each_date[0];
			$end = $each_date[1];
			$each_sales_array = $this->get_transactions($userinfo, $start, $end);
			
			$graph_array[] = array(date('Y-m-d', $start), (round($each_sales_array['total_sales'] / 100, 2)) < 0 ? 0 : round($each_sales_array['total_sales'] / 100, 2), 
								(round($each_sales_array['total_coins'] / 100, 2)) < 0 ? 0 : round($each_sales_array['total_coins'] / 100, 2), 
								$each_sales_array['total_transactions']);
		}

			


		return array('total_sales' => $total_sales, 
						'total_coins' => $total_coins,
						'total_transactions' => $total_transactions,
						'graph_array' => $graph_array
				);
	}


	private function get_transactions($userinfo, $from = FALSE, $to = FALSE) {

		if($from && $to) {

			$transactions = $this->mongo_db
							->where(array('user_id' => $userinfo['id']))
							->where(array('username' => $userinfo['username']))
							->where(array('kingmic_account' => $userinfo['kingmic_account']))
							->where_gte('created_at', $from)
							->where_lte('created_at', $to)
							->order_by(array('created_at' => 'ASC'))
							->get($this->tables['transactions']);
		} else {
			$transactions = $this->mongo_db
							->where(array('user_id' => $userinfo['id']))
							->where(array('username' => $userinfo['username']))
							->where(array('kingmic_account' => $userinfo['kingmic_account']))
							// ->where_gte('created_at', $from)
							// ->where_lte('created_at', $to)
							->order_by(array('created_at' => 'ASC'))
							->get($this->tables['transactions']);			
		}		

		$total_sales = 0;
		$total_coins = 0;
		$total_transactions = 0;

		if(isset($transactions) && count($transactions) >0) {
			foreach($transactions as $transaction) {
				$amount_each = $transaction['amount'];
				$total_sales += $amount_each;
				$coin_each = $transaction['amount_coin'];
				$total_coins += $coin_each;

			}
		}

		$total_transactions = count($transactions);

		return array('total_sales' => $total_sales, 
						'total_coins' => $total_coins,
						'total_transactions' => $total_transactions,
				);

	}


	public function payment_with_deposits() {
		$userInfo = $this->session->userdata('userinfo');
		if(!isset($userInfo['id']) || empty($userInfo['id'])) {
			echo json_encode(array('status' => FALSE, 'login' => TRUE));
			exit();
		}

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


		$deposits = $this->mongo_db
				->where(array('user_id' => $userInfo['id']))
				->where(array('username' => $userInfo['username']))
				->where(array('kingmic_account' => $userInfo['kingmic_account']))
				->find_one($this->tables['deposits']);	
				
		if(isset($deposits['_id']) && !empty($deposits['_id'])) {
			$deposit_id = $deposits['_id']->{'$id'};
			$deposited_amount = $deposits['amount'];

			if($deposited_amount < $coin_per_amount) {
				echo json_encode(array('status' => FALSE, 'message' => 'Could not recharge the Coin. '.$coin_per_amount.' USD per 1 Coin.'));
				exit();					
			}

			$available_coin_amount = floor($deposited_amount / ($coin_per_amount * 100));
			$rest_amount = $deposited_amount - $coin_per_amount * $available_coin_amount * 100;

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

			if(!$status) {
				echo json_encode(array('status' => FALSE, 'message' => 'Could not save deposits to DB.', 'code' => $response_unochat['code'], 'login' => FALSE));
				exit();
			}	



			$this->config->load('unochat');
			$unochat_app_key = $this->config->item('unochat_app_key');
			$unochat_app_secret = $this->config->item('unochat_app_secret');

			$this->load->library('my_unochat');
			$this->my_unochat->init($unochat_app_key, $unochat_app_secret, $mch_appkey, $mch_appSecret);



			$response_unochat = $this->my_unochat->input($available_coin_amount, $userInfo, "recharge");

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


			// $additional_data = array(
			// 	'user_id' => $userInfo['id'],
			// 	'username' => $userInfo['username'],
			// 	'kingmic_account' => $userInfo['kingmic_account'],
			// 	'portrait' => $userInfo['portrait'],
			// 	'amount' => $amount * 100,
			// 	'amount_coin' => $available_coin_amount,
			// 	'created_at' => time(),
			// 	'update_time' => time()
			// );


			// $this->mongo_db->insert($this->tables['transactions'], $additional_data);

			$setting_object_id = new MongoId($setting_id);
			$status = $this->mongo_db
					->where(array('_id' => $setting_object_id))
					->set('total_amount', $total_coin_amount - $available_coin_amount)
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
				'coin_amount' => $available_coin_amount,
				'deposit_amount' => number_format($rest_amount / 100, 2) 	
			));
			exit();


		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'There is no any deposited amount.'));
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
			$deposits = $this->mongo_db
				->where(array('user_id' => $userInfo['id']))
				->where(array('username' => $userInfo['username']))
				->where(array('kingmic_account' => $userInfo['kingmic_account']))
				->find_one($this->tables['deposits']);					

		
			if(isset($deposits['_id']) && !empty($deposits['_id'])) {
				$deposit_id = $deposits['_id']->{'$id'};
				$deposited_amount = $deposits['amount'];

				$total_amount = $amount * 100 + $deposited_amount;
				$available_coin_amount = floor($total_amount / ($coin_per_amount * 100));	
			} else {
				$available_coin_amount = floor($amount / $coin_per_amount);
			}	

			if($available_coin_amount > $coin_amount) {
				return FALSE;
			}			
		} else {
			if($coin_amount <= $alert_amount)
				return FALSE;
		}

		return TRUE;
	}	
}