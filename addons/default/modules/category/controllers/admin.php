
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
	protected $categories;
	protected $validation_rules = array(
			'title' => array(
					'field' => 'title',
					'label' => 'lang:global:title',
					'rules' => 'trim|htmlspecialchars|required'
			),
		
			'description' => array(
					'field' => 'body',
					'label' => 'lang:category:description_lable',
					'rules' => 'trim|htmlspecialchars|required'
			),
			'status' => array(
					'field' => 'status',
					'label' => 'lang:category:status',
					'rules' => 'trim|required'
			),
			
				
		
		
			
			
	);
	
	
	
	public function __construct()
	{
	    parent::__construct();
	    $this->lang->load("category");
	    $this->load->model("category_m");
	     
	}
	
	/**
	 * The main index page in the administration.
	 *
	 * Shows a list of the groups.
	 */
	
	
	
	
	public function index($page=0,$limit=6)
	{
		$categories=$this->category_m->get_categories(1);
		$this->template	->title($this->module_details['name']);
		$this->template->set("categories",$categories);
		$this->template->build('admin/index');

		
	}
		

	public function form($id=null){
		$data['category']="";
		$data['parent_id']="";
		$data["position"]="";
		$data["timestamp"]="";
		$data['status']="";
		$data["description"]="";
		if(intval($id)){
			$category=$this->category_m->get_category($id);
			$data['category']=$category->category;
		
			$data['status']=$category->status;
			$data["timestamp"]=$category->timestamp;
			$data["description"]=$category->description;
			
		}
		
		$this->form_validation->set_rules($this->validation_rules);
		
		if ($this->form_validation->run() == FALSE) {
			
		
		
			$this->template->set($data);
		
			
			$this->template->append_metadata($this->load->view('fragments/wysiwyg', array(), true))->build('admin/form');
				
		} else {
			
			
			$save['category_id']=intval($id);
			$save['parent_id']=1;
			$save['status']=$this->input->post("status");
			
			
			
			$save['lang'][CURRENT_LANGUAGE]['category']=$this->input->post("title");
			$save['lang'][CURRENT_LANGUAGE]['description']=$this->input->post("body");
				
			$id=$this->category_m->save($id,$save);
			if($id){
				$this->session->set_flashdata("success",sprintf(lang("category:publish_success"),$this->input->post("title")));
			}else{
				$this->session->set_flashdata("error",sprintf(lang("category:publish_error"),$this->input->post("title")));
			}
		
			if($this->input->post("btnAction")=="save_exit"){
				redirect("admin/category/index/");
			}else{
				redirect("admin/category/form/".intval($id));
			}
		
		}
	}
	
	
	

}