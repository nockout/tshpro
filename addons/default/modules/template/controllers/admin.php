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
		
			array(
					'field' => 'category_id',
					'label' => 'lang:template:category_label',
					'rules' => 'trim|required|numeric'
			),
			
		
			array(
					'field' => 'status',
					'label' => 'lang:template:template_status_label',
					'rules' => 'trim|alpha'
			),
			
			array(
					'field' => 'price',
					'label' => 'lang:template:price',
					'rules' => 'trim|numeric|required'
			),
			
		
		
			
			
	);
	
	public function __construct()
	{
	    parent::__construct();
		    $this->lang->load('template');

		    $this->categories =array(1=>"Shirt",2=>"Phone");
	}

	/**
	 * The main index page in the administration.
	 *
	 * Shows a list of the groups.
	 */
	
	public function action(){
		$this->load->library('tplate');
		
		switch ($this->input->post("btnAction")){
			case "delete":
				if($this->tplate->delete($this->input->post('action_to')))
					$this->session->set_flashdata("success",lang("template:action_success"));
				else 
					$this->session->set_flashdata("error",lang("template:action_unsuccess"));
				break;
			case "set_group":
				if($this->tplate->set_group($this->input->post('action_to')))
				$this->session->set_flashdata("success",lang("template:action_success"));
				else
					$this->session->set_flashdata("error",lang("template:action_unsuccess"));
		}
		redirect("admin/template/index");
	}
	public function index($page=0,$limit=6)
	{
		$this->load->library('tplate');
		$templates=$this->tplate->get_templates(array(),$page,$limit);
	
	    $pagination = create_pagination('admin/template/index', $templates['total'],$limit);
		
		
		$this->template->set('categories', $this->categories );
	
 		$this->template->set('templates',$templates['objects']);
 		$this->template->set('pagination', $pagination);
 		$this->template	->title($this->module_details['name']);;
		$this->template	->build('admin/index');

	}
		public function form($id=null,$type="null"){
	
		
		$this->load->library('form_validation');
		$data['colors_groups']=array();
		$data['id_template'] = $id;
		$data['timestamp'] = 0;
		$data['status'] ="";
		$data['price'] = "";
		$data['id_color'] ="";
		$data['title']="";
		$this->load->library('tplate');
		$data['categories']=$this->categories;
		$data['category_id']="";
		$colors=$this->tplate->get_colors();

		$this->template->set('colors',$colors);
		$this->load->library('tplate');
		if (intval($id)) {
		
				$tplate=$this->tplate->get_template($id);
				
			if(empty($tplate))
			{
				$this->session->set_flashdata("error",lang("tplate:no_tplate_found"));
				redirect("admin/tplate");
			}
			
			//if the tplate does not exist, redirect them to the tplate list with an error
		
			if (!$tplate) {
				$tplate = $this->tplate->get_template($id);
				if(!$tplate){
					$this->session->set_flashdata('error', lang('error_not_found'));
					redirect($this->config->item('admin_folder') . '/tplate');
				}
				$savelang['name'] = $tplate->name;			
				$savelang['id_template'] = $tplate->id_template;
		
				$savelang['description'] = $tplate->description;

		
				//   $savelang['lang']=$lang;
				$this->tplate->save_lang($id, $lang, $savelang);
				redirect($this->config->item('admin_folder') . '/ttplate/form/' . intval($id) );
			}
			//set values to db values
			$data['template_id'] = $id;
			$data['title'] = isset($tplate->name)?$tplate->name:"";
			$data['description'] = isset($tplate->short_description)?$tplate->short_description:"";
			$data['price'] =number_format($tplate->price, 2, ',', ' ');
			$data['timestamp']=$tplate->timestamp;
			$data['status']=$tplate->status;
			$data['id_color']=$tplate->color;
			$data['category_id']=$tplate->id_category_default;
		
			if($tplate->colors_groups){
				$data['colors_groups']=unserialize($tplate->colors_groups);
			}
			
		
		}
		//echo "<pre>";
		//print_r($_POST);die;
		$this->form_validation->set_rules($this->validation_rules);
		
		if ($this->form_validation->run() == FALSE) {
			
			$this->template->append_css("module::spectrum.css");
				$this->template->append_css("module::custom.css");
				$this->template->set('categories',array("1"=>"ROOT"));
				
				
				$this->template->set($data);
				
				$this->template
				->title($this->module_details['name'], lang('template:create_title'));
			
				$this->add_js();
				$this->template->build('admin/form');
			
			//	return;
			
		} else {
			$save['id_template'] = intval($id);
            $save['price'] =$this->input->post("list_price")?$this->input->post("list_price"):0.99;
            $save['status']=$this->input->post("status");
            $save['id_category_default']=$this->input->post("category_id");
            $save['color']=$this->input->post("id_color");
            $save['colors_groups']=serialize($this->input->post('colors'));
            if(!$save['id_template'])
            $save['timestamp']=date('Y-m-d H:i:s');
            $save['lang'][CURRENT_LANGUAGE]['name']=$this->input->post("title");
            $save['lang'][CURRENT_LANGUAGE]['description']=$this->input->post("description");
           
            $id_tplate=$this->tplate->save($id,$save);
          
            
            if($id_tplate){
				$this->session->set_flashdata ( "success", sprintf ( lang ( "template:publish_success" ), $this->input->post ( "title" ) ) );
			} else {
				$this->session->set_flashdata ( "error", sprintf ( lang ( "template:publish_error" ), $this->input->post ( "title" ) ) );
			}
			if ($this->input->post ( "btnAction" ) == "save_exit") {
				redirect ( "admin/template/index/" );
			} else {
				redirect ( "admin/template/form/" . intval ( $id_tplate ) );
			}
          
		}
		
		
		
		
	
	}

	private function add_js(){

		//Asset::js_inline('jQuery.noConflict();');
		$this->template->append_js("module::jquery-1.8.3.js");
		$this->template->append_js("module::jquery-ui-1.9.2.custom.js");
		$this->template->append_js("module::template/tmpl.min.js");
		$this->template->append_js("module::template/load-image.min.js");
	
		$this->template->append_js("module::jquery.fileupload.js");
		$this->template->append_js("module::jquery.fileupload-process.js");
		$this->template->append_js("module::jquery.fileupload-image.js");
		$this->template->append_js("module::jquery.fileupload-ui.js");
		$this->template->append_js("module::jquery.fileupload-jquery-ui.js");
		$this->template->append_js("module::locale.js");
		$this->template->append_js("module::main.js");
		$this->template->append_js("module::spectrum.js");
		//$this->template->append_js("module::example.js");
	}
	public function img_upload() {
		
		error_reporting(E_ALL | E_STRICT);
		$this->load->library('session');
		
		if(!isset($_REQUEST['id_template'])){
			echo json_encode(array());
						die;
		}
		$r = $_REQUEST['id_template'];
		
	
		//  $product_id = $this->session->userdata('pid');
		if ( $id_template = intval($r)) {
	
			$this->load->library("tplate");
			if ($id_template) {
				//$img = new Image_model();
				$this->tplate->processImage(intval($id_template));
				return;
			}
		}
		die('No product id found');
	}
	public function set_default($id_template=null, $id_image=null,$type=null){
		//$id_template=$this->input->post('id_image');
	//	$id_default=$this->input->post("id_template");
		if($id_image&&$id_template&&$type){
			$this->load->library("tplate");
			$this->tplate->set_default($id_template,$id_image,$type);
		}
	}
	
}