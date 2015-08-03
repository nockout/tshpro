<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "base_m.php";
class Template_m extends Base_m
{
	protected $_table = 'tshirt_template';	

	protected $_primary="id_template";
	protected $lang_table="tshirt_template_lang";
	protected $_image_table="tshirt_template_image";
	protected $_colors="tshirt_colors";
	protected $template_design="tshirt_products";
	
	public function __construct()
	{
		parent::__construct();
		
	}
	public function delete($id){		
		if(!is_array($id)){
			$id=array($id);
		}
		
		if(!$this->db->where_in($this->_primary,$id)->get($this->_table)->result()){
		
			return false;
		}
		
		$this->db->where_in("id_template",($id))->update($this->template_design,array("deleted"=>3));
		
		return $this->db->where_in($this->_primary,($id))->update($this->_table,array("deleted"=>1));
	}
	public function auto_delete($id){
		if(empty($id))
			return ;
		if(!is_array(($id))){
			$id=array($id);
		}
		
		$this->db->where_in($this->_primary,($id));
		if($this->db->delete($this->_table)){
			return	$this->db->where_in($this->_primary,($id))->delete($this->lang_table);
		
		}
		return  ;
		
	}
	public function set_group($ids){
		if(empty($ids))
			return ;
		if(!is_array(($ids))){
			$ids=array($ids);
		}
		$this->db->select_max("group_id");
		$max_id=$this->db->get($this->_table)->row();
	
		$max_id=$max_id->group_id+1;
		return $this->db->where_in('id_template',$ids)->update($this->_table,array("group_id"=>$max_id));
	}
	public function get_templates($params,$offset=0,$limit=6){
	

		$this->db->select("SQL_CALC_FOUND_ROWS *", FALSE);
	
		$this->db->select("(select name from ".$this->db->dbprefix("tshirt_template_categories")." where id_category=id_category_default and lang_code='".CURRENT_LANGUAGE."') as cate_name");
		$this->db->join($this->lang_table,$this->lang_table.'.'.$this->_primary.'='.$this->_table.'.'.$this->_primary);
		$this->db->where('lang_code',CURRENT_LANGUAGE);
		$this->db->where('deleted',0);
		$this->db->offset($offset)->limit($limit);
		$this->db->order_by("group_id");
		//$this->db->order_by("position");
		$objct=$this->db->get($this->_table)->result();
		//print_r($objct);die;
		$return=array();
		$result['objects']=$objct;
		$result['total']=0;
		$query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
        $result['total']= $query->row()->Count;
          
	//print_r($result);die;
		return $result;
		
	
	}
	public function get($id){

	
		$this->db->select("*");
		$this->db->join($this->lang_table,$this->lang_table.'.'.$this->_primary.'='.$this->_table.'.'.$this->_primary,"LEFT");
		$this->db->where('lang_code',CURRENT_LANGUAGE);
		$this->db->where('deleted',0);
		$result=$this->db->where($this->_table.'.'.$this->_primary,$id)->get($this->_table)->row();

		
	
		return $result;
	}
	

	public function save($id,$save){
		if(empty($save)){
			return false;
		}
		$status=$save['status'];
		if($save['status']=="D"){
			//$save['extra']=null;	
			$save['status']="A";
		}
		$lang=$save['lang'];
		unset($save['lang']);
		if(!$id){
			$this->db->insert($this->_table,$save);
			$id=$this->db->insert_id();		
		}else{
			$this->db->where($this->_primary,intval($id))->update($this->_table,$save);
		}
		///if($status=="D"){
		
			//create new description;
			//if(isset($lang[CURRENT_LANGUAGE])){
		$this->save_lang($id,CURRENT_LANGUAGE,$lang[CURRENT_LANGUAGE]);
			//}
		
		//}else{
			
		//}
		return $id;
	}
	private function delete_image($id_template=null) {
		
		//unlink image
		$query = ($this->db->select('id_image,id_template')
				->from($this->_image_table)
				->where('id_template', intval(intval($id_template)))->get());
	
		$images = $query->result_object();
	
		if (count($images)) {
			foreach ($images as $val) {
				$types = Image_model::getImageType();
				$ImageDir = APPPATH . '../upload/template/';
				if (is_array($types)) {
					foreach ($types as $type) {
						$filename = $val->id_template . '_' . $val->id_image  . '.jpg';
						if (file_exists($ImageDir . $filename)) {
							@unlink($ImageDir . $filename);
						}
					}
				}
				$this->db->delete('image', array('id_image' => $val->id_image));
			}
		}
	}
	public function createimage($id_template=0,$type='FRONT'){
		if(intval($id_template)){
			$this->db->insert($this->_image_table,array("id_template"=>$id_template,"type"=>$type));
			$insert_id=$this->db->insert_id();
			$object=new stdClass();
			$object->id_template=$id_template;
			$object->id_image=$insert_id;
			return $object;
			
		}
	}
	function get_images($id_template = 0,$type="FRONT") {
			
		$this->db->select('*');
		$this->db->from($this->_image_table);
		if(!empty($type))
		$this->db->where('type',$type)	;
		$this->db->order_by("position","DESC");
		$this->db->where('id_template', intval($id_template));
			
		$query=$this->db->get()->result();
	
	
	
		return $query;
	}
	public function set_default($id_template=null,$id_image=null,$type=null){
	
		if(!$id_template&&$id_image&&type)
				return;
	
		// reset 
		$this->db->
		where("id_template",$id_template)->where('type',$type)->update($this->_image_table,array("position"=>0));
		return $this->db->where("id_image",intval($id_image))->update($this->_image_table,array("position"=>1));
	}
	function get_colors(){
		return $this->db->get($this->_colors)->result();
	}
	function deleteimage($id_image=null,$id_template=null){
		return $this->db->where('id_image',intval($id_image))->where('id_template',intval($id_template))->delete($this->_image_table);
	}
	 function get_image($id_template = 0) {
		 
		$this->db->select('*');
		$this->db->from($this->_image_table);
		 
		$this->db->where('id_template', intval($id_template));
		 
		$query=$this->db->get();
	
		 
		$result="";
		if($query->row()){
			$result= $query->row()->id_image;
			$query->free_result();
		}
	//	log_message("debug",$result);
	
		return $result;
	}
	
	

}