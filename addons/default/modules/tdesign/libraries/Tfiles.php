<?php defined('BASEPATH') OR exit('No direct script access allowed');
require 	APPPATH.'modules/files/libraries/Files.php';
class Tfiles extends Files
{
	public function __construct()
	{
		parent::__construct();
	}
	public static function get_files($location = 'local', $container = '')
	{
		$results = ci()->file_m->select('files.*, file_folders.name folder_name, file_folders.slug folder_slug')
			->join('file_folders', 'file_folders.id = files.folder_id')
			->where('location', $location)
			->where('slug', $container)
			->order_by("alt_attribute")
			->get_all();
		
		$message = $results ? null : lang('files:no_records_found');

		return self::result( (bool) $results, $message, null, $results);
	}
}