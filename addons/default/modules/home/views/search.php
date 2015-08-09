<h1><?php echo $title?></h1>
<hr>
<?php if(!empty($products)):?>
<?php echo $this->load->view("listproduct",array("products"=>$products),true)?>
<?php else:?>
<div class="row">
	
		<div class="col-md-12"></div>
			
</div>
<?php endif?>