<?php
class Cart extends Public_Controller {
	public function  __construct (){
		parent::__construct();
		$this->load->helper("currency");
		$this->load->config('tdesign/tdesign');
		$this->load->helper('tdesign');
		$this->load->helper('formatting');
		$this->lang->load(array('common',"cart"));
		
	}
	function index()
	{
		echo "<pre>";
		print_r($this->go_cart->contents());
		die;
		//$this->template->set("test","test");
	//	$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		//$data['homepage']			= true;

	//	$this->temmplate->build('homepage', $data);
	}
	
	function ajax_del_items(){
		$item_id=$this->input->post("item_id");
		
		if($item_id){
			
			($this->go_cart->_remove($item_id));
			($this->go_cart->_save_cart());
			die("delete sucess");
			
		}
		die;
		
	}
	function get_shipping_fee(){
		if($this->input->is_ajax_request()){
			///$this->go_cart->clear_shipping();
			$zoneid=$this->input->get('zone');
			$this->load->model(array('location_model','Settings_model'));
			$gc_setting = $this->Settings_model->get_settings('gocart');
			$quantiyFreeship=!empty($gc_setting['free_shipping_flag'])?intval($gc_setting['free_shipping_flag']):0;
			$totalItems= $this->go_cart->total_items();
			
			
			// update shipping fee
			$this->go_cart->total_items();
			
			
			if($totalItems>=$quantiyFreeship){
				$shipping=0;
			}else{
				
				$ship_zone=$this->location_model->zone_information(intval($zoneid));
				$shipping=!empty($ship_zone)?floatval($ship_zone->price):0;
			}

			$total=format_price($this->go_cart->total()+$shipping);
			$shipping=(format_price($shipping));
			die(json_encode(array("s"=>$shipping,"t"=>$total)));
		}
	}
	function setSize(){
		if($size=$this->input->post("size")){
			$this->session->set_userdata("size",$size);
		}
	}
	function ajax_add_to_cart(){
		// Get our inputs
		//$this->go_cart->destroy(false);
	
		$product_id		= $this->input->post('id');
		$quantity 		= ( $this->input->post('quantity') && (intval($this->input->post('quantity')>0) )) ? $this->input->post('quantity') :1;
		$size 	= $this->input->post('sizeSelected');
		
		if($size){
			$this->session-> set_userdata("sizeSelected",$size);
		}
		$this->load->model('product_model');
		
		// Get a cart-ready product array
		$product="";
		
		//if out of stock purchase is disabled, check to make sure there is inventory to support the cart.
		
			//$stock	= $this->product_model->get($product_id);
				
			//loop through the products in the cart and make sure we don't have this in there already. If we do get those quantities as well
			$items		= $this->go_cart->contents();
			$qty_count	= $quantity;
			$is_exist=false;
			if(!empty($items)){
				foreach($items as &$item)
				{
				
					if((intval($item['id']) == intval($product_id))&&$item['sizeSelected']==$size)
					{
					
						$item ['quantity']= intval($qty_count) + $item['quantity'];
						$is_exist=true;
					}
				}
				$this->go_cart->_cart_contents['items']=$items;
				$this->go_cart->_save_cart(true);
				//$this->go_cart->update_cart($product['cartkey'],$product['quantity']);
				//$this->go_cart->_save_cart(true);
			}
			if(!($is_exist)){
				$product =(array) $this->product_model->get(intval($product_id));
				
				if(empty($product))
					die("no product found");
				$product['id']=$product['product_id'];
				$product['sizeSelected']=	$size;
				$product['quantity']=$quantity;
				$this->go_cart->insert(array($product));
			}
			
			
			
			$html=$this->load->view("cart_items",array("items"=>$this->go_cart->contents()),true);
			
			die($this->go_cart->total_items());

	}

