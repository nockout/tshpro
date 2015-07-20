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
	 *
	 * Shows a list of the groups.
	 */
	public function index()
	{
		
		$designs=$this->product_m->get_products(array());
		//echo "<pre>";
		//print_r($designs);;
	//	die;
		$categories =array();
		$this->template->set('categories',$categories);
 		$this->template->
 			set('designs',$designs)
 			->title($this->module_details['name'])
			->build('admin/index');
	}
	
	
	
}