<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class product_categories_m extends MY_Model
 {

 	
 	protected $_table = 'tshirt_categories';
 	public function __construct()
 	{
 		parent::__construct();
 	
 	}
 	public function get_sub_cate($cat_id=1){
 		
 		if(!intval($cat_id))
 			return false;
 	
 		$this->db->select("category_id");
 		$this->db->where('parent_id',$cat_id);
 		$result=$this->db->get($this->_table)->result();
 	
 		if(empty($result))
 			return false;
 		
 		foreach ($result as $r){
 			$categories[]=$r->category_id;
 			$return=$this->get_sub_cate($r->category_id);
 			if(is_array($return))
			$categories=array_merge($categories,$return);
 				
 		}
 		
 		return $categories;
 			
 			
 	}
 
 }