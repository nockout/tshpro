<?php $pFront=$pFront1=$pBack=$pBack1=array('x'=>325,'y'=>329)?>
<?php if(isset($templates)&&count($templates)):?>
<?php foreach ($templates as $t):?>
		<?php if(empty($t->images)) 
			
			continue;?>
		
					
							<?php  $name=$t->id_template;?>
						
								<?php  
							$pFront["price"]=number_format($t->price, 2, ',', ' ');
							
								//$pFront1["price"]=$t->price;?>
			<?php 
			// print_r($t->colors_groups);die;
			// $color =unserialize($t->colors_groups);
			/* if(!empty($color)){
				//echo "Aaa";die;
				$pFront['colors']=implode(",", $color);
				$pBack['colors']=$name;
			} */
			$pFront['options']=array("max_price"=>10000);
			$jsonFront=json_encode($pFront);
			$jsonFront1=json_encode($pFront1);
			$jsonBack=json_encode($pBack);
			$jsonBack1=json_encode($pBack1);
			$FRONT=array_shift($t->images);
			$first_layer=array_shift($FRONT);
			?>
			<div id="template_<?php echo $t->id_template?>" data='<?php echo json_encode(array("name"=>$name,'max_price'=>$t->price_max,"id_template"=>$t->id_template))?>'  class="fpd-product fpd-shadow-1" title="<?php echo $name?>" data-thumbnail="<?php echo $first_layer?>">
	    			 
	    			<img src="<?php echo $first_layer?>" title="<?php echo $name?>" data-parameters='<?php echo $jsonFront?>' />
			  		<?php if(!empty($FRONT)):?>
			  		
			  			<?php foreach ($FRONT as $file):?>
			  						<img src="<?php echo $file?>" title="<?php echo $name?>" data-parameters='<?php echo $jsonFront1?>' />
			  			<?php endforeach;?>
			  		<?php endif?>
			  	
			  			<?php foreach ($t->images as $remain_images):?>
			  				<?php $first_back=array_shift($remain_images)?>
			  				<?php // print_r($remain_images);die;?>
			  				<div class="fpd-product" title="<?php echo $name?>" data-thumbnail="<?php  echo $first_back?>">
		    					<img src="<?php echo $first_back?>" title="<?php echo $name?>" data-parameters='<?php echo $jsonBack?>' />
		    							<?php if(!empty($remain_images)):?>
		    								<?php foreach ($remain_images as $r):?>
		    								<img src="<?php echo $r?>" title="<?php echo $name?>" data-parameters='<?php echo $jsonBack1?>' />
		    								<?php endforeach;?>
		    					
		    							<?php endif?>
							</div>	
						<?php endforeach;?>
			</div>
<?php endforeach;?>
<?php endif?>
