<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Image_m extends MY_Model {
	protected $_table = 'tshirt_categories';
	protected $_images_type = 'tshirt_image_type';
	public function __construct() {
		parent::__construct ();
	}
	public function image_types_by_names($cond=array()) {
		if(empty($cond))
			return;
		$this->db->where($cond);
	
		return $this->db->get ( $this->_images_type )->result();
		
	}
}