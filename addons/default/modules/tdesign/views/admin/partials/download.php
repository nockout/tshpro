<fieldset class="filters">
	<legend><?php echo lang('design:arts') ?></legend>

	<?php if(!empty($arts))?>
		<ul>
				<?php foreach ($arts as $art):?>
				<li style=""><a style="width: 200px;height:200px" download href="<?php echo $art?>" target="_blank">
				<img style="width: 200px;height:200px" src="<?php echo $art?>" /></a>
				</li>
				<?php endforeach;?>
		</ul>

</fieldset>
