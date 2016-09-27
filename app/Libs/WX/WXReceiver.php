<?php
class WXReceiver {
	
	private $_appid;
	private $_appsecret;
	private $_token;
	private $_encoding_aeskey;
	private $_log_file;
	private $_post_data_raw;
	private $_post_data;
	
	private $_error_msg;
	private $_error_code;	
	
	public function __construct($appid, $appsecret, $token, $encoding_aeskey = null, $log_file = null) {
		$this->_appid = $appid;
		$this->_appsecret = $appsecret;
		$this->_token = $token;
		$this->_encoding_aeskey = $encoding_aeskey;
		$this->_log_file = $log_file;
		$this->_post_data_raw = file_get_contents("php://input");
		try {
		    $this->_post_data = simplexml_load_string($this->_post_data_raw, 'SimpleXMLElement', LIBXML_NOCDATA);
		}
		catch(\Exception $e) {
		    $this->_post_data = '';
		}
	}	
	
	private function _setError($code = 0, $msg = '') {
		$this->_error_code = $code;
		$this->_error_msg = $msg;
	}
	
	public function getError() {
		return array(
		    'code' => $this->_error_code,
			'msg'  => $this->_error_msg,
		);
	}
	
	/**
	 * For weixin server validation
	 */
	private function checkSignature() {
		$signature = isset($_GET["signature"]) ? $_GET["signature"] : '';
		$timestamp = isset($_GET["timestamp"]) ? $_GET["timestamp"] : '';
		$nonce = isset($_GET ["nonce"]) ? $_GET ["nonce"] : '';

		$token = $this->_token;
		$tmpArr = array (
			$token,
			$timestamp,
			$nonce
		);
		
		// 如果消息使用安全模式发送的，则使用msg_signature比对，且被签名字段需加上加密后的消息	
		if(!empty($_GET['msg_signature'])) {
			$signature = $_GET["msg_signature"];  // 如果存在加密验证则用加密验证段
			array_push($tmpArr, $this->_post_data['Encrypt']);
		}
		
		sort($tmpArr, SORT_STRING);				
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);

		if ($tmpStr == $signature) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Get Notification
	 * @return boolean|string|WXNotification
	 */
	public function parseNotification() {
			
		// @TODO log switcher		
		$log = "----------------------------\n";
		$log .= date("Y-m-d H:i:s") . ":\n";
		$log .= $_SERVER['REQUEST_URI'] . "\n";
		$log .= $this->_post_data_raw . "\n";
		$log .= http_build_query($_POST) . "\n";
		ob_start();		
		print_r($this->_post_data);
		$log .= ob_get_clean();				
		$this->log($log);	
		// log request end
		if (!$this->checkSignature()) {
			$this->log("error sign \n");
			$this->_setError('-1', 'error sign');
			return false;			
		}
		else {
			$encryptStr = "";
			// 获取通知消息
			if ($_SERVER['REQUEST_METHOD'] == "POST") {				
				$encrypt_type = isset($_GET["encrypt_type"]) ? $_GET["encrypt_type"] : '';
				if ($encrypt_type == 'aes') { // aes加密
					$encryptStr = $this->_post_data['Encrypt'];
					$prpcrypt = new WXHelper_Prpcrypt($this->_encoding_aeskey);
					$array = $prpcrypt->decrypt($encryptStr, $this->_appid);
					if (!isset($array[0]) || ($array[0] != 0)) {
						$this->_setError($array[0], $array[1]);
						$this->log("error decrypt \n");
						return false;
					}
					$decrypt_str = $array[1];
					$notification =  simplexml_load_string($decrypt_str, 'SimpleXMLElement', LIBXML_NOCDATA);
					if (!$this->_appid)	$this->_appid = $array[2]; // 为了没有appid的订阅号。
				} else {
					$notification = $this->_post_data;					
				}
				return new WXNotification($notification);
			}
			// 检测接口
			elseif (!empty($_GET["echostr"])) {
				return $_GET["echostr"];
			}
		}
		return false;	
	}
	
	// TODO: 记录日志的开关，记录日志单独使用函数
	public function log($content) {
		if (!empty($this->_log_file)) {
			$f = fopen($this->_log_file, 'a');			
			fwrite($f, $content);
			fclose($f);
		}
	}
}
