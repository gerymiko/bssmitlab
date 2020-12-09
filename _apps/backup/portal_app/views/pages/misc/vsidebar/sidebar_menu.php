<ul id="main-menu" class="tab">
	<li class="">
		<a onClick="ajax_load_misc('<?php echo site_url()?>miscdashboard');" style="cursor: pointer;">
			<i class="entypo-gauge"></i>
			<span>Dashboard</span>
		</a>
	</li>
	<li class="opened">
		<a href="#">
			<i class="entypo-layout"></i>
			<span>Modul</span>
		</a>
		<ul>
			<li>
				<a onClick="ajax_load_misc('<?php echo site_url()?>administrator');" style="cursor: pointer;">
					<i class="entypo-dot"></i>
					<span>Admin Website</span>
				</a>
			</li>
			<li>
				<a onClick="ajax_load_misc('<?php echo site_url()?>leveluser');" style="cursor: pointer;">
					<i class="entypo-dot"></i>
					<span>Level User</span>
				</a>
			</li>
			<li>
				<a onClick="">
					<i class="entypo-dot"></i>
					<span>Hak Akses</span>
				</a>
			</li>
		</ul>
	</li>
</ul>