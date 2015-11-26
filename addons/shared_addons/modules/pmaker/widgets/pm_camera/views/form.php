<ol>
    <fieldset>
        <legend>Slider Settings</legend>
        <li class="<?php echo alternator('even', ''); ?>">
		<label>Choose Slider:</label>
		<?php echo form_dropdown('slider', $slider_options, $options['slider']); ?>
		<label>Type:</label>
		<?php echo form_dropdown('type', array('slideshow'=>'slideshow','carousel'), $options['type']); ?>
	</li>
    </fieldset>
        
    
</ol>