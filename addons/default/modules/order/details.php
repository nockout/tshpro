<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Blog module
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog
 */
class Module_Order extends Module
{
	public $version = '2.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Order',
				'vi' => 'Đơn hàng'
			),
			'description' => array(
				'en' => 'Order',
				'vi' => 'Đơn hàng '
			),
			'frontend' => true,
			'backend' => true,
			'skip_xss' => true,
			
		);

	

		return $info;
	}

	public function install()
	{
		return true;
		
	}

	public function admin_menu(&$menu)
	{
	
		$menu['lang:cp:nav_order'] = array(
				'lang:cp:nav_order'=> 'admin/order/',
					
		);
	
		add_admin_menu_place('lang:cp:nav_order', 2);
	}
	
	public function uninstall()
	{
		// This is a core module, lets keep it around.
		return false;
	}

	public function upgrade($old_version)
	{
		return true;
	}
}
