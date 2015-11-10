
<div style="min-height: 400px; padding-top: 1em" class="container">
	<h1 id="srshow" class="top_title art_title">
		<i class="fa fa-user"></i> <?php if(!empty($user)) echo sprintf("%s %s",$user->first_name,$user->last_name)?>.
	</h1>

	<form method="get" action="" name="">
		<input type="hidden" value="" name="a">
		<div class="row">
			<div class="col-xs-6 col-md-3 col-md-offset-6">
				<div class="form-group">
					<select onchange="submit();" name="schTrmFilter"
						class="form-control">

						<option value=""><?php echo lang('global:sort_by')?></option>
						<option <?php if($order=='sales'):?> selected="true" <?php endif?>
							value="sales"><?php echo lang('global:bestseller')?></option>
						<option <?php if($order=='new'):?> selected="true" <?php endif?>
							value="new"><?php echo lang('sort:newest')?></option>
						<option <?php if($order=='popular'):?> selected="true"
							<?php endif?> value="popular"><?php echo lang('global:mostpopular')?></option>
					</select>
				</div>
				<!-- /input-group -->
			</div>
			<!-- /.col-lg-6 -->
			<div class="col-xs-6 col-md-3">
				<div class="input-group">
					<input type="text"
						placeholder="<?php echo sprintf(lang('global:search_for'),$user->username) ?>..."
						name="searchart" class="form-control"> <span
						class="input-group-btn">
						<button name="go" type="submit" class="btn btn-default"><?php echo lang('global:go')?>!</button>
					</span>
				</div>
				<!-- /input-group -->
			</div>
			<!-- /.col-lg-6 -->
		</div>
		<!-- /.row -->
	</form>
	<div class="clearfix"></div>
	<hr style="margin-top: 0px;">
	<div class="clearfix"></div>


	<div id="theArtResults">
		<div id="exp40" style="">
			<?php if(!empty($products)):?>
			<?php echo $this->load->view("listproduct",array("products"=>$products),true)?>
			<?php else:?>
					<div class="row">

				<div class="col-md-12"></div>

			</div>
		<?php endif?>
			<div class="row">

				<div class="col-md-12 text-center">
				<?php echo $pagination?>
				</div>

			</div>
				
		</div>

		<div class="clearfix"></div>
	</div>
	
</div>

<?php ?>



</div>