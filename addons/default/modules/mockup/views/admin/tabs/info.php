<div class="form_inputs" id="information">

	<div class="one_half">
		<fieldset>
			<ul>
				<li><label for="title"><?php echo lang('global:title') ?> <span>*</span></label>
					<div class="input"><?php echo form_input('title', set_value('title',$title), 'maxlength="100" id="title"') ?></div>
				</li>
				<li><label for="price"><?php echo lang('mockup:mockup_price') ?> <span>*</span></label>
					<div class="input"><?php echo form_input('price', set_value('price',$price), 'maxlength="100" id="price"') ?></div>
				</li>
				<li><label for="category_id"><?php echo lang('mockup:category_label') ?></label>
					<div class="input">
					<?php echo form_dropdown('category_id', array(lang('mockup:no_category_select_label')) + $categories,set_value('category_id',@cate_id) ) ?>	
					</div></li>


				<li><label for="status"><?php echo lang('mockup:status') ?></label>

					<div class="input"><?php echo form_dropdown('status', array(""=>lang(""), 'A' => lang('mockup:active'),'D' => lang('mockup:inactive'), set_value("status",$status))) ?></div>


				</li>



			</ul>

		</fieldset>
	</div>

</div>
