<?php if(empty($templates)):?>


<?php else:?>
<section id="typography">
	<!-- Headings & Paragraph Copy -->
	<div class="row">
		<div class="span3">
			<div class="tabbable">
				<!-- Only required for left/right tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab1" data-toggle="tab">T-Shirt
							Options</a></li>
					<li><a href="#tab2" data-toggle="tab">Gravatar</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="well">
							<h3>Style & design</h3>
							<select  id="category">
							<?php $currentCate=""?>
						<?php foreach ($templates as $key=>$cate):?>
								<option value="<?php echo $cate->category_id?>" <?php if($key==0) {echo 'selected';$currentCate=$cate;}?>><?php echo $cate->category?></option>
						<?php endforeach;?>
							</select>
						</div>
						<div class="well" id="template">
						<?php echo $this->load->view('admin/create/styles',array('products'=>$currentCate->templates,'title'=>$currentCate->category))?>
						</div>
					</div>
					<div class="tab-pane" id="tab2">
						<div class="well">
							<div class="input-append">
								<input class="span2" id="text-string" type="text"
									placeholder="add text here...">
								<button id="add-text" class="btn" title="Add text"
									style="margin: 0">
									<i class="icon-share-alt"></i>
								</button>
								<hr>
							</div>
						<div id="avatarlist">
							<?php echo form_open(site_url('admin/artist/upload/'),"id='upload_art'")?>
								<div data-reactid=".5.1.0" class="control-group design-area-art-upload" id="dropbox">
					
										<div class="img-drop">

					           		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					                        
					                    </span>
					                    </div>
								 		 <span class="btn btn-large btn-block btn-success btn-file" style="width: 100%;height:100%;position: relative;">
											 Click here to upload<input type="file" multiple="" accept="image/*">
										</span>
								</div>
								<?php echo form_close()?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="span6">
			<div align="center" style="min-height: 32px;">
				<div class="clearfix">
					<div class="btn-group inline pull-left" id="texteditor"
						style="display: none">
						<button id="font-family" class="btn dropdown-toggle"
							data-toggle="dropdown" title="Font Style">
							<i class="icon-font" style="width: 19px; height: 19px;"></i>
						</button>
						<ul class="dropdown-menu" role="menu"
							aria-labelledby="font-family-X">
							<li><a tabindex="-1" href="#" onclick="setFont('Arial');"
								class="Arial">Arial</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Helvetica');"
								class="Helvetica">Helvetica</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Myriad Pro');"
								class="MyriadPro">Myriad Pro</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Delicious');"
								class="Delicious">Delicious</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Verdana');"
								class="Verdana">Verdana</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Georgia');"
								class="Georgia">Georgia</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Courier');"
								class="Courier">Courier</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Comic Sans MS');"
								class="ComicSansMS">Comic Sans MS</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Impact');"
								class="Impact">Impact</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Monaco');"
								class="Monaco">Monaco</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Optima');"
								class="Optima">Optima</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Hoefler Text');"
								class="Hoefler Text">Hoefler Text</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Plaster');"
								class="Plaster">Plaster</a></li>
							<li><a tabindex="-1" href="#" onclick="setFont('Engagement');"
								class="Engagement">Engagement</a></li>
						</ul>
						<button id="text-bold" class="btn" data-original-title="Bold">
							<img src="img/font_bold.png" height="" width="">
						</button>
						<button id="text-italic" class="btn" data-original-title="Italic">
							<img src="img/font_italic.png" height="" width="">
						</button>
						<button id="text-strike" class="btn" title="Strike" style="">
							<img src="img/font_strikethrough.png" height="" width="">
						</button>
						<button id="text-underline" class="btn" title="Underline" style="">
							<img src="img/font_underline.png">
						</button>
						<a class="btn" href="#" rel="tooltip" data-placement="top"
							data-original-title="Font Color"><input type="hidden"
							id="text-fontcolor" class="color-picker" size="7" value="#000000"></a>
						<a class="btn" href="#" rel="tooltip" data-placement="top"
							data-original-title="Font Border Color"><input type="hidden"
							id="text-strokecolor" class="color-picker" size="7"
							value="#000000"></a>
						<!--- Background <input type="hidden" id="text-bgcolor" class="color-picker" size="7" value="#ffffff"> --->
					</div>
					<div class="pull-right" align="" id="imageeditor"
						style="display: none">
						<div class="btn-group">
							<button class="btn" id="bring-to-front" title="Bring to Front">
								<i class="icon-fast-backward rotate" style="height: 19px;"></i>
							</button>
							<button class="btn" id="send-to-back" title="Send to Back">
								<i class="icon-fast-forward rotate" style="height: 19px;"></i>
							</button>
							<button id="flip" type="button" class="btn"
								title="Show Back View">
								<i class="icon-retweet" style="height: 19px;"></i>
							</button>
							<button id="remove-selected" class="btn"
								title="Delete selected item">
								<i class="icon-trash" style="height: 19px;"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			
			<?php if(!empty($currentCate->templates)):?>
			<?php $firstP=$currentCate->templates;
				$images=$firstP[0]->images;
				$front=!empty($images['FRONT'])?$images['FRONT'][0]:"";;	
			?>
			<!--	EDITOR      -->
			<div id="shirtDiv" class="page"
				style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);">
				<!--img/crew_front.png  -->
				<img id="tshirtFacing" src="<?php echo $front?>" />
				<div id="drawingArea"
					style="position: absolute; top: 100px; left: 160px; z-index: 10; width: 200px; height: 400px;">
					<canvas id="tcanvas" width=200 height="400" class="hover"
						style="-webkit-user-select: none;">
					</canvas>
					
					
				</div>
				
				
			</div>
				<?php endif?>

			<!--	/EDITOR		-->
			<!-- 	flip buttpon -->
			
			<div align="center" style="min-height: 32px;">
				
					<div class="" align="" id="imageeditor">
						<div class="btn-group">
							<button onclick="flip()" class="btn" id="bring-to-front" data-original-title="Show Front View" title="Bring to Front">
								FRONT
							</button>
							<button  onclick="flip()" class="btn" id="send-to-back" data-original-title="Show Back View"  title="Send to Back">
								BACK
							</button>
							
						
						</div>
					</div>
				
			</div>
			
			<!-- 	/END FLIP -->	
				
			<?php ?>
		</div>

		<div class="span3">
			  
		      <div class="well">
		     
				<button type="button" class="btn btn-large btn-block btn-success" name="bulksave" id="bulksave">Save <i class="icon-briefcase icon-white"></i></button>
		  		<a href="" class="save">Image</a>   		       		   
		    </div>
		</div>

	</div>

</section>
<?php endif?>