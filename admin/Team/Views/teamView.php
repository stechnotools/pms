<?php

?>
<div class="row">
    <div class="col-sm-5">
        <!-- Profile -->
        <div class="card autotextcolor" style="background:<?=$team->color?>">
            <div class="card-body profile-user-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="avatar-lg">
                                    <img src="<?=$team->photo?>" alt="" class="rounded-circle img-thumbnail">
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <h4 class="mt-1 mb-1"><?=$team->name?></h4>
                                    <p class="font-13"><?=$team->description?></p>

                                    <ul class="mb-0 list-inline">
                                        <li class="list-inline-item me-3">
                                            <h5 class="mb-1 "><?=$total_user?></h5>
                                            <p class="mb-0 font-13">Member</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5 class="mb-1 ">2</h5>
                                            <p class="mb-0 font-13 ">Project</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="text-end multi-user">
                                                <a href="javascript:void(0);" class="d-inline-block">
                                                    <img src="http://ommpms.in/uploads/image-cache/no_image-150x150.png" class="rounded-circle avatar-xs" alt="Superadmin">
                                                </a>
                                                <a href="javascript:void(0);" class="d-inline-block">
                                                    <img src="https://lh3.googleusercontent.com/a/AEdFTp77NrJvrTEc2GxJ3Zf9o2uckMETNP-p15bXECFLiQ=s96-c" class="rounded-circle avatar-xs" alt="Rakesh">
                                                </a>
                                            </div>
                                            <p class="mb-0 font-13 ">Team Leader</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                     <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- end card-body/ profile-user-box-->
        </div><!--end profile/ card -->
    </div> <!-- end col-->
    <div class="col-sm-7">
        <div class="row mb-3">
            <div class="col-lg-6 col-6">
                <div class="border border-light p-2 text-white rounded bg-info">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar-sm">
                            <span class="avatar-title bg-danger rounded-circle h3 my-0">
                                <i class="mdi mdi-swap-horizontal"></i>
                            </span>
                        </div> 
                        <div>
                            <p class="font-18 mb-1">Total Task</p>
                            <h3 class="my-0">8</h3>
                        </div>                                     
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-6">
                <div class="border border-light p-2 text-white rounded bg-success">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar-sm">
                            <span class="avatar-title bg-warning rounded-circle h3 my-0">
                                <i class="mdi mdi-swap-horizontal"></i>
                            </span>
                        </div> 
                        <div>
                            <p class="font-18 mb-1">Completed Task</p>
                            <h3 class="my-0">1</h3>
                        </div>                                     
                    </div>
                </div>
                
            </div>
            <div class="col-lg-6 col-6">
                <div class="border border-light p-2 text-white rounded bg-warning">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar-sm">
                            <span class="avatar-title bg-primary rounded-circle h3 my-0">
                                <i class="mdi mdi-swap-horizontal"></i>
                            </span>
                        </div> 
                        <div>
                            <p class="font-18 mb-1">Pending Task</p>
                            <h3 class="my-0">7</h3>
                        </div>                                     
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-6">
                <div class="border border-light p-2 text-white rounded bg-danger">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="avatar-sm">
                            <span class="avatar-title bg-info rounded-circle h3 my-0">
                                <i class="mdi mdi-swap-horizontal"></i>
                            </span>
                        </div> 
                        <div>
                            <p class="font-18 mb-1">Overdue Task</p>
                            <h3 class="my-0">0</h3>
                        </div>                                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title">Team Member</h4>
            </div>
            <div class="card-body pt-2">
                <div class="position-relative pb-2">
                    <input class="form-control" id="user_autocomplete" placeholder="Add users">
                </div>
                <div  id="user_autocomplete_box" data-simplebar style="max-height: 400px">
                    <?php foreach($team_user as $user){?>
                        <div class="d-flex align-items-center mb-2 task-user" data-id="<?=$user->id?>">
                            <div class="flex-shrink-0 me-2">
                                <img class="me-2 rounded-circle" src="<?=$user->image?>" alt="Generic placeholder image" width="40"> 
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fw-semibold my-0"><?=$user->firstname.' '.$user->lastname?></h5>
                                <p class="mb-0"><?=$user->role?></p>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                        </div>
                    <?}?> 
                </div>
            </div>
            <!-- end card-body -->
        </div>
    </div>
    <div class="col-xl-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title">Recent Activities</h4>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Weekly Report</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Monthly Report</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0 " data-simplebar style="max-height: 400px">
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-start">
                                        <img class="me-2 rounded-circle" src="assets/images/users/avatar-2.jpg" alt="Generic placeholder image" width="40">
                                        <div>
                                            <h5 class="mt-0 mb-1">Soren Drouin<small class="fw-normal ms-3">18 Jan 2019 11:28 pm</small></h5>
                                            <span class="font-13">Completed "Design new idea"...</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted font-13">Project</span> <br>
                                    <p class="mb-0">Hyper Mockup</p>
                                </td>
                                <td class="table-action" style="width: 50px;">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-start">
                                        <img class="me-2 rounded-circle" src="assets/images/users/avatar-6.jpg" alt="Generic placeholder image" width="40">
                                        <div>
                                            <h5 class="mt-0 mb-1">Anne Simard<small class="fw-normal ms-3">18 Jan 2019 11:09 pm</small></h5>
                                            <span class="font-13">Assigned task "Poster illustation design"...</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted font-13">Project</span> <br>
                                    <p class="mb-0">Hyper Mockup</p>
                                </td>
                                <td class="table-action" style="width: 50px;">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-start">
                                        <img class="me-2 rounded-circle" src="assets/images/users/avatar-3.jpg" alt="Generic placeholder image" width="40">
                                        <div>
                                            <h5 class="mt-0 mb-1">Nicolas Chartier<small class="fw-normal ms-3">15 Jan 2019 09:29 pm</small></h5>
                                            <span class="font-13">Completed "Drinking bottle graphics"...</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted font-13">Project</span> <br>
                                    <p class="mb-0">Web UI Design</p>
                                </td>
                                <td class="table-action" style="width: 50px;">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-start">
                                        <img class="me-2 rounded-circle" src="assets/images/users/avatar-4.jpg" alt="Generic placeholder image" width="40">
                                        <div>
                                            <h5 class="mt-0 mb-1">Gano Cloutier<small class="fw-normal ms-3">10 Jan 2019 08:36 pm</small></h5>
                                            <span class="font-13">Completed "Design new idea"...</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted font-13">Project</span> <br>
                                    <p class="mb-0">UBold Admin</p>
                                </td>
                                <td class="table-action" style="width: 50px;">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-start">
                                        <img class="me-2 rounded-circle" src="assets/images/users/avatar-5.jpg" alt="Generic placeholder image" width="40">
                                        <div>
                                            <h5 class="mt-0 mb-1">Francis Achin<small class="fw-normal ms-3">08 Jan 2019 12:28 pm</small></h5>
                                            <span class="font-13">Assigned task "Hyper app design"...</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted font-13">Project</span> <br>
                                    <p class="mb-0">Website Mockup</p>
                                </td>
                                <td class="table-action" style="width: 50px;">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div>
    </div>
