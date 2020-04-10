<?php
/* ----------------------------------------------- *
 | [ XiaoLin ] Version : 2.0 beta
 | 简单粗暴又不失高雅的迫真 OOP MVC 框架，，，
 |
 | URL     : https://blog.test404.club/
 * ----------------------------------------------- *
 | Name    : Init (框架引导、初始化)
 |
 | Author  : Xiaolin (a1475775412@foxmail.com)
 | LICENSE : WTFPL http://www.wtfpl.net/about
 * ----------------------------------------------- */

define('xiaolin', dirname(__FILE__) . DIRECTORY_SEPARATOR);

define('xiaolin_version',		2002);
define('xiaolin_version_name', '2.0Beta');

if(version_compare(PHP_VERSION,'5.6.0', '<')){//测试php版本
	include(xiaolin . 'Template/oldVersion.php');
	die();
}

/* 性能统计 START */
include(xiaolin . 'Module' . DIRECTORY_SEPARATOR . 'PerformanceStatistics.php');
\XiaoLin\Module\PerformanceStatistics::begin();
\XiaoLin\Module\PerformanceStatistics::log('START');

/* (<ゝω·)☆ キラッ~! Kira~! */
include(xiaolin . 'XiaoLin.php');