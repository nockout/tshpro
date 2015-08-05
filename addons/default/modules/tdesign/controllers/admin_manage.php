<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Permissions controller
 *
 * @author		PyroCMS Dev Team
 * @package 	PyroCMS\Core\Modules\Permissions\Controllers
 */
class Admin_Manage extends Admin_Controller
{

	/**
	 * Constructor method.
	 *
	 * As well as everything in the Admin_Controller::__construct(),
	 * this additionally loads the models and language strings for
	 * permission and group.
	 */
	public function __construct()
	{
	    parent::__construct();
	    $this->lang->load('design');
	    $this->load->model('product_m');
	    //$this->load->model('groups/group_m');
	  //  $this->lang->load('permissions');
	   // $this->lang->load('groups/group');
	}

	/**
	 * The main index page in the administration.
	 *aa
	 * Shows a list of the groups.
	 */
	
	public function arts($page=0,$limit=12){
	
		$object=$this->product_m->get_arts(array(),$page,$limit);
		$arts="";
		if(!empty($object)){
			$arts=$object['objects'];
		}
		
		$this->template->
		set('arts',$arts)
		->append_css("module::designer.css")
		->title(lang("design:arts"))
		->build('admin/arts');
	}
	public function index($id=null)
	{
		$id or redirect("admin/tdesign/manage/arts");
	
		$objects=$this->product_m->get_products(array("id_art"=>intval($id)));
		$artobj=$this->product_m->find_art_by_id($id);
		
		$arts="";
		if(!empty($artobj)){
			$arts=unserialize($artobj->data);
		}
		//echo "<pre>";
	//	print_r($arts);die;
		//echo "<pre[>";
		$designs='';
		//print_r($objects);die;
		if(!empty($objects)){
			$designs=$objects['objects'];
		}
		
		$categories =array();
	
		$this->template->set('categories',$categories);
 		$this->template->
 			set('designs',$designs)->
 			set('art_id',$id)->
 			set('arts',$arts)
 			->title($this->module_details['name'])
			->build('admin/index');
	}
	
	
	
}