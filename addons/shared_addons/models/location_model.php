<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model
{
	protected $_table = 'provinces';
	
		
	public function __construct()
	{
		parent::__construct();
		
	}
	public function get_provinces(){
		$return=array();
		$result=$this->db->select(array('id',"title"))->get($this->_table)->result();
		foreach ($result as $r){
			$return[$r->id]=$r->title;
		}
		return $return;
	}
	
}
