<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_unochat {

	protected $api = "http://demo.unochat.io:8080/Server";
	
	protected $mch_name = "Tkpig";
	
	protected $appid = "28";
	
	protected $appSecret = "2M4g6YBmVR4D8ZzZTdhx";
	
	protected $appkey = "sZQIzvkwCI";
	
	protected $mch_appkey = "DYvUZZGa4a";
	
	protected $mch_appSecret = "v3scNtmeIYJmfjys8RVA";



	public function init($appkey, $appSecret, $mch_appkey, $mch_appSecret) {

		$this->appkey = $appkey;
		$this->appSecret = $appSecret;
		$this->mch_appkey = $mch_appkey;
		$this->mch_appSecret = $mch_appSecret;
	}
	
	public function auth(){
		$auth = base64_encode($this->mch_appkey.":".md5($this->mch_appSecret));
		$head = array(
			"Content-Type:application/json",
			"Authorization:Basic $auth"
			);
		return $head;
	}
	
	public function uno_decrypt($data, $key){
		$key = md5($key);
		$x = 0;

		$data = base64_decode($data);

		$len = strlen($data);
		$l = strlen($key);
		$char = '';
		$str = '';

		for ($i = 0; $i < $len; $i++) {
			if ($x == $l) {
				$x = 0;
			}
				
			$char .= substr($key, $x, 1);

			$x++;

		}


		for ($i = 0; $i < $len; $i++) {
			if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
				$str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
			} else {
				$str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
			}
		}

	
		return $str;
	}

	public function input($amount,$userInfo,$type){
		switch($type){
			case 'input':
				$data = array(
					"unochat_uid"		=> $userInfo['id'],
					"unochat_account"	=> $userInfo['kingmic_account'],
					"dynamic_code"		=> "XX",
					"order_no"			=> time(),
					"amount"			=> $amount,
					"order_time"		=> date("Y-m-d H:i:s",time()),
					"remark "			=> "测试付款"
				);
				$output = $this->postcurl("/Pay/submit",json_encode($data),$this->auth());
			break;
			case "output":
				$data = array(
					"unochat_uid"	=> $userInfo['id'],
					"unochat_account"=>$userInfo['kingmic_account'],
					"order_no"		=> time(),
					"amount"		=> $amount,
					"order_time"	=> date("Y-m-d H:i:s", time()),
					"remark"		=> "测试付款"
				);

				$output = $this->postcurl("/Pay/submitWithoutCode",json_encode($data),$this->auth());
				
			break;
			case "recharge":
				$data = array(
					"unochat_uid"	=> $userInfo['id'],
					"order_no"		=> time(),
					"amount"		=> $amount,
					"order_time"	=> date("Y-m-d H:i:s"),
					"remark"		=> "测试付款"
				);
				$output = $this->postcurl("/Pay/recharge",json_encode($data),$this->auth());
			break;
		}
		$output = json_decode($output);
		return array($this->callmsg($output->code));
	}


	public function getinfo($auth){
		return json_decode($this->uno_decrypt($auth, $this->appkey.":".$this->appSecret),true);
	}

	protected function callmsg($code){
		$errmsg = array(
			"101" => "认证失败",
			"102" => "订单号不能为空",
			"103" => "金额不正确",
			"104" => "创建订单失败",
			"105" => "麦信号不正确",
			"106" => "商户余额不足",
			"107" => "动态口令格式不正确",
			"108" => "动态口令错误次数过多 10分钟冻结时间",
			"109" => "动态口令不正确",
			"110" => "扣款失败",
			"200" => "支付成功",
		);
		return array('code' => $code, 'message' => $errmsg[$code]);
	}


	protected function postcurl($uri,$data,$header){
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $this->api.$uri);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		curl_setopt($ch, CURLOPT_POST, 1);
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		
		$output = curl_exec($ch);
		$output = false !== $output ? $output : curl_error($ch);
		
		curl_close($ch);
		return $output;
	}			

}