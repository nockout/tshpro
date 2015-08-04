
<div class="container">
<?php




//form elements

$company	= array('placeholder'=>lang('address_company'),'class'=>'address form-control', 'name'=>'company', 'value'=> set_value('company', @$customer[$address_form_prefix.'_address']['company']));
$address1	= array('placeholder'=>lang('address1'), 'class'=>'address form-control', 'name'=>'address1', 'value'=> set_value('address1', @$customer[$address_form_prefix.'_address']['address1']));
$address2	= array('placeholder'=>lang('address2'), 'class'=>'address form-control', 'name'=>'address2', 'value'=>  set_value('address2', @$customer[$address_form_prefix.'_address']['address2']));
$first		= array('placeholder'=>lang('address_firstname'), 'class'=>'address form-control', 'name'=>'firstname', 'value'=>  set_value('firstname', @$customer[$address_form_prefix.'_address']['firstname']));
$last		= array('placeholder'=>lang('address_lastname'), 'class'=>'address form-control', 'name'=>'lastname', 'value'=>  set_value('lastname', @$customer[$address_form_prefix.'_address']['lastname']));
$email		= array('placeholder'=>lang('address_email'), 'class'=>'address form-control', 'name'=>'email', 'value'=> set_value('email', @$customer[$address_form_prefix.'_address']['email']));
$phone		= array('placeholder'=>lang('address_phone'), 'class'=>'address form-control', 'name'=>'phone', 'value'=> set_value('phone', @$customer[$address_form_prefix.'_address']['phone']));
$city		= array('placeholder'=>lang('address_city'), 'class'=>'address form-control', 'name'=>'city', 'value'=> set_value('city', @$customer[$address_form_prefix.'_address']['city']));
$zip		= array('placeholder'=>lang('address_zip'), 'maxlength'=>'10', 'class'=>'address col-md-2', 'name'=>'zip', 'value'=> set_value('zip', @$customer[$address_form_prefix.'_address']['zip']));


?>
	
	<?php
	//post to the correct place.
	echo form_open('cart/checkout/step_1',"");?>
		<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<?php // Address form ?>
			<fieldset>
				
					<div class="form-group">
						<h2 style="margin:0px;">
							<?php //echo ($address_form_prefix == 'bill')?lang('address'):lang('shipping_address');?>
							<?php echo lang('address')?>
						</h2>
					</div>
				
				
			
					<div class="form-group">
						<label class="placeholder"><?php echo lang('address_company');?></label>
						<?php echo form_input($company);?>
					</div>
		
					<div class="form-group">
						<label class="placeholder"><?php echo lang('address_firstname');?><b class="r"> *</b></label>
						<?php echo form_input($first);?>
					</div>
					<div class="form-group">
						<label class="placeholder"><?php echo lang('address_lastname');?><b class="r"> *</b></label>
						<?php echo form_input($last);?>
					</div>
			
				
					<div class="form-group">
						<label class="placeholder"><?php echo lang('address_email');?><b class="r"> *</b></label>
						<?php echo form_input($email);?>
					</div>

					<div class="form-group">
						<label class="placeholder"><?php echo lang('address_phone');?><b class="r"> *</b></label>
						<?php echo form_input($phone);?>
					</div>
				

				

				<div class="form-group">
						<label class="placeholder"><?php echo lang('address');?><b class="r"> *</b></label>
						<?php echo form_input($address1);?>
					</div>
			
				
			
					
		

				
					<div class="form-group">
						<label class="placeholder"><?php echo lang('address_city');?><b class="r"> *</b></label>
						<?php echo form_input($city);?>
					</div>
				
				
		

				
					<div class="form-group">
						
						<input class="btn  btn-default btn-primary" type="submit" value="<?php echo lang('form_continue');?>"/>
					</div>
			
			</div>
		</fieldset>
	</form>
	</div>
</div>
