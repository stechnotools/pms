
<div class="d-flex align-items-center mb-2 task-user" data-id="<?=$id?>">
    <div class="flex-shrink-0 me-2">
        <img class="me-2 rounded-circle" src="<?=$image?>" alt="Generic placeholder image" width="40"> 
    </div>
    <div class="flex-grow-1">
        <h6 class="fw-semibold my-0"><a href="user/<?=$id?>" class="text-body"><?=$firstname.' '.$lastname?></a></h6>
        <small class="text-muted mb-0"><?=$role?></small>
    </div>
    <?php if(isset($delete)): ?>
    <div class="dropdown">
        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-dots-horizontal"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end" style="">
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item btn-delete">Delete</a>
        </div>
    </div>
    <?php endif; ?>
</div>