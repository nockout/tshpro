<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog\Models
 */
class Order_m extends MY_Model
{
	protected $_table = 'tshirt_orders';
	protected $_orderItem='tshirt_order_items';

	public function get_orders($params,$by="",$way="",$page=0,$limit=6){
		
		$this->db->select("SQL_CALC_FOUND_ROWS *", FALSE);
		if(!empty($params['term'])){
					
			$term=(array)$params['term'];
			if(!empty($term['status'])){
				$this->db->where('status', $term['status']);
			}
			if(!empty($term['group_status'])){
				
				$this->db->where_in('status', $term['group_status']);
			}
			if(!empty($term['from'])){
					
				$from=$term['from'];
				$myDateTime = DateTime::createFromFormat('d/m/Y', $from);
				$from = $myDateTime->format('Y-m-d 00:00:00');
			
				
				
				$this->db->where('ordered_on >=', $from);
				
				
				if(!empty($term['to']))
				{	$to=$term['to'];
			
					$myDateTime = DateTime::createFromFormat('d/m/Y', $to);
					$to = $myDateTime->format('Y-m-d 23:59:59');
				}
				else 
					$to=date('Y-m-d h:i:s');
				
				
				$this->db->where('ordered_on <=', $to);
			
			}
			
			
			if(!empty($term['f_keywords'])){
				
				$this->db->like('order_number', $term['f_keywords']);
				$this->db->or_like('ship_phone', $term['f_keywords']); 
				$this->db->or_like('ship_email', $term['f_keywords']);
				$this->db->or_like('ship_phone', $term['f_keywords']);
				$this->db->or_like("ship_firstname",$term['f_keywords']);
				
			}
			
		
		}
		
		
		
		$this->db->select("CONCAT(ship_firstname,' ',ship_lastname) as fullname" ,false);
		$this->db->offset($page)->limit($limit);
		$object=$this->db->order_by("ordered_on","DESC")->get($this->_table)->result();
	//	print_r($this->db->get_compiled_select);die;
	
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
	
	public function get_artist_commission($id){
		if(empty($id))
			return;
		
		$this->db->select(array('*','sum(dif_price*quantity) as earn'));
		$this->db->group_by('user_id');
		$this->db->where('order_id',intval($id));
		$comissions=$this->db->get('tshirt_order_items')->result();
		$this->load->model('users/Ion_auth_model','Ion_auth');
		if(!empty($comissions)){
			foreach ($comissions as $com){
					$com->user_info=$this->Ion_auth->get_user($com->user_id)->row();
				}
		}
		return $comissions;
	}
	
	public function add_artis_commision($idOrder){
		//remove comission first;
		
		if(empty($idOrder))
			return;
	
		$this->remove_artis_commision($idOrder);	
		$items=$this->_artis_orderItem($idOrder);
		$order=$this->get($idOrder);
		
	
		
		if(empty($idOrder) || empty($order))
			return;
		
	
		$inserts=array();
		foreach ( $items as $item ) {
			$inserts[] = array (
					'user_id' => $item->user_id,
					'order_id' => $idOrder,
					'quantity' => $item->quantity,
					'id_art' => $item->id_art,
					'description' => sprintf('Order #%s',$order->order_number), 
					'amount'=>$item->earn,
					'date_added'=>$order->ordered_on
			);
		}
		if(!empty($inserts))
		{
			
			$this->db->insert_batch('artis_commision_transaction', $inserts);
		}
		
		//
		return true;
	}
	private function _artis_orderItem($idOrder){

		if(empty($idOrder))
			return;
		
		$this->db->where('order_id',intval($idOrder));
		$this->db->select(array('*','sum(dif_price*quantity) as earn'));
		$this->db->group_by('id_art');
	
		$items=$this->db->get('tshirt_order_items')->result();
		
		return $items;
	}
	public function _isSendArtisComission($idOrder){
		return $this->db->where('order_id',intval($idOrder))->count_all_results('artis_commision_transaction');
	}
	public function remove_artis_commision($idOrder){
	
		if(empty($idOrder))
			return;
		$idOrder=intval($idOrder);
		return $this->db->where('order_id',intval($idOrder))->delete('artis_commision_transaction');
		
		
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