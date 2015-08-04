<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Blog module
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog
 */
class Module_Cart extends Module
{
	public $version = '2.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Gio hang',
				'vi' => 'Gio hang'
			),
			'description' => array(
				'en' => 'Order',
				'vi' => 'Gio hang '
			),
			'frontend' => true,
			'backend' => false,
			'skip_xss' => true,
			
		);

	

		return $info;
	}

	public function install()
	{
		return true;
		
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
