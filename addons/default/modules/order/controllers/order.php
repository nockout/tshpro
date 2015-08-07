<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Blog module controller
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog\Controllers
 */
class Order extends Admin_Controller
{
	
	/**
	 * Every time this controller is called should:
	
	 */
	public function __construct()
	{
		parent::__construct();
		
	}


	public function index()
	{
		$this->template
		->title($this->module_details['name'])
// 		->set_breadcrumb(lang('blog:blog_title'))
// 		->set_metadata('og:title', $this->module_details['name'], 'og')
// 		->set_metadata('og:type', 'blog', 'og')
// 		->set_metadata('og:url', current_url(), 'og')
// 		->set_metadata('og:description', $meta['description'], 'og')
// 		->set_metadata('description', $meta['description'])
// 		->set_metadata('keywords', $meta['keywords'])
// 		->set_stream($this->stream->stream_slug, $this->stream->stream_namespace)
// 		->set('posts', $posts['entries'])
// 		->set('pagination', $posts['pagination'])
		->build('home');
	}


	
	public function category($slug = '')
	{
		
	}
	public function action(){
		
	}

}
