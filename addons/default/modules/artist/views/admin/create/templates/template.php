<?php if(isset($templates)&&count($templates)):?>
		<?php foreach ($templates as $key=>$cate):?>

		<?php if(!empty($cate->templates)):?>
		<div class="fpd-category" title="<?php echo $cate->category?>">
		
		
			<?php echo $temp= $this->load->view("admin/create/templates/view",array("templates"=>$cate->templates),true)?>
	
			
		</div>
<?php endif;?><?php endforeach;?><?php endif;?>
