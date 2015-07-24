
	<table cellspacing="0">
		<thead>
			<tr>
				<th width="10%"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')) ?></th>
				<th width="40%"><?php echo lang('option:option_name') ?></th>
				<th width="10%"><?php echo lang('option:option_type') ?></th>
				<th width="20%"><?php echo lang('option:option_position') ?></th>
				<th width="20%"><?php echo lang('global:actions') ?></th>
			</tr>
		</thead>
		<tbody>
			
			<?php foreach ($options as $op) : ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $op->id_option) ?></td>
					<td><?php echo $op->name?></td>
					<td><?php echo $op->group_type ?></td>
					<td><?php echo $op->position ?></td>
					<td style="padding-top:10px;">
                       <a href="<?php echo site_url('admin/option/attributes/' . $op->id_option) ?>" title="<?php echo lang('option:attributes')?>" class="button"><?php echo lang('option:attributes')?></a>
						<a href="<?php echo site_url('admin/option/form/' . $op->id_option) ?>" title="<?php echo lang('global:edit')?>" class="button"><?php echo lang('global:edit')?></a>
						<a href="<?php echo site_url('admin/option/delete/' . $op->id_option) ?>" title="<?php echo lang('global:delete')?>" class="button confirm"><?php echo lang('global:delete')?></a>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<?php  $this->load->view('admin/partials/pagination') ?>

	<br>

	<div class="table_action_buttons">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete', 'bulksave'))) ?>
	</div>