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

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css'); ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'); ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css'); ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css'); ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'); ?>"/>

		<style>
			.ui-to-top {
			    width: 50px;
			    height: 50px;
			    font-size: 24px;
			    line-height: 46px;
			    border-radius: 50% !important;
			    position: fixed;
			    right: 15px;
			    bottom: 15px;
			    overflow: hidden;
			    text-align: center;
			    text-decoration: none;
			    z-index: 20;
			    transition: .3s all ease;
			    -webkit-transform: translateY(100px);
			    transform: translateY(100px);
			}
		</style>

		<script>
			var search_url = "<?php echo site_url('transactions/search_transactions'); ?>";
		</script>
	</head>
	<body>
		<!-- Page-->
		<div class="page">
			<?php echo $header; ?>

			<!-- Page Content-->
			<main class="page-content">
				<!-- Main services-->
				<section class="section-bottom-55">
					<div class="row">
						<div class="col-md-12">
							<div class="portlet light bordered" style="border-bottom: none !important; padding: 0px;">
								<div class="portlet-title">
									<div class="caption font-green-sharp">
										<i class="icon-speech font-green-sharp"></i>
										<span class="caption-subject bold uppercase" style="color: #24a3d8; ">Transaction History</span>
										<span class="caption-helper"></span>
									</div>
									<div class="actions">
										<a href="javascript:openSearchModal();" class="btn btn-circle btn-default" style="background-color: white; border: none;">
											<i class="icon icon-md-variant-1 icon-primary fa-search" style="color: #229dd1; font-size: 25px;"></i>
										</a>
									</div>			

<!--
									<div class="inputs">
										<div class="input-group">
											<input type="text" class="form-control input-circle-left" placeholder="search...">
											<span class="input-group-btn">
												<button class="btn btn-circle-right btn-default" type="button" >
													<i class="icon icon-md-variant-1 icon-primary fa-calendar-check-o" style="font-size: 25px; margin-top: 10px;"></i>
												</button>
											
										</div>	
									</div>
