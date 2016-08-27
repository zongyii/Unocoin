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
	var create_transaction_url = "<?php echo site_url('admin/topup/create_transaction'); ?>";
	var login_url = "<?php echo site_url('admin/login'); ?>";
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
						<i class="fa fa-money"></i>
						<a href="<?php echo site_url('admin/topup/'); ?>"><?php echo $this->lang->line('menu_admin_top_up_label'); ?></a>
						</a>
					</li>					
				</ul>
				<div class="page-toolbar">
					&nbsp;
				</div>
			</div>
			<h3 class="page-title">
			<?php echo $this->lang->line('menu_admin_top_up_label'); ?> <small>topup payment for coin</small>
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

									</div>
									<div class="portlet-body">
										<div class="row" id="messages"></div>
										<form action="" method="post" id="topup_form">
											<div class="form-group">
												<label class="control-label"><?php echo $this->lang->line('topup_amount_label'); ?> *</label>
												<input type="number" class="form-control" id="topup_amount" name="topup_amount" />
											</div>
											<div class="form-group">
												<label class="control-label"><?php echo $this->lang->line('topup_unochat_uid_label'); ?> *</label>
												<input type="text" class="form-control" id="unochat_uid" name="unochat_uid" />
											</div>
											<div class="form-group">
												<label class="control-label"><?php echo $this->lang->line('topup_unochat_id_label'); ?> *</label>
												<input type="text" class="form-control" id="unochat_account" name="unochat_account" />
											</div>
											<div class="form-group">
												<label class="control-label"><?php echo $this->lang->line('topup_dynamic_code_label'); ?> *</label>
												<input type="text" class="form-control" id="dynamic_code" name="dynamic_code" />
											</div>

											<div class="form-group">
												<label class="control-label"><?php echo $this->lang->line('topup_remark_label'); ?> </label>
												<input type="text" class="form-control" id="remarks" name="remarks" />
											</div>


											<div class="margin-top-10">
												<button type="submit" class="btn green-haze">
												<?php echo $this->lang->line('setting_change_password_tab_change_btn_label'); ?></button>
												<a href="<?php echo site_url('admin/dashboard'); ?>" class="btn default">
												<?php echo $this->lang->line('setting_change_password_tab_cancel_btn_label'); ?></a>
											</div>
										</form>
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

		$('#topup_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                topup_amount: {
                    required: true,
                    number: true
                },
                unochat_uid: {
                    required: true
                },                
                unochat_account: {
                    required: true
                },
                dynamic_code: {
                    required: true
                }                
            },

            messages: {
                topup_amount: {
                    required: "<?php echo $this->lang->line('topup_amount_label'); ?> is required.",
                },
                unochat_uid: {
                    required: "<?php echo $this->lang->line('topup_unochat_uid_label'); ?> is required."
                },
                unochat_account: {
                    required: "<?php echo $this->lang->line('topup_unochat_id_label'); ?> is required.",
                },
                dynamic_code: {
                    required: "<?php echo $this->lang->line('topup_dynamic_code_label'); ?> is required.",
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('#topup_form')).show();
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
            	createTransaction();
            	return false;
                //form.submit(); // form validation success, call ajax form submit
            }
        });		
	});


	function createTransaction() {
		var amount = $('#topup_amount').val();
		var uid = $('#unochat_uid').val();
		var account_name = $('#unochat_account').val();
		var dynamic_code = $('#dynamic_code').val();
		var remarks = $('#remarks').val();

        $("html, body").animate({ scrollTop: 0 }, "slow");
        createCustomizeProgressLoader($('#loadingArea'), '');
        $.ajax({
            type : "POST",
            async : true,
            url : create_transaction_url,
            dataType : "json",
            timeout : 30000,
            cache : false,
            data : {
            	amount: amount,
            	uid: uid,
            	account_name: account_name,
            	dynamic_code: dynamic_code,
            	remarks: remarks
            },
            error : function(request, status, error) {
            	destroyCustomizeProgressLoader();
                console.log(error);
                var success_div = "<div class='alert alert-success'>Fatal Error!</div>";
                $('#messages').html($(success_div));
                $('#messages').fadeOut(5000);
                return false;                
            },
            success : function(response) {
            	destroyCustomizeProgressLoader();
                console.log(response);
                if(response.status) {
                    $('#messages').css('display', 'block');
                    var success_div = "<div class='alert alert-success'>" + response['message'] + "</div>";
                    $('#messages').html($(success_div));
                    $('#messages').fadeOut(7000);
                    return false;
                } else {
            		if(response.login) {
            			location.replace(login_url);
            			return false;
            		}
                    $('#messages').css('display', 'block');
                    var error_div = "<div class='alert alert-danger'>" + response['message'] + "</div>";
                    $('#messages').html($(error_div));
                    $('#messages').fadeOut(7000);
                    return false;
                }                    
            }
        });				
	}


    function createCustomizeProgressLoader(container, str) {
        var maskElement = $("<div id='mask'>");
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
        maskElement.css({'width': maskWidth, 
            'height': maskHeight, 
            'position': 'absolute', 
            'left': 0, 
            'top': 0, 
            'background': '#333333',
            'z-index': '999999'});
        maskElement.fadeTo('slow', 0.5);
        
        var loadDialogElement = $("<fieldset>");
        var divElement = $("<div id='ele' style='text-align: center; background-color: #fff; border-color: #fff; border-radius: 10px !important; margin: 0px;'>");
        var spanElement = $("<span style='font-weight: 900; color: #000; font-size: 20px;' />");
        var progressDivElement = $("<img src='<?php echo base_url('assets/frontend/images/preloader.gif'); ?>' style='width: 60px; height: 60px; margin-top: 10px;'>");

        loadDialogElement.css({
            'margin-top': 8
        });
        divElement.css({
            'left': Math.floor($(window).width() / 2 - 50),
            'top': Math.floor($(window).height() / 2 - 28),
            'position': 'absolute',
            'width': 100,
            'height': 100,
            'z-index': '999999'
        });
        spanElement.html(str);
        
        progressDivElement.appendTo(loadDialogElement);
        maskElement.appendTo(container);

        divElement.appendTo(container);
        loadDialogElement.appendTo(divElement);

        spanElement.appendTo(divElement);  
 
    }   
    
    function destroyCustomizeProgressLoader() {
        $('#mask').remove();
        $('#ele').remove();
    }

</script>
</body>
</html>																							