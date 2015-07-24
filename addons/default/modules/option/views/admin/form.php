<section class="title">
<?php if ($this->method == 'create'): ?>
	<h4><?php echo lang('option:create_title') ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('option:edit_title'), isset($product)?htmlspecialchars_decode($product):"") ?></h4>
<?php endif ?>
</section>
<section class="item">
<div class="content">
<?php echo form_open_multipart() ?>

<div class="tabs">

	<!-- Content tab -->
	<div class="form_inputs" id="design-content-tab">
		
	
		<div class="one_half">
			<fieldset>
			<ul>
				<li>
					<label for="title"><?php echo lang('global:title') ?> <span>*</span></label>
					<div class="input"><?php echo form_input('title', isset($product)?htmlspecialchars_decode($product):"", 'maxlength="100" id="title"') ?></div>
				</li>
	
				
				<li>

					<label for="category_id"><?php echo lang('option:category_label') ?></label>
					<div class="input">
					<?php echo form_dropdown('option_type', array(lang('option:no_category_select_label')) + $categories, @cate_id) ?>
	
					</div>
				</li>
	
				<li class="editor">
					<label for="body"><?php echo lang('option:description_label') ?> <span>*</span></label><br>
					
	
					<div class="edit-content">
						<?php echo form_textarea(array('id' => 'body', 'name' => 'body', 'value' =>isset($full_description)?htmlspecialchars_decode($full_description):"", 'rows' => 30, 'class' => "wysiwyg-advanced")) ?>
					</div>
				</li>
			

				</ul>
		
	</fieldset>
		</div>
		
		<Div class="one_full">
		<fieldset>
		<ul>
				
		
				
			
				
					<li>
						<label for="keywords"><?php echo lang('global:keywords') ?></label>
						<div class="input"><?php echo form_input('keywords', isset($keywords)?htmlspecialchars_decode($keywords):"", 'id="keywords"') ?></div>
					</li>
				
			</ul>
			</fieldset>
		</div>
	</div>


	

</div>

<input type="hidden" name="row_edit_id" value="<?php if ($this->method != 'create'): echo $product_id; endif; ?>" />

<div class="buttons">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))) ?>
</div>

<?php echo form_close() ?>

</div>
</section>