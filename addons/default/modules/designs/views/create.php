<style>

#drawingArea{
	border:1px solid ;
}
.item-overview::after, .item-overview::before {
	content: " ";
	display: table;
}

#product-selector .item-options .item-option:first-child {
	border-top-color: #d8dddf;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
}

*, *::after, *::before {
	box-sizing: border-box;
}

.item-overview {
	margin-top: 4px;
}

#product-selector .item-options .item-option.active .item-thumb-container
	{
	border: 1px solid #c2c9cc;
}

#product-selector .item-options .item-option .item-thumb-loaded {
	opacity: 1;
}

.item-thumb-container {
	background: #444 none repeat scroll 0 0;
	border: 1px solid #fff;
	float: left;
	height: 35px;
	margin-right: 5px;
	text-align: center;
	transition: opacity 0.4s ease 0s;
	width: 30px;
}

.item-thumb-container .item-thumb {
	width: 100%;
}

#product-selector .item-options .item-option:last-child {
	border-bottom-color: #d8dddf;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
}


</style>


<section id="typography">
	<div class="page-header"></div>
	<!-- Headings & Paragraph Copy -->
	<div class="row">
		<div class="col-md-3 col-lg-3 ">
			<div class="tabbable">
				<ul class="nav nav-tabs nav-justified">
					<li class="active">
				<a data-toggle="tab" href="#home"><h5>TEXT</h5></a></li>
					<li><a data-toggle="tab" href="#menu1"><h5>ARTS</h5></a>
					</li>

				</ul>
				<div class="tab-content">

					<div id="home" class="tab-pane fade in active">
						<h3>Enter your text below</h3>
						<div class="well">
							<div class="input-group form-group">
								<input id="text-string" type="text" class="form-control "
									placeholder="Your text here" aria-describedby="basic-addon1">
									 <div class="input-group-btn">
									<button id="add-text" type="submit" class="btn btn-success"> <span
									 <span
									
									class="fa fa-search"></button>
									</div>
								</span>
							</div>
						</div>

					</div>

					<div id="menu1" class="tab-pane fade">
						<h3></h3>
						<div class="well">
						
							<div class=" form-group">
								<button  class="form-control btn btn-primary "
									placeholder="Your text here" aria-describedby="basic-addon1">Upload your art 
									</button>
								
							</div>
							<div class="">
							<div id="avatarlist">
								<img src="img/invisibleman.jpg" class="art" style="cursor:pointer;">
				              
							</div>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>

		<div class="col-md-6 col-lg-6">
			<div align="center" style="min-height: 32px;">
				<div class="clearfix">
					<div style="display: none;" id="texteditor" class="btn-group inline pull-left" role="group">
						<button data-toggle="dropdown" class="btn btn-default dropdown-toggle"
							id="font-family" data-original-title="Font Style">
							<i style="width: 19px; height: 19px;" class="fa fa-font">
							
							</i>
						</button>
						<ul aria-labelledby="font-family-X" role="menu"
							class="dropdown-menu">
							<li><a class="Arial" onclick="setFont('Arial');" href="#"
								tabindex="-1" data-original-title="">Arial</a></li>
							<li><a class="Helvetica" onclick="setFont('Helvetica');" href="#"
								tabindex="-1" data-original-title="">Helvetica</a></li>
							<li><a class="MyriadPro" onclick="setFont('Myriad Pro');"
								href="#" tabindex="-1" data-original-title="">Myriad Pro</a></li>
							<li><a class="Delicious" onclick="setFont('Delicious');" href="#"
								tabindex="-1" data-original-title="">Delicious</a></li>
							<li><a class="Verdana" onclick="setFont('Verdana');" href="#"
								tabindex="-1" data-original-title="">Verdana</a></li>
							<li><a class="Georgia" onclick="setFont('Georgia');" href="#"
								tabindex="-1" data-original-title="">Georgia</a></li>
							<li><a class="Courier" onclick="setFont('Courier');" href="#"
								tabindex="-1" data-original-title="">Courier</a></li>
							<li><a class="ComicSansMS" onclick="setFont('Comic Sans MS');"
								href="#" tabindex="-1" data-original-title="">Comic Sans MS</a></li>
							<li><a class="Impact" onclick="setFont('Impact');" href="#"
								tabindex="-1" data-original-title="">Impact</a></li>
							<li><a class="Monaco" onclick="setFont('Monaco',this);" href="#"
								tabindex="-1" data-original-title="">Monaco</a></li>
							<li><a class="Optima" onclick="setFont('Optima');" href="#"
								tabindex="-1" data-original-title="">Optima</a></li>
							<li><a class="Hoefler Text" onclick="setFont('Hoefler Text');"
								href="#" tabindex="-1" data-original-title="">Hoefler Text</a></li>
							<li><a class="Plaster" onclick="setFont('Plaster');" href="#"
								tabindex="-1" data-original-title="">Plaster</a></li>
							<li><a class="Engagement" onclick="setFont('Engagement');"
								href="#" tabindex="-1" data-original-title="">Engagement</a></li>
						</ul>
						<button data-original-title="Bold" class="btn btn-default" id="text-bold">
							<img width="" height="" src="img/font_bold.png">
						</button>
						<button data-original-title="Italic" class="btn btn-default" id="text-italic">
							<img width="" height="" src="img/font_italic.png">
						</button>
						<button style="" class="btn btn-default" id="text-strike"
							data-original-title="Strike">
							<img width="" height="" src="img/font_strikethrough.png">
						</button>
						<button style="" class="btn btn-default" id="text-underline"
							data-original-title="Underline">
							<img src="img/font_underline.png">
						</button>
						
					</div>
					<div align="" style="display: none;" id="imageeditor"
						class="pull-right">
						<div class="btn-group">
							<button id="bring-to-front" class="btn btn-default"
								data-original-title="Bring to Front">
								<i style="height: 19px;" class="fa fa-undo"></i>
							</button>
							<button id="send-to-back" class="btn btn-default"
								data-original-title="Send to Back">
								<i style="height: 19px;" class="fa fa-repeat "></i>
							</button>
							<button class="btn btn-default" type="button" id="flip" data-original-title="Show Front View">
							<i style="height:19px;" class="fa fa-retweet"></i>
							</button>
							<button class="btn btn-default" id="remove-selected"
								data-original-title="Delete selected item">
								<i style="height: 19px;" class="fa fa-trash-o"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<!--	EDITOR      -->
			<div id="shirtDiv" class="page"
				style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);">
				<img id="tshirtFacing" src="img/crew_front.png" />
				
				<div id="drawingArea" style="position: absolute; top: 100px; left: 160px; z-index: 10; width: 200px; height: 400px;">
					<canvas id="tcanvas" width=200 height="400" class="hover"
						style="-webkit-user-select: none;">
					</canvas>
				</div>
			</div>
			<!--	/EDITOR		-->
		</div>

		<div class="col-md-3 col-lg-3 ">
			<h3>Style & design</h3>
			<div class="well ">

				<div class="list-group  ">
					<select id="phoneTypes" class="form-control"
						style="margin-bottom: 10px;">
						<option selected="selected" value="1">iPhone 5</option>
						<option value="2">iPhone 4</option>
						<option value="3">Samsumg III</option>
					</select>

					<div class="list-content  product-selector">
						<ul class="list-group ">
							<li class="list-group-item ">
								<p data-reactid=".7.0.2.$369.0" class="item-name">Teespring
									Premium Tee</p>
								<div data-reactid=".7.0.2.$369.1" class="item-overview">
									<div data-reactid=".7.0.2.$369.1.0"
										class="item-thumb-container item-thumb-loaded">
										<img data-reactid=".7.0.2.$369.1.0.0"
											src="https://d1b2zzpxewkr9z.cloudfront.net/images/products/apparel/product_type_1_front_small.png"
											class="item-thumb">
									</div>
									<p data-reactid=".7.0.2.$369.1.1" class="item-qualities">Premium
										materials</p>
									<div data-reactid=".7.0.2.$369.1.2" class="sizes-label">S
										&ndash; 5XL</div>
								</div>
							</li>
							<li class="list-group-item ">
								<p data-reactid=".7.0.2.$369.0" class="item-name">Teespring
									Premium Tee</p>
								<div data-reactid=".7.0.2.$369.1" class="item-overview">
									<div data-reactid=".7.0.2.$369.1.0"
										class="item-thumb-container item-thumb-loaded">
										<img data-reactid=".7.0.2.$369.1.0.0"
											src="https://d1b2zzpxewkr9z.cloudfront.net/images/products/apparel/product_type_1_front_small.png"
											class="item-thumb">
									</div>
									<p data-reactid=".7.0.2.$369.1.1" class="item-qualities">Premium
										materials</p>
									<div data-reactid=".7.0.2.$369.1.2" class="sizes-label">S
										&ndash; 5XL</div>
								</div>
							</li>
							<li class="list-group-item ">
								<p data-reactid=".7.0.2.$369.0" class="item-name">Teespring
									Premium Tee</p>
								<div data-reactid=".7.0.2.$369.1" class="item-overview">
									<div data-reactid=".7.0.2.$369.1.0"
										class="item-thumb-container item-thumb-loaded">
										<img data-reactid=".7.0.2.$369.1.0.0"
											src="https://d1b2zzpxewkr9z.cloudfront.net/images/products/apparel/product_type_1_front_small.png"
											class="item-thumb">
									</div>
									<p data-reactid=".7.0.2.$369.1.1" class="item-qualities">Premium
										materials</p>
									<div data-reactid=".7.0.2.$369.1.2" class="sizes-label">S
										&ndash; 5XL</div>
								</div>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>

</section>
