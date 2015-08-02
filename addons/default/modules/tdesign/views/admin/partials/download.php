<fieldset id="filters">
	<legend><?php echo lang('design:arts') ?></legend>

	<?php if(!empty($arts))?>
		<ul>
				<?php foreach ($arts as $art)?>
				<li><a download href="<?php echo $art?>" target="_blank"><img src="<?php echo $art?>" /></a></li>
				<?php ?>
		</ul>

</fieldset>
