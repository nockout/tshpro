
<div class="one_full">
	<section class="title">
		<h4><?php echo lang('category:template_title') ?></h4>
	</section>

	<section class="item">
		<div class="content">
			<?php if (isset($categories)&&count($categories)) : ?>
			
				<?php echo $this->load->view('admin/partials/filters') ?>
				
				<?php echo form_open('admin/category/action') ?>
				
					<div id="filter-stage">
						<?php echo $this->load->view('admin/tables/categories') ?>
					</div>
				<?php echo form_close() ?>
			<?php else : ?>
				<div class="no_data"><?php echo lang('category:currently_no_templates') ?></div>
			<?php endif ?>
		</div>
	</section>
</div>
