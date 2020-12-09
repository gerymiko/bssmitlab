<div id="content">
	<div class="container-fluid">
		<div class="heading-block topmargin">
			<p class="lead">Lengkapi data diri anda sekarang !</p>
			<div class="text-rotater" data-separator="|" data-rotate="bounceIn" data-speed="2500">
				<h1 class="thin">Segera unggah <b><span class="t-rotate color">Foto diri|KTP|SIM|Ijazah|Sertifikat|Pengalaman Kerja</span></b> Anda</h1>
			</div>
		</div>
	</div>
</div>

<?php 
	$cnotif = 'red infinite';
	if(isset($cijazah->plisence_file)){
	   $c_ijazah = $cijazah->plisence_file;
	}
	else{
	   $c_ijazah = NULL;
	}
?>

<div id="content">
	<div class="container-fluid">
		<div class="tabs tabs-bordered clearfix">
			<ul class="tab-nav clearfix" id="accountTabs">
				<li class="active"><a href="#tabs-1"><i class="icon-user norightmargin <?=$nPhoto = ($dperson->people_photo == 'default/300.png') ? $cnotif : '';?>"></i></a></li>
				<li><a href="#tabs-2" data-url="<?=site_url();?>account/cdashboard/sysaccount/tab2"><span id="mobileshow"><i class="fa fa-map-marker-alt"></i></span> <span class="desktop-view">Alamat</span></a></li>
				<li><a href="#tabs-3" data-url="<?=site_url();?>account/cdashboard/sysaccount/tab3"><span id="mobileshow"><i class="fa fa-user-graduate"></i></span> <span class="desktop-view">Pendidikan</span></a></li>
				<li><a href="#tabs-4" data-url="<?=site_url();?>account/cdashboard/sysaccount/tab4"><span id="mobileshow"><i class="fa fa-file-alt <?=$nijazah = ($c_ijazah == NULL) ? $cnotif : '';?>" ></i></span> <span class="desktop-view <?=$nijazah = ($c_ijazah == NULL) ? $cnotif : '';?>">Ijazah</span></a></li>
				<li><a href="#tabs-5" data-url="<?=site_url();?>account/cdashboard/sysaccount/tab5"><span id="mobileshow"><i class="far fa-address-card"></i></span> <span class="desktop-view">KTP &amp; SIM</span></a></li>
				<li><a href="#tabs-6" data-url="<?=site_url();?>account/cdashboard/sysaccount/tab6"><span id="mobileshow"><i class="fa fa-certificate"></i></span> <span class="desktop-view">Sertifikat</span></a></li>
				<li><a href="#tabs-7" data-url="<?=site_url();?>account/cdashboard/sysaccount/tab7"><span id="mobileshow"><i class="fa fa-file"></i></span> <span class="desktop-view">Pengalaman Kerja</span></a></li>
			</ul>
			<div class="tab-container">
				<div class="tab-content clearfix" id="tabs-1">
					<div class="feature-box media-box">
						<div class="fbox-desc">
							<h3>Personal
								<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#editBio">
									<span id="mobileshow"><i class="fa fa-pencil-alt"></i></span> <span class="desktop-view">Ubah</span>
								</button>
								<span class="subtitle">
									Data diri pelamar.
								</span>
							</h3><br />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2">
							<div class="shop clearfix ">
								<div class="product clearfix">
									<div class="product-image">
										<img src="<?=site_url('photo_profile');?>" class="img-responsive" width="100%">
										<div class="product-overlay">
											<a href="#" data-toggle="modal" data-target="#unggahFoto"><i class="icon-reply"></i><span> Ubah</span></a>
											<a href="<?=site_url('photo_profile');?>" class="item-quick-view" data-lightbox="image"><i class="icon-zoom-in2"></i><span> Lihat</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<?php
								$born  = new DateTime($dperson->people_birth_date);
								$today = new DateTime(date("Y-m-d"));
								$umur  = $born->diff($today);
							?>
							<p class="nobottommargin"><b><?=$dperson->registrant_kode;?></b></p>
							<small>Kode Registrasi</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=$dperson->people_firstname.' '.$dperson->people_middlename.' '.$dperson->people_lastname;?></b></p>
							<small>Nama Lengkap</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=$dperson->city_name.', '.date("d-m-Y", strtotime($dperson->people_birth_date));?></b></p>
							<small>Tempat &amp; Tanggal Lahir</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=($dperson->people_gender == "L") ? "Laki - laki":"Perempuan";?></b></p>
							<small>Jenis Kelamin</small>
							<div style="padding: 5px;"></div>
						</div>
						<?php
							$phone = ($dperson->people_phone == NULL) ? "-" : $dperson->people_phone;
						?>
						<div class="col-sm-3">
							<p class="nobottommargin"><b><?=$phone.' / '.$dperson->people_mobile;?></b></p>
							<small>Telepon / Seluler <i>(Handphone)</i></small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=($dperson->people_email !== NULL) ? $dperson->people_email : '-';?></b></p>
							<small>Email</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=ucfirst($dperson->people_religion);?></b></p>
							<small>Agama</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=$dperson->people_citizen;?></b></p>
							<small>Kewarganegaraan</small>
							<div style="padding: 5px;"></div>
						</div>
						<div class="col-sm-3">
							<p class="nobottommargin"><b><?=$umur->format('%y Tahun %m Bulan')?></b></p>
							<small>Usia</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=ucfirst($dperson->people_blood_type);?></b></p>
							<small>Golongan Darah</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=($dperson->people_height == NULL) ? "-" : $dperson->people_height;?> CM</b></p>
							<small>Tinggi Badan</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=($dperson->people_weight == NULL) ? "-" : $dperson->people_weight;?> KG</b></p>
							<small>Berat Badan</small>
							<div style="padding: 5px;"></div>
						</div>
					</div>

					<div class="divider"><i class="icon-circle"></i></div>

					<div class="feature-box media-box">
						<div class="fbox-desc">
							<h3>Keterampilan
								<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#addSkill">
									<span id="mobileshow"><i class="fa fa-plus"></i></span> <span class="desktop-view">Tambah</span>
								</button>
								<span class="subtitle">
									Tambahkan keterampilan Anda.
								</span>
							</h3><br />
						</div>

					</div>
						
					<div class="selector noradius">
						<div style="padding: 5px;">
							<input type="text" class="sm-form-control" name="cari_skill" id="cari_skill" placeholder="Cari . . ." >
						</div>
						<table id="tableSkill" class="table table-hover nobottommargin" style="border-bottom: 1px solid #ddd;">
							<thead>
								<th class="text-center">No</th>
								<th>Bidang</th>
								<th>Keahlian</th>
								<th><i class="fa fa-cog"></i></th>
							</thead>
						</table>
					</div>
				</div>

				<div class="tab-content clearfix" id="tabs-2"></div>

				<div class="tab-content clearfix" id="tabs-3"></div>

				<div class="tab-content clearfix" id="tabs-4">
					<div class="feature-box media-box">
						<div class="fbox-desc">
							<h3>Berkas Ijazah
								<?php 
								if(!isset($cijazah->plisence_type)){ ?>
									<button class="btn btn-sm btn-primary nomargin pull-right" data-toggle="modal" data-target="#addIjazah">Tambah</button>
								<?php } ?>
								<span class="subtitle" style="font-size: 13px;">
									Unggah berkas ijazah Anda dengan format <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran maksimal <b>5Mb</b>.
								</span>
							</h3><br />
						</div>
					</div>
					<table id="tableIjazah" class="table table-border table-stripped" width="100%">
						<thead>
							<th class="center">No</th>
							<th>Sekolah / Perguruan Tinggi / Universitas</th>
							<th>Status</th>
							<th class="center">Aksi</th>
						</thead>
					</table>
				</div>

				<div class="tab-content clearfix" id="tabs-5">
					<div class="feature-box media-box">
						<div class="fbox-desc">
							<h3>Berkas KTP &amp; SIM
								<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#addSIM">
									<span id="mobileshow"><i class="fa fa-plus"></i></span> <span class="desktop-view">Tambah</span>
								</button>
								<span class="subtitle" style="font-size: 13px;">
									Unggah berkas KTP dan SIM Anda dengan format <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran maksimal <b>5Mb</b>.
								</span>
							</h3><br />
						</div>
					</div>
					<div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;">
						<table id="tableLisence" class="table table-hover table-bordered nomargin" cellspacing="0" width="100%" style="border: 2px solid #DDDDDD;">
							<thead class="bg-darkgray">
								<th class="text-center">No</th>
								<th>Jenis Berkas</th>
								<th>Keterangan</th>
								<th>Status</th>
								<th class="text-center">Aksi</th>
							</thead>
						</table>
					</div>
					<span id="mobileshow"><i>* Geser untuk melihat tombol unggah/lihat berkas</i></span>
				</div>

				<div class="tab-content clearfix" id="tabs-6">
					<div class="feature-box media-box">
						<div class="fbox-desc">
							<h3>Berkas Sertifikat
								<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#addSertifikat">
									<span id="mobileshow"><i class="fa fa-plus"></i></span> <span class="desktop-view">Tambah</span>
								</button>
								<span class="subtitle" style="font-size: 13px;">
									Unggah berkas Sertifikat Anda dengan format <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran maksimal <b>5Mb</b>.
								</span>
							</h3><br />
						</div>
					</div>
				</div>

				<div class="tab-content clearfix" id="tabs-7">
					<div class="feature-box media-box">
						<div class="fbox-desc">
							<h3>Pengalaman Kerja 
								<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#addPengalaman">
									<span id="mobileshow"><i class="fa fa-plus"></i></span> <span class="desktop-view">Tambah</span>
								</button>
								<span class="subtitle" style="font-size: 13px;">
									Isi dan Unggah berkas Pengalaman Kerja Anda dengan format <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran maksimal <b>5Mb</b>.
								</span>
							</h3><br />
						</div>
						<?php if ( $count_people_job !== 0 ) { ?>
							<table id="tableJobhistory" class="nobottommargin" width="100%">
								<thead>
									<th>Keterangan</th>
								</thead>
							</table>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="unggahFoto" tabindex="-1" role="dialog" aria-labelledby="LabelFoto" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white" id="LabelFoto">Unggah Foto</h5>
				<button type="button" class="close" data-dismiss="modal" style="position: fixed;top: 15px;right: 20px;">×</button>
			</div>
			<form id="form-photo" action="<?=site_url();?>account/cdashboard/sysaccount/save_add_photo" enctype="multipart/form-data" class="nomargin">
				<div class="modal-body">
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">
						<div class="form-control" data-trigger="fileinput"><i class="fa fa-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
						<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="fa fa-paperclip"></i> Pilih Foto</span><span class="fileinput-exists"><i class="fa fa-redo"></i> Ubah</span><input type="file" name="file"></span>
						<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Hapus</a>
						<a href="#" id="upload-btn-photo" class="input-group-addon btn btn-success fileinput-exists"><i class="fa fa-paperclip"></i> Unggah</a>
					</div>
					<div class="form-group">
						<p class="nobottommargin">Ketentuan :</p>
						<ul>
							<ol>1. Mohon unggah file berformat <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran berkas maksimal <b>5Mb</b>.</ol>
							<ol>2. Unggah foto <b>FORMAL</b>.</ol>
							<ol>3. Wajah dalam foto harus terlihat jelas.</ol>
							<ol>4. Jika tidak memenuhi syarat yang telah disebutkan, kami tidak memproses lamaran Anda atau kami akan langsung tidak meloloskan berkas Anda.</ol>
						</ul>
					</div>
		            <div class="progress-photo" style="display:none;">
		            	<div id="progress-bar-photo" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
		            </div>					
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="unggahIjazah" style="overflow:hidden;" role="dialog" aria-labelledby="LabelIjazah" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white" id="LabelIjazah">Unggah Berkas Ijazah</h5>
				<button type="button" class="close" data-dismiss="modal" style="position: fixed;top: 15px;right: 20px;">×</button>
			</div>
			<form id="form-ijazah" method="post" enctype="multipart/form-data" class="nomargin">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Jenis Berkas</label>
								<input type="text" class="form-control input-sm" name="plisence_type_ijazah" value="IJAZAH" readonly="readonly">
							</div>
							<div class="form-group">
								<label>Dikeluarkan di Kota <b class="red">*</b></label><br>
								<select class="form-control js-select2 required" name="plisence_keluaran_ijazah">
									<option value="0">Pilih Kota</option>
			                        <?php
			                            foreach ($kota as $row) {
			                                echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
			                            }
			                        ?>
								</select>
								<div id="errorTerbitanIjazah"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Nomor Ijazah <b class="red">*</b></label>
								<input type="text" class="form-control input-sm required" id="noijazah" name="plisence_number_ijazah" maxlength="50">
							</div>
							<div class="form-group">
								<label>Tanggal dikeluarkan <b class="red">*</b></label>
								<input type="text" name="plisence_date_start_ijazah" class="datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="file" name="file_ijazah" id="file_ijazah" class="form-control input-sm required">
					</div>
					<div class="form-group">
						<p class="nobottommargin">Ketentuan :</p>
						<ul>
							<ol>1. Mohon unggah file berformat gambar <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran berkas maksimal <b>5Mb</b>.</ol>
							<ol>2. Mohon isi nomor ijazah Anda dengan benar.</ol>
							<ol>3. <b>Perhatikan</b> dengan benar file yang akan Anda unggah, karena jika terjadi kesalahan unggah atau salah berkas sistem tidak dapat memperbaharui file Anda.</ol>
							<ol>4. Kolom bertanda (*) wajib diisi.</ol>
						</ul>
					</div>
					<div class="progress-ijazah" style="display:none;">
		            	<div id="progress-bar-ijazah" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
		            </div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary btn-sm" type="button" id="upload-btn-ijazah" disabled="disabled">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addIjazah" style="overflow:hidden;" role="dialog" aria-labelledby="LabelIjazah" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white" id="LabelIjazah">Unggah Berkas Ijazah</h5>
				<button type="button" class="close" data-dismiss="modal" style="position: fixed;top: 15px;right: 20px;">×</button>
			</div>
			<form id="form-add-ijazah" method="post" enctype="multipart/form-data" class="nomargin">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Jenis Berkas</label>
								<input type="text" class="form-control input-sm required" name="plisence_type_add_ijazah" value="IJAZAH" readonly="readonly">
							</div>
							<div class="form-group">
								<label>Dikeluarkan di Kota <b class="red">*</b></label><br>
								<select class="form-control js-select2 required" name="plisence_keluaran_add_ijazah" value="310">
									<option value="0">Pilih Kota</option>
			                        <?php
			                            foreach ($kota as $row) {
			                                echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
			                            }
			                        ?>
								</select>
								<div id="errorTerbitanIjazah"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Nomor Ijazah <b class="red">*</b></label>
								<input type="text" class="form-control input-sm required" id="noijazah" value="NWZ-100.01/2018/VII" name="plisence_number_add_ijazah" maxlength="50">
							</div>
							<div class="form-group">
								<label>Tanggal dikeluarkan <b class="red">*</b></label>
								<input type="text" name="plisence_date_start_add_ijazah" value="20-11-2018" class="datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-form-label">Berkas Ijazah <b class="red">*</b></label>
						<input name="file_ijazah" id="file_add_ijazah" type="file" class="form-control input-sm required">
					</div>
					<div class="form-group">
						<p class="nobottommargin">Ketentuan :</p>
						<ul>
							<ol>1. Mohon unggah file berformat <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran berkas maksimal <b>5Mb</b>.</ol>
							<ol>2. Mohon isi nomor ijazah Anda dengan benar.</ol>
							<ol>3. <b>Perhatikan</b> dengan baik file yang akan Anda unggah, karena jika terjadi kesalahan unggah atau salah berkas sistem tidak dapat memperbaharui file Anda.</ol>
						</ul>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary btn-sm" type="button" id="btn-add-ijazah" disabled="disabled">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="unggahBerkas" tabindex="-1" role="dialog" aria-labelledby="LabelBerkas" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelBerkas">Unggah Berkas</h5>
				<button type="button" class="close" data-dismiss="modal" style="position: fixed;top: 15px;right: 20px;">×</button>
			</div>
			<form id="form-berkas" method="post" action="#" enctype="multipart/form-data" role="form" class="nomargin">
				<input type="hidden" name="plisence_id" id="plisence_id">
				<div class="modal-body">
					<div class="form-group">
						<label for="ptipe" class="col-form-label">Jenis Berkas</label>
						<input type="text" class="form-control input-sm required" name="plisence_type_lisence" id="ptipe" readonly="readonly">
					</div>
					<div class="form-group">
						<label>Unggah Berkas <b class="red">*</b></label>
						<input type="file" name="file_lisence" id="file_lisence" class="form-control input-sm required">
					</div>
					<div class="form-group">
						<p class="nobottommargin">Ketentuan :</p>
						<ul>
							<ol>1. Mohon unggah file berformat gambar <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran berkas maksimal <b>5Mb</b>.</ol>
							<ol>2. Perhatikan dengan baik file yang akan Anda unggah. Tidak dapat diubah ketika terjadi kesalahan file saat mengunggah.</ol>
						</ul>
					</div>
		            <div class="progress-berkas" style="display:none;">
		            	<div id="progress-bar-lisence" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
		            </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary" id="btn-lisence" disabled="disabled">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="unggahJob" tabindex="-1" role="dialog" aria-labelledby="LabelJob" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelJob">Unggah Berkas Pengalaman
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-job" method="post" action="#" enctype="multipart/form-data" role="form" class="nomargin">
				<input type="hidden" name="pjobhistory_id" id="pjobhistory_id_upload">
				<div class="modal-body">
					<div class="form-group">
						<label for="ptipe" class="col-form-label">Nama Perusahaan</label>
						<input type="text" class="form-control input-sm required" name="pjobhistory_company" id="company_upload" readonly="readonly">
					</div>
					<div class="form-group">
						<label>Unggah Berkas <b class="red">*</b></label>
						<input type="file" name="file_job" id="file_job" class="form-control input-sm required">
					</div>
					<div class="form-group">
						<p class="nobottommargin">Ketentuan :</p>
						<ul>
							<ol>1. Mohon unggah file berformat <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran berkas maksimal <b>5Mb</b>.</ol>
						</ul>
					</div>
		            <div class="progress-job" style="display:none;">
		            	<div id="progress-bar-job" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
		            </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" id="btn-job" class="btn btn-primary" disabled="disabled">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addInformal" tabindex="-1" role="dialog" aria-labelledby="LabelInformal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelInformal">Tambah Pelatihan / Sertifikasi
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-add-informal" method="post" role="form" class="nobottommargin">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-form-label">Nama Pelatihan <b class="red">*</b></label>
						<input type="text" name="informaledu_name" maxlength="100" class="alphanum form-control input-sm required" placeholder="Ketik disini . . ." />
					</div>
					<div class="form-group">
						<label class="col-form-label">Nama Tempat Penyelenggara <b class="red">*</b></label>
						<input type="text" name="informaledu_tempat" maxlength="100" class="alphanum form-control input-sm required" placeholder="Ketik disini . . ." />
					</div>
					<label>Masa Pelatihan</label>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Dari <b class="red">*</b></label>
								<input type="text" name="informaledu_dari" class="numdate datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Sampai <b class="red">*</b></label>
								<input type="text" name="informaledu_sampai" class="numdate datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
							</div>	
						</div>
					</div>
					<div class="form-group">
						<label class="col-form-label">Keterangan <b class="red">*</b></label>
						<textarea class="alphanum form-control required" rows="2" maxlength="100" name="informaledu_keterangan" placeholder="Ketik disini . . ."></textarea>
					</div>
					<i><small><b>Catatan</b> : Kolom bertanda (*) wajib diisi.</small></i>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" class="btn btn-primary" onclick="save_add_informal();">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addSkill" role="dialog" aria-labelledby="LabelSkill" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal60" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white uppercase" id="LabelSkill">Tambahkan keterampilan sesuai bidang
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-add-skill" method="post" role="form" class="nomargin">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<label>Pilih Jabatan</label><br />
							<select class="form-control required" name="KodeJB" id="list_jabatan" required="required">
								<option value="0">Pilih</option>
		                        <?php
		                            foreach ($list_jabatan as $row) {
		                                echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.'</option>';
		                            }
		                        ?>	
							</select>
						</div>
						<div class="col-sm-6"></div>
					</div>
					<div class="form-group">
						<br />
						<div id="skill"></div>
						<div id="loading-image" style="display: none;">
							<img src="<?=siteURL();?>bssmitlab/_assets/images/loading.gif" height="20">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="save_add_skill();" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addSIM" style="overflow:hidden;" role="dialog" aria-labelledby="LabelSIM" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelSIM">Tambah SIM ( Surat Ijin Mengemudi )
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-add-sim" method="post" action="#" enctype="multipart/form-data" role="form" class="nobottommargin">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Jenis SIM <b class="red">*</b></label>
								<select class="form-control input-sm required" name="plisence_type_sim" required="required">
									<option>Pilih</option>
									<?php
										$array1   = array('SIM A', 'SIM B1', 'SIM B2', 'SIM B2 UMUM', 'SIM C', 'SIM D' );
										$arraySIM = [];
									    foreach($plisence as $key => $value) {
									        $arraySIM = array_merge($arraySIM, $value);
									    }
										$result = array_diff($array1, $arraySIM);
										foreach ($result as $row) {
											echo '<option value="'.$row.'">'.$row.'</option>';
										}
									?>
								</select>
								<div id="errorTipe"></div>
							</div>
							<div class="form-group">
								<label>Dikeluarkan di Kota <b class="red">*</b></label><br>
								<select class="form-control" name="plisence_keluaran_sim" id="plisence_keluaran_sim" required="required">
									<option value="0">Pilih Kota</option>
			                        <?php
			                            foreach ($kota as $row) {
			                                echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
			                            }
			                        ?>	
								</select>
								<div id="errorTerbitan"></div>
							</div>
							<div class="form-group">
								<label>Berlaku S/d <b class="red">*</b></label>
								<input type="text" name="plisence_date_end_sim" value="21-12-2018" class="datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
	                            <div id="errorBDate"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Nomor SIM <b class="red">*</b></label>
								<input type="text" name="plisence_number_sim" value="777612688801" class="num form-control input-sm required" maxlength="20">
							</div>
							<div class="form-group">
								<label>Tanggal dikeluarkan <b class="red">*</b></label>
								<input type="text" name="plisence_date_start_sim" value="21-12-2018" class="datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
	                            <div id="errorBDate"></div>
							</div>
							<div class="form-group">
								<label>Unggah Berkas <b class="red">*</b></label>
								<input type="file" name="file_add_sim" class="form-control input-sm">
								<label id="errorAddSIM"></label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<p class="nobottommargin">Ketentuan :</p>
						<ul>
							<ol>1. Mohon unggah file berformat <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran berkas maksimal <b>5Mb</b>.
							<ol>2. Perhatikan dengan baik file yang akan Anda unggah. Tidak dapat diubah ketika terjadi kesalahan file saat mengunggah.</ol>
							<ol>3. Kolom bertanda (*) wajib diisi.</ol>
						</ul>
					</div>
					<div class="progress-sim" style="display:none;">
		            	<div id="progress-bar-sim" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
		            </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary" id="btn-add-sim">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addSertifikat" style="overflow:hidden;" role="dialog" aria-labelledby="LabelSertifikat" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelSertifikat">Tambah Sertifikat
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form enctype="multipart/form-data" id="form-add-cert" method="post" action="" role="form" class="nobottommargin">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-form-label">Nama Sertifikat <b class="red">*</b></label>
						<input type="text" name="pcertificate_name" class="form-control required" id="certificate_name" placeholder="Ketik disini bila tidak terdaftar . . ." />
					</div>
					<div class="form-group">
						<label>Masa Berlaku <b class="red">*</b></label><br>
						<select class="form-control required" name="pcertificate_type" id="pcertificate_type">
							<option value="0">Pilih</option>
	                        <option value="1">Jangka Panjang</option>
	                        <option value="2">Periodik</option>
						</select>
						<div id="errorCertMasa"></div>
					</div>
					<div class="form-group" style="display: none;" id="pcertificate_validity">
						<label>Berlaku S/d <b class="red">*</b></label>
						<input type="text" id="pvalidity" name="pcertificate_validity" class="datepicker form-control input-sm" placeholder="DD-MM-YYYY" autocomplete="off"/>
                        <br>
					</div>

					<div class="form-group">
						<label>Unggah Berkas <b class="red">*</b></label>
						<input type="file" name="plisence_file" class="form-control input-sm required">
						<i>* Mohon unggah file berformat <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran berkas maksimal <b>5Mb</b>.</i>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addPengalaman" tabindex="-1" role="dialog" aria-labelledby="LabelPengalaman" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelPengalaman">Tambah Pengalaman Kerja
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-add-job" method="post" enctype="multipart/form-data" action="#" role="form" class="nobottommargin">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Nama Perusahaan <b class="red">*</b></label>
								<input type="text" name="pjobhistory_company_add" maxlength="100" class="alpha form-control input-sm required" placeholder="Ketik disini . . ." />
							</div>
							<div class="form-group">
								<label class="col-form-label">Jabatan Awal <b class="red">*</b></label>
								<input type="text" name="pjobhistory_jabatan_awal_add" maxlength="100" class="alpha form-control input-sm required" placeholder="Ketik disini . . ." />
							</div>
							<div class="form-group">
								<label class="col-form-label">Dari <b class="red">*</b></label>
								<input type="text" name="pjobhistory_thn_start_add" class="numdate datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
							</div>
							<div class="form-group">
								<label class="col-form-label">Gaji Akhir <b class="red">*</b></label>
								<input type="text" name="pjobhistory_gaji_akhir_add" class="num form-control input-sm required" placeholder="Ketik disini . . ." />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Bidang Perusahaan <b class="red">*</b></label>
								<input type="text" name="pjobhistory_bidang_add" maxlength="100" class="alpha form-control input-sm required" placeholder="Ketik disini . . ." />
							</div>
							<div class="form-group">
								<label class="col-form-label">Jabatan Akhir <b class="red">*</b></label>
								<input type="text" name="pjobhistory_jabatan_akhir_add" maxlength="100" class="alpha form-control input-sm required" placeholder="Ketik disini . . ." />
							</div>
							<div class="form-group">
								<label class="col-form-label">Sampai <b class="red">*</b></label>
								<input type="text" name="pjobhistory_thn_end_add" class="numdate datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
							</div>
							<div class="form-group">
								<label class="col-form-label">Alasan Keluar <b class="red">*</b></label>
								<textarea name="pjobhistory_reason_add" class="alpha form-control required" maxlength="150" rows="2"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Unggah Berkas <b class="red">*</b></label>
						<input type="file" name="file_job_upload" id="file_job_upload" class="form-control input-sm required">
						<i>* Mohon unggah file berformat <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran berkas maksimal <b>5Mb</b>.</i>
					</div>
					<i><small><b>Catatan</b> : Kolom bertanda (*) wajib diisi.</small></i>

					<div class="progress-job-add" style="display:none;">
		            	<div id="progress-bar-job-add" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
		            </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" id="btn-job-upload" disabled="disabled" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editBio" tabindex="-1" role="dialog" aria-labelledby="LabelBio" aria-hidden="true">
	<div class="modal-dialog modal60" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelBio">Ubah Biodata
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-edit-bio" method="post" name="form-edit-bio" role="form" class="nobottommargin">
				<input type="hidden" name="people_id" value="<?=$dperson->people_id;?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Nama Depan <b class="red">*</b></label>
								<input type="text" name="people_firstname" class="alpha form-control input-sm required" maxlength="50" value="<?=$dperson->people_firstname;?>"/>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Nama Tengah</label>
								<input type="text" name="people_middlename" class="alpha form-control input-sm" maxlength="50" value="<?=($dperson->people_middlename !== NULL) ? $dperson->people_middlename : '';?>" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-form-label">Nama Belakang</label>
								<input type="text" name="people_lastname" class="alpha form-control input-sm" maxlength="100" value="<?=($dperson->people_lastname !== NULL) ? $dperson->people_lastname : '';?>"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Kota Kelahiran <b class="red">*</b></label><br>
								<select class="form-control required" name="people_birth_place" id="people_birth_place">
									<option value="0">Pilih Kota</option>
			                        <?php
			                            foreach ($kota as $row) {
			                                echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
			                            }
			                        ?>	
								</select>
								<i><small>Jika kota kelahiran tidak terdaftar, mohon pilih kota terdekat dari kota kelahiran. Atau hubungi admin kami.</small></i>
								<div id="errorBorn"></div>
							</div>
							<div class="form-group">
								<label class="col-form-label">Jenis Kelamin <b class="red">*</b></label>
								<select class="form-control required input-sm" name="people_gender">
									<option selected="selected" class="bgcolor white" value="<?=($dperson->people_gender !== NULL) ? ucfirst($dperson->people_gender) : '';?>"><?=($dperson->people_gender !== NULL) ? ucfirst($dperson->people_gender) : '';?> (Selected)</option>
									<option value="L">Laki - laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label class="col-form-label">Nomor Telepon <i>(Rumah)</i></label>
								<input type="text" name="people_phone" class="num form-control input-sm" maxlength="15" value="<?=($dperson->people_phone !== NULL) ? $dperson->people_phone : '';?>" />
							</div>
							<div class="form-group">
								<label class="col-form-label">Kewarganegaraan <b class="red">*</b></label>
								<select class="form-control required input-sm" name="people_citizen">
									<option selected="selected" class="bgcolor white" value="<?=($dperson->people_citizen !== NULL) ? ucfirst($dperson->people_citizen) : '';?>"><?=($dperson->people_citizen !== NULL) ? ucfirst($dperson->people_citizen) : '';?> (Selected)</option>
									<option value="WNI">WNI</option>
									<option value="WNA">WNA</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<?php $dateborn = date("d-m-Y", strtotime($dperson->people_birth_date));?>
								<label class="col-form-label">Tanggal Lahir <b class="red">*</b></label>
								<div class="input-group">
									<input type="text" name="people_birth_date" class="numdate datepicker form-control input-sm required" maxlength="10" value="<?=($dateborn !== NULL) ? $dateborn : '-';?>"/>
									<div class="input-group-btn">                   
			                            <a class="btn btn-icn btn-default btn-sm">
			                                <i class="icon-calendar f10"></i>
			                            </a>
			                        </div>
								</div>
							</div>
							<div class="desktop-view" style="padding: 18px;"></div>
							<div class="form-group">
								<label class="col-form-label">Agama <b class="red">*</b></label>
								<select class="form-control required input-sm" name="people_religion">
									<option selected="selected" class="bgcolor white" value="<?=($dperson->people_religion !== NULL) ? ucfirst($dperson->people_religion) : '';?>"><?=($dperson->people_religion !== NULL) ? ucfirst($dperson->people_religion) : '';?> (Selected)</option>
									<option value="islam">Islam</option>
									<option value="kristen">Kristen</option>
									<option value="katolik">Katolik</option>
									<option value="hindu">Hindu</option>
									<option value="budha">Budha</option>
									<option value="konghuchu">Konghuchu</option>
									<option value="lainnya">Lainnya</option>
								</select>
							</div>
							<div class="form-group">
								<label class="col-form-label">Nomor Seluler / <i>Handphone</i> <b class="red">*</b></label>
								<input type="text" name="people_mobile" class="num form-control input-sm required" maxlength="15" value="<?=($dperson->people_mobile !== NULL) ? $dperson->people_mobile : '-';?>" />
							</div>
							<div class="form-group">
								<label class="col-form-label">Golongan Darah <b class="red">*</b></label>
								<select class="form-control required input-sm" name="people_blood_type">
									<option selected="selected" class="bgcolor white" value="<?=($dperson->people_blood_type !== NULL) ? ucfirst($dperson->people_blood_type) : '';?>"><?=($dperson->people_blood_type !== NULL) ? ucfirst($dperson->people_blood_type) : '';?> (Selected)</option>
									<option>A</option>
									<option>B</option>
									<option>O</option>
									<option>AB</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label class="col-form-label">Tinggi Badan <b class="red">*</b></label>
							<div class="input-group">
								<input type="text" name="people_height" class="num form-control input-sm required" maxlength="3" value="<?=($dperson->people_height !== NULL) ? $dperson->people_height : '-';?>" />
								<div class="input-group-btn">                   
		                            <a class="btn btn-icn btn-default btn-sm">
		                                Cm
		                            </a>
		                        </div>
							</div>
						</div>
						<div class="col-sm-6">
							<label class="col-form-label">Berat Badan <b class="red">*</b></label>
							<div class="input-group">
								<input type="text" name="people_weight" class="num form-control input-sm required" maxlength="3" value="<?=($dperson->people_weight !== NULL) ? $dperson->people_weight : '-';?>"/>
								<div class="input-group-btn">                   
		                            <a class="btn btn-icn btn-default btn-sm">
		                                Kg
		                            </a>
		                        </div>
							</div>
						</div>
					</div>
					<br />
					<i><small><b>Catatan</b> : Kolom bertanda (*) wajib diisi.</small></i>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="save_edit_bio();" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editJob" tabindex="-1" role="dialog" aria-labelledby="LabelJob" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelJob">Ubah Pengalaman Kerja
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-edit-job" method="post" name="form-edit-job" role="form" class="nobottommargin">
				<input type="hidden" name="pjobhistory_id" id="id">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Nama Perusahaan <b class="red">*</b></label>
								<input type="text" name="pjobhistory_company" id="company" class="form-control input-sm required" maxlength="100" />
							</div>
							<div class="form-group">
								<label class="col-form-label">Jabatan Awal <b class="red">*</b></label>
								<input type="text" name="pjobhistory_jabatan_awal" id="jabatan_awal" class="form-control input-sm required" maxlength="50" />
							</div>
							<div class="form-group">
								<label class="col-form-label">Dari <b class="red">*</b></label>
								<input type="text" name="pjobhistory_thn_start" id="thn_start" class="datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
							</div>
							<div class="form-group">
								<label class="col-form-label">Gaji Akhir <b class="red">*</b></label>
								<input type="text" name="pjobhistory_gaji_akhir" id="gaji" class="num form-control input-sm required" />
								<i>* Hanya Angka</i>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Bidang Perusahaan <b class="red">*</b></label>
								<input type="text" name="pjobhistory_bidang" id="bidang" class="form-control input-sm required" maxlength="50" />
							</div>
							<div class="form-group">
								<label class="col-form-label">Jabatan Akhir <b class="red">*</b></label>
								<input type="text" name="pjobhistory_jabatan_akhir" id="jabatan_akhir" class="form-control input-sm required" maxlength="50" />
							</div>
							<div class="form-group">
								<label class="col-form-label">Sampai <b class="red">*</b></label>
								<input type="text" name="pjobhistory_thn_end" id="thn_end" class="datepicker form-control input-sm required" autocomplete="off"/>
							</div>
							<div class="form-group">
								<label class="col-form-label">Alasan Keluar <b class="red">*</b></label>
								<textarea class="form-control required" rows="2" name="pjobhistory_reason" id="reason" maxlength="100"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="save_edit_job();" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="showIjazah" tabindex="-1" role="dialog" aria-labelledby="LabelIjazah" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelIjazah">Lihat Berkas
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<div class="modal-body">
				<img class="img-responsive" src="<?=site_url();?>edu/show_ijazah" style="padding-bottom: 5px;">
				<i>* Reload halaman jika file masih tidak ada setelah unggah berkas.</i>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="showLisence" tabindex="-1" role="dialog" aria-labelledby="LabelLisence" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelLisence">Lihat Berkas
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<div class="modal-body">
				<img class="showimage img-responsive" width="100%" src="" style="padding-bottom: 5px;">
				<i>* Reload halaman jika file masih tidak ada setelah unggah berkas.</i>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="showJobfile" tabindex="-1" role="dialog" aria-labelledby="LabelJobfile" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelJobfile"></h5>
				<button type="button" class="close" data-dismiss="modal" style="position: fixed;top: 15px;right: 20px;">×</button>
			</div>
			<div class="modal-body">
				<img class="showjobfile img-responsive" width="100%" src="" style="padding-bottom: 5px;">
				<i>* Reload halaman jika file masih tidak ada setelah unggah berkas.
				</i>
			</div>
		</div>
	</div>
</div>


<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/global/select2/select2.min.css">
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/global/select2/select2.min.js"></script>

<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/rekrutmen/css/components/radio-checkbox.css" type="text/css" />
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/global/alphanum/jquery.alphanum.js"></script>

<style type="text/css">
	.dataTables_filter{ display:none; }
	.dataTables_paginate{ text-align: right; padding-right: 5px; }
	.pagination > li > a, .pagination > li > span { padding: 3px 10px !important; }
	.btn.disabled { pointer-events: none; }
	.select2 { width: 100% !important; }
	tr.group,
	tr.group:hover {
	    background-color: #fff !important;
	    font-weight: bold;
	    text-transform: uppercase;
	    border-bottom: 1px solid #ddd; 
	}
	.ui-autocomplete {
		position: absolute;
		cursor: pointer;
		z-index: 9999;
	}
	#ui-id-1 {
		list-style: none;
		background-color: #F5F5F5;
		padding: 5px;
		border: 1px solid #ddd; 
		border-radius: 5px;
	}
	#ui-id-1 > li:hover { 
	    background-color: #FFF;
	    border-radius: 5px;
	    padding: 5px;
	}