	function jsonpp($json, $istr='  ')
	{
		$q = FALSE;
		$result = '';
		for($p=$i=0; isset($json[$p]); $p++)
		{
			if($json[$p] == '"' && ($p>0?$json[$p-1]:'') != '\\')
			{
				$q=!$q;
			}
			else if(in_array($json[$p], array('}', ']')) && !$q)
			{
				$result .= "\n".str_repeat($istr, --$i);
			}
			$result .= $json[$p];
			if(in_array($json[$p], array(',', '{', '[')) && !$q)
			{
				$i += in_array($json[$p], array('{', '['));
				$result .= "\n".str_repeat($istr, $i);
			}
		}
		return $result;
	}
	function add_to_cart()
	{
		// Get our inputs
		$product_id		= $this->input->post('id');
		$quantity 		= $this->input->post('quantity');
		$post_options 	= $this->input->post('option');

		// Get a cart-ready product array
		$product = $this->Product_model->get_cart_ready_product($product_id, $quantity);

		//if out of stock purchase is disabled, check to make sure there is inventory to support the cart.
		if(!$this->config->item('allow_os_purchase') && (bool)$product['track_stock'])
		{
			$stock	= $this->Product_model->get_product($product_id);
				
			//loop through the products in the cart and make sure we don't have this in there already. If we do get those quantities as well
			$items		= $this->go_cart->contents();
			$qty_count	= $quantity;
			foreach($items as $item)
			{
				if(intval($item['id']) == intval($product_id))
				{
					$qty_count = $qty_count + $item['quantity'];
				}
			}
				
			if($stock->quantity < $qty_count)
			{
				//we don't have this much in stock
				$this->session->set_flashdata('error', sprintf(lang('not_enough_stock'), $stock->name, $stock->quantity));
				$this->session->set_flashdata('quantity', $quantity);
				$this->session->set_flashdata('option_values', $post_options);

				redirect($this->Product_model->get_slug($product_id));
			}
		}

		// Validate Options
		// this returns a status array, with product item array automatically modified and options added
		//  Warning: this method receives the product by reference
		$status = $this->Option_model->validate_product_options($product, $post_options);

		// don't add the product if we are missing required option values
		if( ! $status['validated'])
		{
			$this->session->set_flashdata('quantity', $quantity);
			$this->session->set_flashdata('error', $status['message']);
			$this->session->set_flashdata('option_values', $post_options);

			redirect($this->Product_model->get_slug($product_id));

		} else {

			//Add the original option vars to the array so we can edit it later
			$product['post_options']	= $post_options;
				
			//is giftcard
			$product['is_gc']			= false;
				
			// Add the product item to the cart, also updates coupon discounts automatically
			$this->go_cart->insert($product);

			// go go gadget cart!
			redirect('cart/view_cart');
		}
	}

	function view_cart()
	{

		$data['page_title']	= 'View Cart';
		//$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		
		$this->template->set( $data);
		$this->template->build('view_cart');
	}

	function remove_item($key)
	{
		//drop quantity to 0
		$this->go_cart->update_cart(array($key=>0));

		redirect('cart/view_cart');
	}

	function thank_you(){
		
		
		$id=$this->session->flashdata('last_order_id');
		
		$this->load->model('order_m');
		$order=$this->order_m->get_order_by_code($id);
		
		
	
		$data=array(
			'order'=>$order,
			'items'=>!empty($order->items)?$order->items:""
		);
		$this->template->build('thank_you',
				$data);
	}
	function update_cart($redirect = false)
	{
		//if redirect isn't provided in the URL check for it in a form field
		if(!$redirect)
		{
			$redirect = $this->input->post('redirect');
		}

		// see if we have an update for the cart
		$item_keys		= $this->input->post('cartkey');
		$coupon_code	= $this->input->post('coupon_code');
		$gc_code		= $this->input->post('gc_code');

		if($coupon_code)
		{
			$coupon_code = strtolower($coupon_code);
		}
			
		//get the items in the cart and test their quantities
		$items			= $this->go_cart->contents();
		$new_key_list	= array();
		//first find out if we're deleting any products
		foreach($item_keys as $key=>$quantity)
		{
			if(intval($quantity) === 0)
			{
				//this item is being removed we can remove it before processing quantities.
				//this will ensure that any items out of order will not throw errors based on the incorrect values of another item in the cart
				$this->go_cart->update_cart(array($key=>$quantity));
			}
			else
			{
				//create a new list of relevant items
				$new_key_list[$key]	= $quantity;
			}
		}
		$response	= array();
		foreach($new_key_list as $key=>$quantity)
		{
			$product	= $this->go_cart->item($key);
			//if out of stock purchase is disabled, check to make sure there is inventory to support the cart.
			if(!$this->config->item('allow_os_purchase') && (bool)$product['track_stock'])
			{
				$stock	= $this->Product_model->get_product($product['id']);
					
				//loop through the new quantities and tabluate any products with the same product id
				$qty_count	= $quantity;
				foreach($new_key_list as $item_key=>$item_quantity)
				{
					if($key != $item_key)
					{
						$item	= $this->go_cart->item($item_key);
						//look for other instances of the same product (this can occur if they have different options) and tabulate the total quantity
						if($item['id'] == $stock->id)
						{
							$qty_count = $qty_count + $item_quantity;
						}
					}
				}
				if($stock->quantity < $qty_count)
				{
					if(isset($response['error']))
					{
						$response['error'] .= '<p>'.sprintf(lang('not_enough_stock'), $stock->name, $stock->quantity).'</p>';
					}
					else
					{
						$response['error'] = '<p>'.sprintf(lang('not_enough_stock'), $stock->name, $stock->quantity).'</p>';
					}
				}
				else
				{
					//this one works, we can update it!
					//don't update the coupons yet
					$this->go_cart->update_cart(array($key=>$quantity));
				}
			}
			else
			{
				$this->go_cart->update_cart(array($key=>$quantity));
			}
		}

		//if we don't have a quantity error, run the update
		if(!isset($response['error']))
		{
			//update the coupons and gift card code
			$response = $this->go_cart->update_cart(false, $coupon_code, $gc_code);
			// set any messages that need to be displayed
		}
		else
		{
			$response['error'] = '<p>'.lang('error_updating_cart').'</p>'.$response['error'];
		}


		//check for errors again, there could have been a new error from the update cart function
		if(isset($response['error']))
		{
			$this->session->set_flashdata('error', $response['error']);
		}
		if(isset($response['message']))
		{
			$this->session->set_flashdata('message', $response['message']);
		}

		if($redirect)
		{
			redirect($redirect);
		}
		else
		{
			redirect('cart/view_cart');
		}
	}


