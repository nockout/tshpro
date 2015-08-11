<?php 	if(!empty($products)):?>
<?php 

		foreach ($products as $p):?>
			
				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
					<div class="frameitWrapper">
						<div class="price">					
							
								<strong><?php echo format_price($p->list_price)?></strong>			
										 	<?php echo Asset::img("leftpsm.png","",$attr = array( "class"=>"btm-s", "width"=>"3", "height"=>"6"));?>
							
						</div>
						<div class="frameit">
							<a href="<?php echo base_url($p->slugurl)?>" border="0">
							<?php if($p->extra):
							    $image= unserialize($p->extra);
							  
							?>
							<div class="frontThumb">
								<img style="display: block;" src="<?php echo isset($image['image'][0]) ? $image['image'][0]:''?>" data-original="<?php echo isset($image['image'][0]) ? $image['image'][0]:''?>"
								 class="img-responsive lazy" alt="<?php echo $p->product?>" title="<?php echo $p->product?>" height="391" width="391">
								

							</div>
							
							<?php endif;?>
								</a>
							
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<strong style="font-size:12px;" class="text-info"><?php echo $p->product?></strong>
							</div>
						</div>
						
					</div>
				</div>
		
			
	<?php endforeach; ?>			
<?php endif?>