<?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-danger animated fadeIn">
	<p><?php echo $this->session->flashdata('error'); ?></p>
</div>
<?php endif; ?>

<?php if (validation_errors()): ?>
<div class="alert alert-danger animated fadeIn">
	<p><?php echo validation_errors(); ?></p>
</div>
<?php endif; ?>

<?php if ( ! empty($messages['error'])): ?>
<div class="alert alert-danger animated fadeIn">
	<p><?php echo $messages['error']; ?></p>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('notice')): ?>
<div class="alert alert-warning animated fadeIn">
	<p><?php echo $this->session->flashdata('notice');?></p>
</div>
<?php endif; ?>

<?php if ( ! empty($messages['notice'])): ?>
<div class="alert alert-warning animated fadeIn">
	<p><?php echo $messages['notice']; ?></p>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success animated fadeIn">
	<p><?php echo $this->session->flashdata('success'); ?></p>
</div>
<?php endif; ?>

<?php if ( ! empty($messages['success'])): ?>
<div class="alert alert-success animated fadeIn">
	<p><?php echo $messages['success']; ?></p>
</div>
<?php endif; ?>

<?php 


	
?>