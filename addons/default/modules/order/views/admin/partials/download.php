<fieldset id="filters">
	<legend><?php echo lang('design:arts') ?></legend>

	<?php if(!empty($arts)):?>
		<ul>
				<?php foreach ($arts as $art):?>
				<li><a download href="<?php echo $art?>" target="_blank">
				<img style="width: 120px;height:120px" src="<?php echo $art?>" /></a></li>
				<?php endforeach;?>
		</ul>
		<?php endif;?>
</fieldset>
