<div id="tentative_abstract_filter" class="block bg-body-light animated fadeIn d-none">
    <div class="block-header">
        <h3 class="block-title">Filter</h3>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                <i class="si si-close"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
        <form id="form-filter" class="form-horizontal">
            <div class="form-layout">
                <div class="form-group row gutters-tiny mb-0 items-push">
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Year: <span class="tx-danger">*</span></label>

                            <select name="year" id="year" class="form-control select2">
                                <option value="0">Select</option>
                                <?php foreach ($years as $key=>$_year){ ?>
                                    <option value="<?=$key?>" <?=($key==$year)?'selected':''?>><?=$_year?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Districts: <span class="tx-danger">*</span></label>
                            <select name="district" id="district" class="form-control js-select2" style="width: 100%;" <?=$active_district?'disabled':'';?>>
                                <option value="0">Select</option>
                                <?php foreach ($districts as $_district){ ?>
                                    <option value="<?=$_district->code?>" <?=($_district->code==$district )?'selected':''?>><?=$_district->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Block: <span class="tx-danger">*</span></label>
                            <select name="block" id="block" class="form-control js-select2" style="width: 100%;">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">GP: <span class="tx-danger">*</span></label>
                            <select name="grampanchayat" id="grampanchayat" class="form-control js-select2" style="width: 100%;">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-layout-footer">
                            <button type="button" id="btn-filter" class="btn btn-primary">Generate</button>
                        </div><!-- form-layout-footer -->
                    </div>
                </div><!-- row -->
            </div><!-- form-layout -->
        </form>
    </div>
</div>
<?php js_start() ?>
<script type="text/javascript"><!--
        $(function(){
            $('select[name=\'district\']').bind('change', function() {
                $.ajax({
                    url: '<?php echo admin_url("district/block"); ?>/' + this.value,
                    dataType: 'json',
                    beforeSend: function() {
                        //$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
                    },
                    complete: function() {
                        //$('.wait').remove();
                    },
                    success: function(json) {

                        html = '<option value="0">Select Block</option>';

                        if (json['block'] != '') {
                            for (i = 0; i < json['block'].length; i++) {
                                html += '<option value="' + json['block'][i]['code'] + '"';
                                if (json['block'][i]['code'] == '<?php echo $block;?>') {
                                    html += ' selected="selected"';
                                }
                                html += '>' + json['block'][i]['name'] + '</option>';
                            }
                        } else {
                            html += '<option value="0" selected="selected">Select Block</option>';
                        }

                        $('select[name=\'block\']').html(html);
                        $('select[name=\'block\']').select2();
                        $('select[name=\'block\']').trigger('change');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            });
            $('select[name=\'district\']').trigger('change');

            $('select[name=\'block\']').bind('change', function() {
                $.ajax({
                    url: '<?php echo admin_url("block/grampanchayat"); ?>/' + this.value,
                    dataType: 'json',
                    beforeSend: function() {
                        //$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
                    },
                    complete: function() {
                        //$('.wait').remove();
                    },
                    success: function(json) {

                        html = '<option value="">Select Grampanchayat</option>';

                        if (json['grampanchayat'] != '') {
                            for (i = 0; i < json['grampanchayat'].length; i++) {
                                html += '<option value="' + json['grampanchayat'][i]['code'] + '"';

                                if (json['grampanchayat'][i]['code'] == '<?php echo $grampanchayat; ?>') {
                                    html += ' selected="selected"';
                                }

                                html += '>' + json['grampanchayat'][i]['name'] + '</option>';
                            }
                        } else {
                            html += '<option value="0" selected="selected">Select Grampanchayat</option>';
                        }

                        $('select[name=\'grampanchayat\']').html(html);
                        $('select[name=\'grampanchayat\']').select2();
                        $('select[name=\'grampanchayat\']').trigger('change');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            });

            Codebase.helpers([ 'select2']);
            $('#btn-filter').click(function(){ //button filter event click
                var url="<?=admin_url('report/tentativefarmer');?>"
                $.ajax({
                    url : url,
                    method:"post",
                    data:$("#tentative_abstract_filter form").serialize(),
                    beforeSend: function(){
                        $.LoadingOverlay("show");
                    },
                    complete: function(){
                        $.LoadingOverlay("hide");
                    },
                    success : function(d) {
                        alert(d);
                    }
                });
                return false;

            });
            $("a[data-download='true']").click(function(e) {
                e.preventDefault();
                var myform = $('#form-filter');
                // Find disabled inputs, and remove the "disabled" attribute
                var disabled = myform.find(':input:disabled').removeAttr('disabled');
                // serialize the form
                var serialized = myform.serialize();
                // re-disabled the set of inputs that you previously enabled
                disabled.attr('disabled','disabled');
                var href=$(this).attr('href');
                $.ajax({
                    type:'POST',
                    url:href,
                    data: serialized,
                    beforeSend: function(){
                        $.LoadingOverlay("show");
                    },
                    complete: function(){
                        $.LoadingOverlay("hide");
                    },
                    dataType:'json'
                }).done(function(data){

                    let link = document.createElement('a');
                    link.style.display = "none"; // because Firefox sux

                    link.hidden = true;
                    link.download = data.filename;
                    link.href = data.file;
                    link.text = "downloading...";

                    document.body.appendChild(link);
                    link.click();
                    link.remove();

                    /*document.body.appendChild(link); // because Firefox sux
                     link.href = data.file;
                     link.download = data.filename;
                     link.click();
                     document.body.removeChild(link); */


                });
            });
        });
</script>
<?php js_end() ?>
