
<div class="col-xs-3 fpd-clearfix fpd-show-up one_half">
	<section class="fpd-main-bar fpd-clearfix fpd-primary-bg-color">
		<!-- Left -->
		<div class="fpd-left">
			<div data-context="layers" class="fpd-btn fpd-primary-text-color"
				style="display: inline-block;">
				<i class="fpd-icon-layers"></i><span>Your Designs</span>
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
				<button type="button" class="" id="putinconllection" class="">Save </button> 
 				<button class="" id="export" class="">EXPORT</button> 
				
				</div>
				<?php echo  form_close()?>
			</div>
		





	

	</section>
	<div class="fpd-left"></div>
</div>
