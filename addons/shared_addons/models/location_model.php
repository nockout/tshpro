<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model
{
	protected $_table = 'provinces';
	protected $_shippings_zones = 'tshirt_shipping_zones';
		
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
	public function get_shipping_zones(){
		$return=array();
		$result=$this->db->select(array('id',"name"))->get($this->_shippings_zones)->result();
		foreach ($result as $r){
			$return[$r->id]=$r->name;
		}
		return $return;
	}
	public function zone_information($id){
		$zone=$this->db->where('id',intval($id))->get($this->_shippings_zones)->row();
		return $zone;
	}
}
