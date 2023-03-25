<div class="row">
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-card">
                    <table class="table mb-0">
                        <tbody>
                        <tr>
                            <td class="fw-medium">Tasks No</td>
                            <td>#<?= $slug ?></td>
                        </tr>
                        <tr>
                            <td class="fw-medium">Project Name</td>
                            <td>
                                <?php if($view): ?>
                                <?php else: ?>
                                <?php echo form_dropdown('project_id', option_array_value($projects, 'id', 'name',[''=>'Select a project']),
                                    set_value('project_id', $project_id),
                                    "id='project_id' class='form-select form-select-sm autoupdate'"); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-medium">Priority</td>
                            <td>
                            <?php if($view): ?>
                                <span class="badge <?= $priority_class ?>"><?= $priority_text ?></span>
                            <?php else: ?>
                                <?php echo form_dropdown('priority', $priorities,
                                    set_value('priority', $priority),
                                    "id='priority' class='form-select form-select-sm autoupdate'"); ?>
                            <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-medium">Status</td>
                            <td><?=$status_text?></td>
                        </tr>
                        <tr>
                            <td class="fw-medium">Created By</td>
                            <td>
                                <?php echo view('Admin\Task\Views\task_user',$created_by); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!--end table-->
                </div>
            </div>
        </div>
        <!--end card-->
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <h5 class="card-title mb-0 flex-grow-1"><i class="ri-alarm-line"></i> Due Date</h5>
                </div>
                <div class="dp" data-provide="datepicker-inline" data-date="<?=$due_date?>" data-date-format="yyyy-mm-dd"></div>
                <input type="hidden" name="due_date" class="date autoupdate">
                <style>
                    .datepicker-inline {
                        width: 100%;
                    }
                    .datepicker table {
                        width: 100%;
                    }
                </style>
            </div>
        </div>
        <!--end card-->
    </div>
    <!---end col-->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <input type="hidden" id="task-title" name="title" class="autoupdate"/>
                    <h2 class="h3 editable mb-3" id="title"
                        data-input-type="input" data-default-text="true"
                        data-connect-with="#task-title"><?= $title ?></h2>

                    <h4 class=""><i class="ri-align-left"></i> Summary</h4>
                    <input type="hidden" id="task-description" name="description" class="autoupdate" value="<?= $description ?>">
                    <p class="editable" data-connect-with="#task-description" data-default-text="false"><?= $description?:'Add details' ?></p>

                </div>
            </div>
        </div>
        <!--end card-->
        <div class="card">
            <div class="card-header">
                <div>
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-body active" data-bs-toggle="tab" href="#home-1" role="tab">
                                Comments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" data-bs-toggle="tab" href="#messages-1" role="tab">
                                Attachments
                            </a>
                        </li>
                    </ul>
                    <!--end nav-->
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="home-1" role="tabpanel">
                        <div data-simplebar style="height: 200px;" id="comment-list" class="px-3 mx-n3 mb-2">
                            <?php if($comments): ?>
                                <?php foreach ($comments as $comment): ?>
                                    <?= view('Admin\Task\Views\task_comment',(array)$comment); ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div id="no-comment" class="card-body bg-light">No one has commented yet.</div>
                            <?php endif; ?>
                            <div class="clist"></div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-lg-12 comment-form">
                                <label for="comment-text" class="form-label">Leave a Comments</label>
                                <textarea class="form-control bg-light border-light"
                                          id="comment-text" rows="3"
                                          placeholder="Enter comments"></textarea>
                                <div class="mt-2 text-end">
                                    <button type="button" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i
                                                class="ri-attachment-line fs-16"></i></button>
                                    <button class="btn btn-success" id="btn-comment">Post Comments</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="messages-1" role="tabpanel">
                        <div class="row">
                            <div class="col-6">
                                <div id="uploaded-files" class="vstack gap-2">
                                    <?php foreach ($files as $file): ?>
                                        <?=$file?>
                                    <?php endforeach; ?>
                                </div>
                                <!--end card-->
                            </div>
                            <div class="col-6">
                                <!-- File Upload -->
                                <form action="task/addfiles" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                                      data-upload-preview-template="#uploadPreviewTemplate">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                    <input name="task_id" type="hidden" value="<?=$id?>" />

                                    <div class="dz-message needsclick">
                                        <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                                        <h3>Drop files here or click to upload.</h3>
                                    </div>
                                </form>
                                <!-- Preview -->
                                <div class="dropzone-previews mt-3" id="file-previews"></div>

                                <!-- file preview template -->
                                <div class="d-none" id="uploadPreviewTemplate">
                                    <div class="card mt-1 mb-0 shadow-none border">
                                        <div class="p-2">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                                </div>
                                                <div class="col ps-0">
                                                    <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                                    <p class="mb-0" data-dz-size></p>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->
                                                    <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Progress -->
                                        <div class="progress" style="height: 2px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" width="0%" data-dz-uploadprogress>
                                                <span class="progress-text"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-md-3">
        <div class="card mb-3" >
            <div class="card-body">
                <div class="d-flex mb-3">
                    <h5 class="card-title mb-0 flex-grow-1"><i class="uil-user-plus"></i> Assigned To</h5>
                </div>
                <div id="assigned-users" class="mb-0">
                    <?php foreach ($assigned_users as $user): ?>
                        <?=$user?>
                    <?php endforeach; ?>
                </div>
                <div class="position-relative">
                    <input class="form-control mt-3" id="assignTask" placeholder="Add members">
                </div>
            </div>
        </div>
        <!--end card-->
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <h5 class="card-title mb-0 flex-grow-1"><i class="uil-file-check-alt"></i> To Do Checklist</h5>
                </div>
                <!-- TO DO List -->

                <div class="todoapp">
                    <div class="">
                        <div class="row">
                            <div class="col">
                                <h5 id="todo-message" class="d-none"><span id="todo-remaining"></span> of <span id="todo-total"></span> remaining</h5>
                            </div>
                        </div>
                    </div>

                    <div class="mb-0" style="max-height: 298px;" data-simplebar>
                        <ul class="list-group list-group-flush todo-list" id="todo-list"></ul>
                    </div>

                    <div class="p-0">
                        <form name="todo-form" id="todo-form" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col">
                                    <input type="text" id="todo-input-text" name="todo-input-text" class="form-control"
                                           placeholder="Add new todo" required>
                                    <div class="invalid-feedback">
                                        Please enter your task name
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- end .todoapp-->

            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <h5 class="card-title mb-0 flex-grow-1"><i class="uil-bookmark-full"></i> Tags</h5>
                </div>
                <h6 class="mb-3 text-uppercase">Tasks Tags</h6>
                <input type="text" data-role="tagsinput" value="<?=$tags?>" class="d-none">
            </div>
        </div>

    </div>
</div>
<!--end row-->