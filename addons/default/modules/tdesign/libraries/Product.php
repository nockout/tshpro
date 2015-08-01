<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Product {
	var $CI;
	var $img_extension;
	public function __construct() {
		$this->CI = &get_instance ();
		$this->CI->load->model ( "Product_m" );
		$this->img_extension=$this->CI->config->item("template_extension")?$this->CI->config->item("template_extension"):".png";
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
	public function create_new_art($art=array()){
		return $this->CI->Product_m->create_art($art);
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
	public function templatesbk($folders = array()) {
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
	public function cate_templates($folders = array()) {
		//$path = rtrim ( $this->CI->config->item ( 'files:path' ), DIRECTORY_SEPARATOR );
		//get category
	

		$categorys='tshirt_template_categories';
		$this->CI->db->select("*");
		$cates=$this->CI->db->get($categorys)->result();
		
		if(empty($cates)){
			return;
		}
		//$result=array();
		foreach ($cates as $cate){
		$tempaltes=	$this->get_template_by_category($cate->id_category);
		if($tempaltes)	{
			foreach ($tempaltes as $t){
				$t->images=$this->get_templates_images($t->id_template);
				}
			$cate->templates=$tempaltes;
			}
		}
	
		return $cates;
	}
	private function get_template_by_category($id_category){
		//echo $id_category;
		$tplate_table='tshirt_template';
		$tplate_table_lang="tshirt_template_lang";
		if(empty($id_category))
			return;
		
		$this->CI->db->where("id_category_default",intval($id_category));
		$this->CI->db->join($tplate_table_lang,$tplate_table.".id_template=".$tplate_table_lang.".id_template","lEFT");
		$this->CI->db->where("lang_code",CURRENT_LANGUAGE);
		$this->CI->db->order_by("position","DESC");

		$tempaltes=$this->CI->db->get($tplate_table)->result();
	
		
		return $tempaltes;
	}
	private function get_templates_images($template_id){
		$path=UPLOAD_PATH.'../template/';
		$imga_table="tshirt_template_image";
		if(empty($template_id))
			return;
		
		$result=$this->CI->db->where("id_template",$template_id)
		->order_by(" type DESC, position DESC")
		->get($imga_table)->result();
		//echo "<pre>";
		//print_r($result);die;
		if(!$result)
			return;
		$return=array();
		$old_type="";
		foreach ($result as $r){			
			if($old_type!=$r->type){
				$old_type=$r->type;
			}
			$realPath=$path.$r->id_template."_".$r->id_image.$this->img_extension;
			if(file_exists($realPath)){
			//	echo $old_type;die;
				$return[$old_type][]=$realPath;
			}
			
			$old_type=$r->type;
		}
		return $return;
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
		
		
		$types = $this->CI->Image_m->image_types_by_names ( array (
				"products" => 1 
		) );
		if (empty ( $types ))
			return false;
		foreach ($extra ['raw_url'] as $url){
			$id_image = $this->CI->Product_m->generate_image_id ( $product_id );
			foreach ( $types as $t ) {
			$destPath = sprintf ( "%s/%s/%s", $upload_path, $t->name, $id_image . "_" . $product_id . '.jpg' );
			$this->CI->image->resize_image ( $url, $destPath, $t->width, $t->height );
			}
			
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