<?php
class WXOAuth {
		
	private $_appid;
	private $_appsecret;
	private $_scope;
	private $_user_access_token;
	private $_user_openid;
	private $_user_code;
	
	/**
	 * 是否已经跳转过了
	 * @var bool
	 */
	public $redirected = false;
	
	const SCOPE_SNSAPI_BASE = 'snsapi_base';
	const SCOPE_SNSAPI_USERINFO = 'snsapi_userinfo';
	
	public function __construct($appid, $appsecret, $scope, $redirect_url = '') {
		$this->_appid = $appid;
		$this->_appsecret = $appsecret;
		$this->_scope = $scope;
		
		if(!empty($_GET['code'])) {
			$this->redirected = true;
			$this->_user_code = $_GET['code'];
		}
		
		if(!empty($redirect_url)) $this->redirect($redirect_url);
	}
	
	public function redirect($source_url, $state = '') {
		$source_url = urlencode($source_url);
		$redirect_url = $this->getRedirectUrl($source_url, $state);
		ob_end_clean();
		header("Location: {$redirect_url}");
		exit();
	}
	
	public function getRedirectUrl($source_url, $state) {
		return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->_appid}&redirect_uri={$source_url}&response_type=code&scope={$this->_scope}&state={$state}#wechat_redirect";
	}
	
	public function getAccessToken() {
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->_appid}&secret={$this->_appsecret}&code={$this->_user_code}&grant_type=authorization_code";		
		$result = $this->_callApi($url);
// 		if(!empty($result)) {
// 			$this->_user_access_token = $result['access_token'];
// 			$this->_user_openid = $result['openid'];
// 		}		
		return $result;
	}
	
	/**
	 * 获取用户信息。如果不填写access_token或openid，则会根据当前上下文自动获取。
	 * @param string $access_token
	 * @param string $openid
	 * @return boolean|Ambigous <boolean, mixed>
	 */
	public function getUserInfo($access_token = '', $openid = '') {
		if(empty($access_token) || empty($openid)) {
			$user_token = $this->getAccessToken();
			if(empty($user_token)) {
				return false;
			}
			$access_token = $user_token['access_token'];
			$openid = $user_token['openid'];
		}		
		$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
		return $this->_callApi($url);
	}		
	
	private function _callApi($url) {
	    $ch = curl_init($url);
		//curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , 0);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		//curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, false);
		//curl_setopt($ch, CURLOPT_REFERER, $strReferer);
		$response = curl_exec($ch);
		$error_no = curl_errno($ch);
		curl_close($ch);
		if($error_no) {
			WXLogger::write(date('Y-m-d H:i:s', time()) . ': CURL Error No ' . $error_no . "\n", storage_path('logs/wxapi.log'));
			return false;
		}
		return json_decode($response, true);
	}
	
}