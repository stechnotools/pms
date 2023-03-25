<div class="row mb-2">
    <div class="col-sm-8">
        <a href="<?=admin_url('users/add')?>" class="btn btn-info mb-3"><i class="mdi mdi-plus"></i> Create Member</a>
    </div>
    <div class="col-sm-4">
        <div class="text-sm-end">
            <div class="app-search">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="mdi mdi-magnify search-icon"></span>
                        <button class="input-group-text btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil uil-sort-amount-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Due Date</a>
                            <a class="dropdown-item" href="#">Added Date</a>
                            <a class="dropdown-item" href="#">Assignee</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- end col-->
</div>
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-5">


<?php foreach($users as $user){?>
    <div class="col-md-4 col-xxl-3">
        <div class="card color-div">
            <div class="card-body">
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">View Profile</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Project Info</a>
                    </div>
                </div>

                <div class="text-center">
                    <img src="<?=$user->image?>" class="rounded-circle avatar-md img-thumbnail" alt="friend">
                    <h4 class="mt-3 my-1"><?=$user->firstname.' '.$user->lastname?> <i class="mdi mdi-check-decagram text-success"></i></h4>
                    <p class="mb-0 text-muted"><i class="mdi mdi-email-outline me-1"></i><?=$user->email?></p>
                    <hr class="bg-dark-lighten my-3">
                    <h5 class="mt-3 fw-semibold text-muted">Complate Total <b>18</b> Project</h5>
                
                    <div class="row mt-3">
                        <div class="col-4">
                            <a href="javascript:void(0);" class="btn w-100 btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Message" data-bs-original-title="Message"><i class="mdi mdi-message-processing-outline"></i></a>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="btn w-100 btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Call" data-bs-original-title="Call"><i class="mdi mdi-phone"></i></a>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="btn w-100 btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Email" data-bs-original-title="Email"><i class="mdi mdi-email-outline"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?}?>
</div>

<?php js_start(); ?>
<script type="text/javascript"><!--
//--></script>
<?php js_end(); ?>