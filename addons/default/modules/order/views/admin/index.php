<div class="one_full">
	<section class="title">
		<h4><?php echo lang('template:template_title') ?></h4>
	</section>

	<section class="item">
		<div class="content">
			<?php if (isset($orders)&&count($orders)) : ?>
				<?php echo $this->load->view('admin/partials/filters') ?>
				
				<?php echo form_open('admin/order/action') ?>
				
					<div id="filter-stage">
						<?php echo $this->load->view('admin/tables/orders') ?>
					</div>
				<?php echo form_close() ?>
			<?php else : ?>
				<div class="no_data"><?php echo lang('template:currently_no_templates') ?></div>
			<?php endif ?>
		</div>
	</section>
</div>
