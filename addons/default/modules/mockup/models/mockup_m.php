<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "base_m.php";
class Mockup_m extends Base_m
{
	protected $_table = 'tshirt_mockup';	

	protected $_primary="id_mockup";
	protected $lang_table="tshirt_mockup_lang";
	
	public function __construct()
	{
		parent::__construct();
		
	}
	public function delete($id){
		
		
		if(!is_array($id)){
			$id=array($id);
		}
		if(!$this->db->where_in($this->_primary,$id)->get($this->_table)->result()){
		
			return false;
		}
		return $this->db->where_in($this->_primary,($id))->update($this->_table,array("deleted"=>1));
	}
	public function auto_delete($id){
		if(empty($id))
			return ;
		if(!is_array(($id))){
			$id=array($id);
		}
		
		$this->db->where_in($this->_primary,($id));
		if($this->db->delete($this->_table)){
			return	$this->db->where_in($this->_primary,($id))->delete($this->lang_table);
		
		}
		return  ;
		
	}
	
	public function get_mockups($params,$offset=0,$limit=6){
	

		$this->db->select("SQL_CALC_FOUND_ROWS *", FALSE);

		
		$this->db->join($this->lang_table,$this->lang_table.'.'.$this->_primary.'='.$this->_table.'.'.$this->_primary);
		$this->db->where('lang_code',CURRENT_LANGUAGE);
		$this->db->where('deleted',0);
		$this->db->offset($offset)->limit($limit);
		$this->db->order_by("position");
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

	
		$this->db->select("*");
		$this->db->join($this->lang_table,$this->lang_table.'.'.$this->_primary.'='.$this->_table.'.'.$this->_primary,"LEFT");
		$this->db->where('lang_code',CURRENT_LANGUAGE);
		$this->db->where('deleted',0);
		$result=$this->db->where($this->_table.'.'.$this->_primary,$id)->get($this->_table)->row();

		
	
		return $result;
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
			$this->db->where($this->_primary,intval($id))->update($this->_table,$save);
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
	
	
	

}