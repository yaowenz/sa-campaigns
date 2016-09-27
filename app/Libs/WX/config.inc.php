<?php
$cwd = __DIR__;
include_once $cwd . '/WXReceiver.php';
include_once $cwd . '/WXResponse.php';
include_once $cwd . '/WXNotification.php';
include_once $cwd . '/WXHelper.php';
include_once $cwd . '/WXLogger.php';
include_once $cwd . '/WXOAuth.php';
include_once $cwd . '/WXJs.php';
include_once $cwd . '/WXApi.php';
include_once $cwd . '/pay/WXPay.Api.php';
include_once $cwd . '/pay/WXPay.JsApi.php';
include_once $cwd . '/pay/WXPay.Notify.php';

class WXConfig {    
    
    public static function getAppId($app) {
    	return \Cache::driver('database')->get('wx_' . $app . '_app_id');
    }
    
    public static function getAppSecret($app) {
        return \Cache::driver('database')->get('wx_' . $app . '_app_secret');
    }
    
    public static function getAppToken($app) {
        return \Cache::driver('database')->get('wx_' . $app . '_app_token');
    }
    
    public static function getJsApiTicket($app) {
        $key = 'wx_' . $app . '_jsapi_ticket';
        return \Cache::driver('database')->get($key);;
    }
    
    public static function setJsApiTicket($app, $js_ticket, $expired_at) {
        $key = 'wx_' . $app . '_jsapi_ticket';
        $data = (object)[
        	'ticket' => $js_ticket, 
        	'expired_at' => $expired_at
        ];
        return \Cache::driver('database')->forever($key, $data);
    }
    
    public static function getAccessToken($app) {
        $key = 'wx_' . $app . '_accesstoken';
        return \Cache::driver('database')->get($key);
    }
    
    /**
     * 缓存access token
     * 
     * @param unknown $app
     * @param unknown $access_token
     * @param unknown $expired_at
     */
    public static function setAccessToken($app, $access_token, $expired_at) {
        $key = 'wx_' . $app . '_accesstoken';      
        $data = (object)[
        	'access_token' => $access_token, 
        	'expired_at' => $expired_at        
        ];
        return \Cache::driver('database')->forever($key, $data);
    }
}
