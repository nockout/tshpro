<section class="title">
	<h4><?php echo lang('design:arts'); ?></h4>
</section>

<section class="item">
	<div class="content"></div>
	<div class="content">
	<ul class="art_list">
	<?php if(!empty($arts)):?>
	<?php foreach ($arts as $art):?>
	<?php  $data=unserialize ( $art->data );
	
		
			if ( empty (  $data)) {
					continue;
			} 
			?>
			
	<li class="one_quarter art_item ">
			<center>
		<?php foreach ($data as $img):?>
		<?php if(file_exists($img)):?>
		<img src="<?php echo $img;?>" />
		<?php endif?>
		<?php endforeach;?>
		
		<?php echo anchor("admin/tdesign/manage/index/".$art->id,lang("design:mockup"),array("class"=>'btn gray'))?>
		</center>
		<center>
		<h5 id="activity"><span class="success">Views:&nbsp;<span class=""><?php echo intval($art->total_view)?></span> </span>
		&nbsp;&nbsp;&nbsp;
		<span class="success"><span class="success">Sales:&nbsp<span class=""><?php echo intval($art->total_sale)?></span>  </span></h5>
		</center>
	</li>
	<?php endforeach;?>	
	<?php endif?>
	</ul>
	</div>
	<div class="clearfix"></div>
	<div class="content"><?php echo $pagination?></div>
</section>
