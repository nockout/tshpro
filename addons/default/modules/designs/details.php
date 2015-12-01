<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Addons Module
 *
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Modules
 */
class Module_Designs extends Module
{
	public $version = '1.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Designs',
				'vi' => 'Designs',
			),
			'description' => array(
				'en' => 'Allows Artis create and manage Design.',
				'vi' => 'Cho phép Artis  tạo và quản lý các bản thiết kế',
			),
			'frontend' 	=> false,
			'backend'  	=> true,
			
			'menu' => false,


		);
	
		// Add upload options to various modules
	

		return $info;
	}

	public function admin_menu(&$menu)
	{

		
		$menu['lang:cp:nav_design']['lang:cp:nav_design_create'] = array(
				'lang:design:create'=> 'designs/create',
				
		);
		add_admin_menu_place('lang:cp:nav_design', 1);
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
