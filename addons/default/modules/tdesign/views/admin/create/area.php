
<?php
if (isset ( $collections ) && count ( $collections ))
	$first_t = reset ( $collections );

?>

<div class="span6">
	<div id="neo">
			<div class="designContainer" id="printable" style=width:<?php echo $this->config->item("min_width_template_file")?>px;height:<?php echo $this->config->item("min_height_template_file")?>px">
				<div class="text t designtext1 no-delete">
					<i class="icon-remove action text-error" data-action="remove"></i>
			<p></p>
			<i class="icon-edit action" data-action="fsontSize"></i>
		</div>       
			<?php if(isset($first_t)):?>
		<img id="Tshirtsrc" src="<?php echo get_image_path_temp($first_t["resize_image"])?>"
			alt="<?php echo ($first_t["file_name"])?>">				
			<?php else	:?>
			<img id="Tshirtsrc"
			src="<?php echo Asset::get_filepath_img("load-art.jpg")?>" alt="">
			<?php endif;	?>
			</div>
	<br/>
	<hr>
	<div class="navbar">
		<div class="navbar-inner">
			<ul class="nav unstyled">
				<li><a href="#myModal" role="button" data-toggle="modal"><i
						class="icon-eye-open"></i> <?php echo lang("design:preview") ?></a></li>
				<li class="divider-vertical"></li>
				<li>
				<a href="javascript:" onclick="PrintElem("
					#printable")" class="print"><i class="icon-print"></i> <?php echo lang("design:print") ?></a>
				</li>
				<li class="divider-vertical"></li>
				<li>
				<a class="dropdown-toggle export" data-toggle="dropdown"
					href="javascript:"> export</a></li>

				<li class="divider-vertical"></li>

				
			</ul>
		</div>
	</div>
	</div>
	
</div>
 <?php $attributes = array('id' => 'export_template');
 $hidden=array("canvasData"=>"");?>
<!--  <form id="export_template" accept-charset="utf-8" method="post" action="http://localhost/tshirtDesignPj/export.php"> -->
 <? echo form_open("admin/tdesign/create/export",$attributes,$hidden)?>
  <? echo form_hidden($hidden)?>
 <?php echo form_close()?>
<script>
 jQuery(document).ready(function ($) { 
         $('.export').click(function(){
            //hide options
            $('#printable').find('i').css('display', 'none');
            $('#printable').find('.ui-icon').css('display', 'none');
            $('#printable').css("width", $("#Tshirtsrc").width());
            $('#printable').css("height", $("#Tshirtsrc").height());
            //get printable section
             var exportCanvas = document.getElementById('printable');
             //get convas container
             var canvasContainer = document.getElementById('convascontent');
           
                //export canvas to convascontainer
                html2canvas(exportCanvas, {
                    //when finished fucntion
                onrendered: function(canvas) {
                    // initialize canvas container (if we generate another canvas)
                    $('#convascontent').html(' ');
                    // append canvas to container
                    canvasContainer.appendChild(canvas);
                    //add id attribute to the canvas
                    $('#convascontent').find('canvas').attr('id','mycanvas');
                    // display options again
                    $('#printable').find('i').css('display', 'block');
                    $('#printable').find('.ui-icon').css('display', 'block');
                    //document.getElementsByTagName("UL")
                }
            });

                	//return;
             $('body').append("<div class='overlay'>Generating your design</div>");

                setTimeout(function(){

                	
                	if(!document.getElementById("mycanvas"))
					{
						alert("No canvas found");
						 $('#printable').find('i').css('display', 'block');
				         $('#printable').find('.ui-icon').css('display', 'block');
						$('div.overlay').remove();
						return;
					}
                	 var oCanvas = document.getElementById("mycanvas"); 
                     
                     var canvasData = oCanvas.toDataURL("image/png");
                     $('input[name="canvasData"]').val(canvasData);
                 	$('div.overlay').remove();
                     $("#export_template").submit();
                     
                     return;
                	var post_data = {};

                 		//    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
							
                  //   };
                     post_data.<?php echo $this->security->get_csrf_token_name(); ?>="<?php echo $this->security->get_csrf_hash(); ?>";
                	post_data.img=canvasData;
                	$.ajax({
                        url: "http://localhost/tshirtDesignPj/index.php/admin/tdesign/create/export",
                        type:'POST',
                        dataType: 'json',
                        data: post_data
                        }).done(function( respone ) {
                        	// $('.yes').html("<div class='alert alert-success'>If you can't download you file here is a link , Saved as <br><a  target='_blank' class='download' download href='http://99bootstrap.com/TshirtDesigner/wordpress/wp-content/plugins/tshirtdesigner/designs/" + data.responseText + "' donwload='http://99bootstrap.com/TshirtDesigner/wordpress/wp-content/plugins/tshirtdesigner/designs/" + data.responseText + "'>"+data.responseText+"</a></div>");
                             //res =  data.responseText;
                         });
                    
                	//return;
                	
					
                    
                   
                //    postData="";
                  //  var postData = "canvasData="+canvasData;
                 ///   postData=_certs;

                  //  var ajax = new XMLHttpRequest();
                  /*  ajax.open("POST","http://localhost/tshirtDesignPj/index.php/admin/tdesign/create/export");
                    ajax.setRequestHeader('Content-Type', 'canvas/upload');
                    ajax.setRequestHeader('Content-TypeLength', postData.length);

                    ajax.onreadystatechange=function()
                    {
                        if (ajax.readyState == 4)
                        { 
                            $('.overlay').remove();
                            //alert(ajax.responseText);
                            // Write out the filename.
                            $('.yes').html("<div class='alert alert-success'>If you can't download you file here is a link , Saved as <br><a  target='_blank' class='download' download href='http://99bootstrap.com/TshirtDesigner/wordpress/wp-content/plugins/tshirtdesigner/designs/" + ajax.responseText + "' donwload='http://99bootstrap.com/TshirtDesigner/wordpress/wp-content/plugins/tshirtdesigner/designs/" + ajax.responseText + "'>"+ajax.responseText+"</a></div>");
                            res =  ajax.responseText;

                        }
                    }
                    ajax.send(postData);*/
                    
                }, 2000);
        //return false;
       });


    });



    </script>