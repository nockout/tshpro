<?php  echo $this->load->view('admin/create/script') ?>
<div id="main-container" class="container">
	<div id="clothing-designer" class="fpd-shadow-1 clothing-designer-1">
		<?php echo $templates?>
		<div class="fpd-design">
			
		</div>
	</div>
	<br />
	
		
				<button class="" id="export"  class="">EXPORT</button>
				<button class="" id="test"  class="">test</button>
		
	</div>
	
	<!-- The form recreation -->
	
	<?php $hiddens=array("base_64image"=>"","product_type"=>"")?>
	<?php echo form_open("admin/tdesign/export","id='save_image'",$hiddens);?>
		
		
	
	<?php echo form_close()?>
</div>

