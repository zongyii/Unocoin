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
		<link href="<?php echo base_url('assets/global/plugins/morris/morris.css'); ?>" rel="stylesheet" type="text/css">
		<script>
			var make_payment_url = "<?php echo site_url('dashboard/payment_with_deposits'); ?>";
		</script>
	</head>
	<body>
		<!-- Page-->
		<div class="page">
			<?php echo $header; ?>

			<!-- Page Content-->
			<main class="page-content">
				<!-- Main services-->
				<section>
					<div id="messages"></div>
					<div class="row">
<!--						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="dashboard-stat blue-madison" style="margin-bottom: 0px !important; ">
								<div class="visual">
									<i class="fa fa-database"></i>
								</div>
								<div class="details">
									<div class="number">
										 <?php echo number_format($deposited_amount / 100, 2); ?>&nbsp;USD
									</div>
									<div class="desc">
										 deposited
									</div>
								</div>
-->								
<!--								
								<a class="more" href="javascript:createPayment();">
								Recharge with this amount <i class="m-icon-swapright m-icon-white"></i>
								</a>
-->	
<!--							
							</div>
						</div>	
-->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="dashboard-stat red-intense" style="margin-bottom: 0px !important; ">
								<div class="visual">
									<i class="fa fa-bar-chart-o"></i>
								</div>
								<div class="details">
									<div class="number">
										<?php
											if(isset($sales_info['total_sales']) && !empty($sales_info['total_sales'])) {
												echo $sales_info['total_sales'];
											} else {
												echo "0.00";
											}
										?>&nbsp;USD
									</div>
									<div class="desc">
										 Total Payments
									</div>
								</div>
<!--								
								<a class="more" href="javascript:createPayment();">
								Recharge with this amount <i class="m-icon-swapright m-icon-white"></i>
								</a>
-->								
							</div>
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="dashboard-stat green-haze" style="margin-bottom: 0px !important; ">
								<div class="visual">
									<i class="fa fa-shopping-cart"></i>
								</div>
								<div class="details">
									<div class="number">
										<?php
											if(isset($sales_info['total_coins']) && !empty($sales_info['total_coins'])) {
												echo $sales_info['total_coins'];
											} else {
												echo "0";
											}
										?>&nbsp;Coins
									</div>
									<div class="desc">
										 Recharged
									</div>
								</div>
<!--								
								<a class="more" href="javascript:createPayment();">
								Recharge with this amount <i class="m-icon-swapright m-icon-white"></i>
								</a>
-->								
							</div>
						</div>


						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="dashboard-stat purple-plum" style="margin-bottom: 0px !important; ">
								<div class="visual">
									<i class="fa fa-globe"></i>
								</div>
								<div class="details">
									<div class="number">
										 <?php
											if(isset($sales_info['total_transactions']) && !empty($sales_info['total_transactions'])) {
												echo number_format($sales_info['total_transactions']);
											} else {
												echo "0";
											}
										?>
									</div>
									<div class="desc">
										 Transactions
									</div>
								</div>
<!--								
								<a class="more" href="javascript:createPayment();">
								Recharge with this amount <i class="m-icon-swapright m-icon-white"></i>
								</a>
-->								
							</div>
						</div>																						
					</div>
				</section>

<!--
				<section>
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Sales Summary</span>
								<span class="caption-helper hide">weekly stats...</span>
							</div>
							<div class="actions">
							</div>
						</div>
						<div class="portlet-body">
							
							<div class="row list-separated">
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="font-grey-mint font-sm" style="text-align: center;">
										 Total Payments
									</div>
									<div class="uppercase font-hg font-red-flamingo" style="text-align: center;" id="sales_div">
										<?php
											if(isset($sales_info['total_sales']) && !empty($sales_info['total_sales'])) {
												echo $sales_info['total_sales'];
											} else {
												echo "0.00";
											}
										?> <span class="font-lg font-grey-mint">USD</span>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="font-grey-mint font-sm" style="text-align: center;">
										 Coins
									</div>
									<div class="uppercase font-hg theme-font" style="text-align: center;" id="revenues_div">
										<?php
											if(isset($sales_info['total_coins']) && !empty($sales_info['total_coins'])) {
												echo $sales_info['total_coins'];
											} else {
												echo "0.00";
											}
										?> </span>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="font-grey-mint font-sm" style="text-align: center;">
										 Transactions
									</div>
									<div class="uppercase font-hg font-blue-sharp" style="text-align: center;" id="transactions_div">
										<?php
											if(isset($sales_info['total_transactions']) && !empty($sales_info['total_transactions'])) {
												echo number_format($sales_info['total_transactions']);
											} else {
												echo "0";
											}
										?>
									</div>
								</div>
							</div>

							<div id="sales_statistics" class="portlet-body-morris-fit morris-chart" style="height: 260px">
							</div>
						</div>
					</div>
-->					
			</main>			
		</div>
		
	</body>
	
    <script src="<?php echo base_url('assets/frontend/js/core.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/script.js'); ?>"></script>

	<script src="<?php echo base_url('assets/global/plugins/morris/morris.min.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/global/plugins/morris/raphael-min.js'); ?>" type="text/javascript"></script>

    <script>
    	jQuery(document).ready(function() {
/*
			var chart_data = [];
			<?php

				if(isset($sales_info['graph_array']) && count($sales_info['graph_array'])) {
					foreach($sales_info['graph_array'] as $each_graph) {
						echo "chart_data.push({ period: '".$each_graph[0]."', payments: ".$each_graph[1].", coins: ".$each_graph[2].", transactions: ".$each_graph[3]." });";
					}
				}
								
			?>		
			initCharts(chart_data);
*/			
        });


	    function initCharts(chart_data) {
	        if (Morris.EventEmitter) {
	            // Use Morris.Area instead of Morris.Line
	            dashboardMainChart = Morris.Area({
	                element: 'sales_statistics',
	                padding: 0,
	                behaveLikeLine: true,
	                gridEnabled: true,
	                gridLineColor: true,
	                axes: true,
	                fillOpacity: 0.5,
	                data: chart_data,
	                lineColors: ['#8e5fa2', '#4db3a4', '#5C9BD1'],
	                xkey: 'period',
	                ykeys: ['payments', 'coins', 'transactions'],
	                labels: ['Payments', 'Coins', 'Transactions'],
	                pointSize: 0,
	                lineWidth: 0,
	                hideHover: 'auto',
	                resize: true
	            });

	        }
	    }


        function createPayment() {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            createCustomizeProgressLoader($('#loadingArea'), ''); 

	        $.ajax({
	            type : "POST",
	            async : true,
	            url : make_payment_url,
	            dataType : "json",
	            timeout : 30000,
	            cache : false,
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
		                		response.coin_amount + " Coins recharged. "  + 
		                		response.deposit_amount + " USD deposited.</p></div>";
		                $('#messages').html($(error_div));
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
</html>														
