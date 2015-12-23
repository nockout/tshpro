<div class="form_inputs" id="information">
	<?php echo form_open()?>
	<div class="one_half">
		<fieldset>
		<legend></legend>
			<ul>
				<li><label for="title"><?php echo lang('global:title') ?> <span>*</span></label>
					<div class="input"><?php echo form_input('title', set_value('title',$title), 'maxlength="100" id="title"') ?></div>
				</li>
				<li><label for="price"><?php echo lang('template:template_price') ?> <span>*</span></label>
					<div class="input"><?php echo form_input('price', set_value('price',$price), 'maxlength="100" id="price"') ?></div>
				</li>
				<li><label for="price"><?php echo lang('template:price_max') ?> <span>*</span></label>
					<div class="input"><?php echo form_input('price_max', set_value('price_max',$price_max), 'maxlength="100" id="price_max"') ?></div>
				</li>
				<li><label for="category_id"><?php echo lang('template:category_label') ?><span>*</span></label>
					<div class="input">
					<?php echo form_dropdown('category_id', array(""=>lang('template:no_category_select_label')) + $categories,set_value('category_id',$category_id) ) ?>	
					</div>
					</li>

		
				
				<li><label for="status"><?php echo lang('template:status') ?></label>

					<div class="input"><?php echo form_dropdown('status', array( 'A' => lang('template:active'),'D' => lang('template:inactive')), set_value("status",$status)) ?></div>


				</li>
				<li>
				<div id="full">
				
				</div>
				</li>
				<li>
				<label for="color"><?php echo lang('template:color') ?></label>
				<div class="input">
				
				<?php echo form_input('color', set_value('color',$color), 'maxlength="100" id="color"') ?></div>
				</li>


			</ul>

		</fieldset>
	</div>
	
	<div class="one_half">
	<fieldset>
	<legend>Print Area Config</legend>
			<ul>
			<li>
			<label for="title">
			X <span>*</span></label>
					<div class="input">
					<?php echo form_input('printareax', set_value('printareax',$printareax), 'maxlength="100" id="printareax"') ?>
					</div>
			</li>
			<li>
			<label for="title">
			Y <span>*</span></label>
					<div class="input"><?php echo form_input('printareay', set_value('printareay',$printareay), 'maxlength="100" id="printareay"') ?>
					</div>
			</li>
			<li>
			<label for="title">
			Width <span>*</span></label>
					<div class="input"><?php echo form_input('printareaw', set_value('printareaw',$printareaw), 'maxlength="100" id="printareaw"') ?>
					</div>
			</li>
			<li>
			<label for="title">
			Heigt <span>*</span></label>
					<div class="input"><?php echo form_input('printareah', set_value('printareah',$printareah), 'maxlength="100" id="printareah"') ?>
					</div>
			</li>
			<li>
			<label for="title">
			<?php echo lang('template:strokecolor') ?> <span>*</span></label>
					<div class="input"><?php echo form_input('strokecolor', set_value('title',$strokecolor), 'maxlength="100" id="strokecolor"') ?>
					</div>
			</li>
			<li>
			<label for="title">
			<?php $sttypes=array("line"=>"line","dash"=>"dash")?>
			Stroke Type <span></span></label>
					<div class="input">
					<?php echo form_dropdown('stroketype', array(""=>lang('template:no_category_select_label')) + $sttypes,set_value('stroketype',$stroketype) ) ?>	
					</div>
			</li>
			</ul>
	</fieldset>
	</div>
	<div class="clearfix"></div>
	<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel')))?>
		</div>
	<?php echo form_close()?>
</div>
<script>
	

   $("#full").spectrum({

		  flat: true,
	      showInput: true,
	      className: "sangit",
	      preferredFormat: "hex",
	      showPalette: true,
	      showPaletteOnly: true,
	      clickoutFiresChange: false,
	      move: function (color) {
	        },
	        show: function () {

	        },
	        beforeShow: function () {

	        },
	        hide: function (color) {
	        },
	 	 	 change: function(color){
		 	  	var hex=color.toHexString();
	 		   var html=[];
	 		   html.push('<div class="pickercolors" style="background:'+hex+'">'); 
	 		//  html.push('<input type="text" class="pickercolors" value="'+hex+'"  name="colors[]"></div>');
	 		 	$("#color").val(color);
	 		   $("#colors_groups").append(html.join(""));
	 		  $('.pickercolors').bind("click",function(){
	 				$(this).remove();
	 			});
	 
	 	 	  },
	   palette: [
	             ["#ffffff", "#000000", "#c00000", "#f79646", "#f5f445", "#7fd13b", "#4bacc6", "#1f497d", "#8064a2", "#ff0000"],
	             ["#f2f2f2", "#7f7f7f", "#f8d1d3", "#fdeada", "#fafdd7", "#e5f5d7", "#dbeef3", "#c6d9f0", "#e5e0ec", "#ffcc00"],
	             ["#d7d7d7", "#595959", "#f2a3a7", "#fbd5b5", "#fbfaae", "#cbecb0", "#b7dde8", "#8db3e2", "#ccc1d9", "#ffff00"],
	             ["#bebebe", "#414141", "#eb757b", "#fac08f", "#eef98e", "#b2e389", "#92cddc", "#548dd4", "#b2a2c7", "#00ff00"],
	             ["#a3a3a3", "#2a2a2a", "#a3171e", "#e36c09", "#dede07", "#5ea226", "#31859b", "#17365d", "#5f497a", "#0000ff"],
	             ["#7e7e7e", "#141414", "#6d0f14", "#974806", "#c0c00d", "#3f6c19", "#205867", "#0f243e", "#3f3151", "#9900ff"]
	   ]
	});

   $('.pickercolors').bind("click",function(){
		$(this).remove();
	});

   </script>
