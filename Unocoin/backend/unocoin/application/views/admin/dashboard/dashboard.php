<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>UNOCoin Admin | Dashboard</title>
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
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/fullcalendar/fullcalendar.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/plugins/jqvmap/jqvmap/jqvmap.css'); ?>" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="<?php echo base_url('assets/admin/pages/css/tasks.css'); ?>" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url('assets/global/css/components.css'); ?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/global/css/plugins.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/layout.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/admin/layout/css/themes/darkblue.css'); ?>" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url('assets/admin/layout/css/custom.css'); ?>" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
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
						<a href="<?php echo site_url('admin/dashboard'); ?>"><?php echo $this->lang->line('menu_admin_dashboard_label'); ?></a>
					</li>
				</ul>
				<div class="page-toolbar">
					&nbsp;
				</div>
			</div>			
			<h3 class="page-title">
			<?php echo $this->lang->line('menu_admin_dashboard_label'); ?> <small>recent news & logs</small>
			</h3>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			
			<div class="row">

																							
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
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
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
		Index.init();   
		Index.initDashboardDaterange();
   
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

   
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>