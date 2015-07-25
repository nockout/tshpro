
<div class="form_inputs" id="combinations">
<?php form_open("admin/mockup/combinations")?>
			<?php if(!$mockup_id):?>
				<div class="one_full">
		<fieldset>
			<div class="block-message warning"><?php echo lang("mockup:save_product_before_add_combinations")?></div>
		</fieldset>
	</div>
			
			<?php else:?>
			
			<?php  //$this->load->view("admin/combinations")?>
			<?php endif;		?>	
			
			<div class="clearfix"></div>
	<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel')))?>
		</div>
			<?php echo form_close()?>
			
			</div>