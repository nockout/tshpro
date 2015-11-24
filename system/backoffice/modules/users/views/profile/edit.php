<div id="maincontentWrap">
	<div class="container">
		<div class="page-header">
			<h2 id="page_title" class="text-center page-title">
				<?php echo ($this->current_user->id !== $_user->id) ? sprintf ( lang ( 'user:edit_title' ), $_user->display_name ) : lang ( 'profile_edit' )?>
			</h2>
		</div>

		<div>
	<?php if (validation_errors()):?>
	<div class="error-box alert alert-danger">
		<?php echo validation_errors();?>
	</div>
	<?php endif;?>

	<?php echo form_open_multipart('', array('id'=>'user_edit'));?>


				<div class=" col-sm-6 col-lg-6 col-sm-6">
					<fieldset id="profile_fields">
						<h2 class="organe"><?php echo lang('user:details_section') ?></h2>
						
				
			<?php foreach($profile_fields as $field): ?>
				<?php if($field['input']): ?>
					<div class="form-group">
					<label for="<?php echo $field['field_slug'] ?>" >
							<?php echo (lang($field['field_name'])) ? lang($field['field_name']) : $field['field_name'];  ?>
							
						</label>

						<?php if($field['instructions']) echo '<p class="instructions">'.$field['instructions'].'</p>'?>
						<?php if($field['field_type']=='text' || $field['field_type']=='url'):?>
						<?php echo   form_input(array('name' => $field['field_slug'], 'class'=>" form-control",'id' => $field['field_slug'], 'value' => set_value($field['field_slug'], $field['value'])));?>
						<?php elseif($field['field_type']=='textarea'):?>
						<?php echo   form_textarea(array('name' => $field['field_slug'], 'class'=>" form-control",'id' => $field['field_slug'], 'value' => set_value($field['field_slug'], $field['value'])));?>
						<?php else:?>
						<?php ;echo $field['input']?>
						<?php endif?>
						
							
						
					</div>
				<?php endif ?>
			<?php endforeach ?>
		</fieldset>
		</div>
	<div class=" col-sm-6 col-lg-6 col-sm-6 ">			
	<h2 class="organe"><?php echo lang('user:details_signin') ?></h2>
						
					
					<div class="form-group">
					
						<label for="email"><?php echo lang('global:email') ?></label>
								
					<?php echo form_input('email', $_user->email,'class=" form-control"')?>
				
					</div>
					
						
						<div class="form-group">
						<label for="display_name" class="required"><?php echo lang('profile_display_name') ?></label>
							
						<?php echo form_input(array('name' => 'display_name', 'class'=>" form-control",'id' => 'display_name', 'value' => set_value('display_name', $display_name)))?>
						</div>
					
						<div class="form-group">
					<label class="required" for="first_name"><?php echo lang('global:user_name')?> </label>
					<?php $pl=lang('global:user_name');?>
					<?php echo form_input('username',set_value('username'),"id='username' placeholder='$pl' class='form-control'")?>
					</div>
					
						
			<div class="form-group"><label for="password"><?php echo lang('global:password') ?></label><br />
				<?php echo form_password('password', '', 'autocomplete="off" class=" form-control"')?>
			</div>
					

	<?php if (Settings::get('api_enabled') and Settings::get('api_user_keys')): ?>
		
	<script>
	jQuery(function($) {
		
		$('input#generate_api_key').click(function(){
			
			var url = "<?php echo site_url('api/ajax/generate_key') ?>",
				$button = $(this);
			
			$.post(url, function(data) {
				$button.prop('disabled', true);
				$('span#api_key').text(data.api_key).parent('li').show();
			}, 'json');
			
		});
		
	});
	</script>

					<fieldset>
					<h2 class="organe"><?php echo lang('profile_api_section') ?></h2>

						<ul>
							<li <?php $api_key or print('style="display:none"') ?>><?php echo sprintf(lang('api:key_message'), '<span id="api_key">'.$api_key.'</span>') ?></li>
							<li><input type="button" id="generate_api_key"
								value="<?php echo lang('api:generate_key') ?>" /></li>
						</ul>

					</fieldset>
					
		</div>				
	<?php endif ?>

	<?php echo form_submit('', lang('profile_save_btn'),'class="btn btn-lg btn-success center-block"')?>
	<?php echo form_close() ?>

			</div>
		</div>
	</div>
</div>