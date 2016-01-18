<?php defined('BASEPATH') OR exit('No direct script access allowed');


function get_image_path_temp($file_name){
	$CI=&get_instance();
	$CI->load->config("tdesign");
	return sprintf("%s/%s",$CI->config->item("tdesign_upload_path_temp"),$file_name);
}
function get_design_image_path($folder=null,$file=""){
	if(!$folder&&$file)
		return ;
	$CI=&get_instance();
	$CI->load->config("tdesign");
	return sprintf("%s%s/%s",$CI->config->item("tdesign_image_url"),$folder,$file);
}
function resize_image($sourcePath, $desPath,$width=480,$height=480){
	if(empty($sourcePath) || empty($desPath) )
		return false;
	$CI=&get_instance();

	$CI->load->library ( 'image_lib' );
	$config ['image_library'] = 'gd2';
	$config ['source_image'] = $sourcePath;

	$config ['new_image'] =$desPath;
	$config ['create_thumb'] = TRUE;
	$config ['maintain_ratio'] = TRUE;
	$config ['quality'] = 100;
	$config ['width'] =$width;
	$config ['height'] =$height;
	$CI->load->library ( 'image_lib', $config );
	$CI->image_lib->initialize ( $config );
	$config ['create_thumb'] = TRUE;
	$config ['thumb_marker'] = '';
	
	$CI->image_lib->initialize ( $config );
	
	if ($CI->image_lib->image_process_gd ()) {
		return true;
	}
	return false;
}

function panagition($url, $segment = 3, $total, $offset, $rows = 10) {
    $CI = &get_instance();
    $CI->load->library('pagination');
    //  $this->load->library('pagination');

    if (!$total)
        return;
    $config['base_url'] = $url;
    $config['total_rows'] = $total;
    $config['per_page'] = $rows;
    $config['uri_segment'] = $segment;
    $config['cur_page'] = $offset;
    //   $config['page_query_string'] = TRUE;
    // $config['use_page_numbers']=TRUE;
  

    $config['full_tag_open'] = '<div class="paginate"><div class="pagination">
    		<ul class="">';
    $config['full_tag_close'] = '</ul></div></div>';
   

    $CI->pagination->initialize($config);

    return  $CI->pagination->create_links();
}
function unique_tracking_id(){
	return uniqid();
}
function product_url_rewrite($slug="",$id=null){
	
	return ($slug&&$id)?sprintf("?q=%s-%s",$slug,$id):$slug;

}