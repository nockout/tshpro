<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Product_m extends MY_Model
{
	protected $_table = 'tshirt_products';
	protected $_users="users";

	protected $_descriptions="tshirt_product_descriptions";
	protected $_viewAllgroups=array("admin","moderate");
	protected $_cate_des='tshirt_category_descriptions';
	public function __construct()
	{
		parent::__construct();
		
	}
	public function get_designs($params,$limit=6,$offset=0){
		

		//$this->db->select("*");
		if($this->allowViewAll()){
			$this->db->set('user_id',$this->current_user->user_id);	
		}
		if(isset($params['category'])){
		//	$this->load->model('product_categories_m');
	
		//	$categories=array_merge(array(intval($params['category'])),$this->product_categories_m->get_sub_cate(1));
		//	$this->db->select("(SELECT username FROM ".(SITE_REF."_".$this->_users)." WHERE id=user_id LIMIT 1) AS user_name", FALSE);
		}
		$this->db->select("*");
		//$this->db->select("(SELECT group_concat(category) FROM ".(SITE_REF."_".$this->_cate_des)." WHERE category_id in (product_cate) ) AS cate_name", FALSE);
		$this->db->select("(SELECT username FROM ".(SITE_REF."_".$this->_users)." WHERE id=user_id LIMIT 1) AS user_name", FALSE);
		$this->limit($limit,$offset);
		$this->db->join($this->_descriptions,$this->_descriptions.'.product_id='.$this->_table.'.product_id');
		$this->db->where('lang_code',CURRENT_LANGUAGE);
		return $this->get_all();
	//	 $this->db->set_dbprefix(SITE_REF.'_');
	}
	private function allowViewAll(){
		return (in_array($this->current_user->group, $this->_viewAllgroups))?true:false;
	}

}