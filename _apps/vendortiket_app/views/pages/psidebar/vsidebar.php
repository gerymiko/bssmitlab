<section class="sidebar">
	<ul class="sidebar-menu" data-widget="tree">
		<li class="bg-gray">
			<a href="<?=site_url();?>cpanel/syspanel">
				<i class="fas fa-dot-circle text-red"></i> <span> Dashboard</span>
			</a>
		</li>
		<li class="treeview active menu-open">
			<a href="#">
				<i class="fas fa-dot-circle text-blue"></i> <span> Permintaan Tiket</span>
				<span class="pull-right-container">
					<i class="fas fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li id="li-PsnTkt"><a id="hf-PsnTkt" href="<?=site_url();?>csubvendor/sysubvendor"><i class="far fa-circle f10"></i> Pesan Tiket</a></li>
				<li id="li-OpsTkt"><a id="hf-OpsTkt" href="<?=site_url();?>coptional/sysoptional/ticket_optional"><i class="far fa-circle f10"></i> Opsional Tiket</a></li>
				<li id="li-TktAgrd"><a id="hf-TktAgrd" href="<?=site_url();?>capproved/sysapproved/ticket_approved"><i class="far fa-circle f10"></i> Tiket Disetujui</a></li>
				<li id="li-TktOrd"><a id="hf-TktOrd" href="<?=site_url();?>cordered/sysordered/ticket_ordered"><i class="far fa-circle f10"></i> Tiket Terpesan</a></li>
			</ul>
		</li>
		<li id="li-inV">
			<a id="hf-inV" href="<?=site_url();?>cinvoice/sysinvoice">
				<i class="fas fa-dot-circle text-blue"></i> <span> Invoice</span>
			</a>
		</li>
		<li>
			<a href="#" class="text-gray">
				<i class="fas fa-dot-circle text-blue"></i> <span> Hak Akses</span>
			</a>
		</li>
	</ul>
</section>