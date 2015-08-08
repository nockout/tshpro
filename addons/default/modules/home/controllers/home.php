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
	public function cate($cateID = null) {
		if (! $cateID)
			$cateID = 1;
		
		$this->load->model ( 'category_model' );
		$category=$this->category_model->get_category($cateID);
	
	
		$this->load->model ( 'product_model' );
		$product = $this->product_model->get_products ( array (
				"cate_id"=>intval($cateID) 
		) );
	
		$this->template->set("title",$category->category);
		$this->template->set("currentCate",$category->category_id);
		$this->template->set("currentCateName",$category->category);
		$this->template->title ( $this->module_details ['name'] )->
		set ( "products", $product ['objects'] )->
		
		build ( 'category' );
	}
	public function index() {
		$this->load->model ( 'product_model' );
		
		$product = $this->product_model->get_products ();
		$this->template->title ( $this->module_details ['name'] )->set ( "products", $product ['objects'] )->

		build ( 'home' );
	}
	public function product($id = null) {
		$this->load->model ( 'product_model' );
		$id or redirect ( "home" );
		$product = $this->product_model->get ( $id );
		if (empty ( $product ))
			redirect ( "home" );
		
		if (! isset ( $product->id_art ))
			redirect ( "home" );
		
		if ($product->id_art) {
			$relatePro = $this->product_model->get_related ( $product->id_art, $id );
			$this->template->set ( 'relprd', $relatePro );
		}
		
		$this->template->title ( $this->module_details ['name'] )->
		set ( 'product', $product )->
		build ( 'detail' );
	}
	public function category($slug = '') {
	}
}

