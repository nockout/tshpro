<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
/**
 * Sample Events Class
 *
 * @package PyroCMS
 * @subpackage Sample Module
 * @category events
 * @author PyroCMS Dev Team
 */
class Events_Order {
	protected $ci;
	public function __construct() {
		$this->ci = & get_instance ();
		
		Events::register ( 'order_update', array (
				$this,
				'run' 
		) );
	}
	public function run($orderInfo) {
		if (! empty ( $orderInfo )) {
			
			$id = $orderInfo ['id'];
			if ($id) {
				$this->ci->load->model ( 'order/order_m' );
				$detail = $this->ci->order_m->get ( $id );
				if (empty ( $detail ))
					return;
				if ($detail->status == ORDER_STATUS_MANUFACTORING) {
					
					$this->_mailToManufacterDepartment ( $detail );
				} elseif ($detail->status == ORDER_STATUS_PROCEED) {
					$this->_mailToSaleDepartment ( $detail );
				}
			}
		}
	}
	private function _mailToManufacterDepartment($orderDetail) {
		$this->ci->load->model ( 'users/ion_auth_model' );
		$users = $this->ci->ion_auth_model->get_active_users ( 'manufacturer' )->result ();
		
		if (! empty ( $users )) {
			foreach ( $users as $user ) {
				
				$array = Events::trigger ( 'email', array (
						'slug' => 'mail-to-manufacturer-deparment',
						'to' => $user->email,
						'name' => $user->first_name . $user->last_name,
						'order_id' => sprintf ( '#%s', $orderDetail->order_number ),
						//'link' => site_url ( 'admin/order/form/4' ) 
				), 'array' );
			}
		}
		return;
	}
	private function _mailToSaleDepartment($orderDetail) {
	
		$this->ci->load->model ( 'users/ion_auth_model' );
		$users = $this->ci->ion_auth_model->get_active_users ( 'sale' )->result ();
		
		if (! empty ( $users )) {
			foreach ( $users as $user ) {
				
				$array = Events::trigger ( 'email', array (
						'slug' => 'mail-to-sale-deparment',
						'to' => $user->email,
						'name' => $user->first_name . $user->last_name,
						'order_id' => sprintf ( '#%s', $orderDetail->order_number ),
						//'link' => site_url ( 'admin/order/form/4' ) 
				), 'array' );
			}
		}
		return;
	}
}