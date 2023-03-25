<div class="row">
    <?php foreach($teams as $team){?>
    <div class="col-sm-6 col-xl-3 mb-3">
        <div class="card mb-0 h-100" style="background-image: url(<?=theme_url('assets/images/bg-pattern.png')?>);">
            <div class="card-body">
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                        <a href="<?=admin_url('team/edit/'.$team->id)?>" class="dropdown-item ajaxaction"><i class="mdi mdi-square-edit-outline me-1"></i> Edit</a>
                        <!-- item-->
                        <hr class="dropdown-divider">
                        <a href="javascript:void(0);" class="dropdown-item text-danger"><i class="mdi mdi-trash-can-outline me-1"></i> Detele</a>
                    </div>
                </div>
                <a href="<?=admin_url('team/view/'.$team->id);?>"><h4 class="header-title"><?=$team->name;?></h4></a>
                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent"><?=$team->description;?></h5>
                <div class="d-flex align-items-center mt-4">
                    <div class="flex-shrink-0">
                       <span class="pe-2 text-nowrap mb-2 d-inline-block">
                            <i class="mdi mdi-format-list-bulleted-type text-muted"></i>
                            <b><?=$team->total_task?></b> Tasks
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-2"></div>
                    <div class="text-end multi-user">
                        <?php foreach($team->users as $user){?>
                        <a href="javascript:void(0);" class="d-inline-block">
                            <img src="<?=$user->image?>" class="rounded-circle avatar-xs" alt="<?=$user->firstname?>">
                        </a>
                        <?}?>
                        
                        <a href="javascript:void(0);" class="d-inline-block ms-n2">
                            <div class="avatar-xs">
                                <span class="avatar-title bg-primary rounded-circle">
                                    +2
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
    <?}?>

    <div class="col-sm-6 col-xl-3 mb-3">
        <div class="card mb-0 h-100">
            <div class="card-body">
                <div class="border-dashed border-2 border h-100 w-100 rounded d-flex align-items-center justify-content-center">
                    <a href="<?=$add?>" class="text-center text-muted p-2 ajaxaction" data-bs-toggle="modal" data-bs-target="#CreateProject">
                        <i class="mdi mdi-plus h3 my-0"></i> <h4 class="font-16 mt-1 mb-0 d-block">Add New Team</h4>
                    </a>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>

<?php js_start(); ?>
<script type="text/javascript"><!--
//--></script>
<?php js_end(); ?>