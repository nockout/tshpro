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
		
		$this->template->title ( $this->module_details ['name'], lang ( 'cat:create_title' ) )->set ( 'mode', 'create' )->set ( "collections", $collections );
		
		$this->template->append_css ( 'bootstrap.css-ver=3.6.1.css' )->append_css ( 'font-awesome.css-ver=3.6.1.css' )->append_css ( 'bootstrap-responsive.css-ver=3.6.1.css' )->append_css ( 'module::animate.css-ver=3.6.1.css' )->append_css ( "jquery-ui-1.8.17.custom.css" )->append_css ( 'module::app.css-ver=3.6.1.css' )->append_css ( 'module::pick-a-color-1.1.7.min.css-ver=3.6.1.css' )->append_css ( 'font.css' )->append_css ( 'module::style.css-ver=3.6.1.css' );
		
		$this->template->append_js ( 'module::jquery-1.11.3.min.js' )
		->append_js ( 'module::jquery-migrate-1.2.1.js' )
		->append_js ( 'module::modernizr.custom.28468.js-ver=3.6.1.js' )
		->append_js ( 'module::bootstrap.js' )
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
		echo "<pre>";
		print_r($_POST);die;
		//print_r($this->input->post());
		//die;
		//$filename=UPLOAD_PATH.'../design/templates/02.jpg';
		//$img=base64_encode(file_get_contents($filename));
		//$img="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";
		//print_r($img);die;
		//$img="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlwAAAHPCAYAAACGBgTAAAAgAElEQVR4nOy9Z5Rc133lO++Tn9/M2AwgEUkQJEBSpChSogIDwCRKFMUskgoWbUnUjNP4je2xPfKzl99btmRLo7GVKBGkRDMDBIlGA93oHCrnnLo6x8qhcw7Afh8a5/D0wTn33u5Gkurste4iUHWr6lYB7Pph//fZ5z/8ByUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJSUlJaXKFIArAPw1gE4Ay1BSqjCdPn0ap06dwqlTp3D69...zY0tJSXw5XFA1xG+CKEugRahTIKNM8q0fc/mOoUaZ1ZWzH942Arw241PSkUtdKLUUEDqUKlVqJpagI1WaLTOODgpky2StQaoMvBq426CoZ+UttRAVcfF+lDK5SGn0CV7WVwFVTWQJXlVUCLjfM+9JqhC3P4lpZWelrKT548ECCFk8mchxEyafFwaERzJT8OgqUVCwE+4GUilRSsyKo4nP5vNLQAMNYNAHpbTJUuPDxErioeAelfJUUoNI0XymRHaGrpHB1uf4oEgNVwUjxUhOJfD/cXnz27FkxDiJaaK1arwlcVVcCV01lCVxVVgRcU1NTfflb3kp0VQv9W54wX2ohYiyESl+P9h8q4IqCUvmxEnBF5ysTvfIOleIZIoUmmjYcNOdLqXasgOFrWekrqT1RblekSDGIlCb5oryqKE4C/V1dFLpSzpcaHlD/flWrle+TE/aV6hdFavhwge9S9H2KCVzVV7XA9T8kmxstdnCPPwAAAABJRU5ErkJggg==";
	//	$img = str_replace('data:image/png;base64,', '', $img);
	//	$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_PATH.'../design/templates/' . uniqid() . '.png';
		$success = file_put_contents($file, $data);
		echo $success;
		return;
		if($this->input->is_ajax_request()){
			if($img=$this->input->post('canvasData',TRUE)){
				echo "<pre>";
				print_r($img);die;
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = UPLOAD_PATH.'../design/templates/' . uniqid() . '.png';
			$success = file_put_contents($file, $data);
			}
			return;
		}
		echo "aaa";die;
		return;
	}
	public function upload_template() {
		if (empty ( $_FILES )) {
			redirect ( "admin/tdesign/create" );
		}
		$data = $this->template_upload ( "img_uploadTemplate" );
		redirect ( "admin/tdesign/create" );
		// $this->create($data);
	}
	private function template_upload($files = "userfiles") {
		$config ['upload_path'] = $this->config->item ( "tdesign_upload_path_folder" );
		
		if (! is_dir ( $config ['upload_path'] ))
			mkdir ( $config ['upload_path'], 0700 );
		
		$config ['allowed_types'] = $this->config->item ( "allowed_types_template" );
		$config ['max_size'] = $this->config->item ( "max_size_template_file" );
		$config ['min_width'] = $this->config->item ( "min_width_template_file" );
		$config ['min_height'] = $this->config->item ( "min_height_template_file" );
		
		$config ['remove_spaces'] = TRUE;
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
			$data = $this->upload->data ();
			// resize image width 480x480
			$data ['resize_image']=$data['file_name'];
			$resize_name=$data ['raw_name'] . sprintf ( "_%sx%s", $this->config->item ( "tdesign_template_img_resize_width" ), $this->config->item ( "tdesign_template_img_resize_height" ) ) . $data ['file_ext'];;
			$sourcImg=$data ['full_path'];
			$destSourc= $data ['file_path'] . $resize_name;
			$this->load->helper("tdesign");
			if(resize_image ( $sourcImg ,$destSourc,$this->config->item ( "tdesign_template_img_resize_width" ), $this->config->item ( "tdesign_template_img_resize_height" )))
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
		
		// print($this->current_user->group);di
	}
}