<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Permissions controller
 *
 * @author		PyroCMS Dev Team
 * @package 	PyroCMS\Core\Modules\Order\Controllers
 */



class Admin extends Admin_Controller
{

	/**
	 * Constructor method.
	 *
	 * As well as everything in the Admin_Controller::__construct(),
	 * this additionally loads the models and language strings for
	 * permission and group.
	 */
	protected $validation_rules = array(
			'title' => array(
					'field' => 'title',
					'label' => 'lang:status',
					'rules' => 'trim|callback_check_status'
			),
		
			
			
	);
	public function __construct()
	{
	    parent::__construct();
	    Events::trigger('save_order',array());
		$this->load->config('tdesign');
	    $this->lang->load('order');
	    $this->load->helper(array("currency",'tdesign'));
	    $this->load->model("search_model");
	}

	/**
	 * The main index page in the administration.
	 *
	 * Shows a list of the groups.
	 */
	
	
	
	function action(){
		echo "<pre>";
		print_r($_POST);die;
	}
	
	public function check_status(){
		$status=$this->input->post("status");
		$comment=$this->input->post("comment");
		if($status==ORDER_STATUS_CANCEL && empty($comment)){
			return false;
		}
		return true;
		
	}
	
	private function _statusByGroup($group){
	
		$status=array(
				""=>lang("ORDER_STATUS_ALL"),
				ORDER_STATUS_NO_PROCESS=>lang("ORDER_STATUS_NO_PROCESS"),
				ORDER_STATUS_MANUFACTORING=>lang("ORDER_STATUS_MANUFACTORING"),
				ORDER_STATUS_PROCEED=>lang("ORDER_STATUS_PROCEED"),
				ORDER_STATUS_CANCEL=>lang("ORDER_STATUS_CANCEL"),
				ORDER_STATUS_CLOSED=>lang("ORDER_STATUS_CLOSED"),
		);
		switch ($group) {
			case "manufacturer" :
				$status=array(
				""=>lang("ORDER_STATUS_ALL"),
				ORDER_STATUS_MANUFACTORING=>lang("ORDER_STATUS_MANUFACTORING"),
				ORDER_STATUS_PROCEED=>lang("ORDER_STATUS_PROCEED")
				);
				break;
			
				
		}
		return $status;
	}
	public function sendcommission(){
		if($this->input->is_ajax_request()){
		
			$idOrder=intval($this->input->get('id'));
			$this->load->model('order_m');
		
			$commisions=$this->order_m->add_artis_commision($idOrder);
			
			echo json_encode(array('message'=>lang('order:send_comission_success')));
		}
	}
	public function delcommission(){
		if($this->input->is_ajax_request()){
	
			$idOrder=intval($this->input->get('id'));
			$this->load->model('order_m');
	
			$commisions=$this->order_m->remove_artis_commision($idOrder);
				
			echo json_encode(array('message'=>lang('order:send_comission_success')));
		}
	}
	public function form($id=null){
		
		$id or redirect("admin/order/index");
		$this->load->model('order_m');
		$detail=$this->order_m->get($id);
		$commisions=$this->order_m->get_artist_commission($id);
	
		$data=array('commisions'=>$commisions,'order_id'=>intval($id),'isSendArtistComission'=>$this->order_m->_isSendArtisComission($id));
		$data['artis_commisions']=$this->template->load_view('admin/artis_commission',$data,true);
		$data['detail']=$detail;
	
		if(empty($detail)){
			$this->session->set_flashdata("error",lang("order:no_order_found"));
			redirect("admin/order/index");
		}
		
		$this->form_validation->set_rules($this->validation_rules);
		
		if ($this->form_validation->run() == FALSE) {
			$statuses=$this->_statusByGroup($this->current_user->group);
			$this->template->set($data)->title(lang("order:order"))->set('status',$statuses)
			->set("title",lang("order:order_title"));
			
			$group=$this->current_user->group;
			
			
			if($group=='manufacturer'){
				$this->template->build('admin/form_manu');
			}else{
				$this->template->build('admin/form');
			}
			
			
			
		}else{
			$save['id']=$id;
			$save['notes']=$this->input->post("comment");
			$save['status']=$this->input->post("status");
			
			$id=$this->order_m->save($save);
			if($id)
			$this->session->set_flashdata("success",lang("order:save_success"));
			else 
				$this->session->set_flashdata("success",lang("order:edit_error"));
			

			Events::trigger('order_update', array('id'=>$id));

			if($this->input->post("btnAction")=="save_exit"){
				redirect("admin/order/");
			
			}else{
				redirect("admin/order/form/".$id);
			}
			
		}
		
		
	}
	public function index($code = 0,  $by = 0, $way = "ASC",$page = 0)
	{
		
		
		if ($this->input->post('search')) {

            $object = $this->input->post();
     
            $code = $this->search_model->record_term(json_encode($object));
            // echo $code;die;
            redirect(site_url(array('admin', 'order',"index", $code,$by, $way ,$page)));
        }
        $term = array();
        if ($code) {

            $term = json_decode($this->search_model->get_term($code));
        }
      
		
		$data['term']=(array)$term;
		$this->load->model('order_m');
		
		$data['term']['group_status']=array_keys($this->_statusByGroup($this->current_user->group));
		$status=$this->_statusByGroup($this->current_user->group);
		
		$designs=$this->order_m->get_orders($data,$by,$way,$page,6);
		
		$pagination=panagition("admin/order/index/$code/$by/$way/",4,$designs['total'],$page,6);
		
		
		$this->template->set("term",(array)$term);
 		$this->template->
 			set('orders',$designs['objects'])
 			->set('status',$status)
 			->set('pagination', $pagination)
 			->title($this->module_details['name'])
			->build('admin/index');;

	}
			
		
	
	


	
}
