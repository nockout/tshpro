<div class="col-xs-3 fpd-clearfix fpd-show-up">
	<section class="fpd-main-bar fpd-clearfix fpd-primary-bg-color">

		<!-- Left -->
		<div class="fpd-left">
			<div data-context="layers" class="fpd-btn fpd-primary-text-color"
				style="display: inline-block;">
				<i class="fpd-icon-layers"></i><span>Style & design</span>
			</div>

		</div>

		<!-- Right -->

	</section>
	<section class="fpd-main-container">
		<div class="fpd-content-products" style="display: block;heigh:600px">
			<div class="fpd-content-head">
				<?php if(isset($template_categories)):?>
				
				<select style=" width: 100%;" autoselect="off" id="fbd-category-modify" class="skip fbd-category-modify" tabindex="-1">
					<?php foreach ($template_categories as $key=>$cate):?>
						<?php if(count($cate->templates)):?>
						<option value="<?php echo $cate->id_category?>"><?php echo $cate->name?></option>
						<?php endif?>
					<?php endforeach;?>
				</select> 
				<?php endif ;?>
				
			</div>
			<?php if(isset($template_categories)):?>
				<?php foreach ($template_categories as $key=>$cate):?>
				<div id="tempcate<?php echo $cate->id_category?>" style="display: none" >
					<?php foreach ($cate->templates as $file):?>
					
							<?php if(empty($file->images)) continue;?>
								<div class="fpd-grid fpd-grid-contain fpd-padding fpd-dynamic-columns">
								<?php foreach ($file->images as $image):?>
									<div class="fpd-product fpd-item fpd-tooltip" 
								title="<?php echo $file->name?>"
								data-thumbnail="<?php echo $image?>" >
								<picture class="img-product" style="diplay:block;bottom: 10px;
left: 20px;    right: 20px;top: 10px; background-size: contain; background-image: url('<?php echo $image?>')" 
								title="<?php echo $file->name?> "
								data-parameters='{"x": 325, "y": 329,  "price": 20}' 
								/></picture>

								</div>
								<?php endforeach;?>
								</div>
						<?php endforeach;?>
				
				
					
				</div>
				<?php endforeach;?>
				<?php endif?>
				
				
				
			<div class="fpd-content-body" style="box-sizing: border-box;border: 1px solid #efefef;    height: 640px;">
			
			</div>
			
			<div class="" style="overflow: visible;"></div>
		</div>


	</section>
	<div class="fpd-left"></div>
</div>