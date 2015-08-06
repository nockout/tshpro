<?php if ($this->go_cart->total_items()==0):?>
    <div class="alert alert-info">
        <a class="close" data-dismiss="alert">×</a>
        <?php echo lang('empty_view_cart');?>
    </div>
<?php else: ?>
    <div class="container" style="padding-top:10px;">
    <div class="page-header">
        <h2><?php echo lang('your_cart');?></h2>
    </div>
      <div class="row">
   		 <?php echo form_open('cart/update_cart', array('id'=>'update_cart_form'));?>
      		<div class="col-md-12" >
   		 <?php include('checkout/summary.php');?>
            
        

                <a class="btn btn-large btn-primary" href="home" /><?php echo lang("cart:continue_shipping")?></a>
                <input id="redirect_path" type="hidden" name="redirect" value=""/>
    

                <input class="btn btn-large btn-primary" type="submit" onclick="$('#redirect_path').val('cart/checkout');" value="<?php echo lang('form_checkout');?>"/>
       
            
    		<?php echo form_close()?>
	
      			  </div>
      
	</div>
	
	
	
	

<div class="row"></div>


</div>
<?php endif; ?>
