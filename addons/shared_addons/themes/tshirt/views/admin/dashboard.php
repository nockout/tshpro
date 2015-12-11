<!-- Add an extra div to allow the elements within it to be sortable! -->
<?php
function status($statusid) {
	switch ($statusid) {
		case 0 :
			return lang ( "ORDER_STATUS_NO_PROCESS" );
		case 1 :
			return lang ( "ORDER_STATUS_MANUFACTORING" );
		case 2 :
			return lang ( "ORDER_STATUS_PROCEED" );
		case 3 :
			return lang ( "ORDER_STATUS_CANCEL" );
		case 4 :
			return lang ( "ORDER_STATUS_CLOSED" );
	}
}
?>


<div id="sortable">

	<!-- Dashboard Widgets -->
	<!-- Begin Quick Links -->
	<?php ?>
<div class="one_full">

<?php if(!empty($orders)):?>

	<div class="<?php echo !empty($arts) ? "one_half":"one_full" ?>">
		<section class="draggable title">
			<h4><?php echo lang("cp:order_analys")?></h4>
			<a class="tooltip-s toggle" title="Toggle this element"></a>
		</section>
		<section id="quick_links" class="item <?php echo isset($orders) ?>">
			<div class="content">
				<table border="0" id="widgets-list" class="table-list"
					cellspacing="0">
					<tbody class="ui-sortable">
					<tr>
							<td><?php echo lang ( "cp:total_order" )?></td>
							<td><?php echo $orders['total']?></td>
							</tr>
						<tr>
							<td><?php echo lang ( "ORDER_STATUS_NO_PROCESS" )?></td>
							<td><a href="<?php echo base_url("admin/order")?>" > <?php echo $orders['new']?></a></td>
							</tr>
						<tr>
							<td><?php echo lang ( "ORDER_STATUS_MANUFACTORING" )?></td>
							<td><a href="<?php echo base_url("admin/order")?>" > <?php echo $orders['manufacturer']?></a></td>
						</tr>
				
				</table>
			</div>
		</section>
	</div>
	<?php endif?>
	<?php if(!empty($arts)):?>
	<div class="one_half">
		<section class="draggable title">
			<h4><?php echo lang('cp:art_statictis')?></h4>
			<a class="tooltip-s toggle" title="Toggle this element"></a>
		</section>
		<section id="quick_links" class="item ">
			<div class="content">
				<table border="0" id="widgets-list" class="table-list"
					cellspacing="0">
					<tbody class="ui-sortable">
						<tr>
							<td><?php echo lang('cp:art')?></td>
							<td> <?php echo $arts['total']?></td>
						</tr>
						<tr>
							<td><?php echo lang('cp:new_art')?></td>
							<td><a href="<?php echo site_url("admin/tdesign/manage/arts")?>"><?php echo $arts['new']?></a></td>
						</tr>
						<tr>
							<td><?php echo lang('cp:not_approve')?></td>
							<td><a href="<?php echo site_url("admin/tdesign/manage/arts")?>"><?php echo $arts['not_approval']?></a></td>
						</tr>
				
				</table>
			</div>
		</section>
	</div>



<?php endif ?>	
	</div>
	<?php if(!empty($latest_order)):?>
	
	<div class="one_full">
		<section class="draggable title">
			<h4><?php echo lang('cp:last_order');?></h4>
			<a class="tooltip-s toggle" title="Toggle this element"></a>
		</section>
		<section id="quick_links" class="item ">
			<div class="content">


				<!-- Available Widget List -->
				<table border="0" id="widgets-list" class="table-list"
					cellspacing="0">
					<thead>
						<tr>

							<th width="20%"><?php echo lang('cp:order_id')?></th>
							<th><?php echo lang('cp:status')?></th>
							<th width=""><?php echo lang('cp:date')?></th>
							<th width=""><?php echo lang('global:actions') ?></th>
							<th width=""><?php echo lang('global:actions') ?></th>
						</tr>
					</thead>
					<tbody class="ui-sortable">
							<?php foreach ($latest_order['objects'] as $order):?>
								<tr>

							<td><a
								href="<?php echo site_url("admin/order/form/".$order->id)?>">#<?php echo $order->order_number?></a></td>
							<td><?php echo status($order->status)?></td>
							<td><?php echo ($order->ordered_on)?></td>
							<td><?php echo format_currency($order->total)?></td>
							<td><a
								href="<?php echo site_url("admin/order/form/".$order->id)?>"><?php echo lang("global:view")?></a></td>
						</tr>
								<?php endforeach;?>
							
					</tbody>
				</table>

			</div>

		</section>

	</div>

<?php endif?>

</div>
<!-- End sortable div -->