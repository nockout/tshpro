<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
/**
 * Permissions controller
 *
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Permissions\Controllers
 */
class Admin extends Admin_Controller {
	
	/**
	 * Constructor method.
	 *
	 * As well as everything in the Admin_Controller::__construct(),
	 * this additionally loads the models and language strings for
	 * permission and group.
	 */
	protected $validation_rules = array (
			'title' => array (
					'field' => 'title',
					'label' => 'lang:global:title',
					'rules' => 'trim|htmlspecialchars|required' 
			),
			
			array (
					'field' => 'cate_id',
					'label' => 'lang:design:category_label',
					'rules' => 'trim|required|numeric' 
			),
			
			// array(
			// 'field' => 'body',
			// 'label' => 'lang:design:description_label',
			// 'rules' => 'trim|required'
			// ),
			
			array (
					'field' => 'status',
					'label' => 'lang:design:status_label',
					'rules' => 'trim|alpha' 
			),
			array (
					'field' => 'created_on',
					'label' => 'lang:design:date_label',
					'rules' => 'trim|required' 
			),
			array (
					'field' => 'price',
					'label' => 'lang:design:price',
					'rules' => 'trim|numeric|required' 
			),
			
			array (
					'field' => 'keywords',
					'label' => 'lang:global:keywords',
					'rules' => 'trim' 
			) 
	)
	;
	public function __construct() {
		parent::__construct ();
		$this->lang->load ( 'design' );
		$this->load->helper ( array (
				"MY_string",
				"currency" 
		) );
		$this->load->model ( array (
				"category_model",
				"Routes_model" 
		) );
	}
	
