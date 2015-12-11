<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Theme_Tshirt extends Theme {

    public $name			= 'Tshirt';
    public $author			= 'tshirt Dev Team';
    public $author_website	= 'http://tshirt.com/';
    public $website			= 'http://tshirt.com/';
    public $description		= 'tshirt admin theme. HTML5 and CSS3 styling.';
    public $version			= '1.0.0';
	//public $type			= 'admin';
	public $options 		= array();
	
	public $group="";
	/**
	 * Run() is triggered when the theme is loaded for use
	 *
	 * This should contain the main logic for the theme.
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct(){
		$this->load->config('tdesign');
		$this->load->helper('formatting');
		$currentUser=($this->current_user) ?$this->current_user :"";
		
		if(($currentUser)){
			
			$this->group=$currentUser->group;
		}
		
	}
	public function run()
	{
		// only load these items on the dashboard
		if ($this->module == '' && $this->method != 'login' && $this->method != 'help')
		{
		
			$data=array();
			switch ($this->group){
				case "admin" :
					
					$data['orders']=$this->notice_order();
					$data['arts']=$this->notice_art();
					$data['latest_order']=$this->get_lastest_order();
					break;
				case "sale" :
					$data['orders']=self::notice_order();
					$data['latest_order']=$this->get_lastest_order();
					break;
				case "manufacturer" :
					$data['orders']=self::notice_order();
					break;
			}
		
			$this->template->set($data);
		}
	}
	
	private function notice_order(){
		$this->load->model('order_model');
		
		
		$orders=$this->order_model->analys_order();
		
	
		return $orders;
	}
	private function get_lastest_order(){
		$this->load->model('order_model');
		if($this->group=='admin' || $this->group=="sale"){
			$data['term']['group_status']=array(ORDER_STATUS_NO_PROCESS,ORDER_STATUS_MANUFACTORING);
		}elseif($this->group=="manufacturer"  ){
			$data['term']['group_status']=array(ORDER_STATUS_MANUFACTORING);
		}else{
			return null;
		}
		
		return $this->order_model->get_orders($data,'ordered_on','desc',0,6);
	}
	
	private function notice_art(){
		$this->load->model('art_model');
		return $this->art_model->analys_arts();
		
	}
	
	
}

/* End of file theme.php */