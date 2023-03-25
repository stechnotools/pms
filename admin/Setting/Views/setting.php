<?php
$validation = \Config\Services::validation();
?>
<?php echo form_open_multipart('', ['id'=>"form-setting", 'class'=>"form-horizontal needs-validation ".$error_class, 'novalidate'=>'']); ?>
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active show" id="v-pills-general-tab" data-bs-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general"
                           aria-selected="true">
                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                            <span class="d-none d-md-block">General</span>
                        </a>
                        <a class="nav-link" id="v-pills-email-tab" data-bs-toggle="pill" href="#v-pills-email" role="tab" aria-controls="v-pills-email"
                           aria-selected="false">
                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                            <span class="d-none d-md-block">Email</span>
                        </a>

                        <a class="nav-link" id="v-pills-notification-tab" data-bs-toggle="pill" href="#v-pills-notification" role="tab" aria-controls="v-pills-notification"
                           aria-selected="false">
                            <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                            <span class="d-none d-md-block">Notification</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center bg-info">
                    <h4 class="header-title text-bg-info">Setting</h4>
                    <div class="btn-groups">
                        <button type="submit" form="form-setting" class="btn btn-sm btn-success">Save </button>
                        <a href="<?php echo $cancel; ?>" class="btn btn-sm btn-danger">Cancel</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                            <div class="row mb-3">
                                <label for="input-title" class="col-3 col-form-label">App Title</label>
                                <div class="col-9">
                                    <?php echo form_input(array('class'=>'form-control','name' => 'config_site_title', 'id' => 'config_site_title', 'placeholder'=>'Site Title','value' => set_value('config_site_title', $config_site_title??""))); ?>
                                    <div class="invalid-feedback animated fadeInDown"><?= $validation->getError('config_site_title'); ?></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 control-label" for="input-image"><?php echo lang('Setting.entry_logo'); ?></label>
                                <div class="col-sm-3">
                                    <div class="fileinput">
                                        <div class="options-container">
                                            <div class="fl-Left" style="width: 150px; margin-left: 30px; margin-right: 30px;">
                                                <img id="imgProfile" title="Change profile photo" class="profilePic dropzone" src="MediaUploader/MyPHOTO_7.png"
                                                     alt="pic" />
                                                <div> Change profile photo</div>
                                            </div>
                                            <img src="<?php echo $thumb_logo; ?>" class="img-fluid img-thumbnail" alt="profile-image" id="thumb_logo">
                                            <input type="hidden" name="config_site_logo" value="<?php echo $config_site_logo??"";?>" id="site_logo" />
                                            <div class="mt-2">
                                                <div class="options-overlay-content">
                                                    <a class="btn btn-sm btn-rounded btn-primary " onclick="image_upload('site_logo','thumb_logo')">Browse</a>
                                                    <a class="btn btn-sm btn-rounded btn-danger " onclick="$('#thumb_logo').attr('src', '<?php echo $no_image; ?>'); $('#site_logo').attr('value', '');">Clear</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 control-label" for="input-image"><?php echo lang('Setting.entry_icon'); ?></label>
                                <div class="col-sm-3">
                                    <div class="fileinput">
                                        <div class="options-container">
                                            <img src="<?php echo $thumb_icon; ?>" class="img-fluid img-thumbnail" alt="profile-image" id="thumb_icon">
                                            <input type="hidden" name="config_site_icon" value="<?php echo $config_site_icon??"";?>" id="site_icon" />
                                            <div class="mt-2">
                                                <div class="options-overlay-content">
                                                    <a class="btn btn-sm btn-rounded btn-primary min-width-75" onclick="image_upload('site_icon','thumb_icon')">Browse</a>
                                                    <a class="btn btn-sm btn-rounded btn-danger min-width-75" onclick="$('#thumb_icon').attr('src', '<?php echo $no_image; ?>'); $('#site_icon').attr('value', '');">Clear</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input-timezone" class="col-3 col-form-label">Timezone</label>
                                <div class="col-9">
                                    <?php  echo form_dropdown('config_time_zone', option_array_values($timezone, 'value', 'text'), set_value('config_time_zone',$config_time_zone??""),array('class'=>'form-control select2','id' => 'config_time_zone','data-toggle'=>"select2") ); ?>
                                    <div class="invalid-feedback animated fadeInDown"><?= $validation->getError('config_app_url'); ?></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input-timezone" class="col-3 col-form-label">Start of Week</label>
                                <div class="col-9">
                                    <?php  echo form_dropdown('config_start_week', $weeks, set_value('config_start_week',$config_start_week??""),array('class'=>'form-control select2','id' => 'config_start_week') ); ?>
                                    <div class="invalid-feedback animated fadeInDown"><?= $validation->getError('config_start_week'); ?></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input-title" class="col-3 col-form-label">Date format</label>
                                <div class="col-9">
                                    <?php  echo form_dropdown('config_date_format', $date_formats, set_value('config_date_format',$config_date_format??""),array('class'=>'form-control select2','id' => 'config_date_format') ); ?>
                                    <div class="invalid-feedback animated fadeInDown"><?= $validation->getError('config_date_format'); ?></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input-title" class="col-3 col-form-label">Time format</label>
                                <div class="col-9">
                                    <?php  echo form_dropdown('config_time_format', array('12'=>'12 Hours','24'=>'24 Hours'), set_value('config_time_format',$config_time_format??""),array('class'=>'form-control select2','id' => 'config_time_format') ); ?>
                                    <div class="invalid-feedback animated fadeInDown"><?= $validation->getError('config_time_format'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-email" role="tabpanel" aria-labelledby="v-pills-email-tab">
                            <fieldset>
                                <legend>General</legend>
                                <div class="row mb-3">
                                    <label for="input-mail-engine" class="col-sm-3 col-form-label">Mail Engine</label>
                                    <div class="col-sm-9">
                                        <?php  echo form_dropdown('config_mail_protocol', array('mail'=>'Mail','smtp' => 'SMTP'), set_value('config_mail_protocol',$config_mail_protocol??""),array('class'=>'form-control select2','id' => 'config_mail_protocol')); ?>
                                        <div class="form-text">Only choose 'Mail' unless your host has disabled the php mail function.</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input-mail-parameter" class="col-sm-3 col-form-label">Mail Parameters</label>
                                    <div class="col-sm-9">
                                        <?php echo form_input(array('class'=>'form-control','name' => 'config_mail_parameter', 'id' => 'config_mail_parameter', 'placeholder'=>'Mail Parameters','value' => set_value('config_mail_parameter', $config_mail_parameter??""))); ?>
                                        <div class="form-text">When using 'Mail', additional mail parameters can be added here (e.g. -f email@wassan.org).</div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>SMTP</legend>
                                <div class="row mb-3">
                                    <label for="input-mail-smtp-hostname" class="col-sm-3 col-form-label">Hostname</label>
                                    <div class="col-sm-9">
                                        <?php echo form_input(array('class'=>'form-control','name' => 'config_smtp_host', 'id' => 'config_smtp_host', 'value' => set_value('config_smtp_host', $config_smtp_host??""))); ?>
                                        <div class="form-text">Add 'tls://' or 'ssl://' prefix if security connection is required. (e.g. tls://smtp.gmail.com, ssl://smtp.gmail.com).</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input-mail-smtp-username" class="col-3 col-form-label">Username</label>
                                    <div class="col-9">
                                        <?php echo form_input(array('class'=>'form-control','name' => 'config_smtp_username', 'id' => 'config_smtp_username', 'value' => set_value('config_smtp_username', $config_smtp_username??""))); ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input-mail-smtp-password" class="col-3 col-form-label">Password</label>
                                    <div class="col-9">
                                        <?php echo form_input(array('class'=>'form-control','name' => 'config_smtp_password', 'id' => 'config_smtp_password', 'value' => set_value('config_smtp_password', $config_smtp_password??""))); ?>
                                        <div class="form-text">For Gmail you might need to setup an application specific password here: <a href="https://security.google.com/settings/security/apppasswords" target="_blank">https://security.google.com/settings/security/apppasswords</a>.</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input-mail-smtp-port" class="col-3 col-form-label">Port</label>
                                    <div class="col-9">
                                        <?php echo form_input(array('class'=>'form-control','name' => 'config_smtp_port', 'id' => 'config_smtp_port', 'value' => set_value('config_smtp_port', $config_smtp_port??""))); ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input-mail-smtp-timeout" class="col-3 col-form-label">Timeout</label>
                                    <div class="col-9">
                                        <?php echo form_input(array('class'=>'form-control','name' => 'config_smtp_timeout', 'id' => 'config_smtp_timeout', 'value' => set_value('config_smtp_timeout', $config_smtp_timeout??""))); ?>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="tab-pane fade" id="v-pills-notification" role="tabpanel" aria-labelledby="v-pills-notification-tab">
                            <div class="row mb-3">
                                <label for="input-title" class="col-3 col-form-label">Prefered Email</label>
                                <div class="col-9">
                                    <?php echo form_input(array('class'=>'form-control','name' => 'config_email', 'id' => 'config_email', 'placeholder'=>"Prefered Email",'value' => set_value('config_email', $config_email??""))); ?>
                                    <div class="invalid-feedback animated fadeInDown"><?= $validation->getError('config_email'); ?></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input-title" class="col-3 col-form-label">Browser Notification</label>
                                <div class="col-9">
                                    <?php echo form_checkbox(array('id'=>'config_browser_notification','name' => 'config_browser_notification', 'value' => 1,'checked' => (isset($config_browser_notification)?($config_browser_notification == 1):false) ? true : false,'data-switch'=>"bool" )); ?>
                                    <label for="config_browser_notification" data-on-label="On" data-off-label="Off"></label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input-title" class="col-3 col-form-label">Email Notification</label>
                                <div class="col-9">
                                    <?php foreach($mail_status as $key=>$mstatus){?>
                                        <div class="form-check">
                                            <?php echo form_checkbox(array('name' => 'config_mail_notification[]','class'=>'form-check-input', 'value' => $key,'checked' => (isset($config_mail_notification)?(in_array($key,$config_mail_notification)?true:false): false) )); ?>
                                            <label class="form-check-label" for="customCheck1"><?=$mstatus?></label>
                                        </div>
                                    <?}?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>

<?php echo form_close(); ?>
<?php js_start(); ?>
<script type="text/javascript"><!--

    function image_upload(field, thumb) {
        CKFinder.modal( {
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function( finder ) {
                console.log(finder);
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    url=file.getUrl();

                    var lastSlash = url.lastIndexOf("uploads/");
                    var fileName=url.substring(lastSlash+8);
                    //url=url.replace("images", ".thumbs/images");
                    $('#'+thumb).attr('src', decodeURI(url));
                    $('#'+field).attr('value', decodeURI(fileName));

                } );




                finder.on( 'file:choose:resizedImage', function( evt ) {
                    var output = document.getElementById( field );
                    output.value = evt.data.resizedUrl;
                    console.log(evt.data.resizedUrl);
                } );
            }
        });

    };

    //--></script>
<?php js_end(); ?>