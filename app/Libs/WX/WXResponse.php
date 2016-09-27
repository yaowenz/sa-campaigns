<?php
/**
 * TODO 将通知信息封装成类
 * @author zhang.yaowen
 *
 */
class WXResponse {
    
    public static function success() {
        return 'success';
    }
	
	public static function text($from, $to, $content) {
		return sprintf("<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[text]]></MsgType>
		<Content><![CDATA[%s]]></Content>
		</xml>", $to, $from, time(), $content);
	}
}
