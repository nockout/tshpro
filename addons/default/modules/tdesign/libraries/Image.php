<?php
class Image{
	var $CI;
	public function __construct()
	{
		$this->CI=&get_instance();
			
	}
	public function resize_image($sourcePath,$desPath,$width=0,$height=0,$type="jpg"){
		if(!$width&&$heght)
			return;
		
		if(empty($sourcePath) || empty($desPath) )
			return false;
		$this->CI=&get_instance();
		
		$this->CI->load->library ( 'image_lib' );
		$config ['image_library'] = 'gd2';
		$config ['source_image'] = $sourcePath;
		
		$config ['new_image'] =$desPath;
		$config ['create_thumb'] = TRUE;
		$config ['maintain_ratio'] = TRUE;
	
		$config ['quality'] = 100;
		$config ['width'] =$width;
		$config ['height'] =$height;
		$this->CI->load->library ( 'image_lib', $config );
		$this->CI->image_lib->initialize ( $config );
		$config ['create_thumb'] = TRUE;
		$config ['thumb_marker'] = '';
		
		$this->CI->image_lib->initialize ( $config );
		
		if ($this->CI->image_lib->image_process_gd ("resize")) {
			return true;
		}
		return false;
	}
	
	
}