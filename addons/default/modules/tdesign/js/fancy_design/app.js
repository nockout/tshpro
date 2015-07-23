jQuery(document)
		.ready(
				function() {

					var yourDesigner = $('#clothing-designer')
							.fancyProductDesigner(
									{
										
										editorMode : false,
										fonts : [ 'Arial', 'Fearless',
												'Helvetica', 'Times New Roman',
												'Verdana', 'Geneva', 'Gorditas' ],
										customTextParameters : {
											colors : false,
											removable : true,
											resizable : true,
											draggable : true,
											rotatable : true,
											autoCenter : true,
											boundingBox : "Base"
										},
										elementParameters: {
											x: 0, //the x-position
											y: 0, //the y-position
											z: -1, //Allows to set the z-index of an element, -1 means it will be added on the stack of layers
											opacity: 1, //opacity (0-1)
											originX: 'center', //left,center
											originY: 'center', //top,center
											scale: 1, // the scale factor
											degree: 0, //the degree for the rotation
											price: 0, //how much does the element cost
											colors: false, //false, a string with hex colors separated by commas for static colors or a single color value for enabling the colorpicker
											currentColor: false,
											removable: false, //false or true
											draggable: false,  //false or true
											rotatable: false, // false or true
											resizable: false,  //false or true
											zChangeable: false, //false or true
											boundingBox: false, //false, an element by title or an object with x,y,width,height
											autoCenter: false, //when the element is added to stage, center it automatically
											replace: '', //replaces anelement, if an element is added to stage and another element with the same type and replace parameter enabled is on the stage
											boundingBoxClipping: false, //will cut off the area of the element that is outside of the bounding box
											autoSelect: false, //select the element when its added to stage
											topped: false, //set the element always on top
											flipX: false,
											flipY: false,
											colorPrices: {}
										},
										templatesDirectory :"addons/default/modules/tdesign/templates/",
										customImageParameters : {
											draggable : true,
											removable : true,
											colors : '#000',
											
											autoCenter : true,
											boundingBox : "Base"
										}
									}).data('fancy-product-designer');

					// print button
					$('#print-button').click(function() {
						yourDesigner.print();
						return false;
					});

					// create an image
					$('#image-button').click(function() {
						var image = yourDesigner.createImage();
						return false;
					});

					// create a pdf with jsPDF
					$('#pdf-button').click(
							function() {
								var image = new Image();
								image.src = yourDesigner.getProductDataURL(
										'jpeg', '#ffffff');
								image.onload = function() {
									var doc = new jsPDF();
									doc
											.addImage(this.src, 'JPEG', 0, 0,
													this.width * 0.2,
													this.height * 0.2);
									doc.save('Product.pdf');
								}
								return false;
							});

					// checkout button with getProduct()
					$('#checkout-button').click(function() {
						var product = yourDesigner.getProduct();
						console.log(product);
						return false;
					});

					// event handler when the price is changing
					$('#clothing-designer').bind('priceChange',
							function(evt, price, currentPrice) {
								$('#thsirt-price').text(currentPrice);
							});

					// recreate button
					$('#recreation-button').click(
							function() {
								var fabricJSON = JSON.stringify(yourDesigner
										.getFabricJSON());
								$('#recreation-form input:first').val(
										fabricJSON).parent().submit();
								return false;
							});

					// click handler for input upload
					$('#upload-button').click(function() {
						$('#design-upload').click();
						return false;
					});

					// save image on webserver
					$('#save-image-php').click(function() {
						$.post("php/save_image.php", {
							base64_image : yourDesigner.getProductDataURL()
						});
					});

					// send image via mail
					$('#send-image-mail-php').click(function() {
						$.post("php/send_image_via_mail.php", {
							base64_image : yourDesigner.getProductDataURL()
						});
					});

					// upload image
					document.getElementById('design-upload').onchange = function(
							e) {
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
