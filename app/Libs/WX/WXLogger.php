<?php
interface IWXLogger {	
	public static function write($data, $file);	
}

class WXLogger {	
	/**
	 * @var IWXLogger
	 */
	private static $_instance;

	public static function __callStatic($name, $args) {
		if(empty(self::$_instance)) self::$_instance = new WXLogger_File(); // 默认使用文件的WXLogger
		call_user_func_array(array(self::$_instance, $name), $args);
	}
	
	public static function setProvider($_instance) {
		self::$_instance = $_instance;
	}
}

class WXLogger_File implements IWXLogger {
	
	//public static function __	
	public static function write($data, $file) {
	    $f = fopen($file, 'w+');
		fwrite($f, $data);
		fclose($f);
	}
}
