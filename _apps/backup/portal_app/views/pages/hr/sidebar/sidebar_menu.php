<ul id="main-menu" class="tab">
	<li class="">
		<a href="#" onClick="ajax_load('<?php echo site_url()?>dashboard');" style="cursor: pointer;">
			<i class="entypo-gauge"></i>
			<span>Dashboard</span>
		</a>
	</li>
	
	<?php 
	$level = $this->session->userdata('level_id');
		if($level == 7 || $level == 6){
	?>
	<li>
		<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarPerjabatan');" style="cursor: pointer;">
			<i class="fa fa-user-tie"></i>
			<span>Pelamar Perjabatan</span>
		</a>
	</li>
	<li>
		<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarSeleksiTeknis');" style="cursor: pointer;">
			<i class="fa fa-chalkboard-teacher"></i>
			<span>Interview Teknis</span>
		</a>
	</li>
	<li>
		<a href="#" onClick="ajax_load('<?php echo site_url()?>rekapMonitoring');" style="cursor: pointer;">
			<i class="fa fa-chalkboard-teacher"></i>
			<span>Rekap Monitoring</span>
		</a>
	</li>
	<li>
		<a href="#" onClick="ajax_load('<?php echo site_url()?>pesertaLolos');" style="cursor: pointer;">
			<i class="fa fa-chalkboard-teacher"></i>
			<span>Peserta Lolos</span>
		</a>
	</li>
	<li>
		<a href="#" onClick="ajax_load('<?php echo site_url()?>lowongan');" style="cursor: pointer;">
			<i class="fa fa-desktop"></i>
			<span>Lowongan</span>
		</a>
	</li>
	<li class="opened">
		<a>
			<i class="entypo-layout"></i>
			<span>Rekrutmen Manual <button class="btn btn-xs pull-right btn-warning">Baru</button></span>
		</a>
		<ul>
			<li>
				<a href="#" onClick="ajax_load('<?=site_url()?>mpelamarAll');" style="cursor: pointer;">
					<i class="entypo-dot-2"></i>
					<span>Rekap Pelamar</span>
				</a>
			</li>
			<li>
				<a href="#" onClick="ajax_load('<?=site_url()?>mpelamarAll');" style="cursor: pointer;">
					<i class="entypo-dot-2"></i>
					<span>Rekap Tahap MCU</span>
				</a>
			</li>
		</ul>
	</li>
	<?php } else { ?>

	<li>
		<a href="#">
			<i class="entypo-layout"></i>
			<span>Manajemen Data</span>
		</a>
		<ul>
			<li>
				<a href="#" onClick="ajax_load('<?php echo site_url()?>department');" style="cursor: pointer;">
					<i class="fa fa-briefcase"></i>
					<span>Departemen</span>
				</a>
			</li>
			<li>
				<a href="#" onClick="ajax_load('<?php echo site_url()?>jabatan');" style="cursor: pointer;">
					<i class="fa fa-suitcase"></i>
					<span>Jabatan</span>
				</a>
			</li>
			<li>
				<a href="#" onClick="ajax_load('<?php echo site_url()?>pengguna');" style="cursor: pointer;">
					<i class="fa fa-user-friends"></i>
					<span>Pengguna Web Karir</span>
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a target="_blank" href="http://web.binasaranasukses.com/hrmcu/">
			<i class="entypo-layout"></i>
			<span>Medical Check Up</span>
		</a>
	</li>
	<li>
		<a target="_blank" href="http://web.binasaranasukses.com/api/profiling/">
			<i class="entypo-layout"></i>
			<span>Master Data Profiling</span>
		</a>
	</li>
	<li class="">
		<a>
			<i class="entypo-layout"></i>
			<span>Rekrutmen Web</span>
		</a>
		<ul>
			<li>
				<a href="#">
					<i class="entypo-dot-2"></i>
					<span>Pelamar</span>
				</a>
				<ul>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarAll');" style="cursor: pointer;">
							<i class="fa fa-users"></i>
							<span>Semua Pelamar</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarPerjabatan');" style="cursor: pointer;">
							<i class="fa fa-user-tie"></i>
							<span>Pelamar Perjabatan</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarFreshgrad');" style="cursor: pointer;">
							<i class="fa fa-user-graduate"></i>
							<span>Lulusan Baru</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarQualify');" style="cursor: pointer;">
							<i class="fa fa-user-check"></i>
							<span>Kualifikasi</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarUnqualify');" style="cursor: pointer;">
							<i class="fa fa-user-times"></i>
							<span>Tidak Kualifikasi</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarFailed');" style="cursor: pointer;">
							<i class="fa fa-user-slash"></i>
							<span>Tidak Lolos</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>prapemilihan');" style="cursor: pointer;">
							<i class="fa fa-user-clock"></i>
							<span>Pra-pemilihan</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>final');" style="cursor: pointer;">
							<i class="fa fa-user-edit"></i>
							<span>Final</span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">
					<i class="entypo-dot-2"></i>
					<span>Kirim SMS</span>
				</a>
				<ul>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>kirimSmsHRD');" style="cursor: pointer;">
							<i class="fa fa-envelope"></i>
							<span> KSPM & HRD</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>kirimSmsTeknis');" style="cursor: pointer;">
							<i class="fa fa-envelope"></i>
							<span> Teknis</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>kirimSmsTeori');" style="cursor: pointer;">
							<i class="fa fa-envelope"></i>
							<span>Tes Teori</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>kirimSmsPraktek');" style="cursor: pointer;">
							<i class="fa fa-envelope"></i>
							<span>Tes Praktek</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>kirimSmsMCU');" style="cursor: pointer;">
							<i class="fa fa-envelope"></i>
							<span>Medical Check Up</span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">
					<i class="entypo-dot-2"></i>
					<span>Monitoring Interview</span>
				</a>
				<ul>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarSeleksiHrd');" style="cursor: pointer;">
							<i class="fa fa-chalkboard-teacher"></i>
							<span>Interview KSPM & HRD</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarSeleksiTeknis');" style="cursor: pointer;">
							<i class="fa fa-chalkboard-teacher"></i>
							<span>Interview Teknis</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarSeleksiTeori');" style="cursor: pointer;">
							<i class="fa fa-chalkboard-teacher"></i>
							<span>Tes Teori</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>pelamarSeleksiPraktek');" style="cursor: pointer;">
							<i class="fa fa-chalkboard-teacher"></i>
							<span>Tes Praktek</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>medical');" style="cursor: pointer;">
							<i class="fa fa-chalkboard-teacher"></i>
							<span>Tahap MCU</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>rekapMonitoring');" style="cursor: pointer;">
							<i class="fa fa-chalkboard-teacher"></i>
							<span>Rekap Monitoring</span>
						</a>
					</li>
					<li>
						<a href="#" onClick="ajax_load('<?php echo site_url()?>pesertaLolos');" style="cursor: pointer;">
							<i class="fa fa-chalkboard-teacher"></i>
							<span>Peserta Lolos</span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">
					<i class="entypo-dot-2"></i>
					<span>Master Rekrutmen</span>
				</a>
				<ul>
					<li>
						<a onClick="ajax_load('<?php echo site_url()?>masterSkill');" style="cursor: pointer;">
							<i class="fa fa-puzzle-piece"></i>
							<span>Master Skill</span>
						</a>
					</li>
					<li>
						<a onClick="ajax_load('<?php echo site_url()?>masterSyarat');" style="cursor: pointer;">
							<i class="fa fa-clipboard-check"></i>
							<span>Master Syarat</span>
						</a>
					</li>
					<li>
						<a onClick="ajax_load('<?php echo site_url()?>masterSertifikat');" style="cursor: pointer;">
							<i class="fa fa-certificate"></i>
							<span>Master Sertifikat</span>
						</a>
					</li>
					<li>
						<a onClick="ajax_load('<?php echo site_url()?>masterPic');" style="cursor: pointer;">
							<i class="fa fa-user-shield"></i>
							<span>Master PIC</span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#" onClick="ajax_load('<?php echo site_url()?>lowongan');" style="cursor: pointer;">
					<i class="entypo-dot-2"></i>
					<span>Lowongan</span>
				</a>
			</li>
		</ul>
	</li>
	<li class="">
		<a>
			<i class="entypo-layout"></i>
			<span>Rekrutmen Manual <button class="btn btn-xs pull-right btn-warning">Baru</button></span>
		</a>
		<ul>
			<li>
				<a href="#" onClick="ajax_load('<?=site_url()?>mpelamarAll');" style="cursor: pointer;">
					<i class="entypo-dot-2"></i>
					<span>Rekap Pelamar</span>
				</a>
			</li>
			<li>
				<a href="#" onClick="ajax_load('<?=site_url()?>mpelamarAll');" style="cursor: pointer;">
					<i class="entypo-dot-2"></i>
					<span>Rekap Tahap MCU</span>
				</a>
			</li>
			<!-- <li>
				<a href="#" onClick="ajax_load('<?=site_url()?>mpelamarAll');" style="cursor: pointer;">
					<i class="entypo-dot-2"></i>
					<span>Interview &amp; Tes</span>
				</a>
			</li>
			<li>
				<a href="#" onClick="ajax_load('<?=site_url()?>mpelamarAll');" style="cursor: pointer;">
					<i class="entypo-dot-2"></i>
					<span>Pelamar Blacklist</span>
				</a>
			</li> -->
		</ul>
	</li>

	<?php } ?>
</ul>



