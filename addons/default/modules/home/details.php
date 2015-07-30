<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Blog module
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog
 */
class Module_Home extends Module
{
	public $version = '2.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Home',
				'vi' => 'Trang chủ'
			),
			'description' => array(
				'en' => 'Home',
				'vi' => 'Trang chủ '
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
