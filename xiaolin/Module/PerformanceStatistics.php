<?php
/* ----------------------------------------------- *
 | [ XiaoLin ] Version : 2.0 beta
 | 简单粗暴又不失高雅的迫真 OOP MVC 框架，，，
 |
 | URL     : https://blog.test404.club/
 * ----------------------------------------------- *
 | Name    : PerformanceStatistics (性能统计模块)
 |
 | Author  : Xiaolin (a1475775412@foxmail.com)
 | LICENSE : WTFPL http://www.wtfpl.net/about
 * ----------------------------------------------- */

namespace XiaoLin\Module;

use XiaoLin\AutoLoad;

class PerformanceStatistics{
	public static $show = true;
	public static $enable = true;
	
	public static $log = [];
	public static $begin = [];
	public static $SQLCount = 0;
	
	private $logIndex = 0;
	
	/**
	 * 开始统计
	 * 
	 * @return void
	 */
	public static function begin(){
		self::$begin = [
			'time'		=> self::fn(),
			'memory'	=> memory_get_usage()
		];
	}
	
	/**
	 * 进行记录
	 * 
	 * @param string $name 记录名称
	 * @return void
	 */
	public static function log($name = null){
		if(!self::$enable) return;
		
		self::$log[] = [
			'name'		=> $name,
			'time'		=> self::fn() - self::$begin['time'],
			'memory'	=> (memory_get_usage() - self::$begin['memory']) / 1024,
			'sql'		=> self::$SQLCount
		];
	}
	
	/**
	 * 输出记录
	 * 
	 * @return void
	 */
	public static function show(){
		if(!self::$enable || !self::$show) return;
		
		echo "\r\n" . '<!-- XiaoLin - 性能统计' . "\r\n";
		foreach(self::$log as $index => $row){
			echo '#' . $index . ($row['name'] ? ' - ' . $row['name'] : '') . "\r\n";
			echo 'Memory   ：' . round($row['memory'], 2) . ' KB' . "\r\n";
			echo 'Time     ：' . round($row['time'] * 1000, 2) . ' ms' . "\r\n";
			echo 'SQLQuery ：' . $row['sql'] . ' 次' . "\r\n\r\n";
		}
		
		echo 'AutoLoad: ' . count(AutoLoad::$included) . "\r\n";
		foreach(AutoLoad::$included as $index => $file){
			echo '#' . $index . ' - ' . str_replace(root, '', $file) . "\r\n";
		}
		
		echo "\r\n";
		
		echo 'Language Key Count: ' . count(Language::$lang) . "\r\n";
		echo 'Language Files: ' . count(Language::$loadFiles) . "\r\n";
		foreach(Language::$loadFiles as $index => $file){
			echo '#' . $index . ' - ' . str_replace(root, '', $file) . "\r\n";
		}
		
		echo 'Cache write: ' . count(Cache::$writeList) . "\r\n";
		foreach(Cache::$writeList as $index => $key){
			echo '#' . $index . ' - ' . $key . "\r\n";
		}
		echo 'Cache read : ' . count(Cache::$readList) . "\r\n";
		foreach(Cache::$readList as $index => $key){
			echo '#' . $index . ' - ' . $key . "\r\n";
		}
		
		echo "\r\n" . '-->';
	}
	
	/**
	 * 获取当前时间
	 * 
	 * @return loog
	 */
	private static function fn(){
		list($a, $b) = explode(' ',microtime()); //获取并分割当前时间戳和微妙数，赋值给变量
		return $a + $b;
	}
}