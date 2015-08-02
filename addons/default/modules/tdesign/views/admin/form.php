<section class="title">
<?php if ($this->method == 'create'): ?>
	<h4><?php echo lang('design:create_title') ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('design:edit_title'), isset($product)?htmlspecialchars_decode($product):"") ?></h4>
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
		<?php //if(isset($arts)):?>
			<?php //foreach ($arts as $art):?>
			
			<!-- <img alt="" src="<?php //echo $art?>"> -->
			<?php //endforeach;?>
		
		<?php //endif?>
		<div class="clearfix"></div>	
		<?php if(!empty($images)):?>
		<?php //echo $images;die;?>
		<?php $image=array_shift($images);?>
		
		<img style="width:320px;heith:320px" data-pyroimage="true" alt="your art" src="<?php echo isset($image)?$image:""?>" id="target">
	
		<?php foreach ($images as $img):?>
		<img style="width:90px;heith:320px" data-pyroimage="true" alt="your art" src="<?php echo isset($img)?$img:""?>" id="target">
		<?php endforeach;?>
		<?php else:?>
		<img style="width:90px;heith:90px"  alt="your art" src="<?php echo Asset::get_filepath_img("load-art.jpg")?>" id="target">
		<?php endif?>
		</fieldset>
		</div>
			
		<div class="one_half">
			<fieldset>
			<ul>
				<li>
					<label for="title"><?php echo lang('global:title') ?> <span>*</span></label>
					<div class="input"><?php echo form_input('title', isset($product)?htmlspecialchars_decode($product):"", 'maxlength="100" id="title"') ?></div>
				</li>
	
				
				<li>

					<label for="category_id"><?php echo lang('design:category_label') ?></label>
					<div class="input">
					<?php echo form_dropdown('category_id', array(lang('design:no_category_select_label')) + $categories, @cate_id) ?>
	
					</div>
				</li>
					<li>
					<label for="price"><?php echo lang('design:price') ?> </label>
					<div class="input"><?php echo form_input('list_price', set_value("list_price",$list_price), 'maxlength="100" id="price"') ?></div>
				</li>
				
				<li>
					<label for="status"><?php echo lang('design:status_label') ?></label>
					
					<div class="input">
					<?php echo form_dropdown('status', array(""=>lang(""), 'A' => lang('design:status_A_label'),'D' => lang('design:status_D_label')), set_value("status",$status)) ?></div>
				
					
				</li>
				<li class="date-meta">
					<label><?php echo lang('design:date_label') ?></label>
	
					<div class="input datetime_input">
						<?php echo form_input('created_on', date('Y-m-d', strtotime($avail_since)), 'maxlength="10" id="datepicker" class="text width-20"') ?> &nbsp;
						<?php //echo form_dropdown('created_on_hour', $hours, date('H',strtotime($avail_since))) ?> :
						<?php //echo form_dropdown('created_on_minute', $minutes, date('i', ltrim(strtotime($avail_since), '0'))) ?>
					</div>
				</li>
				

				</ul>
		
	</fieldset>
		</div>
		
		<Div class="one_full">
		<fieldset>
		<ul>
				
		
				<li class="editor">
					<label for="body"><?php echo lang('design:description_label') ?> <span>*</span></label><br>
					
	
					<div class="edit-content">
						<?php echo form_textarea(array('id' => 'body', 'name' => 'body', 'value' =>isset($full_description)?htmlspecialchars_decode($full_description):"", 'rows' => 30, 'class' => "wysiwyg-advanced")) ?>
					</div>
				</li>
			
				
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