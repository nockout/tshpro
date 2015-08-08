<section class="title">
<?php if ($this->method == 'create'): ?>
	<h4><?php echo lang('category:create_title') ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('category:edit_title'), isset($category)?htmlspecialchars_decode($category):"") ?></h4>
<?php
endif;?></section>
<section class="item">
	<div class="content">
<?php echo form_open_multipart()?>
<div class="tabs">
			<!-- Content tab -->
			<div class="form_inputs" id="category-content-tab">


				<div class="one_half">
					<fieldset>
						<ul>
							<li><label for="title"><?php echo lang('global:title') ?> <span>*</span></label>
								<div class="input"><?php echo form_input('title', isset($category)?htmlspecialchars_decode($category):"", 'maxlength="100" id="title"') ?></div>
							</li>





							<li><label for="status"><?php echo lang('category:status') ?></label>

								<div class="input">
								<?php echo form_dropdown('status', array(""=>lang(""), '1' => lang('category:active'),'0' => lang('category:inactive')), set_value("status",$status)) ?></div>


							</li>



						</ul>

					</fieldset>
				</div>

				<Div class="one_full">
					<fieldset>
						<ul>


							<li class="editor"><label for="body"><?php echo lang('category:description_lable') ?> <span>*</span></label><br>


								<div class="edit-content">
						<?php echo form_textarea(array('id' => 'body', 'name' => 'body', 'value' =>set_value("body",$description), 'rows' => 30, 'class' => "wysiwyg-advanced"))?>
					</div>
					</li>


							

						</ul>
					</fieldset>
				</div>
			</div>




		</div>

		

		<div class="buttons">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel')))?>
</div>

<?php echo form_close()?>

</div>
</section>