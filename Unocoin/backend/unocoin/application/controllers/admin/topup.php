<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topup extends CI_Controller {
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
		if(!$this->ion_auth->logged_in()) {
			redirect('admin/login', 'refresh');
		}

		if(!$this->ion_auth->is_admin()) {
			redirect('admin/login', 'refresh');
		}

		$data_left['category'] = 3;	//Category manage page selected.
		$data_left['sub_category'] = 0;	//Sub Category manage page selected.
		$left_view = $this->load->view('admin/left' , $data_left , true);
		$data['left'] = $left_view;
		$admin = $this->ion_auth->user()->row();
		$data_header['admin'] = $admin;
		$data['header'] = $this->load->view('admin/header', $data_header, true);


		$this->load->view('admin/topup/index', $data);

	}


	public function create_transaction() {
		if(!$this->ion_auth->logged_in()) {
			$data = array();
			$data['status'] = FALSE;
			$data['login'] = TRUE;
			$data['message'] = $this->lang->line('common_login_prompt_message');
			echo json_encode($data);			
		}

		if(!$this->ion_auth->is_admin()) {
			$data = array();
			$data['status'] = FALSE;
			$data['login'] = TRUE;
			$data['message'] = $this->lang->line('common_admin_login_prompt_message');
			echo json_encode($data);
		}

		$user = $this->ion_auth->user()->row();

		$this->form_validation->set_rules('amount', $this->lang->line('topup_amount_label'), 'required');
		$this->form_validation->set_rules('uid', $this->lang->line('topup_unochat_uid_label'), 'required');
		$this->form_validation->set_rules('account_name', $this->lang->line('topup_unochat_id_label'), 'required');
		$this->form_validation->set_rules('dynamic_code', $this->lang->line('topup_dynamic_code_label'), 'required');

		if($this->form_validation->run() == TRUE) {
			$amount = $this->input->post('amount');
			$uid = $this->input->post('uid');
			$account_name = $this->input->post('account_name');
			$dynamic_code = $this->input->post('dynamic_code');
			$remarks = $this->input->post('remarks');

			$settings = $this->mongo_db
				->find_one($this->tables['admin_settings']);

			if(isset($settings['_id']) && !empty($settings['_id'])) {
				$setting_id = $settings['_id']->{'$id'};
				$coin_per_amount = $settings['coin_per_amount'];
				$mch_appkey = $settings['mch_app_key'];
				$mch_appSecret = $settings['mch_app_secret'];
				$total_coin_amount = $settings['total_amount'];
				$admin_phone_number = $settings['alert_phone'];
				$admin_email = $settings['alert_email'];

				$this->config->load('unochat');
				$unochat_app_key = $this->config->item('unochat_app_key');
				$unochat_app_secret = $this->config->item('unochat_app_secret');

				$this->load->library('my_unochat');
				$this->my_unochat->init($unochat_app_key, $unochat_app_secret, $mch_appkey, $mch_appSecret);

				$userInfo = array('id' => $uid, 'kingmic_account' => $account_name);

				$response_unochat = $this->my_unochat->input($amount, $userInfo, "input", $dynamic_code, $remarks);
//$response_unochat = $this->my_unochat->input($amount, $userInfo, "recharge");
// echo json_encode($response_unochat);
// exit();


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
					'username' => 'admin',
					'kingmic_account' => $userInfo['kingmic_account'],
					'portrait' => '',
					'amount' => $amount * $coin_per_amount * 100,
					'amount_coin' => $amount,
					'created_at' => time(),
					'update_time' => time(),
					'type' => 1 	//1: Payment,  0: Recharge
				);


				$this->mongo_db->insert($this->tables['transactions'], $additional_data);

				$setting_object_id = new MongoId($setting_id);


				$status = $this->mongo_db
						->where(array('_id' => $setting_object_id))
						->set('total_amount', $total_coin_amount + $amount)
						->set('update_time', time())
						->update($this->tables['admin_settings']);

				echo json_encode(array(
					'status' => TRUE, 
					'code' => $response_unochat['code'], 
					'message' => $response_unochat['message'],
					'coin_amount' => $total_coin_amount + $amount,
				));
				exit();

			} else {
				$message = 'Could not read Admin Settings data.';
				$data['status'] = FALSE;
				$data['message'] = $message;
				echo json_encode($data);
				exit();				
			}


		} else {
			$message = validation_errors();
			$data['status'] = FALSE;
			$data['message'] = $message;
			echo json_encode($data);
			exit();			
		}



	}


}