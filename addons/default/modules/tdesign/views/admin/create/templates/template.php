
<?php if(isset($templates)&&count($templates)):?>
		<?php foreach ($templates as $key=>$cate):?>
		<?php echo "<pre>";print_r($cate);continue;?>
		<?php if(count($cate->templates)):?>
<div class="fpd-category" title="<?php echo $cate->name?>">
				<?php foreach ($cate->templates as $file):?>
						<?php
				
if (! ( $file->images ))
{
						continue;
}				?>
				
					<?php if(count($file->images)>1):?>
					<?php $link=array_shift($file->images)?>
								<div class="fpd-product" title="<?php echo $file->name?>"
								data-thumbnail="<?php echo $link?>">
								<img src="<?php echo $link?>" 
								title="<?php echo $file->name?>"
								data-parameters='{"x": 325, "y": 329,  "price": 20}' 
								/>
					
					<?php //print_r($file->images);die;?>
						<?php foreach ($file->images as $image):?>
								<div class="fpd-product" 
								title="<?php echo $file->name?>"
								data-thumbnail="<?php echo $image?>" >
								<img src="<?php echo $image?>" 
								title="<?php echo $file->name?> "
								data-parameters='{"x": 325, "y": 329,  "price": 20}' 
								/>

								</div>
						<?php endforeach;?>
						
						
								</div>
				
				<?php else:?>
						<?php $link1=reset($file->images)?>
								<div class="fpd-product" 
								title="<?php echo $file->name?>"
								data-thumbnail="<?php echo $link1?>">
								<img src="<?php echo $link1?>" 
								title="<?php echo $file->name?>"
								data-parameters='{"x": 325, "y": 329,  "price": 20}' 
								/>



							</div>
				<?php endif;?>				
<?php endforeach;?>
			</div>

<?php endif?>
<?php endforeach;?>
			
	
<?php endif?>