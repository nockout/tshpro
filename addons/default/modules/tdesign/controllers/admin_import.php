<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
/**
 * Permissions controller
 *
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Permissions\Controllers
 *         
 */
class Admin_Import extends Admin_Controller {
	public function __construct() {
		parent::__construct ();
		$this->lang->load ( 'design' );
		$this->load->model ( 'product_m' );
		$this->config->load ( 'tdesign' );
		$this->load->library('image_lib');
	}
	public function index(){
		echo "aaa";die;
	}
	public function test(){
		
		// resize art first;
		$config['image_library']    = 'gd2';
		$config['width']=210;
		$config['source_image']  = UPLOAD_PATH.'../design/arts/temp56701b38919b7.png';
		$config['new_image']          = UPLOAD_PATH.'../art_resize.png';
		$config['quality']=100;
	
		$this->image_lib->initialize($config);
		
	
	
		
		$this->image_lib->resize();
		$this->image_lib->clear();
		
		
		$config['image_library']    = 'gd2';
        $config['source_image']     = UPLOAD_PATH.'../template/12_12.png';
        $config['wm_type']          = 'overlay';
        $config['wm_overlay_path']  = UPLOAD_PATH.'../art_resize.png'; //the overlay image
        $config['quality']=100;
        $config['wm_opacity']       = 100;
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';
        $config['new_image']          = UPLOAD_PATH.'../test.png';
        $this->image_lib->initialize($config);
		if (!$data=$this->image_lib->watermark()) {
			echo $this->image_lib->display_errors();
			return;
		}
		$this->image_lib->clear();
		echo "<pre>";
		print_r($data);die;
		echo "success";
	}
}