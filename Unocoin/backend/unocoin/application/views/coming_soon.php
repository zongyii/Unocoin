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
	</head>
	<body>
		<!-- Page-->
		<div class="page">
			<?php //echo $header; ?>

			<!-- Page Content-->
			<main class="page-content">
				<section class="section-85">
					<div class="shell text-center">
						<div class="range range-xs-center">
							<div class="cell-xs-12">
								<h1><?php echo $this->lang->line('coming_soon_label'); ?></h1>
								<p><?php echo $message; ?></p>
							</div>
							<div class="cell-xs-12 cell-md-10 cell-lg-8 offset-top-10">
								<div class="countdown-wrap">
									<div data-type="until" data-date="<?php echo $count_down; ?>" data-format="wdhms" data-bg="rgba(67,67,67,.39)" class="DateCountdown DateCountdown-1"></div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</main>
		</div>
		
	</body>	

    <script src="<?php echo base_url('assets/frontend/js/core.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/script.js'); ?>"></script>
</html>								