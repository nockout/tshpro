<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog\Models
 */
class Trans_m extends MY_Model
{
	protected $_table = 'artis_commision_transaction';
	//protected $_orderItem='tshirt_order_items';

	public function get_trans($params,$by="",$way="",$page=0,$limit=6){
		
		$this->db->select("SQL_CALC_FOUND_ROWS *", FALSE);
		
		if(!empty($params['term'])){
					
			$term=(array)$params['term'];
			
			
			
			
		
		}
		
		if(!empty($params['user_id']))
		{
			$this->db->where("user_id", intval($params['user_id']));
		}
	
		$this->db->offset($page)->limit($limit);
		$object=$this->db->order_by("date_added","DESC")->get($this->_table)->result();
	
		$result['objects']=$object;
		$result['total']=0;
		$query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		$result['total']= $query->row()->Count;
		
		return $result;
	}
	public function get($id){
		
		$order=$this->db->where('id',intval($id))->get($this->_table)->row();
		
		if(empty($order))
			return;
		
		// get arts from product_id;
		//$this->db->select()
		$order->items=$this->db->where("order_id",intval($id))->get($this->_orderItem)->result();
		if(!empty($order->items)){
			
			foreach ($order->items as &$item){
				$contents=unserialize($item->contents);
				
				$item->arts=$this->db->select("data")->from('tshirt_arts')->where("id",$contents['id_art'])->get()->row();
				$item->designer=$this->get_designer($contents['user_id']);
			}
			
		}
	
		$zone=$this->get_shipzone($order->ship_zone_id);
		if($zone)
			$order->shipzone=$zone->name;
		return $order;
	}
	private function get_designer($id){
		return $this->db->where("id",intval($id))->get("users")->row();
	}
	private function get_shipzone($zone_id){
		return  $this->db->where("id",intval($zone_id))->get("tshirt_shipping_zones")->row();
		
	}
	
	
	
	

}