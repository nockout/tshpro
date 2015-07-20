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
	public function get_products($cond=array()){
		return $this->CI->Product_m->get_products($cond);
	}
	public function save($id,$save){
		return $this->CI->Product_m->save($id,$save);
		
	}
	public function get_product($id)
	{
		return $this->CI->Product_m->get($id);
	
	}
	public function generate_image($product_id){
			if(!intval($product_id))
				return;
			$this->CI->load->model("Image_m");
			$this->CI->load->library("image");
			$this->CI->load->config("tdesign");
			$upload_path=$this->CI->config->item('locate_upload_path');
			$this->CI->load->model("Product_m");
			$product=$this->CI->Product_m->get($product_id);
			if(empty($product))
				return;
			$extra=unserialize($product->extra);
			if(empty($extra['raw_url'])){
				return;
			}
			
			$id_image=$this->CI->Product_m->generate_image_id($product_id);
			$types=$this->CI->Image_m->image_types_by_names(array("products"=>1));
			if(empty($types))
				return false;
			foreach ($types as $t){
				$destPath=sprintf("%s/%s/%s",$upload_path,$t->name,$id_image."_".$product_id.'.jpg');
				$this->CI->image->resize_image($extra['raw_url'],$destPath,$t->width,$t->height);
				
			}

			return true;
			
	}
	public function generate_folder(){
		
			$this->CI->load->model("Image_m");
			$this->CI->load->config("tdesign");
			$types=$this->CI->Image_m->image_types_by_names(array("products"=>1));
			if(empty($types))
				return;
			foreach ($types as $t){
			if(!is_dir($this->CI->config->item('locate_upload_path').$t->name)){
				mkdir($this->CI->config->item('locate_upload_path').$t->name,0777, true);
			}
		}	
	}


}