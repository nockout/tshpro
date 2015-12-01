<?php //echo "<pre>"; print_r($products);die;?>


	<?php if(!empty($products)):?>
	<table id="productlist" class="table">
		
			<?php foreach ($products as $key=>$product):?>
				<?php if(empty($product->images)) continue;
					$imgs=$product->images;
					if(empty($imgs['FRONT'][0])) continue;
				?>
				
				<tr class="alt <?php if($key==0) echo "active"?>">
					<td>
					<h5><?php echo $product->name?></h5>
					
					<?php //4i?>
					<img class="front thump"  src="<?php echo $imgs['FRONT'][0]?>"/>
					<img class="back thump hidden" width="30px" height="30px" src="<?php echo !empty($imgs['BACK'][0])?$imgs['BACK'][0]:""?>"/>
						<span5><?php echo format_price($product->price)?></span>
					</td>
				</tr>
			
			<?php endforeach;?>
	</table>
	<p></p>
	<?php endif?>



<style>

</style>