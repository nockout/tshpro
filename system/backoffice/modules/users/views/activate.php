


<div id="maincontentWrap">

<?php echo form_open('users/activate', 'id="activate-user"')?>
	<div class="container">
		<div class="page-header">
			<h2 class="page-title text-center" id="page_title"><?php echo lang('user:register_header') ?></h2>
		</div>
		<?php if ( ! empty($error_string)):?>

				<div class="alert alert-danger">
					<?php echo $error_string;?>
				</div>
		<?php endif?>
	
		<div class="col-sm-6 col-sm-offset-3">
			<div class="explain">
	<div class="form-group">
				<div class="wizard text-center">
					<a><span class="  badge">1</span><?php echo lang('user:register_step1') ?></a>

					<a class="current"><span class="badge badge-inverse ">2</span> <?php echo lang('user:register_step2') ?></a>
				</div>
</div>
				<div class="form-group">
					<label for="email"><?php echo lang('global:email') ?></label>
		<?php echo form_input('email', isset($_user['email']) ? escape_tags($_user['email']) : '', 'maxlength="40" class="form-control"');?>
				</div>

				<div class="form-group">
					<label for="activation_code"><?php echo lang('user:activation_code') ?></label>
		<?php echo form_input('activation_code', '', 'maxlength="40" class="form-control"');?>
				</div>
				<div class="form-group">
				
				<?php echo form_submit('btnSubmit', lang('user:activate_btn'),'class="btn btn-success btn-lg btn-block"')?>
				
				</div>
			</div>
		</div>

	</div>
<?php echo form_close()?>
</div>

