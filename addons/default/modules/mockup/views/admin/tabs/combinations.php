<div class="form_inputs" id="combinations">
			<?php if(!$mockup_id):?>
				<div class="one_full">
		<fieldset>
			<div class="block-message warning"><?php echo lang("mockup:save_product_before_add_combinations")?></div>
		</fieldset>
	</div>
			
			<?php else:?>
			<?php echo form_open("admin/mockup/combinations")?>
			<?php  $this->load->view("admin/combinations")?>
			<?php echo form_close()?>
			
			<?phpendif;
			?>
</div>