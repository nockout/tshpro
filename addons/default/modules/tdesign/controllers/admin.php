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
					'field' => 'list_price',
					'label' => 'lang:design:price',
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
	
	}

	/**
	 * The main index page in the administration.
	 *
	 * Shows a list of the groups.
	 */
	
	public function save_images(){
		//$this->load->model("product_m");
		//$this->product_m->get_product_draft(23);
		//die;
	
		if(!isset($_REQUEST['arts'])){
			$this->session->set_flashdata("error","design:no_art_found");
			redirect("admin/tdesign/create_design");
		}
		if(!isset($_REQUEST['products'])){
			$this->session->set_flashdata("error","design:no_design_found");
			redirect("admin/tdesign/create_design");
		}
		// create art products;
		
		$this->load->library('product');
		$this->load->helper("tdesign");
		$raw_arts=[];
		$id_art=$this->product->create_new_art(array('data'=>serialize($_REQUEST['arts'])));
		if(!$id_art)
		{
			$this->session->set_flashdata("error","design:no_art_found");
			redirect("admin/tdesign/create_design");
		}
		
	
		$raw_designs=$_REQUEST['products'];
		$products=array();
		$group_id=time();
		foreach ($raw_designs as $group=>$arr_base64_imgs){
			$files=array();
			$names=array();
			if(empty($arr_base64_imgs["images"]))
				continue;
			//print_r($arr_base64_imgs);die;
			foreach ($arr_base64_imgs["images"] as $image){
				
				$base64_str = substr($image, strpos($image, ",")+1);	
			//decode base64 string
				$decoded = base64_decode($base64_str);
				$name= "temp".uniqid(). '.png';
				$file=UPLOAD_PATH.'../design/templates/' .$name;
				$files[] = $file;
				$names[]=$name;
				$result = file_put_contents($file, $decoded);
			}
			$urls=array();
			
			foreach ($names as $tempname){
				$urls[]=get_design_image_path("templates",$tempname);
			}
			$products[]=$this->product->create_draft(array('group_id'=>$group_id,'id_art'=>intval($id_art),"raw_url"=>$files,"image"=>$urls,"name"=>$arr_base64_imgs['title'],'price'=>$arr_base64_imgs['price']));
		}
	//	echo "<pre>";
		//print_r($products);die;
		if(empty($products)){
			show_error("Service Currently Unvaiable");
			return;
		}
		
// 		if(count($products)==1){
			
// 			redirect("admin/tdesign/form/".$products[0]->product_id);
// 		}
		redirect("admin/tdesign/manage/arts");
		
		
	}
	function test(){
		printf("uniqid(): %s\r\n", uniqid());die;
		$string='a:25:{s:2:"en";s:5:"Users";s:2:"ar";s:20:"المستخدمون";s:2:"br";s:9:"Usuários";s:2:"pt";s:12:"Utilizadores";s:2:"cs";s:11:"Uživatelé";s:2:"da";s:7:"Brugere";s:2:"de";s:8:"Benutzer";s:2:"el";s:14:"Χρήστες";s:2:"es";s:8:"Usuarios";s:2:"fa";s:14:"کاربران";s:2:"fi";s:12:"Käyttäjät";s:2:"fr";s:12:"Utilisateurs";s:2:"he";s:14:"משתמשים";s:2:"id";s:8:"Pengguna";s:2:"it";s:6:"Utenti";s:2:"lt";s:10:"Vartotojai";s:2:"nl";s:10:"Gebruikers";s:2:"pl";s:12:"Użytkownicy";s:2:"ru";s:24:"Пользователи";s:2:"sl";s:10:"Uporabniki";s:2:"tw";s:6:"用戶";s:2:"cn";s:6:"用户";s:2:"hu";s:14:"Felhasználók";s:2:"th";s:27:"ผู้ใช้งาน";s:2:"se";s:10:"Användare";}';
		echo "<pre>";
		print_r(unserialize($string));
		
	}
	
	public function export(){
		
		if(!isset($_REQUEST['base_64image'])){
			$this->session->set_flashdata("error",lang("design:no_design_found"));
			redirect("admin/tdesign/create_design");
		}
		$base64_str = substr($_REQUEST['base_64image'], strpos($_REQUEST['base_64image'], ",")+1);
		
		//decode base64 string
		$decoded = base64_decode($base64_str);
		
	
		//create png from decoded base 64 string and save the image in the parent folder
	
	
	
		
	
		$name= "temp".uniqid(). '.png';
		$file = UPLOAD_PATH.'../design/templates/' .$name;
		$result = file_put_contents($file, $decoded);
		
		
		$this->load->library('product');
		$this->load->helper("tdesign");
		// create draft design
		$product=$this->product->create_draft(array("raw_url"=>$file,"image"=>get_design_image_path("templates",$name)));
		//redirect("admin/tdesign/create");
		if(empty($product)){
			show_error("Service Currently Unvaiable");
			return;
		}
		$type=$this->input->post("product_type")?$this->input->post("product_type"):"shirts";
		
		redirect("admin/tdesign/form/".$product->product_id."/".$type);
	}
	public function create_design(){
		
		$this->load->library('product');
		$this->lang->load("templates");;
		
		$templates=$this->product->cate_templates();

		$template_cache=$this->load->view("admin/create/templates/template",array('templates'=>$templates),TRUE);
		
		
		
		$this->template->append_js(array("module::fancy_design/jquery.min.js",
				"module::fancy_design/jquery-ui.min.js",
				"module::fancy_design/bootstrap.min.js",
				"module::fancy_design/fabric.js",
				"module::fancy_design/jquery.fancyProductDesigner.js",
				//"module::fancy_design/app.js"
		));
	
		$this->template->append_css(array(
										"module::fancy_design/jquery-ui.css",
										"module::fancy_design/bootstrap.css",
										"module::fancy_design/icon-font.css",
										"module::fancy_design/jquery.fancyProductDesigner.css",								
										"module::fancy_design/plugins.min.css",
				"module::designer.css",
				
		));
		
		$this->template->title($this->module_details['name']);
		$this->template->set("templates",$template_cache);
		$this->template->set("template_categories",$templates);
		$this->template->build('admin/create/main');;
		
	}
	public function delete($id=null){
		if(!empty($id)){
			$this->load->library('product');
			//check logo 
			
			if($this->product->delete($id))
			{
				$this->session->set_flashdata("success",sprintf(lang("design:delete_success"),""));
			}else{
				$this->session->set_flashdata("error",sprintf(lang("design:delete_error"),""));
			}
		}
		redirect('admin/tdesign/index');
	}
	public function auto_delete($id){
		$this->load->library('product');
		$this->product->auto_delete($id);
	
	}

	public function action(){
		
		switch ($this->input->post("btnAction"))
		 { 	case "delete": 
		 	if($ids=$this->input->post("action_to")){
		 		$this->load->library('product');
		 		$this->product->delete($ids);
		 	}
		 	
		  };
		redirect('admin/tdesign/index');
	}
	public function sidebar(){
		$this->lang->load("templates");
		echo $this->load->view('admin/create/templates/actions',array(),TRUE);;
		die;
	}
	
	
	public function generate_folder(){
		
		$this->load->library('product');
		$this->product->generate_folder();
		ECHO "DONE";
	}
	public function index($page=0,$limit=6)
	{
		$this->load->library('product');
		$designs=$this->product->get_products(array(),$page,$limit);
	
	    $pagination = create_pagination('admin/tdesign/index', $designs['total'],6);
		$categories =array();	
	//	print_r($pagination);die;
		$this->template->set('categories',$categories);
 		$this->template->
 			set('designs',$designs['objects'])
 			->set('pagination', $pagination)
 			->title($this->module_details['name'])
			->build('admin/index');;

	}
	public function form($id=null,$type="null"){
		$id or redirect('admin/index');
		
		$this->load->library('product');
		$this->load->helper('currency');
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
		$data['keywords']="";
		$data['product_categories'] =array();
		$data['arts']="";
		if ($id) {
		
				$product=$this->product->get_product($id);
				if($product->status=="O"){
					$extra=unserialize($product->extra);
					//echo "<pre>";
				//	print_r($extra);die;
					if(isset($extra['image'])){
					
						$product->image=$extra['image'];
					}
					
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
		
			$data['product_code'] = $product->product_code;
			$data['short_description'] = isset($product->short_description)?$product->short_description:"";
			$data['full_description'] =isset($product->full_description)?$product->full_description:"";
			$data['keywords'] = isset($product->search_words)?$product->search_words:"";
			$data['list_price'] = $product->list_price;
			$data['extra'] = $product->extra;
			$data['product_code']=$product->product_code;
			//echo "<pre>";
			//print_r($product->extra);die;
			$data['images']=!empty($product->image)?$product->image:"";
			$data['avail_since']=$product->avail_since;
			$data['status']=$product->status;
			$data['arts']=$product->arts;
			
		
		}
		$this->form_validation->set_rules($this->validation_rules);
		
		if ($this->form_validation->run() == FALSE) {
				$this->template
				->set('hours', array_combine($hours = range(0, 23), $hours))
				->set('minutes', array_combine($minutes = range(0, 59), $minutes))
				->set('categories',array("1"=>"ROOT"));
				
				
				$this->template->set($data);
		
				$this->template
				->title($this->module_details['name'], lang('design:create_title'))
				->append_metadata($this->load->view('fragments/wysiwyg', array(), true))->build('admin/form');
			
		} else {
			$save['product_id'] = intval($id);
            $save['list_price'] =$this->input->post("list_price")?$this->input->post("list_price"):0;
            $save['status']=$this->input->post("status");
            $save['cate_id']=$this->input->post("category_id");
            
            $save['lang'][CURRENT_LANGUAGE]['product']=$this->input->post("title");
      
            $save['lang'][CURRENT_LANGUAGE]['search_words']=$this->input->post("keywords");
       
            $save['lang'][CURRENT_LANGUAGE]['full_description']=$this->input->post("body");
            $product_id=$this->product->save($id,$save);
            if( $product->status=="O"){
            	//generate image
            	$this->product->generate_image($product_id);
            }
          
            if($product_id){
            	$this->session->set_flashdata("success",sprintf(lang("design:publish_success"),$this->input->post("title")));
            }else{
            	$this->session->set_flashdata("error",sprintf(lang("design:publish_error"),$this->input->post("title")));
            }
            if($this->input->post("btnAction")=="save_exit"){
            	redirect("admin/tdesign/index/");
            }else{
            	redirect("admin/tdesign/form/".intval($id));
            }
          
		}
		
		
		
		
	
	}

	
}
