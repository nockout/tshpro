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
					'label' => 'lang:design:category_label',
					'rules' => 'trim|required|numeric'
			),
			
			array(
					'field' => 'body',
					'label' => 'lang:design:description_label',
					'rules' => 'trim|required'
			),
			
			array(
					'field' => 'status',
					'label' => 'lang:design:status_label',
					'rules' => 'trim|alpha'
			),
			array(
					'field' => 'created_on',
					'label' => 'lang:design:date_label',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'created_on_hour',
					'label' => 'lang:design:created_hour',
					'rules' => 'trim|numeric|required'
			),
			
			array(
					'field' => 'keywords',
					'label' => 'lang:global:keywords',
					'rules' => 'trim'
			),
			
			
	);
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
	public function generate_folder(){
		
		$this->load->library('product');
		$this->product->generate_folder();
		ECHO "DONE";
	}
	public function index()
	{
		$this->load->library('product');
			$designs=$this->product->get_products(array());
		
		$categories =array();
		$this->template->set('categories',$categories);
 		$this->template->
 			set('designs',$designs)
 			->title($this->module_details['name'])
			->build('admin/index');;

	}
	public function form($id=null,$status="null"){
		$id or redirect('admin/index');
	
		$this->load->library('product');
	
		$this->load->library('form_validation');
		$data['product_id'] = '';
		$data['slug'] = '';
		$data['group_id'] = '';
		$data['product'] = "";
		$data['status'] = "";
		$data['shortname'] = '';
		$data['product_code'] = '';
		$data['short_description'] = '';
		$data['full_description'] = '';
		$data['search_words'] = '';
		$data['list_price'] = '';
		$data['extra'] = '';
		$data['product_code']="";
		$data['keywords']="";
		$data['product_categories'] =array();
		if ($id) {
			if($status=="D"){
			
				$product=$this->product->get_draft($id);
			}else{
				$product=$this->product->get_product($id);
			}
			
			if(empty($product))
			{
				die("no design found");
			}
			
			//if the product does not exist, redirect them to the product list with an error
		
			if (!$product) {
				$product = $this->product->get_product($id);
				if(!$product){
					$this->session->set_flashdata('error', lang('error_not_found'));
					redirect($this->config->item('admin_folder') . '/products');
				}
				$savelang['shortname'] = $product->shortname;
				$savelang['product'] = $product->product;
				$savelang['product_id'] = $product->product_id;
				$savelang['meta_title'] = $product->meta_title;
				$savelang['full_description'] = $product->full_description;
				$savelang['more_info'] = $product->more_info;
				$savelang['search_words'] = $product->search_words;
				$savelang['meta_description'] = $product->meta;
				//   $savelang['lang']=$lang;
				$this->product->save_lang($id, $lang, $savelang);
				redirect($this->config->item('admin_folder') . '/tdesign/form/' . $id );
			}
			//set values to db values
			$data['product_id'] = $id;
		
			$data['slug'] =$product->slug;
			$data['group_id'] = $product->group_id;
			$data['product'] = isset($product->product)?$product->product:"";
		
			$data['product_code'] = $product->product_code;
			$data['short_description'] = isset($product->short_description)?$product->short_description:"";
			$data['full_description'] =isset($product->full_description)?$product->full_description:"";
			$data['keywords'] = isset($product->search_words)?$product->search_words:"";
			$data['list_price'] = $product->list_price;
			$data['extra'] = $product->extra;
			$data['product_code']=$product->product_code;
			$data['image']=!empty($product->image)?$product->image:"";
			$data['avail_since']=$product->avail_since;
			$data['status']=$product->status;
		
			
		
		}
		$this->form_validation->set_rules($this->validation_rules);
		
		if ($this->form_validation->run() == FALSE) {
				$this->template
				->set('hours', array_combine($hours = range(0, 23), $hours))
				->set('minutes', array_combine($minutes = range(0, 59), $minutes))
				->set('categories',array("1"=>"ROOT"));
				
				
				$this->template->set($data);
				$this->template->append_css ( 'module::form.css' );;
				$this->template
				->title($this->module_details['name'], lang('design:create_title'))
				->append_metadata($this->load->view('fragments/wysiwyg', array(), true))->build('admin/form');
			
		} else {
			$save['product_id'] = intval($id);
            $save['list_price'] =$this->input->post("list_price")?$this->input->post("list_price"):0.99;
            $save['status']=$this->input->post("status");
            $save['cate_id']=$this->input->post("category_id");
            
            $save['lang'][CURRENT_LANGUAGE]['product']=$this->input->post("title");
            $save['lang'][CURRENT_LANGUAGE]['short_description']=$this->input->post("title");
            $save['lang'][CURRENT_LANGUAGE]['search_words']=$this->input->post("keywords");
            $save['lang'][CURRENT_LANGUAGE]['shortname']=$this->input->post("title");
            $save['lang'][CURRENT_LANGUAGE]['age_warning_message']=$this->input->post("age_warning_message")?$this->input->post("age_warning_message"):"";
            $save['lang'][CURRENT_LANGUAGE]['full_description']=$this->input->post("body");
            $product_id=$this->product->save($id,$save);
            if( $save['status']=="D"){
            	//generate image
            	$this->product->generate_image($product_id);
            }
            
            if($product_id){
            	$this->session->set_flashdata("success",sprintf(lang("design:publish_success"),$this->input->post("title")));
            }else{
            	$this->session->set_flashdata("error",sprintf(lang("design:publish_error"),$this->input->post("title")));
            }
            if($this->input->post("btnAction")=="save_exit"){
            	redirect("admin/tdesign/index/");
            }else{
            	redirect("admin/tdesign/form/".intval($id));
            }
          
		}
		
		
		
		
	
	}

	
}