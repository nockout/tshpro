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
	public function processImage($mockup_id) {
		if(empty($mockup_id))
			return;
		$config['upload_dir'] = "global/images/p/";
		$config['upload_dir'] = $config['upload_dir'];
	
		if (!is_dir($config['upload_dir'])) { //create the folder if it's not already exists
			mkdir($config['upload_dir'], 0755, TRUE);
		}
		$config['script_url'] = base_url() . "product/img_upload/";
		$config['upload_url'] = base_url() . "product/img_upload/";
		$upload_handler = new UploadHandler($config);
	
	
		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Disposition: inline; filename="files.json"');
		header('X-Content-Type-Options: nosniff');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
		header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'OPTIONS':
				break;
			case 'HEAD':
			case 'GET':
				$this->product_id = $product_id;
				$upload_dir = dirname($_SERVER['SCRIPT_FILENAME']) . '/global/images/p/';
				$url = base_url();
				$files = array();
				if ($images = $this->getImageIDByProduct($this->product_id)) {
					foreach ($images as $img) {
						$file = new stdClass();
						$file->name = $this->product_id . '-' . $img->id_image . '-' . 'medium' . '.jpg';
						$file->id_image = $img->id_image;
						$file->url = $url . 'global/images/p/' . $this->product_id . '-' . $img->id_image . '-' . 'medium' . '.jpg';
						$file->delete_url = $this->getFullUrl() . '/product/img_upload'
								. '?id_image=' . rawurlencode($img->id_image).'&&product_id='.rawurlencode($product_id);
						$file->delete_url .= '&_method=DELETE';
						$file->deleteType='DELETE';
						$files[] = $file;
					};
				}
				$obj=new stdClass();
				$obj->files=$files;
				print_r(json_encode($obj));
				break;
			case 'POST':
				if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
					$upload_handler->delete();
				} else {
					$this->product_id = $product_id;
					parent::create($this->fields);
					if (is_object($this)) {
						$types = self::getImageType();
						if (!is_array($types)) {
							die('Can\'t not get image types');
						}
						$imge_version = array();
	
						foreach ($types as $type) {
							$imge_version[$type->name] = array(
									'upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']) . '/global/images/p/',
									'upload_url' => $upload_handler->getFullUrl() . '/files/',
									'max_width' => $type->width,
									'max_height' => $type->height,
									'jpeg_quality' => 95);
						}
						// $upload_handler->options['image_versions'] = $imge_version;
						$this->load->library('images');
						$images = new CI_Images();
						$files = $_FILES['files'];
	
						if (isset($files['tmp_name'][0])) {
	
							foreach ($imge_version as $name => $version) {
								$new_name = $this->product_id . '-' . $this->id_image . '-' . $name . '.jpg';
								$images->imageResize($files['tmp_name'][0], $version['upload_dir'] . $new_name
										, $version['max_width'], $version['max_height']);
							}
						}
						$files_return = array();
						if ($images = $this->getImageIDByProduct($this->product_id)) {
							//     foreach ($images as $img) {
							$file = new stdClass();
							$file->name = $this->product_id . '-' . $this->id_image . '-' . 'medium' . '.jpg';
							$file->id_image = $this->id_image;
							$file->url = base_url() . 'global/images/p/' . $this->product_id . '-' . $this->id_image . '-' . 'medium' . '.jpg';
							$file->delete_url = $this->getFullUrl() . '/product/img_upload' . '?id_image=' . rawurlencode($this->id_image).'&product_id='.rawurlencode($product_id);
							$file->delete_url .= '&_method=DELETE';
							$file->deleteType='DELETE';
							$files_return[] = $file;
	
	
							//  };
						}
						$object= new stdClass();
						$object->files=$files_return;
						$object->notifications= json_encode ( $this->tools->set_notification
								( 'N', 'notice', 'Image upload successfull.' )
						);
						print_r(json_encode($object));
					}
				}
				break;
			case 'DELETE':
				$this->img_delete(intval($_REQUEST['id_image']), $product_id);
				echo json_encode($this->tools->set_notification('N', 'notice', 'Delete successfull'));
				return;
				break;
			default:
				header('HTTP/1.1 405 Method Not Allowed');
		}
	}
	
}