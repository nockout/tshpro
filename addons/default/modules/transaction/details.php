<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Blog module
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog
 */
class Module_Transaction extends Module
{
	public $version = '1.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Transaction',
				'vi' => 'Giao dịch'
			),
			'description' => array(
				'en' => 'Transaction',
				'vi' => 'Giao dịch'
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
	
		$menu['lang:cp:nav_transaction'] = array(
				'lang:cp:nav_transaction'=> 'admin/transaction/',
					
		);
	
		add_admin_menu_place('lang:cp:nav_transaction', 3);
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
