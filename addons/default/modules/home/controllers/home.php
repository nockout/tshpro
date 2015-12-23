<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
/**
 * Public Blog module controller
 *
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog\Controllers
 */
class Home extends Public_Controller {
	
	/**
	 * Every time this controller is called should:
	 */
	public function __construct() {
		parent::__construct ();
		
		$this->lang->load ( "home" );
		
		$this->load->helper ( "currency" );
	}
	
	public function index() {
	
		$this->load->model ( 'product_model' );
		$product = $this->product_model->get_products (array('is_gc'=>1),0,40);
		$this->template->title ( $this->module_details ['name'] )->set ( "products", $product ['objects'] )->
		build ( 'home' );
	}
	public function cate($cateID = null) {
		if (! $cateID)
			$cateID = 1;
	
		$this->load->model ( 'category_model' );
		$category=$this->category_model->get_category($cateID);
	
	
		$this->load->model ( 'product_model' );
		
		$per_page=$this->input->get('per_page')?$this->input->get('per_page'):0;
		$product = $this->product_model->get_products ( array (
				"cate_id"=>intval($cateID),intval($per_page),$limit=12
		) );
		$pagination= $this->pagination($this->current_full_url(),$product['total'], 12);;
		
		$this->template->set("pagination",$pagination);
		$this->template->set("title",$category->category);
		$this->template->set("currentCate",$category->category_id);
		$this->template->set("currentCateName",$category->category);
		$this->template->title ( $this->module_details ['name'] )->
		set ( "products", $product ['objects'] )->
		build ( 'category' );
	}
	public function product($id = null) {
		
		$this->load->model ( 'product_model' );
		$this->load->model ( 'art_model' );
		$id or redirect ( "home" );
		
		
		$product = $this->product_model->get ( $id );
		
		if($product->status=="D")
			show_404("page not found");
		
		if(!$this->art_model->isActive(intval($product->id_art)))
				show_404("page not found");
		
		
		$this->product_model->updateTotalView($id);
		$this->load->model ( array('category_model' ,'user/ion_auth_model'));		
		$user=$this->ion_auth_model->get_user($product->user_id)->row();
		$this->template->set ( 'user', $user );
		
		
		if (empty ( $product ))
			redirect ( "home" );
		
		/* if (! isset ( $product->id_art ))
			redirect ( "home" ); */
		
		if ($product->id_art) {
			$groupProducts = $this->product_model->groupProducts ( $product->id_art );
			
			
			$relatePro=array();
			if(!empty($groupProducts)){
				$relatePro=$groupProducts['objects'];
			}
			
			$this->template->set ( 'relprd', $relatePro );
		}
		
		$this->template->title ( $this->module_details ['name'] )->set ( 'product', $product )->build ( 'detail' );
	}
	public function search($slug = '') {
		
		$search=$this->input->get("search");
		$cateID=intval($this->input->get("cId"));
		$cateID=$cateID?$cateID:1;
		$this->load->model ( 'category_model' );
		$category=$this->category_model->get_category($cateID);
		$this->load->model ( 'product_model' );
		$per_page=$this->input->get('per_page')?$this->input->get('per_page'):0;
		
		
		$product = $this->product_model->get_products ( array (
				"cate_id"=>intval($cateID),
				"search_name"=>$search
		) ,intval($per_page),$limit=12);
		
		$pagination= $this->pagination($this->current_full_url(),$product['total'], 12);;
		$this->template->set("pagination",$pagination);
		$this->template->set("title",sprintf(lang("all_search"),$search));
		$this->template->set("currentCate",$category->category_id);
		$this->template->set("currentCateName",$category->category);
		$this->template->title ( sprintf(lang("all_search"),$search) )->
		set ( "products", $product ['objects'] )->build( 'search' );
		
		
	}
	public function user($id = '') {
		
		$search=$this->input->get("search");
		$cateID=intval($this->input->get("cId"));
		$cateID=$cateID?$cateID:1;
		$this->load->model ( array('category_model' ,'user/ion_auth_model'));
		
		$user=$this->ion_auth_model->get_user($id)->row();
	
		$category=$this->category_model->get_category($cateID);
	
		$this->load->model ( 'product_model' );
		$params=array (
				"user_id"=>intval($id),
				);
		$ordery_by=$order=$this->input->get('schTrmFilter');
		$order_way='DESC';
		switch ($order){
			case "sale" :
				$order = 'sale_amount';
				break;
			case "popular" :
				$order = 'total_view';
				break;
			case "new" :
				$order = 'avail_since';
				break;
			default:
				$order = 'avail_since';
		}
		$params['order']=$order;
		$params['way']=$order_way;
		
		
		if($term=$this->input->get('searchart')){
			$params['search_name']=$term;
		}
		$per_page=$this->input->get('per_page')?$this->input->get('per_page'):0;
		$product = $this->product_model->get_products ( $params,intval($per_page),$limit=12);
	
		$pagination= $this->pagination($this->current_full_url(),$product['total'], 12);;
		
		
		
		$this->template->set("title",sprintf(lang("all_search"),$search));
		$this->template->set("currentCate",$category->category_id);
		$this->template->set("currentCateName",$category->category);
		$this->template->set("user",$user);
		$this->template->set("order",$ordery_by);
		$this->template->set("pagination",$pagination);
		$this->template->title ( sprintf(lang("all_search"),$search) )->
		set ( "products", $product ['objects'] )->build( 'artis' );
	
	
	}
	public function pagination($uri,$total,$limit){
		$this->load->library('pagination');
		$config['full_tag_open'] = '<ul class="pagination">';
		
		
		$config['full_tag_close'] = '</ul>';
		$config['base_url'] = $uri;
		$config['total_rows'] = $total;
		$config['per_page'] = 12;
		$config['num_links'] = 5;
		$config['page_query_string'] = true;
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	
	private function current_full_url()
	{
			$CI =& get_instance();
	
		$url = $CI->config->site_url($CI->uri->uri_string());
		$q='';
		
		if($_GET)
		foreach ($_GET as $k =>$v){
			if($k=='per_page')
				continue;
			$vars[]="$k=$v";
			
		}
	
		if(!empty($vars))
		$q=implode('&', $vars);
	
		return $q ? ($url.'?'.$q ): $url.'?'.$q;
	}
	
	
}

