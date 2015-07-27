<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "base_m.php";
class Product_m extends Base_m
{
	protected $_table = 'tshirt_products';
	protected $_users="users";
	protected  $_primary="product_id";
	protected $lang_table="tshirt_product_descriptions";
	protected $_descriptions="tshirt_product_descriptions";
	protected $_viewAllgroups=array("admin","moderate");
	protected $_cate_des='tshirt_category_descriptions';
	protected $_images='tshirt_image';
	protected $_default_fields = array(
						'product_id'=>null, 
		 				'product_code'=>"FFFFF", 
		 				'product_type'=>"P", 
		 				'status'=>"D", 
		 				'user_id'=>0, 
		 				'list_price'=>0, 
		 				'amount'=>0,
						'weight'=>0, 
		 				'length'=>0, 
						'width'=>0, 
		 				'height'=>0, 
						'shipping_freight'=>0,
						"updated_timestamp"=>0,	
						'free_shipping'=>"N",
						
						'is_returnable'=>"N",
						"avail_since"=>0,
						"modified"=>0,
						'extra'=>"", 
						 
						
					);
		
	public function __construct()
	{
		parent::__construct();
		
	}
	public function delete($id){
		if(empty($id))
			return;
		if(!$this->allowViewAll())
		{
			$this->db->where("user_id",$this->current_user->user_id);
		}
		
		if(!is_array($id)){
			$id=array($id);
		}
		if(!$this->db->where_in("product_id",$id)->get($this->_table)->result()){
		
			return false;
		}
		return $this->db->where_in("product_id",($id))->update($this->_table,array("deleted"=>1));
	}
	public function auto_delete($id){
		if(empty($id))
			return ;
		if(!is_array(($id))){
			$id=array($id);
		}
		
		$this->db->where_in('product_id',($id));
		if($this->db->delete($this->_table)){
			return	$this->db->where_in("product_id",($id))->delete($this->_descriptions);
		
		}
		return  ;
		
	}
	
	public function get_products($params,$offset=0,$limit=6){
		

		//$this->db->select("*");
		if($this->allowViewAll()){
			$this->db->set('user_id',$this->current_user->user_id);	
		}
		if(isset($params['category'])){
		
		}

		$this->db->select("SQL_CALC_FOUND_ROWS *", FALSE);

		$this->db->select("(SELECT username FROM ".(SITE_REF."_".$this->_users)." WHERE id=user_id LIMIT 1) AS user_name", FALSE);
	
		$this->db->join($this->_descriptions,$this->_descriptions.'.product_id='.$this->_table.'.product_id');
		$this->db->where('lang_code',CURRENT_LANGUAGE);
		$this->db->where('deleted',0);
		$this->db->offset($offset)->limit($limit);
		$this->db->order_by("avail_since","DESC");
		$objct=$this->db->get($this->_table)->result();
		//print_r($objct);die;
		$return=array();
		$result['objects']=$objct;
		$result['total']=0;
		$query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
        $result['total']= $query->row()->Count;
          
	
		return $result;
		
	
	}
	public function get($id){
		if(!$this->allowViewAll()){
			$this->db->where("user_id",$this->current_user->user_id);
		}
		if($row=$this->is_draft($id)){
			return $row;
		}
		$this->db->select("*");
		$this->db->join($this->_descriptions,$this->_descriptions.'.product_id='.$this->_table.'.product_id',"LEFT");
		$this->db->where('lang_code',CURRENT_LANGUAGE);
		$this->db->where('deleted',0);
		$result=$this->db->where($this->_table.'.product_id',$id)->get($this->_table)->row();
		$result->images=$this->get_images($id);
		if(!empty($result->images)){
			$first=reset($result->images);
			$this->load->helper('tdesign');
			$result->image=get_design_image_path("original",$first->id_image.'_'.$first->product_id.'.jpg');
		}
	
		return $result;
	}
	public function get_images($id){
		if(!is_array($id)){
			$id=array($id);
		}
		return $this->db->where_in('product_id',$id)->get($this->_images)->result();
	}
	public function create_draft($extra=null){
				if(!empty($extra)){
					$this->_default_fields['extra']=serialize($extra);
				}
				unset($this->_default_fields['product_id']);
				$this->_default_fields['status']="O";
				$this->_default_fields['avail_since']=Date("Y-m-d H:i:s");
				$this->_default_fields['cate_id']=1;
				$this->_default_fields['user_id']=$this->current_user->id;
				$this->db->insert($this->_table,$this->_default_fields);
				$insert_id = $this->db->insert_id();
				$lang[CURRENT_LANGUAGE]['product']=isset($extra['name'])?$extra['name']:"";
				if($insert_id){
						$this->save_lang($insert_id,CURRENT_LANGUAGE,$lang[CURRENT_LANGUAGE]);
				}
				return $this->get_product_draft($insert_id);
							
	
	}
	public function save($id,$save){
		if(empty($save)){
			return false;
		}
		$status=$save['status'];
		if($save['status']=="D"){
			//$save['extra']=null;	
			$save['status']="A";
		}
		$lang=$save['lang'];
		unset($save['lang']);
		if(!$id){
			$this->db->insert($this->_table,$save);
			$id=$this->db->insert_id();		
		}else{
			$this->db->where("product_id",intval($id))->update($this->_table,$save);
		}
		///if($status=="D"){
		
			//create new description;
			//if(isset($lang[CURRENT_LANGUAGE])){
		$this->save_lang($id,CURRENT_LANGUAGE,$lang[CURRENT_LANGUAGE]);
			//}
		
		//}else{
			
		//}
		return $id;
	}
	public function put_live($id,$data){
			$this->save_lang($id,$this->langs,$data);
	}
	public function is_draft($id){
		return $this->db->where('product_id',intval($id))->where("status","D")->get($this->_table)->row();
	}
	public function get_product_draft($id){
		if(!$this->allowViewAll()){
			$this->db->where("user_id",$this->current_user->user_id);
		}
		$this->db->join($this->_descriptions,$this->_table.'.product_id='.$this->_descriptions.'.product_id',"LEFT");
		$this->db->where("lang_code",CURRENT_LANGUAGE);
		echo "<pre>";
		print_r( $this->db->where("status","D")->where($this->_table.'.product_id',$id)->get($this->_table)->row());
		die;
	}
	private function allowViewAll(){
		return (in_array($this->current_user->group, $this->_viewAllgroups))?true:false;
	}
	public function generate_image_id($product_id){
		if(!intval($product_id))
			return;
		$this->db->insert($this->_images,array('product_id'=>intval($product_id)));
		return $this->db->insert_id();
	}

}