<?php
/**
 * 
 * 微信支付API异常类
 * @author widyhu
 *
 */
class WXPayException extends Exception {
	public function errorMessage()
	{
		return $this->getMessage();
	}
}
