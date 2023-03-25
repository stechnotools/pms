
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Kanban Board</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-2">
                <div class="row g-2">
                    <!--end col-->
                    <div class="col-lg-3 col-auto">
                        <div class="search-box">
                            <input type="text" class="form-control search" id="search-task-options" placeholder="Search for tasks...">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end card-body-->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="board">
            <div data-plugin="dragula" data-containers='<?=json_encode($containers)?>'>
                <?php foreach ($boards as $key => $board): ?>
                    <div class="tasks">
                        <div class="d-flex <?=$board->color?>">
                            <div class="flex-grow-1">
                                <h6 class="text-uppercase m-2">
                                    <?=$board->title?>
                                    <small class="badge bg-secondary align-bottom ms-1 totaltask-badge"><?=count($board->tasks)?></small>
                                </h6>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown mt-1">
                                    <a class="text-reset btn-sort" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <small class="text">Priority</small><i class="mdi mdi-chevron-down ms-1"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item">Priority</a>
                                        <a class="dropdown-item">Date Added</a>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        <h5 class="mt-0 task-header --><?//=$board->color?><!--">--><?//=$board->title?><!-- <span class="badge bg-secondary total-tasks">--><?//=count($board->tasks)?><!--</span></h5>-->
                        <?php if($key==0): ?>
                        <!-- Add Task -->
                        <div>
                            <div class="card mb-0" id="card-add-task">
                                <div class="card-body p-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control dropdown-toggle" placeholder="Add a task..." id="input-add-task">
                                        <button class="input-group-text btn btn-primary" id="btn-add-task" type="button"><i class="uil-message"></i></button>
                                    </div>
                                </div> <!-- end card-body -->
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="task-list-wrapper" data-simplebar style="max-height: 50vh;">
                            <div id="task-list-<?=$board->id?>" data-status="<?=$board->id?>" class="task-list-items">
                                <?php foreach($board->tasks as $task) {
                                    echo view('Admin\Task\Views\task_item',(array)$task);
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div> <!-- end .board-->
        </div> <!-- end col -->
    </div>
</div>
<!-- end row-->
<div class="offcanvas offcanvas-end offcanvas-size-xl" tabindex="-1" id="taskForm" data-task-id="" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h1 id="offcanvasLabel" class="task-title"></h1>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body"></div>
</div>