<?php
/* ----------------------------------------------- *
 | [ XiaoLin ] Version : 2.0 beta
 | 简单粗暴又不失高雅的迫真 OOP MVC 框架，，，
 |
 | URL     : https://blog.test404.club/
 * ----------------------------------------------- *
 | Name    : ErrorManager (错误管理模块)
 |
 | Author  : Xiaolin (a1475775412@foxmail.com)
 | LICENSE : WTFPL http://www.wtfpl.net/about
 * ----------------------------------------------- */

namespace XiaoLin;

use XiaoLin\Exception\ErrorException;
use XiaoLin\Router;
use XiaoLin\Module\PerformanceStatistics;

class ErrorManager{
	static private $debug = false;
	static public $adminInfo = [];
	
	/**
	 * 初始化错误管理
	 * 该方法会在发生错误/异常的时候进行调用
	 * 
	 * @return void
	 */
	static public function init(){
		self::$adminInfo = XiaoLin::$config['adminInfo'] ?: l('@xiaolin.errorManager.adminInfo', [], [
			'xiaolin框架'		=> '<a href="https://blog.test404.club/" target="_blank">https://blog.test404.club/</a>',
			'xiaolin框架作者'	=> 'Xiaolin (a1475775412@foxmail.com)',
		]);
		
		self::$debug = XiaoLin::$config['debug'];
	}
	
	/**
	 * 错误回调
	 * 
	 * @param int    $errno   错误代码
	 * @param string $errstr  错误信息
	 * @param string $errfile 错误文件
	 * @param int    $errline 错误所在行数
	 * @return void
	 */
	static public function error(int $errno, string $errstr, string $errfile, int $errline){
		if (!(error_reporting() & $errno)) {
			return false;
		}
		
		if(!class_exists('\\XiaoLin\\Exception\\Error\\WarningException', false)){
			include(xiaolin . 'Exception' . DIRECTORY_SEPARATOR . 'Errors.php');
		}
		
		switch($errno){
			 case E_ERROR:               throw new \XiaoLin\Exception\Error\ErrorException            ($errno, $errstr, $errfile, $errline);
			 case E_WARNING:             throw new \XiaoLin\Exception\Error\WarningException          ($errno, $errstr, $errfile, $errline);
			 case E_PARSE:               throw new \XiaoLin\Exception\Error\ParseException            ($errno, $errstr, $errfile, $errline);
			 case E_NOTICE:              throw new \XiaoLin\Exception\Error\NoticeException           ($errno, $errstr, $errfile, $errline);
			 case E_CORE_ERROR:          throw new \XiaoLin\Exception\Error\CoreErrorException        ($errno, $errstr, $errfile, $errline);
			 case E_CORE_WARNING:        throw new \XiaoLin\Exception\Error\CoreWarningException      ($errno, $errstr, $errfile, $errline);
			 case E_COMPILE_ERROR:       throw new \XiaoLin\Exception\Error\CompileErrorException     ($errno, $errstr, $errfile, $errline);
			 case E_COMPILE_WARNING:     throw new \XiaoLin\Exception\Error\CoreWarningException      ($errno, $errstr, $errfile, $errline);
			 case E_USER_ERROR:          throw new \XiaoLin\Exception\Error\UserErrorException        ($errno, $errstr, $errfile, $errline);
			 case E_USER_WARNING:        throw new \XiaoLin\Exception\Error\UserWarningException      ($errno, $errstr, $errfile, $errline);
			 case E_USER_NOTICE:         throw new \XiaoLin\Exception\Error\UserNoticeException       ($errno, $errstr, $errfile, $errline);
			 case E_STRICT:              throw new \XiaoLin\Exception\Error\StrictException           ($errno, $errstr, $errfile, $errline);
			 case E_RECOVERABLE_ERROR:   throw new \XiaoLin\Exception\Error\RecoverableErrorException ($errno, $errstr, $errfile, $errline);
			 case E_DEPRECATED:          throw new \XiaoLin\Exception\Error\DeprecatedException       ($errno, $errstr, $errfile, $errline);
			 case E_USER_DEPRECATED:     throw new \XiaoLin\Exception\Error\UserDeprecatedException   ($errno, $errstr, $errfile, $errline);
		}
      
		return true;
	}
	
