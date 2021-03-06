
<?php

function status($statusid) {
	switch ($statusid) {
		case 0 :
			return lang("ORDER_STATUS_NO_PROCESS");
		case 1 :
			return lang("ORDER_STATUS_MANUFACTORING");
		case 2 :
			return lang("ORDER_STATUS_PROCEED");
		case 3 :
			return lang("ORDER_STATUS_CANCEL");
			
	}
}
;
?>
<section class="title">

	<h4><?php echo ($title) ?></h4>
</section>
<section class="item">
	<div class="content">
		<div class="form_inputs" id="information">
	<?php echo form_open()?>
	<div class="one_half">
				<fieldset>

					<ul>
						<li>


							<div class="input">
								<b><?php echo lang('order:order_id') ?></b>:#<?php echo $detail->order_number?> </div>
						</li>
						<li>


							<div class="input">
								<b><?php echo lang('order:date_label') ?></b>:<?php echo date("d/m/Y H:i:s",strtotime($detail->ordered_on))?> </div>
						</li>
						<li>


							<div class="input">
								<b><?php echo lang('order:phone') ?></b>:<?php echo $detail->phone?> </div>
						</li>
						<li>


							<div class="input">
								<b><?php echo lang('order:mail') ?></b>:<?php echo $detail->email?> </div>
						</li>
						<li>


							<div class="input">
								<b><?php echo lang('order:name') ?></b>:<?php echo $detail->firstname." ".$detail->lastname?> </div>
						</li>
						<li>


							<div class="input">
								<b><?php echo lang('order:company') ?></b>:<?php echo ($detail->company)?> </div>
						</li>
					</ul>

				</fieldset>

			</div>
			<div class="one_half">
				<fieldset>

					<ul>
						<li>


							<div class="input">
								<b><?php echo lang('order:shipping_zone') ?></b>:<?php echo !empty($detail->shipzone)?$detail->shipzone:""?> </div>
						</li>
											
						<li>


							<div class="input">
								<b><?php echo lang('order:shipping_address1') ?></b>:<?php echo $detail->ship_address1?> </div>
						</li>
						<li>


							<div class="input">
								<b><?php echo lang('order:shipping_address2') ?></b>:<?php echo $detail->ship_address2?> </div>
						</li>
							
							
					
						<li><label for="status"><?php echo lang('order:status_label') ?></label>

							<?php if($detail->status==ORDER_STATUS_MANUFACTORING):?>
							<div class="input">
							
									
								<?php echo form_dropdown("status",$status,set_value("status",$detail->status))?>
								</div>
							<?php else:?>
								:<?php echo status($detail->status);?>
							
						
							<?php endif?>
						</li>

					</ul>

				</fieldset>

			</div>
			<div class="one_full">
				<fieldset>
					<ul>
						<li><label for="comment"><?php echo lang('order:comment') ?></label>
							<div class="input">
								<textarea name="comment" style="" class="cke_wrapper"><?php echo $detail->notes?></textarea>
							</div></li>
					</ul>
				</fieldset>
			</div>
			
			<?php if(!empty($detail->items)):?>
			<div class="one_full">
				<table cellspacing="0">
					<thead>
						<tr>
							<th></th>
							<th><?php echo lang("item:image")?></th>
							<th class="collapse"><?php echo lang("item:name")?></th>
							<th class="collapse"><?php echo lang("item:designer")?></th>
							<th><?php echo lang("item:quantity")?></th>
							<th class="text-right"><?php echo lang("item:price")?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($detail->items as $item):?>
						<?php $productData=unserialize($item->contents)?>
						<tr>
	
							<td><?php $this->load->view("admin/partials/download",array("arts"=>!empty($item->arts->data)?unserialize($item->arts->data):""))?></td>
							
							<td class="collapse">
							<?php if(!empty($productData['extra'])):?>
							<?php $extras=unserialize($productData['extra']);?>
							<?php if(!empty($extras['image']))?>
							<?php foreach ($extras['image'] as $extra):?>
							
							<img width="90" height="90" alt="" src="<?php echo $extra?>">
							<?php break;?>
							<?php endforeach;?>
							<?php endif?>
							</td>
							<?php $size=isset($productData['sizeSelected'])?$productData['sizeSelected']:""?>
							<td class="collapse"><?php echo $productData['product']."-".$size ?></td>
							<td class="collapse"><?php echo !empty($item->designer)?$item->designer->username:"" ?></td>

							<td style="padding-top: 10px;"><?php echo $productData['quantity']?></td>
							<td class="collapse text-right"><?php echo format_price($productData['subtotal'])?></td>
						</tr>
						
						<?php endforeach;?>
						<tr>
							<td colspan=5 class="text-right"><h2><?php echo lang("order:shipping_fee")?></h2></td>
							<td  class="text-right"><h2><?php echo format_price($detail->shipping);?></h2></td>
						</tr>
						<tr>
						
							<td colspan=5 class="text-right"><h2><?php echo lang("order:total")?></h2></td>
							<td  class="text-right"><h2><?php echo format_price($detail->total);?></h2></td>
						</tr>
					</tbody>
				</table>

			</div>
			<?php endif?>
			
			
			<div class="clearfix"></div>
			<?php if($detail->status==ORDER_STATUS_MANUFACTORING):?>
			<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel')))?>
			<?php endif?>
		</div>
	<?php echo form_close()?>
</div>


	</div>
</section>