<div class="row mb-2">
    <div class="col-sm-4">
        <a href="<?=$add?>" class="btn btn-danger rounded-pill mb-3 ajaxaction"><i class="mdi mdi-plus"></i> Create Project</a>
    </div>
    <div class="col-sm-8">
        <div class="text-sm-end">
            <div class="btn-group mb-3">
                <button type="button" class="btn btn-primary">All</button>
            </div>
            <div class="btn-group mb-3 ms-1">
                <button type="button" class="btn btn-light">Ongoing</button>
                <button type="button" class="btn btn-light">Finished</button>
            </div>
            <div class="btn-group mb-3 ms-2 d-none d-sm-inline-block">
                <button type="button" class="btn btn-secondary"><i class="ri-function-line"></i></button>
            </div>
            <div class="btn-group mb-3 d-none d-sm-inline-block">
                <button type="button" class="btn btn-link text-muted"><i class="ri-list-check-2"></i></button>
            </div>
        </div>
    </div><!-- end col-->
</div>
<div class="row">
    <?php foreach($projects as $project){?>
    <div class="col-sm-6 col-xl-3 mb-3">
        <div class="card d-block h-100 border border-light">
            <div class="card-body">
                <div class="dropdown card-widgets">
                    <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-fill"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                        <!-- item-->
                        <a href="<?=admin_url('project/edit/'.$project->id)?>" class="dropdown-item ajaxaction"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                        <!-- item-->
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="<?=admin_url('project/view/'.$project->id)?>" class="">
                        <div class="roundimage" style="background:<?=$project->color?>"><?=initialName($project->name)?></div>
                    </a>
                    <h5 class="m-0">
                        <a href="<?=admin_url('project/view/'.$project->id)?>" title="<?=$project->name;?>" class=""><?=$project->name;?></a>
                    </h5>
                </div>
                <!-- project title-->
                
                <div class="badge bg-success my-1"><?=$project->status;?></div>

                <p class="mb-0"><b>Due Date:</b> <?=$project->end_date;?></p>

                <p class="text-muted font-13 my-1"><?=$project->description;?>...<a href="javascript:void(0);" class="fw-bold text-muted">view more</a></p>
                <!-- project detail-->
                <p class="mb-1 d-flex justify-content-between">
                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                        <i class="mdi mdi-format-list-bulleted-type text-muted"></i>
                        <b><?=$project->total_taskes?></b> <br>Tasks
                    </span>
                    <span class="text-nowrap mb-2 d-inline-block">
                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                        <b><?=$project->total_comments?></b> <br>Comments
                    </span>
                </p>
                <div id="tooltip-container">
                    <?php foreach($project->users as $user){?>
                    <a href="javascript:void(0);" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" class="d-inline-block" aria-label="<?=$user->firstname?>" data-bs-original-title="<?=$user->firstname?>">
                        <img src="<?=$user->image?>" class="rounded-circle avatar-xs" alt="friend">
                    </a>
                    <?}?>

                   
                    <a href="javascript:void(0);" class="d-inline-block text-muted fw-bold ms-2">
                        +7 more
                    </a>
                </div>
            </div> <!-- end card-body-->

        </div>


        </div>
    <?}?>

    <!-- end col -->
</div>

<?php js_start(); ?>
<script type="text/javascript"><!--
//--></script>
<?php js_end(); ?>