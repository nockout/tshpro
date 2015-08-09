<?php  echo $this->load->view('admin/create/script')?>
<section class="">

	<div class="row">
		<div id="main-container" class="col-xs-8">
			<div id="clothing-designer" class="fpd-shadow-1 clothing-designer-1">
		<?php echo $templates?>
		<div class="fpd-design"></div>
		<?php  //echo $this->load->view("admin/create/relateproduct")?>
	</div>
		</div>
	<?php  echo $this->load->view("admin/create/right")?>
 	<input type="file" id="design-upload" style="display: none;" />
		<div class="hidden one_third"></div>

	</div>
</section>