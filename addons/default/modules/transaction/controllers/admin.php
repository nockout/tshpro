<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Permissions controller
 *
 * @author		PyroCMS Dev Team
 * @package 	PyroCMS\Core\Modules\Order\Controllers
 */



define('ITEM_PER_PAGE', 10);
class Admin extends Admin_Controller
{

	

	public function __construct()
	{
	    parent::__construct();
	    
	    
	    $this->lang->load('trans');
	    $this->load->helper(array("currency",'tdesign'));
	    $this->load->model("search_model");
	}

	public function index($code = 0,  $by = 0, $way = "ASC",$page = 0){
		
		$user_group=$this->current_user->group;
		if($user_group=='artist'){
			$this->_artistIndex($code = 0,  $by = 0, $way = "ASC",$page = 0);
		}else{
			$this->_commonIndex($code = 0,  $by = 0, $way = "ASC",$page = 0);
		}
	}
	private function _commonIndex($code = 0,  $by = 0, $way = "ASC",$page = 0){
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
		$this->load->model('trans_m');
		
		$trans=$this->trans_m->get_trans($data,$by,$way,$page,ITEM_PER_PAGE);
		
		$pagination=panagition("admin/transaction/index/$code/$by/$way/",7,$trans['total'],$page,ITEM_PER_PAGE);
		$this->template->set("term",(array)$term);
		$this->template->
		set('trans',$trans['objects'])
		
		->set('pagination', $pagination)
		->title($this->module_details['name'])
		->build('admin/index');;
	}
	private function _artistIndex($code = 0,  $by = 0, $way = "ASC",$page = 0){

		
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
		$this->load->model('trans_m');
		
		$data['user_id']=$this->current_user->id;
		$trans=$this->trans_m->get_trans($data,$by,$way,$page,ITEM_PER_PAGE);
		
		$pagination=panagition("admin/transaction/index/$code/$by/$way/",7,$trans['total'],$page,ITEM_PER_PAGE);
		$this->template->set("term",(array)$term);
		$this->template->
		set('trans',$trans['objects'])
		
		->set('pagination', $pagination)
		->title($this->module_details['name'])
		->build('admin/index');;
	}
	/**
	 * The main index page in the administration.
	 *
	 * Shows a list of the groups.
	 */
	
	

	
	

	
}
