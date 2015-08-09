<fieldset id="filters">
	<legend><?php echo lang('global:filters') ?></legend>

	<?php echo form_open('', '', array('f_module' => $module_details['slug'])) ?>
		<ul>
			
			<li class="">
				<label for="f_category"><?php echo lang('global:keywords') ?></label>
				<?php echo form_input('f_keywords', set_value("f_keywords",!empty($term['f_keywords'])? $term['f_keywords']:""), 'style="width: 55%;"') ?>
			</li>
			<li class="">
        		<label for="f_category"><?php echo lang('template:category_label') ?></label>
       			<?php echo form_dropdown('f_category', array(0 => lang('global:select-all')) + $categories,set_value("f_category",!empty($term['f_category'])? $term['f_category']:"")); ?>
    		</li>

				
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
				<li class="">
				<?php echo anchor(("admin/template") , lang('buttons:cancel'), 'class="button red"') ?>
			</li>
		</ul>
	<?php echo form_close() ?>
</fieldset>
