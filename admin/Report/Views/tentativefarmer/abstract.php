<div class="block" id="farmerlist" data-toggle="appear">
    <div class="block-header block-header-default">
        <h3 class="block-title"><?php echo $title;?></h3>
        <div class="block-options">
            <button class="btn btn-outline-primary" onclick="Codebase.blocks('#tentative_abstract_filter', 'open');"><i class="fa fa-filter"></i></button>
            <a href="<?=$download_excel_url?>" class="btn btn-outline-info mg-r-5" data-download="true"><i class="fa fa-file-excel-o"></i></a>
            <a href="<?=$download_pdf_url?>" class="btn btn-outline-warning mg-r-5" data-download="true"><i class="fa fa-file-pdf-o"></i></a>
        </div>
    </div>
    <div class="block-content block-content-full">
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
                <form id="form-filter" action="<?=$action?>" class="form-horizontal">
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
                                    <button type="submit" id="btn-filter" class="btn btn-primary">Generate</button>
                                </div><!-- form-layout-footer -->
                            </div>
                        </div><!-- row -->
                    </div><!-- form-layout -->
                </form>
            </div>
        </div>
        <div class="table-responsive" style="overflow:auto;position:relative;">
            <p class="text-center heading"><?php echo $subtitle;?></p>
            <table class="table table-bordered table-striped">
                <thead>
                <tr class="table-active">
                    <?if($village){?>
                    <?}else if($grampanchayat){?>
                        <th scope="col">Name of Village</th>
                    <?} else if($block){?>
                        <th scope="col">Name of GP</th>
                        <th scope="col">No. Of Village</th>
                    <?} else if($district){?>
                        <th scope="col">Name of Block</th>
                        <th scope="col">No. Of GP</th>
                        <th scope="col">No. Of Village</th>
                    <?} else if($state){?>
                        <th scope="col">Name of District</th>
                        <th scope="col">No. of Block</th>
                        <th scope="col">No. Of GP</th>
                        <th scope="col">No. Of Village</th>
                    <?}?>
                    <th scope="col">Total Male</th>
                    <th scope="col">Total Female</th>
                    <th scope="col">Total Other</th>
                    <th scope="col">Total Farmer</th>
                    <th scope="col">Current Year Submission</th>
                    <th scope="col">Migrated Farmer</th>
                    <th scope="col">Total Submission</th>
                    <!--<th scope="col">Duplicate Submission<br>(Based on Bank Account)</th>
                    <th scope="col">Unique Submission</th>-->
                </tr>
                </thead>
                <tbody>
                <?php
                $total_block=$total_gp=$total_village=$total_farmer=$total_male=$total_female=$total_other=$total_submission=$migrate_submission=$total_duplicate=$total_unique=0;
                foreach($submissions as $key=>$submission){
                    $total_block+=isset($submission['TOTAL_BLOCK'])?$submission['TOTAL_BLOCK']:0;
                    $total_gp+=isset($submission['TOTAL_GP'])?$submission['TOTAL_GP']:0;
                    $total_village+=isset($submission['TOTAL_VILLAGE'])?$submission['TOTAL_VILLAGE']:0;
                    $total_submission+=$submission['TOTAL_SUBMISSION'];
                    $migrate_submission+=$submission['TOTAL_MIGRATE_SUBMISSION'];
                    $total_duplicate+=$submission['TOTAL_DUPLICATE'];
                    $total_farmer+=$submission['TOTAL_TENTATIVE'];
                    $total_male+=$submission['TOTAL_MALE'];
                    $total_female+=$submission['TOTAL_FEMALE'];

                    //$total_unique+=$submission['TOTAL_BLOCK'];
                    ?>
                    <tr>

                        <?if($village){?>
                        <?}else if($grampanchayat){?>
                            <td><?php echo $submission['NAME'];?></td>
                        <?}else if($block){?>
                            <td><?php echo $submission['NAME'];?></td>
                            <td><?php echo $submission['TOTAL_VILLAGE']?$submission['TOTAL_VILLAGE']:0;?></td>
                        <?} else if($district){?>
                            <td><?php echo $submission['NAME'];?></td>
                            <td><?php echo $submission['TOTAL_GP']?$submission['TOTAL_GP']:0;?></td>
                            <td><?php echo $submission['TOTAL_VILLAGE']?$submission['TOTAL_VILLAGE']:0;?></td>
                        <?} else if($state){?>
                            <td><?php echo $submission['NAME'];?></td>
                            <td><?php echo $submission['TOTAL_BLOCK']?$submission['TOTAL_BLOCK']:0;?></td>
                            <td><?php echo $submission['TOTAL_GP']?$submission['TOTAL_GP']:0;?></td>
                            <td><?php echo $submission['TOTAL_VILLAGE']?$submission['TOTAL_VILLAGE']:0;?></td>
                        <?}?>
                        <td><?php echo $submission['TOTAL_MALE']?$submission['TOTAL_MALE']:0;?></td>
                        <td><?php echo $submission['TOTAL_FEMALE']?$submission['TOTAL_FEMALE']:0;?></td>
                        <td><?php echo $submission['TOTAL_TENTATIVE']-($submission['TOTAL_MALE']+$submission['TOTAL_FEMALE']);?></td>
                        <td><?php echo $submission['TOTAL_TENTATIVE']?$submission['TOTAL_TENTATIVE']:0;?></td>
                        <td><?php echo $submission['TOTAL_SUBMISSION']?$submission['TOTAL_SUBMISSION']:0;?></td>
                        <td><?php echo $submission['TOTAL_MIGRATE_SUBMISSION'];?></td>
                        <td><?php echo $submission['TOTAL_SUBMISSION']+$submission['TOTAL_MIGRATE_SUBMISSION'];?></td>
                        <!--<td><?php echo $submission['TOTAL_DUPLICATE'];?></td>
				<td><?php echo ($submission['TOTAL_SUBMISSION'])-($submission['TOTAL_DUPLICATE']) ;?></td>-->
                    </tr>
                <?php }?>
                <tr>

                    <?if($village){?>
                    <?}else if($grampanchayat){?>
                        <td>Total</td>
                    <?}else if($block){?>
                        <td>Total</td>
                        <td><?=$total_village;?></td>
                    <?} else if($district){?>
                        <td>Total</td>
                        <td><?=$total_gp;?></td>
                        <td><?=$total_village;?></td>
                    <?} elseif($state){?>
                        <td>Total</td>
                        <td><?=$total_block;?></td>
                        <td><?=$total_gp;?></td>
                        <td><?=$total_village;?></td>
                    <?}?>
                    <td><?=$total_male;?></td>
                    <td><?=$total_female;?></td>
                    <td><?=$total_farmer-($total_male+$total_female);?></td>
                    <td><?=$total_farmer;?></td>
                    <td><?=$total_submission;?></td>
                    <td><?=$migrate_submission;?></td>
                    <td><?=$total_submission+$migrate_submission;?></td>
                    <!--<td><?=$total_duplicate;?></td>
				<td><?=($total_submission-$total_duplicate);?></td>-->
                </tr>
                </tbody>
            </table>
        </div>
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
