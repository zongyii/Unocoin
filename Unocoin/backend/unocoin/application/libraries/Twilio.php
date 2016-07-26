<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/libraries/TwilioSDK/Services/Twilio.php';

class Twilio
{
	protected $_ci;
	protected $account_sid;
	protected $auth_token;

	function __construct()
	{
		//initialize the CI super-object
		$this->_ci =& get_instance();

		//load config
		$this->_ci->load->config('twilio', TRUE);

		$this->account_sid = $this->_ci->config->item('account_sid', 'twilio');
		$this->auth_token  = $this->_ci->config->item('auth_token', 'twilio');		
	}

	function sendSMS($from, $to, $message)
	{
		$client = new Services_Twilio($this->account_sid, $this->auth_token);
		$message = $client->account->messages->sendMessage(
			$from, // From a valid Twilio number
			$to, // Text this number
			$message
		);

		return $message;
	}


}