-->									
								</div>
								<div class="portlet-body">
									<div class="row" id="transaction_list" style="text-align: center; padding-left: 10px; padding-right: 10px; margin-left: 5px; margin-right: 5px;">
										<?php
											if(count($transactions) > 0) {
												foreach($transactions as $transaction) {
										?>
													<div class="portlet box blue">
														<div class="portlet-title">
															<div class="caption">
																<i class="fa fa-history"></i><?php echo date("d M Y", $transaction['created_at']); ?>
															</div>
															<div class="tools">
															</div>
														</div>
														<div class="portlet-body">
															<table class="table table-border-top">
											                    <thead>
																	<tr>
																		<th style="text-align: center;">Time</th>
																		<th style="text-align: right;">Coin</th>
																		<th style="text-align: right;">Payment (USD)</th>
																	</tr>
											                    </thead>
											                    <tbody>
											                      	<tr>
																		<td style="text-align: center;">
																			<?php echo date('H:i', $transaction['created_at']); ?>
																		</td>
											                        	<td style="text-align: right;">
											                        		<?php echo $transaction['amount_coin']; ?>
											                        	</td>
											                        	<td style="text-align: right;">
											                        		<?php echo number_format($transaction['amount'] / 100, 2); ?>
											                        	</td>
											                      	</tr>
											                    </tbody>
<!--											                    
											                    <tfoot>
											                      	<tr>
											                        	<td>All Items</td>
											                        	<td>Description</td>
											                        	<td>Your Total</td>
											                        	<td>$10.00</td>
											                      	</tr>
											                    </tfoot>
-->											                    
											                  </table>															 
														</div>
													</div>


										<?php			
												}
											}
										?>
									</div>
									<div class="row">&nbsp;</div>
									<div class="row" style="text-align: center;" id="load_logo_field"></div>
									<div class="row">&nbsp;</div>
									<div class="row" style="text-align: center;">
										<?php
											if(count($transactions) > 0) {
										?>
												<button id="view_more_btn" class="btn btn-circle btn-curious-blue" style="width: 200px; padding: 5px 29px; font-size: 25px;" onclick="viewMore(false);">View more</button>
										<?php
											}
										?>			
									</div>
								</div>

							</div>
						</div>
					</div>		
				</section>
			</main>
		</div>

		<div id="loadingArea"></div>

		<div id="searchModal" class="modal fade" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<a class="close" data-dismiss="modal">x</a>
						<h4 class='main_font_header'>Search Transaction</h4>
					</div>
					<div class="modal-body">
						<form>
								<label>From Date</label>
								<div class="input-icon left">
									<i class="icon icon-md-variant-1 icon-primary fa-calendar-check-o" style="font-size: 25px; padding-top: 5px; padding-left: 10px; color: #24a3d8;"></i>
									<input type="text" id="from_date" name="from_date" class="form-control input-circle date date-picker" placeholder="From Date" data-date-format="yyyy-mm-dd" style="padding-left: 50px;" readonly />
								</div>
								<div class="row">&nbsp;</div>
								<label>To Date</label>
								<div class="input-icon left">
									<i class="icon icon-md-variant-1 icon-primary fa-calendar-check-o" style="font-size: 25px; padding-top: 5px; padding-left: 10px; color: #24a3d8;"></i>
									<input type="text" id="to_date" name="to_date" class="form-control input-circle date date-picker" placeholder="To Date" data-date-format="yyyy-mm-dd" style="padding-left: 50px;" readonly />
								</div>								
								<button class="btn btn-default btn-circle " onclick="javascript: clearDate(); return false;" type="button">Clear</button>
						</form>		
					</div>
					<div class="modal-footer">
				    	<button class="btn btn-default btn-circle " data-dismiss="modal" aria-hidden="true">Cancel</button>
				    	<button onclick="javascript: searchDate();" class="btn btn-primary btn-circle " style="margin-top: 0px;">Search</button>
					</div>
				</div>
			</div>
		</div>		

		<input type="hidden" id="search_offset" name="search_offset" value="<?php if(isset($search_offset)) echo $search_offset; else echo "0"; ?>" />
		<input type="hidden" id="search_limit" name="search_limit" value="<?php if(isset($search_limit)) echo $search_limit; else echo "5"; ?>" />

	    <script src="<?php echo base_url('assets/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>

	    <script src="<?php echo base_url('assets/frontend/js/core.min.js'); ?>"></script>
	    <script src="<?php echo base_url('assets/frontend/js/script.js'); ?>"></script>

		<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/clockface/js/clockface.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/moment.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>"></script>


		<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
	    
	    <script>
	    var preventCount = 0;
	    	jQuery(document).ready(function() {
				if (jQuery().datepicker) {
		            $('.date-picker').datepicker({
		                rtl: false,
		                orientation: "left",
		                autoclose: true
		            });
		            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
		        }


				$('#searchModal').on('hidden.bs.modal', function (e) {
				  	$("html, body").animate({ scrollTop: 0 }, "slow");
				})				

	        });

	        function clearDate() {
	        	$('#from_date').val("");
	        	$('#to_date').val("");
	        }

	        function openSearchModal() {

	        	$('#searchModal').modal();
	        	$("html, body").animate({ scrollTop: document.body.clientHeight / 2 }, "slow");
	        }

	        function searchDate() {
	        	var from_date = $('#from_date').val();
	        	var to_date = $('#to_date').val();
	    		// var search_offset = $('#search_offset').val();
	    		// var search_limit = $('#search_limit').val();
	    		var search_offset = 0;
	    		var search_limit = 0;
	    		$('#searchModal').modal('hide');
	    		$('#view_more_btn').css('visibility', 'hidden');
	    		createCustomizeProgressLoaderLocalArea($('#transaction_list'));
			    $.ajax({
			        type : "POST",
			        async : true,
			        url : search_url,
			        dataType : "json",
			        timeout : 30000,
			        cache : false,
			        data : {search_offset: search_offset, 
			        		search_limit: search_limit, 
			        		from_date: from_date,
			        		to_date: to_date},
			        error : function(request, status, error) {
			        	destroyCustomizeProgressLoader($('#transaction_list'));
			        	$('#view_more_btn').css('visibility', 'visible');
			            console.log(error);
			        },
			        success : function(response) {
			        	console.log(response);
			        	destroyCustomizeProgressLoader($('#transaction_list'));
			        	//return;
			        	
			        	if(response.status == true) {
			        		var append_html = '';
				        	$.each(response.transactions, function(index, value) {
								append_html = append_html + '<div class="portlet box blue">';
								append_html = append_html + '<div class="portlet-title">';
								append_html = append_html + '<div class="caption">';
								append_html = append_html + '<i class="fa fa-history"></i>' + value['created_at'];
								append_html = append_html + '</div>';
								append_html = append_html + '<div class="tools">';
								append_html = append_html + '<a href="javascript:;" class="collapse" data-original-title="" title="">';
								append_html = append_html + '</a>';
								append_html = append_html + '<a href="" class="fullscreen" data-original-title="" title="">';
								append_html = append_html + '</a>';
								append_html = append_html + '</div>';
								append_html = append_html + '</div>';
								append_html = append_html + '<div class="portlet-body">';
								append_html = append_html + '<table class="table table-border-top">';
						        append_html = append_html + '<thead>';
								append_html = append_html + '<tr>';
								append_html = append_html + '<th style="text-align: center;">Time</th>';
								append_html = append_html + '<th style="text-align: right;">Coin</th>';
								append_html = append_html + '<th style="text-align: right;">Payment (USD)</th>';
								append_html = append_html + '</tr>';
						        append_html = append_html + '</thead>';
						        append_html = append_html + '<tbody>';
						        append_html = append_html + '<tr>';
								append_html = append_html + '<td style="text-align: center;">';
								append_html = append_html + value['created_at_time'];
								append_html = append_html + '</td>';
						        append_html = append_html + '<td style="text-align: right;">';
						        append_html = append_html + value['amount_coin'];
						        append_html = append_html + '</td>';
						        append_html = append_html + '<td style="text-align: right;">';
						        append_html = append_html + value['amount'];
						        append_html = append_html + '</td>';
						        append_html = append_html + '</tr>';
						        append_html = append_html + '</tbody>';
								append_html = append_html + '</table>';
								append_html = append_html + '</div>';
								append_html = append_html + '</div>';			        		
				        	});
							
							$('#transaction_list').html($(append_html));
							$('#search_offset').val(response.search_offset);
							$('#search_limit').val(response.search_limit);
							$('#view_more_btn').css('visibility', 'visible');
						} else {

						}

			        }
			    });
	        }


	    	function viewMore(is_change_date) {
	    		var search_offset = $('#search_offset').val();
	    		var search_limit = $('#search_limit').val();

	        	var from_date = $('#from_date').val();
	        	var to_date = $('#to_date').val();

	    		createCustomizeProgressLoaderLocalArea($('#load_logo_field'));

			    $.ajax({
			        type : "POST",
			        async : true,
			        url : search_url,
			        dataType : "json",
			        timeout : 30000,
			        cache : false,
			        data : {search_offset: search_offset, 
			        		search_limit: search_limit, 
			        		from_date: from_date,
			        		to_date: to_date},
			        error : function(request, status, error) {
			        	destroyCustomizeProgressLoader($('#load_logo_field'));
			            console.log(error);
			        },
			        success : function(response) {
			        	destroyCustomizeProgressLoader($('#load_logo_field'));
			        	if(response.status === true) {
			        		var append_html = '';
				        	$.each(response.transactions, function(index, value) {
								append_html = append_html + '<div class="portlet box blue">';
								append_html = append_html + '<div class="portlet-title">';
								append_html = append_html + '<div class="caption">';
								append_html = append_html + '<i class="fa fa-history"></i>' + value['created_at'];
								append_html = append_html + '</div>';
								append_html = append_html + '<div class="tools">';
								append_html = append_html + '<a href="javascript:;" class="collapse" data-original-title="" title="">';
								append_html = append_html + '</a>';
								append_html = append_html + '<a href="" class="fullscreen" data-original-title="" title="">';
								append_html = append_html + '</a>';
								append_html = append_html + '</div>';
								append_html = append_html + '</div>';
								append_html = append_html + '<div class="portlet-body">';
								append_html = append_html + '<table class="table table-border-top">';
						        append_html = append_html + '<thead>';
								append_html = append_html + '<tr>';
								append_html = append_html + '<th style="text-align: center;">Time</th>';
								append_html = append_html + '<th style="text-align: right;">Coin</th>';
								append_html = append_html + '<th style="text-align: right;">Payment (USD)</th>';
								append_html = append_html + '</tr>';
						        append_html = append_html + '</thead>';
						        append_html = append_html + '<tbody>';
						        append_html = append_html + '<tr>';
								append_html = append_html + '<td style="text-align: center;">';
								append_html = append_html + value['created_at_time'];
								append_html = append_html + '</td>';
						        append_html = append_html + '<td style="text-align: right;">';
						        append_html = append_html + value['amount_coin'];
						        append_html = append_html + '</td>';
						        append_html = append_html + '<td style="text-align: right;">';
						        append_html = append_html + value['amount'];
						        append_html = append_html + '</td>';
						        append_html = append_html + '</tr>';
						        append_html = append_html + '</tbody>';
								append_html = append_html + '</table>';
								append_html = append_html + '</div>';
								append_html = append_html + '</div>';			        		
				        	});
							
							if(is_change_date === true) {
								$('#transaction_list').html($(append_html));
							} else {
								$('#transaction_list').append($(append_html));
							}
							$('#search_offset').val(response.search_offset);
							$('#search_limit').val(response.search_limit);
						} else {

						}

			        }
			    });	    		 
	    	}

			function createCustomizeProgressLoaderLocalArea(container) {
				container.html("<img src='<?php echo base_url('assets/admin/layout/img/loading-spinner-default.gif'); ?>' style='width: 22px; height: 22px;'>");

		    }

		    function destroyCustomizeProgressLoader(container) {
		    	container.html("");
		    }

	    </script>
	</body>
</html>	        
