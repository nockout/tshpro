<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Users Module
 *
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Users
 */
class Module_Customer extends Module {

	public $version = '1.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Customer design',
				'vi' => 'khách hàng'
			),
			'description' => array(
				'en' => 'Let users register and log in to the site, and manage them via home page.',
				
				'se' => 'Låt dina besökare registrera sig och logga in på webbplatsen. Hantera sedan användarna via kontrollpanelen.'
			),
			'frontend' 	=> true,
			'backend'  	=> false,
			'menu'	  	=> false,
			'roles'		=> array('admin_profile_fields')
			);

		if (function_exists('group_has_role'))
		{
			if(group_has_role('users', 'admin_profile_fields'))
			{
				$info['sections'] = array(
					'users' => array(
							'name' 	=> 'user:list_title',
							'uri' 	=> 'admin/users',
								'shortcuts' => array(
									'create' => array(
										'name' 	=> 'user:add_title',
										'uri' 	=> 'admin/users/create',
										'class' => 'add'
										)
									)
								),
					'fields' => array(
							'name' 	=> 'user:profile_fields_label',
							'uri' 	=> 'admin/users/fields',
								'shortcuts' => array(
									'create' => array(
										'name' 	=> 'user:add_field',
										'uri' 	=> 'admin/users/fields/create',
										'class' => 'add'
										)
									)
								)
						);
			}
		}

		return $info;
	}

	public function admin_menu(&$menu)
	{ 
		//$this->lang->load('design');
		$menu['lang:cp:nav_users']['lang:cp:nav_users'] = 'admin/users';
	}

	/**
	 * Installation logic
	 *
	 * This is handled by the installer only so that a default user can be created.
	 *
	 * @return boolean
	 */
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