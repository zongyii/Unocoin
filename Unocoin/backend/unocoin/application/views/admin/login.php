<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>UNOCoin Admin | Login </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/uniform/css/uniform.default.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/select2/select2.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/pages/css/login3.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/css/components.css'); ?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/css/plugins.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/layout.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/themes/darkblue.css'); ?>" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url('assets/admin/layout/css/custom.css'); ?>" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="favicon.ico"/>
</head>

<body class="login">
<div class="logo">
	<a href="index.html">
	<img src="<?php echo base_url('assets/images/small-red-white-logo.png'); ?>" alt=""/>
	</a>
</div>
<div class="menu-toggler sidebar-toggler">
</div>

<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?php echo site_url('admin/login'); ?>" method="post">
		<h3 class="form-title"><?php echo $this->lang->line('signin_alert_header', 'english'); ?></h3>
		<div class="alert alert-danger alert_message_panel" style="display: none; ">
			<?php
				if(isset($message) && !empty($message)) {
					echo $message;
				}
			?>
			<span>
		</div>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			<?php echo $this->lang->line('signin_alert_span', 'english'); ?></span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9"><?php echo $this->lang->line('signin_master_label', 'english'); ?></label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="<?php echo $this->lang->line('signin_master_label', 'english'); ?>" name="mastername"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9"><?php echo $this->lang->line('signin_password_label', 'english'); ?></label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="<?php echo $this->lang->line('signin_password_label', 'english'); ?>" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">&nbsp;</label>
			<button type="submit" class="btn green-haze pull-right">
			<?php echo $this->lang->line('signin_actions_button', 'english'); ?> <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
<!--
		<div class="forget-password">
			<h4><?php echo $this->lang->line('signin_actions_a', 'english'); ?></h4>
			<p>
				 no worries, click <a href="javascript:;" id="forget-password">
				here </a>
				to reset your password.
			</p>
		</div>
-->	


	</form>
	<!-- END LOGIN FORM -->

</div>
<div class="copyright">
	 <?php echo $this->lang->line('signin_footer', 'english'); ?>
</div>
<!--[if lt IE 9]>
<script src="<?php echo base_url('assets/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]-->
<script src="<?php echo base_url('assets/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/global/scripts/metronic.js" type="text/javascript'); ?>"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/demo.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/login.js'); ?>" type="text/javascript"></script>
<script>
	jQuery(document).ready(function() {     
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		Login.init();
		Demo.init();
		<?php
			if(isset($message) && !empty($message)) {
		?>
				$('.alert_message_panel').css('display', 'block');
				$('.alert_message_panel').fadeOut(7000);
				
		<?php				
			}
		?>
	});
</script>
</body>
</html>