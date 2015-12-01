<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tdesign_lib{
	var $CI;
	public function __construct()
	{
		$this->CI=&get_instance();
			
	}
	
	public function create_design(){
		if(empty($this->CI->current_user))
			return false;
		
		
	}
	private function save_design(){
		
	}
}