<?php if(!empty($error_string)): ?>
<div class="error-box">
	<?php echo $error_string?>
</div>
<?php endif;?>
<section class="item">
	<br />
	<div class="content entry-content">
		<div class="container-fluid">
			<div class="yes"></div>
			<div class="row-fluid content item">
				<div class="span12">
					<div id="neo">
					<?php echo $this->load->view("admin/create/area")?>
					<?php echo $this->load->view("admin/create/navigate")?>
					</div>
				</div>
				<div id="textwidget">
					<div class="span12 col-xs-12">
				<?php echo $this->load->view("admin/create/image_widget")?>
			</div>



				</div>
				<div id="imgwidget">
					<div class="span12 col-xs-12">
				<?php echo $this->load->view("admin/create/text_widget")?>
			</div>



				</div>
				<Script>
					$('#textwidget').BootSideMenu({	
					side:"right", // left or right
			
					autoClose:true // auto close when page loads

					});
					$('#imgwidget').BootSideMenu({	
					side:"left", // left or right
					
					autoClose:true // auto close when page loads

					});
		</Script>

			</div>
		</div>


		<div id="convascontent" style="display: none"></div>
	</div>
</section>
<?php
$attributes = array (
		'id' => 'export_template' 
);
$hidden = array (
		"canvasData" => "" 
);
?>

<? echo form_open("admin/tdesign/create/export",$attributes,$hidden)?>
  <? echo form_hidden($hidden)?>
 <?php echo form_close()?>
<script>
 jQuery(document).ready(function ($) { 
         $('.export').click(function(){
      
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
               
                    
                }, 2000);
        
       });


    });



    </script>