<section class="title">
<?php if (empty($mockup_id)): ?>
	<h4><?php echo lang('mockup:create_title') ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('mockup:edit_title'), isset($name)?htmlspecialchars_decode($name):"") ?></h4>
<?php endif;?>

</section>
<section class="item">
	<div class="content">

<div class="tabs">

			<ul class="tab-menu">
				<li><a href="#information"><span><?php echo lang('mockup:information') ?></span></a></li>
				<li><a href="#combinations"><span><?php echo lang('mockup:combinations') ?></span></a></li>
				<li><a href="#images"><span><?php echo lang('mockup:images') ?></span></a></li>
			</ul>

			<!-- Content tab -->
			<?php $this->load->view("admin/information")?>	
		<?php $this->load->view("admin/combinations")?>	
		<?php $this->load->view("admin/images")?>	
		


		<input type="hidden" name="row_edit_id"
			value="<?php if ($this->method != 'create'): echo $mockup_id; endif; ?>" />

	


	
</div>
</section>