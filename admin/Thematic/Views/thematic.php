<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="d-flex card-header justify-content-between align-items-center bg-primary p-2 text-dark bg-opacity-50">
                <h4 class="header-title">Thematic</h4>
                <div class="btn-groups">
                    <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-sm btn-primary ajaxaction">Add</a>
                    <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-sm btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-users').submit() : false;">Delete</button>
                </div>
            </div>
            <div class="card-body">

                    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-thematic">
                    <table class="table table-centered table-striped dt-responsive nowrap w-100" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
                                        <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Color</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th style="width: 75px;">Action</th>
                            </tr>
                        </thead>
                    </table>
                    </form>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>

<?php js_start(); ?>
<script type="text/javascript"><!--
$(function(){
	table=$('#datatable').DataTable({
        keys: !0,
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        },
		"processing": true,
		"serverSide": true,
		"columnDefs": [
			{ targets: 'no-sort', orderable: false }
		],
		"ajax":{
			url :"<?=$datatable_url?>", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".datatable_error").html("");
				$("#datatable").append('<tbody class="datatable_error"><tr><th colspan="5">No data found.</th></tr></tbody>');
				$("#datatable_processing").css("display","none");
				
			},
			dataType:'json'
		},
	});
});
//--></script>
<?php js_end(); ?>