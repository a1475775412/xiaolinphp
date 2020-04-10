<?php
/* ----------------------------------------------- *
 | [ XiaoLin ] Version : 2.0 beta
 | 简单粗暴又不失高雅的迫真 OOP MVC 框架，，，
 |
 | URL     : https://blog.test404.club/
 * ----------------------------------------------- *
 | Name    : Exception:Init (异常类:初始化)
 |
 | Author  : Xiaolin (a1475775412@foxmail.com)
 | LICENSE : WTFPL http://www.wtfpl.net/about
 * ----------------------------------------------- */

namespace XiaoLin\Exception;

use XiaoLin\Exception\Exception;

class InitException extends Exception{
    public function __construct($code, $path = '')
    {
		$this->code = $code;
		$this->path = $path;
		
		switch($this->code){
			case 0:
				$this->message = 'Application directory does not exist.';
			break;
			
			case 1:
				$this->message = l('模板目录不存在！');
			break;
		}
    }
}