<section class="sidebar">
	<ul class="sidebar-menu" data-widget="tree" >
		<li class="bg-gray">
			<a href="<?=site_url();?>cpanel/syspanel">
				<i class="fas fa-dot-circle text-red"></i> <span> Dashboard</span>
			</a>
		</li>
		<li class="treeview active menu-open">
			<a href="#">
				<i class="fas fa-dot-circle text-blue"></i> <span>Pengajuan Tiket</span>
				<span class="pull-right-container">
					<i class="fas fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu" id="menutama">
				<li id="li-PVnDr"><a id="href-PVnDr" href="<?=site_url();?>csubmission/sysubmission/submission_vendor">- Data Pengajuan</a></li>
				<li id="li-OpsNVnDr"><a id="href-OpsNVnDr" href="<?=site_url();?>coption/sysoption/ticket_option">- Opsional Vendor</a></li>
				<li id="li-TkOrdr"><a id="href-TkOrdr" href="<?=site_url();?>cordered/sysordered/ticket_ordered">- Tiket Terpesan</a></li>
			</ul>
		</li>
		<li class="treeview active menu-open">
			<a href="#">
				<i class="fas fa-dot-circle text-blue"></i> <span>Pengajuan Dinas</span>
				<span class="pull-right-container">
					<i class="fas fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li id="li-SrcSch"><a id="href-SrcSch" href="<?=site_url();?>cschedule/syschedule">- Cari Jadwal</a></li>
			</ul>
		</li>
		<li id="li-dInv">
			<a id="href-dInv" href="<?=site_url();?>cinvoice/sysinvoice">
				<i class="fas fa-dot-circle text-blue"></i> <span> Daftar Invoice</span>
			</a>
		</li>
		<li class="treeview active menu-open">
			<a href="#">
				<i class="fas fa-dot-circle text-blue"></i> <span>Master</span>
				<span class="pull-right-container">
					<i class="fas fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li id="li-bPoHCti"><a id="href-bPoHCti" href="<?=site_url();?>cpoh/syspoh/akomodasi_cuti">- Akomodasi Cuti</a></li>
				<li id="li-bPoHDns"><a id="href-bPoHDns" href="<?=site_url();?>cpoh/syspoh/akomodasi_dinas">- Akomodasi Dinas</a></li>
				<li id="li-hAccs"><a id="href-hAccs" href="<?=site_url();?>caccess/sysaccess">- Hak Akses</a></li>
			</ul>
		</li>
	</ul>
</section>