<div class="row mb-4">
    <div class="col-12 text-center">
        <h3>Sunday, March 26</h3>
        <h2><?=$user_greeting?></h2>
        <p><?=inspirationMeassage();?></p>
        </div>
</div>



<div class="row mb-2">
    <div class="col-sm-6 col-lg-2">
        <div class="card rounded-0 shadow-none m-0 color-div" >
            <div class="card-body px-0 text-center">
                <i class="ri-briefcase-line text-muted font-24"></i>
                <h3><span>29</span></h3>
                <p class="text-muted font-15 mb-0">Total Tasks</p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card rounded-0 shadow-none m-0 border-start  color-div">
            <div class="card-body px-0 text-center">
                <i class="ri-list-check-2 text-muted font-24"></i>
                <h3><span>715</span></h3>
                <p class="text-muted font-15 mb-0">Open Tasks</p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card rounded-0 shadow-none m-0 border-start color-div">
            <div class="card-body px-0 text-center">
                <i class="ri-group-line text-muted font-24"></i>
                <h3><span>31</span></h3>
                <p class="text-muted font-15 mb-0">Completed Task</p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card rounded-0 shadow-none m-0 border-start color-div">
            <div class="card-body px-0 text-center">
                <i class="ri-group-line text-muted font-24"></i>
                <h3><span>31</span></h3>
                <p class="text-muted font-15 mb-0">Pending Task</p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card rounded-0 shadow-none m-0 border-start  color-div">
            <div class="card-body px-0 text-center">
                <i class="ri-line-chart-line text-muted font-24"></i>
                <h3><span>93%</span> <i class="mdi mdi-arrow-up text-success"></i></h3>
                <p class="text-muted font-15 mb-0">Overdue Task</p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card rounded-0 shadow-none m-0 border-start  color-div">
            <div class="card-body px-0 text-center">
                <i class="ri-line-chart-line text-muted font-24"></i>
                <h3><span>93%</span> <i class="mdi mdi-arrow-up text-success"></i></h3>
                <p class="text-muted font-15 mb-0">Total Project</p>
            </div>
        </div>
    </div>
               
</div>
<!-- end row-->