</div>                     
                        
    

<?php js_start(); ?>
<script>
    $(document).ready(function(){
        $('.autotextcolor').autotextcolor();
    });

    $(function(){
        $("#user_autocomplete").autocompleter({
            source: '<?=admin_url('users/search')?>',
            limit: 5,
            cache: false,
            combine: function (params) {
                // passing params to match endpoint
                return {
                    q: params.query,
                    limit: params.limit,
                    delete: false,
                };
            },
            format: function (data) {
                // map response data to match autocompleter
                return data.map(function (item) {
                    return {
                        label: item.firstname,
                        value: item.id,
                        image: item.image,
                        email: item.email,
                        html: item.html,
                    };
                });
            },
            template:
                ' {{ html }} ',
            empty: false,
            callback: function (value, index, object) {
                $("#user_autocomplete").val('');

                if($('#user_autocomplete_box').find('[data-id="'+value+'"]').length){
                    notify('Team Member','Team user already added.','info');
                    return;
                } else {
                    $("#user_autocomplete_box").append(object.html);
                    $('#user_autocomplete_box').LoadingOverlay('show');
                    $.post('<?=admin_url('team/user/add')?>',{team_id:<?=$team->id?>,user_id:object.value},function (data, status) {
                        $('#user_autocomplete_box').LoadingOverlay('hide',true);
                    });
                    notify('Team Member','Member added successfully.','success');
                }

            },
        });
    })

</script>
<?php js_end(); ?>