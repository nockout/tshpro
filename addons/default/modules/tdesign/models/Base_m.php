<?php
class Base_m extends MY_Model {
	
	// var $all_langs=array();
	var $langs = array ();
	protected $_primary="";
	protected $lang_table="";
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'lang_m',"lang_model" );
		$this->langs = $this->lang_model->get_langs ( false );
	}
	function save_lang($id = 0, $lang = "en", $data = array()) {
		if (! $this->_primary && $this->lang_table)
			return;
		
		if (empty ( $id ) or empty ( $lang ) or empty ( $data ))
			return;
		if ($row = $this->db->get_where ( $this->lang_table, array (
				'id' => $id,
				'lang_code' => $lang 
		) )->row ()) {
			
			$this->db->where ( array (
					$this->_primary => $id,
					'lang_code' => $lang 
			) )->update ( $this->lang_table, $data );
		} else {
			// should save all lang
			if (count ( $this->langs )) {
				foreach ( $this->langs as $key => $lang ) {
					$data [$this->_primary] = $id;
					$data ['lang_code'] = $key;
					if (! $row = $this->db->get_where ( $this->lang_table, array (
							$this->_primary => $id,
							'lang_code' => $key 
					) )->row ())
						$this->db->insert ( $this->lang_table, $data );
				}
			} else {
				
				$data ['id'] = $id;
				$data ['lang_code'] = $lang;
				$this->db->insert ( $this->lang_table, $data );
			}
		}
	}
	function save_miss_lang($id = 0, $lang = "en", $data = array()) {
		if (empty ( $id ) or empty ( $lang ) or empty ( $data ))
			return;
		if ($row = $this->db->get_where ( $this->lang_table, array (
				'id' => $id,
				'lang_code' => $lang 
		) )->row ()) {
			
			$this->db->where ( array (
					'id' => $id,
					'lang_code' => $lang 
			) )->update ( $this->lang_table, $data );
		} else {
			// should save all lang
			$data ['id'] = $id;
			$data ['lang_code'] = $lang;
			$this->db->insert ( $this->lang_table, $data );
		}
	}
}
