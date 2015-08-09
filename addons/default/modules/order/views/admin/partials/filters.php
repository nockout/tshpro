<fieldset id="filters">
	<legend><?php echo lang('global:filters') ?></legend>
	<?php 
	$status=array(
			""=>lang(""),
			0=> lang("order:status_no_process"),
			1=> lang("order:status_proceceed"),
			2=> lang("order:status_cancel")
	);
	

	?>
	<?php echo form_open('', '', array('f_module' => $module_details['slug'])) ?>
		<ul>
			
			
			
				<li class="">
				<label for="f_category"><?php echo lang('global:keywords') ?></label>
				<?php echo form_input('f_keywords', set_value("f_keywords",!empty($term['f_keywords'])? $term['f_keywords']:"") , 'style="width: 55%;"') ?>
			</li>
			<li class="">
				<label for="f_category"><?php echo lang('order:status_label') ?></label>
				<?php echo form_dropdown('status', $status, set_value("status",!empty($term['status'])?$term['status']:"")) ?>
			</li>
		
			<li class="">
				<?php 
				$data = array(
						'name'        => 'search',
						'id'          => 'search',
						'value'       => 'search',
						"class"		=>"button",
				
						"type"			=>"submit"
				);
				
			
				?>
				<?php echo form_input($data) ?>
			
				<?php echo anchor("admin/order" , lang('buttons:cancel'), 'class="button red"') ?>
			</li>
		</ul>
	<?php echo form_close() ?>
</fieldset>
