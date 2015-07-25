<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Mockup {
	var $CI;
	public function __construct() {
		$this->CI = &get_instance ();
		$this->CI->load->model ( "Mockup_m" );
	}

	public function get_options($type_mockup = null) {
		if (! $type_mockup)
			return;
			// load xml
		$types = array (
				"shirts" => array (
						"Men",
						"Women" 
				),
				'phone-accessories' => array ()

				 
		);
		if (isset ( $types [$type_mockup] )) {
			return $types [$type_mockup];
		}
		
		return null;
	}
	public function get_mockups($cond = array(), $page, $limit) {
		return $this->CI->Mockup_m->get_mockups ( $cond, $page, $limit );
	}
	public function save($id, $save) {
		return $this->CI->Mockup_m->save ( $id, $save );
	}
	public function get_mockup($id) {
		return $this->CI->Mockup_m->get ( $id );
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
	public function generate_image($mockup_id) {
		if (! intval ( $mockup_id ))
			return;
		$this->CI->load->model ( "Image_m" );
		$this->CI->load->library ( "image" );
		$this->CI->load->config ( "tdesign" );
		$upload_path = $this->CI->config->item ( 'locate_upload_path' );
		$this->CI->load->model ( "Mockup_m" );
		$mockup = $this->CI->Mockup_m->get ( $mockup_id );
		if (empty ( $mockup ))
			return;
		$extra = unserialize ( $mockup->extra );
		if (empty ( $extra ['raw_url'] )) {
			return;
		}
		
		$id_image = $this->CI->Mockup_m->generate_image_id ( $mockup_id );
		$types = $this->CI->Image_m->image_types_by_names ( array (
				"mockups" => 1 
		) );
		if (empty ( $types ))
			return false;
		foreach ( $types as $t ) {
			$destPath = sprintf ( "%s/%s/%s", $upload_path, $t->name, $id_image . "_" . $mockup_id . '.jpg' );
			$this->CI->image->resize_image ( $extra ['raw_url'], $destPath, $t->width, $t->height );
		}
		
		return true;
	}
	public function generate_folder() {
		$this->CI->load->model ( "Image_m" );
		$this->CI->load->config ( "tdesign" );
		$types = $this->CI->Image_m->image_types_by_names ( array (
				"mockups" => 1 
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
		$this->CI->load->model ( "Mockup_m" );
	
		return $this->CI->Mockup_m->delete ( $id );
		
		// unlink image;
	}
	public function auto_delete($id){
		
		if(empty($id)){
			return;
			
		}
		if(!is_array($id)){
			$id=array($id);
		}
		$this->CI->load->model ( "Mockup_m" );
		
		 $this->CI->Mockup_m->auto_delete ( $id );
		$this->delete_image($id);
	}
	private function delete_image($ids = null) {
		
		if (empty ( $ids ))
			return;
	
		$this->CI->load->model ( "Image_m" );

		$this->CI->load->model ( "Mockup_m" );
		$types = $this->CI->Image_m->image_types_by_names ( array (
				"mockups" => 1 
		) );
	
		if (empty ( $types ))
			return;
		$groups=array();
		$result=$this->CI->Mockup_m->get_images($ids);
		if(empty($result))
			return;
		foreach ($result as $r){
			$groups[]=array('id_image'=>$r->id_image,'id_mockup'=>$r->mockup_id);
		}
		$upload_path = $this->CI->config->item ( 'locate_upload_path' );
	
		foreach ( $types as $t ) {
			
			foreach ( $groups as $G ) {
				$destPath = sprintf ( "%s/%s/%s", $upload_path, $t->name, $G['id_image'] . "_" . $G['id_mockup'] . '.jpg' );
				
				if (file_exists ( $destPath ))
					
					unlink ( $destPath );
			}
		}
		return true;
		// / $this->db->where("mockup_id",intval($id))->delete($this->_images);
	}
}