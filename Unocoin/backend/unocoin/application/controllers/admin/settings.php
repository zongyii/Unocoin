<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
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

		$data_left['category'] = 2;	//Category manage page selected.
		$data_left['sub_category'] = 0;	//Sub Category manage page selected.
		$left_view = $this->load->view('admin/left' , $data_left , true);
		$data['left'] = $left_view;
		$admin = $this->ion_auth->user()->row();
		$data_header['admin'] = $admin;
		$data['header'] = $this->load->view('admin/header', $data_header, true);

		$settings = $this->mongo_db
					->find_one($this->tables['admin_settings']);

		if(isset($settings['_id']) && !empty($settings['_id'])) {
			$data['setting_id'] = $settings['_id']->{'$id'};
			$data['stripe_app_key'] = $settings['stripe_app_key'];
			$data['stripe_app_secret'] = $settings['stripe_app_secret'];
			$data['mch_app_key'] = $settings['mch_app_key'];
			$data['mch_app_secret'] = $settings['mch_app_secret'];
			$data['total_amount'] = $settings['total_amount'];
			$data['alert_amount'] = $settings['alert_amount'];
			$data['alert_phone'] = $settings['alert_phone'];
			$data['alert_email'] = $settings['alert_email'];
			$data['coin_per_amount'] = $settings['coin_per_amount'];

		} else {
			$data['setting_id'] = '-1';
		}	
		
		$this->load->view('admin/settings/index', $data);
	}


	public function change_password() {
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

		$this->form_validation->set_rules('old_password', $this->lang->line('users_register_reseller_menu3_f1'), 'required');
		$this->form_validation->set_rules('change_password', $this->lang->line('users_register_reseller_menu3_f2'), 'required|min_length['.$this->config->item('min_password_length', 'ion_auth').']|max_length['.$this->config->item('max_password_length', 'ion_auth').'|matches[change_password_confirm]');
		$this->form_validation->set_rules('change_password_confirm', $this->lang->line('users_register_reseller_menu3_f3'), 'required');
		
// echo json_encode($user);
// exit();		
		if($this->form_validation->run() == false) {
			$message = validation_errors();
			$data['status'] = false;
			$data['message'] = $message;
			echo json_encode($data);
			return FALSE;
		} else {
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $user->{$identity_column};

			//echo json_encode($identity);
			
			$change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('change_password'));
			
			if($change) {
				$message = 'Success';
				$data['status'] = TRUE;
				$data['message'] = $message;
				echo json_encode($data);
				return TRUE;
			} else {
				$message = 'Failed to change password';
				$data['status'] = FALSE;
				$data['message'] = $message;
				echo json_encode($data);
				return FALSE;
			}
						
		}		
	}		


	public function save_privacy_settings() {
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

		$this->form_validation->set_rules('stripe_app_key', $this->lang->line('setting_pricvacy_setting_tab_stripe_app_key_label'), 'required');
		$this->form_validation->set_rules('stripe_app_secret', $this->lang->line('setting_pricvacy_setting_tab_stripe_app_secret_label'), 'required');
		$this->form_validation->set_rules('mch_app_key', $this->lang->line('setting_pricvacy_setting_tab_unochat_merchant_app_key_label'), 'required');
		$this->form_validation->set_rules('mch_app_secret', $this->lang->line('setting_pricvacy_setting_tab_unochat_merchant_app_secret_label'), 'required');


		if($this->form_validation->run() == TRUE) {
			$stripe_app_key = $this->input->post('stripe_app_key');
			$stripe_app_secret = $this->input->post('stripe_app_secret');
			$mch_app_key = $this->input->post('mch_app_key');
			$mch_app_secret = $this->input->post('mch_app_secret');

			$settings = $this->mongo_db
					->find_one($this->tables['admin_settings']);

			if(isset($settings['_id']) && !empty($settings['_id'])) {
				$setting_id = $settings['_id']->{'$id'};

				$object_id = new MongoId($setting_id);

				$status = $this->mongo_db
						->where(array('_id' => $object_id))
						->set('stripe_app_key', $stripe_app_key)
						->set('stripe_app_secret', $stripe_app_secret)
						->set('mch_app_key', $mch_app_key)
						->set('mch_app_secret', $mch_app_secret)
						->update($this->tables['admin_settings']);

				if($status) {
					$message = 'Success';
					$data['status'] = TRUE;
					$data['message'] = $message;
					echo json_encode($data);
					return TRUE;
				} else {
					$message = 'Failed to save information';
					$data['status'] = FALSE;
					$data['message'] = $message;
					echo json_encode($data);
					return FALSE;
				}	 					

			} else {
				$additional_data = array(
					'stripe_app_key' => $stripe_app_key,
					'stripe_app_secret' => $stripe_app_secret,
					'mch_app_key' => $mch_app_key,
					'mch_app_secret' => $mch_app_secret,
					'total_amount' => '',
					'alert_amount' => '',
					'alert_phone' => '',
					'alert_email' => '',
					'coin_per_amount' => ''
				);


				$insert_id = $this->mongo_db->insert($this->tables['admin_settings'], $additional_data);					
				if($insert_id != FALSE) {
					$message = 'Success';
					$data['status'] = TRUE;
					$data['message'] = $message;
					echo json_encode($data);
					return TRUE;
				} else {
					$message = 'Failed to save information';
					$data['status'] = FALSE;
					$data['message'] = $message;
					echo json_encode($data);
					return FALSE;
				}				
			}				
					

		} else {
			$message = validation_errors();
			$data['status'] = false;
			$data['message'] = $message;
			echo json_encode($data);
			return FALSE;			
		}
	}


	public function save_coin_settings() {
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

		$this->form_validation->set_rules('coin_amount', $this->lang->line('setting_coin_setting_tab_coin_amount_label'), 'required|numeric');
		$this->form_validation->set_rules('coin_per_amount', $this->lang->line('setting_coin_setting_tab_usd_amount_per_coin_label'), 'required|numeric');
		$this->form_validation->set_rules('coin_amount_min', $this->lang->line('setting_coin_setting_tab_min_coin_amount_label'), 'required|numeric');
		$this->form_validation->set_rules('phone_number', $this->lang->line('setting_coin_setting_tab_phone_number_notification_label'), 'required');
		$this->form_validation->set_rules('email_address', $this->lang->line('setting_coin_setting_tab_email_notification_label'), 'required');


		if($this->form_validation->run() == TRUE) {
			$coin_amount = $this->input->post('coin_amount');
			$coin_per_amount = $this->input->post('coin_per_amount');
			$coin_amount_min = $this->input->post('coin_amount_min');
			$phone_number = $this->input->post('phone_number');
			$email_address = $this->input->post('email_address');

			$settings = $this->mongo_db
					->find_one($this->tables['admin_settings']);

			if(isset($settings['_id']) && !empty($settings['_id'])) {
				$setting_id = $settings['_id']->{'$id'};

				$object_id = new MongoId($setting_id);



				$status = $this->mongo_db
						->where(array('_id' => $object_id))
						->set('total_amount', $coin_amount)
						->set('coin_per_amount', $coin_per_amount)
						->set('alert_amount', $coin_amount_min)
						->set('alert_phone', $phone_number)
						->set('alert_email', $email_address)
						->update($this->tables['admin_settings']);

				if($status) {
					$message = 'Success';
					$data['status'] = TRUE;
					$data['message'] = $message;
					echo json_encode($data);
					return TRUE;
				} else {
					$message = 'Failed to save information';
					$data['status'] = FALSE;
					$data['message'] = $message;
					echo json_encode($data);
					return FALSE;
				}	 					

			} else {
				$additional_data = array(
					'stripe_app_key' => '',
					'stripe_app_secret' => '',
					'mch_app_key' => '',
					'mch_app_secret' => '',
					'total_amount' => $coin_amount,
					'coin_per_amount' => $coin_per_amount,
					'alert_amount' => $coin_amount_min,
					'alert_phone' => $phone_number,
					'alert_email' => $email_address,
				);


				$insert_id = $this->mongo_db->insert($this->tables['admin_settings'], $additional_data);					
				if($insert_id != FALSE) {
					$message = 'Success';
					$data['status'] = TRUE;
					$data['message'] = $message;
					echo json_encode($data);
					return TRUE;
				} else {
					$message = 'Failed to save information';
					$data['status'] = FALSE;
					$data['message'] = $message;
					echo json_encode($data);
					return FALSE;
				}				
			}			

		} else {
			$message = validation_errors();
			$data['status'] = false;
			$data['message'] = $message;
			echo json_encode($data);
			return FALSE;			
		}

	}
}