<?php
$validation = \Config\Services::validation();
$errors = $validation->getErrors();
$validaion_error_class=$errors ? 'was-validated':'';
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="d-flex card-header justify-content-between align-items-center bg-primary p-2 text-dark bg-opacity-50">
                <h4 class="header-title"><?php echo $text_form; ?></h4>
                <div class="btn-groups">
                    <button type="submit" form="form-project" class="btn btn-sm btn-primary">Save</button>
                    <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="Cancel" class="btn btn-sm btn-primary">Cancel</a>
                </div>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('', 'id="form-project" class="needs-validation '.$validaion_error_class.'" novalidate'); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Team Name</label>
                        <?php echo form_input(array('class'=>'form-control','name' => 'name', 'id' => 'name', 'placeholder'=>'Name','value' => set_value('name', $name),'required'=>true)); ?>
                        <div class="invalid-feedback "><?= $validation->getError('name'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="project-overview" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter some description.."><?=$description?></textarea>
                    </div>
                    <div class="mb-3 mt-3 mt-xl-0">
                        <label for="projectname" class="mb-0">Color</label>
                        <?php echo form_input(array('class'=>'form-control','type'=>'color','name' => 'color', 'id' => 'color', 'placeholder'=>'Color','value' => set_value('color', $color))); ?>
                    </div>
                   
                <!-- end row -->
                <?php echo form_close(); ?>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<?php js_start(); ?>
<script>

</script>
<?php js_end(); ?>