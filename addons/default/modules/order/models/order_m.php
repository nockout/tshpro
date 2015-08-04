<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog\Models
 */
class Order_m extends MY_Model
{
	protected $_table = 'tshirt_orders';
	protected $_orderItem='tshirt_order_items';

	public function get_orders($params,$page=0,$limit=6){
		
		$this->db->select("SQL_CALC_FOUND_ROWS *", FALSE);
		if(!empty($params))
		$this->db->where($params);
		
		$this->db->offset($page)->limit($limit);
		$object=$this->db->order_by("ordered_on","DESC")->get($this->_table)->result();
		
	
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
		$order->items=$this->db->where("order_id",intval($id))->get($this->_orderItem)->result();
		return $order;
	}
	public function save($param) {
		if(empty($param))
			return;
		$id="";
		if(!empty($param['id'])){
			$id=intval($param['id']);
			$this->db->where("id",intval($param['id']))->update($this->_table,$param);
	
		}
		return $id;
	}

}