<?php

function status($statusid) {
	switch ($statusid) {
		case 0 :
			return lang("order:status_no_process");
		case 1 :
			return lang("order:status_proceceed");
		case 2 :
			return lang("order:status_cancel");
	}
}
?>
<table cellspacing="0">
	<thead>
		<tr>
			<th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')) ?></th>
			<th><?php echo lang('order:order_id') ?></th>


			<th class="collapse"><?php echo lang('order:date_label') ?></th>
			<th class="collapse"><?php echo lang('order:customer') ?></th>
			<th class="collapse"><?php echo lang('order:phone') ?></th>
			<th class="collapse"><?php echo lang('order:status_label') ?></th>
			<th><?php echo lang('order:total') ?></th>
			<th width="180"><?php echo lang('global:actions') ?></th>
		</tr>
	</thead>
	<tbody>
			
			<?php foreach ($orders as $order) : ?>
				<tr>
			<td><?php echo form_checkbox('action_to[]', $order->id) ?></td>
			<td class="collapse"><a href="<?php echo base_url("admin/order/form/".$order->id)?>" >#<?php  echo $order->order_number?></a></td>
			<td class="collapse"><?php  echo date("d/m/y H:i:s",strtotime($order->ordered_on));?></td>
				<td class="collapse"><?php  echo ($order->fullname)?></td>
					<td class="collapse"><?php  echo ($order->phone)?></td>
			<td class="collapse"><?php  echo status($order->status)?></td>
			<td class="collapse"><?php  echo format_price($order->total)?></td>
			<td style="padding-top: 10px;">
			 
		<a href="<?php echo site_url('admin/order/form/' . $order->id) ?>" title="<?php echo lang('global:edit')?>" class="button"><?php echo lang('global:edit')?></a>
					
					
			</td>
		</tr>
			<?php endforeach ?>
		</tbody>
</table>

<?php  echo $pagination; ?>

<br>

<div class="table_action_buttons">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))) ?>
	</div>