
<div class="col-xs-3 fpd-clearfix fpd-show-up one_half">
	<section class="fpd-main-bar fpd-clearfix fpd-primary-bg-color">
		<!-- Left -->
		<div class="fpd-left">
			<div data-context="layers" class="fpd-btn fpd-primary-text-color"
				style="display: inline-block;">
				<i class="fpd-icon-layers"></i><span><?php echo lang("design:style")?></span>
			</div>

		</div>

		<!-- Right -->

	</section>
	<section class="fpd-main-container">
		<div class="fpd-content-products" style="display: block; heigh: 600px">
			
		<?php echo form_open("admin/tdesign/save_images","id='save_image'");?>
				<fieldset>
					<table id="yourdesigns"  class="table-list" cellspacing="0" border="0">
					
					</table>
						
						
				
				</fieldset>
				<div class="buttons float-right padding-top">
				<button type="button" class="" id="putinconllection" ><?php echo lang("design:apply_this_style")?></button> 
 				<button type="button" class="" id="export" ><?php echo lang("design:save_all_design")?></button> 
				
				</div>
				<?php if(isset($art_id)):?>
					<input type="hidden" name="art_id" value="<?php echo $art_id?>">
				<?php endif;?>
				<div id="slider"></div>
				<?php echo  form_close()?>
			</div>
		





	

	</section>
	<div class="fpd-left"></div>
</div>
