<table cellspacing="0">
		<thead>
			<tr>
				<th><?php echo lang('attribute:name') ?></th>
				<th><?php echo lang('attribute:attribute_price') ?></th>
		
				<th width="180"><?php echo lang('global:actions') ?></th>
			</tr>
		</thead>
		<tbody>
			
			<?php foreach ($mockups as $mockup) : ?>
				<tr>
					
					<td class="collapse"><?php  echo $attribute->name?></td>
					<td class="collapse"><?php  echo $attribute->price?></td>		
				
					<td style="padding-top:10px;">
                       
                      
						<a href="<?php echo site_url('admin/mockup/form/' . $mockup->id_mockup) ?>" title="<?php echo lang('global:edit')?>" class="button"><?php echo lang('global:edit')?></a>
						<a href="<?php echo site_url('admin/mockup/delete/' . $mockup->id_mockup) ?>" title="<?php echo lang('global:delete')?>" class="button confirm"><?php echo lang('global:delete')?></a>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
