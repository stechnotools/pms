<?php 
$template=service('template');
$user=service('user');
?>
	<?php if ($user->isLogged()){?>
		<footer class="footer ">
			<script>document.write(new Date().getFullYear())</script> © Stechno Tools
		</footer>
	<?}?>
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

</div><!-- END wrapper -->
<script src="<?=theme_url('assets/js/vendor.min.js');?>"></script>
<script src="<?=theme_url('assets/js/loadingoverlay.min.js');?>"></script>
<script src="<?=theme_url('assets/js/jquery-autotextcolor.js');?>"></script>
<script src="<?=theme_url('assets/js/app.min.js');?>"></script>
<script src="<?=theme_url('assets/js/common.js');?>"></script>
<script src="<?=theme_url('assets/js/r.js?v=1');?>"></script>
<?php echo $template->footer_javascript() ?>
</body>
</html>