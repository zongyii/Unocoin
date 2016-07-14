<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	public $tables = array();
	function __construct() {
		parent::__construct();

		// $table['users'] = 'customers';
		// $table['interface_types'] = 'interface_types';
		// $table['interface_units'] = 'interface_units';
		// $table['ai'] = 'ai';
		// $table['tiles'] = 'tiles';
		// $table['analog'] = 'analog_V1';
		// $this->tables  = $table;

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');		
		header('HTTP/1.1 200 OK');
		header('Content-type: application/json');
		
	}

	public function stripe_payment() {
		$this->form_validation->set_rules('cc_number' , 'CC Number' , 'required|numeric');
		$this->form_validation->set_rules('cvc' , 'CVC' , 'required|numeric');
		$this->form_validation->set_rules('exp_month' , 'Exp Month' , 'required|numeric');
		$this->form_validation->set_rules('exp_year' , 'Exp Year' , 'required|numeric');	
		$this->form_validation->set_rules('uid' , 'UID' , 'required|numeric');
		$this->form_validation->set_rules('username' , 'UserName' , 'required');
		$this->form_validation->set_rules('amount' , 'Amount' , 'required|numeric');

		if ($this->form_validation->run() == true) {
			$cc_number = $this->input->post('cc_number');
			$cvc = $this->input->post('cvc');
			$exp_month = $this->input->post('exp_month');
			$exp_year = $this->input->post('exp_year');
			$uid = $this->input->post('uid');
			$username = $this->input->post('username');
			$amount = $this->input->post('amount');

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

			echo json_encode($response);
			exit();			
		} else {
			$response = array('status' => FALSE, 'message' => validation_errors());
			echo json_encode($response);			
			exit();
		}	
	}
}