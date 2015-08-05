<div style="padding-top:10px;" class="container">
		
			<h1 class="hidden-xs top_title"><?php echo $product->product?></h1> 
			<a class="artistlink hidden-xs" title="Click to see more designs by Fanbuild" href="/Fanbuild/"><i class="fa fa-user"></i> Fanbuild</a>

			<div style="margin-bottom:40px;" class="row">
				<div class="col-sm-7  ">
					<div class="productFrame">
						<span class="priceshow"><?php echo $product->list_price?></span>
					<!-- 	<img width="13" height="8" class="btm-s" src=""> -->
			
					<?php 
					$extra=$product->extra;
					if($extra){
						$extra=unserialize($extra);
					}
					//echo "<pre>";
					//print_r($extra);die;
					if(!empty($extra['image'])):?>
						<?php $first=array_shift($extra['image']);?>
				
						<a data-theimage="<?php echo array_shift($extra['image'])?>" data-target="#imageModal" data-toggle="modal">
							<img width="651" height="651" class="img-responsive lg_view" alt="<?php echo $product->product?>" src="<?php echo $first?>">
					
						</a>
					<?php endif?>
						
						
							<div class="label label-default pull-right">
								Shown On Sports Grey
							</div>
							<div class="clearfix"></div>
						
					</div>
					
					<div class="explain hidden-xs">
						<p><strong>Design Description:</strong></p>
						<p><?php echo $product->full_description?></p>
						<p>Shirt SKU: <?php echo $product->product_code?></p>
					</div>

				</div>
				<div class="col-sm-5  col-lg-4 col-lg-offset-1">
					
				
							
					<div class="clearfix"></div>
					
					
					
					<?php 
					 
					if(isset($relprd) && !empty($relprd)) : ?>
				<div style="margin-bottom: 25px;" class="form-group">
						<label for="Style">Style</label>
						<select onchange="location = this.options[this.selectedIndex].value;" class="form-control" name="shirtTypes" id="shirtTypes">
							<?php 
								foreach ($relprd as $rp):
							?>
							<option  value="<?php echo site_url("home/product/".$rp->product_id)?>"><?php echo $rp->product."-".$rp->list_price?></option>
							
							<?php endforeach;?>
									
							
							
						</select>
					</div>
					<?php endif;?>
				

					<div class="clearfix"></div>
					
					
				
					
					 <?php echo form_open('cart/add_to_cart', 'class="form-horizontal"');?>
							
						<input type="hidden" name="cartkey" value="<?php echo $this->session->flashdata('cartkey');?>" />
                   		<input type="hidden" name="id" value="<?php echo $product->product_id?>"/>
						<div class="form-group">
									<button class="btn btn-lg btn-block btn-xxl btn-success btn-bright  hidden-xs" name="submit" type="submit">Order &nbsp;&nbsp;<i class="fa fa-caret-right"></i></button>
								</div>
					<?php echo form_close()?>
					
					<div class="visible-xs">
					
						<h1>Jeb Bush 2016</h1>
						<a class="artistlink" title="Click to see more designs by Fanbuild" href="/Fanbuild/"><i class="fa fa-user"></i> Fanbuild</a>
						<p>For those voting and support Jeb Bush in the 2016 Presidential race!</p>

						<hr>
						
						<div data-url="https://www.sunfrog.com/Jeb-Bush-2016.html" data-bubbles="top" data-style="icons" class="don-share visible-xs don-bubble-top">
							<div class="don-share-facebook"><a title="Share on Facebook" target="_blank" href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Fwww.sunfrog.com%2FJeb-Bush-2016.html"><span class="don-btn don-btn-facebook don-btn-ico"><i class="don-ico-facebook"></i></span><span class="don-count">0</span></a></div>
							<div class="don-share-pinterest"><a title="Share on Pinterest" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=https%3A%2F%2Fwww.sunfrog.com%2FJeb-Bush-2016.html&amp;media=//images.sunfrogshirts.com/2015/07/29/Jeb-Bush-2016.jpg&amp;description=Jeb%20Bush%202016"><span class="don-btn don-btn-pinterest don-btn-ico"><i class="don-ico-pinterest"></i></span><span class="don-count">0</span></a></div>
							<div class="don-share-twitter"><a title="Share on Twitter" target="_blank" href="https://twitter.com/share?url=https%3A%2F%2Fwww.sunfrog.com%2FJeb-Bush-2016.html&amp;text=Jeb%20Bush%202016"><span class="don-btn don-btn-twitter don-btn-ico"><i class="don-ico-twitter"></i></span><span class="don-count">0</span></a></div>
							<div class="don-share-google"><a title="Share on Google+" target="_blank" href="https://plus.google.com/share?url=https%3A%2F%2Fwww.sunfrog.com%2FJeb-Bush-2016.html"><span class="don-btn don-btn-google don-btn-ico"><i class="don-ico-google"></i></span><span class="don-count">0</span></a></div>

						</div>
						
					</div>

					<div class="hidden-xs">
						
				

						<div class="clearfix"></div>		
						
						
						
						<br>
						<br>
						
				
						
						
					</div>
					
					<br>
					<div class="alt-bg alt-bg-pad visible-xs">
						
							<div class="col-xs-6">
								<a href="/returns/">
								<img width="296" height="66" class="img-responsive cen-sm" alt="100% Satisfaction Guaranteed!" src="/images/satisfaction.svg">							
								</a>	
							</div>
						
							<div class="col-xs-6">
								<img width="209" height="66" class="img-responsive cen-sm" alt="Printed in the USA" src="/images/printed-in-us.svg"> 
							</div>
						
						<div class="clearfix"></div>
					</div>
					<br>
				
			</div>
			
		</div>

	
	
	

			<?php //echo $this->load->view("alsolike")?>
		
		<div data-colorscheme="light" data-width="100%" data-order-by="reverse_time" data-numposts="5" data-href="https://www.sunfrog.com/Jeb-Bush-2016.html" class="fb-comments fb_iframe_widget fb_iframe_widget_fluid" fb-xfbml-state="rendered"><span style="height: 176px; width: 1140px;"><iframe id="f30ec97af312fbe" name="f1bd557df0de048" scrolling="no" style="border: medium none; overflow: hidden; height: 176px; width: 1140px;" title="Facebook Social Plugin" class="fb_ltr" src="https://www.facebook.com/plugins/comments.php?api_key=842113255878673&amp;channel_url=https%3A%2F%2Fs-static.ak.facebook.com%2Fconnect%2Fxd_arbiter%2F4B2NplaqNF3.js%3Fversion%3D41%23cb%3Df292d8b60a93854%26domain%3Dwww.sunfrog.com%26origin%3Dhttps%253A%252F%252Fwww.sunfrog.com%252Ff549dfdf42942%26relation%3Dparent.parent&amp;colorscheme=light&amp;href=https%3A%2F%2Fwww.sunfrog.com%2FJeb-Bush-2016.html&amp;locale=en_US&amp;numposts=5&amp;order_by=reverse_time&amp;sdk=joey&amp;skin=light&amp;version=v2.3&amp;width=100%25"></iframe></span></div>
	


<div style="height:130px;" class="visible-xs"><div class="clearfix"></div></div>



<span style="display: none;" id="productPagePull">Jeb-Bush-2016.html</span>
<span style="display: none;" id="productImgPull">2015/07/29/md_Jeb-Bush-2016.jpg</span>
<span style="display: none;" id="productTitlePull">Jeb Bush 2016</span>


</div>