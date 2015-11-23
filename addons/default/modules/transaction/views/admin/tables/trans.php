
<table cellspacing="0">
	<thead>
		<tr>
			
			<th class="collapse"><?php echo lang('tran:date_label') ?></th>
		
			<th class="collapse"><?php echo lang('trans:description') ?></th>
			<th><?php echo lang('trans:amount') ?></th>
		
		</tr>
	</thead>
	<tbody>
			
			<?php foreach ($trans as $tran) : ?>
				<tr>
			
			<td class="collapse"><?php  echo ($tran->date_added)?></td>
			<td class="collapse"><?php  echo ($tran->description);?></td>
			<td class="collapse"><?php  echo format_price($tran->amount)?></td>
			
		</tr>
			<?php endforeach ?>
		</tbody>
</table>

<?php  echo $pagination; ?>

<br>
