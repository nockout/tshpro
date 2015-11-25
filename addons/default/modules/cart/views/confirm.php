<div class="container">
	<?php echo $this->load->view("notices")?>

	<div style="display: none; margin-top: 10px;" class="row"
		id="frmValidateRow">
		<div class="col-sm-6">
			<div role="success" class="alert alert-success">

				<div id="frmValidate"></div>
			</div>
		</div>
	</div>


	<div class="row">

		<form accept-charset="UTF-8" method="post" class="form-horizontal"
			action="<?php echo base_url("cart/checkout/")?>"
			name="productpurchase" id="productpurchase">
			<div class="col-sm-12">
				<div class="page-header">
					<h1>
						<?php echo lang("cart:title_contact_info")?> <small>| <?php echo lang("cart:title:checkout")?></small>
					</h1>
				</div>

				<div class="row shpInfoSlct">
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group row">
							<label class="col-lg-2 col-sm-12"><?php echo lang("cart:email")?></label>
							<div class="col-lg-10 col-sm-12">
							
								<?php echo form_input('email',set_value('email'),'class="form-control"
									placeholder="'. lang("cart:email").'" id="email"');?>	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-2 col-sm-12"><?php echo lang("global:first_last_name")?></label>
							<div class="col-lg-10 col-sm-12">
							<?php echo form_input('first_name',set_value('first_name'),'class="form-control"
									placeholder="'. lang("global:first_last_name").'" id="first_name"');?>	
								
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-2 col-sm-12"><?php echo lang("cart:shipping_address")?></label>
							<div class="col-lg-10 col-sm-12">
							
								<?php echo form_textarea('address',set_value('address'),'class="form-control"
									placeholder="'. lang("cart:shipping_address").'" id="address"');?>
								
							</div>
						</div>

						<div class="row form-group ">

							<div class="col-xs-12">

								<div class="form-group ">
									<label class="col-lg-2 col-sm-12"><?php echo lang("cart:shipping_zones")?></label>
									<div class="col-lg-10 col-sm-12"><?php echo form_dropdown('zone_id', $zones, set_value("zone_id"),'autocomplete="off" id="zones" class="form-control"');?>
									</div>
								</div>

							</div>

						</div>
						<div class="form-group row">
							<label class="col-lg-2 col-sm-12"><?php echo lang("cart:phone")?></label>
							<div class="col-lg-10 col-sm-12">
								<?php echo form_input('phone',set_value('phone'),'class="form-control"
									placeholder="'. lang("phone").'" id="phone"');?>
								
							</div>
						</div>
						<div class="form-group row">
							<div class=" col-lg-10 col-lg-offset-2  col-sm-12">
								<input type="submit"
									value="<?php echo lang("cart:place_order")?>"
									class="btn btn-success btn-lg btn-xxl btn-block"
									name="submitWait" id="plsWt2">

							</div>
						</div>



					</div>
					<div class="col-sm-6">

						<div class="panel panel-info">


							<div class="panel-heading">
								<h3 class="panel-title"><?php echo lang("cart:order_sumary")?></h3>
							</div>
							<div class="panel-body">


								<div id="getShipTDBox">


									<table class="table table-condensed">

										<tbody>
				<?php 	foreach ($this->go_cart->contents() as $cartkey=>$product):?>
		
				<tr>
												<td><?php echo $product['quantity']?></td>
												<td>
												<?php $inforProduct=unserialize($product['extra'])?>
												
												<?php if(!empty($inforProduct['image'])):?>
												
												<img class="img-responsive" width="90" height="90" src="<?php echo $inforProduct['image'][0]?>" />
												<?php endif?>
												</td>
												<td><?php 
												$size=(!empty($product['sizeSelected']))?($product['sizeSelected']):"";
												echo sprintf("%s-%s",$product['product'],$size);
												?></td>
												
												<td class="text-right">
					<?php echo format_price($product['price']*$product['quantity'])?>
					</td>
											</tr>
				<?php endforeach;?>
				
						
					
			
				<tr>
												<td colspan="3"><?php echo lang("cart:sub_total")?></td>
												<td class="text-right"><?php  echo format_price($this->go_cart->total())?></td>
											</tr>


				


											<tr class=" ">
												<td colspan="3"><?php echo lang("cart:shipping_fee")?></td>
												<td class="text-right" id="shipping_frame"><?php  echo format_price(0)?></td>
											</tr>
											

								<script>
								(function($) {

									$(function() {
										$("#zones").on("change", function(ev) {
											
											var data="?zone="+$(this).val();
											$.get("cart/get_shipping_fee"+data, function(res) {
												var object=$.parseJSON(res);
												
												if(object){
													$("#shipping_frame").html(object.s);
													$("#total_frame").html(object.t);
												}
											});
										});

										})
								})(jQuery);					

								</script>
											<tr>
												<td colspan="3"><?php echo lang("cart:payment")?></td>
												<td class="text-right" id=""><?php $payment=$this->go_cart->payment_method();echo $payment['description']?></td>
											</tr>
											
											<tr class="text-info bg-info">
												<td colspan="3"><?php echo lang("cart:total")?></td>
												<td class="text-right" id="total_frame"><?php  echo format_price($this->go_cart->total())?></td>
											</tr>
											
											

										</tbody>
									</table>

								</div>

								<h5>How quickly will I get my shirt?</h5>
								<p>Your shirt will ship out within 5 days of placing your order!</p>
							</div>
						</div>



					</div>

				</div>


			</div>


		</form>

	</div>

</div>