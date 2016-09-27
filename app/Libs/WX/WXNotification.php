<?php
/**
 * TODO 将通知信息封装成类
 * @author zhang.yaowen
 *
 */
class WXNotification {
	
	private $_wx_notification;
	
	public $fromUser;
	public $toUser;
	public $msgType;
	public $event;
	public $eventKey;
	
	public function __construct($notification_body) {		
		$this->_wx_notification = $notification_body; 
		
		// init data
		$this->fromUser = $this->getFromUser();
		$this->toUser = $this->getToUser();
		$this->msgType = $this->getMsgType();
		$this->event = $this->getEventType();
		$this->eventKey = $this->getEventKey();
	}
	
	public function __get($property) {
		// 如果使用SimpleXMLElement->Property，则使用json_encode或者print_r会将值显示为一个索引为0的数组, 使用(string)强转;
		if(!empty($this->_wx_notification->$property)) {
            return (string)$this->_wx_notification->$property;
		}
		return null;
	}
	
	public function getFromUser() {
		return $this->__get('FromUserName');
	}
	
	public function getToUser() {
		return $this->__get('ToUserName');
	}
	
	/**
	 * 消息类型
	 */
	public function getMsgType() {
		return strtolower($this->__get('MsgType'));
	}
	
	/**
	 * 事件类型
	 */
	public function getEventType() {
	    return strtolower($this->__get('Event'));
	}
	
	
	public function getEventKey() {
	    return strtolower($this->__get('EventKey'));
	}

}
