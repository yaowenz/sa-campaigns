<?php
/**
 * 
 * @author zhang.yaowen
 *
 */
class WXApi {    
	
	// Consts
	const MSGTYPE_TEXT = 'text';
	const MSGTYPE_IMAGE = 'image';
	const MSGTYPE_LOCATION = 'location';
	const MSGTYPE_LINK = 'link';
	const MSGTYPE_EVENT = 'event';
	const MSGTYPE_MUSIC = 'music';
	const MSGTYPE_NEWS = 'news';
	const MSGTYPE_VOICE = 'voice';
	const MSGTYPE_VIDEO = 'video';
	const EVENT_SUBSCRIBE = 'subscribe';       //订阅
	const EVENT_UNSUBSCRIBE = 'unsubscribe';   //取消订阅
	const EVENT_SCAN = 'SCAN';                 //扫描带参数二维码
	const EVENT_LOCATION = 'LOCATION';         //上报地理位置
	const EVENT_MENU_VIEW = 'VIEW';                     //菜单 - 点击菜单跳转链接
	const EVENT_MENU_CLICK = 'CLICK';                   //菜单 - 点击菜单拉取消息
	const EVENT_MENU_SCAN_PUSH = 'scancode_push';       //菜单 - 扫码推事件(客户端跳URL)
	const EVENT_MENU_SCAN_WAITMSG = 'scancode_waitmsg'; //菜单 - 扫码推事件(客户端不跳URL)
	const EVENT_MENU_PIC_SYS = 'pic_sysphoto';          //菜单 - 弹出系统拍照发图
	const EVENT_MENU_PIC_PHOTO = 'pic_photo_or_album';  //菜单 - 弹出拍照或者相册发图
	const EVENT_MENU_PIC_WEIXIN = 'pic_weixin';         //菜单 - 弹出微信相册发图器
	const EVENT_MENU_LOCATION = 'location_select';      //菜单 - 弹出地理位置选择器
	const EVENT_SEND_MASS = 'MASSSENDJOBFINISH';        //发送结果 - 高级群发完成
	const EVENT_SEND_TEMPLATE = 'TEMPLATESENDJOBFINISH';//发送结果 - 模板消息发送结果
	const EVENT_KF_SEESION_CREATE = 'kfcreatesession';  //多客服 - 接入会话
	const EVENT_KF_SEESION_CLOSE = 'kfclosesession';    //多客服 - 关闭会话
	const EVENT_KF_SEESION_SWITCH = 'kfswitchsession';  //多客服 - 转接会话
	const EVENT_CARD_PASS = 'card_pass_check';          //卡券 - 审核通过
	const EVENT_CARD_NOTPASS = 'card_not_pass_check';   //卡券 - 审核未通过
	const EVENT_CARD_USER_GET = 'user_get_card';        //卡券 - 用户领取卡券
	const EVENT_CARD_USER_DEL = 'user_del_card';        //卡券 - 用户删除卡券
	const API_URL_PREFIX = 'https://api.weixin.qq.com/cgi-bin';
	const AUTH_URL = '/token?grant_type=client_credential&';
	const MENU_CREATE_URL = '/menu/create?';
	const MENU_GET_URL = '/menu/get?';
	const MENU_DELETE_URL = '/menu/delete?';
	const GET_TICKET_URL = '/ticket/getticket?';
	const CALLBACKSERVER_GET_URL = '/getcallbackip?';
	const QRCODE_CREATE_URL='/qrcode/create?';
	const QR_SCENE = 'QR_SCENE';
	const QR_LIMIT_SCENE = 'QR_LIMIT_SCENE';
	const QRCODE_IMG_URL='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=';
	const SHORT_URL='/shorturl?';
	const USER_GET_URL='/user/get?';
	const USER_INFO_URL='/user/info?';
	const USER_UPDATEREMARK_URL='/user/info/updateremark?';
	const GROUP_GET_URL='/groups/get?';
	const USER_GROUP_URL='/groups/getid?';
	const GROUP_CREATE_URL='/groups/create?';
	const GROUP_UPDATE_URL='/groups/update?';
	const GROUP_MEMBER_UPDATE_URL='/groups/members/update?';
	const GROUP_MEMBER_BATCHUPDATE_URL='/groups/members/batchupdate?';
	const CUSTOM_SEND_URL='/message/custom/send?';
	const MEDIA_UPLOADNEWS_URL = '/media/uploadnews?';
	const MASS_SEND_URL = '/message/mass/send?';
	const TEMPLATE_SET_INDUSTRY_URL = '/message/template/api_set_industry?';
	const TEMPLATE_ADD_TPL_URL = '/message/template/api_add_template?';
	const TEMPLATE_SEND_URL = '/message/template/send?';
	const MASS_SEND_GROUP_URL = '/message/mass/sendall?';
	const MASS_DELETE_URL = '/message/mass/delete?';
	const MASS_PREVIEW_URL = '/message/mass/preview?';
	const MASS_QUERY_URL = '/message/mass/get?';
	const UPLOAD_MEDIA_URL = 'http://file.api.weixin.qq.com/cgi-bin';
	const MEDIA_UPLOAD_URL = '/media/upload?';
	const MEDIA_GET_URL = '/media/get?';
	const MEDIA_VIDEO_UPLOAD = '/media/uploadvideo?';
    const MEDIA_FOREVER_UPLOAD_URL = '/material/add_material?';
    const MEDIA_FOREVER_NEWS_UPLOAD_URL = '/material/add_news?';
    const MEDIA_FOREVER_NEWS_UPDATE_URL = '/material/update_news?';
    const MEDIA_FOREVER_GET_URL = '/material/get_material?';
    const MEDIA_FOREVER_DEL_URL = '/material/del_material?';
    const MEDIA_FOREVER_COUNT_URL = '/material/get_materialcount?';
    const MEDIA_FOREVER_BATCHGET_URL = '/material/batchget_material?';
	const OAUTH_PREFIX = 'https://open.weixin.qq.com/connect/oauth2';
	const OAUTH_AUTHORIZE_URL = '/authorize?';
	///多客服相关地址
	const CUSTOM_SERVICE_GET_RECORD = '/customservice/getrecord?';
	const CUSTOM_SERVICE_GET_KFLIST = '/customservice/getkflist?';
	const CUSTOM_SERVICE_GET_ONLINEKFLIST = '/customservice/getonlinekflist?';
	const API_BASE_URL_PREFIX = 'https://api.weixin.qq.com'; //以下API接口URL需要使用此前缀
	const OAUTH_TOKEN_URL = '/sns/oauth2/access_token?';
	const OAUTH_REFRESH_URL = '/sns/oauth2/refresh_token?';
	const OAUTH_USERINFO_URL = '/sns/userinfo?';
	const OAUTH_AUTH_URL = '/sns/auth?';
	///多客服相关地址
	const CUSTOM_SESSION_CREATE = '/customservice/kfsession/create?';
	const CUSTOM_SESSION_CLOSE = '/customservice/kfsession/close?';
	const CUSTOM_SESSION_SWITCH = '/customservice/kfsession/switch?';
	const CUSTOM_SESSION_GET = '/customservice/kfsession/getsession?';
	const CUSTOM_SESSION_GET_LIST = '/customservice/kfsession/getsessionlist?';
	const CUSTOM_SESSION_GET_WAIT = '/customservice/kfsession/getwaitcase?';
	const CS_KF_ACCOUNT_ADD_URL = '/customservice/kfaccount/add?';
	const CS_KF_ACCOUNT_UPDATE_URL = '/customservice/kfaccount/update?';
	const CS_KF_ACCOUNT_DEL_URL = '/customservice/kfaccount/del?';
	const CS_KF_ACCOUNT_UPLOAD_HEADIMG_URL = '/customservice/kfaccount/uploadheadimg?';
	///卡券相关地址
	const CARD_CREATE                     = '/card/create?';
	const CARD_DELETE                     = '/card/delete?';
	const CARD_UPDATE                     = '/card/update?';
	const CARD_GET                        = '/card/get?';
	const CARD_BATCHGET                   = '/card/batchget?';
	const CARD_MODIFY_STOCK               = '/card/modifystock?';
	const CARD_LOCATION_BATCHADD          = '/card/location/batchadd?';
	const CARD_LOCATION_BATCHGET          = '/card/location/batchget?';
	const CARD_GETCOLORS                  = '/card/getcolors?';
	const CARD_QRCODE_CREATE              = '/card/qrcode/create?';
	const CARD_CODE_CONSUME               = '/card/code/consume?';
	const CARD_CODE_DECRYPT               = '/card/code/decrypt?';
	const CARD_CODE_GET                   = '/card/code/get?';
	const CARD_CODE_UPDATE                = '/card/code/update?';
	const CARD_CODE_UNAVAILABLE           = '/card/code/unavailable?';
	const CARD_TESTWHILELIST_SET          = '/card/testwhitelist/set?';
	const CARD_MEMBERCARD_ACTIVATE        = '/card/membercard/activate?';      //激活会员卡
	const CARD_MEMBERCARD_UPDATEUSER      = '/card/membercard/updateuser?';    //更新会员卡
	const CARD_MOVIETICKET_UPDATEUSER     = '/card/movieticket/updateuser?';   //更新电影票(未加方法)
	const CARD_BOARDINGPASS_CHECKIN       = '/card/boardingpass/checkin?';     //飞机票-在线选座(未加方法)
	const CARD_LUCKYMONEY_UPDATE          = '/card/luckymoney/updateuserbalance?';     //更新红包金额
	const SEMANTIC_API_URL = '/semantic/semproxy/search?'; //语义理解
	///数据分析接口
	static $DATACUBE_URL_ARR = array(        //用户分析
	        'user' => array(
	                'summary' => '/datacube/getusersummary?',		//获取用户增减数据（getusersummary）
	                'cumulate' => '/datacube/getusercumulate?',		//获取累计用户数据（getusercumulate）
	        ),
	        'article' => array(            //图文分析
	                'summary' => '/datacube/getarticlesummary?',		//获取图文群发每日数据（getarticlesummary）
	                'total' => '/datacube/getarticletotal?',		//获取图文群发总数据（getarticletotal）
	                'read' => '/datacube/getuserread?',			//获取图文统计数据（getuserread）
	                'readhour' => '/datacube/getuserreadhour?',		//获取图文统计分时数据（getuserreadhour）
	                'share' => '/datacube/getusershare?',			//获取图文分享转发数据（getusershare）
	                'sharehour' => '/datacube/getusersharehour?',		//获取图文分享转发分时数据（getusersharehour）
	        ),
	        'upstreammsg' => array(        //消息分析
	                'summary' => '/datacube/getupstreammsg?',		//获取消息发送概况数据（getupstreammsg）
					'hour' => '/datacube/getupstreammsghour?',	//获取消息分送分时数据（getupstreammsghour）
	                'week' => '/datacube/getupstreammsgweek?',	//获取消息发送周数据（getupstreammsgweek）
	                'month' => '/datacube/getupstreammsgmonth?',	//获取消息发送月数据（getupstreammsgmonth）
	                'dist' => '/datacube/getupstreammsgdist?',	//获取消息发送分布数据（getupstreammsgdist）
	                'distweek' => '/datacube/getupstreammsgdistweek?',	//获取消息发送分布周数据（getupstreammsgdistweek）
	               	'distmonth' => '/datacube/getupstreammsgdistmonth?',	//获取消息发送分布月数据（getupstreammsgdistmonth）
	        ),
	        'interface' => array(        //接口分析
	                'summary' => '/datacube/getinterfacesummary?',	//获取接口分析数据（getinterfacesummary）
	                'summaryhour' => '/datacube/getinterfacesummaryhour?',	//获取接口分析分时数据（getinterfacesummaryhour）
	        )
	);
	///微信摇一摇周边
	const SHAKEAROUND_DEVICE_APPLYID = '/shakearound/device/applyid?';//申请设备ID
    const SHAKEAROUND_DEVICE_UPDATE = '/shakearound/device/update?';//编辑设备信息
	const SHAKEAROUND_DEVICE_SEARCH = '/shakearound/device/search?';//查询设备列表
	const SHAKEAROUND_DEVICE_BINDLOCATION = '/shakearound/device/bindlocation?';//配置设备与门店ID的关系
	const SHAKEAROUND_DEVICE_BINDPAGE = '/shakearound/device/bindpage?';//配置设备与页面的绑定关系
    const SHAKEAROUND_MATERIAL_ADD = '/shakearound/material/add?';//上传摇一摇图片素材
	const SHAKEAROUND_PAGE_ADD = '/shakearound/page/add?';//增加页面
	const SHAKEAROUND_PAGE_UPDATE = '/shakearound/page/update?';//编辑页面
	const SHAKEAROUND_PAGE_SEARCH = '/shakearound/page/search?';//查询页面列表
	const SHAKEAROUND_PAGE_DELETE = '/shakearound/page/delete?';//删除页面
	const SHAKEAROUND_USER_GETSHAKEINFO = '/shakearound/user/getshakeinfo?';//获取摇周边的设备及用户信息
	const SHAKEAROUND_STATISTICS_DEVICE = '/shakearound/statistics/device?';//以设备为维度的数据统计接口
    const SHAKEAROUND_STATISTICS_PAGE = '/shakearound/statistics/page?';//以页面为维度的数据统计接口
	
