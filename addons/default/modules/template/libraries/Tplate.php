<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Tplate {
	var $CI;
	var $img_extension;
	public function __construct() {
		$this->CI = &get_instance ();
		$this->CI->load->model ( "template_m" );
		$this->img_extension=$this->CI->config->item("template_extension")?$this->CI->config->item("template_extension"):'.png';
	}

	
	public function get_colors() {
		$colors=array();
		if($result=$this->CI->template_m->get_colors()){
				foreach ($result as $c){
				$colors[$c->id_color]=$c->name;
				}
		}
		return $colors;
	}
	public function get_templates($cond = array(), $page, $limit) {
		return $this->CI->template_m->get_templates ( $cond, $page, $limit );
	}
	public function save($id, $save) {
		return $this->CI->template_m->save ( $id, $save );
	}
	public function get_template($id) {
		return $this->CI->template_m->get ( $id );
	}
	
	public function set_default($id_template,$id_image,$type){
		return $this->CI->template_m->set_default($id_template, $id_image,$type );
	}
	
	
	public function delete($id) {
		//$this->CI->load->model ( "Template_m" );
		
		return $this->CI->template_m->delete ( $id );
		
		// unlink image;
	}
	public function set_group($id){
	//	$this->CI->load->model ( "Template_m" );
		
		return $this->CI->template_m->set_group ( $id );
	}
	public function auto_delete($id){
		
		if(empty($id)){
			return;
			
		}
		if(!is_array($id)){
			$id=array($id);
		}
		$this->CI->load->model ( "template_m" );
		
		 $this->CI->template_m->auto_delete ( $id );
		$this->delete_image($id);
	}
	
	public function processImage($template_id) {
		if(empty($template_id))
			return;
		$this->CI->load->helper("upload");
		$path=UPLOAD_PATH.'../template/';
		$config['upload_dir'] = $path;
		$config['upload_dir'] = $config['upload_dir'];
	
		if (!is_dir($config['upload_dir'])) { //create the folder if it's not already exists
			mkdir($config['upload_dir'], 0755, TRUE);
		}
		$config['script_url'] = base_url() . $path;
		$config['upload_url'] = base_url() . $path;
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
				//$id_template= $template_id;
				$upload_dir = dirname($_SERVER['SCRIPT_FILENAME']) . $path;
				$url = base_url();
				$files = array();
				$type=isset($_REQUEST['type'])?$_REQUEST['type']:"FRONT";
				//echo $type;
				if ($images = $this->CI->template_m->get_images($template_id,$type)) {
					
					foreach ($images as $img) {
						$returnpath= $path . $template_id . '_' . $img->id_image .$this->img_extension;
						if(file_exists($returnpath)){
						$file = new stdClass();
						$file->name = $template_id . '_' . $img->id_image . $this->img_extension;
						$file->id_image = $img->id_image;
						$file->url = $path . $template_id . '_' . $img->id_image .$this->img_extension;
						$file->delete_url = site_url() . '/admin/template/img_upload'
								. '?id_image=' . rawurlencode($img->id_image).'&&id_template='.rawurlencode($template_id);
						$file->delete_url .= '&&method=DELETE';
						$file->deleteType='DELETE';
						$file->url_default= site_url() . '/admin/template/set_default/'.$template_id.'/'.$img->id_image.'/'.$img->type;
						$files[] = $file;
						}
					};
				}
				$obj=new stdClass();
				$obj->files=$files;
				print_r(json_encode($obj));
				break;
			case 'POST':
				
				if (isset($_REQUEST['method']) && $_REQUEST['method'] === 'DELETE') {
					$upload_handler->delete();
				} else {
					$id_template= $template_id;
					$type=$this->CI->input->post('type')?$this->CI->input->post('type'):"FRONT";
					
					//parent::create($this->fields);
					if(isset($_FILES['files'])){
						
							if ($timage=($this->CI->template_m->createimage($template_id,$type))) {
				
								$new_file_path=$path.$id_template."_".$timage->id_image.$this->img_extension;
								
								if (isset($_FILES['files']['tmp_name'][0])) {
									$file_path=$_FILES['files']['tmp_name'][0];
								
									if(file_exists($file_path)){
										
									if($file_path !== $new_file_path)
										 @copy($file_path, $new_file_path);
									}
								}
						
					
				 }
					
				 $files_return = array();
				
							//     foreach ($images as $img) {
							$file = new stdClass();
							$file->name = $id_template. '_' . $timage->id_image  . $this->img_extension;
							$file->id_image =  $timage->id_image ;
							$file->url =$path . $id_template. '_' .  $timage->id_image  .  $this->img_extension;
							$file->delete_url = $this->getFullUrl() . '/admin/template/img_upload' . '?id_image=' . rawurlencode($timage->id_image).'&&id_template='.rawurlencode( $id_template );
							$file->delete_url .= '&&method=DELETE';
							$file->deleteType='DELETE';
							$file->url_default= site_url() . '/admin/template/set_default/'.$id_template.'/'.$timage->id_image.'/'.$type;
							$files_return[] = $file;
	
	
							//  };
						
						$object= new stdClass();
						$object->files=$files_return;
						
						print_r(json_encode($object));
					}
				}
				break;
			case 'DELETE':
				
				if(!isset($_REQUEST['id_image']))
					return;
					if(!isset($_REQUEST['id_template']))
						return;
					$tid=$_REQUEST['id_template'];
					$image_id=$_REQUEST['id_image'];
				$this->CI->template_m->deleteimage($_REQUEST['id_image'], $_REQUEST['id_template']);
				$deltepath=$path . $tid. '_' .$image_id   .  $this->img_extension;
			//	echo $deltepath;die;
				if(file_exists($deltepath)){
					@unlink($deltepath);
				}
				//echo json_encode($this->tools->set_notification('N', 'notice', 'Delete successfull'));
				return;
				break;
			default:
				header('HTTP/1.1 405 Method Not Allowed');
		}
	}
	public function getFullUrl() {
		return (isset ( $_SERVER ['HTTPS'] ) ? 'https://' : 'http://') . (isset ( $_SERVER ['REMOTE_USER'] ) ? $_SERVER ['REMOTE_USER'] . '@' : '') . (isset ( $_SERVER ['HTTP_HOST'] ) ? $_SERVER ['HTTP_HOST'] : ($_SERVER ['SERVER_NAME'] . (isset ( $_SERVER ['HTTPS'] ) && $_SERVER ['SERVER_PORT'] === 443 || $_SERVER ['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER ['SERVER_PORT']))) . substr ( $_SERVER ['SCRIPT_NAME'], 0, strrpos ( $_SERVER ['SCRIPT_NAME'], '/' ) );
	}
	
}