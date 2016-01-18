
	<h1 class="hidden-xs top_title"><?php echo $product->product?></h1>
	<div style="margin-bottom: 40px;" class="row">
		<div class="col-sm-7  ">
			<div class="productFrame">
				<span class="priceshow"><?php echo format_price($product->price)?></span>
			 	<?php echo Asset::img("tag-btm.png","",$attr = array( "class"=>"btm-s", "width"=>"13", "height"=>"8"));?>
			
					<?php
					$extra = $product->extra;
					if ($extra) {
						$extra = unserialize ( $extra );
					}
					if (! empty ( $extra ['image'] )) :
						?>
						<?php $first=array_shift($extra['image']);?>
				
						<a data-theimage="<?php echo array_shift($extra['image'])?>"
					data-target="#imageModal" data-toggle="modal">
					 <img width="651"
					height="651" class="img-responsive lg_view"
					alt="<?php echo $product->product?>" src="<?php echo $first?>">

				</a>
					<?php endif?>
						
						
							<div class="label label-default pull-right">Shown On Sports Grey
				</div>
				<div class="clearfix"></div>

			</div>
			<?php if(!empty($user)):?>
			<a class="artistlink hidden-xs"
				title="Click to see more designs by 1miliondollar"
				href="<?php echo site_url($user->username)?>">
				<button class="btn btn-default" type="button">
					<i class="fa fa-user"></i> Designer: <strong><?php echo $user->username?></strong>
				</button>
			</a>
			<?php endif?>
			<div class="explain hidden-xs">
				<p>
					<strong><?php echo lang('product:description')?></strong>
				</p>
				<p><?php echo $product->full_description?></p>
				<p>SKU: <?php echo $product->product_code?></p>
			</div>

		</div>
		<div class="col-sm-5  col-lg-4 col-lg-offset-1">



			<div class="clearfix"></div>

<?php echo form_open('cart/ajax_add_to_cart', 'id="ajax_cart" class="form-horizontal"');?>
			<div class="form-group">
					<?php
					
					if (isset ( $relprd ) && ! empty ( $relprd )) :
						?>

				
					<label for="Style"><?php echo lang("product:style")?></label> <select
					onchange="location = this.options[this.selectedIndex].value;"
					class="form-control" name="shirtTypes" id="shirtTypes">
							<?php
						foreach ( $relprd as $rp ) :
							?>
							
							<option
						<?php if($rp->product_id==$product->product_id) echo 'selected=""'?>
						value="<?php echo site_url("home/product/".$rp->product_id)?>"><?php echo $rp->product."-".$rp->price?></option>
							
							<?php endforeach;?>
									
							
							
						</select>
				
				
					<?php endif;?>
				
						</div>
			<div class="clearfix"></div>

			<div class="form-group">

				<label for="Style"><?php echo lang("product:quantity")?></label> <select
					class="form-control" name="quantity" id="">
							<?php for( $i=1; $i<=30; $i++):?>
							<option value="<?php echo $i;?>"><?php echo $i?></option>
							<?php endfor;?>	
					</select>

				<button
					style="background: none; border: none; text-align: left; padding: 8px 0px 8px 0px;"
					class=" text-primary" data-target="#sizeModal" type="button"
					data-toggle="modal">Sizing Chart</button>


				<div id="popsize" data-placement="top" data-toggle="popover"
					class="size-select" aria-describedby="">
				
				<?php $siszeSelected=$this->session->userdata("sizeSelected")?>
					<div data-toggle="buttons" class="btn-group">


						<label
							class="picksize <?php if($siszeSelected=="S"): ?> active <?php endif ?> btn btn-default"
							for="S"> <input type="radio" value="S" autocomplete="off"
							data-se="0" name="size" id="S">S
						</label> <label
							class=" picksize <?php if($siszeSelected=="M"): ?> active <?php endif ?> btn btn-default "
							for="M"> <input type="radio" value="M" autocomplete="off"
							data-se="0" name="size" id="M">M
						</label> <label
							class="picksize <?php if($siszeSelected=="L"): ?> active <?php endif ?> btn btn-default"
							for="L"> <input type="radio" value="L" autocomplete="off"
							data-se="0" name="size" id="L">L
						</label> <label
							class="picksize <?php if($siszeSelected=="XL"): ?> active <?php endif ?> btn btn-default"
							for="XL"> <input type="radio" value="XL" autocomplete="off"
							data-se="0" name="size" id="XL">XL
						</label> <label
							class="picksize <?php if($siszeSelected=="XXL"): ?> active <?php endif ?> btn btn-default"
							data-placement="top" for="XXL"> <input type="radio" value="XXL"
							data-se="1" name="size" id="XXL">2X
						</label> <label
							class="picksize <?php if($siszeSelected=="XXXL"): ?> active <?php endif ?> btn btn-default"
							data-placement="top" for="XXXL"> <input type="radio" value="XXXL"
							data-se="1" name="size" id="XXXL">3X
						</label> <label
							class="picksize <?php if($siszeSelected=="XXXXL"): ?> active <?php endif ?> btn btn-default"
							data-placement="top" for="XXXXL"> <input type="radio"
							value="XXXXL" data-se="1" name="size" id="XXXXL">4X
						</label>


					</div>

				</div>
				<?php
					
					if (isset ( $relprd ) && ! empty ( $relprd )) :
						?>
						<button
					style="background: none; border: none; text-align: left; padding: 8px 0px 8px 0px;"
					class=" text-primary" data-target="#sizeModal" type="button"
					data-toggle="modal"><?php echo lang("global:color")?></button>
			<div id="popcolor" data-placement="top" 
					class="size-select" aria-describedby="">
					<div class="btn-group">
					<?php foreach ($relprd as $rs):?>
				
							<a href="<?php echo product_url_rewrite($rs->slugurl,$rs->product_id)?>" class=" btn btn-default"  style=";background-color: <?php echo $rs->color?>" ">&nbsp;</a>
						
					<?php endforeach;?>
					</div>
						
				</div>
				<?php endif?>
			</div>


			<div class="form-group">


				<input id="sizeSelected" type="hidden"
					value="<?php echo $siszeSelected ?>" name="sizeSelected"> <input
					type="hidden" name="cartkey"
					value="<?php echo $this->session->flashdata('cartkey');?>" /> <input
					type="hidden" name="id" value="<?php echo $product->product_id?>" />

				<button
					class="btn btn-lg btn-block btn-xxl btn-success btn-bright  hidden-xs"
					name="submit" type="submit">
									<?php echo lang("add_to_cart")?> 
									<i class="glyphicon glyphicon-triangle-right"></i>
				</button>


			</div>
					<?php echo form_close()?>
			


			<br>
			
			<br>

		</div>

	</div>

	
	
	

			<?php //echo $this->load->view("alsolike")?>
		
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=1636047256649849";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-comments" data-href="<?php echo current_url();;?>" data-numposts="5"></div>

			</div>
		</div>



	<div style="height: 130px;" class="visible-xs">
		<div class="clearfix"></div>
	</div>