	public static $errCode = array(
		'-1'=>'系统繁忙',
		'0'=>'请求成功',
		'40001'=>'获取access_token时AppSecret错误，或者access_token无效',
		'40002'=>'不合法的凭证类型',
		'40003'=>'不合法的OpenID',
		'40004'=>'不合法的媒体文件类型',
		'40005'=>'不合法的文件类型',
		'40006'=>'不合法的文件大小',
		'40007'=>'不合法的媒体文件id',
		'40008'=>'不合法的消息类型',
		'40009'=>'不合法的图片文件大小',
		'40010'=>'不合法的语音文件大小',
		'40011'=>'不合法的视频文件大小',
		'40012'=>'不合法的缩略图文件大小',
		'40013'=>'不合法的APPID',
		'40014'=>'不合法的access_token',
		'40015'=>'不合法的菜单类型',
		'40016'=>'不合法的按钮个数',
		'40017'=>'不合法的按钮类型',
		'40018'=>'不合法的按钮名字长度',
		'40019'=>'不合法的按钮KEY长度',
		'40020'=>'不合法的按钮URL长度',
		'40021'=>'不合法的菜单版本号',
		'40022'=>'不合法的子菜单级数',
		'40023'=>'不合法的子菜单按钮个数',
		'40024'=>'不合法的子菜单按钮类型',
		'40025'=>'不合法的子菜单按钮名字长度',
		'40026'=>'不合法的子菜单按钮KEY长度',
		'40027'=>'不合法的子菜单按钮URL长度',
		'40028'=>'不合法的自定义菜单使用用户',
		'40029'=>'不合法的oauth_code',
		'40030'=>'不合法的refresh_token',
		'40031'=>'不合法的openid列表',
		'40032'=>'不合法的openid列表长度',
		'40033'=>'不合法的请求字符，不能包含\uxxxx格式的字符',
		'40035'=>'不合法的参数',
		'40038'=>'不合法的请求格式',
		'40039'=>'不合法的URL长度',
		'40050'=>'不合法的分组id',
		'40051'=>'分组名字不合法',
		'40099'=>'该 code 已被核销',
		'41001'=>'缺少access_token参数',
		'41002'=>'缺少appid参数',
		'41003'=>'缺少refresh_token参数',
		'41004'=>'缺少secret参数',
		'41005'=>'缺少多媒体文件数据',
		'41006'=>'缺少media_id参数',
		'41007'=>'缺少子菜单数据',
		'41008'=>'缺少oauth code',
		'41009'=>'缺少openid',
		'42001'=>'access_token超时',
		'42002'=>'refresh_token超时',
		'42003'=>'oauth_code超时',
		'42005'=>'调用接口频率超过上限',
		'43001'=>'需要GET请求',
		'43002'=>'需要POST请求',
		'43003'=>'需要HTTPS请求',
		'43004'=>'需要接收者关注',
		'43005'=>'需要好友关系',
		'44001'=>'多媒体文件为空',
		'44002'=>'POST的数据包为空',
		'44003'=>'图文消息内容为空',
		'44004'=>'文本消息内容为空',
		'45001'=>'多媒体文件大小超过限制',
		'45002'=>'消息内容超过限制',
		'45003'=>'标题字段超过限制',
		'45004'=>'描述字段超过限制',
		'45005'=>'链接字段超过限制',
		'45006'=>'图片链接字段超过限制',
		'45007'=>'语音播放时间超过限制',
		'45008'=>'图文消息超过限制',
		'45009'=>'接口调用超过限制',
		'45010'=>'创建菜单个数超过限制',
		'45015'=>'回复时间超过限制',
		'45016'=>'系统分组，不允许修改',
		'45017'=>'分组名字过长',
		'45018'=>'分组数量超过上限',
		'45024'=>'账号数量超过上限',
		'46001'=>'不存在媒体数据',
		'46002'=>'不存在的菜单版本',
		'46003'=>'不存在的菜单数据',
		'46004'=>'不存在的用户',
		'47001'=>'解析JSON/XML内容错误',
		'48001'=>'api功能未授权',
		'50001'=>'用户未授权该api',
		'61450'=>'系统错误',
		'61451'=>'参数错误',
		'61452'=>'无效客服账号',
		'61453'=>'账号已存在',
		'61454'=>'客服帐号名长度超过限制(仅允许10个英文字符，不包括@及@后的公众号的微信号)',
		'61455'=>'客服账号名包含非法字符(英文+数字)',
		'61456'=>'客服账号个数超过限制(10个客服账号)',
		'61457'=>'无效头像文件类型',
		'61500'=>'日期格式错误',
		'61501'=>'日期范围错误',
		'7000000'=>'请求正常，无语义结果',
		'7000001'=>'缺失请求参数',
		'7000002'=>'signature 参数无效',
		'7000003'=>'地理位置相关配置 1 无效',
		'7000004'=>'地理位置相关配置 2 无效',
		'7000005'=>'请求地理位置信息失败',
		'7000006'=>'地理位置结果解析失败',
		'7000007'=>'内部初始化失败',
		'7000008'=>'非法 appid（获取密钥失败）',
		'7000009'=>'请求语义服务失败',
		'7000010'=>'非法 post 请求',
		'7000011'=>'post 请求 json 字段无效',
		'7000030'=>'查询 query 太短',
		'7000031'=>'查询 query 太长',
		'7000032'=>'城市、经纬度信息缺失',
		'7000033'=>'query 请求语义处理失败',
		'7000034'=>'获取天气信息失败',
		'7000035'=>'获取股票信息失败',
		'7000036'=>'utf8 编码转换失败',
	);
	
	
	