	/**
	 * The main index page in the administration.
	 *
	 * Shows a list of the groups.
	 */
	public function save_images() {
		if (! isset ( $_REQUEST ['arts'] )) {
			$this->session->set_flashdata ( "error", "design:no_art_found" );
			redirect ( "admin/tdesign/create_design" );
		}
		if (! isset ( $_REQUEST ['products'] )) {
			$this->session->set_flashdata ( "error", "design:no_design_found" );
			redirect ( "admin/tdesign/create_design" );
		}
		
		$this->load->library ( 'product' );
		$this->load->helper ( "tdesign" );
		$raw_arts = [ ];
		if (isset ( $_REQUEST ['art_id'] )) {
			$id_art = $_REQUEST ['art_id'];
		} else
			$id_art = $this->product->create_new_art ( array (
					'data' => serialize ( $_REQUEST ['arts'] ) 
			) );
		
		if (! $id_art) {
			$this->session->set_flashdata ( "error", "design:no_art_found" );
			redirect ( "admin/tdesign/create_design" );
		}
		
		$raw_designs = $_REQUEST ['products'];
		$products = array ();
		$group_id = time ();
		foreach ( $raw_designs as $group => $arr_base64_imgs ) {
			$files = array ();
			$names = array ();
			if (empty ( $arr_base64_imgs ["images"] ))
				continue;
			foreach ( $arr_base64_imgs ["images"] as $image ) {
				$base64_str = substr ( $image, strpos ( $image, "," ) + 1 );
				$decoded = base64_decode ( $base64_str );
				$name = "temp" . uniqid () . '.png';
				$file = UPLOAD_PATH . '../design/designs/' . $name;
				$files [] = $file;
				$names [] = $name;
				$result = file_put_contents ( $file, $decoded );
			}
			$urls = array ();
			
			foreach ( $names as $tempname ) {
				$urls [] = get_design_image_path ( "designs", $tempname );
			}
			
			$products [] = $this->product->create_draft ( array (
					'group_id' => $group_id,
					'id_art' => intval ( $id_art ),
					"raw_url" => $files,
					"image" => $urls,
					"name" => $arr_base64_imgs ['title'],
					"id_template" => $arr_base64_imgs ['id_template'],
					"description" => $arr_base64_imgs ['description'],
					'price' => $arr_base64_imgs ['price'] 
			) );
		}
		if (empty ( $products )) {
			show_error ( "Service Currently Unvaiable" );
			return;
		}
		
		redirect ( "admin/tdesign/manage/arts" );
	}
	function test() {
		printf ( "uniqid(): %s\r\n", uniqid () );
		die ();
		$string = 'a:25:{s:2:"en";s:5:"Users";s:2:"ar";s:20:"المستخدمون";s:2:"br";s:9:"Usuários";s:2:"pt";s:12:"Utilizadores";s:2:"cs";s:11:"Uživatelé";s:2:"da";s:7:"Brugere";s:2:"de";s:8:"Benutzer";s:2:"el";s:14:"Χρήστες";s:2:"es";s:8:"Usuarios";s:2:"fa";s:14:"کاربران";s:2:"fi";s:12:"Käyttäjät";s:2:"fr";s:12:"Utilisateurs";s:2:"he";s:14:"משתמשים";s:2:"id";s:8:"Pengguna";s:2:"it";s:6:"Utenti";s:2:"lt";s:10:"Vartotojai";s:2:"nl";s:10:"Gebruikers";s:2:"pl";s:12:"Użytkownicy";s:2:"ru";s:24:"Пользователи";s:2:"sl";s:10:"Uporabniki";s:2:"tw";s:6:"用戶";s:2:"cn";s:6:"用户";s:2:"hu";s:14:"Felhasználók";s:2:"th";s:27:"ผู้ใช้งาน";s:2:"se";s:10:"Användare";}';
		echo "<pre>";
		print_r ( unserialize ( $string ) );
	}
	public function export() {
		if (! isset ( $_REQUEST ['base_64image'] )) {
			$this->session->set_flashdata ( "error", lang ( "design:no_design_found" ) );
			redirect ( "admin/tdesign/create_design" );
		}
		$base64_str = substr ( $_REQUEST ['base_64image'], strpos ( $_REQUEST ['base_64image'], "," ) + 1 );
		
		// decode base64 string
		$decoded = base64_decode ( $base64_str );
		
		// create png from decoded base 64 string and save the image in the parent folder
		
		$name = "temp" . uniqid () . '.png';
		$file = UPLOAD_PATH . '../design/designs/' . $name;
		$result = file_put_contents ( $file, $decoded );
		
		$this->load->library ( 'product' );
		$this->load->helper ( "tdesign" );
		// create draft design
		$product = $this->product->create_draft ( array (
				"raw_url" => $file,
				"image" => get_design_image_path ( "templates", $name ) 
		) );
		// redirect("admin/tdesign/create");
		if (empty ( $product )) {
			show_error ( "Service Currently Unvaiable" );
			return;
		}
		$type = $this->input->post ( "product_type" ) ? $this->input->post ( "product_type" ) : "shirts";
		
		redirect ( "admin/tdesign/form/" . $product->product_id . "/" . $type );
	}
	public function create_design() {
		$this->load->library ( 'product' );
		$this->lang->load ( "templates" );
		;
		
		$templates = $this->product->cate_templates ();
		// echo "<pre>";
		// print_r($templates);;
		// $template_cache=$this->load->view("admin/create/template",array('templates'=>$templates),TRUE);
		
		$this->template->append_js ( array (
				"module::fabric.min.js",
				"module::tshirtEditor.js",
				"module::jquery.miniColors.min.js",
				"module::bootstrap.min.js",
				"module::upload.js" 
		) );
		$this->template->append_css ( array (
				"module::jquery.miniColors.css",
				"module::bootstrap.min.css",
				"module::bootstrap-responsive.min.css",
				"module::designer.css" 
		)
		 );
		
		$this->template->title ( $this->module_details ['name'] );
		
		if (isset ( $_POST ['art_id'] )) {
			
			$this->template->set ( "art_id", $_POST ['art_id'] );
		}
		$this->template->set ( 'templates', $templates );
		// $this->template->set("templates",$template_cache);
		// $this->template->set("template_categories",$templates);
		$this->template->build ( 'admin/create/form' );
		;
	}
	public function delete($id = null) {
		if (! empty ( $id )) {
			$this->load->library ( 'product' );
			// check logo
			
			if ($this->product->delete ( $id )) {
				$this->session->set_flashdata ( "success", sprintf ( lang ( "design:delete_success" ), "" ) );
			} else {
				$this->session->set_flashdata ( "error", sprintf ( lang ( "design:delete_error" ), "" ) );
			}
		}
		redirect ( 'admin/tdesign/manage/index' );
	}
	public function auto_delete($id) {
		$this->load->library ( 'product' );
		$this->product->auto_delete ( $id );
	}
	public function action() {
		switch ($this->input->post ( "btnAction" )) {
			case "delete" :
				if ($ids = $this->input->post ( "action_to" )) {
					$this->load->library ( 'product' );
					$this->product->delete ( $ids );
				}
		}
		;
		redirect ( 'admin/tdesign/manage/index' );
	}
	public function sidebar() {
		$this->lang->load ( "templates" );
		echo $this->load->view ( 'admin/create/templates/actions', array (), TRUE );
		;
		die ();
	}
	public function generate_folder() {
		$this->load->library ( 'product' );
		$this->product->generate_folder ();
		ECHO "DONE";
	}
	public function index($page = 0, $limit = 6, $code = "", $by = "id", $way = "DESC") {
		$this->load->library ( 'product' );
		$this->load->helper ( "tdesign" );
		$designs = $this->product->get_products ( array (), $page, $limit );
		$pagination = panagition ( "admin/order/index/$code?by=$by&way=$way/", 4, $designs ['total'], $page, 6 );
		$categories = array ();
		
		$this->template->set ( 'categories', $categories );
		$this->template->set ( 'designs', $designs ['objects'] )->set ( 'pagination', $pagination )->title ( $this->module_details ['name'] )->build ( 'admin/index' );
		;
	}
	public function form($id = null, $type = "null") {
		$id or redirect ( 'admin/index' );
		
		$this->load->model ( array (
				"category_model",
				"product_m" 
		) );
		
		$categories = $this->category_model->get_option_categories ( 1 );
		
		$this->load->library ( 'product' );
		$this->load->helper ( 'currency' );
		$this->load->library ( 'form_validation' );
		$data ['categories'] = $categories;
		$data ['product_id'] = '';
		$data ['slug_id'] = "";
		$data ['slugurl'] = "";
		$data ['group_id'] = '';
		$data ['product'] = "";
		$data ['cate_id'] = '';
		$data ['status'] = "";
		$data ['shortname'] = '';
		$data ['product_code'] = '';
		$data ['short_description'] = '';
		$data ['full_description'] = '';
		$data ['search_words'] = '';
		$data ['list_price'] = '';
		$data ['price'] = '';
		$data ['extra'] = '';
		$data ['product_code'] = "";
		$data ['keywords'] = "";
		$data ['product_categories'] = array ();
		$data ['arts'] = "";
		$data ['id_art'] = "";
		$data ['slugurl'] = "";
		$data ['is_gc'] = "";
		if ($id) {
			
			$product = $this->product->get_product ( $id );
			$extra = unserialize ( $product->extra );
			$product->image = $extra ['image'];
			
			if (empty ( $product )) {
				die ( "no design found" );
			}
			
			$data ['product_id'] = $id;
			$cat = $this->product_m->get_category_products ( $product->product_id );
			$data ['group_id'] = $product->group_id;
			$data ['product'] = $product->product;
			$data ['cate_id'] = ! empty ( $cat ) ? $cat->category_id : "";
			$data ['product_code'] = $product->product_code;
			$data ['short_description'] = isset ( $product->short_description ) ? $product->short_description : "";
			$data ['full_description'] = isset ( $product->full_description ) ? $product->full_description : "";
			$data ['keywords'] = isset ( $product->search_words ) ? $product->search_words : "";
			$data ['price'] = $product->price;
			$data ['extra'] = $product->extra;
			$data ['product_code'] = $product->product_code;
			$data ['slug_id'] = $product->slug_id;
			$data ['slugurl'] = $product->slugurl;
			$data ['images'] = ! empty ( $product->image ) ? $product->image : "";
			$data ['avail_since'] = $product->avail_since;
			$data ['status'] = $product->status;
			$data ['arts'] = $product->arts;
			$data ['id_art'] = $product->id_art;
			$data ['slugurl'] = $product->slugurl;
			$data ['is_gc'] = $product->is_gc;
		}
		$this->form_validation->set_rules ( 'slugurl', 'lang:design:slug', 'trim|callback_checkslug[' . $id . ']' );
		$this->form_validation->set_rules ( $this->validation_rules );
		
		$this->form_validation->set_message ( 'checkslug', lang ( 'slug_exist' ) );
		if ($this->form_validation->run () == FALSE) {
			$this->template->set ( 'hours', array_combine ( $hours = range ( 0, 23 ), $hours ) )->set ( 'minutes', array_combine ( $minutes = range ( 0, 59 ), $minutes ) )->set ( 'categories', array (
					"1" => "ROOT" 
			) );
			
			$this->template->set ( $data );
			
			$this->template->title ( $this->module_details ['name'], lang ( 'design:create_title' ) )->append_metadata ( $this->load->view ( 'fragments/wysiwyg', array (), true ) )->build ( 'admin/form' );
		} else {
			
			$slug = $this->input->post ( 'slugurl' );
			
			if (empty ( $slug ) || $slug == '') {
				$slug = $this->input->post ( "title" );
			}
			$slug = create_slug ( $slug );
			
			if ($id) {
				$route_id = $product->slug_id;
				if (! $this->Routes_model->check_slug_exist_product ( $slug, $product->slug_id )) {
					$slug = $this->Routes_model->validate_slug ( $slug, $product->slug_id, false );
					if (! $this->Routes_model->check_routes_by_id ( $product->slug_id )) {
						$route ['keyword'] = $slug;
						$route ['oid'] = $id;
						$route_id = $this->Routes_model->save ( $route );
					}
				}
			} else {
				$slug = $this->Routes_model->validate_slug ( $slug, false, $count = false );
				$route ['keyword'] = $slug;
				$route_id = $this->Routes_model->save ( $route );
			}
			
			$save ['product_id'] = intval ( $id );
			$save ['price'] = $this->input->post ( "price" ) ? $this->input->post ( "price" ) : 0;
			$save ['status'] = $this->input->post ( "status" );
			$save ['is_gc'] = $this->input->post ( "is_gc" ) ? 0 : 1;
			
			$save ['lang'] [CURRENT_LANGUAGE] ['slugurl'] = $slug;
			$save ['lang'] [CURRENT_LANGUAGE] ['slug_id'] = $route_id;
			$save ['lang'] [CURRENT_LANGUAGE] ['product'] = $this->input->post ( "title" );
			$save ['lang'] [CURRENT_LANGUAGE] ['search_words'] = $this->input->post ( "keywords" );
			$save ['lang'] [CURRENT_LANGUAGE] ['full_description'] = $this->input->post ( "body" );
			$product_id = $this->product->save ( $id, $save );
			if ($category_id = $this->input->post ( "cate_id" )) {
				$this->product_m->save_category ( $product_id, $category_id );
			}
			
			$route ['url_alias_id'] = $route_id;
			$route ['keyword'] = $slug;
			$route ['query'] = 'home/product/' . $id . '';
			$route ['oid'] = $id;
			$this->Routes_model->save ( $route );
			
			if ($product_id) {
				$this->session->set_flashdata ( "success", sprintf ( lang ( "design:publish_success" ), $this->input->post ( "title" ) ) );
			} else {
				$this->session->set_flashdata ( "error", sprintf ( lang ( "design:publish_error" ), $this->input->post ( "title" ) ) );
			}
			if ($this->input->post ( "btnAction" ) == "save_exit") {
				redirect ( "admin/tdesign/manage/index/" . intval ( $product->id_art ) );
			} else {
				redirect ( "admin/tdesign/form/" . intval ( $id ) );
			}
		}
	}
	function checkslug($field, $id) {
		$this->load->library ( 'product' );
		if ($field == "" || empty ( $field )) {
			$slug = create_slug ( $field );
		} else
			$slug = create_slug ( $field );
		
		if (intval ( $id ) > 0) {
			$product = $this->product->get_product ( $id );
			$slug_id = $product->slug_id;
			if ($this->Routes_model->check_slug ( $slug, $slug_id )) {
				return false;
			}
		} else {
			if ($this->Routes_model->check_slug ( $slug )) {
				return false;
			}
		}
	}
	function templateinfo($id_template = 0) {
		$this->load->model ( 'product_m' );
		
		if ($id_template) {
			
			ob_clean ();
			$product = $this->product_m->get_product_template ( $id_template );
			die ( json_encode ( array (
					"na" => $product->name,
					"mp" => $product->price_max,
					"p" => $product->price,
					"idt" => $id_template 
			), true ) );
			ob_flush ();
			exit ();
		}
	}
	function upload() {
		if ($this->input->is_ajax_request ()) {
			$msg = "";
			$url = "";
			$status="";
			$file_element_name = 'img_file';
			if ($status != "error") {
				$config ['upload_path'] = './uploads/design/temp';
				$config ['allowed_types'] = 'gif|jpg|png|';
				$config ['max_size'] = 1024 * 8;
				$config ['encrypt_name'] = FALSE;
				$new_name = uniqid ();
				$config ['file_name'] = $new_name;
				
				$this->load->library ( 'upload', $config );
				if (! $this->upload->do_upload ( $file_element_name )) {
					$status = 'error';
					$msg = $this->upload->display_errors ( '', '' );
				} else {
					$data = $this->upload->data ();
					
					$image_path = $data ['full_path'];
					if (file_exists ( $image_path )) {
						$status = "success";
						$msg = "File successfully uploaded";
					} else {
						$status = "error";
						$msg = "Something went wrong when saving the file, please try again.";
					}
				}
				@unlink ( $_FILES [$file_element_name] );
				$url = '/uploads/design/temp/' . $data ['orig_name'];
				
				// put into temp session
				$arts=array();
				if($session_arts=$this->session->userdata('arts')){
					$arts=(array)json_decode($session_arts);
				}else{
					
				}
				$this->session->userdata('arts',json_encode($arts));
				
				
				
			}
			echo json_encode ( array (
					'status' => $status,
					'msg' => $msg,
					"call_back_url" => $url 
			) );
		}
		// return json_encode(array("callback_url"=>"/designs/3022w8/uploads/16043698"));
	}
	function pickcategory() {
		if ($this->input->is_ajax_request ()) {
			
			$status=$msg="";
			$id=$this->input->post('id');
			$this->load->library ( 'product' );
			$this->load->model('category_model');
			$category=$this->category_model->get_category(intval($id));
			$templates = $this->product->get_template_by_category ($id);
			if (empty ( $category )) {
				die ( json_encode ( array (
						'status' => $status,
						'msg' => $msg,
						"html" => "" 
				) ) );
			}
			$status="success";
			$templates = $this->product->get_template_by_category ($id);
			if($templates)	{
				foreach ( $templates as $t ) {
					$t->images = $this->product->get_templates_images ( $t->id_template );
				}
				$category->templates = $templates;
			}else{
				$category->templates = "";
			}
			$html=$this->load->view('admin/create/styles',array('products'=>$category->templates,'title'=>$category->category),true);
		
			die(json_encode ( array (
					'status' => $status,
					'msg' => $msg,
					"html" => $html 
			) ));
		}
	}
}
