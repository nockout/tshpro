<div class="col-sm-6 col-sm-offset-3">


<div class="explain">
			<?php echo Asset::img("aff-design-sell.png","",$attr = array( "class"=>"img-responsive center-block"));?>
			
			<h3 class="text-center">Design. Share. Profit.</h3>
			
			<?php if ( ! empty($error_string)):?>
<!-- Woops... -->
<div class="error-box">
	<?php echo $error_string;?>
</div>
<?php endif;?>
			
			<?php echo form_open('customer/users/register', array('id' => 'register')) ?>
				
				
				<div class="form-group">
						<label for="email"><?php echo lang('global:email') ?></label>
		<input type="text" name="email" class="form-control"  maxlength="100" value="<?php echo $_user->email ?>" />
		<?php echo form_input('d0ntf1llth1s1n', ' ', 'class="default-form" style="display:none"') ?>
					</div>
				
					<div class="form-group">
					<label for="username"><?php echo lang('user:username') ?></label>
					<input type="text" name="username"  class="form-control"maxlength="100" value="<?php echo $_user->username ?>" />
					</div>
				
					<div class="form-group">
					<label>Password</label>
						<label for="password"><?php echo lang('global:password') ?></label>
						<input type="password" class="form-control" name="password" maxlength="100" />
		
					</div>
		
			<div class="form-group">
					<label>first name</label>
						<input type="text" class="form-control"  maxlength="50" id="first_name" value="" name="first_name">
					</div>
					
						<div class="form-group">
					<label>last name</label>
						<input type="text" class="form-control" maxlength="50" id="last_name" value="" name="last_name">
					</div>	
					<div class="form-group">
					<label>Phone</label>
					
						<input type="text" class="form-control" maxlength="20" id="phone" value="" name="phone">
					</div>
					
					<label>Company</label>
						<input type="text" class="form-control" maxlength="100" id="company" value="" name="company">
					</div>
					
					
					
					<div class="form-group">
					<label>Country:</label>
						<select class="form-control" name="country" id="country">
							
			
			<option value="Vietnam_VN">Vietnam</option>
		
						</select>
					</div>
		

				<div class="checkbox">
					<label>
					  <input type="checkbox" value="1" name="terms" id="terms"> I have read and agree to the <a href="https://www.sunfrog.com/terms/affiliate-terms.cfm">terms and conditions</a>
					</label>
				 </div>
	
				<div class="checkbox">
					<label>
					  <input type="checkbox" checked="" id="MailingList" value="1" name="MailingList">Mailing List <em>Get notified of new designs, win free shirts, receive special discounts. </em>
					</label>
				 </div>
				
				
				<center>
				<a class="btn btn-default" href="#" target="_blank"><i class="fa fa-eye"></i> Privacy Policy.</a><br><br>
				</center>
				
			
				
				<input type="hidden" value="<?php ?>" name="randValue">
				<div class="col-sm-8 col-sm-offset-2">
					<input type="submit" value="Sign Up Now" class="btn btn-success btn-lg btn-block" name="submit">
				</div>
				<div class="clearfix"></div>

			</form>

			
			</div>
</div>			