    /**
	 * @param WXApi
	 */
    private static $_instance;

    private $_app;
    private $_access_token;
    private $_response;
    
    public $error = ''; 
    
    protected function __construct() {
        
    }

    /**
     * 单例模式运行
	 * @return WXApi
	 */
    public static function singleton($app = 'default') {
        if(empty(self::$_instance[$app])) {
        	self::$_instance[$app] = new WXApi();
        	self::$_instance[$app]->_app = $app;
        }        
        return self::$_instance[$app];
    }
    
    private function _getApiGateway($api = '', $refresh_acces_token = false) {
    	$api_gateway = self::API_URL_PREFIX;
    	
    	if(!empty($api)) {
    		$api_gateway .= $api . 'access_token=' . $this->getAccessToken($refresh_acces_token);
    	}
    	
    	return $api_gateway;
    }    
   
    
    public function getError() {
    	if(!empty($this->error)) {
    		return array(
    		    'code' => $this->error,
    			'msg' => self::$errCode[$this->error]
    		);
    	}
    	return null;
    }
    
    public function getErrorMsg() {
    	$error = $this->getError();
    	if(!empty($error)) {
    		$error = "Code: {$error['code']}, Msg: {$error['msg']}";
    	}
    	return $error;
    }
    
    public function resetError() {
    	$this->error = null;
    }
    