<div class="row">
    
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title">My Tasks</h4>
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
            <div class="card-header bg-light-lighten border-top border-bottom border-light py-1 text-center">
                <p class="m-0"><b>107</b> Tasks completed out of 195</p>
            </div>
            <div class="card-body pt-2">
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0">
                        <tbody>
                        <tr>
                            <td>
                                <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">Coffee detail page - Main Page</a></h5>
                                <span class="text-muted font-13">Due in 3 days</span>
                            </td>
                            <td>
                                <span class="text-muted font-13">Status</span> <br>
                                <span class="badge badge-warning-lighten">In-progress</span>
                            </td>
                            <td>
                                <span class="text-muted font-13">Assigned to</span>
                                <h5 class="font-14 mt-1 fw-normal">Logan R. Cohn</h5>
                            </td>
                            <td>
                                <span class="text-muted font-13">Total time spend</span>
                                <h5 class="font-14 mt-1 fw-normal">3h 20min</h5>
                            </td>
                            <td class="table-action" style="width: 90px;">
                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">Drinking bottle graphics</a></h5>
                                <span class="text-muted font-13">Due in 27 days</span>
                            </td>
                            <td>
                                <span class="text-muted font-13">Status</span> <br>
                                <span class="badge badge-danger-lighten">Outdated</span>
                            </td>
                            <td>
                                <span class="text-muted font-13">Assigned to</span>
                                <h5 class="font-14 mt-1 fw-normal">Jerry F. Powell</h5>
                            </td>
                            <td>
                                <span class="text-muted font-13">Total time spend</span>
                                <h5 class="font-14 mt-1 fw-normal">12h 21min</h5>
                            </td>
                            <td class="table-action" style="width: 90px;">
                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">App design and development</a></h5>
                                <span class="text-muted font-13">Due in 7 days</span>
                            </td>
                            <td>
                                <span class="text-muted font-13">Status</span> <br>
                                <span class="badge badge-success-lighten">Completed</span>
                            </td>
                            <td>
                                <span class="text-muted font-13">Assigned to</span>
                                <h5 class="font-14 mt-1 fw-normal">Scot M. Smith</h5>
                            </td>
                            <td>
                                <span class="text-muted font-13">Total time spend</span>
                                <h5 class="font-14 mt-1 fw-normal">78h 05min</h5>
                            </td>
                            <td class="table-action" style="width: 90px;">
                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">Poster illustation design</a></h5>
                                <span class="text-muted font-13">Due in 5 days</span>
                            </td>
                            <td>
                                <span class="text-muted font-13">Status</span> <br>
                                <span class="badge badge-warning-lighten">In-progress</span>
                            </td>
                            <td>
                                <span class="text-muted font-13">Assigned to</span>
                                <h5 class="font-14 mt-1 fw-normal">John P. Ritter</h5>
                            </td>
                            <td>
                                <span class="text-muted font-13">Total time spend</span>
                                <h5 class="font-14 mt-1 fw-normal">26h 58min</h5>
                            </td>
                            <td class="table-action" style="width: 90px;">
                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
    <div class="col-lg-4">                    
        <!-- Todo-->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title">My Todo Items</h4>
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                    </div>
                </div>
            </div>

            <div class="todoapp">
                <div class="card-body py-0">
                    <div class="row">
                        <div class="col">
                            <h5 id="todo-message"><span id="todo-remaining">3</span> of <span id="todo-total">7</span> remaining</h5>
                        </div>
                        <div class="col-auto">
                            <a href="" class="float-end btn btn-light btn-sm" id="btn-archive">Archive</a>
                        </div>
                    </div>
                </div>

                <div class="card-body py-0 mb-0" style="max-height: 298px;" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px -24px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 24px;">
                    <ul class="list-group list-group-flush todo-list" id="todo-list"><li class="list-group-item border-0 ps-0"><div class="form-check mb-0"><input type="checkbox" class="form-check-input todo-done" id="7" checked=""><label class="form-check-label" for="7"><s>Build an angular app</s></label></div></li><li class="list-group-item border-0 ps-0"><div class="form-check mb-0"><input type="checkbox" class="form-check-input todo-done" id="6"><label class="form-check-label" for="6">Create new version 3.0</label></div></li><li class="list-group-item border-0 ps-0"><div class="form-check mb-0"><input type="checkbox" class="form-check-input todo-done" id="5"><label class="form-check-label" for="5">Hehe!! This looks cool!</label></div></li><li class="list-group-item border-0 ps-0"><div class="form-check mb-0"><input type="checkbox" class="form-check-input todo-done" id="4" checked=""><label class="form-check-label" for="4"><s>Testing??</s></label></div></li><li class="list-group-item border-0 ps-0"><div class="form-check mb-0"><input type="checkbox" class="form-check-input todo-done" id="3" checked=""><label class="form-check-label" for="3"><s>Creating component page</s></label></div></li><li class="list-group-item border-0 ps-0"><div class="form-check mb-0"><input type="checkbox" class="form-check-input todo-done" id="2" checked=""><label class="form-check-label" for="2"><s>Build a js based app</s></label></div></li><li class="list-group-item border-0 ps-0"><div class="form-check mb-0"><input type="checkbox" class="form-check-input todo-done" id="1"><label class="form-check-label" for="1">Design One page theme</label></div></li></ul>
                </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 319px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 278px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>

                <div class="card-body pt-2">
                    <form name="todo-form" id="todo-form" class="needs-validation" novalidate="">
                        <div class="row">
                            <div class="col">
                                <input type="text" id="todo-input-text" name="todo-input-text" class="form-control" placeholder="Add new todo" required="">
                                <div class="invalid-feedback">
                                    Please enter your task name
                                </div>
                            </div>
                            <div class="col-auto d-grid">
                                <button class="btn-primary btn-md btn waves-effect waves-light" type="submit" id="todo-btn-submit">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end .todoapp-->                                    
        </div> <!-- end card-->
     
    </div><!-- end col-->

</div>
<!-- end row-->


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title">Tasks Overview</h4>
                <div>
                    <button type="button" class="btn btn-soft-secondary btn-sm">
                        ALL
                    </button>
                    <button type="button" class="btn btn-soft-primary btn-sm">
                        1M
                    </button>
                    <button type="button" class="btn btn-soft-secondary btn-sm">
                        6M
                    </button>
                    <button type="button" class="btn btn-soft-secondary btn-sm">
                        1Y
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div dir="ltr">
                    <div class="chartjs-chart" style="height: 320px;">
                        <canvas id="task-area-chart" data-bgcolor="#727cf5" data-bordercolor="#727cf5" style="box-sizing: border-box; display: block; height: 320px; width: 993px;" width="993" height="320"></canvas>
                    </div>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->


