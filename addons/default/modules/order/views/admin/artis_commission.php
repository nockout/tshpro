	<?php if(!empty($commisions)):?>
<div class="one_half">
	<section class="title">
		<h4><?php echo lang('order:artis_commission')?></h4>
	</section>
	<fieldset>
		<ul>
						<?php foreach ($commisions as $com): ?>
						<?php if(!empty($com->user_info)):?>
						<li>
				<div class="input">
								<?php echo sprintf('%s %s (%s)',$com->user_info->first_name,$com->user_info->last_name,$com->user_info->username) ?> : <?php echo format_price($com->earn)?> 
							    </div>
			</li>
						<?php endif?>
						<?php endforeach;?>
						<li>
				<div class="buttons text-right">
				<?php if(!empty($isSendArtistComission)):?>
					<button type="button" class="btn red" value=""   name="removeartiscomision"
						id="removeartiscomision" >
						<span><?php echo lang('order:del_commission')?></span>
					</button>
				<?php else:?>
					<button type="button" class="btn blue" value=""   name="sendartiscomision"
						id="sendartiscomision" >
						<span><?php echo lang('order:send_commission')?></span>
					</button>
				<?php endif?>
			</li>
		</ul>

	</fieldset>



</div>
<?php endif?>
<script>
$( document ).ready(function() {
	
	 var  _removeartisComission=function(){
		 var _this=$(this);
		 
		 var jqxhr = $.get( "admin/order/delcommission/",{ id: <?php echo $order_id?> })  
			  .done(function() {
				  _this.attr('class','btn blue');
				  _this.val("<?php echo lang('order:send_commission')?>");
				  _this.html("<?php echo lang('order:send_commission')?>");
				  _this.attr('id','delcommission');
				  _this.off('click');
				  _this.on('click',_addartisComission);
			  })
			  .fail(function() {
			    alert( "error" );
			  });
	 }
	 var _addartisComission=function(){
		 var _this=$(this);
		 var jqxhr = $.get( "admin/order/sendcommission/",{ id: <?php echo $order_id?> })  
			  .done(function() {
				  _this.attr('class','btn red');
				  _this.val("<?php echo lang('order:del_commission')?>");
				  _this.html("<?php echo lang('order:del_commission')?>");
				  _this.attr('id','removeartiscomision');
				  _this.off('click');
				  _this.on('click',_removeartisComission);
			  })
			  .fail(function() {
			    alert( "error" );
			  });
	}
	 $('#sendartiscomision').on('click',_addartisComission);
	 $('#removeartiscomision').on('click',_removeartisComission)
		;
		
});




</script>