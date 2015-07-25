<section class="title">
<?php if (empty($mockup_id)): ?>
	<h4><?php echo lang('mockup:create_title') ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('mockup:edit_title'), isset($name)?htmlspecialchars_decode($name):"") ?></h4>
<?php endif;?>

</section>
<section class="item">
	<div class="content">


<div class="tabs">

			<ul class="tab-menu">
				<li><a href="#information"><span><?php echo lang('mockup:information') ?></span></a></li>
				<li><a href="#combinations"><span><?php echo lang('mockup:combinations') ?></span></a></li>
				<li><a href="#images"><span><?php echo lang('mockup:images') ?></span></a></li>
			</ul>

			<!-- Content tab -->
			<div class="form_inputs" id="information">
			<?php echo form_open_multipart()?>
				<div class="one_half">
					<fieldset>
						<ul>
							<li><label for="title"><?php echo lang('global:title') ?> <span>*</span></label>
								<div class="input"><?php echo form_input('title', set_value('title',$title), 'maxlength="100" id="title"') ?></div>
							</li>
							<li><label for="price"><?php echo lang('mockup:mockup_price') ?> <span>*</span></label>
								<div class="input"><?php echo form_input('price', set_value('price',$price), 'maxlength="100" id="price"') ?></div>
							</li>
							<li><label for="category_id"><?php echo lang('mockup:category_label') ?></label>
								<div class="input">
					<?php echo form_dropdown('category_id', array(lang('mockup:no_category_select_label')) + $categories,set_value('category_id',@cate_id) ) ?>	
					</div></li>


							<li><label for="status"><?php echo lang('mockup:status') ?></label>

								<div class="input"><?php echo form_dropdown('status', array(""=>lang(""), 'A' => lang('mockup:active'),'D' => lang('mockup:inactive'), set_value("status",$status))) ?></div>


							</li>
							


						</ul>

					</fieldset>
				</div>
			<?php echo form_close()?>
			</div>

			<div class="form_inputs" id="combinations">
			<?php if(!$mockup_id):?>
				<div class="one_full">
					<fieldset>
						<div class="block-message warning"><?php echo lang("mockup:save_product_before_add_combinations")?></div>
					</fieldset>
				</div>
			
			<?php else:?>
			<?php  $this->load->view("admin/combinations")?>
			<?php endif?>
			</div>
			<div class="form_inputs" id="images">
					<?php if(!$mockup_id):?>
							<div class="one_full">
								<fieldset>
								<div class="block-message warning"><?php echo lang("mockup:save_product_before_add_image")?></div>
								</fieldset>
								</div>
								<?php else:?>
						<?php // $this->load->view("admin/images",array(),true)?>
				
					<?php endif;?>
				</div>


		</div>

		<input type="hidden" name="row_edit_id"
			value="<?php if ($this->method != 'create'): echo $mockup_id; endif; ?>" />

		<div class="buttons">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel')))?>
</div>



</div>
</section>