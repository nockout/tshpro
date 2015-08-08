<?php
Class Category_model extends CI_Model
{

	var $_table="tshirt_categories";
	var $_description="tshirt_category_descriptions";
    function get_categories($parent = false)
    {
        if ($parent !== false)
        {
            $this->db->where('parent_id', $parent);
        }
        $this->db->select('*');
      	$this->db->join($this->_description,"$this->_table.category_id=$this->_description.category_id");
        $this->db->order_by("$this->_table.position", 'ASC');
        
        //this will alphabetize them if there is no position
        $this->db->order_by('category', 'ASC');
      
        $this->db->where("lang_code",CURRENT_LANGUAGE);
        $result = $this->db->get($this->_table)->result();
      // 
        
        
        return $result;
    }
    function get_option_categories($parent = false)
    {
    	if ($parent !== false)
    	{
    		$this->db->where('parent_id', $parent);
    	}
    	$this->db->select('*');
    	$this->db->join($this->_description,"$this->_table.category_id=$this->_description.category_id");
    	$this->db->order_by("$this->_table.position", 'ASC');
    
    	//this will alphabetize them if there is no position
    	$this->db->order_by('category', 'ASC');
    
    	$this->db->where("lang_code",CURRENT_LANGUAGE);
    	$result = $this->db->get($this->_table)->result();
    	if(empty($result))
    		return array();
    	//
    	foreach ($result as $r){
    		$categories[$r->category_id]=$r->category;
    	}
    
    	return $categories;
    }
    function get_categories_tiered($admin = false)
    {
        if(!$admin) $this->db->where('enabled', 1);
        
        $this->db->order_by('position');
        $this->db->order_by('name', 'ASC');
        $categories = $this->db->get($this->_table)->result();
        
        $results    = array();
        foreach($categories as $category) {

            // Set a class to active, so we can highlight our current category
            if($this->uri->segment(1) == $category->slug) {
                $category->active = true;
            } else {
                $category->active = false;
            }

            $results[$category->parent_id][$category->id] = $category;
        }
        
        return $results;
    }
    
    function get_category($id)
    {  	$this->db->select('*');
      	$this->db->join($this->_description,"$this->_table.category_id=$this->_description.category_id");
      	$this->db->where("lang_code",CURRENT_LANGUAGE);
      	$this->db->order_by("$this->_table.position", 'ASC');
        return $this->db->get_where($this->_table, array("$this->_table.category_id"=>$id))->row();
    }
    
    function get_category_products_admin($id)
    {
        $this->db->order_by('position', 'ASC');
        $result = $this->db->get_where('category_products', array('category_id'=>$id));
        $result = $result->result();
        
        $contents   = array();
        foreach ($result as $product)
        {
            $result2    = $this->db->get_where('products', array('category_id'=>$product->product_id));
            $result2    = $result2->row();
            
            $contents[] = $result2; 
        }
        
        return $contents;
    }
    
    function get_category_products($id, $limit, $offset)
    {
        $this->db->order_by('position', 'ASC');
        $result = $this->db->get_where('category_products', array('category_id'=>$id), $limit, $offset);
        $result = $result->result();
        
        $contents   = array();
        $count      = 1;
        foreach ($result as $product)
        {
            $result2    = $this->db->get_where('products', array('category_id'=>$product->product_id));
            $result2    = $result2->row();
            
            $contents[$count]   = $result2;
            $count++;
        }
        
        return $contents;
    }
    
    function organize_contents($id, $products)
    {
        //first clear out the contents of the category
        $this->db->where('category_id', $id);
        $this->db->delete('category_products');
        
        //now loop through the products we have and add them in
        $position = 0;
        foreach ($products as $product)
        {
            $this->db->insert('category_products', array('category_id'=>$id, 'product_id'=>$product, 'position'=>$position));
            $position++;
        }
    }
    
    function save($category)
    {
        if ($category['category_id'])
        {
            $this->db->where('category_id', $category['category_id']);
            $this->db->update($this->_table, $category);
            
            return $category['category_id'];
        }
        else
        {
            $this->db->insert($this->_table, $category);
            return $this->db->insert_id();
        }
    }
    
    function delete($id)
    {
        $this->db->where('category_id', $id);
        $this->db->delete($this->_table);
        
        //delete references to this category in the product to category table
        $this->db->where('category_id', $id);
        $this->db->delete('category_products');
    }
}