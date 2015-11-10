<?php

class Routes_model extends CI_Model {

	var $table_routes="url_alias";
    function __construct() {
        parent::__construct();
    }

    // save or update a route and return the id
    function get_slug_id($oid,$entity){
    	if(!empty($oid)&&!empty($entity)){
	    	$this->db->where('entity', $entity);
	    	$this->db->where('oid', $oid);
	    	$row=$this->db->get($this->table_routes)->row();
	    	if(!empty($row))
	    		return $row->url_alias_id;
    	}
    	return false;
    }
    function save($route) {
        if (!empty($route['url_alias_id'])) {
            $this->db->where('url_alias_id', $route['url_alias_id']);
            $this->db->update($this->table_routes, $route);
            return $route['url_alias_id'];
        }
        else {
            $this->db->insert($this->table_routes, $route);
            return $this->db->insert_id();
        }
    }

    function check_routes_by_id($id) {
        if (!empty($id)) {
            $this->db->where('url_alias_id', $id);
            return (bool) $this->db->count_all_results($this->table_routes);
        }
        return FALSE;
    }
    function check_routes_by_oid($id,$entity='') {
    	if (!empty($id)&&($entity)) {
    		$this->db->where('entity', $entity);
    		$this->db->where('oid', $id);
    		return (bool) $this->db->count_all_results($this->table_routes);
    	}
    	return FALSE;
    }
    function check_slug_exist_product($slug, $id) {
        if (!empty($slug) && !empty($id)) {
            $this->db->where('url_alias_id', $id);
            $this->db->where('keyword', $slug);
            return (bool) $this->db->count_all_results($this->table_routes);
        }
        return FALSE;
    }

    function check_slug($slug, $id = false,$entity='product') {
        if ($id) {
            $this->db->where('url_alias_id !=', $id);
        }
       
        $this->db->where('keyword', $slug);
        $this->db->where('entity',$entity);
        return (bool) $this->db->count_all_results($this->table_routes);
    }

    function validate_slug($slug, $id = false, $count = false,$ext='') {
        if ($this->check_slug($slug . $count.$ext, $id)) {
            if (!$count) {
                $count = 1;
            }
            else {
                $count++;
            }
            return $this->validate_slug($slug, $id, $count,$ext);
        }
        else {
            return $slug . $count.$ext;
        }
    }

   
    function delete($id) {
        $this->db->where('url_alias_id', $id);
        $this->db->delete($this->table_routes);
    }

}
