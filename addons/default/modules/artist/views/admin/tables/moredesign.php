

	<div class="table_action_buttons">
	<?php echo form_open('admin/tdesign/create_design') ?>				
					<div id="filter-stage">
					<input type="hidden" name="art_id" value="<?php echo $art_id?>">
					<input class="btnl red blue" value="<?php echo lang("design:adddmore")?>" name="btnAction" type="submit"  />
					</div>
				<?php echo form_close() ?>
	</div>
	