	/**
	 * 异常回调
	 * 
	 * @param exception $ex 异常
	 * @return void
	 */
	static public function exception($ex){
		PerformanceStatistics::log('XiaoLin:error_manager');
		
		$info = [
			'message'		=> $ex->getMessage(),
			'code'			=> $ex->getCode(),
			'file'			=> $ex->getFile(),
			'fileText'		=> self::getFileLines($ex->getFile(), $ex->getLine() - 10, 20, $ex->getLine()),
			'line'			=> $ex->getLine(),
			'class'			=> get_class($ex),
			'trace'			=> self::formatTrace($ex->getTrace()),
			'removeTrace'	=> isset($ex->removeTraceCount) ? $ex->removeTraceCount : 0,
			'exceptionVars'	=> self::getExceptionVars($ex),
			'url'			=> urldecode(Router::getUrl()),
			'debug'			=> self::$debug
		];
		
		if($info['removeTrace'] > 0){
			array_splice($info['trace'], 0, $info['removeTrace']);
		}
		
		$info = self::hiddenRootPath($info);
		
		$sysinfo = l('@xiaolin.sysinfo.statusCode.500', [], [
			'title'		=> '系统故障',
			'moreTitle'	=> '啊哈... 出了一点点小问题_(:з」∠)_',
			'more'		=> [
				'程序猿/媛写错了什么东西。',
				'发生了一些不可预料的事情。',
				'如果你发现了有什么不对，请迅速联系站点管理员',
				'如果没什么不对的，那就再试一次看看？'
			],
		
			'code'		=> '500',
			'type'		=> 'error', //[info, error, success]
			'title'		=> '系统故障'
		]);
		
		$sysinfo['showTips'] = !self::$debug;
		$sysinfo['errorInfo'] = $info;
		$sysinfo['adminInfo'] = self::$adminInfo;
		
		
		sysinfo($sysinfo);
		
		die();
	}
	
	/**
	 * 获取异常参数并格式化返回
	 * 用来获取\XiaoLin\Exception\Exception类的异常自定义值
	 * 
	 * @param exception $ex 异常
	 * @return array
	 */
	static private function getExceptionVars($ex){
		$return = [];
		
		if(method_exists($ex, 'getValues')){
			$values = $ex->getValues();
			
			foreach($values as $key => $value){
				if(is_array($value)){
					$return[$key] = [
						'type'	=> 1,
						'value'	=> self::formatArgs($value, 0)
					];
				}else{
					$return[$key] = [
						'type'	=> 0,
						'value'	=> [
							self::varToString($value, 0),
							var_export($value, true),
							$value
						]
					];
				}
			}
		}
		
		return $return;
	}
	
	/**
	 * 格式化函数参数
	 * 
	 * @param array $arr    参数们
	 * @param int   $strlen 文本长度
	 * @return array
	 */
	static private function formatArgs($arr, $strlen = 20){
		$args = [];
		
		foreach($arr as $i => $row){
			$args[$i] = [
				self::varToString($row, $strlen),
				@var_export($row, true),
				$row
			];
		}
		
		return $args;
	}
	
	/**
	 * 格式化Trace
	 * 
	 * @param array $trace PHP异常追踪信息
	 * @return array
	 */
	static private function formatTrace($trace){
		foreach($trace as $i => $row){
			$trace[$i]['file'] = isset($row['file']) ? $row['file'] : 'NO FILE';
			$trace[$i]['line'] = isset($row['line']) ? $row['line'] : 'NO LINE';
			$trace[$i]['fileText'] = isset($row['file']) ? self::getFileLines($row['file'], $row['line'] - 4, 10, $row['line']) : '';
			$trace[$i]['function_'] = isset($row['class']) ? $row['class'] . $row['type'] . $row['function'] : $row['function'];
			$trace[$i]['args'] = isset($trace[$i]['args']) ? self::formatArgs($trace[$i]['args']) : [];
		}
		
		return $trace;
	}
	
	/**
	 * 把任何类型的值转换为文本型
	 * 
	 * @param mixed $var    值
	 * @param int   $strlen 最大长度
	 * @return mixed
	 */
	static private function varToString($var, $strlen = 20){
		if(is_string($var)){
			$var = htmlspecialchars('"' . ($strlen != 0 && mb_strlen($var, 'UTF-8') > $strlen ? mb_substr($var, 0, $strlen) . '...' : $var) . '"');
			$var = str_replace(root, '[ROOT]' . DIRECTORY_SEPARATOR, $var);
		}elseif(is_numeric($var) || is_bool($var)){
			$var = $var;
		}elseif(is_callable($var)){
			$var = '(Function)';
		}elseif(is_object($var)){
			$var = '(Object)';
		}else{
			$var = @htmlspecialchars((string)$var);
		}
		
		return $var;
	}
	
	/**
	 * 隐藏根路径
	 * 
	 * @param mixed $arr 值
	 * @return mixed
	 */
	static private function hiddenRootPath($arr){
		if(is_array($arr)){
			foreach($arr as $index => $value){
				$arr[$index] = self::hiddenRootPath($value);
			}
		}else if(is_string($arr)){
			$arr = str_replace(root, '', $arr);
		}
		
		return $arr;
	}
	
	/**
	 * 获取指定文件的指定范围行内容
	 * 
	 * @param string $filename  文件名
	 * @param int    $startLine 起始行
	 * @param int    $endLine   结束行
	 * @param int    $redline   添加标记行
	 * @return string
	 */
	static private function getFileLines($filename, $startLine = 1, $endLine = 50, $redline = 1) {
		$fp = @fopen($filename, 'rb');
		if (!$fp) return '';
		
		$line = 0;
		
		for ($i = 1; $i < $startLine; ++$i) {
			$line++;
			fgets($fp);
		}
		for ($i = 0; $i <= $endLine; ++$i) {
			$line++;
			if(($text = fgets($fp)) === FALSE){
				break;
			}
			$content[] = str_replace(["\r","\n"], '', $line == $redline ? '[redline]' . $text . '[/redline]' : $text);
		}
		fclose($fp);
		
		return implode("\r\n", $content);
	}
}