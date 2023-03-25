<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title"><?php echo $admin_title; ?></h3>
        <div class="block-options">
            <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary ajaxaction"><i class="fa fa-plus"></i></a>
            <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-dashboard').submit() : false;"><i class="fa fa-trash-o"></i></button>
        </div>
    </div>
    <div class="block-content block-content-full">
        <div class="table-responsive">
            <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-dashboard">
                <table class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Dashboard Name</th>
                            <th>Route</th>
                            <th>Width</th>
                            <th>Filter</th>
                            <th>Download</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody id="report_menu">
                    <?php
                    $permissions=[];
                    foreach ($dreports as $report) {
                        $permissions=json_decode($report->permission,true);
                        //printr($permissions);
                        ?>
                        <tr class="report_menu draggable-item" id="<?= $report->id ?>">
                            <td class=" pl-lg">
                                <a class="btn-block-option draggable-handler" href="javascript:void(0)">
                                    <i class="si si-cursor-move"></i>
                                </a>
                                <?= lang($report->name) ?>
                            </td>
                            <td class=" pl-lg">
                                <a class="btn-block-option draggable-handler" href="javascript:void(0)">
                                    <i class="si si-cursor-move"></i>
                                </a>
                                <?= lang($report->route) ?>
                            </td>
                            <td class="pl-lg">
                                <input type="text" data-id="<?= $report->id ?>" name="col" value="<?= $report->col ?>" class="form-control">
                            </td>
                            <td>
                                <div class="col-lg-5 checkbox change_status">
                                    <label class="css-control css-control-sm css-control-primary css-switch">
                                        <?php echo form_checkbox(array('class'=>'css-control-input','data-id'=>$report->id , 'data-action'=>'f', 'name' => 'filter', 'value' => 1,'checked' => ($report->filter == 1 ? true : false))); ?>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="col-lg-5 checkbox change_status">
                                    <label class="css-control css-control-sm css-control-primary css-switch">
                                        <?php echo form_checkbox(array('class'=>'css-control-input','data-id'=>$report->id ,'data-action'=>'d', 'name' => 'download', 'value' => 1,'checked' => ($report->download == 1 ? true : false))); ?>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </div>
                            </td>

                            <td>

                                    <div class="btn-group btn-group-sm pull-right">
                                        <a class="btn btn-sm btn-primary ajaxaction" href="<?=admin_url('setting/dashboard/edit/'.$report->id);?>"><i class="fa fa-pencil"></i></a>
                                        <a class="btn-sm btn btn-danger btn-remove" href=<?=admin_url('setting/dashboard/delete/'.$report->id);?>" onclick="return confirm('Are you sure?') ? true : false;"><i class="fa fa-trash-o"></i></a>
                                    </div>

                            </td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>

                </table>
            </form>
        </div>
    </div>
</div>

<?php js_start(); ?>
<script type="text/javascript"><!--
    jQuery(function(){ Codebase.helpers('draggable-items'); });
    $(document).ready(function () {
        $('.change_status input[type="checkbox"]').change(function () {
            var id = $(this).data().id;
            var value = $(this).is(":checked");
            if (value == true) {
                value = 1;
            } else {
                value = 0;
            }
            key = $(this).attr('name');

            var action = $(this).data('action');
            data = {};
            // assigning key-value pair to data object
            data[key] = value;
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: '<?= admin_url()?>/setting/save_dashboard/' + id + '/' + action, // the url where we want to POST
                dataType: 'json', // what type of data do we expect back from the server
                data:data,
                encode: true,
                success: function (res) {
                    if (res) {
//                        toastr[res.status](res.message);
                    } else {
                        alert('There was a problem with AJAX');
                    }
                }
            })

        });
        $('.change_permission input[type="checkbox"]').change(function () {
            var parenttr=$(this).parents('tr');
            var id = $(parenttr).attr('id');

            var role_ids = $(parenttr).find('input[name^="permission"]:checked').map(function()
            {
                role_id=$(this).val();
                return role_id;
            }).get();
            var status='p';
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: '<?= admin_url()?>/setting/save_dashboard/' + id + '/' + status, // the url where we want to POST
                data:{role_ids:role_ids},
                dataType: 'json', // what type of data do we expect back from the server
                encode: true,
                success: function (res) {
                    if (res) {
//                        toastr[res.status](res.message);
                    } else {
                        alert('There was a problem with AJAX');
                    }
                }
            })

        });
        $('input[name="col"]').change(function () {
            var id = $(this).data().id;
            var col = $(this).val();
            var status="w"
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: '<?= admin_url()?>/setting/save_dashboard/' + id + '/' + status, // the url where we want to POST
                dataType: 'json', // what type of data do we expect back from the server
                data:{col:col},
                encode: true,
                success: function (res) {
                    if (res) {
//                        toastr[res.status](res.message);
                    } else {
                        alert('There was a problem with AJAX');
                    }
                }
            })

        });
    })
    $(function () {
        $('tbody[id^="report_menu"]').sortable({
            connectWith: ".report_menu",
            placeholder: 'ui-state-highlight',
            forcePlaceholderSize: true,
            stop: function (event, ui) {
                var id = JSON.stringify(
                    $('tbody[id^="report_menu"]').sortable(
                        'toArray',
                        {
                            attribute: 'id'
                        }
                    )
                );
                var formData = {
                    'report_menu': id
                };
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: '<?= admin_url()?>setting/save_dashboard/', // the url where we want to POST
                    data: formData, // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true,
                    success: function (res) {
                        if (res) {
//                            toastr[res.status](res.message);
                        } else {
                            alert('There was a problem with AJAX');
                        }
                    }
                })

            }
        });
        $(".report_menu").disableSelection();
    });
    //--></script>
<?php js_end(); ?>