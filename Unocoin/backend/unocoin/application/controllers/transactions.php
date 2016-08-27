<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transactions extends CI_Controller {
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
		$data_header['category'] = 2;
		$data_header['userinfo'] = $userinfo;
		$data['header'] = $this->load->view('header', $data_header, TRUE);

//Get all transactions for this user.

		$data['transactions'] = $this->mongo_db
						->where(array('user_id' => $userinfo['id']))
						->where(array('username' => $userinfo['username']))
						->where(array('kingmic_account' => $userinfo['kingmic_account']))
						->order_by(array('created_at' => 'DESC'))
						->offset(0)
						->limit(5)
						->get($this->tables['transactions']);



		$data['search_offset'] = 5;
		$data['search_limit'] = 5;
		if($is_available_recharge)
			$this->load->view('transactions', $data);
		else 
			$this->load->view('coming_soon', $data);		
	}

	public function search_transactions() {
		$search_limit = $this->input->post('search_limit');
		$search_offset = $this->input->post('search_offset');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');

		if(isset($from_date) && !empty($from_date)) {
			$from = strtotime($from_date);
		} else {
			$from = 0;
		}

		if(isset($to_date) && !empty($to_date)) {
			$to = strtotime($to_date) + 86399;
		} else {
			$to = strtotime(date("Y-m-d", time())) + 86399;
		}
// echo json_encode($to);
// exit();
		if($from > $to) {
			$tmp = $from;
			$from = $to;
			$to = $tmp;
			$from = strtotime(date("Y-m-d", $from));
			$to = strtotime(date("Y-m-d", $to)) + 86399;
		}

// echo json_encode(array(date("Y-m-d", $from), date("Y-m-d", $to)));
// exit();
		
		if(!isset($search_limit) || empty($search_limit) || $search_limit == 0) {
			$search_limit = 5;
		}

		if(!isset($search_offset) || empty($search_offset) || $search_offset == 0) {
			$search_offset = 0;
		}

		$userinfo = $this->session->userdata('userinfo');

		$transactions = $this->mongo_db
						->where(array('user_id' => $userinfo['id']))
						->where(array('username' => $userinfo['username']))
						->where(array('kingmic_account' => $userinfo['kingmic_account']))
						->where_gte('created_at', $from)
						->where_lte('created_at', $to)						
						->order_by(array('created_at' => 'DESC'))
						->offset($search_offset)
						// ->limit($search_limit)
						->get($this->tables['transactions']);

// echo json_encode($transactions);
// exit();

		$transactions = $this->mongo_db
						->where(array('user_id' => $userinfo['id']))
						->where(array('username' => $userinfo['username']))
						->where(array('kingmic_account' => $userinfo['kingmic_account']))
						->where_gte('created_at', $from)
						->where_lte('created_at', $to)						
						->order_by(array('created_at' => 'DESC'))
						->offset($search_offset)
						->limit($search_limit)
						->get($this->tables['transactions']);	
// echo json_encode($transactions);
// exit();
		$transaction_array = array();
						
		if(count($transactions) > 0) {
			foreach($transactions as $transaction) {
				$created_at = $transaction['created_at'];
				$transaction['created_at'] = date('d M Y', $created_at);
				$transaction['created_at_time'] = date('H:i', $created_at);
				$transaction['amount'] = number_format($transaction['amount'] / 100, 2);
				$transaction_array[] = $transaction;
			}
		}
// var_dump($transaction_array);
// exit();
		$data['transactions'] = $transaction_array;
		$data['search_offset'] = $search_offset + 5;
		$data['search_limit'] = $search_limit;
		if(count($data['transactions']) > 0) {
			$data['status'] = TRUE;
		} else {
			$data['status'] = FALSE;
		}

		echo json_encode($data);
		exit();					
	}
}