    /**
     * 获取AccessToken
     * 
     * @param string $update
     * @return The|boolean
     */
    public function getAccessToken($update = false){             
        $api_gateway =  $this->_getApiGateway() . '/token?grant_type=client_credential&appid=%s&secret=%s';        
        
    	$_appid 		= WXConfig::getAppId($this->_app);
		$_appsecret 	= WXConfig::getAppSecret($this->_app);
		
		if($_appid && $_appsecret){
		    
			// 如果缓存的access_token未过期，则直接返回
			$access_token = !empty($this->_access_token) ? $this->_access_token : WXConfig::getAccessToken($this->_app);
			// read from cache
			if(is_object($access_token)) {
				if($access_token->expired_at < time() + 300) { // 5分钟缓冲时间
					$update = true;
				}
				else {				
					$access_token = $access_token->access_token;					
				}
			}
			
			if (!$update && !empty($access_token)) {					
				return $access_token;				
			}		
			$this->_response = $this->callApi(sprintf($api_gateway, $_appid, $_appsecret), array(), false);			
			$result = json_decode($this->_response);			
			
			if(!empty($result->errcode)) {
			    return false;
			}
			
			if($result) {
			    $access_token = $result->access_token;
			    $expired_at = time() + intval($result->expires_in);			    
			    $this->_access_token = (object)[
			    	'access_token' => $access_token, 
			    	'expired_at' => $expired_at
			    ];
			    WXConfig::setAccessToken($this->_app, $access_token, $expired_at);			    
			    return $access_token;
			}
		}	
		return false;
    }
    
