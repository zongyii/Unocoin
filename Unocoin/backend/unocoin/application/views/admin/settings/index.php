<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8"/>
<title>UNO Coine Admin | Settings</title>
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
<link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/pages/css/profile.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/pages/css/tasks.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/css/components.css'); ?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/css/plugins.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/layout.css'); ?>" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo base_url('assets/admin/layout/css/themes/darkblue.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/custom.css'); ?>" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

<script>
	var change_password_url = "<?php echo site_url('admin/settings/change_password'); ?>";
	var login_url = "<?php echo site_url('admin/login'); ?>";
	var save_privacy_settings_url = "<?php echo site_url('admin/settings/save_privacy_settings'); ?>";
	var save_coin_settings_url = "<?php echo site_url('admin/settings/save_coin_settings'); ?>";
</script>
<style>
    .has-error {
        border-color: #FF0000;
    }

    .has-error label {
        color: #FF0000;
    }

    .has-error input {
        border-color: #FF0000 !important;
    }	

    .has-error select {
        border-color: #FF0000 !important;
    }    
</style>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
	<?php echo $header; ?>
<div class="clearfix">
</div>
<div class="page-container">
		<?php echo $left; ?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('admin/dashboard'); ?>"><?php echo $this->lang->line('common_home_label'); ?></a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<i class="fa fa-user"></i>
						<a href="<?php echo site_url('admin/profiles/'); ?>"><?php echo $this->lang->line('menu_admin_settings_label'); ?></a>
						</a>
					</li>					
				</ul>
				<div class="page-toolbar">
					&nbsp;
				</div>
			</div>
			<h3 class="page-title">
			<?php echo $this->lang->line('menu_admin_settings_label'); ?> <small>manage the settings of administrator</small>
			</h3>			
			<div class="row margin-top-20">
				<div class="col-md-12">

					<div class="profile-content">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet light">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase"> &nbsp;</span>
										</div>
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_1_1" data-toggle="tab"><?php echo $this->lang->line('setting_change_password_tab_label'); ?></a>
											</li>
											<li>
												<a href="#tab_1_2" data-toggle="tab"><?php echo $this->lang->line('setting_privacy_setting_tab_label'); ?></a>
											</li>			
											<li>
												<a href="#tab_1_3" data-toggle="tab"><?php echo $this->lang->line('setting_alert_setting_tab_label'); ?></a>
											</li>
																						
										</ul>
									</div>
									<div class="portlet-body">
										<div class="row" id="messages"></div>
										<div class="tab-content">
											<!-- CHANGE PASSWORD TAB -->
											<div class="tab-pane active" id="tab_1_1">
												<form action="" method="post" id="change_password_form">
													<div class="form-group">
														<label class="control-label"><?php echo $this->lang->line('setting_change_password_tab_current_password_label'); ?> *</label>
														<input type="password" class="form-control" id="old_password" name="old_password" />
													</div>
													<div class="form-group">
														<label class="control-label"><?php echo $this->lang->line('setting_change_password_tab_new_password_label'); ?> *</label>
														<input type="password" class="form-control" id="change_password" name="change_password" />
													</div>
													<div class="form-group">
														<label class="control-label"><?php echo $this->lang->line('setting_change_password_tab_retype_password_label'); ?> *</label>
														<input type="password" class="form-control" id="change_password_confirm" name="change_password_confirm" />
													</div>
													<div class="margin-top-10">
														<button type="submit" class="btn green-haze">
														<?php echo $this->lang->line('setting_change_password_tab_change_btn_label'); ?></button>
														<a href="<?php echo site_url('admin/dashboard'); ?>" class="btn default">
														<?php echo $this->lang->line('setting_change_password_tab_cancel_btn_label'); ?></a>
													</div>
												</form>
											</div>
											<!-- END CHANGE PASSWORD TAB -->
											<!-- BEGIN PRIAVCY SETTINGS TAB -->
											<div class="tab-pane" id="tab_1_2">
												<form action="" method="post" id="privacy_settings_form">
													<fieldset>
														<legend><?php echo $this->lang->line('setting_pricvacy_setting_tab_stripe_fieldset_label'); ?></legend>
														<div class="form-group">
															<label class="control-label"><?php echo $this->lang->line('setting_pricvacy_setting_tab_stripe_app_key_label'); ?> *</label>
															<input type="text" class="form-control" id="stripe_app_key" name="stripe_app_key" value="<?php if(isset($stripe_app_key) && !empty($stripe_app_key)) echo $stripe_app_key; ?>" />
														</div>
														<div class="form-group">
															<label class="control-label"><?php echo $this->lang->line('setting_pricvacy_setting_tab_stripe_app_secret_label'); ?> *</label>
															<input type="text" class="form-control" id="stripe_app_secret" name="stripe_app_secret" value="<?php if(isset($stripe_app_secret) && !empty($stripe_app_secret)) echo $stripe_app_secret; ?>" />
														</div>
													</fieldset>	
													<div class="clearfix">&nbsp;</div>
													<div class="clearfix">&nbsp;</div>
													<div class="clearfix">&nbsp;</div>

													<fieldset>
														<legend><?php echo $this->lang->line('setting_pricvacy_setting_tab_unochat_fieldset_label'); ?></legend>
														<div class="form-group">
															<label class="control-label"><?php echo $this->lang->line('setting_pricvacy_setting_tab_unochat_merchant_app_key_label'); ?> *</label>
															<input type="text" class="form-control" id="mch_app_key" name="mch_app_key" value="<?php if(isset($mch_app_key) && !empty($mch_app_key)) echo $mch_app_key; ?>" />
														</div>
														<div class="form-group">
															<label class="control-label"><?php echo $this->lang->line('setting_pricvacy_setting_tab_unochat_merchant_app_secret_label'); ?> *</label>
															<input type="text" class="form-control" id="mch_app_secret" name="mch_app_secret" value="<?php if(isset($mch_app_secret) && !empty($mch_app_secret)) echo $mch_app_secret; ?>" />
														</div>
													</fieldset>	

													<div class="margin-top-10">
														<button type="submit" class="btn green-haze">
														<?php echo $this->lang->line('common_save_label'); ?></button>
														<a href="<?php echo site_url('admin/dashboard'); ?>" class="btn default">
														<?php echo $this->lang->line('setting_change_password_tab_cancel_btn_label'); ?></a>
													</div>
												</form>												
											</div>	
											<!-- END PRIAVCY SETTINGS TAB -->	
											<!-- BEGIN COIN SETTINGS TAB -->	
											<div class="tab-pane" id="tab_1_3">
												<form action="" method="post" id="coin_setting_form">
													<fieldset>
														<legend><?php echo $this->lang->line('setting_coin_setting_tab_amount_fieldset_label'); ?></legend>
														<div class="form-group">
															<label class="control-label"><?php echo $this->lang->line('setting_coin_setting_tab_coin_amount_label'); ?> *</label>
															<input type="text" class="form-control" id="coin_amount" name="coin_amount" value="<?php if(isset($total_amount) && !empty($total_amount)) echo $total_amount; ?>"  />
														</div>
														<div class="form-group">
															<label class="control-label"><?php echo $this->lang->line('setting_coin_setting_tab_usd_amount_per_coin_label'); ?> *</label>
															<input type="text" class="form-control" id="coin_per_amount" name="coin_per_amount" value="<?php if(isset($coin_per_amount) && !empty($coin_per_amount)) echo $coin_per_amount; ?>"  />
														</div>														
													</fieldset>	
													<div class="clearfix">&nbsp;</div>
													<div class="clearfix">&nbsp;</div>
													<div class="clearfix">&nbsp;</div>	

													<fieldset>
														<legend><?php echo $this->lang->line('setting_coin_setting_tab_alert_fieldset_label'); ?></legend>
														<div class="form-group">
															<label class="control-label"><?php echo $this->lang->line('setting_coin_setting_tab_min_coin_amount_label'); ?> *</label>
															<input type="text" class="form-control" id="coin_amount_min" name="coin_amount_min" value="<?php if(isset($alert_amount) && !empty($alert_amount)) echo $alert_amount; ?>" />
														</div>
														<div class="form-group">
															<label class="control-label"><?php echo $this->lang->line('setting_coin_setting_tab_phone_number_notification_label'); ?> *</label>
															<input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php if(isset($alert_phone) && !empty($alert_phone)) echo $alert_phone; ?>" />
														</div>
														<div class="form-group">
															<label class="control-label"><?php echo $this->lang->line('setting_coin_setting_tab_email_notification_label'); ?> *</label>
															<input type="text" class="form-control" id="email_address" name="email_address" value="<?php if(isset($alert_email) && !empty($alert_email)) echo $alert_email; ?>" />
														</div>
													</fieldset>
													<div class="margin-top-10">
														<button type="submit" class="btn green-haze">
														<?php echo $this->lang->line('common_save_label'); ?></button>
														<a href="<?php echo site_url('admin/dashboard'); ?>" class="btn default">
														<?php echo $this->lang->line('setting_change_password_tab_cancel_btn_label'); ?></a>
													</div>													
												</form>
											</div>
											<!-- END COIN SETTINGS TAB -->	
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="setting_id" name="setting_id" value="<?php if(isset($setting_id) && !empty($setting_id)) echo $setting_id; ?>" />

