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
		if(!$this->ion_auth->logged_in()) {
			redirect('admin/login', 'refresh');
		}

		if(!$this->ion_auth->is_admin()) {
			redirect('admin/login', 'refresh');
		}

		$data_left['category'] = 1;	//Category manage page selected.
		$data_left['sub_category'] = 0;	//Sub Category manage page selected.
		$left_view = $this->load->view('admin/left' , $data_left , true);
		$data['left'] = $left_view;
		$admin = $this->ion_auth->user()->row();
		$data_header['admin'] = $admin;
		$data['header'] = $this->load->view('admin/header', $data_header, true);

		$data['transactions'] = $this->mongo_db
						// ->where(array('user_id' => $userinfo['id']))
						// ->where(array('username' => $userinfo['username']))
						// ->where(array('kingmic_account' => $userinfo['kingmic_account']))
						->order_by(array('created_at' => 'DESC'))
						->get($this->tables['transactions']);		
		
		$this->load->view('admin/transactions/index', $data);		
	}

}