    public function getMenu() {
	    $access_token = $this->getAccessToken();
	    $url = $this->_getApiGateway() . self::MENU_GET_URL.'access_token='.$access_token;
	    $result = $this->callApi($url);
	    
	    if (!empty($result))
	    {
	    	$json = json_decode($result);
	    	if (!empty($json->errcode)) {
	    		$this->error = $json->errcode;
	    		return false;
	    	}
	    	return $json;
	    }
	    return false;
    }   
    
    /**
     * 长链接转短链接
     * @param string $url
     * @return boolean|string
     */
    public function getShortUrl($url) {
        $access_token = $this->getAccessToken();
        $url = $this->_getApiGateway() . self::SHORT_URL.'access_token='.$access_token;
        $result = $this->callApi($url, [
            'action' => 'long2short',
            'long_url' => $url,
        ]);
         
        if (!empty($result))
        {
            $json = json_decode($result);
            if (!empty($json->errcode)) {
                $this->error = $json->errcode;
                return false;
            }
            return $json->short_url;
        }
        return false;
    }
    
    
    /**
     * 获取临时素材(认证后的订阅号可用)
     * @param string $media_id 媒体文件id
     * @param boolean $is_video 是否为视频文件，默认为否
     * @param string $fetch_file 获取文件后所存放的位置, false 为仅返回文件的url地址
     * @return binary|string
     */
    public function getMediaTemp($media_id, $is_video=false, $fetch_file = false){
    	//如果要获取的素材是视频文件时，不能使用https协议，必须更换成http协议
    	$url_prefix = $is_video?str_replace('https','http',self::API_URL_PREFIX):self::API_URL_PREFIX;
    	$url = $url_prefix.self::MEDIA_GET_URL.'access_token='.$this->getAccessToken().'&media_id='.$media_id;
    	
    	if(!$fetch_file) {
    		return $url;
    	}    	
    	return false;
    }    
    
