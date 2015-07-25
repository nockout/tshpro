<fieldset>
    <?php if (($mockup_id)): ?>
       
   <div class="container">
		
		<!-- Bootstrap CSS fixes for IE6 -->
		<!--[if lt IE 7]>
			<?php Asset::css("module::bootstrap-ie6.min.css") ?>
		<![endif]-->
		<!-- Bootstrap Image Gallery styles -->
		<?php Asset::css("module::bootstrap-image-gallery.min.css") ?> 
		
		<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
			<?php Asset::css("module::jquery.fileupload-ui.css") ?> 
		<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
		<!-- The file upload form used as target for the file upload widget -->
		<?php $attribute=array('id'=>'fileupload')?>
<?php //echo form_open_multipart('admin/mockup/img_upload',$attribute); ?>		
<form id="fileupload" action="admin/mockup/img_upload" method="POST" enctype="multipart/form-data">
    		<div class="fileupload-buttonbar">
				<div class="fileupload-buttons">

					<span class="fileinput-button"> <span>Add files...</span> <input
						type="file" name="files[]" multiple>
					</span>
					<button type="submit" class="start">Start upload</button>
					<button type="reset" class="cancel">Cancel upload</button>
					<button type="button" class="delete">Delete</button>
					<input type="checkbox" class="toggle">
					<!-- The loading indicator is shown during file processing -->
					<span class="fileupload-loading"></span>
				</div>
				<!-- The global progress information -->
				<div class="fileupload-progress fade" style="display: none">
					<!-- The global progress bar -->
					<div class="progress" role="progressbar" aria-valuemin="0"
						aria-valuemax="100"></div>
					<!-- The extended global progress information -->
					<div class="progress-extended">&nbsp;</div>
				</div>
			</div>
			<!-- The table listing the files available for upload/download -->
			<table role="presentation">
				<tbody class="files"></tbody>
			</table>
	<?php echo form_close();?>
		<br>
		<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade" style="display:none">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            {% if (file.error) { %}
                <div><span class="error">Error:</span> {%=file.error%}</div>
            {% } %}
              <!--<p class="size">{%=o.formatFileSize(file.size)%}</p>-->
            {% if (!o.files.error) { %}
                <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"></div>
            {% } %}
        </td>
       
        <td>
            {% if (!o.files.error && !i && !o.options.autoUpload) { %}
                <button class="start">Start</button>
            {% } %}
            {% if (!i) { %}
                <button class="cancel">Cancel</button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
		<!-- The template to display files available for download -->
		<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade" style="display:none">
        <td>
            <span class="preview">
              
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.url%}"></a>
             
            </span>
        </td>
        <td>
<!--            <p class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            </p>-->
            {% if (file.error) { %}
                <div><span class="error">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            <button class="delete" data-type="{%=file.deleteType%}" data-url="{%=file.delete_url%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>Delete</button>
            <input type="checkbox" name="delete" value="1" class="toggle">
        </td>
    </tr>
{% } %}
</script>


	</div>
    <?php endif ?>

</fieldset>
