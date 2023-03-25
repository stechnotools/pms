<?php

?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">                                    
            <div class="page-title-right">
            <div class=" row text-end row d-flex justify-content-end col-auto">  
                <div class="col-sm-auto  ">
                    <a href="<?=admin_url('project')?>" class="btn btn-xs btn-primary btn-icon-only width-auto ">Overview</a>
                </div> 
                <div class="col-sm-auto  ">
                <a href="<?=admin_url('task')?>" class="btn btn-xs btn-primary btn-icon-only width-auto ">Task Board</a>
                </div>      
                <!--<div class="col-sm-auto  ">
                    <a href="#" class="btn btn-xs btn-primary btn-icon-only width-auto ">Timesheet</a>
                </div>
                <div class="col-sm-auto  ">
                <a href="#" class="btn btn-xs btn-primary btn-icon-only width-auto ">Gantt Chart</a>
                </div>
                
                <div class="col-sm-auto  ">
                    <a href="" class="btn btn-xs btn-primary btn-icon-only width-auto">Discussion</a>
                </div>
                <div class="col-sm-auto ">
                    <a href="" class="btn btn-xs btn-primary btn-icon-only width-auto ">Files</a>
                </div>-->
        </div>
            </div>
            <h4 class="page-title">Project Details</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="d-block d-sm-flex align-items-center justify-content-between">
                    <h4 class="text-white">  <?=$project->name;?></h4>
                    <div class="d-flex  align-items-center">
                        <div class="px-3">
                            <span class="text-white text-sm">Start Date:</span>
                            <h5 class="text-white text-nowrap"><?=$project->start_date;?></h5>
                        </div>
                        <div class="px-3">
                            <span class="text-white text-sm">Due Date:</span>
                            <h5 class="text-white"><?=$project->end_date;?></h5>
                        </div>
                        <div class="px-3">
                            <span class="text-white text-sm">Total Members:</span>
                            <h5 class="text-white text-nowrap"><?=count($project_user);?></h5>
                        </div>
                        <div class="px-3">
                            <div class="badge  bg-success p-2 px-3 rounded"> <?=$project->status;?> </div>
                        </div>
                    </div>
                                                                                                                                    
                    <div class="d-flex align-items-center ">
                        <button class="btn btn-light d-flex align-items-between me-3">
                            <a href="<?=admin_url('project/edit/'.$project->id)?>" class="ajaxaction" data-title="Edit Project" data-toggle="popover" title="Edit">
                                <i class="mdi mdi-pencil-box-outline"> </i>
                            </a>
                        </button>
                        <button class="btn btn-light d">
                            <a href="#" class="bs-pass-para" data-confirm="Are You Sure?" data-text="This action can not be undone. Do you want to continue?" data-confirm-yes="delete-form-5" data-toggle="popover" title="Delete">
                                <i class="mdi mdi-delete-outline"> </i>
                            </a>
                        </button>
                    </div>                                                                                                                                         
                </div>
            </div>
        </div>
    </div> <!-- end col-->
</div>
<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <div class="border border-light p-3 text-white rounded bg-info">
            <div class="d-flex justify-content-between align-items-center">
                <div class="avatar-sm">
                    <span class="avatar-title bg-danger rounded-circle h3 my-0">
                        <i class="mdi mdi-swap-horizontal"></i>
                    </span>
                </div> 
                <div>
                    <p class="font-18 mb-1">Total Task</p>
                    <h3 class="my-0"><?=$total_task?></h3>
                </div>                                     
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="border border-light p-3 text-white rounded bg-success">
            <div class="d-flex justify-content-between align-items-center">
                <div class="avatar-sm">
                    <span class="avatar-title bg-warning rounded-circle h3 my-0">
                        <i class="mdi mdi-swap-horizontal"></i>
                    </span>
                </div> 
                <div>
                    <p class="font-18 mb-1">Completed Task</p>
                    <h3 class="my-0"><?=$completed_task?></h3>
                </div>                                     
            </div>
        </div>
        
    </div>
        <div class="col-lg-3 col-6">
        <div class="border border-light p-3 text-white rounded bg-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div class="avatar-sm">
                    <span class="avatar-title bg-primary rounded-circle h3 my-0">
                        <i class="mdi mdi-swap-horizontal"></i>
                    </span>
                </div> 
                <div>
                    <p class="font-18 mb-1">Pending Task</p>
                    <h3 class="my-0"><?=$pending_task?></h3>
                </div>                                     
            </div>
        </div>
    </div>
        <div class="col-lg-3 col-6">
        <div class="border border-light p-3 text-white rounded bg-danger">
            <div class="d-flex justify-content-between align-items-center">
                <div class="avatar-sm">
                    <span class="avatar-title bg-info rounded-circle h3 my-0">
                        <i class="mdi mdi-swap-horizontal"></i>
                    </span>
                </div> 
                <div>
                    <p class="font-18 mb-1">Overdue Task</p>
                    <h3 class="my-0"><?=$overdue_task?></h3>
                </div>                                     
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-xxl-3">
        <div class="card card-h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title mb-0">Team Members</h4>
                <div>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected="">Active</option>
                        <option value="1">Offline</option>
                    </select>
                </div>
            </div>

            <div class="card-body py-0 mb-3" data-simplebar style="max-height: 304px;">
                <?php foreach($project_user as $puser){?>
                <div class="d-flex align-items-start  mt-3">
                    <img class="me-3 rounded-circle" src="<?=$puser->image?>" width="40" height="40" alt="<?=$puser->firstname?>">
                    <div class="w-100 overflow-hidden">
                        <h5 class="mt-0 mb-1 fw-semibold"><a href="javascript:void(0);" class="text-secondary"><?=$puser->firstname .' '.$puser->lastname?> Pearson</a></h5>
                        <ul class="list-inline mb-0 font-13">
                            <li class="list-inline-item">Project Manager</li>
                            <li class="list-inline-item text-muted"><i class="mdi mdi-circle-small"></i></li>
                            <li class="list-inline-item text-muted">Thematic Person</li>
                        </ul>
                    </div>
                </div>
                <?}?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xxl-3">
        <div class="card card-h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title mb-0">Active Task</h4>
                <div>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected="">Today</option>
                        <option value="1">Yesterday</option>
                        <option value="2">Tomorrow</option>
                    </select>
                </div>
            </div>
            <div class="card-body py-0 mb-3" data-simplebar style="max-height: 304px;">
                <?php foreach($taskes as $task){?>
                <div class="border rounded p-2 mb-2">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item font-16 fw-semibold">
                            <a href="javascript:void(0);" class="text-secondary"><?=$task->task_title;?></a>
                        </li>
                        <li class="list-inline-item text-muted"><i class="mdi mdi-circle-small"></i></li>
                        <li class="list-inline-item font-13 fw-semibold text-muted"><?=$task->created_at;?></li>
                    </ul>
                    <p class="text-muted mb-0"><?=$task->description;?></p>
                    <p class="text-muted mb-0"><i class="mdi mdi-account-group me-1"></i> <b>1</b> People</p>
                </div>
                <?}?>
                
                
                <div class="text-center">
                    <i class="mdi mdi-dots-circle mdi-spin font-20 text-muted"></i>
                </div>
            </div>
        
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-3">Project Progress</h5>
        <div dir="ltr">
            <div class="mt-3 chartjs-chart" style="height: 320px;">
                <canvas id="line-chart-example" style="box-sizing: border-box; display: block; height: 320px; width: 460px;" width="460" height="320"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-3">Thematic Task Progress(Date wise)</h5>
        <div dir="ltr">
            <div class="mt-3 chartjs-chart" style="height: 320px;">
                <canvas id="line-chart-example" style="box-sizing: border-box; display: block; height: 320px; width: 460px;" width="460" height="320"></canvas>
            </div>
        </div>
    </div>
