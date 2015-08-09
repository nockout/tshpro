
	<table cellspacing="0">
		<thead>
			<tr>
				<th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')) ?></th>
				<th><?php echo lang('global:title') ?></th>
				<th><?php echo lang('template:group') ?></th>
				<th class="collapse"><?php echo lang('template:category_label') ?></th>
				<th class="collapse"><?php echo lang('template:date_label') ?></th>
			
				<th><?php echo lang('template:status_label') ?></th>
				<th width="180"><?php echo lang('global:actions') ?></th>
			</tr>
		</thead>
		<tbody>
			
			<?php foreach ($templates as $template) : ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $template->id_template) ?></td>
					<td class="collapse"><?php  echo $template->name?></td>
					<td class="collapse"><?php  echo $template->group_id?></td>
					<td class="collapse"><?php  echo $template->cate_name?></td>
					<td class="collapse"><?php echo format_date($template->timestamp) ?></td>				
					<td><?php echo lang('template:'.$template->status.'_label') ?></td>
					<td style="padding-top:10px;">
                       
                      
						<a href="<?php echo site_url('admin/template/form/' . $template->id_template) ?>" title="<?php echo lang('global:edit')?>" class="button"><?php echo lang('global:edit')?></a>
						<a href="<?php echo site_url('admin/template/delete/' . $template->id_template) ?>" title="<?php echo lang('global:delete')?>" class="button confirm"><?php echo lang('global:delete')?></a>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<?php  echo $pagination ?>

	<br>

	<div class="table_action_buttons">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete', 'publish',"set_group"))) ?>
	</div>