    /**
     * 创建菜单(认证后的订阅号可用)
     * @param array $data 菜单数组数据
     * example:
     * 	array (
     * 	    'button' => array (
     * 	      0 => array (
     * 	        'name' => '扫码',
     * 	        'sub_button' => array (
     * 	            0 => array (
     * 	              'type' => 'scancode_waitmsg',
     * 	              'name' => '扫码带提示',
     * 	              'key' => 'rselfmenu_0_0',
     * 	            ),
     * 	            1 => array (
     * 	              'type' => 'scancode_push',
     * 	              'name' => '扫码推事件',
     * 	              'key' => 'rselfmenu_0_1',
     * 	            ),
     * 	        ),
     * 	      ),
     * 	      1 => array (
     * 	        'name' => '发图',
     * 	        'sub_button' => array (
     * 	            0 => array (
     * 	              'type' => 'pic_sysphoto',
     * 	              'name' => '系统拍照发图',
     * 	              'key' => 'rselfmenu_1_0',
     * 	            ),
     * 	            1 => array (
     * 	              'type' => 'pic_photo_or_album',
     * 	              'name' => '拍照或者相册发图',
     * 	              'key' => 'rselfmenu_1_1',
     * 	            )
     * 	        ),
     * 	      ),
     * 	      2 => array (
     * 	        'type' => 'location_select',
     * 	        'name' => '发送位置',
     * 	        'key' => 'rselfmenu_2_0'
     * 	      ),
     * 	    ),
     * 	)
     * type可以选择为以下几种，其中5-8除了收到菜单事件以外，还会单独收到对应类型的信息。
     * 1、click：点击推事件
     * 2、view：跳转URL
     * 3、scancode_push：扫码推事件
     * 4、scancode_waitmsg：扫码推事件且弹出“消息接收中”提示框
     * 5、pic_sysphoto：弹出系统拍照发图
     * 6、pic_photo_or_album：弹出拍照或者相册发图
     * 7、pic_weixin：弹出微信相册发图器
     * 8、location_select：弹出地理位置选择器
     */
    public function setMenu($data){
    	$access_token = $this->getAccessToken();
    	$url = $this->_getApiGateway() . self::MENU_CREATE_URL.'access_token='.$access_token;
    	$result = $this->callApi($url, $data);
    	if (!empty($result))
	    {
	    	$json = json_decode($result);
	    	if (!empty($json->errcode)) { //errorcode = 0 success
	    		$this->error = $json->errcode;
	    		return false;
	    	}
	    	return $json;
	    }
	    return false;
    }   

    
    public function sendTemplateMessage($to_openid, $template_id, $url, $message, $color = '#14d056'){    	
    	$post_data = array(
	    	"touser" => $to_openid,
	    	"template_id" => $template_id,
	    	"url" => $url,
	    	"topcolor" => $color,
	    	"data" => $message,
    	);    	
    	    	
    	$access_token = $this->getAccessToken();
    	$url = $this->_getApiGateway() . self::TEMPLATE_SEND_URL . 'access_token=' . $access_token;
    	$result = $this->callApi($url, $post_data);
    	if($result){
    		$json = json_decode($result);
    		if (!$json || !empty($json->errcode)) {
    			$this->error = $json->errcode;
    			return false;
    		}
    		return $json->msgid;
    	}
    	return false;
    }
    
