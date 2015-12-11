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
}