<?php
class Art_model extends CI_Model
{
	var $table="tshirt_arts";
	function __construct() {
		parent::__construct();
	}
	
	// save or update a route and return the id
	public function analys_arts(){
		$analys['total']=self::get_statictis();
		$analys['not_approval']=self::get_statictis(array('allowed'=>0));
		$analys['new']=self::get_statictis(array('new'=>1));
		// get 
		return $analys;
	}
	 function get_statictis($params=array()){
		if(!empty($params)){
			$this->db->where($params);
		}
		
		return $this->db->count_all_results($this->table);
	}
	function status($id,$status){
		if(!intval($id))
			return ;
		if($id){
			$this->db->where('id',$id)->update($this->table,array('allowed'=>$status));
		}
	}
	function deleteall($ids=array()){

		if(empty($ids) || empty($this->current_user->id))
			return;
		$this->db->where_in('id_art',$ids)->update('tshirt_products',array('deleted'=>3));
		return $this->db->where_in('id',$ids)->update($this->table,array('deleted'=>1));
	}
	
	function statusall($ids=array(),$status=0){
	
		if(empty($ids) || empty($this->current_user->id))
			return;
		$status=intval($status)?1:0;
		if($status==1){
			//
			
			$this->db->where_in('id_art',$ids)->update('tshirt_products',array('deleted'=>0,'status'=>"A",'is_gc'=>1));
		}else{
			$this->db->where_in('id_art',$ids)->update('tshirt_products',array('deleted'=>3,'status'=>"D",'is_gc'=>0));
		}
		return $this->db->where_in('id',$ids)->update($this->table,array('allowed'=>$status));
	
		/* $checkGroup=array('admin','sale');
			$group=$this->current_user->group;
			if(empty($ids) || empty($this->current_user->id))
				return;
				if(!in_array($group, $checkGroup))// check is design
				{
				$user_id=$this->current_user->id;
				$subSQl=$this->db->select('id')->from($this->table)->where_in('id',$ids)->where('user_id',$user_id)->get_compiled_select();
				echo "<pre>";
				PRINT_R($subSQl);die;
				}
				else {
				$this->db->where_in('id',$ids)->update();
		} */
			
	}
	function isActive($id){
		if(empty($id))
			return false;
		return $this->db->where('id',$id)->where(array("deleted"=>0,"allowed"=>1))->get($this->table);
	}
	function change_name($id="",$data){
		$group=$this->current_user->group;
		if($group=="artist"){
			$this->db->where('user_id',$this->current_user->id);
		}
		if(empty($id))
			return;
		if(!empty($data)){
			return $this->db->where('id',intval($id))->update($this->table,$data);
		}
		return ;
	}
}