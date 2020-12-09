<div class="navbar-inner">
	<!-- logo -->
	<div class="navbar-brand">
		<a href="#">
			<img src="<?=site_url();?>syslink/logo" width="50"  alt="PT BSS PORTAL" />
		</a>
	</div>
	<ul class="navbar-nav">
		<?php
			$level = $this->session->userdata('level_id');
			if($level == 7){
		?>
		<li class="opened active">
			<a href="<?php echo site_url()?>syspanel">
				<i class="entypo-home"></i>
				<span>Home</span>
			</a>
		</li>
		<li class="opened">
			<a href="<?php echo site_url()?>syshaer/dashboard">
				<i class="entypo-layout"></i>
				<span>Departemen Human Resource</span>
			</a>
			<!-- <ul>
				<li>
					<a href="<?php echo site_url()?>syshaer/dashboard">
						<span>Human Resource</span>
					</a>
				</li>
			</ul> -->
		</li>
		<?php } else { ?>

		<li class="opened active">
			<a href="<?php echo site_url()?>syspanel">
				<i class="entypo-home"></i>
				<span>Home</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url()?>zenmisc/miscdashboard">
				<i class="entypo-layout"></i>
				<span>Misc</span>
			</a>
		</li>
		<li class="opened">
			<a href="<?php echo site_url()?>syshaer/dashboard">
				<i class="entypo-layout"></i>
				<span>Departemen Human Resource</span>
			</a>
			<!-- <ul>
				<li>
					<a href="<?php echo site_url()?>syshaer/dashboard">
						<span>Human Resource</span>
					</a>
				</li>
			</ul> -->
		</li>

		<?php } ?>
		<!-- Search Bar -->
		<!-- <li id="search" class="search-input-collapsed"> -->
			<!-- add class "search-input-collapsed" to auto collapse search input -->
			<!-- <form method="get" action="">
				<input type="text" name="q" class="search-input" placeholder="Search something..."/>
				<button type="submit">
					<i class="entypo-search"></i>
				</button>
			</form>
		</li> -->
	</ul>

	<!-- notifications and other links -->
	<ul class="nav navbar-right pull-right">
		<!-- dropdowns -->
		<!-- <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="entypo-list"></i>
				<span class="badge badge-info">6</span>
			</a>
			<ul class="dropdown-menu">
				<li class="top">
					<p>You have 6 pending tasks</p>
				</li>
				<li>
					<ul class="dropdown-menu-list scroller">
						<li>
							<a href="#">
								<span class="task">
									<span class="desc">Procurement</span>
									<span class="percent">27%</span>
								</span>

								<span class="progress">
									<span style="width: 27%;" class="progress-bar progress-bar-success">
										<span class="sr-only">27% Complete</span>
									</span>
								</span>
							</a>
						</li>
					</ul>
				</li>

				<li class="external">
					<a href="#">See all tasks</a>
				</li>					
			</ul>
		</li> -->

		<!-- <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="entypo-mail"></i>
				<span class="badge badge-secondary">10</span>
			</a>
			<ul class="dropdown-menu">
				<li>
					<ul class="dropdown-menu-list scroller">
						<li class="active">
							<a href="#">
								<span class="image pull-right">
									<img src="" alt="" class="img-circle" />
								</span>

								<span class="line">
									<strong>Luc Chartier</strong>
									- yesterday
								</span>

								<span class="line desc small">
									This ain’t our first item, it is the best of the rest.
								</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="external">
					<a href="mailbox.html">All Messages</a>
				</li>					
			</ul>
		</li> -->

		<!-- <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="entypo-globe"></i>
				<span class="badge badge-warning">1</span>
			</a>
			<ul class="dropdown-menu">
				<li class="top">
					<p class="small">
						<a href="#" class="pull-right">Mark all Read</a>
						You have <strong>3</strong> new notifications.
					</p>
				</li>
				<li>
					<ul class="dropdown-menu-list scroller">
						<li class="unread notification-success">
							<a href="#">
								<i class="entypo-user-add pull-right"></i>

								<span class="line">
									<strong>New user registered</strong>
								</span>

								<span class="line small">
									30 seconds ago
								</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="external">
					<a href="#">View all notifications</a>
				</li>					
			</ul>
		</li> -->

		<!-- <li class="sep"></li> -->

		<li class="dropdown" style="background: #002F65;">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="fa fa-user-cog" style="margin: 5px 5px 5px 5px;"></i>
			</a>
			<ul class="dropdown-menu" style="width: 200px;">
				<li class="top">
					<p class="small">
						Hello, <strong><?=$detailuser->users_fullname;?></strong> and you are <b><?=ucfirst($detailuser->level_name);?></b>
					</p>
				</li>
				<li>
					<ul class="dropdown-menu-list scroller">
						<li class="notification-warning">
							<a href="#">
								<i class="fa fa-cogs pull-right"></i>

								<span class="line">
									<strong>Profil</strong>
								</span>

								<span class="line small">
									Pegaturan Akun
								</span>
							</a>
						</li>
						<li class="notification-success">
							<a href="<?php echo site_url();?>syspanel/logout">
								<i class="entypo-logout pull-right"></i>

								<span class="line">
									<strong>Logout</strong>
								</span>

								<span class="line small">
									Keluar dari website
								</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="external text-center red">
					<small><b>PT BINA SARANA SUKSES</b></small>
				</li>					
			</ul>
		</li>

		<!-- mobile only -->
		<li class="visible-xs">	
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="horizontal-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>
		</li>
	</ul>
</div>
<!-- <noscript>
	<div class="tile-block tile-purple" style="border-radius: 0;margin-bottom: 0;">				
		<div class="tile-content">
			<div style="padding-top: 10px"></div>
			<p class="text-center">JavaScript tidak diaktifkan. Mohon aktifkan javascript melalui pengaturan browser anda. <a target="_blank" href="http://web.binasaranasukses.com/karir/javascript"><b>Klik disini</b></a> untuk cara mengaktifkannya.</p>
		</div>
	</div>
</noscript> -->