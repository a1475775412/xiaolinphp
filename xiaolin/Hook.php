<?php
/* ----------------------------------------------- *
 | [ XiaoLin ] Version : 2.0 beta
 | 简单粗暴又不失高雅的迫真 OOP MVC 框架，，，
 |
 | URL     : https://blog.test404.club/
 * ----------------------------------------------- *
 | Name    : Hook (钩子)
 |
 | Author  : Xiaolin (a1475775412@foxmail.com)
 | LICENSE : WTFPL http://www.wtfpl.net/about
 * ----------------------------------------------- */

namespace XiaoLin;

use XiaoLin\Module\PerformanceStatistics;

class Hook{
	private static $hookList = [];
	
	/**
	 * 将函数添加到钩子队列
	 * 越早添加的越早被执行
	 * 若函数返回FALSE(不包含空) 则停止执行下一个钩子
	 * 若函数返回TRUE 则停止执行并返回TRUE
	 * 函数别名: add_hook()
	 * 
	 * @param string   $id       钩子ID
	 * @param function $function 回调函数
	 * @return void
	 */
	public static function add(string $id, $function){
		self::$hookList[$id][] = $function;
	}
	
	/**
	 * 执行钩子
	 * 函数别名: do_hook()
	 * 
	 * @param string $id   钩子ID
	 * @param array  $args 参数们
	 * @return boolean
	 */
	public static function do($id, $args = []){
		if(isset(self::$hookList[$id])){
			foreach(self::$hookList[$id] as $index => $function){
				if($result = $function($args) === FALSE){
					break;
				}
				
				if($result === TRUE){
					return TRUE;
				}
				PerformanceStatistics::log('Hook:' . $id . ' #' . $index . '');
			}
		}
		
		return false;
	}
}