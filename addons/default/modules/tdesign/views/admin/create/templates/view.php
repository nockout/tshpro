<?php $json_ar=$json_ar1=array('x'=>325,'y'=>329,'price'=>0)?>
<?php //echo "<pre>" print_r($views);die;?>
<?php if(isset($templates)&&count($templates)):?>
<?php foreach ($templates as $t):?>
		<?php if(empty($t->images)) 
			
			continue;?>
		
					
							<?php  $name=$t->name;?>
						
								<?php  
								$json_ar["price"]=$t->price;
								$json_ar1["price"]=$t->price;?>
			<?php if(!empty($t->colors_groups)){
				//echo "Aaa";die;
				$json_ar['colors']=implode(",", unserialize($t->colors_groups));
				
			}
			$json=json_encode($json_ar);
			$json1=json_encode($json_ar1);
			$FRONT=array_shift($t->images);
			$first_layer=array_shift($FRONT);
	//		echo "<pre>";
// 			print_r($t->images);die;
			?>
			<div class="fpd-product" title="<?php echo $name?>" data-thumbnail="<?php echo $first_layer?>">
	    			<img src="<?php echo $first_layer?>" title="<?php echo $name?>" data-parameters='<?php echo $json?>' />
			  		<?php if(!empty($FRONT)):?>
			  		
			  			<?php foreach ($FRONT as $file):?>
			  						<img src="<?php echo $file?>" title="Base" data-parameters='<?php echo $json1?>' />
			  			<?php endforeach;?>
			  		<?php endif?>
			  	
			  			<?php foreach ($t->images as $remain_images):?>
			  				<?php $first_back=array_shift($remain_images)?>
			  				<?php // print_r($remain_images);die;?>
			  				<div class="fpd-product" title="<?php echo $name?>" data-thumbnail="<?php  echo $first_back?>">
		    					<img src="<?php echo $first_back?>" title="<?php echo $name?>" data-parameters='<?php echo $json?>' />
		    							<?php if(!empty($remain_images)):?>
		    								<?php foreach ($remain_images as $r):?>
		    								<img src="<?php echo $r?>" title="<?php echo $name?>" data-parameters='<?php echo $json1?>' />
		    								<?php endforeach;?>
		    					
		    							<?php endif?>
							</div>	
						<?php endforeach;?>
			</div>
		
			
			
		
		
<?php endforeach;?>
<?php endif?>
