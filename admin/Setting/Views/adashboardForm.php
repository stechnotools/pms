<?php
$validation = \Config\Services::validation();
?>

<?php echo form_open_multipart('', 'id="form-dashboard"'); ?>
<div class="row">
	<div class="col-xl-12">
		
		<div class="block">
			<div class="block-header block-header-default content-heading <?=$hideclass?>" data-show="edit">
				<h3 class="block-title content-title"><?php echo $text_form; ?></h3>
				<div class="block-options">
					<button type="submit" form="form-dashboard" class="btn btn-primary">Save</button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="Cancel" class="btn btn-primary">Cancel</a>
				</div>
			</div>
			
			<div class="block-content">
                <div class="form-group <?=$validation->hasError('name')?'is-invalid':''?>">
                    <label for="name" >Report Name</label>
                    <?php echo form_input(array('class'=>'form-control','name' => 'name', 'id' => 'name', 'placeholder'=>'Name','value' => set_value('name', $name))); ?>
                    <div class="invalid-feedback animated fadeInDown"><?= $validation->getError('name'); ?></div>
                </div>
                <div class="form-group <?=$validation->hasError('route')?'is-invalid':''?>">
                    <label for="name" >Report Route Path</label>
                    <?php echo form_input(array('class'=>'form-control','name' => 'route', 'id' => 'route', 'placeholder'=>'Route','value' => set_value('route', $route))); ?>
                    <div class="invalid-feedback animated fadeInDown"><?= $validation->getError('route'); ?></div>
                </div>
				<div class="form-group <?=$validation->hasError('col')?'is-invalid':''?>">
					<label for="name" >Width</label>
					<?php echo form_input(array('class'=>'form-control','name' => 'col', 'id' => 'col', 'placeholder'=>'Width','value' => set_value('col', $col))); ?>
					<div class="invalid-feedback animated fadeInDown"><?= $validation->getError('col'); ?></div>
				</div>	
			</div> 
		</div>
	</div> 
</div>
<?php echo form_close(); ?>
