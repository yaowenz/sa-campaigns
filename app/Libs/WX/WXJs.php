<?php
class WXJs {
  private $app;
  private $appId;
  private $appSecret;

  public function __construct($app) {
    $this->app = $app;
    $this->appId = \WXConfig::getAppId($app);
    $this->appSecret = \WXConfig::getAppSecret($app);
  }

  public function getSignPackage($url = null) {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = empty($url) ? "{$protocol}{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}" : $url;
    
    //确认url是页面完整的url(请在当前页面alert(location.href.split('#')[0])确认)，包括'http(s)://'部分，以及'？'后面的GET参数部分,但不包括'#'hash后面的部分。
    $url = explode('#', $url);
    $url = $url[0];    

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return (object)$signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    $ticket = \WXConfig::getJsApiTicket($this->app);
    if (empty($ticket) || (is_object($ticket) && $ticket->expired_at < (time() + 300))) {
      $accessToken = WXApi::singleton($this->app)->getAccessToken();
      
      // 如果是企业号用以下 URL 获取 ticket
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      
      // TODO 出错后如何处理？
      $res = $this->httpGet($url);
      //watchdog('wx_framework', $res);
      $res = json_decode($res);
      if(!empty($res) && !empty($res->ticket)) {
          $ticket = $res->ticket;
          $expires = intval($res->expires_in);      
          if ($ticket) {
          	\WXConfig::setJsApiTicket($this->app, $ticket, $expires);
          }
      }
      else {
          return false;
      }
    } 
    else {
    	$ticket = $ticket->data;
    }
    return $ticket;
  }



  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
  }
}

