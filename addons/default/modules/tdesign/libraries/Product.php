<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Product{
	var $CI;
	public function __construct()
	{
		$this->CI= &get_instance();
		$this->CI->load->model("Product_m");
	}
	public function create_draft($extra=null){
	
		return $this->CI->Product_m->create_draft($extra);
	}
	public function get_draft($product_id){
	
		$design= $this->CI->Product_m->get_product_draft($product_id);
		if(empty($design))
			return;
		$extra=unserialize($design->extra);	
		if(isset($extra['image'])){

			$design->image=$extra['image'];
		}
		
		return $design;
	}
	public function get_product($id)
	{
		return $this->CI->Product_m->get($id);
	
	}


}