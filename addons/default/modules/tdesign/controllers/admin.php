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
	public function __construct()
	{
	    parent::__construct();
	    $this->lang->load('design');
	  //  $this->load->model('permission_m');
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
		
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image']	= APPPATH.'upload/design/temp/SF-Art-Template.png';
		$config['new_image']= APPPATH.'upload/design/temp/SF-Art-Template.png';
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config['width']	= $this->config->item("tdesign_template_img_resize_width");
		$config['height']	= $this->config->item("tdesign_template_img_resize_height");
		
		$this->load->library('image_lib', $config);
		
		$this->image_lib->resize();
			
			echo "aaa";
			die;
		
// 		$this->template
// 			->set('admin_group', $this->config->item('admin_group', 'ion_auth'))
// 			->set('groups', $this->group_m->get_all())
// 			->title($this->module_details['name'])
// 			->build('admin/index');
	}
	public function step1(){
				$this->template->append_css("module::step1.css");
				
				
				$this->template->title($this->module_details['name'])
				->build('admin/create/step_1');
	}

	
}