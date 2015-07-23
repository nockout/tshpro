
<?php
if (isset ( $collections ) && count ( $collections ))
	$first_t = reset ( $collections );

?>

	<div id="neo">
			<div class="designContainer" id="printable" style="width:<?php echo $original->width ?>px;height:<?php echo $original->height ?>px">
				   <div id="imagesContainer"></div>
				<div class="text t designtext1 no-delete">
					<i class="icon-remove action text-error" data-action="remove"></i>
			<p></p>
			<i class="icon-edit action" data-action="fsontSize"></i>
		</div>       
			<?php if(isset($first_t)):?>
		<img id="Tshirtsrc" src="<?php echo get_image_path_temp($first_t["resize_image"])?>"
			alt="<?php echo ($first_t["file_name"])?>">				
			<?php else	:?>
			<img id="Tshirtsrc"
			src="<?php echo Asset::get_filepath_img("load-art.jpg")?>" alt="">
			<?php endif;	?>
			</div>
	<br/>


