<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lang_m extends CI_Model {

	private $table_lang="tshirt_lang";
    function __construct() {
        parent::__construct();
    }

    function get_lang() {
        return $this->db->order_by('id')->get($this->table_lang)->result();
    }

    function status($id, $status) {
        return $this->db->where('id', $id)->update($this->table_lang, array('active' => $status));
    }

    function get($id) {
        return $this->db->select('*')->from($this->table_lang)->where('id', $id)->get()->row();
    }

    function save($data = array()) {

        if (empty($data))
            return;
        if (!isset($data['active'])) {
            $data['active'] = 0;
        }
        $data['iso_code'] = trim(strtoupper($data['iso_code']));
        if (isset($data['id'])) {
            $data['id'] = intval($data['id']);
            $this->db->where('id', $data['id'])->update($this->table_lang, $data);
            return $data['id'];
        } else {
            $this->db->insert($this->table_lang, $data);
            return $this->db->insert_id();
        }
    }

    function delete($id) {
        return $this->db->where('id', $id)->delete($this->table_lang);
    }

    function get_langs($active = 1) {
        if ($active) {
            $this->db->where('active', $active);
        }
        $result = $this->db->order_by('sequence')->get($this->table_lang)->result();
        if (empty($result))
            return;
        foreach ($result as $l) {
            $lang[$l->iso_code] = $l;
        }
        return $lang;
    }

}
