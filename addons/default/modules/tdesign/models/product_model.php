<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'product_description_model.php';
require 'product_price_model.php';
require 'product_options_model.php';

class Product_m extends SMC_Model {

    public $product_id;

    /**
     * @var varchar Max length is 32.
     */
    public $product_code;

    /**
     * @var char Max length is 1.
     */
    public $product_type = "P";

    /**
     * @var char Max length is 1.
     */
    public $status = "A";

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $company_id;

    /**
     * @var decimal Max length is 12. ,2).
     */
    public $list_price;

    /**
     * @var mediumint Max length is 8.
     */
    public $amount;

    /**
     * @var decimal Max length is 12. ,2).
     */
    public $weight = 0;

    /**
     * @var mediumint Max length is 8.  unsigned.
     */
    public $length = 0;

    /**
     * @var mediumint Max length is 8.  unsigned.
     */
    public $width = 0;

    /**
     * @var mediumint Max length is 8.  unsigned.
     */
    public $height = 0;

    /**
     * @var decimal Max length is 12. ,2).
     */
    public $shipping_freight = 0;

    /**
     * @var mediumint Max length is 8.  unsigned.
     */
    public $low_avail_limit = 0;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $timestamp;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $updated_timestamp = 0;

    /**
     * @var varchar Max length is 255.
     */
    public $usergroup_ids = 0;

    /**
     * @var char Max length is 1.
     */
    public $is_edp = 'N';

    /**
     * @var char Max length is 1.
     */
    public $edp_shipping = 'N';

    /**
     * @var char Max length is 1.
     */
    public $unlimited_download = 'N';

    /**
     * @var char Max length is 1.
     */
    public $tracking;

    /**
     * @var char Max length is 1.
     */
    public $free_shipping = 'N';

    /**
     * @var char Max length is 1.
     */
    public $feature_comparison = 'N';

    /**
     * @var char Max length is 1.
     */
    public $zero_price_action = "N";

    /**
     * @var char Max length is 1.
     */
    public $is_pbp = 'Y';

    /**
     * @var char Max length is 1.
     */
    public $is_op = "N";

    /**
     * @var char Max length is 1.
     */
    public $is_oper = 'N';

    /**
     * @var char Max length is 1.
     */
    public $is_returnable = 'Y';

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $return_period = 10;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $avail_since;

    /**
     * @var char Max length is 1.
     */
    public $out_of_stock_actions;

    /**
     * @var varchar Max length is 255.
     */
    public $localization = '';

    /**
     * @var smallint Max length is 5.
     */
    public $min_qty;

    /**
     * @var smallint Max length is 5.
     */
    public $max_qty;

    /**
     * @var smallint Max length is 5.
     */
    public $qty_step;

    /**
     * @var smallint Max length is 5.
     */
    public $list_qty_count;

    /**
     * @var varchar Max length is 255.
     */
    public $tax_ids = 0;

    /**
     * @var char Max length is 1.
     */
    public $age_verification = 'N';

    /**
     * @var tinyint Max length is 4.
     */
    public $age_limit = 0;

    /**
     * @var char Max length is 1.
     */
    public $options_type;

    /**
     * @var char Max length is 1.
     */
    public $exceptions_type;

    /**
     * @var varchar Max length is 50.
     */
    public $details_layout = 'default';

    /**
     * @var varchar Max length is 255.
     */
    public $category_id = 1;
    public $category_name = 'Home';
    public $shipping_params = '';
    public $table = 'bahani_products';
    public $primary = 'product_id';
    public $_fields = array('product_id', 'product_code', 'product_type', 'status', 'company_id', 'list_price', 'amount', 'weight', 'length', 'width', 'height', 'shipping_freight', 'low_avail_limit', 'timestamp', 'updated_timestamp', 'usergroup_ids', 'is_edp', 'edp_shipping', 'unlimited_download', 'tracking', 'free_shipping', 'feature_comparison', 'zero_price_action', 'is_pbp', 'is_op', 'is_oper', 'is_returnable', 'return_period', 'avail_since', 'out_of_stock_actions', 'localization', 'min_qty', 'max_qty', 'qty_step', 'list_qty_count', 'tax_ids', 'age_verification', 'age_limit', 'options_type', 'exceptions_type', 'details_layout', 'shipping_params');
    public $_product_description;
    public $_product_prices;
    public $_product_options;
    public static $_searchfields = array(
        array('fname' => 'product_id', 'display_name' => 'Product ID', 'type' => 'number', 'table' => 'p'),
        array('fname' => 'product', 'display_name' => 'Name', 'type' => 'string'),
        array('fname' => 'product_code', 'display_name' => 'Status', 'type' => 'string'),
        array('fname' => 'price', 'display_name' => 'Prices', 'type' => 'number'),
        array('fname' => 'status', 'display_name' => 'Status', 'type' => 'string'),
//                array('fname'=>'test','display_name'=>'test Product','type'=>'datetime')
    );

