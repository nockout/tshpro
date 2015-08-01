<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Addons Module
 *
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Modules
 */
class Module_TDesign extends Module
{
	public $version = '2.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Design',
				'vi' => 'Design',
			),
			'description' => array(
				'en' => 'Allows user create and manage Design.',
				'vi' => 'Cho phép người dùng tạo và quản lý bản mẫu',
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

		$menu['lang:cp:nav_design']['lang:cp:nav_design_create'] = array(
				'lang:design:create'=> 'admin/tdesign/create_design',
				//'lang:design:management'=> 'admin/tdesign/'
		);

		$menu['lang:cp:nav_design']['lang:cp:nav_design_management'] = array(
				//'lang:design:create'=> 'admin/tdesign/create_design',
				'lang:design:management'=> 'admin/tdesign/manage/arts'
		);
		//echo "<pre>";
		//print_r($menu);die;
		add_admin_menu_place('lang:cp:nav_design', 1);
	}

	public function install()
	{
		return true;
		$this->dbforge->drop_table('theme_options');

		$tables = array(
			'theme_options' => array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true),
				'slug' => array('type' => 'VARCHAR', 'constraint' => 30),
				'title' => array('type' => 'VARCHAR', 'constraint' => 100),
				'description' => array('type' => 'TEXT', 'constraint' => 100),
				'type' => array('type' => 'set', 'constraint' => array('text', 'textarea', 'password', 'select', 'select-multiple', 'radio', 'checkbox', 'colour-picker')),
				'default' => array('type' => 'VARCHAR', 'constraint' => 255),
				'value' => array('type' => 'VARCHAR', 'constraint' => 255),
				'options' => array('type' => 'TEXT'),
				'is_required' => array('type' => 'INT', 'constraint' => 1),
				'theme' => array('type' => 'VARCHAR', 'constraint' => 50),
			),
		);

		if ( ! $this->install_tables($tables)) {
			return false;
		}

		// Install settings
		$settings = array(
			array(
				'slug' => 'addons_upload',
				'title' => 'Addons Upload Permissions',
				'description' => 'Keeps mere admins from uploading addons by default',
				'type' => 'text',
				'default' => '0',
				'value' => '0',
				'options' => '',
				'is_required' => 1,
				'is_gui' => 0,
				'module' => '',
				'order' => 0,
			),
			array(
				'slug' => 'default_theme',
				'title' => 'Default Theme',
				'description' => 'Select the theme you want users to see by default.',
				'type' => '',
				'default' => 'default',
				'value' => 'default',
				'options' => 'func:get_themes',
				'is_required' => 1,
				'is_gui' => 0,
				'module' => '',
				'order' => 0,
			),
			array(
				'slug' => 'admin_theme',
				'title' => 'Control Panel Theme',
				'description' => 'Select the theme for the control panel.',
				'type' => '',
				'default' => '',
				'value' => 'pyrocms',
				'options' => 'func:get_themes',
				'is_required' => 1,
				'is_gui' => 0,
				'module' => '',
				'order' => 0,
			),
		);

		foreach ($settings as $setting)
		{
			if ( ! $this->db->insert('settings', $setting))
			{
				return false;
			}
		}

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
