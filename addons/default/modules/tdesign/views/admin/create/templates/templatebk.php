
<?php 
$new_templates=array();
if(isset($templates)&&count($templates))
{
		foreach ($templates as $key=>$folder){
			
			$new_templates[$key]=array();
				foreach ($folder as $file){
					if(preg_match("/_BACK/", $file->name))
					{	
							continue;
					}
					if($back=find_item_back($folder,$file->name,$file->extension)){
						$file->back=$back;
					}
					$new_templates[$key][]=$file;
				}
			
		}	

}


	?>
<?php function find_item_back(&$items,$name="",$extension=""){
	
	if(!$name&&$extension)
		return;
	
	$split=explode(".", $name);
	
	if(empty($split))
		return;
	$splitname=$split[0];
	
	$file_pattern=$splitname.'_BACK'.$extension;
	foreach ($items as $key=> $t){

		if($file_pattern== $t->name){
			$temp=$t;
			unset($t);
			return $temp;
			
		}
	}
	return ;

}?>

<?php if(isset($new_templates)&&count($new_templates)):?>
		<?php foreach ($new_templates as $key=>$t):?>
		<?php if(count($t)):?>
			<div class="fpd-category" title="<?php echo $key?>">
				<?php foreach ($t as $file):?>
				<?php $name=$file->name?>
					<div class="fpd-product" title="<?php echo $file->name?>"
						data-thumbnail="<?php echo $file->link?>">
						<img src="<?php echo $file->link?>" title="<?php echo $file->name?>" data-parameters='{"x": 325, "y": 329, "colors":  "#D5D5D5,#990000,#cccccc" , "price": 20}' />
						
					<?php 
					
				
					?>
					
						<?php if(isset($file->back)):?>
							<?php $back=$file->back?>
								<div class="fpd-product" title="<?php echo $back->name?>" data-thumbnail="<?php echo $back->link?>">
								<img src="<?php echo $back->link?>" title="<?php echo $back->name?>" data-parameters='{"x": 325, "y": 329,"colors": "#D5D5D5,#990000,#cccccc" ,  "price": 20}'  />
		    					
								</div>
						
						<?php endif;?>
					</div>
				<?php endforeach;?>
			</div>
		
		<?php endif?>
<?php endforeach;?>
			
	
<?php endif?>


