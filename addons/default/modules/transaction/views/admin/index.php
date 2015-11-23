<div class="one_full">
	<section class="title">
		<h4><?php echo lang('transaction:title') ?></h4>
	</section>

	<section class="item">
		<div class="content">
			
				<?php echo $this->load->view('admin/partials/filters') ?>
				<?php if (isset($trans)&&count($trans)) : ?>
				<?php echo form_open('admin/transaction/action') ?>
				
					<div id="filter-stage">
						<?php echo $this->load->view('admin/tables/trans') ?>
					</div>
					<?php else : ?>
				<div class="no_data"><?php echo lang('transaction:currently_no_trans') ?></div>
			<?php endif ?>
				<?php echo form_close() ?>
			
		</div>
	</section>
</div>
