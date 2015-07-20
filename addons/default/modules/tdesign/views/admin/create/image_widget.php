
	<div class="widget">
		<div class="widget-header">
			<i class="icon-star"></i>
			<h3><?php echo lang("design:image_options") ?></h3>
		</div>
		<div class="widget-content">
		
				<?php echo form_open_multipart("admin/tdesign/create/upload_template");?>
				<h5>

				<i class="icon-picture"></i> <?php echo lang("design:upload_template")?>
				</h5>
			<div class="input-append customfile">
				<input id="add_template" style="float: left" type="text"
					placeholder="<?php echo lang("design:add_template_here")?>" aria-hidden="true"
					class="customfile-feedback span8">
				<button type="submit" value="Upload" aria-hidden="true"
					class="upload-button" style="float: left;">Upload</button>
			</div>
			<input type="file" id="img_uploadTemplate" class="hidden span8 "
				name="img_uploadTemplate" />

			<hr>
				<?php echo form_close()?>
				
		
			<?php if(isset($collections)&&count($collections)):?>		
			<h5>
				<i class="icon-picture"></i> <?php echo lang("design:add_mockup")?>
					</h5>
			<input type="file" id="imgInp" class="span8" name="file" />
			<hr>
			<h5>
				<i class="icon-tags"></i> <?php echo lang("design:collections")?>
					</h5>
			<ul class="tshirts unstyled clearfix">
			<?php foreach ($collections as $file):?>
				<li><a href="#" data-toggle="tooltip" data-placement="bottom"
					title='<?php echo $file["file_name"]?>'> <img
						src="<?php echo  get_image_path_temp($file["resize_image"])?>"
						alt="<?php echo $file["file_name"]?>">
				</a></li>
				<?php endforeach;?>
			</ul>
			<hr>
				<?php endif;?>
				
						<h5>
				<i class="icon-cog"></i> <?php echo lang("design:help")?>
					</h5>
			<p class="help">
				<span class="badge badge-info"><i class="icon-edit"></i></span> :
						<?php echo lang("design:text_help")?> <br> <span
					class="badge badge-info"><i class="icon-remove"></i></span>:
						<?php echo lang("design:remove_text_help")?>  <br> <span
					class="badge badge-info"><span
					class="ui-icon ui-icon-white ui-icon-gripsmall-diagonal-se"></span></span>:
						<?php echo lang("design:text_resize_image")?> 
					</p>
		</div>
	</div>

<script>





	$("#add_template").click(function(){
		document.getElementById("img_uploadTemplate").click();
		});
	$("#img_uploadTemplate").change(function(){
		var filename = $('#img_uploadTemplate').val().replace(/C:\\fakepath\\/i, '')
		$("#add_template").val(filename);

		});
	

</script>