</style>

<?php 
	$pesan = $this->session->flashdata('pesan');
	if(isset($pesan)){ ?>
	<script>
		$(document).ready(function(){
			swal({  
				type: "<?=$pesan['type'];?>", 
				title: "<?=$pesan["title"];?>",   
				text: "<?=$pesan["message"];?>",
				timer: 4000,
			});
		});    
	</script>
<?php } ?>

<script>
	$('#accountTabs a').click(function (e) {
		e.preventDefault();
	  
			var url  = $(this).attr("data-url");
			var href = this.hash;
			var pane = $(this);
		
		$(href).load(url,function(result){      
		    pane.tab('show');
		});
	});

	$('#tabs-1').load($('.active a').attr("data-url"), function(result){
		$('.active a').tab('show');
	});

	$(document).ready(function() {

		var url_lang = "<?=site_url();?>s_url/dt_language";

		var table1 = $('#tableLisence').DataTable( {
    		"bInfo": false,
    		"bPaginate": false,
    		"bFilter": false,
    		"bLengthChange": false,
    		"ordering": false,
    		"processing" : true,
			"serverSide" : true,
    		"ajax" : {
				"url"  : '<?=site_url()?>table_lisence',
				"type" : 'POST',
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
		    },
		    "language": {
				"url": url_lang,
			},
		    "columnDefs": [
	            {
	                "targets": [ 0 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	                "width": "4%",
	            },
	            {
	                "targets": [ 1 ],
	                "className": "text-center",
	                "orderable": false,
	                "width": "25%",
	            },
	            {
	                "targets": [ 2 ],
	                "className": "left-center",
	                "orderable": false,
	                "width": "25%",
	            },
	            {
	                "targets": [ 3 ],
	                "className": "text-center",
	                "orderable": false,
	                "width": "25%",
	            },
	            {
	                "targets": [ 4 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	            },
	        ],
	        "createdRow": function( row, data, dataIndex){
                if( data[3] ==  `Belum diunggah`){
                    $(row).addClass('bg-red');
                }
            },
    	});

    	var groupColumn = 1;
    	var table2 = $('#tableSkill').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"bInfo": false,
			"bLengthChange": false,
			"pageLength": 5,
			"order": [[ groupColumn, 'asc' ]],
			"ajax" : {
				"url"  : '<?=site_url()?>table_skill',
				"type" : 'POST',
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
		    },
		    "language": { "url": url_lang, },
		    "columnDefs": [
	            { "visible": false, "targets": groupColumn },
	            {
	                "targets": [ 0 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	                "width": "10%",
	            },
	            {
	                "targets": [ 2 ],
	                "className": "text-left",
	                "orderable": false,
	            },
	            {
	                "targets": [ 3 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	                "width": "15%",
	            },
	        ],
	        "drawCallback": function ( settings ) {
				var api  = this.api();
				var rows = api.rows( {page:'current'} ).nodes();
				var last = null;
	 
	            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
	                if ( last !== group ) {
	                    $(rows).eq( i ).before(
	                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
	                    );
	                    last = group;
	                }
	            });

	            $("#tableSkill thead").remove();
	        },
		});
	    $('#tableSkill tbody').on( 'click', 'tr.group', function () {
	        var currentOrder = table2.order()[0];
	        if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
	            table2.order( [ groupColumn, 'desc' ] ).draw();
	        }
	        else {
	            table2.order( [ groupColumn, 'asc' ] ).draw();
	        }
	    });
	    $('#cari_skill').keyup(function(){
		    table2.search($(this).val()).draw() ;
		});

		var table4 = $('#tableIjazah').DataTable( {
			"bLengthChange": false,
			"processing": true,
			"serverSide": true,
			"bPaginate": false,
			"ordering": false,
			"bFilter": false,
    		"bInfo": false,
    		"ajax": {
				"url"  : '<?=site_url()?>table_ijazah',
				"type" : 'POST',
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
		    },
		    "language": {
				"url": url_lang,
			},
			"columnDefs": [
	            {
	                "targets": [ 0 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	                "width": "4%",
	            },
	            {
	                "targets": [ 3 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	                "width": "10%",
	            },
	        ],
    	});

    	var table6 = $('#tableJobhistory').DataTable( {
    		"bInfo": false,
    		"bFilter": false,
    		"bLengthChange": false,
    		"ordering": false,
    		"processing": true,
			"serverSide": true,
			"pageLength": 5,
    		"ajax" : {
				"url"  : '<?=site_url()?>table_job',
				"type" : 'POST',
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
		    },
		    "language": {
				"url": url_lang,
			},
			"drawCallback": function ( settings ) {
				$("#tableJobhistory thead").remove();
			}
    	});

		$('.datepicker').datepicker({
			autoclose: true,
			format: "dd-mm-yyyy",
			todayHighlight: true,
			startView: 2,
			daysOfWeekHighlighted: "0"
		});

		$('#form-foto').validate();
		$('#form-berkas').validate();
		$('#form-add-cert').validate();
		$('#form-ijazah').validate();
		$('#form-add-job').validate();
		$('#form-add-sim').validate();

	    jQuery.extend(jQuery.validator.messages, {
		    required: "Kolom ini wajib diisi.",
		    remote: "Silakan perbaiki kolom ini.",
		    email: "Format email salah.",
		    url: "Format URL salah.",
		    date: "Harap masukkan tanggal yang benar.",
		    number: "Harap masukkan nomor yang benar.",
		    digits: "Harap masukkan hanya angka.",
		    equalTo: "Silahkan masukkan nilai yang sama lagi.",
		    accept: "Harap masukkan nilai dengan ekstensi yang benar.",
		    maxlength: jQuery.validator.format("Harap masukkan tidak lebih dari {0} karakter."),
		    minlength: jQuery.validator.format("Harap masukkan setidaknya {0} karakter."),
		    rangelength: jQuery.validator.format("Masukkan nilai antara {0} dan {1} karakter."),
		    range: jQuery.validator.format("Harap masukkan nilai antara {0} dan {1}."),
		    max: jQuery.validator.format("Harap masukkan nilai kurang dari atau sama dengan {0}."),
		    min: jQuery.validator.format("Harap masukkan nilai yang lebih besar dari atau sama dengan {0}.")
		});

	    //harus dirubah controllernya
		$("#certificate_name").autocomplete({
        	source: "<?=site_url('account/cdashboard/sysaccount/get_certificate/?');?>"
        });

		$('#unggahBerkas').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button    = $(event.relatedTarget) 
				var fid       = button.data('id')
				var ftipe     = button.data('tipe')
				var modal     = $(this)
				modal.find('.modal-title white').text('Unggah Berkas ' + ftipe)
				modal.find('#plisence_id').val(fid)
				modal.find('#ptipe').val(ftipe)
			}
		});

		$('#unggahJob').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button   = $(event.relatedTarget) 
				var id      = button.data('id')
				var company = button.data('company')
				var modal    = $(this)
				modal.find('#pjobhistory_id_upload').val(id)
				modal.find('#company_upload').val(company)
			}
		});

		$('#showLisence').on('show.bs.modal', function (event) {
        	var button = $(event.relatedTarget)
			var image  = button.data('src')
			var modal  = $(this)
            modal.find(".showimage").attr("src", image);
        });

        $('#showJobfile').on('show.bs.modal', function (event) {
			var button  = $(event.relatedTarget)
			var jobfile = button.data('src')
			var name    = button.data('name')
			var modal   = $(this)
			modal.find('.modal-title white').text('Lihat Berkas ' + name)
            modal.find(".showjobfile").attr("src", jobfile);
        });

        $('#editJob').on('show.bs.modal', function (event) {
        	if (event.namespace == 'bs.modal') {
				var button        = $(event.relatedTarget) 
				var id            = button.data('id')
				var company       = button.data('company')
				var jabatan_awal  = button.data('jabatan_awal')
				var jabatan_akhir = button.data('jabatan_akhir')
				var thn_start     = button.data('thn_start')
				var thn_end       = button.data('thn_end')
				var bidang        = button.data('bidang')
				var gaji          = button.data('gaji')
				var reason        = button.data('reason')
				var modal         = $(this)
				modal.find('#id').val(id)
				modal.find('#company').val(company)
				modal.find('#jabatan_awal').val(jabatan_awal)
				modal.find('#jabatan_akhir').val(jabatan_akhir)
				modal.find('#thn_start').val(thn_start)
				modal.find('#thn_end').val(thn_end)
				modal.find('#bidang').val(bidang)
				modal.find('#gaji').val(gaji)
				modal.find('#reason').val(reason)
			}
		});
	});
	
	$('#people_birth_place').val(<?=($dperson->people_birth_place !== NULL) ? $dperson->people_birth_place : 0;?>).trigger('change');
	
	$('#people_birth_place').select2({dropdownParent: $('#editBio')});
	$('#list_jabatan').select2();
	
	$('#plisence_keluaran_sim').select2();
	$('.js-select2').select2();
	
	$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});
	$('.numdate').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false});
	$('.alpha').alphanum({allowNumeric: false});
	$('.alphanum').alphanum({ allow: '-/()_ .', });
	$('#noijazah').alphanum({ allow: '-/()_ .', });

	var select = document.getElementById("pcertificate_type");
	select.onchange = function() {
	    if(select.value == "2") {
	       document.getElementById("pcertificate_validity").style.display = "inline";
	    } else {
	       document.getElementById("pcertificate_validity").style.display = "none";
	    }
	}

	$('#list_jabatan').on('select2:select', function(e) {
		var opt = 'skill=' + $(this).val();
		$.ajax({
			type: "POST",
			url: "<?=site_url()?>account/cdashboard/sysxpertise/get_skill",
			data: opt,
			beforeSend: function() {
				$("#loading-image").show();
			},
			success:function(data){
				$("#skill").html(data);
				$("#loading-image").hide();
			}
		});
	});

	function save_edit_bio(){
		var databio = $("#form-edit-bio").serialize();
		if($("#form-edit-bio").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>save_edit_bio",
			databio,
			function(data){
				if(data){
					$('#editBio').modal('hide');
					swal({
						title: "Naiss!", 
						text: "Data berhasil diperbaharui", 
						type: "success"}).then(function(){ 
							location.reload();
						}
					);
				} else {
					$('#editBio').modal('hide');
					swal("Oops!", "Gagal diproses. Coba lagi", "error");
				}
			});	
		}
	}

	function save_add_skill(){
	 	var paramstr = $("#form-add-skill").serialize();
	 	var table    = $('#tableSkill').DataTable();
		if($("#form-add-skill").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>account/cdashboard/sysxpertise/save_add_skill",
			paramstr,
			function(data) {
				if(data == "true"){
					table.ajax.reload();
					$('#addSkill').modal('hide');
					swal("Naiss!", "Keterampilan berhasil disimpan", "success");
				} else {
					$('#addSkill').modal('hide');
					swal("Oops!", "Keterampilan gagal disimpan", "error");
				}
			});	
		}
	}

	function delete_skill(pskill_id){
		var table = $('#tableSkill').DataTable();
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah Anda yakin ingin menghapus data ini ?",
	        type: "warning",
	        showCancelButton: true,
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>account/cdashboard/sysxpertise/delete_skill",
					type: "post",
					data: {pskill_id:pskill_id},
					success:function(){
						table.ajax.reload();
						swal("Naiss!", "Data berhasil dihapus", "success");
					},
					error:function(){
						table.ajax.reload();
						swal("Oops!", "Data gagal dihapus", "error");
					},
				});
			}
        });
  	};

  	function save_edit_job(){
		var paramstr = $("#form-edit-job").serialize();
		var table6   = $('#tableJobhistory').DataTable();
		if($("#form-edit-job").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>account/cdashboard/sysjobhistory/save_edit_job",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#editJob').modal('hide');
					table6.ajax.reload();
					swal("Naiss!", "Data berhasil disimpan", "success");
				} else {
					$('#editJob').modal('hide');
					swal("Oops!", "Gagal diproses. Coba lagi", "error");
				}
			});	
		}
	}

	function delete_job(pjobhistory_id){
		var table6 = $('#tableJobhistory').DataTable();
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah Anda yakin ingin menghapus data ini ?",
	        type: "warning",
	        showCancelButton: true,
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>account/cdashboard/sysjobhistory/delete_job",
					type: "post",
					data: {pjobhistory_id:pjobhistory_id},
					success:function(){
						table6.ajax.reload();
						swal("Naiss!", "Data berhasil dihapus", "success");
					},
					error:function(){
						table6.ajax.reload();
						swal("Oops!", "Data gagal dihapus", "error");
					},
				});
			}
        });
  	};

  	//FOTO
  	$(function () {
		var inputFile    = $('input[name=file]');
		var uploadURI    = $('#form-photo').attr('action');
		var progressBar0 = $('#progress-bar-photo');
		$('#upload-btn-photo').on('click', function(event) {
			var fileToUpload = inputFile[0].files[0];

			if (fileToUpload != 'undefined') {

				var formData = new FormData();
				formData.append("file", fileToUpload);

				$.ajax({
					url: uploadURI,
					type: 'post',
					data: formData,
					processData: false,
					contentType: false,
					success: function(result) {
						$('#unggahFoto').modal('hide');
						swal({
							title: "Naiss!", 
							text: "Data berhasil disimpan", 
							type: "success"}).then(function(){ 
								location.reload();
							}
						);
					},
					error: function(error) {
		                $('#unggahFoto').modal('hide');
		                $('.progress-photo').hide();
						swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
		            },
					xhr: function() {
						var xhr = new XMLHttpRequest();
						xhr.upload.addEventListener("progress", function(event) {
							if (event.lengthComputable) {
								var percentComplete = Math.round( (event.loaded / event.total) * 100 );
								
								$('.progress-photo').show();
								progressBar0.css({width: percentComplete + "%"});
								progressBar0.text(percentComplete + '%');
							};
						}, false);
						return xhr;
					}
				});
			}
		});
	});
  	
	$(document).ready(function (e) {
		//IJAZAH
		$('#file_ijazah').change(
            function(){
                if ($(this).val()) {
                    $('#upload-btn-ijazah').attr('disabled',false);
					var progressBar1 = $('#progress-bar-ijazah');
					var table4       = $('#tableIjazah').DataTable();
					$("#form-ijazah").on('click',(function(e) {
						e.preventDefault();

						if($("#form-ijazah").valid() == false){
							return false;
						} else {
							$.ajax({
								url: "<?=site_url();?>account/cdashboard/syseducation/save_add_ijazah",
								type: "POST",
								data:  new FormData(this),
								contentType: false,
								cache: false,
								processData:false,
								success: function(data){
									if(data == 'Error'){
										$('#unggahIjazah').modal('hide');
										swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
										table4.ajax.reload();
									} else {
										$("#form-ijazah")[0].reset();
										$('#unggahIjazah').modal('hide');
										swal({
											title: "Naiss!", 
											text: "Berkas berhasil disimpan", 
											type: "success"}).then(function(){ 
												location.reload();
											}
										);
									}
								},
								xhr: function() {
									var xhr = new XMLHttpRequest();
									xhr.upload.addEventListener("progress", function(event) {
										if (event.lengthComputable) {
											var percentComplete = Math.round( (event.loaded / event.total) * 100 );
											
											$('.progress-ijazah').show();
											progressBar1.css({width: percentComplete + "%"});
											progressBar1.text(percentComplete + '%');
										};
									}, false);
									return xhr;
								}     
							});
						}
					}));
				}
			}
		);

		$('#file_add_ijazah').change(
            function(){
                if ($(this).val()) {
                    $('#btn-add-ijazah').attr('disabled',false);
					var progressBar1a = $('#progress-bar-add-ijazah');
					$("#form-add-ijazah").on('click',(function(e) {
						e.preventDefault();

						if($("#form-add-ijazah").valid() == false){
							return false;
						} else {
							$.ajax({
								url: "<?=site_url();?>account/cdashboard/syseducation/save_add_ijazah",
								type: "POST",
								data:  new FormData(this),
								contentType: false,
								cache: false,
								processData:false,
								success: function(data){
									if(data == 'Error'){
										$('#addIjazah').modal('hide');
										swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
									} else {
										$("#form-add-ijazah")[0].reset();
										$('#addIjazah').modal('hide');
										swal({
											title: "Naiss!", 
											text: "Berkas berhasil disimpan", 
											type: "success"}).then(function(){ 
												location.reload();
											}
										);
									}
								},
								xhr: function() {
									var xhr = new XMLHttpRequest();
									xhr.upload.addEventListener("progress", function(event) {
										if (event.lengthComputable) {
											var percentComplete = Math.round( (event.loaded / event.total) * 100 );
											
											$('.progress-add-ijazah').show();
											progressBar1a.css({width: percentComplete + "%"});
											progressBar1a.text(percentComplete + '%');
										};
									}, false);
									return xhr;
								}     
							});
						}
					}));
				}
			}
		);

		//SIM
		$("#form-add-sim").on("submit", (function(e) {
			e.preventDefault();
			var progressBar2 = $('#progress-bar-sim');
			
			if($("#form-add-sim").valid() == false){
				return false;
			} else {
				$.ajax({
					url: "<?=site_url();?>lisence/save_add_sim",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data){
						if(data !== 'Success'){
							$('#addSIM').modal('hide');
							$('.progress-sim').hide();
							swal("Oops!", "Gagal diproses. Pastikan format dan ukuran file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
						} else {
							$('#addSIM').modal('hide');
							swal({
								title: "Naiss!", 
								text: "Berkas berhasil disimpan", 
								type: "success"}).then(function(){ 
									location.reload();
								}
							);
						}
					},
					xhr: function() {
						var xhr = new XMLHttpRequest();
						xhr.upload.addEventListener("progress", function(event) {
							if (event.lengthComputable) {
								var percentComplete = Math.round( (event.loaded / event.total) * 100 );
								$('.progress-sim').show();
								progressBar2.css({width: percentComplete + "%"});
								progressBar2.text(percentComplete + '%');
							};
						}, false);
						return xhr;
					}     
				});
			}
		}));

		//LISENCE
        $('#file_lisence').change(
            function(){
                if ($(this).val()) {
                    $('#btn-lisence').attr('disabled',false);
					var progressBar3 = $('#progress-bar-lisence');
					$("#form-berkas").on('submit',(function(e) {
						e.preventDefault();

						$.ajax({
							url: "<?=site_url();?>account/cdashboard/syslisence/save_upload_lisence",
							type: "POST",
							data:  new FormData(this),
							contentType: false,
							cache: false,
							processData:false,
							success: function(data){
								if(data == 'Error'){
									$('#unggahBerkas').modal('hide');
									$('#progress-bar-lisence').hide();
									swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
								} else {
									$("#form-berkas")[0].reset();
									$('#unggahBerkas').modal('hide');
									swal({
										title: "Naiss!", 
										text: "Berkas berhasil disimpan", 
										type: "success"}).then(function(){ 
											location.reload();
										}
									);
								}
							},
							xhr: function() {
								var xhr = new XMLHttpRequest();
								xhr.upload.addEventListener("progress", function(event) {
									if (event.lengthComputable) {
										var percentComplete = Math.round( (event.loaded / event.total) * 100 );
										$('#progress-bar-lisence').show();
										progressBar3.css({width: percentComplete + "%"});
										progressBar3.text(percentComplete + '%');
									};
								}, false);
								return xhr;
							}     
						});
					}));
				} 
            }
        );

		//JOB
        $('#file_job').change(
            function(){
                if ($(this).val()) {
                    $('#btn-job').attr('disabled',false);
                    var progressBar4 = $('#progress-bar-job');
					$("#form-job").on('submit',(function(e) {
						e.preventDefault();

						$.ajax({
							url: "<?=site_url();?>account/cdashboard/sysjobhistory/save_upload_job",
							type: "POST",
							data:  new FormData(this),
							contentType: false,
							cache: false,
							processData:false,
							success: function(data){
								if(data == 'Error'){
									$('#unggahJob').modal('hide');
									$('.progress-job').hide();
									swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
								} else {
									$("#form-job")[0].reset();
									$('#unggahJob').modal('hide');
									swal({
										title: "Naiss!", 
										text: "Berkas berhasil disimpan", 
										type: "success"}).then(function(){ 
											location.reload();
										}
									);
								}
							},
							xhr: function() {
								var xhr = new XMLHttpRequest();
								xhr.upload.addEventListener("progress", function(event) {
									if (event.lengthComputable) {
										var percentComplete = Math.round( (event.loaded / event.total) * 100 );
										$('.progress-job').show();
										progressBar4.css({width: percentComplete + "%"});
										progressBar4.text(percentComplete + '%');
									};
								}, false);
								return xhr;
							}     
						});
					}));
                } 
            }
        );

    	//JOB
        $('#file_job_upload').change(
            function(){
                if ($(this).val()) {
                    $('#btn-job-upload').attr('disabled',false);
					$("#form-add-job").on('click',(function(e) {
						e.preventDefault();

						if($("#form-add-job").valid() == false){
							return false;
						} else {
							$.ajax({
								url: "<?=site_url();?>account/cdashboard/sysjobhistory/save_add_job",
								type: "POST",
								data:  new FormData(this),
								contentType: false,
								cache: false,
								processData:false,
								success: function(data){
									if(data == 'Error'){
										$('#addPengalaman').modal('hide');
										swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
									} else {
										$('#addPengalaman').modal('hide');
										swal({
											title: "Naiss!", 
											text: "Berkas berhasil disimpan", 
											type: "success"}).then(function(){ 
												location.reload();
											}
										);
									}
								},     
							});
						}
					}));
                } 
            }
        );
    });

$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});
	                    
</script>