<div class="page-footer">
	<div class="page-footer-inner">
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->

<div id="loadingArea"></div>

<!--[if lt IE 9]>
<script src="<?php echo base_url('assets/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]-->
<script src="<?php echo base_url('assets/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-ui/jquery-ui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/quick-sidebar.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/demo.js'); ?>" type="text/javascript"></script>

<script>
	jQuery(document).ready(function() {       
		   // initiate layout and plugins
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features

		$('#change_password_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                old_password: {
                    required: true
                },
                change_password: {
                    required: true
                },                
                change_password_confirm: {
                    equalTo: "#change_password"
                },
            },

            messages: {
                old_password: {
                    required: "<?php echo $this->lang->line('setting_change_password_tab_current_password_label'); ?> is required.",
                },
                change_password: {
                    required: "<?php echo $this->lang->line('setting_change_password_tab_new_password_label'); ?> is required."
                },
                change_password_confirm: {
                    required: "<?php echo $this->lang->line('setting_change_password_tab_retype_password_label'); ?> is required.",
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('#deposit_form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
            	changePassword();
            	return false;
                //form.submit(); // form validation success, call ajax form submit
            }
        });	


		$('#privacy_settings_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                stripe_app_key: {
                    required: true
                },
                stripe_app_secret: {
                    required: true
                },                
                mch_app_key: {
                    required: true
                },                
                mch_app_secret: {
                    required: true
                }

            },

            messages: {
                stripe_app_key: {
                    required: "<?php echo $this->lang->line('setting_pricvacy_setting_tab_stripe_app_key_label'); ?> is required.",
                },
                stripe_app_secret: {
                    required: "<?php echo $this->lang->line('setting_pricvacy_setting_tab_stripe_app_secret_label'); ?> is required."
                },
                mch_app_key: {
                    required: "<?php echo $this->lang->line('setting_pricvacy_setting_tab_unochat_merchant_app_key_label'); ?> is required.",
                },
                mch_app_secret: {
                    required: "<?php echo $this->lang->line('setting_pricvacy_setting_tab_unochat_merchant_app_secret_label'); ?> is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('#privacy_settings_form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
            	savePrivacySettings();
            	return false;
                //form.submit(); // form validation success, call ajax form submit
            }
        });    


		$('#coin_setting_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                coin_amount: {
                    required: true,
                    number: true
                },
                coin_per_amount: {
                    required: true,
                    number: true
                },
                coin_amount_min: {
                    required: true,
                    number: true
                },                
                phone_number: {
                    required: true
                },                
                email_address: {
                    required: true
                }

            },

            messages: {
                coin_amount: {
                    required: "<?php echo $this->lang->line('setting_coin_setting_tab_coin_amount_label'); ?> is required.",
                },
                coin_per_amount: {
                    required: "<?php echo $this->lang->line('setting_coin_setting_tab_usd_amount_per_coin_label'); ?> is required."
                },
                coin_amount_min: {
                    required: "<?php echo $this->lang->line('setting_coin_setting_tab_min_coin_amount_label'); ?> is required."
                },
                phone_number: {
                    required: "<?php echo $this->lang->line('setting_coin_setting_tab_phone_number_notification_label'); ?> is required.",
                },
                email_address: {
                    required: "<?php echo $this->lang->line('setting_coin_setting_tab_email_notification_label'); ?> is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('#privacy_settings_form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
            	saveCoinSettings();
            	return false;
                //form.submit(); // form validation success, call ajax form submit
            }
        });            	
	});

	function changePassword() {
        var old_password = $('#old_password').val();
        var change_password = $('#change_password').val();
        var change_password_confirm = $('#change_password_confirm').val();

        var term = "old_password=" + old_password + "&change_password=" + change_password + "&change_password_confirm=" + change_password_confirm;
        $.ajax({
            type : "POST",
            async : true,
            url : change_password_url,
            dataType : "json",
            timeout : 30000,
            cache : false,
            data : term,
            error : function(request, status, error) {
                console.log(error);
                var success_div = "<div class='alert alert-success'>Fatal Error!</div>";
                $('#messages').html($(success_div));
                $('#messages').fadeOut(5000);
                return false;                
            },
            success : function(response) {

                console.log(response);

                if(response.status) {
                    $('#messages').css('display', 'block');
                    var success_div = "<div class='alert alert-success'>" + response['message'] + "</div>";
                    $('#messages').html($(success_div));
                    $('#messages').fadeOut(5000);
                    $('#old_password').val('');
                    $('#change_password').val('');
                    $('#change_password_confirm').val('');
                    return false;
                } else {
                    $('#messages').css('display', 'block');
                    var error_div = "<div class='alert alert-danger'>" + response['message'] + "</div>";
                    $('#messages').html($(error_div));
                    $('#messages').fadeOut(5000);
                    $('#old_password').val('');
                    $('#change_password').val('');
                    $('#change_password_confirm').val('');                        
                    return false;
                }                    
            }
        });		
	}

	function savePrivacySettings() {
		var stripe_app_key = $('#stripe_app_key').val();
		var stripe_app_secret = $('#stripe_app_secret').val();
		var mch_app_key = $('#mch_app_key').val();
		var mch_app_secret = $('#mch_app_secret').val();

        $.ajax({
            type : "POST",
            async : true,
            url : save_privacy_settings_url,
            dataType : "json",
            timeout : 30000,
            cache : false,
            data : {
            	stripe_app_key: stripe_app_key,
            	stripe_app_secret: stripe_app_secret,
            	mch_app_key: mch_app_key,
            	mch_app_secret: mch_app_secret
            },
            error : function(request, status, error) {
                console.log(error);
                var success_div = "<div class='alert alert-success'>Fatal Error!</div>";
                $('#messages').html($(success_div));
                $('#messages').fadeOut(5000);
                return false;                
            },
            success : function(response) {
                console.log(response);
                if(response.status) {
                    $('#messages').css('display', 'block');
                    var success_div = "<div class='alert alert-success'>" + response['message'] + "</div>";
                    $('#messages').html($(success_div));
                    $('#messages').fadeOut(5000);
                    return false;
                } else {
                    $('#messages').css('display', 'block');
                    var error_div = "<div class='alert alert-danger'>" + response['message'] + "</div>";
                    $('#messages').html($(error_div));
                    $('#messages').fadeOut(5000);
                    return false;
                }                    
            }
        });		
	}


	function saveCoinSettings() {
		var coin_amount = $('#coin_amount').val();
		var coin_per_amount = $('#coin_per_amount').val();
		var coin_amount_min = $('#coin_amount_min').val();
		var phone_number = $('#phone_number').val();
		var email_address = $('#email_address').val();

        $.ajax({
            type : "POST",
            async : true,
            url : save_coin_settings_url,
            dataType : "json",
            timeout : 30000,
            cache : false,
            data : {
            	coin_amount: coin_amount,
            	coin_per_amount: coin_per_amount,
            	coin_amount_min: coin_amount_min,
            	phone_number: phone_number,
            	email_address: email_address
            },
            error : function(request, status, error) {
                console.log(error);
                var success_div = "<div class='alert alert-success'>Fatal Error!</div>";
                $('#messages').html($(success_div));
                $('#messages').fadeOut(5000);
                return false;                
            },
            success : function(response) {
                console.log(response);
                if(response.status) {
                    $('#messages').css('display', 'block');
                    var success_div = "<div class='alert alert-success'>" + response['message'] + "</div>";
                    $('#messages').html($(success_div));
                    $('#messages').fadeOut(5000);
                    return false;
                } else {
                    $('#messages').css('display', 'block');
                    var error_div = "<div class='alert alert-danger'>" + response['message'] + "</div>";
                    $('#messages').html($(error_div));
                    $('#messages').fadeOut(5000);
                    return false;
                }                    
            }
        });				
	}
</script>
</body>
</html>
