<Script>
jQuery(document)
.ready(
		function() {
			var has_key="<?php echo $this->security->get_csrf_token_name() ?>";
			
			var has_value="<?php echo $this->security->get_csrf_hash()?>" ;

			//var elements=[{"price":"100000","type":"image","isInitial":true,x:325,y:329,source:"uploads/default/../template/8_104.png","title":"abcd124"}];
			
			var product=0;
			var yourDesigner = $('#clothing-designer')
					.fancyProductDesigner(
							{
								printarea:{w:120,h:450},
								width: "100%",
								editorMode : false,
								fonts : [ 'Arial', 'Fearless',
										'Helvetica', 'Times New Roman',
										'Verdana', 'Geneva', 'Gorditas' ],
								customTextParameters : {
									colors : "#000",
									removable : true,
									resizable : true,
									draggable : true,
									rotatable : true,
									autoCenter : true,
									boundingBox : "Base",
									patternable: true
								},width: 900, boundingBoxColor:"#18BC9C",
						    	stageHeight: 600,
								elementParameters: {
									/*x: 'center', //the x-position
									y: 'center', //the y-position
									z: -1,
									colors : '#000',
									resizeToW: 1200,
								    resizeToH: 1200,
									scale: "0.6",
									autoSelect: true,
									draggable : true,*/
									boundingBox:"Base",
						    		x:0,
						    		y:0,
						    		autoCenter : true,
						    		scale: "1.0",
										//Allows to set the z-index of an element, -1 means it will be added on the stack of layers
									
								},
								templatesDirectory :"<?php echo base_url("index.php/admin/tdesign/")?>/",
								phpDirectory: "php/",
								customImageParameters : {
									draggable : true,
									removable : true,
									colors : '#000',
									minW:1200,
							        minH:1200,
							        maxW: 4800,
							        maxH: 4800,
							      /*   scale: 0.5,		 */					       
									autoCenter : true,
									boundingBox : "Base",
									resizable : true,
								},
								labels: { //different labels used for the UI
									<?php echo $this->security->get_csrf_token_name() ?>:'<?php echo $this->security->get_csrf_hash() ?>',
									layersButton: '<?php echo lang("template:manages_layer")?>',
									addsButton: '<?php echo lang("template:functions")?>',
									moreButton: '<?php echo lang("template:_layers")?>',
									productsButton: '<?php echo lang("template:change_product")?>',
									downloadImage: '<?php echo lang("template:download_image")?>',
									print: 'Print',
									downLoadPDF: 'Download PDF',
									saveProduct: 'Save',
									loadProduct: 'Load',
									undoButton: 'Undo',
									redoButton: 'Redo',
									resetProductButton: 'Reset Product',
									zoomButton: 'Zoom',
									panButton: 'Pan',
									addImageButton: '<?php echo lang("template:add_mockup")?>',
									addTextButton: '<?php echo lang("template:enter_text")?>',
									enterText: '<?php echo lang("template:enter_text")?>',
									addFBButton: 'Add photo from facebook',
									addInstaButton: 'Add photo from instagram',
									addDesignButton: 'Choose from Designs',
									fillOptions: 'Fill Options',
									color: '<?php echo lang("template:color")?>',
									patterns: 'Patterns',
									opacity: 'Opacity',
									filter: 'Filter',
									textOptions: 'Text Options',
									changeText: 'Change Text',
									typeface: 'Typeface',
									lineHeight: 'Line Height',
									textAlign: 'Alignment',
									textAlignLeft: 'Align Left',
									textAlignCenter: 'Align Center',
									textAlignRight: 'Align Right',
									textStyling: 'Styling',
									bold: 'Bold',
									italic: 'Italic',
									underline: 'Underline',
									curvedText: 'Curved Text',
									curvedTextSpacing: 'Spacing',
									curvedTextRadius: 'Radius',
									curvedTextReverse: 'Reverse',
									transform: 'Transform',
									angle: 'Angle',
									scale: 'Scale',
									centerH: 'Center Horizontal',
									centerV: 'Center Vertical',
									flipHorizontal: 'Flip Horizontal',
									flipVertical: 'Flip Vertical',
									resetElement: 'Reset Element',
									fbSelectAlbum: 'Select an album',
									instaFeedButton: 'My Feed',
									instaRecentImagesButton: 'My Recent Images',
									editElement: 'Edit Element',
									productSaved: 'Product Saved!',
									lock: 'Lock',
									unlock: 'Unlock',
									remove: 'Remove',
									outOfContainmentAlert: 'Move it in his containment!',
									uploadedDesignSizeAlert: "<?php echo lang("template:invalid_mockup_size")?>",
									initText: "<?php echo lang("template:init_design")?>",
									myUploadedImgCat: "Your uploaded images",
									moveUp: 'Move Up',
									moveDown: 'Move Down'
								}
							}).data('fancy-product-designer');

					$('#clothing-designer').on("elementAdded",function(event,object){
							$(".fpd-context-dialog").hide();
							//$("#clothing-designer").fancyProductDesigner.closeDialog();
						});
					$('button#putinconllection').on("click",function() {

						var art=yourDesigner.getCustomElements();
						if(!art.length){
								alert("<?php echo lang("design:empty_art")?>");
									return;
							};
						var type=$(".fpd-product-categories").val()?$(".fpd-product-categories").val():"shirts";
						var views=yourDesigner.getViewsDataURL();
						var products=yourDesigner.getProduct(true);
						yourDesigner.reloadprintarea();
						console.log(yourDesigner);
						$.get( "admin/tdesign/templateinfo/"+products[0].title, function( data,status,xhr  ) {
							//console.log(status);
							//console.log(xhr);
							var hmtl=[];
							var type=$(".fpd-product-categories").val()?$(".fpd-product-categories").val():"shirts";
							var views=yourDesigner.getViewsDataURL();
							if(!products)
								return;
							var price=parseInt(data.p);
							var max_price=parseInt(data.mp);
							if(views.length){
								hmtl.push("<tr><td style='width: 30px' align='left'>");
								hmtl.push("<img style='width:80px;height:80px' src='"+views[0]+"'></td>");
								hmtl.push("<td style='position:relative'>");
								hmtl.push("<i style='top:0;right:0;position:absolute; font-size: 1.3em;cursor: pointer' class='x_row pointer fpd-btn  fpd-icon-remove'></i>");
								hmtl.push("<input type='hidden'  value='"+data.idt+"' name=products["+product+"][id_template]>");
								hmtl.push("<label'><?php echo lang("design:designed_label")?></label>");
								hmtl.push("<input type='text' class='name' id='title' style='width:90%' value='"+data.na+"' name=products["+product+"][title]>");	
								hmtl.push("<label id='label0'><?php echo lang("design:description_label")?></label>");
								hmtl.push("<textarea class='des' style='width:90%;'  name=products["+product+"][description]>");	
								hmtl.push("</textarea><br/>");
								hmtl.push("<div style='width:95%;' id='slider"+product+"'>");
								hmtl.push("</div>");
								hmtl.push("<input type='hidden' id='price"+product+"' maxlength='100' value='"+price+"' name=products["+product+"][price]>");
								hmtl.push(" <p><label id='label"+product+"' >Price:"+price+"</label>");
								hmtl.push("</p>");
								for(i=0;i<views.length;i++){
									hmtl.push( "<input  type='hidden' name='products["+product+"][images]["+i+"]' value='"+views[i]+"'>");
								}
						
								
							
								hmtl.push("</td></tr>");
								$("#yourdesigns").append(hmtl.join(""));
								
								$(".x_row").bind( "click", function() {
									 
									  $(this).closest('tr').remove();
									});
								var productprice=($("#price"+product));
								var label=($("#label"+product));
								//console.log(price);
								$("#slider"+product).slider({
								    range: "min",
								    value: price,
								    step: 5000,
								    min: price,
								    max: max_price,
								    slide: function(event, ui) {
				    
								    	productprice.val(ui.value);     	
								    	label.html("Price:"+ui.value);
								     	
								    }
								});
								
								product++;
							}
							
							},"json");
					
					
						
						
						
						
						
						return;
					});

				
					$('button#export').on("click",function() {
						var hmtl=[];
						var art=yourDesigner.getCustomElements();
						if(!art.length){
								alert("<?php echo lang("design:empty_art")?>");
									return;
							}else{
								
								for(i=0;i<art.length;i++){
									if(art[i].element.type=="image"){
										value=(art[i].element.source);
																
									}else{
										value=art[i].element.toDataURL();
										}		
						
									hmtl.push("<input type='hidden'  maxlength='100' value='"+value+"' name=arts["+i+"]>");							
												
								}
							
						}
						hmtl.push("</td></tr>");
						$("#yourdesigns").append(hmtl.join(""));
						var check=true;
						$('#save_image input.name').each(
							    function(index){  
							        var input = $(this);
							        console.log(input.val());
							      	if(!input.val()){
							      		check=false;
							      		return;
								      }
							    }
							);
						
						if(!check){
							alert("<?php echo lang("design:inputall")?>");
							return;
						}
						
						var postt = $( "#save_image" ).submit();
						
                         
					});
		
			document.getElementById('design-upload').onchange = function(e) {
				if (window.FileReader) {
					var reader = new FileReader();
					reader.readAsDataURL(e.target.files[0]);
					reader.onload = function(e) {

						var image = new Image;
						image.src = e.target.result;
						image.onload = function() {
							var maxH = 400, maxW = 300, imageH = this.height, imageW = this.width, scaling = 1;

							if (imageW > imageH) {
								if (imageW > maxW) {
									scaling = maxW / imageW;
								}
							} else {
								if (imageH > maxH) {
									scaling = maxH / imageH;
								}
							}

							yourDesigner.addElement('image',
									e.target.result,
									'my custom design', {
										colors : $('#colorizable').is(
												':checked') ? '#000000'
												: false,
										zChangeable : true,
										removable : true,
										draggable : true,
										resizable : true,
										rotatable : true,
										autoCenter : true,
										boundingBox : "Base",
										scale : scaling
									});
						};
					};
				} else {
					alert('FileReader API is not supported in your browser, please use Firefox, Safari, Chrome or IE10!')
				}
			};
		});


	
</Script>
