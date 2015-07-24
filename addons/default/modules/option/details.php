<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Addons Module
 *
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Modules
 */
class Module_Option extends Module
{
	public $version = '1.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Option',
				'vi' => 'Option',
			),
			'description' => array(
				'en' => 'Option',
				'vi' => 'Option',
			),
			'frontend' => false,
			'backend' => true,
			'menu' => false,

// 			'sections' => array(
// 				'design' => array(
// 					'name' => 'design:create',
// 					'uri' => 'admin/tdesign/create',
// 				),
// 				'management' => array(
// 					'name' => 'design:manage',
// 					'uri' => 'admin/tdesign/management',
// 				),
				
// 			),
		);
	
		// Add upload options to various modules
	

		return $info;
	}

	public function admin_menu(&$menu)
	{
		
		$menu['lang:cp:nav_option'] = array(
			'lang:cp:nav_option'=> 'admin/option/',
			
		);
		//echo "<pre>";
		//print_r($menu);die;
		add_admin_menu_place('lang:cp:nav_option', 2);
	}

	public function install()
	{
		return true;
	
	}

	public function uninstall()
	{
		// This is a core module, lets keep it around.
		return true;
	}

	public function upgrade($old_version)
	{
		return true;
	}

}
