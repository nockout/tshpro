
	<table cellspacing="0">
		<thead>
			<tr>
				<th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')) ?></th>
				<th><?php echo lang('mockup:mockup_label') ?></th>
				<th class="collapse"><?php echo lang('mockup:category_label') ?></th>
				<th class="collapse"><?php echo lang('mockup:date_label') ?></th>
			
				<th><?php echo lang('mockup:status_label') ?></th>
				<th width="180"><?php echo lang('global:actions') ?></th>
			</tr>
		</thead>
		<tbody>
			
			<?php foreach ($mockups as $mockup) : ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $mockup->id_mockup) ?></td>
					<td class="collapse"><?php  echo $mockup->name?></td>
					<td class="collapse"><?php  echo $mockup->id_category_default?></td>
					<td class="collapse"><?php echo format_date($mockup->timestamp) ?></td>				
					<td><?php echo lang('mockup:'.$mockup->status.'_label') ?></td>
					<td style="padding-top:10px;">
                       
                      
						<a href="<?php echo site_url('admin/tmockup/form/' . $mockup->id_mockup) ?>" title="<?php echo lang('global:edit')?>" class="button"><?php echo lang('global:edit')?></a>
						<a href="<?php echo site_url('admin/tmockup/delete/' . $mockup->id_mockup) ?>" title="<?php echo lang('global:delete')?>" class="button confirm"><?php echo lang('global:delete')?></a>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<?php  $this->load->view('admin/partials/pagination') ?>

	<br>

	<div class="table_action_buttons">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete', 'publish'))) ?>
	</div>