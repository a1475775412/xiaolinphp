<?php
/* ----------------------------------------------- *
 | [ XiaoLin ] Version : 2.0 beta
 | 简单粗暴又不失高雅的迫真 OOP MVC 框架，，，
 |
 | URL     : https://blog.test404.club/
 * ----------------------------------------------- *
 | Name    : Exception:AutoLoad (异常类:自动加载)
 |
 | Author  : Xiaolin (a1475775412@foxmail.com)
 | LICENSE : WTFPL http://www.wtfpl.net/about
 * ----------------------------------------------- */

namespace XiaoLin\Exception;

use XiaoLin\Exception\Exception;
use XiaoLin\View;

class AutoLoadException extends Exception{
    public function __construct($code, $class, $tryFiles = [], $loadFile = '')
    {
		$this->code = $code;
		$this->tryFiles = $tryFiles;
		
		switch($this->code){
			case 0:
				$this->message = l('无法自动加载类。');
				$this->class = $class;
			break;
			
			case 1:
				$this->message = l('已加载类文件，但未成功加载类。');
				$this->loadFile = $loadFile;
			break;
		}
    }
}