    /**
     * 批量获取关注用户列表
     * @param unknown $next_openid
     */
    public function getUserList($next_openid=''){
    	$url = $this->_getApiGateway(self::USER_GET_URL);    	
    	$url .= '&next_openid='.$next_openid;
    	$result = $this->_parseResultJSON($this->callApi($url));
    	
    	if(!empty($result)) {
    		return $result;
    	}
    	
    	return false;    
    }
    
    /**
     * 获取关注者详细信息
     * @param string $openid
     * @return array {subscribe,openid,nickname,sex,city,province,country,language,headimgurl,subscribe_time,[unionid]}
     * 注意：unionid字段 只有在用户将公众号绑定到微信开放平台账号后，才会出现。建议调用前用isset()检测一下
     */
    public function getUserInfo($openid){
    	$url = $this->_getApiGateway(self::USER_INFO_URL);    
    	$url .= '&lang=zh_CN&openid='.$openid;
    	$result = $this->_parseResultJSON($this->callApi($url));
    	
    	if(!empty($result)) {
    		return $result;
    	}
    	return false;
    }
    
    /**
     * 生成临时二维码
     * @param unknown $code
     * @param int $expired_in seconds to expired
     */
    public function getShortTermQR($code, $expire_seconds) {
        $url = $this->_getApiGateway(self::QRCODE_CREATE_URL);
        $data = [
            'expire_seconds' => $expire_seconds,
            'action_name' => self::QR_SCENE,
            'action_info' => [
                'scene' => ['scene_id' => $code]
            ]
        ];
        
        $result = $this->_parseResultJSON($this->callApi($url, $data));
         
        if(!empty($result)) {
            return $result;
        }
        return false;
    }
    
    public function getLongTermQR($code) {
        
    }
    
    public function getQRImageUrl($ticket) {
        $url = self::QRCODE_IMG_URL . $ticket;
        return $url;
    }
    
    public function upload_thumb($file) {
    	return $this->_upload_media($file, 'thumb');
    }
    
    public function upload_image($file) {
    	return $this->_upload_media($file, 'image');
    }    
    
    /**
     * 
		图片（image）: 1M，支持JPG格式
		语音（voice）：2M，播放长度不超过60s，支持AMR\MP3格式
		视频（video）：10MB，支持MP4格式
		缩略图（thumb）：64KB，支持JPG格式
     * @return string $media_id		
	 */    
    private function _upload_media($file, $type) {
        $access_token = $this->get_access_token();        
        $api_url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type={$type}";        
        
        $content = array();
        if (class_exists('\CURLFile')) { //CURL compatible above PHP 5.5
        	$content = array('media' => new \CURLFile(realpath($file)));
        } else {
        	$content = array('media' => '@' . realpath($file));
        }        
        
		if($this->is_success($this->callApi($api_url, $content))) {
			$result = json_decode($this->_response);
			$key = "{$type}_media_id";
			return $result->$key;
		}
        return false;
    }
    
	public function upload_news($news) {		
		$api = $this->_getApiGateway() . "/media/uploadnews?access_token=" . $this->get_access_token();		
		
		// JSON_UNESCAPED_UNICODE is not supported until 5.4
		$content = json_encode(array('articles' => $news), JSON_UNESCAPED_UNICODE);
		
		if($this->is_success($this->callApi($api, $content))) {
			$response = json_decode($this->_response);
			return $response->media_id;	
		}		
		return false; 		
	}	
	
	
	public static function build_news_item($thumb_media_id, $title, $html_content, $author = '', $src_url = '', $digest = '', $show_cover = true) {
		return array(
			"thumb_media_id"	 => $thumb_media_id,
			"author" 		 	 => $author, 
			"title"				 => $title, 
			"content_source_url" => $src_url,
			"content" 			 => $html_content,
			"digest"			 => $digest,
			"show_cover_pic" 	 => $show_cover ? "1" : "0"
		);
	}

	/**
	 * 处理微信返回的结果XML
	 * @param unknown $result
	 * @return mixed|boolean
	 */
    private function _parseResultJSON($result) {
    	$text = $result;
    	$result = json_decode($result);
    	if(!empty($result)) {
    		if(!empty($result->errcode)) {    			
    			// 如果出错是access_token过期的话，重新获取
		    	if($result->errcode == '42001') {
		    		//$this->get_access_token(true);	 		    	
    			}
				$this->error = $result->errcode;    			
    		}
    		else {
    			return $result;
    		}
    	}
    	return false;
    }    
    
