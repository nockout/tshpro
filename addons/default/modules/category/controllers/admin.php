
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
	    $this->load->model(array("category_m","Routes_model"));
	    $this->load->helper(array("MY_string"));
	    
	     
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
	public function action(){
		
		
		redirect('admin/category');
	}
	public function delete($id=null){
		if(!empty($id)){
			$categories=$this->category_m->delete(intval($id));
		}
		redirect('admin/category');
	}	

	public function form($id=null){
		$data['category']="";
		$data['parent_id']="";
		$data["position"]="";
		$data["timestamp"]="";
		$data['status']="";
		$data["description"]="";
		$data['slugurl']="";
		$data['slug_id']="";
		if(intval($id)){
			$category=$this->category_m->get_category($id);
			$data['category']=$category->category;
		
			$data['status']=$category->status;
			$data["timestamp"]=$category->timestamp;
			$data["description"]=$category->description;
			
			$data['slugurl']=$category->slugurl;
			$data['slug_id']=$category->slug_id;
			
		}
		
		
		$this->form_validation->set_rules('slugurl', 'lang:design:slug', 'trim|callback_checkslug['.$id.']');
		$this->form_validation->set_rules($this->validation_rules);
		
		$this->form_validation->set_message('checkslug', lang('slug_exist'));
		if ($this->form_validation->run() == FALSE) {
			
		
		
			$this->template->set($data);
		
			
			$this->template->append_metadata($this->load->view('fragments/wysiwyg', array(), true))->build('admin/form');
				
		} else {
			
			
			$slug = $this->input->post('slugurl');
				
			if (empty($slug) || $slug == '') {
				$slug = $this->input->post("title");
				$slug = create_slug($slug);
			}
				
			
				
			if ($id) {
				$route_id = $category->slug_id;
				if (!$this->Routes_model->check_slug_exist_product($slug, $route_id)) {
					$slug = $this->Routes_model->validate_slug($slug, $route_id);
					if (!$this->Routes_model->check_routes_by_id($route_id)) {
						$route['keyword'] = $slug;
						$route['entity']='category';
						$route['oid']=$id;
						$route_id = $this->Routes_model->save($route);
					}
				}
			} else {
				$slug = $this->Routes_model->validate_slug($slug);
				$route['keyword'] = $slug;
				$route['entity']='category';
				$route_id = $this->Routes_model->save($route);
			}
			
			
			$save['category_id']=intval($id);
			$save['parent_id']=1;
			$save['status']=$this->input->post("status");
			$save['lang'][CURRENT_LANGUAGE]['slugurl']=$slug;
			$save['lang'][CURRENT_LANGUAGE]['slug_id']=$route_id;
			
			
			$save['lang'][CURRENT_LANGUAGE]['category']=$this->input->post("title");
			$save['lang'][CURRENT_LANGUAGE]['description']=$this->input->post("body");
				
			$id=$this->category_m->save($id,$save);
			if($id){
				$this->session->set_flashdata("success",sprintf(lang("category:publish_success"),$this->input->post("title")));
			}else{
				$this->session->set_flashdata("error",sprintf(lang("category:publish_error"),$this->input->post("title")));
			}
		
			
			
			$route['url_alias_id'] = $route_id;
			$route['keyword'] = $slug;
			$route['query'] = 'home/cate/' . $id . '';
			$route['oid'] = $id;
			$this->Routes_model->save($route);
			
			
			if($this->input->post("btnAction")=="save_exit"){
				redirect("admin/category/index/");
			}else{
				redirect("admin/category/form/".intval($id));
			}
		
		}
	}
	
	function checkslug($field, $id) {
		
		if ($field == "" || empty($field)) {
			$slug=create_slug($field);
				
	
		} else
			$slug = create_slug($field);
	
		if (intval($id)>0) {
			
			
			$cate=$this->category_m->get_category($id);
			$slug_id = $cate->slug_id;
			if ($this->Routes_model->check_slug($slug, $slug_id)) {
				return false;
			}
		} else {
			if ($this->Routes_model->check_slug($slug)) {
				return false;
			}
		}
	}
	

}