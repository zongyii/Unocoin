<!-- Page Header-->
<header class="page-head">
	<!-- RD Navbar-->
	<div class="rd-navbar-wrap">
		<nav data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-lg-stick-up-clone="true" data-md-stick-up-offset="157px" data-lg-stick-up-offset="157px" class="rd-navbar rd-navbar-default">
			<div class="rd-navbar-inner">
				<!-- RD Navbar Panel-->
				<div class="rd-navbar-panel">
					<!-- RD Navbar Toggle-->
					<button data-rd-navbar-toggle=".rd-navbar-nav-wrap" class="rd-navbar-toggle"><span></span></button>
					<!-- RD Navbar Brand--><a href="<?php echo site_url('dashboard'); ?>" class="rd-navbar-brand">
					<div class="brand-name"><span class="text-ubold text-river-bed">UNO&nbsp;</span><span class="text-thin">Coin</span></div></a>
				</div>	






				<div class="rd-navbar-aside">
					<div data-rd-navbar-toggle=".rd-navbar-aside" class="rd-navbar-aside-toggle"><img src="<?php echo $userinfo['portrait']; ?>" alt="" width="32" height="32" style="border-radius: 16px !important;"/></div>

					<div class="rd-navbar-aside-content">
						<ul class="block-wrap-list">
							<li class="block-wrap">
								<div class="unit unit-sm-horizontal unit-align-center unit-middle unit-spacing-sm">
									<div class="unit-left">
										<figure>
											<img src="<?php echo $userinfo['portrait']; ?>" alt="" width="64" height="64" style="border-radius: 64px !important;" />
										</figure>
									</div>
									<div class="unit-body">
										<address class="contact-info">
											<span class="text-bold" style="color: #44bef1;"><?php echo $userinfo['kingmic_account']; ?></span>
										</address>
									</div>
								</div>
							</li>
						</ul>
<!--						
						<div class="bg-athens-gray bg-wrap">
							<div class="block-container">
								<div class="block-left">
									<p class="rd-navbar-fixed--hidden small">Welcome to FinExpert, your expert in managing your finances!</p>
								</div>
								<div class="block-right">
									<ul class="list-inline">
										<li><a href="#" class="icon icon-xxs icon-circle icon-dark icon-alto-filled fa-facebook"></a></li>
										<li><a href="#" class="icon icon-xxs icon-circle icon-dark icon-alto-filled fa-twitter"></a></li>
										<li><a href="#" class="icon icon-xxs icon-circle icon-dark icon-alto-filled fa-google-plus"></a></li>
									</ul>
								</div>
							</div>
						</div>
-->						
					</div>		
				</div>


				<div class="rd-navbar-nav-wrap rd-navbar-nav-dark">
					<div class="rd-navbar-nav-wrap-inner">
						<!-- RD Navbar Nav-->
						<ul class="rd-navbar-nav">
							<li <?php if($category == 0) echo 'class="active"'; ?>><a href="<?php echo site_url('dashboard'); ?>"><?php echo $this->lang->line('menu_dashboard_label');?></a></li>
			              	<li <?php if($category == 1) echo 'class="active"'; ?>><a href="<?php echo site_url('recharge'); ?>"><?php echo $this->lang->line('menu_recharge_label');?></a></li>
			              	<li <?php if($category == 2) echo 'class="active"'; ?>><a href="<?php echo site_url('transactions'); ?>"><?php echo $this->lang->line('menu_transactions_label');?></a></li>
						</ul>
					</div>
				</div>	
			</div>
		</nav>
	</div>
</header>	