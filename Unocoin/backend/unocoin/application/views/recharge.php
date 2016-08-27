<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="utf-8"/>
		<title></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
		<meta content="" name="description"/>
		<meta content="" name="author"/>
	
		<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/style.css'); ?>">
		<link href="<?php echo base_url('assets/global/css/components.css'); ?>" id="style_components" rel="stylesheet" type="text/css"/>
		<script>
			var make_payment_url = "<?php echo site_url('recharge/payment'); ?>";
			var login_url = "<?php echo site_url('dashboard'); ?>";
			var coin_per_amount = <?php echo $coin_per_amount; ?>;

		</script>
	</head>
	<body>
		<!-- Page-->
		<div class="page">
			<?php echo $header; ?>

			<!-- Page Content-->
			<main class="page-content">
				<!-- Main services-->

<style>
	.input-padding {
		padding-left: 10px;
		padding-right: 10px;
		padding-top: 5px;
		padding-bottom: 5px;
		height: 40px;
		border-radius: 3px !important;
	}

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
				<section>
					<div class="row">
						<div class="col-md-12" style="margin-left: 5px; margin-right: 5px; padding: 0px;">
							<!-- BEGIN Portlet PORTLET-->
							<div class="portlet light bordered" style="padding: 5px;">
								<div class="portlet-title">
									<div class="caption font-green-sharp">
										<i class="icon-speech font-green-sharp"></i>
										<span class="caption-subject bold uppercase" style="color: #24a3d8; ">Credit Card Payment</span>
										<span class="caption-helper"></span>
									</div>
									<div class="actions">

									</div>
								</div>
								<div class="portlet-body">
									<form role="form" method="post" id="cc_form" onsubmit="return false;">
										<div id="messages"></div>
										<div class="alert alert-danger display-hide" id="infos">
											<button class="close" data-close="alert"></button>
											<span>Please enter required fields.
											</span>
										</div>

										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-2 hidden-xs"></div>
											<div class="col-lg-4 col-md-4 col-sm-8 col-xs-12" style="text-align: center;">
												<h4>Pick the coin amount</h4>
												<input class="knob" data-angleoffset=-125 data-anglearc=250 data-fgcolor="#66EE66" value="5" data-min="1" data-max="10000">
											</div>
											<div class=" col-lg-4 col-md-4 col-sm-2 hidden-xs"></div>

										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 0px; padding-right: 0px; text-align: center;">
											<span id="usd_amount_span" style="color: rgb(102, 238, 102); font-size: 20px; font-weight: 800;"><?php echo $coin_per_amount * 5; ?> USD</span><span>&nbsp;&nbsp;(1 Coin / <?php echo $coin_per_amount; ?> USD)</span>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
											<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
												<div class="form-group">
													<label class="control-label sr-only"><?php echo $this->lang->line('signup_firstname_label'); ?> *</label>
													<input type="text" id="cc_number" name="cc_number" placeholder="Card Number" class="form-control input-padding" />
												</div>
											</div>
											<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="padding-left: 0px;">
												<div class="form-group">
													<label class="control-label sr-only"><?php echo $this->lang->line('signup_lastname_input'); ?> *</label>
													<input type="text" id="cvc" name="cvc" placeholder="CVC" class="form-control input-padding" />
												</div>
											</div>	
										</div>
										<div class="clearfix">&nbsp;</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
												<div class="form-group">
													<label class="control-label sr-only"><?php echo $this->lang->line('signup_firstname_label'); ?> *</label>
													<select  class="form-control input-padding" id="exp_month" name="exp_month">
														<option value="">Exp Month</option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
													</select>
												</div>
											</div>

											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-left: 0px;">
												<div class="form-group">
													<label class="control-label sr-only"><?php echo $this->lang->line('signup_lastname_input'); ?> *</label>
													<select  class="form-control input-padding" id="exp_year" name="exp_year">
														<option value="">Exp Year</option>
														<option value="2016">2016</option>
														<option value="2017">2017</option>
														<option value="2018">2018</option>
														<option value="2019">2019</option>
														<option value="2020">2020</option>
														<option value="2021">2021</option>
														<option value="2022">2022</option>
														<option value="2023">2023</option>
														<option value="2024">2024</option>
														<option value="2025">2025</option>
													</select>
												</div>
											</div>	
										</div>


										<div class="clearfix">&nbsp;</div>
										<div class="row" style="padding-left: 15px; padding-right: 15px;">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
												<div class="margiv-top-10">
													<button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 15px !important; ">
														Payment
													</button>
												</div>
											</div>
										</div>
										<input type="hidden" name="amount" id="amount" value="5" />

									</form>
								</div>
							</div>
							<!-- END Portlet PORTLET-->
						</div>
					</div>	
				</section>


			</main>			
		</div>
		

		<div id="loadingArea"></div>

	
	    <script src="<?php echo base_url('assets/frontend/js/core.min.js'); ?>"></script>
	    <script src="<?php echo base_url('assets/frontend/js/script.js'); ?>"></script>
	    <script src="<?php echo base_url('assets/global/plugins/jquery-knob/js/jquery.knob.js'); ?>"></script>
	    <script src="<?php echo base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>

	    <script>
	    	jQuery(document).ready(function() {
	            $(".knob").knob({
	                'dynamicDraw': true,
	                'thickness': 0.2,
	                'tickColorizeValues': true,
	                'skin': 'tron',
	                'release': function(val) {
	                	$('#amount').val(val);
	                	var usd_amount = val * <?php echo $coin_per_amount; ?>;
	                	$('#usd_amount_span').html(number_format(usd_amount, 2) + " USD");
	                },
	                'change': function(val) {
	                	$('#amount').val(val);
	                	var usd_amount = val * <?php echo $coin_per_amount; ?>;
	                	$('#usd_amount_span').html(number_format(usd_amount, 2) + " USD");
	                }
	            }); 

				$('#cc_form').validate({
		            errorElement: 'span', //default input error message container
		            errorClass: 'help-block', // default input error message class
		            focusInvalid: false, // do not focus the last invalid input
		            rules: {
		                cc_number: {
		                    required: true,
		                    number: true
		                },
		                cvc: {
		                    required: true,
		                    number: true
		                },
		                exp_month: {
		                    required: true,
		                    number: true
		                },
		                exp_year: {
		                    required: true,
		                    number: true
		                },
		                amount: {
		                    required: true,
		                    number: true	                
		                }
		            },

		            messages: {
		                cc_number: {
		                    required: "Card Number is required.",
		                    number: "Must input number value."
		                },
		                deposit_currency: {
		                    required: "CVC is required.",
		                    number: "Must input number value."
		                },                
		                exp_month: {
		                    required: "Exp Month is required.",
		                    number: "Must input number value."
		                },
		                exp_year: {
		                    required: "Exp Year is required.",
		                    number: "Must input number value."
		                },
		                amount: {
		                    required: "Amount is required.",
		                    number: "Must input number value."	                
		                }
		            },

		            invalidHandler: function(event, validator) { //display error alert on form submit   
		                $('.alert-danger', $('#cc_form')).show();
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
		            	paymentSubmit();
		            	return false;
		                //form.submit(); // form validation success, call ajax form submit
		            }
		        });            
	        });


			function number_format(num, decimals, dec_point, thousands_sep) {
			    num = parseFloat(num);
			    if(isNaN(num)) return '0';
			 
			    if(typeof(decimals) == 'undefined') decimals = 0;
			    if(typeof(dec_point) == 'undefined') dec_point = '.';
			    if(typeof(thousands_sep) == 'undefined') thousands_sep = ',';
			    decimals = Math.pow(10, decimals);
			 
			    num = num * decimals;
			    num = Math.round(num);
			    num = num / decimals;
			 
			    num = String(num);
			    var reg = /(^[+-]?\d+)(\d{3})/;
			    var tmp = num.split('.');
			    var n = tmp[0];
			    var d = tmp[1] ? dec_point + tmp[1] : '';
			 
			    while(reg.test(n)) n = n.replace(reg, "$1"+thousands_sep+"$2");
			 
			    return n + d;
			}

			function paymentSubmit() {
				var amount = $('#amount').val();
				var cc_number = $('#cc_number').val();
				var cvc = $('#cvc').val();
				var exp_month = $('#exp_month').val();
				var exp_year = $('#exp_year').val();

				if(amount && amount > 0) {

                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    createCustomizeProgressLoader($('#loadingArea'), '');

			        $.ajax({
			            type : "POST",
			            async : true,
			            url : make_payment_url,
			            dataType : "json",
			            timeout : 30000,
			            cache : false,
			            data : {amount: amount, cc_number: cc_number, cvc: cvc, exp_month: exp_month, exp_year: exp_year},
			            error : function(request, status, error) {
			            	destroyCustomizeProgressLoader();
			                console.log(error);    
			                var error_div = "<div class='alert alert-danger'>Fatal Error!</div>";
			                $('#messages').html($(error_div));			                                
			            },
			            success : function(response) {	
			            	destroyCustomizeProgressLoader();
			            	console.log(response);
			            	if(response.status === false) {
			            		if(response.login) {
			            			location.replace(login_url);
			            			return false;
			            		}

				                var error_div = "<div class='alert alert-danger'>" + response.message + "</div>";
				                $('#messages').html($(error_div));
				                return false;		            		
			            	} else {
				                var error_div = "<div class='alert alert-success'>" + 
				                		response.message + "<p>" + 
				                		response.coin_amount + " Coins recharged.</p></div>"  + 
				                		/*response.deposit_amount + " USD deposited.</p></div>";*/
				                $('#messages').html($(error_div));
				                return false;
			            	}

			            }
		            });
				} else {
	                var error_div = "<div class='alert alert-danger'>Amount value must be great than 0.</div>";
	                $('#infos').html($(error_div));
	                return false;
				}
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