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
					'label' => 'lang:global:title',
					'rules' => 'trim|htmlspecialchars|required'
			),
		
			array(
					'field' => 'category_id',
					'label' => 'lang:mockup:category_label',
					'rules' => 'trim|required|numeric'
			),
			
		
			array(
					'field' => 'status',
					'label' => 'lang:mockup:mockup_status_label',
					'rules' => 'trim|alpha'
			),
			
			array(
					'field' => 'price',
					'label' => 'lang:mockup:mockup_price',
					'rules' => 'trim|numeric|required'
			),
			
		
			
			
	);
	public function __construct()
	{
	    parent::__construct();
		    $this->lang->load('mockup');

		  
	}

	/**
	 * The main index page in the administration.
	 *
	 * Shows a list of the groups.
	 */

	public function index($page=0,$limit=6)
	{
		$this->load->library('mockup');
		$mockups=$this->mockup->get_mockups(array(),$page,$limit);
	
	    $pagination = create_pagination('admin/tmockup/index', $mockups['total'],$limit);
		$categories =array();	
	
		$this->template->set('categories',$categories);
 		$this->template->set('mockups',$mockups['objects']);
 		$this->template->set('pagination', $pagination);
 		$this->template	->title($this->module_details['name']);;
		$this->template	->build('admin/index');

	}
	public function form($id=null,$type="null"){
	
		
		$this->load->library('form_validation');
		$data['mockup_id'] = $this->input->post("mockup_id");
		$data['timestamp'] = 0;
		$data['status'] =$this->input->post("status");
		$data['price'] = $this->input->post("price");;
		$data['mockup_categories'] =array();
		$data['title']="";
		$this->load->library('mockup');
		if ($id) {
		
				$mockup=$this->mockup->get_mockup($id);
				
			if(empty($mockup))
			{
				$this->session->set_flashdata("error",lang("mockup:no_mockup_found"));
				redirect("admin/mockup");
			}
			
			//if the mockup does not exist, redirect them to the mockup list with an error
		
			if (!$mockup) {
				$mockup = $this->mockup->get_mockup($id);
				if(!$mockup){
					$this->session->set_flashdata('error', lang('error_not_found'));
					redirect($this->config->item('admin_folder') . '/mockup');
				}
				$savelang['name'] = $mockup->name;			
				$savelang['id_mockup'] = $mockup->id_mockup;
		
				$savelang['description'] = $mockup->description;

		
				//   $savelang['lang']=$lang;
				$this->mockup->save_lang($id, $lang, $savelang);
				redirect($this->config->item('admin_folder') . '/tmockup/form/' . intval($id) );
			}
			//set values to db values
			$data['mockup_id'] = $id;
			$data['title'] = isset($mockup->name)?$mockup->name:"";
			$data['description'] = isset($mockup->short_description)?$mockup->short_description:"";
			$data['price'] = $mockup->price;
			$data['timestamp']=$mockup->timestamp;
			$data['status']=$mockup->status;
		
			
		
		}
		$this->form_validation->set_rules($this->validation_rules);
		
		if ($this->form_validation->run() == FALSE) {
				$this->template
				->set('hours', array_combine($hours = range(0, 23), $hours))
				->set('minutes', array_combine($minutes = range(0, 59), $minutes))
				->set('categories',array("1"=>"ROOT"));
				
				
				$this->template->set($data);
				//$this->add_js();
			//	$frame_images=$this->load->view("admin/images",array(),true);
				$this->template
				->title($this->module_details['name'], lang('mockup:create_title'))
				->append_metadata($this->load->view('fragments/wysiwyg', array(), true))->build('admin/form');
				return;
			
		} else {
			$save['id_mockup'] = intval($id);
            $save['price'] =$this->input->post("list_price")?$this->input->post("list_price"):0.99;
            $save['status']=$this->input->post("status");
            $save['id_category_default']=$this->input->post("category_id");
            if(!$save['id_mockup'])
            $save['timestamp']=date('Y-m-d H:i:s');
            $save['lang'][CURRENT_LANGUAGE]['name']=$this->input->post("title");
            $save['lang'][CURRENT_LANGUAGE]['description']=$this->input->post("description");
           
            $id_mockup=$this->mockup->save($id,$save);
          
          
            
            
            
            
            if($id_mockup){
				$this->session->set_flashdata ( "success", sprintf ( lang ( "mockup:publish_success" ), $this->input->post ( "title" ) ) );
			} else {
				$this->session->set_flashdata ( "error", sprintf ( lang ( "mockup:publish_error" ), $this->input->post ( "title" ) ) );
			}
			if ($this->input->post ( "btnAction" ) == "save_exit") {
				redirect ( "admin/mockup/index/" );
			} else {
				redirect ( "admin/mockup/form/" . intval ( $id_mockup ) );
			}
          
		}
		
		
		
		
	
	}
	private function add_js(){
		

	}
	public function img_upload() {
		error_reporting(E_ALL | E_STRICT);
		$this->load->library('session');
		if(!isset($_REQUEST['mockup_id'])){
			echo json_encode(array());
						die;
		}
		$r = $_REQUEST['mockup_id'];
	
		//  $product_id = $this->session->userdata('pid');
		if (isset($r) && $product_id = intval($r)) {
	
			$this->load->library("Mockup");
			if ($product_id) {
				//$img = new Image_model();
				$this->Mockup->processImage(intval($product_id));
				return;
			}
		}
		die('No product id found');
	}
	
}