<div class="row">
    <div class="col-xl-5">
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

            <div class="card-body pt-0">
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
        </div> <!-- end card -->
    </div><!-- end col-->

    <div class="col-xl-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title">Your Calendar</h4>
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

            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-7">
                        <div data-provide="datepicker-inline" data-date-today-highlight="true" class="calendar-widget"><div class="datepicker datepicker-inline"><div class="datepicker-days" style=""><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">January 2023</th><th class="next">»</th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td class="old day" data-date="1671926400000">25</td><td class="old day" data-date="1672012800000">26</td><td class="old day" data-date="1672099200000">27</td><td class="old day" data-date="1672185600000">28</td><td class="old day" data-date="1672272000000">29</td><td class="old day" data-date="1672358400000">30</td><td class="old day" data-date="1672444800000">31</td></tr><tr><td class="day" data-date="1672531200000">1</td><td class="day" data-date="1672617600000">2</td><td class="day" data-date="1672704000000">3</td><td class="day" data-date="1672790400000">4</td><td class="day" data-date="1672876800000">5</td><td class="day" data-date="1672963200000">6</td><td class="day" data-date="1673049600000">7</td></tr><tr><td class="day" data-date="1673136000000">8</td><td class="day" data-date="1673222400000">9</td><td class="day" data-date="1673308800000">10</td><td class="day" data-date="1673395200000">11</td><td class="day" data-date="1673481600000">12</td><td class="day" data-date="1673568000000">13</td><td class="day" data-date="1673654400000">14</td></tr><tr><td class="day" data-date="1673740800000">15</td><td class="day" data-date="1673827200000">16</td><td class="day" data-date="1673913600000">17</td><td class="day" data-date="1674000000000">18</td><td class="day" data-date="1674086400000">19</td><td class="day" data-date="1674172800000">20</td><td class="day" data-date="1674259200000">21</td></tr><tr><td class="day" data-date="1674345600000">22</td><td class="day" data-date="1674432000000">23</td><td class="today day" data-date="1674518400000">24</td><td class="day" data-date="1674604800000">25</td><td class="day" data-date="1674691200000">26</td><td class="day" data-date="1674777600000">27</td><td class="day" data-date="1674864000000">28</td></tr><tr><td class="day" data-date="1674950400000">29</td><td class="day" data-date="1675036800000">30</td><td class="day" data-date="1675123200000">31</td><td class="new day" data-date="1675209600000">1</td><td class="new day" data-date="1675296000000">2</td><td class="new day" data-date="1675382400000">3</td><td class="new day" data-date="1675468800000">4</td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2023</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="month focused">Jan</span><span class="month">Feb</span><span class="month">Mar</span><span class="month">Apr</span><span class="month">May</span><span class="month">Jun</span><span class="month">Jul</span><span class="month">Aug</span><span class="month">Sep</span><span class="month">Oct</span><span class="month">Nov</span><span class="month">Dec</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2020-2029</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="year old">2019</span><span class="year">2020</span><span class="year">2021</span><span class="year">2022</span><span class="year focused">2023</span><span class="year">2024</span><span class="year">2025</span><span class="year">2026</span><span class="year">2027</span><span class="year">2028</span><span class="year">2029</span><span class="year new">2030</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2000-2090</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="decade old">1990</span><span class="decade">2000</span><span class="decade">2010</span><span class="decade focused">2020</span><span class="decade">2030</span><span class="decade">2040</span><span class="decade">2050</span><span class="decade">2060</span><span class="decade">2070</span><span class="decade">2080</span><span class="decade">2090</span><span class="decade new">2100</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div><div class="datepicker-centuries" style="display: none;"><table class="table-condensed"><thead><tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr><tr><th class="prev">«</th><th colspan="5" class="datepicker-switch">2000-2900</th><th class="next">»</th></tr></thead><tbody><tr><td colspan="7"><span class="century old">1900</span><span class="century focused">2000</span><span class="century">2100</span><span class="century">2200</span><span class="century">2300</span><span class="century">2400</span><span class="century">2500</span><span class="century">2600</span><span class="century">2700</span><span class="century">2800</span><span class="century">2900</span><span class="century new">3000</span></td></tr></tbody><tfoot><tr><th colspan="7" class="today" style="display: none;">Today</th></tr><tr><th colspan="7" class="clear" style="display: none;">Clear</th></tr></tfoot></table></div></div></div>
                    </div> <!-- end col-->
                    <div class="col-md-5">
                        <ul class="list-unstyled mt-1">
                            <li class="mb-4">
                                <p class="text-muted mb-1 font-13">
                                    <i class="mdi mdi-calendar"></i> 7:30 AM - 10:00 AM
                                </p>
                                <h5>Meeting with BD Team</h5>
                            </li>
                            <li class="mb-4">
                                <p class="text-muted mb-1 font-13">
                                    <i class="mdi mdi-calendar"></i> 10:30 AM - 11:45 AM
                                </p>
                                <h5>Design Review - Hyper Admin</h5>
                            </li>
                            <li class="mb-4">
                                <p class="text-muted mb-1 font-13">
                                    <i class="mdi mdi-calendar"></i> 12:15 PM - 02:00 PM
                                </p>
                                <h5>Setup Github Repository</h5>
                            </li>
                            <li>
                                <p class="text-muted mb-1 font-13">
                                    <i class="mdi mdi-calendar"></i> 5:30 PM - 07:00 PM
                                </p>
                                <h5>Meeting with Design Studio</h5>
                            </li>
                        </ul>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->

</div>
<!-- end row-->


