<div class="one_full">
	<section class="title">
		<h4><?php echo lang('design:design_title') ?></h4>
	</section>

	<section class="item">
		<div class="content">
		
			<?php if ($designs) : ?>
			<?php echo $this->load->view('admin/tables/moredesign') ?>
				<?php echo $this->load->view('admin/partials/filters') ?>
			
				<?php echo form_open('admin/tdesign/action') ?>
				
					<div id="filter-stage">
						<?php echo $this->load->view('admin/tables/designs') ?>
					</div>
				<?php echo form_close() ?>
				
			<?php else : ?>
				<div class="no_data"><?php echo lang('design:currently_no_products') ?></div>
			<?php endif ?>
		</div>
	</section>
</div>
