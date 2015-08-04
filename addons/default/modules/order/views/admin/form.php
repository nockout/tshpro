<section class="title">
<?php if (empty($id_template)): ?>
	<h4><?php echo lang('template:create_title') ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('template:edit_title'), isset($name)?htmlspecialchars_decode($name):"") ?></h4>
<?php endif;?>

</section>
<section class="item">
	<div class="content">

<div class="tabs">

			<ul class="tab-menu">
				<li><a href="#information"><span><?php echo lang('template:information') ?></span></a></li>
				
				<li><a href="#images"><span><?php echo lang('template:images') ?></span></a></li>
			</ul>
			
			<!-- Content tab -->
			<?php  $this->load->view("admin/information")?>	
		
		<?php $this->load->view("admin/images")?>	
		


		<input type="hidden" name="row_edit_id"
			value="<?php if ($this->method != 'create'): echo $id_template; endif; ?>" />

	


	
</div>
</section>