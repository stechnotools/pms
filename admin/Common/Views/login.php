<?php
$template = service('template');
$validation = \Config\Services::validation();
?>
<div class="auth-fluid">
	<!--Auth fluid left content -->
	<div class="auth-fluid-form-box">
		<div class="card-body d-flex flex-column h-100 gap-3">
            <!-- Logo -->
            <div class="auth-brand text-center text-lg-start">
                <a href="<?=base_url()?>" class="logo-dark">
                    <?php if ($logo) { ?>
                        <span><img height="22" src="<?php echo $logo; ?>" title="<?php echo $site_name; ?>" alt="<?php echo $site_name; ?>"  /></span>
                    <?php }else{ ?>
                        <span class="font-size-xl text-primary"><?php echo $site_name; ?></span>
                    <?}?>
                </a>
            </div>
            <div class="my-auto">
                <!-- title-->
                <h4 class="mt-0">Sign In</h4>
                <p class="text-muted mb-4">Enter your company email address and password to access account.</p>
                 <?php if($login_error) { ?>
                    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Error - </strong> <?=$login_error?>
                    </div>
                <?php } ?>
				<!-- form -->
                <?php echo form_open($action,array('class' => 'js-validation-signin', 'id' => 'form-signin','role'=>'form')); ?>
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Email address</label>
                        <input class="form-control" type="email" id="username" name="username" required="" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <a href="pages-recoverpw-2.html" class="text-muted float-end"><small>Forgot your password?</small></a>
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox-signin">
                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                        </div>
                    </div>
                    <div class="d-grid mb-0 text-center">
                        <?php if ($redirect) { ?>
                            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                        <?php } ?>
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Log In </button>
                    </div>

					<!-- social-->
					<div class="text-center mt-4">
						<p class="text-muted font-16">Sign in with</p>
                        <div class="form-group mb-0 text-center">
                            <a href="<?=$glogin?>" class="btn btn-primary btn-block"><i class="mdi mdi-login"></i>Wassan E-Mail</a>
                        </div>
					</div>
                <?php echo form_close(); ?>
				<!-- end form-->
			</div> <!-- end .card-body -->
		</div> <!-- end .align-items-center.d-flex.h-100-->
	</div>
	<!-- end auth-fluid-form-box-->

	<!-- Auth fluid right content -->
	<div class="auth-fluid-right text-center">
		<div class="auth-user-testimonial">
			<h2 class="mb-3">Good morning from WASSAN</h2>
			<p class="lead"><i class="mdi mdi-format-quote-open"></i> Project management system<i class="mdi mdi-format-quote-close"></i>
			</p>
			<p>
				~ Admin
			</p>
		</div> <!-- end auth-user-testimonial-->
	</div>
	<!-- end Auth fluid right content -->
</div>   