<div class="border rounded border-dashed p-2 task-file ">
    <div class="d-flex align-items-center">
        <div class="flex-shrink-0 me-3">
            <div class="avatar-sm">
                <div class="avatar-title bg-light text-secondary rounded fs-24">
                    <i class="<?=$icon?>"></i>
                </div>
            </div>
        </div>
        <div class="flex-grow-1 overflow-hidden">
            <h5 class="fs-13 mb-1">
                <a href="javascript:void(0);"
                   class="text-body text-truncate d-block"><?=$filename?></a>
            </h5>
            <div class="text-muted"><?=$size?></div>
        </div>
        <div class="flex-shrink-0 ms-2">
            <div class="d-flex gap-1">
                <a href="<?=$file_url?>" target="_blank" class="btn btn-icon text-muted btn-sm fs-18">
                    <i class="ri-download-2-line"></i></a>
                <button type="button" class="btn btn-icon text-muted btn-sm fs-18 btn-delete" data-id="<?=$id?>" data-bs-toggle="tooltip" data-bs-title="Delete">
                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i></button>
            </div>
        </div>
    </div>
</div>