    public function Product_model() {
        $this->_product_description = new Product_description_model();
        $this->_product_prices = new Product_prices_model();
    }

    public function getProductById($product_id) {
        $product = Product_model::find('product_id', $product_id);
        if ($product) {
            $product->_product_description = Product_description_model::find('product_id', $product_id);
            $product->_product_prices = Product_prices_model::find('product_id', $product_id);
            // $product->_product_options = Product_options_model::find_options($product_id);
            $cate = $product->getCategoryProduct($product_id);
            if ($cate) {

                $product->category_id = $cate[0]->category_id;
                $product->category_name = $cate[0]->category;
            }
        }

        return $product;
    }

    public function getCategoryProduct($product_id) {
        if ($product_id) {
            $this->db->select('pc.category_id,category');
            $this->db->from('products_categories pc');
            $this->db->join('category_descriptions cd', 'pc.category_id=cd.category_id');
            $this->db->where('product_id', $product_id);
            $this->db->limit(1, 0);
            $results = $this->db->get();
            if (count($results))
                return $results->result_object();
        }
        return 0;
    }

    public function getProductByCategoryID($category_id, $offset = 0, $limit = 1, $orderBY = null, $orderWay = 'ASC', $company_id = null, $useSolr = false) {
        $this->db->cache_delete('product', 'ajax_list');
        if ($useSolr) {

            $this->load->library("solr/Solr");
            $solrServer = $this->config->config['solr_server_address'];
            $solrServerPort = $this->config->config['solr_port'];
            $solrPath = $this->config->config['solr_path'];
            $collection = 'products';
            $solr = new Apache_Solr_Service($solrServer, $solrServerPort, $solrPath . $collection);
            try {
                $query = $category_id == 1 ? "*:*" : "category_id:" . $category_id;
                // urlencode(" *:*&sort=price+ASC ");
                $searchOptions = array('sort' => 'product desc');
                $results = $solr->search($query, $offset, $limit, $searchOptions);
                if ($results) {
                    $total = (int) $results->response->numFound;
                    $start = min(1, $total);
                    $end = min($limit, $total);
                }
               
                 foreach ( $results->response->docs as $p) {
                    if(!isset($p->id_image))
                          $p->id_image=$this->get_image(intval($p->product_id));
                   
                } 
                
               
                $result = array('products' => $results->response->docs,
                    'total' => $total,
                    'start' => $start,
                    'end' => $end);
                return $result;
            } catch (Exception $e) {
                print_r($e);
            }
            return;
        } else {
            if ($orderBY == 'product_id')
                $orderBY = 'p1.product_id';
            $query = 'SELECT  *  FROM 
                     (SELECT product_id as pid FROM 
                    (select id_category as category_id from ' . $this->db->dbprefix . 'categoryindex where id_parent=' . $this->db->escape((($category_id != 1) ? $category_id : 1)) . ') pci 
                    left join ' . $this->db->dbprefix . 'products_categories pc on pc.category_id = pci.category_id' .
                    ' LIMIT ' . $this->db->escape(intval($offset)) . ',' . $this->db->escape(intval($limit)) .
                    ') p 
                     LEFT JOIN ' . $this->db->dbprefix . 'products p1 ON p.pid=p1.product_id 
                     LEFT JOIN ' . $this->db->dbprefix . 'product_descriptions pd ON p.pid=pd.product_id 
                     LEFT JOIN ' . $this->db->dbprefix . 'product_prices pp ON p.pid=pp.product_id
                     LEFT JOIN ' . $this->db->dbprefix . 'image pi ON p.pid=pi.product_id ';
            if ($company_id) {
                $query.='WHERE  p1.company_id=' . $this->db->escape($company_id);
            }

            $query.=' GROUP BY p.pid';
            if ($orderBY)
                $query.=' order by ' . $this->db->escape_str($orderBY) . ' ' . $orderWay;
////            $query.=' LIMIT ' . $this->db->escape(intval($limit)). ',' . $this->db->escape(intval($offset));
//            print_r($query);
//            die;
            $result = $this->db->query($query);
            $this->load->driver('cache');
            $totals = array();
            if ($this->cache->apc) {

                $totals = $this->cache->apc->get('totals');
            }
            $totalProduct = 0;
            if (isset($totals[$category_id])) {
                $totalProduct = $totals[$category_id];
            } else {
                $queryTotal = '(SELECT product_id as pid FROM 
                    (select id_category as category_id from ' . $this->db->dbprefix . 'ps_categoryindex where id_parent=' . $this->db->escape((($category_id != 1) ? $category_id : 1)) . ') pci 
                    left join ' . $this->db->dbprefix . 'products_categories pc on pc.category_id = pci.category_id' .
                        ')';
                $rs = $this->db->query($queryTotal);
                $totalProduct = $rs->num_rows();
                if ($this->cache->apc) {
                    $totals = $this->cache->apc->get('totals');

                    if (is_array($totals)) {
                        $totals[$category_id] = $totalProduct;
                    } else {
                        $totals = array($category_id => $totalProduct);
                    }

                    $this->cache->apc->save('totals', $totals, 1000);
                }
            }
            $start = min(1, $totalProduct);
            $end = min($limit, $totalProduct);

            $results = array('products' => $result->result_object(),
                'total' => $totalProduct,
                'start' => $start,
                'end' => $end);
        }

        return $results;
    }

    public function save($properties_to_save = array()) {
        $this->timestamp = strtotime($this->timestamp);
        $this->updated_timestamp = strtotime($this->updated_timestamp);
        $this->avail_since = strtotime($this->avail_since);
        if (parent::save($properties_to_save) && $this->hook_after_process_edit())
            return true;
        return false;
    }

    public function create($properties_to_save = array()) {
        $this->timestamp = strtotime($this->timestamp);
        $this->updated_timestamp = strtotime($this->updated_timestamp);
        $this->avail_since = strtotime($this->avail_since);
        if (parent::create($properties_to_save) && $this->hook_after_process_add())
            return true;

        return false;
    }

    private function hook_after_process_add() {
        $this->_product_prices->product_id = $this->product_id;
        $this->_product_prices->create($this->_product_prices->_fields, false);
        $this->_product_description->product_id = $this->product_id;
        $this->_product_description->create($this->_product_description->_fields, false);
        $this->updateProductCategory('add');
        return true;
    }

    private function hook_after_process_edit() {
        $this->_product_prices->product_id = $this->product_id;
        $this->_product_prices->save($this->_product_prices->_fields);
        $this->_product_description->product_id = $this->product_id;
        $this->_product_description->save($this->_product_description->_fields);
        $this->updateProductCategory('update');

        return true;
    }

    private function updateProductCategory($action) {
        switch ($action) {
            case 'add':
                $this->db->insert('products_categories', array('product_id' => $this->product_id,
                    'category_id' => $this->category_id,
                    'link_type' => 'M',
                    'position' => 0)
                );
                break;
            case 'update':
                $this->db->where('product_id', $this->product_id);
                $this->db->update('products_categories', array(
                    'category_id' => $this->category_id,
                    'link_type' => 'M',
                    'position' => 0)
                );
                break;
            default:
                break;
        }
    }

    public static function getSearchFieldByKey($key) {


        foreach (Product_model::$_searchfields as $f) {
            if ($f['fname'] == $key)
                return $f;
        }


        return null;
    }

    public function search($conditions = array(), $offset = 0, $limit = 1, $orderBy = null, $orderName = 'ASC', $seachOnSolr = false) {
        if ($seachOnSolr) {

            die('Coming soon');
        } else {


            $query = "SELECT   SQL_CALC_FOUND_ROWS *,p.product_id as pid,p.product_id,pc.price,p.list_price,p.amount,pd.product,p.product_code,p.status,pi.id_image FROM " .
                    $this->db->dbprefix . "products p 
                LEFT JOIN " . $this->db->dbprefix . "product_descriptions pd 
                ON p.product_id=pd.product_id 
                LEFT JOIN " . $this->db->dbprefix . "product_prices pc
                ON p.product_id=pc.product_id
                 LEFT JOIN " . $this->db->dbprefix . "image pi
                 ON p.product_id=pi.product_id    
                WHERE 1 AND ";
            foreach ($conditions as $con) {
                $query.= $con . ' ';
            };
            $query.=' GROUP BY p.product_id ';
            if ($orderBy) {
                if ($orderBy == 'product_id')
                    $orderBy = 'p.product_id';
                $query.=' ORDER BY ' . $orderBy . ' ' . $orderName;
            }
            $query.=' LIMIT ' . $offset . ',' . $limit;
            $results = $this->db->query($query);
            $totalquery = $this->db->query('SELECT FOUND_ROWS() as total;');
            $row = $totalquery->row();
            $totalProduct = $row->total;
            // $totalProduct = $results->num_rows();
            $start = min(1, $totalProduct);
            $end = min($limit, $totalProduct);
            $result = array('products' => $results->result_object(),
                'total' => $totalProduct,
                'start' => $start,
                'end' => $end);
            return $result;
        }
    }

    public function hook_after_add() {
        $this->add_product_to_category($this->id_product, $this->id_category);
        $this->updateTotalProducts();
    }

    private function add_product_to_category($id_product, $id_category) {
        $data = array(
            'product_id' => $id_product,
            'category_id' => $id_category,
            'link_type' => 'M',
            'poisiton' => 0
        );
        return $this->db->insert('' . $this->db->dbprefix . 'products_categories', $data);
    }

    private function updateTotalProducts() {
        //    return $this->db->
    }

    public function delete_product() {

        return ($this->remove());
    }

    public function remove() {

        $this->db->delete('products_categories', array('product_id' => $this->product_id));
        $this->db->query(('delete t1,t2,t3,t4 
                                from ' . $this->db->dbprefix . 'product_options t1
                                inner ' . $this->db->dbprefix . 'product_options_descriptions t2 on t1.option_id=t2.option_id
                                inner ' . $this->db->dbprefix . 'product_option_variants t3 on t1.option_id=t3.option_id 
                                left join ' . $this->db->dbprefix . 'product_option_variants_descriptions t4 on t4.variant_id=t3.variant_id           
                                and t1.product_id=' . $this->db->escape(intval($this->product_id))));

        $this->db->query('delete t1 
                              from ' . $this->db->dbprefix . 'product_descriptions t1
                                                          where t1.product_id=' . $this->db->escape(intval($this->product_id))
        );
        $this->db->query('delete t1 
                              from ' . $this->db->dbprefix . 'product_prices t1
                                                          where t1.product_id=' . $this->db->escape(intval($this->product_id))
        );
        $this->delete_image();
        if (parent::remove())
            return true;

        return false;
    }

    private function delete_image() {
        $this->load->smc_model('Image_model');
        //unlink image
        $query = ($this->db->select('id_image,product_id')
                        ->from('image')
                        ->where('product_id', intval($this->product_id))->get());

        $images = $query->result_object();

        if (count($images)) {
            foreach ($images as $val) {
                $types = Image_model::getImageType();
                $ImageDir = APPPATH . '../global/img/p/';
                if (is_array($types)) {
                    foreach ($types as $type) {
                        $filename = $val->product_id . '-' . $val->id_image . '-' . $type->name . '.jpg';
                        if (file_exists($ImageDir . $filename)) {
                            @unlink($ImageDir . $filename);
                        }
                    }
                }
                $this->db->delete('image', array('id_image' => $val->id_image));
            }
        }
    }

    private function get_image($product_id = 0) {
    	
        $this->db->select('id_image');
       $this->db->from('image');
       
       $this->db->where('product_id', $product_id);
     
       $query=$this->db->get();    
        
     
    	$result="";
        if($query->row()){
            $result= $query->row()->id_image;
            $query->free_result();
        }
        log_message("debug",$result);
        
        return $result;
    }

}