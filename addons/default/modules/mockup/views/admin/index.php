<div class="one_full">
	<section class="title">
		<h4><?php echo lang('mockup:mockup_title') ?></h4>
	</section>

	<section class="item">
		<div class="content">
			<?php if (isset($mockups)&&count($mockups)) : ?>
				<?php echo $this->load->view('admin/partials/filters') ?>
				
				<?php echo form_open('admin/mockup/action') ?>
				
					<div id="filter-stage">
						<?php echo $this->load->view('admin/tables/mockups') ?>
					</div>
				<?php echo form_close() ?>
			<?php else : ?>
				<div class="no_data"><?php echo lang('mockup:currently_no_mockups') ?></div>
			<?php endif ?>
		</div>
	</section>
</div>
