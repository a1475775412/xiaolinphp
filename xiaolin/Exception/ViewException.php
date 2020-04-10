<?php
/* ----------------------------------------------- *
 | [ XiaoLin ] Version : 2.0 beta
 | 简单粗暴又不失高雅的迫真 OOP MVC 框架，，，
 |
 | URL     : https://blog.test404.club/
 * ----------------------------------------------- *
 | Name    : Exception:View (异常类:模板、视图)
 |
 | Author  : Xiaolin (a1475775412@foxmail.com)
 | LICENSE : WTFPL http://www.wtfpl.net/about
 * ----------------------------------------------- */

namespace XiaoLin\Exception;

use XiaoLin\Exception\Exception;
use XiaoLin\View;

class ViewException extends Exception{
    public function __construct($code, $filepath = '', $filename = '', $file = '')
    {
		$this->code = $code;
		
		switch($this->code){
			case 0:
				$this->message = l('模板文件未找到！');
			break;
			
			case 1:
				$this->message = l('写入模板引擎缓存文件失败！');
			break;
		}
		
		$this->template_filepath = $filepath;
		$this->template_filename = $filename;
		$this->template_file = $file;
		$this->GlobalVars = View::getGlobalVar();
		$this->Vars = View::getVar();
    }
}