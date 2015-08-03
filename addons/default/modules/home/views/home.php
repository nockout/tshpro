	<?php 
	if($products)
	foreach ($products as $p):?>
			<form name="sendtocollection" method="post" action="/AddtoGo.cfm">
				<input name="mockupID" value="59650813" type="hidden">
				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
					<div class="frameitWrapper">
						<div class="price">					
							
								<strong>$<?php echo $p->list_price?></strong>			
							
							<img src="/images/leftpsm.png" class="leftp" height="3" width="6">
						</div>
						<div class="frameit">
							<a href="<?php echo base_url("tdesign/index/$p->product_id")?>" border="0">
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
			</form>
			
	<?php endforeach; ?>			
