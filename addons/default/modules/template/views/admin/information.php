<div class="form_inputs" id="information">
	<?php echo form_open()?>
	<div class="one_half">
		<fieldset>
			<ul>
				<li><label for="title"><?php echo lang('global:title') ?> <span>*</span></label>
					<div class="input"><?php echo form_input('title', set_value('title',$title), 'maxlength="100" id="title"') ?></div>
				</li>
				<li><label for="price"><?php echo lang('template:template_price') ?> <span>*</span></label>
					<div class="input"><?php echo form_input('price', set_value('price',$price), 'maxlength="100" id="price"') ?></div>
				</li>
				<li><label for="category_id"><?php echo lang('template:category_label') ?><span>*</span></label>
					<div class="input">
					<?php echo form_dropdown('category_id', array(lang('template:no_category_select_label')) + $categories,set_value('category_id',$category_id) ) ?>	
					</div></li>

			
				<li><label for="status"><?php echo lang('template:color') ?><span>*</span></label>

					<div class="input">
<?php echo form_dropdown('id_color', array(lang('template:no_color_select_label')) + $colors,set_value('id_color',$id_color) ) ?>
					</div>


				</li>
				<li><label for="status"><?php echo lang('template:status') ?></label>

					<div class="input"><?php echo form_dropdown('status', array( 'A' => lang('template:active'),'D' => lang('template:inactive')), set_value("status",$status)) ?></div>


				</li>



			</ul>

		</fieldset>
	</div>
	<div class="clearfix"></div>
	<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel')))?>
		</div>
	<?php echo form_close()?>
</div>
