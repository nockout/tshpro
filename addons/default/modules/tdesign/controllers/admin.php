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
			//$data['shortname'] = $product->shortname;
			$data['product_code'] = $product->product_code;
			$data['short_description'] = isset($product->short_description)?$product->short_description:"";
			$data['full_description'] =isset($product->full_description)?$product->full_description:"";
			$data['search_words'] = isset($product->search_words)?$product->search_words:"";
			$data['list_price'] = $product->list_price;
			$data['extra'] = $product->extra;
			$data['product_code']=$product->product_code;
			$data['image']=$product->image;
			$data['avail_since']=$product->avail_since;
			$data['status']=$product->status;
			
			
		
		}
		$this->form_validation->set_rules($this->validation_rules);
		
		if ($this->form_validation->run() == FALSE) {
				$this->template
				->set('hours', array_combine($hours = range(0, 23), $hours))
				->set('minutes', array_combine($minutes = range(0, 59), $minutes))
				->set('categories',array("1"=>2));
				
				
				$this->template->set($data);
				$this->template->append_css ( 'module::form.css' );;
				$this->template
				->title($this->module_details['name'], lang('design:create_title'))
				->append_metadata($this->load->view('fragments/wysiwyg', array(), true))->build('admin/form');
			
		} else {
			$save['product_id'] = $id;
            $save['list_price'] =$this->input->post("list_price");
            echo "<pre>";
            print_r($save);die;
		}
		
		
		
		
	
	}

	
}