


</br>
<?php if(empty($order)):?>
<div class="col-sm-6 col-lg-6  col-md-offset-3">

	<table class="table table-condensed">
		<tbody>
			<tr>
								
									<?php $tag_a='<a href="'.site_url('home').'"><span class="text-warning">'.Settings::get('site_name').'</span></a>'?>
									<td class="text-left" colspan="4"><h5><?php echo sprintf(lang("cart:thank_you"),$tag_a)?></h5>

				</td>

			</tr>
					<tr>
								<td class="text-left" colspan="2">
										<a href="<?php echo site_url()?>" ><i class="fa  fa-arrow-left"></i>&nbsp;<?php echo lang('cart:return_home')?></a>
										
									</td>
									<td class="text-right" colspan="2"><a href="home" class=""><?php echo lang('cart:continue_shopping')?>&nbsp;<i class="fa  fa-arrow-right"></i></a></td>
								</tr>
		</tbody>

	</table>
</div>

<?php else:?>
<div class="container">
	<div class="row ">

			<?php ?>
			<div class="col-sm-6 col-lg-6  col-md-offset-3">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo lang("cart:order_sumary")?></h3>
				</div>
				<div class="panel-body">

					<h5 class="">
						<span><?php echo lang("cart:order_code")?></span><span
							class="text-warning">#<?php echo $order->order_number?></span>
					</h5>
					<h5 class="text-success"><?php echo lang("cart:just_buy")?></h5>
					<div id="getShipTDBox">

						<table class="table table-condensed">
								<?php if(!empty($items)):?>
							<tbody>
				<?php 	foreach ($items as $item):?>
									<?php $product=(array)unserialize($item->contents);?>
									
									
				<tr>
									<td><?php echo $product['quantity']?></td>
									<td>
												<?php $inforProduct=unserialize($product['extra'])?>
												
												<?php if(!empty($inforProduct['image'])):?>
												
												<img class="img-responsive" width="90" height="90"
										src="<?php echo $inforProduct['image'][0]?>" />
												<?php endif?>
												</td>
									<td><?php
			$size = (! empty ( $product ['sizeSelected'] )) ? ($product ['sizeSelected']) : "";
			echo sprintf ( "%s-%s", $product ['product'], $size );
			?></td>

									<td class="text-right">
					<?php echo format_price($product['price']*$product['quantity'])?>
					</td>
								</tr>
				<?php endforeach;?>
							</tbody>
							<?php endif?>	
							<tbody>



								<tr>
									<td class="text-right" colspan="3"><?php echo lang("cart:sub_total")?></td>
									<td class="text-right"><?php  echo format_price($order->subtotal)?></td>
								</tr>



								<tr class=" ">
									<td class="text-right" colspan="3"><?php echo lang("cart:shipping_fee")?></td>
									<td class="text-right" id="shipping_frame"><?php  echo format_price($order->shipping)?></td>
								</tr>

								<tr>
									<td class="text-right" colspan="3"><?php echo lang("cart:payment")?></td>
									<td class="text-right" id="total_frame"><?php echo $order->payment_info?></td>
								</tr>

								<tr class="text-info bg-info">
									<td class="text-right" colspan="3"><?php echo lang("cart:total")?></td>
									<td class="text-right" id="total_frame"><?php  echo format_price($order->total)?></td>
								</tr>

								<tr>
								
									<?php $tag_a='<a href="'.site_url('home').'"><span class="text-warning">'.Settings::get('site_name').'</span></a>'?>
									<td class="text-left" colspan="4"><h5><?php echo sprintf(lang("cart:thank_you"),$tag_a)?></h5>
										
									</td>
									
								</tr>
								<tr>
								<td class="text-left" colspan="2">
										<a href="home" ><i class="fa  fa-arrow-left"></i><?php lang('cart:return_home')?></a>
										
									</td>
									<td class="text-right" colspan="2"><a href="" class=""><i class="fa  fa-arrow-right"></i><?php lang('cart:continue_shopping')?></a></td>
								</tr>
							</tbody>

						</table>

					</div>

				</div>
			</div>
		</div>



	</div>
</div>
<?php endif?>