	/***********************************************************
	 Gift Cards
	 - this function handles adding gift cards to the cart
	 ***********************************************************/
	function ajax_cart_items(){
	
		
		die($this->load->view("cart_items",array("items"=>$this->go_cart->contents()),true));
	}
	
	function giftcard()
	{
		if(!$this->gift_cards_enabled) redirect('/');

		// Load giftcard settings
		$gc_settings = $this->Settings_model->get_settings("gift_cards");

		$this->load->library('form_validation');

		$data['allow_custom_amount']	= (bool) $gc_settings['allow_custom_amount'];
		$data['preset_values']			= explode(",",$gc_settings['predefined_card_amounts']);

		if($data['allow_custom_amount'])
		{
			$this->form_validation->set_rules('custom_amount', 'lang:custom_amount', 'numeric');
		}

		$this->form_validation->set_rules('amount', 'lang:amount', 'required');
		$this->form_validation->set_rules('preset_amount', 'lang:preset_amount', 'numeric');
		$this->form_validation->set_rules('gc_to_name', 'lang:recipient_name', 'trim|required');
		$this->form_validation->set_rules('gc_to_email', 'lang:recipient_email', 'trim|required|valid_email');
		$this->form_validation->set_rules('gc_from', 'lang:sender_email', 'trim|required');
		$this->form_validation->set_rules('message', 'lang:custom_greeting', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['error']				= validation_errors();
			$data['page_title']			= lang('giftcard');
			$data['gift_cards_enabled']	= $this->gift_cards_enabled;
			$this->view('giftcards', $data);
		}
		else
		{
				
			// add to cart
				
			$card['price'] = set_value(set_value('amount'));
				
			$card['id']				= -1; // just a placeholder
			$card['sku']			= lang('giftcard');
			$card['base_price']		= $card['price']; // price gets modified by options, show the baseline still...
			$card['name']			= lang('giftcard');
			$card['code']			= generate_code(); // from the string helper
			$card['excerpt']		= sprintf(lang('giftcard_excerpt'), set_value('gc_to_name'));
			$card['weight']			= 0;
			$card['quantity']		= 1;
			$card['shippable']		= false;
			$card['taxable']		= 0;
			$card['fixed_quantity'] = true;
			$card['is_gc']			= true; // !Important
			$card['track_stock']	= false; // !Imporortant
				
			$card['gc_info'] = array("to_name"	=> set_value('gc_to_name'),
					"to_email"	=> set_value('gc_to_email'),
					"from"		=> set_value('gc_from'),
					"personal_message"	=> set_value('message')
			);
				
			// add the card data like a product
			$this->go_cart->insert($card);
				
			redirect('cart/view_cart');
		}
	}
}
?>