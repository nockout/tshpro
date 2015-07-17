<?php if(!empty($error_string)): ?>
<div class="error-box">
	<?php echo $error_string?>
</div>
<?php endif;?>
<section class="item">
	<br />
	<div class="entry-content">
	<div class="container-fluid">
		<div class="yes"></div>
		<div class="row-fluid content item">
		<?php echo $this->load->view("admin/create/text_widget")?>
		<?php echo $this->load->view("admin/create/area")?>
		<?php echo $this->load->view("admin/create/image_widget")?>
	

	</div>
	</div>
	<div id="myModal" class="modal hide fade">
		<div class="modal-body"></div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
	</div>

	<div id="convascontent" style="display: none"></div>
	</div>
</section>