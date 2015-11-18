<div id="maincontentWrap">


	<div class="container">
		<div class="page-header">
			<h2 class="text-center"><?php echo lang('user:register_header')?></h2>
		</div>
		<?php if ( ! empty($error_string)):?>

				<div class="alert alert-danger">
					<?php echo $error_string;?>
				</div>
		<?php endif?>
	<?php echo form_open('register/artis', array('id' => 'register'))?>
		<div class="col-sm-6 col-sm-offset-3">
			<div class="explain">
				<img class="img-responsive center-block"
					src="<?php echo Asset::get_filepath_img('aff-design-share-sell.png')?>">
				<h3 class="text-center">Design. Share. Profit.</h3>



				<div class="form-group">
					<label class="required" for="first_name"><?php echo lang('global:first_last_name')?> </label>
					<?php $pl=lang('global:first_last_name');?>
					<?php echo form_input('first_name',set_value('first_name'),"id='first_name' placeholder='$pl' class='form-control'")?>
					</div>

				<div class="form-group">
					<label class="required" for="first_name"><?php echo lang('global:user_name')?> </label>
					<?php $pl=lang('global:user_name');?>
					<?php echo form_input('username',set_value('username'),"id='username' placeholder='$pl' class='form-control'")?>
					</div>


				<div class="form-group">
					<label class="required" for="email">
						<?php echo lang('global:email') ?></label>
						<?php echo form_input('email',set_value('email'),"placeholder='artist@example.com' class='form-control'")?>
					</div>



				<div class="form-group">
					<label class="required" for="password"><?php echo lang('global:password') ?></label>
						<?php $pl=lang('global:password');?>
					<?php echo form_password('password',set_value('password'),"placeholder='$pl' class='form-control'")?>
			
				</div>
				<div class="form-group">
					<label class="required"><?php echo lang('global:confirm_password');$pl=lang('global:confirm_password') ?></label> 
						<?php echo form_password('confirm',set_value('confirm'),"placeholder='$pl' class='form-control'")?>
					
				</div>


				<div class="form-group row">
					<div class="col-lg-6 col-xl-12">
					<?php echo $cap['image']?>
					 </div>
					<div class="col-lg-6 col-xl-12">

						<input type="text" class="form-control" id="capText"
							name="capText"> <small><em>* <?php echo lang('global:captcha_remind')?></em></small>
					</div>

				</div>
				<div class="form-group">
					<div class="checkbox">
						<label> <input type="checkbox" value="1" name="terms" id="terms">
						<?php $anchor= anchor(site_url('term'),lang('global:term_conditional'))?>
							<?php echo sprintf(lang('global:read_and_agree'),$anchor,Settings::get('site_name') )?>
								
						</label>
					</div>
					<center>

						<a class="btn btn-default"
							href="<?php site_url('chinh-sach-bao-mat')?>" target="_blank"><i
							class="fa fa-eye"></i> <?php echo lang('global:privacy_policy')?>.</a><br>
						<br>
					</center>
					<input type="hidden" value="01140823EA51828C6B2B754FAE288688"
						name="randValue">
					<div class="col-sm-8 col-sm-offset-2">
						<input type="submit" value="<?php echo lang('global:sign_up')?>"
							class="btn btn-success btn-lg btn-block" name="submit">
					</div>
					<div class="clearfix"></div>
				</div>



			</div>
		</div>
<?php echo form_close()?>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){

	$("#first_name").on('keyup keypress blur change',function(e){
	 	var _nick=$(this).val();
		var re = /(?![\x00-\x7F]|[\xC0-\xDF][\x80-\xBF]|[\xE0-\xEF][\x80-\xBF]{2}|[\xF0-\xF7][\x80-\xBF]{3})./g;
		_nick = _nick.replace(re, "")
		_nick=_nick.replace(/\s+/g, '');;
	
		$("#username").val(_nick);
	});

});

</script>