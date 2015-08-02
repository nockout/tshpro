<section class="title">
	<h4><?php echo lang('design:arts'); ?></h4>
</section>

<section class="item">
	<div class="content">
	<ul class="art_list">
	<?php if(!empty($arts)):?>
	<?php foreach ($arts as $art):?>
	<?php  $data=unserialize ( $art->data );
			if ( empty (  $data)) {
					continue;
			} 
			?>
			
	<li class="one_quarter art_list ">
			<center>
		<?php foreach ($data as $img):?>
		<img src="<?php echo $img;?>" />
		
		<?php endforeach;?>
		
		<?php echo anchor("admin/tdesign/manage/index/".$art->id,lang("design:mockup"),array("class"=>'btn gray'))?>
		</center>
	</li>
	<?php endforeach;?>	
	<?php endif?>
	</ul>
	</div>
</section>