<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>UNOCoin Admin | Transaction History</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/uniform/css/uniform.default.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/fullcalendar/fullcalendar.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/jqvmap/jqvmap/jqvmap.css'); ?>" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/select2/select2.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css'); ?>"/>


<link href="<?php echo base_url('assets/admin/pages/css/tasks.css'); ?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url('assets/global/css/components.css'); ?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/css/plugins.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/layout.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/themes/darkblue.css'); ?>" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url('assets/admin/layout/css/custom.css'); ?>" rel="stylesheet" type="text/css"/>

<link rel="shortcut icon" href="favicon.ico"/>
<style>
.sticky-layout .sidebar {
    position: fixed;  
    top: 0;
}
</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
<!-- BEGIN HEADER -->
	<?php echo $header; ?>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<?php echo $left; ?>
	<!-- BEGIN CONTENT -->
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
						<a href="<?php echo site_url('admin/transactions'); ?>"><?php echo $this->lang->line('menu_admin_transactions_label'); ?></a>
					</li>
				</ul>
				<div class="page-toolbar">
					&nbsp;
				</div>
			</div>			
			<h3 class="page-title">
			<?php echo $this->lang->line('menu_admin_transactions_label'); ?> <small>view histories of transaction</small>
			</h3>
			<!-- END PAGE HEADER-->
		
			<div class="row margin-top-20">
				<div class="col-md-12">

					<div class="profile-content">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet light">
									<div class="portlet-title tabbable-line">

									</div>
									<div class="portlet-body">
										<div class="row" id="messages"></div>
										<table class="table table-striped table-bordered table-hover" id="sample_1">
											<thead>
												<tr>
													<th style="text-align: center;">
														 <?php echo $this->lang->line('transaction_avatar_header_label'); ?>
													</th>
													<th style="text-align: center;">
														 <?php echo $this->lang->line('transaction_user_id_header_label'); ?>
													</th>
													<th style="text-align: center;">
														 <?php echo $this->lang->line('transaction_user_name_header_label'); ?>
													</th>
													<th style="text-align: center;">
														 <?php echo $this->lang->line('transaction_account_header_label'); ?>
													</th>
													<th style="text-align: center;">
														 <?php echo $this->lang->line('transaction_amount_header_label'); ?>
													</th>
													<th style="text-align: center;">
														 <?php echo $this->lang->line('transaction_coin_header_label'); ?>
													</th>
													<th style="text-align: center;">
														 <?php echo $this->lang->line('transaction_date_header_label'); ?>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if(count($transactions) > 0) {
														foreach($transactions as $transaction) {
												?>			
															<tr class="odd gradeX">
																<td align="center">
																	<img src="<?php echo $transaction['portrait']; ?>" style="width: 60px; height: 60px; border-radius: 40px !important;"/>
																</td>
																<td align="center">
																	<?php echo $transaction['user_id']; ?>
																</td>
																<td align="center">
																	<?php echo $transaction['username']; ?>
																</td>
																<td align="center">
																	<?php echo $transaction['kingmic_account']; ?>
																</td>
																<td align="right">
																	<?php echo number_format($transaction['amount'] / 100, 2); ?>
																</td>
																<td align="right">
																	<?php echo $transaction['amount_coin']; ?>
																</td>
																<td align="center">
																	<?php echo date('Y/m/d H:i:s', $transaction['created_at']); ?>
																</td>
															</tr>
												<?php
														}
													}

												?>
											</tbody>
										</table>	
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
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
 <div class="page-footer">
	<div class="page-footer-inner" style="text-align: center; !important">

	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div> 
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('assets/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]-->
<script src="<?php echo base_url('assets/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('assets/global/plugins/jquery-ui/jquery-ui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/flot/jquery.flot.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/flot/jquery.flot.resize.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/flot/jquery.flot.categories.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.pulsate.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/moment.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="<?php echo base_url('assets/global/plugins/fullcalendar/fullcalendar.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>


<script src="<?php echo base_url('assets/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/quick-sidebar.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout/scripts/demo.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/index.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/tasks.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/charts-amcharts.js'); ?>"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
	jQuery(document).ready(function() {    
		Metronic.init(); // init metronic core componets
		Layout.init(); // init layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
		//Index.init();   
		//Index.initDashboardDaterange();
   		initTable();

		$(window).scroll(function() {
			var offset = $('.page-sidebar').offset();
			var qmheight = $('.page-sidebar').height();
			var view = viewinfo();
			if(offset.top < $(document).scrollTop() + 10){
				ani_top = $(document).scrollTop() + 10;
				movflag = true;
			} //else if(offset.top + qmheight > $(document).scrollTop() + view.cy){
			else if(offset.top + qmheight + view.cy > $(document).scrollTop()){	
				ani_top = $(document).scrollTop() + 10;//$(document).scrollTop() + view.cy - qmheight - 280 - offset.top;
				movflag = true;
			}	

			if(movflag == true){
				// $('.page-sidebar')
				// 	.stop()
				// 	.animate({top: ani_top}, 'slow', 'linear');
				$('.page-sidebar').css('top', ani_top);
			}
		});    

	});

function viewinfo() {
	var e = document.documentElement || {},
		b = document.body || {},
		w = window;
	function min() {
		var v = Infinity;
		for( var i = 0;  i < arguments.length;  i++ ) {
			var n = arguments[i];
			if( n && n < v ) v = n;
		}
		return v;
	}
	return {
		x: w.pageXOffset || e.scrollLeft || b.scrollLeft || 0,
		y: w.pageYOffset || e.scrollTop || b.scrollTop || 0,
		cx: min( e.clientWidth, b.clientWidth, w.innerWidth ),
		cy: min( e.clientHeight, b.clientHeight, w.innerHeight )
	};
}

function initTable() {
    var table = $('#sample_1');

    // begin first table
    table.dataTable({

        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No data available in table",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "No entries found",
            "infoFiltered": "(filtered1 from _MAX_ total entries)",
            "lengthMenu": "Show _MENU_ entries",
            "search": "Search:",
            "zeroRecords": "No matching records found"
        },

        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "columns": [{
            "orderable": false
        }, {
            "orderable": true
        }, {
            "orderable": true
        }, {
            "orderable": true
        }, {
            "orderable": true
        }, {
            "orderable": true
        }, {
            "orderable": true
        }],
        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 5,            
        "pagingType": "bootstrap_full_number",
        "language": {
            "search": "Search: ",
            "lengthMenu": "  _MENU_ records",
            "paginate": {
                "previous":"Prev",
                "next": "Next",
                "last": "Last",
                "first": "First"
            }
        },
        "columnDefs": [{  // set default column settings
            'orderable': false,
            'targets': [0]
        }, {
            "searchable": false,
            "targets": [0]
        }],
        "order": [
            [6, "desc"]
        ] // set first column as a default sort by asc
    });

    var tableWrapper = jQuery('#sample_1_wrapper');

    table.find('.group-checkable').change(function () {
        var set = jQuery(this).attr("data-set");
        var checked = jQuery(this).is(":checked");
        jQuery(set).each(function () {
            if (checked) {
                $(this).attr("checked", true);
                $(this).parents('tr').addClass("active");
            } else {
                $(this).attr("checked", false);
                $(this).parents('tr').removeClass("active");
            }
        });
        jQuery.uniform.update(set);
    });

    table.on('change', 'tbody tr .checkboxes', function () {
        $(this).parents('tr').toggleClass("active");
    });

    tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown

}
   
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>