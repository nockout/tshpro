
	<table cellspacing="0">
		<thead>
			<tr>
				<th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')) ?></th>
				<th><?php echo lang('global:title') ?></th>
			
				
				<th class="collapse"><?php echo lang('order:date_label') ?></th>
			
				<th><?php echo lang('order:total') ?></th>
				<th width="180"><?php echo lang('global:actions') ?></th>
			</tr>
		</thead>
		<tbody>
			
			<?php foreach ($orders as $order) : ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $order->id) ?></td>
					<td class="collapse"><?php  echo $order->order_number?></td>
					<td class="collapse"><?php  echo $order->ordered_on?></td>
					<td class="collapse"><?php  echo $order->total?></td>
					
					<td style="padding-top:10px;">
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<?php  $this->load->view('admin/partials/pagination') ?>

	<br>

	<div class="table_action_buttons">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))) ?>
	</div>