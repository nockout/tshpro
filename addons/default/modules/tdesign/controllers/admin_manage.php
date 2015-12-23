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
	    $this->load->model(array('product_m',"art_model",'search_model'));
	   
	    
	 
	}

	/**
	 * The main index page in the administration.
	 *aa
	 * Shows a list of the groups.
	 */
	
	public function arts($code = 0,  $by = 0, $way = "ASC",$page = 0){
	
		//print_r($_POST);die;
		if ($this->input->post('search')) {
		
			$object = $this->input->post();
			
			$code = $this->search_model->record_term(json_encode($object));
			// echo $code;die;
			redirect(site_url(array('admin', 'tdesign',"manage",'arts', $code,$by, $way ,$page)));
		}
		$term = array();
		if ($code) {
		
			$term = (array)json_decode($this->search_model->get_term($code));
		}
		
		
		$object=$this->product_m->get_arts($term,$page,10);
		$arts="";
		if(!empty($object)){
			$arts=$object['objects'];
		}
		$this->load->helper(array("currency",'tdesign'));
		$pagination=panagition("admin/tdesign/manage/arts/$code/$by/$way/",8,$object['total'],$page,10);
		
		$this->template->
		set('arts',$arts)
		->set('term',($term))
		->set('pagination',$pagination)
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
		$designs='';
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
	public function action(){
		$action=$this->input->post('submit');
		$this->load->model('art_model');
		$ids=$this->input->post('action_to');
		
		switch ($action){
			case "activate":
				
				$this->art_model->statusall($ids,1);
				break;
				case "disable":
				
					$this->art_model->statusall($ids,0);
					break;
			case "delete":
				$this->art_model->deleteall($ids);
					break;
				
		}
		$this->load->library('user_agent');
		if ($this->agent->is_referral())
		{
			redirect ($this->agent->referrer());
		}
		redirect('admin/tdesign/manage/arts'); 
		/* if ($id = $this->streams->entries->insert_entry($_POST, 'blog', 'blogs', array('created'), $extra))
			{
				
				$this->session->set_flashdata('success', sprintf($this->lang->line('blog:post_add_success'), $this->input->post('title')));

			
			}
			else
			{
				$this->session->set_flashdata('error', lang('blog:post_add_error'));
			}

			
			 redirect('admin/tdesign/manage/arts); */
	}
	public function change_name()
	{
		
		$idArt=$this->input->post('id');
		$newName=$this->input->post('name');
		if(intval($idArt)&&$newName){
				
				$this->art_model->change_name($idArt,array('name'=>$newName));
		}
	}	
}