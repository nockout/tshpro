<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Blog module controller
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog\Controllers
 */
class Designs extends Public_Controller
{
	
	/**
	 * Every time this controller is called should:
	
	 */
	public function __construct()
	{
		parent::__construct();
		
	}


	public function index() {
	
		if (isset ( $this->current_user->id )) {
			$this->view ( $this->current_user->id );
		} else {
			redirect ( 'users/login/users' );
		}
	}
	
	private function view($username = null){
		switch (Settings::get('profile_visibility'))
		{
			case 'public':
				// if it's public then we don't care about anything
				break;
		
			case 'owner':
				// they have to be logged in so we know if they're the owner
				$this->current_user or redirect('users/login/users/view/'.$username);
		
				// do we have a match?
				$this->current_user->username !== $udsername and redirect('404');
				break;
		
			case 'hidden':
				// if it's hidden then nobody gets it
				redirect('404');
				break;
		
			case 'member':
				// anybody can see it if they're logged in
				$this->current_user or redirect('users/login/users/view/'.$username);
				break;
		}
		
		// Don't make a 2nd db call if the user profile is the same as the logged in user
		if ($this->current_user && $username === $this->current_user->username)
		{
			$user = $this->current_user;
		}
		// Fine, just grab the user from the DB
		else
		{
			$user = $this->ion_auth->get_user($username);
		}
		
		// No user? Show a 404 error
		$user or show_404();
		return;
		
	}

	public function create(){
		if (isset ( $this->current_user->id )) {
			$this->view ( $this->current_user->id );
		} else {
			redirect ( 'users/login/users' );
		}
	
		$this->template->append_js(array(
				"module::custom/fabric.js",
				/* "module::custom/caseEditor.js", */
				"module::custom/tshirtEditor.js",
				"module::custom/jquery.miniColors.min.js",
				
				//"module::fancy_design/app.js"
		));
		
		$this->template->append_css(array(
				"module::bootstrap/jquery.miniColors.css",
				"module::bootstrap/jquery.simplecolorpicker.css",
				
		
		));
		$this->template->build('create', array(
				/* '_user' => $user, */
		));
	}

}
