<?php
/* ----------------------------------------------- *
 | [ XiaoLin ] Version : 2.0 beta
 | 简单粗暴又不失高雅的迫真 OOP MVC 框架，，，
 |
 | URL     : https://blog.test404.club/
 * ----------------------------------------------- *
 | Name    : AntiCSRF (CSRF攻击防御模块)
 |
 | Author  : Xiaolin (a1475775412@foxmail.com)
 | LICENSE : WTFPL http://www.wtfpl.net/about
 * ----------------------------------------------- */

namespace XiaoLin\Module;

use XiaoLin\View;

class AntiCSRF{
	public static $whiteList	= [];
	public static $cookieName	= 'xiaolin_formhash';
	public static $sessionName	= 'xiaolin_formhash';
	public static $argName		= 'formhash';
	public static $varName		= 'formHash';
	
	/**
	 * 初始化CSRF攻击防御模块
	 * 一般来说不用手动初始化，应当在xiaolin配置文件进行配置
	 * 
	 * @param string $cookieName  COOKIE键值
	 * @param string $sessionName SESSION键值
	 * @param string $argName     获取formhash的POST键值
	 * @param string $varName     注册到View的变量名
	 * @return void
	 */
	public static function init($cookieName = 'xiaolin_formhash', $sessionName = 'xiaolin_formhash', $argName = 'formhash', $varName = 'formHash'){
		global $a,$c,$m;
		
		if(session_status() === PHP_SESSION_NONE){
			session_start();
		}
		
		if(!isset($_SESSION[self::$sessionName])){
			self::refush();
		}
		
		if(!isset(self::$whiteList[$a][$c]) || !in_array($m, self::$whiteList[$a][$c])){
			if(is_post && !self::verify()){
				sysinfo(l('@xiaolin.sysinfo.antiCSRF', [], [
					'code'	=> '403',
					'type'	=> 'error',
					'info'	=> '表单验证未通过!',
					'more'	=> [
						'您同时打开了多个页面',
						'您直接通过网址访问表单提交页面',
						'请尝试关掉其他页面',
						'或者返回首页再试一次'
					]
				]));
			}
		}
		
		@setcookie(self::$cookieName, self::get(), 0, '/');
		
		View::setVar(self::$varName, function(){
			return AntiCSRF::get();
		});
	}
	
	/**
	 * 进行验证
	 * 在初始化的时候会自动对POST请求进行验证
	 *
	 * @return boolean
	 */
	public static function verify(){
		$result = i(self::$argName) == self::get();
		self::refush();
		
		return $result;
	}
	
	/**
	 * 刷新FormHash(验证值)
	 *
	 * @return string
	 */
	public static function refush(){
		$_SESSION[self::$sessionName] = 'xl_' . md5(uniqid() . rand());
		@setcookie(self::$cookieName, $_SESSION[self::$sessionName], 0, '/');
		return $_SESSION[self::$sessionName];
	}
	
	/**
	 * 获取FormHash(验证值)
	 *
	 * @return string
	 */
	public static function get(){
		return isset($_SESSION[self::$sessionName]) ? $_SESSION[self::$sessionName] : '';
	}
}