<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog\Models
 */
class Trans_m extends MY_Model
{
	protected $_table = 'artis_commision_transaction';
	//protected $_orderItem='tshirt_order_items';

	public function get_artis_trans($user_id,$params,$by="",$way="",$page=0,$limit=6){
		
		
		if(empty($user_id))
			return;
	
			
		$this->db->select("SQL_CALC_FOUND_ROWS *", FALSE);
		
		if(!empty($params['term'])){
					
			$term=(array)$params['term'];
			
		
		}
		$this->db->where('user_id',intval($user_id));
		
		$this->db->offset($page);
		$this->db->limit(12);
		$object=$this->db->order_by("date_added","DESC")->get($this->_table)->result();
	
		$result['objects']=$object;
		$result['total']=0;
		$query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		$result['total']= $query->row()->Count;
		
		return $result;
	}
	public function get_trans($params,$by="",$way="",$page=0,$limit=6){
		
		$this->db->select("SQL_CALC_FOUND_ROWS *", FALSE);
	
		if(!empty($params['term'])){
				
			$term=(array)$params['term'];
				
				
				
				
	
		}
	
	
	
		$this->db->offset($page)->limit($limit);
		$object=$this->db->order_by("date_added","DESC")->get($this->_table)->result();
	
		$result['objects']=$object;
		$result['total']=0;
		$query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		$result['total']= $query->row()->Count;
	
		return $result;
	}
	
	
	
	

}