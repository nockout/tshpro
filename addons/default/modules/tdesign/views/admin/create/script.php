<Script>
jQuery(document)
.ready(
		function() {
			var has_key="<?php echo $this->security->get_csrf_token_name() ?>";
			
			var has_value="<?php echo $this->security->get_csrf_hash()?>" ;
		
			var product =0;
			var yourDesigner = $('#clothing-designer')
					.fancyProductDesigner(
							{
								
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
									boundingBox : "Base"
								},width: 900, boundingBoxColor:"#18BC9C",
						    	stageHeight: 500,
								elementParameters: {
									/*x: 'center', //the x-position
									y: 'center', //the y-position
									z: -1,
									colors : '#000',
									resizeToW: 1200,
								    resizeToH: 1200,
									scale: "0.6",
									autoSelect: true,
									draggable : true,*/boundingBox:true,
						    		x:0,
						    		y:0,autoCenter : true,
									
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
							        maxW: 3600,
							        maxH: 3600,
							        scale: 0.6,							       
									autoCenter : true,
									boundingBox : "Base",
									resizable : true,
								},
								labels: { //different labels used for the UI
									<?php echo $this->security->get_csrf_token_name() ?>:'<?php echo $this->security->get_csrf_hash() ?>',
									layersButton: 'Manage Layers',
									addsButton: 'Add Something',
									moreButton: 'Actions',
									productsButton: 'Change Products',
									downloadImage: 'Download Image',
									print: 'Print',
									downLoadPDF: 'Download PDF',
									saveProduct: 'Save',
									loadProduct: 'Load',
									undoButton: 'Undo',
									redoButton: 'Redo',
									resetProductButton: 'Reset Product',
									zoomButton: 'Zoom',
									panButton: 'Pan',
									addImageButton: '<?php echo lang("design:add_mockup")?>',
									addTextButton: 'Add your own text',
									enterText: 'Enter your text',
									addFBButton: 'Add photo from facebook',
									addInstaButton: 'Add photo from instagram',
									addDesignButton: 'Choose from Designs',
									fillOptions: 'Fill Options',
									color: 'Color',
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
									uploadedDesignSizeAlert: "<?php echo lang("design:invalid_mockup_size")?>",
									initText: "Initializing product designer",
									myUploadedImgCat: "Your uploaded images",
									moveUp: 'Move Up',
									moveDown: 'Move Down'
								}
							}).data('fancy-product-designer');

					
					$('button#putinconllection').on("click",function() {
						var type=$(".fpd-product-categories").val()?$(".fpd-product-categories").val():"shirts";
						var views=yourDesigner.getViewsDataURL();
						var products=yourDesigner.getProduct(true);
						if(!products)
							return;
						var name=(products[0].title);
						//return; 
						var hmtl=[] ,hidden="";
						if(views.length){
							hmtl.push("<tr><td style='width: 30px' align='left'>");
							hmtl.push("<img style='width:80px;height:80px' src='"+views[0]+"'></td>");
							hmtl.push("<td style='position:relative'>");
							hmtl.push("<i style='top:0;right:0;position:absolute; font-size: 1.3em;cursor: pointer' class='x_row pointer fpd-btn  fpd-icon-remove'></i>");
							hmtl.push("<input type='text' id='title' maxlength='100' value='"+name+"' name=products["+product+"][title]>");
							hmtl.push("<input type='text' id='title' maxlength='100' value='"+0.99+"' name=products["+product+"][price]>");
							
							for(i=0;i<views.length;i++){

							hmtl.push( "<input  type='hidden' name='products["+product+"][images]["+i+"]' value='"+views[i]+"'>");
							}
					
							
						
							hmtl.push("</td></tr>");
							$("#yourdesigns").append(hmtl.join(""));
							
							$(".x_row").bind( "click", function() {
								 
								  $(this).closest('tr').remove();
								});
							product++;
						}
						
						
						return;
					});
					$('button#export').on("click",function() {
						var postt = $( "#save_image" ).submit();
						
                         
					});
					$('.x_row').on("click",function(){
						alert("Aaaa");
						});
					
			// upload image
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
