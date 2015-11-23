<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_Users
{
	protected $ci;
	protected $Routes_model;
	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->model(array('Routes_model'));
		$this->ci->load->library('Ion_auth');
		$this->Routes_model=$this->ci->Routes_model;
	
		Events::register('user_updated', array($this, 'run_update'));
		Events::register('post_user_register', array($this, 'run_created'));
	}
	public function run_created($id){

		if(empty($id)){
			return;
		}
		
		
		$user=(array)$this->ci->ion_auth->get_user(intval($id));
		
		if(empty($user))
			return;
		$data=array('code'=>uniqid(),
				'bank_name'=>$this->ci->input->post('bank_name'),
				'bank_branch_number'=>$this->ci->input->post('bank_branch_number'),
				'bank_swift_code'=>$this->ci->input->post('bank_swift_code'),
				'bank_account_name'=>$this->ci->input->post('bank_account_name'),
				'bank_account_number'=>$this->ci->input->post('bank_account_number')
				
				
		);
		
	
		return	$this->ci->db->where('id',$id)->update('users',$data);
		
		
		
	}
	
	public function run_update($id)
	{
		if(empty($id)){
			return;
		}

		
		$user=$this->ci->ion_auth->get_user(intval($id));

		if(empty($user))
			return;
		$slug=$user->username;

			if (! $this->Routes_model->check_routes_by_oid ( $id,'user' )) {
				$route ['keyword'] = 'home/'.$slug;
				$route ['entity'] = 'user';
				$route['query']='home/user/'.$id;
				$route['oid']=$id;
				$route_id = $this->Routes_model->save ( $route );
			}else{
				// get
				$url_alias_id=$this->Routes_model->get_slug_id($id,'user');
				$route['url_alias_id']=$url_alias_id;
				$route ['keyword'] = 'home/'.$slug;
				$route ['entity'] = 'user';
				$route['query']='home/user/'.$id;
				$route['oid']=$id;
				$route_id = $this->Routes_model->save ( $route );
			}
		
		
			$data=array(
					'bank_name'=>$this->ci->input->post('bank_name'),
					'bank_branch_number'=>$this->ci->input->post('bank_branch_number'),
					'bank_swift_code'=>$this->ci->input->post('bank_swift_code'),
					'bank_account_name'=>$this->ci->input->post('bank_account_name'),
					'bank_account_number'=>$this->ci->input->post('bank_account_number')
			
			
			);
		return ;
	}

}
/* End of file events.php */