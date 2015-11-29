<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
/**
 * Permissions controller
 *
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Permissions\Controllers
 */
class Admin_Create extends Admin_Controller {
	
	/**
	 * Constructor method.
	 *
	 * As well as everything in the Admin_Controller::__construct(),
	 * this additionally loads the models and language strings for
	 * permission and group.
	 */
	public function __construct() {
		parent::__construct ();
		$this->lang->load ( 'design' );
		$this->load->model ( 'product_m' );
		$this->config->load ( 'tdesign' );
		// $this->lang->load('permissions');
		// $this->lang->load('groups/group');
	}
	
	/**
	 * The main index page in the administration.
	 *
	 * Shows a list of the groups.
	 */
	private function create($data = array()) {
		
		$this->load->helper ( "tdesign" );
		$collections = $this->session->userdata ( "templates" );
		$this->load->model('Image_m');
		
		$types=$this->Image_m->image_types_by_names(array("name"=>"original","products"=>1));
		if(!empty($types)){
			$types=$types[0];
		}
		$this->template->title ( $this->module_details ['name'], lang ( 'cat:create_title' ) )
		->set ( 'mode', 'create' )
		->set ( "collections", $collections )
		->set ( "original", $types );
		$this->template->append_css ( 'bootstrap.css-ver=3.6.1.css' )
		->append_css ( 'font-awesome.css-ver=3.6.1.css' )
		->append_css ( 'bootstrap-responsive.css-ver=3.6.1.css' )
		->append_css ( 'module::animate.css-ver=3.6.1.css' )
		->append_css ( "jquery-ui-1.8.17.custom.css" )
		->append_css ( 'module::app.css-ver=3.6.1.css' )
		->append_css ( 'module::pick-a-color-1.1.7.min.css-ver=3.6.1.css' )
		->append_css ( 'font.css' )
		->append_css ( 'module::style.css-ver=3.6.1.css' )
		->append_css ( 'module::BootSideMenu.css' );
		
		$this->template->append_js ( 'module::jquery-1.11.3.min.js' )
		->append_js ( 'module::jquery-migrate-1.2.1.js' )
		->append_js ( 'module::modernizr.custom.28468.js-ver=3.6.1.js' )
		->append_js ( 'module::bootstrap.js' )
		->append_js ( 'module::BootSideMenu.js' )
		->append_js ( 'module::jquery-ui.min.js' )
		->append_js ( 'module::more.js' )
		->append_js ( 'module::pick-a-color-1.1.7.min.js-ver=3.6.1.js' )
		->append_js ( 'module::tinycolor-0.9.15.min.js-ver=3.6.1.js' )
		->append_js ( 'module::jquery.print-preview.js-ver=3.6.1.js' )
		->append_js ( 'module::html2canvas.js' )
		->append_js ( 'module::Canvas2Image.js-ver=3.6.1.js' )
		->append_js ( 'module::base64.js-ver=3.6.1.js' )
		->append_js ( 'module::app.js-ver=3.6.1.js' )
		->append_js ( 'module::excanvas.js-ver=3.6.1.js' )
		->append_js ( 'module::html5.js-ver=3.6.1.js' )
		->append_js ( 'module::dropfileFix.js-ver=3.6.1.js' );
		$this->template->build ( 'admin/create/index' );
	}
	
	
	public function export(){
		
		if(!isset($_REQUEST['canvasData'])){
			redirect("admin/tdesign/create");
		}
		$img=$_REQUEST['canvasData'];
		
		if(empty($img)){
			
			$this->session->set_flashdata ( 'error', lang ( "design:no_design_found" ) );
			redirect("admin/tdesign/create");
		}
		
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$name= "temp".uniqid(). '.png';
		$file = UPLOAD_PATH.'../design/templates/' .$name;
		$success = file_put_contents($file, $data);
		
		
		$this->load->library('product');
		$this->load->helper("tdesign");	
		// create draft design
		$product=$this->product->create_draft(array("raw_url"=>$file,"image"=>get_design_image_path("templates",$name)));
		//redirect("admin/tdesign/create");
		if(empty($product)){
			show_error("Service Currently Unvaiable");
			return;
		}
		
		redirect("admin/tdesign/form/".$product->product_id."/D");
	
	}
	public function upload_template() {
		if (empty ( $_FILES )) {
			redirect ( "admin/tdesign/create" );
		}
		$data = $this->template_upload ( "img_uploadTemplate" );
		redirect ( "admin/tdesign/create" );
		// $this->create($data);
	}
	public function template_upload($files = "userfiles") {
		$config ['upload_path'] = $this->config->item ( "tdesign_upload_path_folder" );		
		if (! is_dir ( $config ['upload_path'] ))
			mkdir ( $config ['upload_path'], 0777 );
		$this->load->model('Image_m');
		
		$types=$this->Image_m->image_types_by_names(array("name"=>"original","products"=>1));
		if(empty($types)){
			$this->session->set_flashdata ( 'error', lang("design:no_origin_size_set") );
			return;
		}
		$type=$types[0];
		$config ['allowed_types'] = $this->config->item ( "allowed_types_template" );
		$config ['max_size'] = $this->config->item ( "max_size_template_file" );
		$config ['min_width'] = $type->width;
		$config ['min_height'] = $type->height;
		$config ['remove_spaces'] = TRUE;
		if(empty($_FILES [$files] ['name']))
			return;
		$file_name = ($_FILES [$files] ['name']);
		$config ['file_name'] = $file_name;
		$this->load->library ( 'upload', $config );
		
		if (! $this->upload->do_upload ( $files )) {
			$err = $this->upload->display_errors ();
			$er = array (
					'error' => $err 
			);
			
			$this->session->set_flashdata ( 'error', $err );
			return $er;
		} else {
			$this->load->library('Image');
			$data = $this->upload->data ();
			$data ['resize_image']=$data['file_name'];
			$resize_name=$data ['raw_name'] . sprintf ( "_%sx%s", $this->config->item ( "tdesign_template_img_resize_width" ), $this->config->item ( "tdesign_template_img_resize_height" ) ) . $data ['file_ext'];;
			$sourcImg=$data ['full_path'];
			$destSourc= $data ['file_path'] . $resize_name;
			if($this->image->resize_image ( $sourcImg ,$destSourc,$type->width, $type->height))
				$data ['resize_image']=$resize_name;
				
			
			if ($collections = $this->session->userdata ( 'templates' )) {
				$collections [$data ['file_name']] = $data;
			} else {
				$collections [$data ['file_name']] = $data;
			}
			
			$this->session->set_userdata ( 'templates', $collections );
			$this->session->set_flashdata ( 'success', lang ( "design:template_upload_sucessfull" ) );
		}
	}
	
	public function index() {
		
		$this->create ();
		
	}
}