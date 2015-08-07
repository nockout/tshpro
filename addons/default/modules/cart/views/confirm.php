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

		<form accept-charset="UTF-8" method="post"
			action="<?php echo base_url("cart/checkout/")?>"
			name="productpurchase" id="productpurchase">
			<div class="col-sm-7">
				<div class="page-header">
					<h1>
						<?php echo lang("cart:title_contact_info")?> <small>| <?php echo lang("cart:title:checkout")?></small>
					</h1>
				</div>

				<div class="row shpInfoSlct">
					<div class="col-sm-8">
						<div class="form-group has-feedback">
							<label class="ielabel"><?php echo lang("cart:email")?></label> <input
								type="text" class="form-control" placeholder="<?php echo lang("cart:email")?>"
								value="" name="email" id="email">
						</div>
						<div class="form-group has-feedback">
							<label class="ielabel"><?php echo lang("cart:first_name")?></label> <input
								type="text" value="" class="form-control"
								placeholder="<?php echo lang("cart:first_name")?>" id="name"
								name="first_name">
						</div>
						<div class="form-group has-feedback">
							<label class="ielabel"><?php echo lang("cart:address")?></label> <input
								type="text" value="" class="form-control"
								placeholder="<?php echo lang("cart:last_name")?>" id="name"
								name="last_name">
						</div>
						<div class="form-group has-feedback">
							<label class="ielabel"><?php echo lang("shipping_address")?></label>
							<input type="text" value="" class="form-control"
								placeholder="<?php echo lang("cart:shipping_address")?>" id="address"
								name="address">
						</div>

						<div class="row">
						
							<div class="col-xs-12">

								<div style="display: Block;" class="form-group has-feedback">
									<label class="ielabel"><?php echo lang("city")?></label> 
									<?php echo form_dropdown('city', $cities, set_value("city"),'autocomplete="off" class="form-control"');?>
									
								</div>
							
							</div>

						</div>
						<div class="form-group has-feedback">
							<label class="ielabel"><?php echo lang("cart:phone")?></label> 
							<input type="text" value=""
								class="form-control" placeholder="<?php echo lang("phone")?>" id="phone" name="phone">
						</div>
						<div class="form-group">
							<input type="submit" value="<?php echo lang("cart:place_order")?>"
								class="btn btn-success btn-lg btn-xxl btn-block"
								name="submitWait" id="plsWt2">

						</div>




					</div>


				</div>


			</div>

			<div class="col-sm-5">
				<div class="page-header">
					<h1>
						<img style="padding-top: 7px;" class="img-responsive"
							src="https://seal.godaddy.com/images/3/en/siteseal_gd_3_h_l_m.gif">
					</h1>
				</div>
				<div class="panel panel-info">


					<div class="panel-heading">
						<h3 class="panel-title">Order Summary</h3>
					</div>
					<div class="panel-body">


						<div id="getShipTDBox">


							<table class="table table-condensed">

								<tbody>
				<?php 	foreach ($this->go_cart->contents() as $cartkey=>$product):?>
		
				<tr>
										<td><?php echo $product['quantity']?></td>
										<td><?php echo (!empty($product['sizeSelected']))?($product['sizeSelected']):""?></td>
										<td><?php echo $product['product']?></td>
										<td class="text-right">
					<?php echo format_price($product['price']*$product['quantity'])?>
					</td>
									</tr>
				<?php endforeach;?>
				
						
					
			
				<tr>
										<td colspan="3"><?php echo lang("cart:sub_total")?></td>
										<td class="text-right"><?php  echo format_price($this->go_cart->total())?></td>
									</tr>







									<tr class="text-info bg-info">
										<td colspan="3"><?php echo lang("cart:total")?></td>
										<td class="text-right"><?php  echo format_price($this->go_cart->total())?></td>
									</tr>


								</tbody>
							</table>

						</div>

						<h5>How quickly will I get my shirt?</h5>
						<p>Your shirt will ship out within 5 days of placing your order!</p>
					</div>
				</div>



			</div>
		</form>

	</div>

</div>