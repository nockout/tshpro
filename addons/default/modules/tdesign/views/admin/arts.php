
<script>
$(function(){
	/* $(".art_approve").change(function(){
		var id=$(this).val();
		var status=$(this).is(':checked') ? 1 :0;
		console.log(id);
		//var data="id=";
		$.get( "admin/tdesign/art_status/"+id+"/"+status, function( data ) {
			
			});
		if(status==0){
				$("#status"+id).html("<?php echo lang('button:deactive')?>");
			}else{
				$("#status"+id).html("<?php echo lang('button:active')?>");
		}
	});
	*/
	$("#active_all").change(function(){
		
		var id=$(this).val();
		var status=$(this).is(':checked') ? 1 :0;
		if(status)
		$(".art_approve").attr('checked',true);
		else
			$(".art_approve").attr('checked',false);
	});
})


function approveall(){
	$(".art_approve").attr('checked',true);
}
function deapproveall(){
	$(".art_approve").attr('checked',false);
}

</script>

<section class="title">
	<h4><?php echo lang('design:arts'); ?></h4>
</section>
<style>
.search li {
	display:inline-block;
}
</style>
<section class="item">
	<div class="content">
<?php echo form_open("admin/tdesign/manage/arts")?>
		<div class="content" >
		<fieldset id="filter">
			<ul class="search">
				<li><label> 
		
				<input type="text" value="<?php echo !empty($term['f_keywords'])?$term['f_keywords']:""?>" name="f_keywords"></li>
				</label>
				<li><button style="margin:0" value="search" class="btn blue" " type="submit" name="search"><?php echo lang('global:search')?></button>
					<a href="<?php echo site_url("admin/tdesign/manage/arts")?>" style="margin:0" class="btn red"><?php echo lang("buttons:cancel")?></a>
				</li>
			</ul>
		</div>		
<?php echo form_close()?>	
</fieldset>
 	<?php echo form_open("admin/tdesign/manage/action")?>
	
	<?php if(!empty($arts)):?>
		<ul class="art_list">
	<?php foreach ($arts as $art):?>
	<?php
			
			$data = unserialize ( $art->data );
			
			if (empty ( $data )) {
				continue;
			}
			?>
			
	<li class="one_quarter art_item ">
				<center>
				
		<?php foreach ($data as $img):?>
		<?php if(file_exists($img)):?>
			<img src="<?php echo $img;?>" />
			<?php break;;?>
		<?php endif?>
		<?php endforeach;?>
		</center>
		
		
		
			<center>
		<?php echo anchor("admin/tdesign/manage/index/".$art->id,!empty($art->name)?$art->name:lang("design:mockup"),array("class"=>'text_label'))?>
		
		<div class="edit"></div>
		<input type="text" value="" id="<?php echo $art->id?>" class="editable"/>
		
				</center>
				<center>
				
				<label id="status-<?php echo $art->id?>">
				
		<?php  if($art->allowed) echo lang("buttons:activate") ; else echo lang("buttons:deactivate") ; ?>
		</label>
				
				</center>
				<center>
					<h5 id="activity">
						<span class="success"><?php echo lang("design:views")?>:&nbsp;<span
							class=""><?php echo intval($art->total_view)?></span> </span>
						&nbsp;&nbsp;&nbsp; <span class="success"><span class="success"><?php echo lang("design:sale")?>:&nbsp<span
								class=""><?php echo intval($art->total_sale)?></span> </span>
					
					</h5>
				</center>
				
				<div style="float: right;">
					<input <?php  if($art->allowed) echo  "checked" ; else echo "" ;?>
						type="checkbox" class="art_approve" value="<?php echo $art->id?> "
						autocomplete="off" name="action_to[]">
				</div>
			</li>
	<?php endforeach;?>	
	
	
	
	</ul>
	<?php else:?>
	<div class="no_data"><?php echo lang("design:currently_no_products")?></div>
	<?php endif?>
	</div>
	<div class="clearfix"></div>
	<?php if(!empty($arts)):?>
	<div class="content">



		<div style="margin: 18px 0">

			<button class="btn blue" value="activate" type="submit" name="submit"><?php echo lang('buttons:activate')?></button>

			<button class="btn blue" value="disable" type="submit" name="submit"><?php echo lang('buttons:deactivate')?></button>
			<button class="btn red confirm" value="delete" type="submit"
				name="submit"><?php echo lang('buttons:delete')?></button>
			<label> ALL <input autocomplete="off" type="checkbox"
				class="check-all" value="" id="active_all" name="action_to_all">
			</label>
		</div>
		<div style="float: right">
<?php echo $pagination?>
</div>
	</div>
	<?php endif?>
</section>
	
<?php echo form_close() ?>

<script>
var has_key="<?php echo $this->security->get_csrf_token_name() ?>";

var has_value="<?php echo $this->security->get_csrf_hash()?>" ;
$(document).ready(function(){
	
	$('.edit').click(function(){
		$(this).hide();
		$(this).prev().hide();
		$(this).next().show();
		$(this).next().select();
	});
	
	
	$('input[type="text"].editable').blur(function() {  
         if ($.trim(this.value) == ''){  
			 this.value = (this.defaultValue ? this.defaultValue : '');  
		 }
		 else{
			 $(this).prev().prev().html(this.value);
		 }
		 
		 $(this).hide();
		 $(this).prev().show();
		 $(this).prev().prev().show();
     });
	  
	  $('input[type="text"].editable').keypress(function(event) {
		  
		  if (event.keyCode == '13') {
			  if ($.trim(this.value) == ''){  
				 this.value = (this.defaultValue ? this.defaultValue : '');  
			 }
			 else
			 {
				 $(this).prev().prev().html(this.value);
			 }
			 
			 $(this).hide();
			 $(this).prev().show();
			 $(this).prev().prev().show();
			 event.preventDefault();
			 $.ajaxSetup({
			        data: {
			        	has_key: has_value
			        }
			    });

			    // now you can use plain old POST requests like always
			    $.post('admin/tdesign/manage/change_name', { name : this.value,id:$(this).attr("id") });
			 return true;
		  }
		  
		 //return false;
	  });
		  
});
</script>

