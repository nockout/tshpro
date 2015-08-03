	<table cellspacing="0">
		<thead>
			<tr>
				<th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')) ?></th>
				<th><?php echo lang('design:designed_label') ?></th>
				<th class="collapse"><?php echo lang('design:category_label') ?></th>
				<th class="collapse"><?php echo lang('design:date_label') ?></th>
				<th class="collapse"><?php echo lang('design:written_by_label') ?></th>
				<th><?php echo lang('design:status_label') ?></th>
				<th width="180"><?php echo lang('global:actions') ?></th>
			</tr>
		</thead>
		<tbody>
			
			<?php foreach ($designs as $design) : ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $design->product_id) ?></td>
					<td><?php echo $design->product?></td>
					<td class="collapse"><?php  echo $design->cate_name?></td>
					<td class="collapse"><?php echo format_date($design->avail_since) ?></td>
					<td class="collapse">
					<?php if (isset($design->user_id)): ?>
						<?php echo anchor('user/'.$design->user_id, $design->user_name, 'target="_blank"') ?>
					<?php else: ?>
						<?php echo lang('design:author_unknown') ?>
					<?php endif ?>
					</td>
					<td><?php echo lang('design:disable_label') ?></td>
					<td style="padding-top:10px;">
                       
                      <?php if($design->deleted==0):?>
						<a href="<?php echo site_url('admin/tdesign/form/' . $design->product_id) ?>" title="<?php echo lang('global:edit')?>" class="button"><?php echo lang('global:edit')?></a>
						<a href="<?php echo site_url('admin/tdesign/delete/' . $design->product_id) ?>" title="<?php echo lang('global:delete')?>" class="button confirm"><?php echo lang('global:delete')?></a>
						<?php endif;?>
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