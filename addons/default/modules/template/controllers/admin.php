
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
	protected $categories;
	protected $validation_rules = array(
			'title' => array(
					'field' => 'title',
					'label' => 'lang:global:title',
					'rules' => 'trim|htmlspecialchars|required'
			),
		
			array(
					'field' => 'category_id',
					'label' => 'lang:template:category_label',
					'rules' => 'trim|required|demical'
			),
			
		
			array(
					'field' => 'status',
					'label' => 'lang:template:template_status_label',
					'rules' => 'trim|alpha'
			),
			
			array(
					'field' => 'price',
					'label' => 'lang:template:template_price',
					'rules' => 'trim|numeric|integer'
			),
			array(
					'field' => 'price_max',
					'label' => 'lang:template:template_price',
					'rules' => 'trim|numeric|integer|callback_check_price'
			),
				
		
		
			
			
	);
	
	var $tplateImageFolder="";
	
	
	public function __construct()
	{
	    parent::__construct();
	    $this->tplateImageFolder=UPLOAD_PATH.'../template/';
		    $this->lang->load('template');
		    $this->load->helper(array('currency','tdesign'));
		    $this->load->model(array("category_model","search_model"));
		   
	}
	public function check_price(){
		$price=intval($this->input->post('price'));
		$price_max=intval($this->input->post("price_max"));
		if(!$price&&$price_max){
				
			return false;
		}
	//	echo "<aaa>";die;
		return ($price<$price_max)?true:false;
	}
	/**
	 * The main index page in the administration.
	 *
	 * Shows a list of the groups.
	 */
	
	public function action(){
		$this->load->library('tplate');
		
		switch ($this->input->post("btnAction")){
			case "delete":
				if($this->tplate->delete($this->input->post('action_to')))
					$this->session->set_flashdata("success",lang("template:action_success"));
				else 
					$this->session->set_flashdata("error",lang("template:action_unsuccess"));
				break;
			case "set_group":
				if($this->tplate->set_group($this->input->post('action_to')))
				$this->session->set_flashdata("success",lang("template:action_success"));
				else
					$this->session->set_flashdata("error",lang("template:action_unsuccess"));
		}
		redirect("admin/template/index");
	}
	
	public function delete($id=null){
		if(!empty($id)){
			$this->load->library('tplate');
			//check logo
				
			if($this->tplate->delete($id))
			{	
				$this->session->set_flashdata("success",sprintf(lang("design:delete_success"),""));
			}else{
				$this->session->set_flashdata("error",sprintf(lang("design:delete_error"),""));
			}
		}
		redirect('admin/template');
	}
	
	public function index($code = 0,  $by = 0, $way = "ASC",$page = 0)
	{
		$this->load->library('tplate');

		
		$categories=$this->category_model->get_option_categories(1);
		$this->load->model('template_m');
		
	
		if ($this->input->post('search')) {
		
			$object = $this->input->post();
			 
			$code = $this->search_model->record_term(json_encode($object));
			// echo $code;die;
			redirect(site_url(array('admin', 'template',"index", $code,$by, $way ,$page)));
		}
		$term = array();
		if ($code) {
		
			$term = json_decode($this->search_model->get_term($code));
		}
		$data['term']=$term;
		
		$templates=$this->template_m->get_templates($data,$by,$way,$page,6);
	
		$this->template->set("term",(array)$term);
	    $pagination=panagition("admin/template/index/$code/$by/$way/",4,$templates['total'],$page,6);
		$this->template->set('categories', $categories);
 		$this->template->set('templates',$templates['objects']);
 		$this->template->set('pagination', $pagination);
 		$this->template	->title($this->module_details['name']);;
		$this->template	->build('admin/index');

	}
		public function form($id=null,$type="null"){
	
		
		$this->load->library('form_validation');

		$data['colors_groups']=array();
		$data['price_max']='';
		$data['id_template'] = $id;
		$data['timestamp'] = 0;
		$data['status'] ="";
		$data['price'] = "";
		$data['color'] ="";
		$data['title']="";
		$this->load->library('tplate');
		$data['categories']=$this->category_model->get_option_categories(1);
		$data['category_id']="";
		$colors=$this->tplate->get_colors();

		$this->template->set('colors',$colors);
		$this->load->library('tplate');
		if (intval($id)) {
		
				$tplate=$this->tplate->get_template($id);
				
			if(empty($tplate))
			{
				$this->session->set_flashdata("error",lang("tplate:no_tplate_found"));
				redirect("admin/tplate");
			}
			
			//if the tplate does not exist, redirect them to the tplate list with an error
		
			if (!$tplate) {
				$tplate = $this->tplate->get_template($id);
				if(!$tplate){
					$this->session->set_flashdata('error', lang('error_not_found'));
					redirect($this->config->item('admin_folder') . '/tplate');
				}
				$savelang['name'] = $tplate->name;			
				$savelang['id_template'] = $tplate->id_template;
		
				$savelang['description'] = $tplate->description;

		
				//   $savelang['lang']=$lang;
				$this->tplate->save_lang($id, $lang, $savelang);
				redirect($this->config->item('admin_folder') . '/ttplate/form/' . intval($id) );
			}
			//set values to db values
			$data['template_id'] = $id;
			$data['price_max']=$tplate->price_max;
			$data['title'] = isset($tplate->name)?$tplate->name:"";
			$data['description'] = isset($tplate->short_description)?$tplate->short_description:"";
			$data['price'] =$tplate->price;
			$data['timestamp']=$tplate->timestamp;
			$data['status']=$tplate->status;
			$data['color']=$tplate->color;
			$data['category_id']=$tplate->id_category_default;
		/* 
			if($tplate->colors_groups){
				//$data['colors_groups']=unserialize($tplate->colors_groups);
			}
			 */
		
		}
		//echo "<pre>";
		//print_r($_POST);die;
		$this->form_validation->set_rules($this->validation_rules);
		
		if ($this->form_validation->run() == FALSE) {
			
			$this->template->append_css("module::spectrum.css");
				$this->template->append_css("module::custom.css");
				$this->template->set('categories',array("1"=>"ROOT"));
				
				
				$this->template->set($data);
				
				$this->template
				->title($this->module_details['name'], lang('template:create_title'));
			
				$this->add_js();
				$this->template->build('admin/form');
			
			//	return;
			
		} else {
			$save['id_template'] = intval($id);
            $save['price'] =$this->input->post("price")?$this->input->post("price"):"";
            $save['price_max'] =$this->input->post("price_max")?$this->input->post("price_max"):"";
            $save['status']=$this->input->post("status");
            $save['id_category_default']=$this->input->post("category_id");
            $save['color']=$this->input->post("color");
           // $save['colors_groups']=serialize($this->input->post('colors'));
            if(!$save['id_template'])
            $save['timestamp']=date('Y-m-d H:i:s');
            $save['lang'][CURRENT_LANGUAGE]['name']=$this->input->post("title");
            $save['lang'][CURRENT_LANGUAGE]['description']=$this->input->post("description");
           
            $id_tplate=$this->tplate->save($id,$save);
          
            
            if($id_tplate){
				$this->session->set_flashdata ( "success", sprintf ( lang ( "template:publish_success" ), $this->input->post ( "title" ) ) );
			} else {
				$this->session->set_flashdata ( "error", sprintf ( lang ( "template:publish_error" ), $this->input->post ( "title" ) ) );
			}
			if ($this->input->post ( "btnAction" ) == "save_exit") {
				redirect ( "admin/template/index/" );
			} else {
				redirect ( "admin/template/form/" . intval ( $id_tplate ) );
			}
          
		}
		
		
		
		
	
	}

	private function add_js(){

	
		//Asset::js_inline('jQuery.noConflict();');
		$this->template->append_js("module::jquery-1.8.3.js");
		$this->template->append_js("module::jquery-ui-1.9.2.custom.js");
		$this->template->append_js("module::template/tmpl.min.js");
		$this->template->append_js("module::template/load-image.min.js");
	
		$this->template->append_js("module::jquery.fileupload.js");
		$this->template->append_js("module::jquery.fileupload-process.js");
		$this->template->append_js("module::jquery.fileupload-image.js");
		$this->template->append_js("module::jquery.fileupload-ui.js");
		$this->template->append_js("module::jquery.fileupload-jquery-ui.js");
		$this->template->append_js("module::locale.js");
		$this->template->append_js("module::main.js");
		$this->template->append_js("module::spectrum.js");
		//$this->template->append_js("module::example.js");
	}
	public function img_upload() {
		
		error_reporting(E_ALL | E_STRICT);
		$this->load->library('session');
		
		if(!isset($_REQUEST['id_template'])){
			echo json_encode(array());
						die;
		}
		$r = $_REQUEST['id_template'];
		
	
		//  $product_id = $this->session->userdata('pid');
		if ( $id_template = intval($r)) {
	
			$this->load->library("tplate");
			if ($id_template) {
				//$img = new Image_model();
				$this->tplate->processImage(intval($id_template));
				return;
			}
		}
		die('No product id found');
	}
	public function set_default($id_template=null, $id_image=null,$type=null){
		if($id_image&&$id_template&&$type){
			$this->load->library("tplate");
			$this->tplate->set_default($id_template,$id_image,$type);
		}
	}
	
	public function import(){
		$this->load->library('Excel');
		$this->template->build('admin/import');
	}
	public function doimport($userFile="spreedsheet"){
		if(empty($_FILES))
			return;
		$error=array();
		ini_set('max_execution_time',0);
		
		$config['allowed_types'] = 'zip';
		$config['upload_path'] =  UPLOAD_PATH.'../import/';;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload($userFile))
		{
			$error = array('error' => $this->upload->display_errors());
		
			//$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$zip = new ZipArchive;
			$file = $data['upload_data']['full_path'];
			chmod($file,0777);
			if ($zip->open($file) === TRUE) {
				$zip->extractTo( UPLOAD_PATH.'../import/');
				$zip->close();
				//echo 'ok';
			} else {
				//echo 'failed';
			}
			if(!file_exists(UPLOAD_PATH.'../import/products.xlsx')){
				$error[]='ERROR: products.xlsx was not found';
			}
			if(!is_dir(UPLOAD_PATH.'../import/images')){
				$error[]='ERROR: images folder was not found';
			}
			if(empty($error)){
				try{
					$inputFileName=UPLOAD_PATH.'../import/products.xlsx';
				
				$this->load->library('excel');
				 $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
   				 $objReader = PHPExcel_IOFactory::createReader($inputFileType);
   				 $objPHPExcel = $objReader->load($inputFileName);
   				 } catch(Exception $e) {
   				 	$error[]=('ERROR: loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
   				 }
   				 
   				 
   				 $this->load->model('category/category_m');
   				 $this->load->model('template/template_m');
   				 //  Get worksheet dimensions
   				 $sheet = $objPHPExcel->getSheet(0);
   				 $highestRow = $sheet->getHighestRow();
   				 $highestColumn = $sheet->getHighestColumn();
   			
   				 for ($row = 2; $row <= $highestRow; $row++){
   				 
   				 	$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
   				 			NULL,
   				 			TRUE,
   				 			FALSE);
   				 	if(empty($rowData))
   				 		continue;
   				 	$data=$rowData[0];
   				 
   				 	$imgPath=UPLOAD_PATH.'../import'.$data[6];
   				
   				 	if(!file_exists($imgPath) || empty($data[6]))
   				 	{
   				 		
   				 		$error[]=sprintf("ERROR: can not find image path of product STT %s-%s-%s",$data[0],$data[2],$data[3]);
   				 		continue;
   				 	}
   				 	
   				 		// create product teamplate;
   				 	$category=$data[1];
   				 	
   				 	$category=$this->category_m->get_category_by_name($category);
   				 	$saveProduct['lang'][CURRENT_LANGUAGE]['name']=$data[2]?$data[2]:"empty name";
   				 	$saveProduct['lang'][CURRENT_LANGUAGE]['description']=$data[9]?$data[9]:"";
   				 	$saveProduct['code']=$data[5];
   				 	$saveProduct['color']=$data[7];
   				 	$saveProduct['price']=intval($data[8]);
   				 	$saveProduct['price_max']=intval($data[8]);
   				 	$saveProduct['status']='A';
   				 	
   				 	$saveProduct['timestamp']=date('Y-m-d h:i:s');
   				 	$saveProduct['id_category_default']=$category->category_id;
   				 	$id=$this->template_m->save("",$saveProduct);
   				
   					
   					if(!$this->importProcessImage($id,$imgPath)){
   						$error[]=sprintf("ERROR: can not find image path of product STT%s:%s-%s",$data[0],$data[2],$data[3]);
   					}
   				 	
   				 }
   				 
   				 
   				 
			}
			
		}
		
		$this->session->set_flashdata('import_errors',json_encode($error));
		//$this->session->set_flashdata('import_sucess',json_encode($error));
		//$this->session->set_flashdata('import_warning',json_encode($error));
		redirect("admin/template/import");
	}
	private function importProcessImage($id,$imgPath){
		$img=$this->template_m->createimage ( $id );
		//echo $imgPath;die;
		$returnpath = $this->tplateImageFolder . $id . '_' . $img->id_image . '.png';
		if (file_exists($imgPath)) {
		
			$config ['image_library'] = 'gd2';
			$config ['source_image'] = $imgPath;
			$config ['new_image'] = $returnpath;
			
			$config ['maintain_ratio'] = TRUE;
			$config ['height'] = 600;
			
			$this->load->library ( 'image_lib' );
			$resizer = new CI_Image_lib ();
			$resizer->initialize ( $config );
			$resizer->resize ();
			return true;
		}else{
			return ;
		}
	}
	

}