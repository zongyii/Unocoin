<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
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
			$this->form_validation->set_rules('mastername', $this->lang->line('signin_username_input'), 'required|xss_clean');
			$this->form_validation->set_rules('password', $this->lang->line('signin_password_input'), 'required');

			if($this->form_validation->run() == TRUE) {
				$remember = false;
				$identity = $this->input->post('mastername');
				$password = $this->input->post('password');


				if($this->ion_auth->login($identity, $password, $remember)) {
					redirect('admin/dashboard');
 				} else {					
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					$data = array();
					$data['mastername'] = array('name' => 'mastername',
												'id' => 'mastername',
												'class' => 'form-control placeholder-no-fix',
												'type' => "text",
												'autocomplete' => "off", 
												'placeholder' => $this->lang->line('signin_master_label', 'english')
					);

					$data['password'] = array('class' => 'form-control placeholder-no-fix',
												'type' => 'password',
												'autocomplete' => 'off',
												'placeholder' => $this->lang->line('signin_password_label', 'english'),
												'name' => "password", 
												'id' => "password"
					);

					$data['message'] = $this->ion_auth->errors();
					$this->load->view('admin/login', $data);


					//redirect('admin/login');
				}

			} else {
				$data = array();
				$data['mastername'] = array('name' => 'mastername',
											'id' => 'mastername',
											'class' => 'form-control placeholder-no-fix',
											'type' => "text",
											'autocomplete' => "off", 
											'placeholder' => $this->lang->line('signin_master_label', 'english')
				);

				$data['password'] = array('class' => 'form-control placeholder-no-fix',
											'type' => 'password',
											'autocomplete' => 'off',
											'placeholder' => $this->lang->line('signin_password_label', 'english'),
											'name' => "password", 
											'id' => "password"
				);

				$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$this->load->view('admin/login', $data);				
			}
		} else {
			redirect('admin/dashboard');
		}


	}


	public function logout($admin = false) {
		$logout = $this->ion_auth->logout();
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('admin/login', 'refresh');
	}	

}