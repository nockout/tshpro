<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Product {
	var $CI;
	public function __construct() {
		$this->CI = &get_instance ();
		$this->CI->load->model ( "Product_m" );
	}
	public function create_draft($extra = null) {
		return $this->CI->Product_m->create_draft ( $extra );
	}
	public function get_draft($product_id) {
		$design = $this->CI->Product_m->get_product_draft ( $product_id );
		if (empty ( $design ))
			return;
		$extra = unserialize ( $design->extra );
		if (isset ( $extra ['image'] )) {
			
			$design->image = $extra ['image'];
		}
		
		return $design;
	}
	public function get_options($type_product = null) {
		if (! $type_product)
			return;
			// load xml
		$types = array (
				"shirts" => array (
						"Men",
						"Women" 
				),
				'phone-accessories' => array ()

				 
		);
		if (isset ( $types [$type_product] )) {
			return $types [$type_product];
		}
		
		return null;
	}
	public function get_products($cond = array(), $page, $limit) {
		return $this->CI->Product_m->get_products ( $cond, $page, $limit );
	}
	public function save($id, $save) {
		return $this->CI->Product_m->save ( $id, $save );
	}
	public function get_product($id) {
		return $this->CI->Product_m->get ( $id );
	}
	public function templates($folders = array()) {
		$path = rtrim ( $this->CI->config->item ( 'files:path' ), DIRECTORY_SEPARATOR );
		$fods = $this->get_templates ( $folders );
		if (empty ( $fods )) {
			return;
		}
		$path = BASE_URI . rtrim ( $this->CI->config->item ( 'files:path' ), DIRECTORY_SEPARATOR );
		foreach ( $fods as $key => $f ) {
			
			if (isset ( $f ['data'] )) {
				foreach ( $f ['data'] as $file ) {
					$file->link = $path . '/' . $file->_path . $file->filename;
				}
				$result [$key] = $f ['data'];
			}
		}
		
		return $result;
	}
	private function get_templates($folders) {
		if (empty ( $folders ))
			return;
		$this->CI->load->library ( "tfiles" );
		$templates = array ();
		foreach ( $folders as $folder ) {
			$templates [$folder] = $this->CI->tfiles->get_files ( "local", $folder );
		}
		
		return $templates;
	}
	public function generate_image($product_id) {
		if (! intval ( $product_id ))
			return;
		$this->CI->load->model ( "Image_m" );
		$this->CI->load->library ( "image" );
		$this->CI->load->config ( "tdesign" );
		$upload_path = $this->CI->config->item ( 'locate_upload_path' );
		$this->CI->load->model ( "Product_m" );
		$product = $this->CI->Product_m->get ( $product_id );
		if (empty ( $product ))
			return;
		$extra = unserialize ( $product->extra );
		if (empty ( $extra ['raw_url'] )) {
			return;
		}
		
		$id_image = $this->CI->Product_m->generate_image_id ( $product_id );
		$types = $this->CI->Image_m->image_types_by_names ( array (
				"products" => 1 
		) );
		if (empty ( $types ))
			return false;
		foreach ( $types as $t ) {
			$destPath = sprintf ( "%s/%s/%s", $upload_path, $t->name, $id_image . "_" . $product_id . '.jpg' );
			$this->CI->image->resize_image ( $extra ['raw_url'], $destPath, $t->width, $t->height );
		}
		
		return true;
	}
	public function generate_folder() {
		$this->CI->load->model ( "Image_m" );
		$this->CI->load->config ( "tdesign" );
		$types = $this->CI->Image_m->image_types_by_names ( array (
				"products" => 1 
		) );
		if (empty ( $types ))
			return;
		foreach ( $types as $t ) {
			if (! is_dir ( $this->CI->config->item ( 'locate_upload_path' ) . $t->name )) {
				mkdir ( $this->CI->config->item ( 'locate_upload_path' ) . $t->name, 0777, true );
			}
		}
	}
	public function delete($id) {
		$this->CI->load->model ( "Product_m" );
	
		return $this->CI->Product_m->delete ( $id );
		
		// unlink image;
	}
	public function auto_delete($id){
		
		if(empty($id)){
			return;
			
		}
		if(!is_array($id)){
			$id=array($id);
		}
		$this->CI->load->model ( "Product_m" );
		
		 $this->CI->Product_m->auto_delete ( $id );
		$this->delete_image($id);
	}
	private function delete_image($ids = null) {
		
		if (empty ( $ids ))
			return;
	
		$this->CI->load->model ( "Image_m" );
		$this->CI->config->load ( "tdesign" );
		$this->CI->load->model ( "Product_m" );
		$types = $this->CI->Image_m->image_types_by_names ( array (
				"products" => 1 
		) );
	
		if (empty ( $types ))
			return;
		$groups=array();
		$result=$this->CI->Product_m->get_images($ids);
		if(empty($result))
			return;
		foreach ($result as $r){
			$groups[]=array('id_image'=>$r->id_image,'id_product'=>$r->product_id);
		}
		$upload_path = $this->CI->config->item ( 'locate_upload_path' );
	
		foreach ( $types as $t ) {
			
			foreach ( $groups as $G ) {
				$destPath = sprintf ( "%s/%s/%s", $upload_path, $t->name, $G['id_image'] . "_" . $G['id_product'] . '.jpg' );
				
				if (file_exists ( $destPath ))
					
					unlink ( $destPath );
			}
		}
		return true;
		// / $this->db->where("product_id",intval($id))->delete($this->_images);
	}
}