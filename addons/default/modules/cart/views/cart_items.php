<div class="container-fluid">
<?php if(!empty($items)):?>
	<?php foreach ($items as $item):?>
	<?php ?>
	<div class="row cartRowContent">
		<div class="col-xs-3 cart-thumb">
			<a href="<?php echo base_url('home/product/'.$item['id'])?>">
			<?php 
					$extra=$item['extra'];
					if($extra){
						$extra=unserialize($extra);
					}
					$first="";
					//echo "<pre>";
					//print_r($extra);die;
					if(!empty($extra['image'])):?>
						<?php $first=array_shift($extra['image']);?>
					<?php endif?>
			<img
				class="img-responsive thumbnail"
				src="<?php echo $first?>">
		</a>
		</div>
		<div class="col-xs-9 cart-cell">
			<i onclick="chkCart(delItem, '1');"
				class="fa fa-times pull-right text-danger"></i><?php echo $item['product']?> </br>
			<strong> <?php echo format_price($item['list_price'])?></strong><br>
			<strong> <?php echo lang("cart:quantity")?>:<?php echo ($item['quantity'])?></strong>
		</div>

		<div class="clearfix"></div>
		<hr>

	</div>
	<?php endforeach;?>
	<?php else:?>
	<div class="row cartRowContent fade in">
		<div class="collapse" id="showCartActivity" aria-expanded="false"
			style="height: 0px;"></div>
		<!-- This is used in sunfrog.js -->
		<div class="col-xs-3 cart-thumb">
			<img width="93" height="105" class="img-responsive thumbnail"
				src="/images/empty-cart-shirt.svg">
		</div>
		<div class="col-xs-7 cart-cell text-center">
			<br> <strong class="text-danger"> Your cart is empty! <br> Quick put
				a shirt in it!
			</strong>
		</div>

		<div class="clearfix"></div>
		<hr>


	</div>
	<?php endif?>
	<span id="p_co"></span>
</div>