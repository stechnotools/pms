<div class="d-flex mb-3">
    <img class="me-2 rounded-circle" src="<?=$image?>" alt="Generic placeholder image" height="32">
    <div class="w-100">
        <h5 class="mt-0"><?=$firstname.' ',$lastname?> <small class="text-muted float-end"><?=ago(strtotime($created_at))?></small></h5>
        <?=$comment?>
    </div>
</div>