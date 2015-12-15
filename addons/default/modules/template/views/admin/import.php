<div class="one_full">
	<section class="title">
		<h4>Upload</h4>
	</section>
	<section class="item">
		<div class="content">
			<fieldset id="filters">
				
				<?php echo form_open_multipart('admin/template/doimport');?>
					<ul>
					<li class=""><label for="f_category">File</label> <input
						type="file" name="spreedsheet" size="20" /></li>
					<li><input type="submit" value="upload" /></li>
				</ul>
	
					
				<?php echo form_close()?>
			</fieldset>	
			<?php if($error=$this->session->flashdata('import_errors')):?>	
			<?php $errors=(array)json_decode($error)?>
		<div id="filter-stage" style="display: block;">
			<table cellspacing="0" cellpadding="0" border="0" class="table-list">
				<tbody>
				<?php foreach ($errors as $error):?>
					<tr>
						<td class="align-center"><?php echo $error?></td>
						
						
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
		<?php endif?>
	</section>
</div>
</div>