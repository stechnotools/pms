
<!-- Task Item -->
<div class="card mb-0 card-task" data-task-id="<?=$task_id?>">
    <div class="card-body p-2">
        <small data-bs-toggle="tooltip" data-bs-title="Date added" class="float-end text-muted"><?=$created_at?></small>
        <span data-bs-toggle="tooltip" data-bs-title="Priority" class="badge <?=$priority_class?>"><?=$priority_text?></span>

        <h5 class="mt-2 mb-2">
            <a href="javascript:void(0)" class="text-body"><?=$task_title?></a>
        </h5>
        <div class="float-end">
        <?php if(!$due_date): ?>
            <i class="uil-stopwatch"></i><small class="text-muted"> No due date</small>
        <?php else: ?>
            <i class="uil-stopwatch"></i><small class="text-muted"> <?=$due_date_text?></small>
        <?php endif; ?>
        </div>
        <p class="mb-0">
            <span class="text-nowrap d-inline-block" data-bs-toggle="tooltip" data-bs-title="Comments">
                <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                <b><?=$total_comments?></b>
            </span>
            <span class="text-nowrap d-inline-block" data-bs-toggle="tooltip" data-bs-title="Sub tasks">
                <i class="mdi mdi-checkbox-marked-outline"></i>
                <b>0</b>
            </span>
            <span class="text-nowrap d-inline-block" data-bs-toggle="tooltip" data-bs-title="Added By: <?=$task_user?>">
                <i class="mdi mdi-account text-muted"></i>
                <?php if($user_image) { ?>
                    <img src="<?=$user_image?>" alt="image" class="img-fluid avatar-xs rounded-circle">
                <?php } else { ?>
                <div class="avatar-xs">
                    <span class="avatar-title bg-success rounded-circle"><?=$user_initials?></span>
                </div>
                <?php } ?>
            </span>
            <?php if($task_users) { ?>
            <span class="badge bg-secondary">+<?=$task_users?></span>
            <?php } ?>
        </p>

    </div> <!-- end card-body -->
</div>
<!-- Task Item End -->