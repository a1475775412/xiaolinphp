<?php
/* ----------------------------------------------- *
 | [ XiaoLin ] Version : 2.0 beta
 | 简单粗暴又不失高雅的迫真 OOP MVC 框架，，，
 |
 | URL     : https://blog.test404.club/
 * ----------------------------------------------- *
 | Name    : Exception:Error (异常类:错误)
 |
 | Author  : Xiaolin (a1475775412@foxmail.com)
 | LICENSE : WTFPL http://www.wtfpl.net/about
 * ----------------------------------------------- */

namespace XiaoLin\Exception;

use XiaoLin\Exception\Exception;

class ErrorException extends Exception{
    public function __construct($errno, $errstr, $errfile, $errline)
    {
		$this->code = $errno;
		$this->message = $errstr;
		$this->file = $errfile;
		$this->line = $errline;
		
		$this->removeTraceCount = 1;
    }
}