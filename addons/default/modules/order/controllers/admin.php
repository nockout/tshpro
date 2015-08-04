<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Permissions controller
 *
 * @author		PyroCMS Dev Team
 * @package 	PyroCMS\Core\Modules\Permissions\Controllers
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
	    $this->lang->load('order');
	    $this->load->helper("currency");
	}

	/**
	 * The main index page in the administration.
	 *
	 * Shows a list of the groups.
	 */
	
	
		
	public function check_status(){
		if($this->input->post("status")==2 && empty($this->input->post("comment"))){
			return false;
		}
		return true;
		
	}
	public function form($id=null){
		$id or redirect("admin/order/index");
		$this->load->model('order_m');
		$detail=$this->order_m->get($id);
		$data['detail']=$detail;
		if(empty($detail)){
			$this->session->set_flashdata("error",lang("order:no_order_found"));
			redirect("admin/order/index");
		}
		
		$this->form_validation->set_rules($this->validation_rules);
		
		if ($this->form_validation->run() == FALSE) {
			
			
			$this->template->set($data)->title(lang("order:order"))
			->set("title",lang("order:order_title"))
			->build('admin/form');
		}else{
			$save['id']=$id;
			$save['notes']=$this->input->post("comment");
			$save['status']=$this->input->post("status");
			
			$id=$this->order_m->save($save);
			if($id)
			$this->session->set_flashdata("success",lang("order:save_success"));
			else 
				$this->session->set_flashdata("success",lang("order:edit_error"));
			
			if($this->input->post("btnAction")=="save_exit"){
				redirect("admin/order/");
			
			}else{
				redirect("admin/order/form/".$id);
			}
			
		}
		
		
	}
	public function index($page=0,$limit=6)
	{
		$this->load->model('order_m');
		$designs=$this->order_m->get_orders(array(),$page,$limit);
		

	    $pagination = create_pagination('admin/order/index', $designs['total'],6);
		$categories =array();	

		$this->template->set('categories',$categories);
 		$this->template->
 			set('orders',$designs['objects'])
 			->set('pagination', $pagination)
 			->title($this->module_details['name'])
			->build('admin/index');;

	}
			
		
	
	


	
}