</div>
    <!-- end card-->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Files</h5>

                <div class="card mb-1 shadow-none border">
                    <div class="p-2">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="avatar-sm">
                                    <span class="avatar-title rounded">
                                        .ZIP
                                    </span>
                                </div>
                            </div>
                            <div class="col ps-0">
                                <a href="javascript:void(0);" class="text-muted fw-bold">Hyper-admin-design.zip</a>
                                <p class="mb-0">2.3 MB</p>
                            </div>
                            <div class="col-auto">
                                <!-- Button -->
                                <a href="javascript:void(0);" class="btn btn-link btn-lg text-muted">
                                    <i class="ri-download-2-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-1 shadow-none border">
                    <div class="p-2">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img src="assets/images/projects/project-1.jpg" class="avatar-sm rounded" alt="file-image">
                            </div>
                            <div class="col ps-0">
                                <a href="javascript:void(0);" class="text-muted fw-bold">Dashboard-design.jpg</a>
                                <p class="mb-0">3.25 MB</p>
                            </div>
                            <div class="col-auto">
                                <!-- Button -->
                                <a href="javascript:void(0);" class="btn btn-link btn-lg text-muted">
                                    <i class="ri-download-2-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-0 shadow-none border">
                    <div class="p-2">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-secondary text-light rounded">
                                        .MP4
                                    </span>
                                </div>
                            </div>
                            <div class="col ps-0">
                                <a href="javascript:void(0);" class="text-muted fw-bold">Admin-bug-report.mp4</a>
                                <p class="mb-0">7.05 MB</p>
                            </div>
                            <div class="col-auto">
                                <!-- Button -->
                                <a href="javascript:void(0);" class="btn btn-link btn-lg text-muted">
                                    <i class="ri-download-2-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <h4 class="mt-0 mb-3">Comments (258)</h4>

            <textarea class="form-control form-control-light mb-2" placeholder="Write message" id="example-textarea" rows="3"></textarea>
            <div class="text-end">
                <div class="btn-group mb-2">
                    <button type="button" class="btn btn-link btn-sm text-muted font-18"><i class="ri-attachment-2"></i></button>
                </div>
                <div class="btn-group mb-2 ms-2">
                    <button type="button" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </div>

            <div class="d-flex align-items-start mt-2">
                <img class="me-3 avatar-sm rounded-circle" src="assets/images/users/avatar-3.jpg" alt="Generic placeholder image">
                <div class="w-100 overflow-hidden">
                    <h5 class="mt-0">Jeremy Tomlinson</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in
                    vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
                    in faucibus.
            
                    <div class="d-flex align-items-start mt-3">
                        <a class="pe-3" href="#">
                            <img src="assets/images/users/avatar-4.jpg" class="avatar-sm rounded-circle" alt="Generic placeholder image">
                        </a>
                        <div class="w-100 overflow-hidden">
                            <h5 class="mt-0">Kathleen Thomas</h5>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in
                            vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue
                            felis in faucibus.
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-2">
                <a href="javascript:void(0);" class="text-danger">Load more </a>
            </div>
        </div> <!-- end card-body-->
    </div>
    </div>
</div>
    

<?php js_start(); ?>
<?php js_end(); ?>