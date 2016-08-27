<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">

		<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<li class="sidebar-toggler-wrapper">

				<div class="sidebar-toggler">
				</div>

			</li>

			<li class="start <?php if($category == 0) echo "active open"; ?> ">
				<a href="<?php echo site_url('admin/dashboard'); ?>">
					<i class="icon-home"></i>
					<span class="title"><?php echo $this->lang->line('menu_admin_dashboard_label'); ?></span>
					<span class="arrow <?php if($category == 0) echo "active open"; ?> "></span>
				</a>
			</li>	

			<li class="start <?php if($category == 1) echo "active open"; ?> ">
				<a href="<?php echo site_url('admin/transactions'); ?>">
					<i class="fa fa-history"></i>
					<span class="title"><?php echo $this->lang->line('menu_admin_transactions_label'); ?></span>
					<span class="arrow <?php if($category == 1) echo "active open"; ?> "></span>
				</a>
			</li>

			<li class="start <?php if($category == 2) echo "active open"; ?> ">
				<a href="<?php echo site_url('admin/settings'); ?>">
					<i class="fa fa-gears"></i>
					<span class="title"><?php echo $this->lang->line('menu_admin_settings_label'); ?></span>
					<span class="arrow <?php if($category == 2) echo "active open"; ?> "></span>
				</a>
			</li>

			<li class="start <?php if($category == 3) echo "active open"; ?> ">
				<a href="<?php echo site_url('admin/topup'); ?>">
					<i class="fa fa-money"></i>
					<span class="title"><?php echo $this->lang->line('menu_admin_top_up_label'); ?></span>
					<span class="arrow <?php if($category == 3) echo "active open"; ?> "></span>
				</a>
			</li>
		</ul>
	</div>
</div>
