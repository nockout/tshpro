<?php  echo $this->load->view('admin/create/script')?>
<section class="item">

<div class="row">
	<div  id="main-container" class="col-xs-8" >
	<div id="clothing-designer" class="fpd-shadow-1 clothing-designer-1">
		<?php echo $templates?>
		<div class="fpd-design"></div>
		<?php  //echo $this->load->view("admin/create/relateproduct")?>
	</div>
	
	</div>

	<?php  echo $this->load->view("admin/create/right")?>

 	<input type="file" id="design-upload" style="display: none;" />


<div class="hidden one_third">


	<!-- The form recreation -->
	
	<?php //$hiddens=array("base_64image"=>"","product_type"=>"")?>
	<?php // echo form_open("admin/tdesign/export","id='save_image'",$hiddens);?>

		
		
	
	<?php echo form_close()?>
</div>

</div>
</section>