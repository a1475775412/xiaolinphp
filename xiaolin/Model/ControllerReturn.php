<?php
namespace XiaoLin\Model;

class ControllerReturn{
	public $type = '';
	public $data = '';
	
	function __construct($type, $data){
		$this->type = $type;
		$this->data = $data;
	}
}