    /**
     * 发送客服消息-图片
     * @param string $openid
     * @param string $media_id
     * @return bool
     */
    public function send_individual_image($openid, $media_id) {    	
    	$content = array(
    		'touser' 	=> $openid,
    		'msgtype'	=> 'image',
    		'image'		=> array('media_id' => $media_id) 
    	);    	
    	return $this->_send_individual_message($content);
    }  
    
    /**
     * 发送客服消息-文字
     * @param string $openid
     * @param string $text
     * @return boolean
     */
    public function sendIndividualText($openid, $text) {
    	$content = array(
    		'touser' 	=> $openid,
    		'msgtype'	=> 'text',
    		'text'		=> array('content' => $text)
    	);
    	return $this->_sendIndividualMessage($content);
    }    
    
    /**
     * 发送一对一客服消息
     * @param array $content
     * @return boolean
     */
    private function _sendIndividualMessage($content) {
    	$api_url = $this->_getApiGateway(self::CUSTOM_SEND_URL);
    	
    	$result = $this->_parseResultJSON($this->callApi($api_url, $content));
    	 
    	if(!empty($result)) {
    		return $result;
    	}
    	
    	return false;
    }

    
    public function send_mass_news($openids, $media_id) {
    	$content = array(
    		"touser"	=> $openids,
    		"mpnews"	=> array('media_id' => $media_id),
    		'msgtype'	=> 'mpnews',
    	);    	
    	return $this->_send_mass($content);    	
    }
    
    private function _send_mass($content) {
    	$api = $this->_getApiGateway() . "/message/mass/send?access_token=" . $this->get_access_token();       	
    	if($this->is_success($this->callApi($api, json_encode($content, JSON_UNESCAPED_UNICODE)))) {
    		$result = json_decode($this->_response);    		
    		return $result->msg_id;
    	}
    	return false;
    }
    
    /**
     * 分组群发多图文
     * @param int $group_id
     * @param string $media_id
     * @return boolean
     */
    public function send_group_news($group_id, $media_id) {
    	$content = array(	    	
	    	"mpnews"	=> array('media_id' => $media_id),
	    	'msgtype'	=> 'mpnews',
    	);
    	
    	return $this->_send_group($group_id, $content);
    }
    
    /**
     * 根据微信分组进行群发
     * $group_id = -1 为全部发送
     * @param array $content
     * @param int $group_id
     * @return boolean
     */
    private function _send_group($group_id, $content) { //
    	$api = $this->_getApiGateway() . "/message/mass/sendall?access_token=" . $this->get_access_token();
 
    	if($group_id != -1) {
    		$content['filter'] = array(
    			'is_to_all' => false,
    			'group_id' => $group_id
    		);
    	}    	
    	else {
    		$content['filter'] = array('is_to_all' => true);
    	}
    	
    	if($this->is_success($this->callApi($api, json_encode($content, JSON_UNESCAPED_UNICODE)))) {
    		$result = json_decode($this->_response);
    		return $result->msg_id;
    	}
    	return false;
    }
    
    /**
     * 获取微信所有分组
     * @return mixed|boolean
     */
    public function get_groups() {
    	$url = $this->_getApiGateway() . "/groups/get?access_token=" . $this->get_access_token();    	
    	if($this->is_success($this->callApi($url, null, false))) {
    		$groups = json_decode($this->_response);
    		return $groups->groups;
    	}    	
    	return false;
    }

    public function callApi($url, $content = array(), $is_post = true) {
    	$this->resetError();    	
    	
    	$ch = curl_init($url);
    	    	
    	if(is_array($content)) $content = json_encode($content, JSON_UNESCAPED_UNICODE);
    	
    	//curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , 0); //TODO enabled this option will return an error no 60 in Windows PHP 5.3, why?
    	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    	//curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_POST, $is_post);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
    	//curl_setopt($ch, CURLOPT_REFERER, $strReferer);
    	$this->_response = curl_exec($ch);
    	$error_no = curl_errno($ch);    
    	curl_close($ch);
    	if($error_no) {
    		$this->error = -10;
    		//error_log(date('Y-m-d H:i:s', time()) . ': CURL Error No ' . $error_no . "\n\r", 3, WCP_API_CALL_ERROR);
    		return false;
    	} 
    	
    	return $this->_response;
    }
    
    public function getHttpResponse() {
    	return $this->_response;
    }
}
?>