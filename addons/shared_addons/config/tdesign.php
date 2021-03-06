<?php
$config ['allowed_types_template'] = 'gif|jpg|png';
$config ['max_size_template_file'] = 5000;
$config ['min_width_template_file'] = 480;
$config ['min_height_template_file'] = 480;
$config ['tdesign_upload_path_folder']=UPLOAD_PATH.'../design/temp';
$config ['tdesign_upload_path_temp']=BASE_URL.'/uploads/design/temp';
$config ['tdesign_image_url']=BASE_URL.'uploads/design/';
$config ['locate_upload_path']='uploads/design/';

$config ['tdesign_template_img_resize_width']=480;
$config ['tdesign_template_img_resize_height']=480;

$config ['admin_folder']='admin';
$config ['DEFAULT_LANG']='en';

$config['template_extension']='.png';


define('ORDER_STATUS_NO_PROCESS', 0);
define('ORDER_STATUS_MANUFACTORING', 1);
define('ORDER_STATUS_PROCEED', 2);
define('ORDER_STATUS_CANCEL', 3);
define('ORDER_STATUS_CLOSED', 4);


define('MAX_TEMPLATE_HEIGHT',620);