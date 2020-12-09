<h4 style="margin-top: 0px;"><span class="label label-danger">PELAMAR</span> Semua Pelamar Manual - <small>Data keseluruhan pelamar manual</small></h4>
<hr>
<div class="panel panel-default" data-collapsed="0">
	<div class="panel-body" style="background: #FFF;">
        <form id="form-filter" class="form-horizontal">
        	<div class="row">
        		<div class="col-md-3">
        			<div class="container-fluid">
        				<div class="form-group">
			                <input type="text" class="form-control alpha input-sm" id="people_fullname" placeholder="Nama Lengkap" maxlength="100">
			            </div>
			            <div class="form-group">
			                <select class="form-control input-sm" id="conclusion_search">
			                	<option value="">Pilih status</option>
			                	<option value="0">Tidak Lulus (TL)</option>
			                	<option value="1">Lulus (L)</option>
			                	<option value="3">Belum Interview</option>
			                </select>
			            </div>
        			</div>
        		</div>
        		<div class="col-md-3">
        			<div class="container-fluid">
        				<div class="form-group">
			                <input type="text" class="form-control num input-sm" id="people_noreg" placeholder="No. Registrasi" data-mask="BSS-MRECRUIT-******-***" maxlength="24">
			            </div>
			        </div>
        		</div>
        		<div class="col-md-3">
        			<div class="container-fluid">
        				<div class="form-group">
			                <input type="text" class="form-control alpnum input-sm" id="people_position" placeholder="Posisi" maxlength="50">
			            </div>
			        </div>
			    </div>
        		<div class="col-md-3">
        			<div class="container-fluid">
	        			<div class="form-group">
			                <select class="form-control input-sm" name="site_search" id="site_search">
			                	<option value="">Pilih site</option>
			                	<?php
		                        	foreach ($site as $row) {
		                        		echo '<option value="'.$row->KodeST.'">'.$row->NamaST.' ['.$row->KodeST.']</option>';
		                        	}
		                        ?>
			                </select>
			            </div>
			        </div>
        		</div>
        	</div>
    		<div class="container-fluid">
        		<div class="form-group has-warning">
	            	<button type="button" class="btn btn-primary btn-icon" id="btn-filter">
						Filter
						<i class="entypo-search"></i>
					</button>
					<button type="button" class="btn btn-default btn-icon" id="btn-reset">
						Reset
						<i class="entypo-arrows-ccw"></i>
					</button>
					<button type="button" class="btn btn-danger pull-right btn-icon" data-toggle="modal" data-target="#modal-add-pelamar" data-backdrop="static" data-keyboard="false">
						Tambah Data
						<i class="entypo-plus"></i>
					</button>
	            </div>
	        </div>
        </form>
		
		<hr class="row">

		<table class="table table-bordered table-hover" id="tablePelamarAll" style="background: #FFF;">
			<thead>
				<tr>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th class="text-center bold">No</th>
					<th class="text-center bold">Pelamar</th>
					<th class="text-center bold">No. Reg</th>
					<th class="text-center bold">Pendidikan</th>
					<th class="text-center bold">Usia</th>
					<th class="text-center bold">Posisi</th>
					<th class="text-center bold">Tgl Lamar</th>
					<th class="text-center bold">Site</th>
					<th class="text-center bold">Kesimpulan</th>
					<th class="text-center bold"><i class="fa fa-cogs"></i></th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="loading" id="loading"></div>

<div id="modal-add-pelamar" class="modal all-modals modal-gray">
	<div class="modal-dialog modal60">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Pelamar</h4>
			</div>
			<div class="modal-body">
				<form id="addpelamarmanual" method="post" action="#" class="form-wizard validate">
					<div class="steps-progress"><div class="progress-indicator"></div></div>
					<ul>
						<li class="active"><a href="#tab2-1" data-toggle="tab"><span>1</span>Personal</a></li>
						<li><a href="#tab2-2" data-toggle="tab"><span>2</span>Alamat</a></li>
						<li><a href="#tab2-3" data-toggle="tab"><span>3</span>Pendidikan</a></li>
						<li><a href="#tab2-4" data-toggle="tab"><span>4</span>ID &amp; Surat Izin</a></li>
						<li><a href="#tab2-5" data-toggle="tab"><span>5</span>Pengalaman</a></li>
						<li><a href="#tab2-6" data-toggle="tab"><span>6</span>Kemampuan</a></li>
						<li><a href="#tab2-7" data-toggle="tab"><span>7</span>Interview</a></li>
					</ul>
					<div class="tab-content">
						<!-- PERSONAL -->
						<div class="tab-pane active" id="tab2-1">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Cek Nomor KTP</label>
										<input class="form-control required num" maxlength="17" id="noktp" placeholder="Identity number" />
										<span id="ktp-availability-status" style="color: #21CB21;"></span>
									</div>
									
									<div class="form-group">
										<label class="control-label">Tempat Lahir</label>
				                        <input type="text" name="birthplace" id="birthplace" class="form-control required alpha" maxlength="150" placeholder="Birthplace" >
									</div>
									<div class="form-group">
										<label class="control-label">Jenis Kelamin</label>
										<select class="form-control required" name="gender" id="gender">
											<option value="">Pilih</option>
											<option value="L">Laki - laki</option>
											<option value="P">Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Jabatan yang dilamar</label>
										<select name="jabatan" id="jabatan" class="required" maxlength="150" tabindex="2" data-validate="required">
				                            <option></option>
				                            <?php
				                            	foreach ($list_jabatan as $row) {
				                            		echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.' ['.$row->KodeJB.']</option>';
				                            	}
				                            ?>
				                        </select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Nama Lengkap</label>
										<input class="form-control required alpha" name="fullname" id="fullname" placeholder="Full name" />
									</div>
									<div class="form-group">
										<label class="control-label">Tanggal Lahir</label>
										<input class="form-control required" name="birthdate" id="birthdate" data-mask="date" placeholder="Pre-formatted birth date" />
									</div>
									<div class="form-group">
										<label class="control-label">Nomor HP</label>
										<input class="form-control required num" maxlength="14" name="mobilephone" id="mobilephone" placeholder="Mobile phone number" />
									</div>
									<div class="form-group">
										<label class="control-label">Tanggal Melamar</label>
										<input class="form-control required" name="submissiondate" id="submissiondate" data-mask="date" placeholder="Pre-formatted date" />
									</div>
								</div>
							</div>							
						</div>
						
						<!-- ADDRESS -->
						<div class="tab-pane" id="tab2-2">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Alamat</label>
										<input class="form-control alpnum required" name="street" id="street" maxlength="200" placeholder="Enter your street address" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label class="control-label">Kota</label>
										<input type="text" name="addressplace" id="addressplace" class="form-control required alpha" maxlength="150" placeholder="City address" />

									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Kode Pos</label>
										<input class="form-control required num" name="zip" id="zip" data-mask="** ****" placeholder="Postal Code" />
									</div>
								</div>
							</div>
						</div>
						
						<!-- EDUCATION -->
						<div class="tab-pane" id="tab2-3">
							<strong>Pendidikan Terkahir</strong>
							<br /><br />
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Jenjang</label>
										<select name="jenjang" id="jenjang" class="required" tabindex="2" data-validate="required">
				                            <option></option>
				                            <?php
				                            	foreach ($education as $row) {
				                            		echo '<option value="'.$row->edutype_id.'">'.$row->edutype_name.'</option>';
				                            	}
				                            ?>
				                        </select>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label">Nama Sekolah</label>
										<input class="form-control alpnum required" maxlength="100" name="eduname" id="eduname" placeholder="Education name" />
									</div>
								</div>								
							</div>
						</div>
						
						<!-- LISENCE -->
						<div class="tab-pane" id="tab2-4">
							<strong>Identitas</strong>
							<br /><br />
							<div class="row">
								<div class="col-md-4">
									<label class="control-label">Jenis Identitas</label>
									<input class="form-control required" name="lisence_type" id="ktp_type" value="KTP" readonly />
								</div>
								<div class="col-md-4">
									<label class="control-label">Nomor KTP</label>
									<input class="form-control required num" maxlength="17" name="idktp" id="idktp" placeholder="Identity number" />
								</div>
							</div>
							<br>
							<strong>SIM (Surat Izin Mengemudi)</strong>
							<br /><br />
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Pilih jenis SIM</label>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<div class="checkbox">
														<input type="checkbox" value="1" id="simB1" name="simB1">
														<label>SIM B1</label>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="checkbox">
														<input type="checkbox" value="2" id="simB2" name="simB2">
														<label>SIM B2</label>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="checkbox">
														<input type="checkbox" value="3" id="simB1u" name="simB1u">
														<label>SIM B1 UMUM</label>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="checkbox">
														<input type="checkbox" value="4" id="simB2u" name="simB2u">
														<label>SIM B2 UMUM</label>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="checkbox">
														<input type="checkbox" value="5" id="simA" name="simA">
														<label>SIM A</label>
													</div>
												</div>
											</div>
										</div>
										
									</div>
								</div>								
							</div>
							
							<div class="sim-b1" style="display: none;">
								<div class="row">
									<div class="col-md-2">
										<label class="control-label">&nbsp;</label>
										<p class="text-right">
											<span class="label label-info">SIM B1</span>
										</p>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Nomor SIM</label>
											<input class="form-control num required" name="nosimB1" id="nosimB1" placeholder="Lisence number" maxlength="17" />
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Berlaku S/d</label>
											<input class="form-control required" name="periodsimB1" id="periodsimB1" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
										</div>
									</div>
								</div>
							</div>
							<div class="sim-b2" style="display: none;">
								<div class="row">
									<div class="col-md-2">
										<label class="control-label">&nbsp;</label>
										<p class="text-right">
											<span class="label label-info">SIM B2</span>
										</p>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Nomor SIM</label>
											<input class="form-control num required" name="nosimB2" id="nosimB2" placeholder="Lisence number" maxlength="17" value="1715170601110" />
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Berlaku S/d</label>
											<input class="form-control required" name="periodsimB2" id="periodsimB2" data-mask="date" placeholder="Pre-formatted date" maxlength="10" value="20/07/2023" />
										</div>
									</div>
								</div>
							</div>
							<div class="sim-b1u" style="display: none;">
								<div class="row">
									<div class="col-md-2">
										<label class="control-label">&nbsp;</label>
										<p class="text-right">
											<span class="label label-info">SIM B1 U</span>
										</p>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Nomor SIM</label>
											<input class="form-control num required" name="nosimB1u" id="nosimB1u" placeholder="Lisence number" maxlength="17" />
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Berlaku S/d</label>
											<input class="form-control required" name="periodsimB1u" id="periodsimB1u" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
										</div>
									</div>
								</div>
							</div>
							<div class="sim-b2u" style="display: none;">
								<div class="row">
									<div class="col-md-2">
										<label class="control-label">&nbsp;</label>
										<p class="text-right">
											<span class="label label-info">SIM B2 U</span>
										</p>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Nomor SIM</label>
											<input class="form-control num required" name="nosimB2u" id="nosimB2u" placeholder="Lisence number" maxlength="17" />
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Berlaku S/d</label>
											<input class="form-control required" name="periodsimB2u" id="periodsimB2u" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
										</div>
									</div>
								</div>
							</div>
							<div class="sim-A" style="display: none;">
								<div class="row">
									<div class="col-md-2">
										<label class="control-label">&nbsp;</label>
										<p class="text-right">
											<span class="label label-info">SIM A</span>
										</p>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Nomor SIM</label>
											<input class="form-control num required" name="nosimA" id="nosimA" placeholder="Lisence number" maxlength="17" />
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">Berlaku S/d</label>
											<input class="form-control required" name="periodsimA" id="periodsimA" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<!-- EXP -->
						<div class="tab-pane" id="tab2-5">
							<strong>Pengalaman Kerja</strong>
							<br /><br />
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">(1). Nama Perusahaan</label>
										<input class="form-control alpnum" name="company_name[]" placeholder="Company name" maxlength="150" value="PT. PRIMA LAKSANA MANDIRI" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Posisi</label>
										<input class="form-control alpnum" name="position[]" placeholder="Position" maxlength="150" value="Driver" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tahun Masuk</label>
										<input class="form-control" name="start_date[]" data-mask="date" placeholder="Pre-formatted date" maxlength="10" value="22/03/2013" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tahun Keluar</label>
										<input class="form-control" name="end_date[]" data-mask="date" placeholder="Pre-formatted date" maxlength="10" value="01/01/2015" />
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">(2). Nama Perusahaan</label>
										<input class="form-control alpnum" name="company_name[]" placeholder="Company name" maxlength="150" value="PT. WIJAYA KARYA ANUGRAH" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Posisi</label>
										<input class="form-control alpnum" name="position[]" placeholder="Position" maxlength="150" value="Driver" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tahun Masuk</label>
										<input class="form-control" name="start_date[]" data-mask="date" placeholder="Pre-formatted date" maxlength="10" value="03/03/2015" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tahun Keluar</label>
										<input class="form-control" name="end_date[]" data-mask="date" placeholder="Pre-formatted date" maxlength="10" value="04/04/2019" />
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">(3). Nama Perusahaan</label>
										<input class="form-control alpnum" name="company_name[]" placeholder="Company name" maxlength="150" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Posisi</label>
										<input class="form-control alpnum" name="position[]" placeholder="Position" maxlength="150" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tahun Masuk</label>
										<input class="form-control" name="start_date[]" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tahun Keluar</label>
										<input class="form-control" name="end_date[]" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">(4). Nama Perusahaan</label>
										<input class="form-control alpnum" name="company_name[]" placeholder="Company name" maxlength="150" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Posisi</label>
										<input class="form-control alpnum" name="position[]" placeholder="Position" maxlength="150" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tahun Masuk</label>
										<input class="form-control" name="start_date[]" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tahun Keluar</label>
										<input class="form-control" name="end_date[]" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
									</div>
								</div>						
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">(5). Nama Perusahaan</label>
										<input class="form-control alpnum" name="company_name[]" placeholder="Company name" maxlength="150" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Posisi</label>
										<input class="form-control alpnum" name="position[]" placeholder="Position" maxlength="150" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tahun Masuk</label>
										<input class="form-control" name="start_date[]" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Tahun Keluar</label>
										<input class="form-control" name="end_date[]" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
									</div>
								</div>								
							</div>
						</div>
						
						<!-- SKILL -->
						<div class="tab-pane" id="tab2-6">
							<strong>Kemampuan / keahlian</strong>
							<br /><br />
							<div class="row">
								<div class="col-md-1">
									<label class="control-label">&nbsp;</label>
									<p class="text-right">
										<span class="label label-info">1</span>
									</p>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Kemampuan</label>
										<input class="form-control alpnum" name="skillname[]" placeholder="Skills name" maxlength="150" value="Driver" />
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<label class="control-label">Unit</label>
										<input class="form-control alpnum" name="skillunit[]" placeholder="Skills unit" maxlength="150" value="DT SCANIA" />
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-md-1">
									<label class="control-label">&nbsp;</label>
									<p class="text-right">
										<span class="label label-info">2</span>
									</p>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Kemampuan</label>
										<input class="form-control alpnum" name="skillname[]" placeholder="Skills name" maxlength="150" value="Driver" />
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<label class="control-label">Unit</label>
										<input class="form-control alpnum" name="skillunit[]" placeholder="Skills unit" maxlength="150" value="HINO 260FM" />
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-md-1">
									<label class="control-label">&nbsp;</label>
									<p class="text-right">
										<span class="label label-info">3</span>
									</p>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Kemampuan</label>
										<input class="form-control alpnum" name="skillname[]" placeholder="Skills name" maxlength="150" />
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<label class="control-label">Unit</label>
										<input class="form-control alpnum" name="skillunit[]" placeholder="Skills unit" maxlength="150" />
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-md-1">
									<label class="control-label">&nbsp;</label>
									<p class="text-right">
										<span class="label label-info">4</span>
									</p>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Kemampuan</label>
										<input class="form-control alpnum" name="skillname[]" placeholder="Skills name" maxlength="150" />
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<label class="control-label">Unit</label>
										<input class="form-control alpnum" name="skillunit[]" placeholder="Skills unit" maxlength="150" />
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-md-1">
									<label class="control-label">&nbsp;</label>
									<p class="text-right">
										<span class="label label-info">5</span>
									</p>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Kemampuan</label>
										<input class="form-control alpnum" name="skillname[]" placeholder="Skills name" maxlength="150" />
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<label class="control-label">Unit</label>
										<input class="form-control alpnum" name="skillunit[]" placeholder="Skills unit" maxlength="150" />
									</div>
								</div>								
							</div>
						</div>
						
						<!-- CONCLUSION -->
						<div class="tab-pane" id="tab2-7">
							<strong>Interview dan Tes</strong>
							<br /><br />
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Apakah pelamar ini di <b>BLACKLIST</b> ?</label>
										<div class="row">
											<div class="col-md-4">
												<select class="form-control required" name="blacklist" id="blacklist">
													<option value="0">Tidak</option>
													<option value="1">Iya</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>

							<hr>

							<div class="form-group">
								<div class="checkbox">
									<input type="checkbox" class="required" name="chk-rules" id="chk-rules" data-message-message="Anda harus memberikan centang pada kolom ini.">
									<label for="chk-rules">Apakah data yang dimasukkan sudah benar ?</label>
								</div>
							</div>
							<div class="form-group">
								<button type="button" id="btn_save_add_mpelamar" class="btn btn-primary">Simpan Data</button>
							</div>
						</div>

						<ul class="pager wizard">
							<li class="previous">
								<a href="#"><i class="entypo-left-open"></i> Sebelumnya</a>
							</li>
							<li class="next">
								<a href="#">Selanjutnya <i class="entypo-right-open"></i></a>
							</li>
						</ul>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="modal-add-teori" class="modal all-modals modal-gray">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah / Input Nilai Tes Teori</h4>
			</div>
			<form method="post" id="form-edit-teori">
				<input type="hidden" name="people_id" id="id">
				<div class="modal-body">
					<div class="form-group">
						<label>Tanggal Tes Teori</label>
						<input type="text" name="interview_date" id="interview_date" data-mask="date" class="form-control" maxlength="10">
					</div>
					<div class="form-group">
						<label>Nilai Teori</label>
						<input type="text" name="score_teori_edit" id="score_teori_edit" class="form-control scores" maxlength="5">
					</div>
					<span>Gunakan titik (.) sebagai koma jika nilai desimal. Contoh ( 79.56 )</span>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default btn-icon" data-dismiss="modal">
						Tutup<i class="entypo-cancel"></i>
					</button>
					<button type="button" onclick="save_edit_teori();" class="btn btn-red btn-icon">
						Simpan<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal-add-praktek" class="modal all-modals modal-gray">
	<div class="modal-dialog modal60">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah / Input Nilai Tes Praktek</h4>
			</div>
			<form method="post" id="form-edit-praktek">
				<input type="hidden" name="people_id" id="people_id">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Tanggal Tes Praktek</label>
								<input type="text" name="praktek_date" id="praktek_date" data-mask="date" class="form-control" maxlength="10">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label>Nilai I (15)</label>
								<input type="text" name="score_practice1_edit" id="score_practice1_edit" class="form-control scores" maxlength="5">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Nilai II (10)</label>
								<input type="text" name="score_practice2_edit" id="score_practice2_edit" class="form-control scores" maxlength="5">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Nilai III (10)</label>
								<input type="text" name="score_practice3_edit" id="score_practice3_edit" class="form-control scores" maxlength="5">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Nilai IV (55)</label>
								<input type="text" name="score_practice4_edit" id="score_practice4_edit" class="form-control scores" maxlength="5">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Nilai V (10)</label>
								<input type="text" name="score_practice5_edit" id="score_practice5_edit" class="form-control scores" maxlength="5">
							</div>
						</div>
					</div>
					<span>Gunakan titik (.) sebagai koma jika nilai desimal. Contoh ( 78.90 )</span><br><br>

					<div id="sembunyi" class="">
						<strong>Kesimpulan Hasil Interview</strong>
						<br /><br />
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Apakah pelamar lulus ?</label>
									<select class="form-control required" name="statusinterview_edit" id="statusinterview_edit">
										<option value="0">Tidak Lulus</option>
										<option value="1">Lulus</option>
										<option value="2">Belum Selesai</option>
										<option value="3">Belum Interview</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Keterangan (Lulus / Tidak Lulus)</label>
									<input type="text" name="conclusion_ket_edit" id="conclusion_ket_edit" maxlength="150" class="form-control alpnum">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Keterangan / Referensi</label>
									<textarea class="form-control alpnum" rows="2" maxlength="150" name="reference_edit" id="reference_edit"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default btn-icon" data-dismiss="modal">
						Tutup<i class="entypo-cancel"></i>
					</button>
					<button type="button" onclick="save_edit_praktek();" class="btn btn-red btn-icon">
						Simpan<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal-interview" class="modal all-modals modal-gray"> 
	<div class="modal-dialog modal60">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Formulir Interview : </h4>
			</div>
			<form method="post" id="form-interview" action="#">
				<input type="hidden" name="people_id" id="people_id">
				<div class="modal-body">
					<div class="panel panel-primary">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Pilih jenis seleksi</label>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group group-seleksi1">
													<div class="checkbox">
														<input type="checkbox" value="1" id="tes_berkas" name="jenis_tes[]">
														<label>Berkas</label>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group group-seleksi2">
													<div class="checkbox">
														<input type="checkbox" value="2" id="tes_hrd" name="jenis_tes[]">
														<label>Interview HRD / Teknis</label>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group group-seleksi3">
													<div class="checkbox">
														<input type="checkbox" value="3" id="tes_teori" name="jenis_tes[]">
														<label>Tes Teori</label>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group group-seleksi4">
													<div class="checkbox">
														<input type="checkbox" value="4" id="tes_praktek" name="jenis_tes[]">
														<label>Tes Praktek</label>
													</div>
												</div>
											</div>
										</div>
										<span id="info-seleksi" class="red hidden">Pilih jenis seleksi terlebih dahulu!</span>
									</div>

								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Nama Pelamar</label>
										<input type="text" name="fullname" id="fullname" class="form-control" readonly >
									</div>
									<div class="form-group">
										<label class="control-label">Jabatan yang dilamar</label>
										<select name="jabatan" id="jabatan" class="required" maxlength="150" tabindex="2" data-validate="required">
							                <option></option>
							                <?php
							                	foreach ($list_jabatan as $row) {
							                		echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.' ['.$row->KodeJB.']</option>';
							                	}
							                ?>
							            </select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Site Interview</label>
										<select name="interviewsite" id="interviewsite" class="required" maxlength="50" tabindex="2" data-validate="required">
							                <option></option>
							                <?php
							                	foreach ($site as $row) {
							                		echo '<option value="'.$row->KodeST.'">'.$row->NamaST.' ['.$row->KodeST.']</option>';
							                	}
							                ?>
							            </select>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="panel panel-primary content_test_hrd" style="display: none;">
						<div class="panel-body">
							<div class="row" >
								<div class="col-md-12">
									<strong>Interview HRD</strong>
									<br /><br />
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tanggal Interview</label>
												<input class="form-control" name="interviewdate_hrd" id="interviewdate_hrd" data-mask="date" placeholder="Pre-formatted interview date" maxlength="10" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Nama HRD</label>
												<select name="hrd_nik" id="hrd_nik" class="required" maxlength="50" tabindex="2" data-validate="required">
									                <option></option>
									                <?php
									                	foreach ($list_karyawan as $row) {
									                		echo '<option value="'.$row->Nama.' - '.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
									                	}
									                ?>
									            </select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="panel panel-primary content_test_teori" style="display: none;">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<strong>Tes Teori</strong>
									<br /><br />
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tanggal Teori</label>
												<input class="form-control" name="interviewdate_teori" id="interviewdate_teori" data-mask="date" placeholder="Pre-formatted interview date" maxlength="10" />
											</div>
											<div class="form-group">
												<label class="control-label">Nilai</label>
												<input type="text" name="score_teori" id="score_teori" class="form-control scores" maxlength="5">
												<span>* Gunakan titik sebagai pengganti koma. Contoh: 76.90</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Nama HRD</label>
												<select name="teori_nik" id="teori_nik" class="required" maxlength="50" tabindex="2" data-validate="required">
									                <option></option>
									                <?php
									                	foreach ($list_karyawan as $row) {
									                		echo '<option value="'.$row->Nama.' - '.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
									                	}
									                ?>
									            </select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="panel panel-primary content_test_praktek" style="display: none;">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<strong>Tes Praktek</strong>
									<br /><br />
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tanggal Praktek</label>
												<input class="form-control" name="interviewdate_praktek" id="interviewdate_praktek" data-mask="date" placeholder="Pre-formatted interview date" maxlength="10" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Nama Trainer</label>
												<select name="trainer_nik" id="trainer_nik" class="required" maxlength="150" tabindex="2" data-validate="required">
									                <option></option>
									                <?php
									                	foreach ($list_trainer as $row) {
									                		echo '<option value="'.$row->Nama.' - '.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
									                	}
									                ?>
									            </select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label>Nilai I (15)</label>
												<input type="text" name="score_practice1" class="form-control scores" maxlength="5">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Nilai II (10)</label>
												<input type="text" name="score_practice2" class="form-control scores" maxlength="5">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Nilai III (10)</label>
												<input type="text" name="score_practice3" class="form-control scores" maxlength="5">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Nilai IV (55)</label>
												<input type="text" name="score_practice4" class="form-control scores" maxlength="5">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Nilai V (10)</label>
												<input type="text" name="score_practice5" class="form-control scores" maxlength="5">
											</div>
										</div>
									</div>
									<span>Gunakan titik (.) sebagai koma jika nilai desimal. Contoh ( 78.90 )</span><br><br>
								</div>
							</div>
						</div>
					</div>
					
					<hr>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Apakah pelamar lulus ?</label>
								<select class="form-control required" name="statusinterview" id="statusinterview">
									<option value="">Pilih</option>
									<option value="1">Lulus</option>
									<option value="0">Tidak Lulus</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Keterangan (Lulus / Tidak Lulus)</label>
								<select class="form-control required" name="conclusion_ket" id="conclusion_ket">
									<option value="">Pilih</option>
									<option value="Lanjut tes HRD dan Teknis">Lanjut tes HRD & Teknis</option>
									<option value="Lanjut tes teori">Lanjut Tes Teori</option>
									<option value="Lanjut tes praktek">Lanjut Tes Praktek</option>
									<option value="Lanjut MCU">Lanjut MCU</option>
									<option value="Gagal Berkas">Gagal Berkas</option>
									<option value="Gagal Interview HRD">Gagal Interview HRD</option>
									<option value="Gagal Interview Teknis">Gagal Interview Teknis</option>
									<option value="Gagal Teori">Gagal Teori</option>
									<option value="Gagal Praktek">Gagal Praktek</option>
									<option value="Gagal MCU">Gagal MCU</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="button" onclick="save_interview();">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<style type="text/css">
	.dataTables_length { width: 5% !important; }
	td.details-control {
		background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
	  	cursor: pointer;
	}
	tr.shown td.details-control { background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center; }
	.page-body .select2-container .select2-choice {
		height: 32px !important;
		line-height: 31px !important;
	}
	.text-coret { text-decoration: line-through !important; }
	.form-wizard .tab-content { margin: 40px 5px 5px 5px !important; }
	#hidden_div { display: none; }
	ul.ui-autocomplete { z-index: 9999; }
</style>

<script type="text/javascript">

 	var table;

 	function format ( d ){
		return '<table cellpadding="0" cellspacing="0" style="padding-left:0px;" class="table table-bordered no-margin">'+
		'<tr>'+
			'<td class="col-xs-3">Tgl Interview &amp; Tes Teori</td>'+
			'<td>'+d.interview_date+'</td>'+
			'<td></td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-3">PIC HRD & Teknis</td>'+
			'<td>'+d.hrd_name+'</td>'+
			'<td></td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-3">Tgl Tes Teori</td>'+
			'<td>'+d.teori_date+'</td>'+
			'<td></td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-3">PIC Tes Teori</td>'+
			'<td>'+d.teori_name+'</td>'+
			'<td></td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-3">Nilai Teori</td>'+
			'<td>'+d.score_teori+'</td>'+
			'<td><a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-add-teori" data-backdrop="static" data-keyboard="false" data-id="'+d.id+'" data-interview_date="'+d.interview_date+'" data-score_teori="'+d.score_teori+'" data-name="'+d.fullname+'" >Ubah / Input</a></td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-3">Nama Trainer</td>'+
			'<td>'+d.trainer_name+'</td>'+
			'<td></td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-3">Nilai Praktek I, II, III, IV, V</td>'+
			'<td>'+d.score_practice1+', '+d.score_practice2+', '+d.score_practice3+', '+d.score_practice4+', '+d.score_practice5+'</td>'+
			'<td><a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-add-praktek" data-backdrop="static" data-keyboard="false" data-id="'+d.id+'" data-praktek_date="'+d.praktek_date+'" data-score_practice1="'+d.score_practice1+'" data-score_practice2="'+d.score_practice2+'" data-score_practice3="'+d.score_practice3+'" data-score_practice4="'+d.score_practice4+'" data-score_practice5="'+d.score_practice5+'" data-conclusion_ket="'+d.conclusion_ket+'" data-reference="'+d.reference+'" data-conclusion="'+d.conclusion_ref+'" >Ubah / Input</a></td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-3">Nilai Praktek Rata-rata</td>'+
			'<td>'+d.score_practice_average+'</td>'+
			'<td></td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-3">Keterangan</td>'+
			'<td>'+d.conclusion_ket+'</td>'+
			'<td></td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-3">Masa Interview Aktif</td>'+
			'<td>'+d.last_date+'</td>'+
			'<td></td>'+
		'</tr>'+
		'</table>';
    }

    function showDiv(divId, element){ document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none'; }

	$(document).ready(function() {
    	var table = $('#tablePelamarAll').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"order": [],
	        "stateSave": true,
			"ajax": {
				"url": '<?=site_url('dtMPelamarAll')?>',
				"type": "POST",
				"data": function ( data ) {
					data.people_fullname   = $('#people_fullname').val();
					data.people_noreg      = $('#people_noreg').val();
					data.people_position   = $('#people_position').val();
					data.site_search       = $('#site_search').val();
					data.conclusion_search = $('#conclusion_search').val();
	            },
	            // error: function(data) { table.ajax.reload(); }
		    },
		    "columns": [
		    	{
	               "className": 'details-control',
	               "data": null,
	               "defaultContent": '',
	               "orderable": false, 
	               "targets": 0
	            },
	            { "data": "no", "className": "text-center", "searchable": false, "orderable": false},
	            { "data": "fullname", "className": "text-left", "orderable": false,  render : function(data ,type, row) {
			        	return '<a target="_blank" onClick="ajax_load(\'<?=site_url()?>detailPeopleManual/'+row.noreg+'\')">'+data+'</a>'
			        } },
	            { "data": "noreg", "className": "text-center", "orderable": false},
	            { "data": "edu", "className": "text-center", "searchable": false, "orderable": false},
	            { "data": "age", "className": "text-center", "searchable": false, "orderable": false},
	            { "data": "jabatan", "className": "text-center", "orderable": false},
	            { "data": "tgl_melamar", "className": "text-center", "orderable": false},
	            { "data": "site","className": "text-center", "orderable": false },
	            { "data": "conclusion", "className": "text-center", "orderable": false},
	            { "data": "action", "className": "text-center", "orderable": false},
	        ],
			"language":{ "url":"<?=base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json" },
			"createdRow": function( row, data, dataIndex){
                if( data[9] ==  `Blacklist`){
                    $(row).addClass('red-bg');
                }
            },
		});

		$('#btn-filter').click(function(){ 
			table.ajax.reload();
		});
		$('#btn-reset').click(function(){ 
			$('#form-filter')[0].reset();
			table.ajax.reload();  
		});

		$( "#birthplace, #addressplace" ).autocomplete({
          	source: "<?=site_url('getcity/?');?>"
        });

		$('#jenjang, #trainer_nik, #interviewsite, #jabatan, #hrd_nik, #teori_nik').select2({
			placeholder: "Pilih",
    		allowClear: true
		});

		$('.datepicker').datepicker({
			format: 'dd-mm-yyyy',
			todayBtn: true,
			timePicker: true,
			autoclose: true
		});

		$('.alpha').alphanum({allowNumeric: false});
		$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});
		$('.alpnum').alphanum({
			allowNumeric: true,
			allow: ',.'
		});
		$('.scores').numeric({ allow: '.' });
		$('#noktp').blur(ceknokatepe);

		$('#tablePelamarAll tbody').on('click', 'td.details-control', function () {
			var tr  = $(this).closest('tr'),
				row = table.row( tr );
			if ( row.child.isShown() ) {
				row.child.hide();
				tr.removeClass('shown');
			} else {
				row.child( format(row.data()) ).show();
				tr.addClass('shown');
			}
		});

        $("#btn_save_add_mpelamar").click(function (){
        	$("#loading").removeClass("hidden");
			var formdata = $("#addpelamarmanual").serialize(),
				progressBar = $('#progress-bar-add');
			if($("#addpelamarmanual").valid() == false){
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>hrDepartment/pelamar/manual/sysmpelamarall/addpelamarmanual",
				formdata,
				function(data) {
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-add-pelamar').modal('hide');
						swal("Naiss!", "Data pelamar berhasil disimpan", "success");
						table.ajax.reload();
					} else if(data == "BL") {
						$("#loading").addClass("hidden");
						$('#modal-add-pelamar').modal('hide');
						swal("Informasi", "Data pelamar berhasil disimpan dan masuk dalam kategori BLACKLIST", "warning");
						table.ajax.reload();
					} else if(data == "Duplicate") {
						$("#loading").addClass("hidden");
						$('#modal-add-pelamar').modal('hide');
						swal("Informasi", "Duplikat data pelamar. Pelamar sudah terdaftar", "warning");
						table.ajax.reload(); 
					} else {
						$("#loading").addClass("hidden");
						$('#modal-add-pelamar').modal('hide');
						swal("Oops!", "Maaf data pelamar gagal disimpan. Muat ulang halaman ini dan coba lagi", "error");
						table.ajax.reload();
					}
				});	
			}
		});
    });

    jQuery(document).ready(function(){ jQuery("body").append( jQuery(".page-container .all-modals") ); });

    $(".tile-stats").each(function(i, el){
        var $this = $(el),
			$num     = $this.find('.num'),
			start    = attrDefault($num, 'start', 0),
			end      = attrDefault($num, 'end', 0),
			prefix   = attrDefault($num, 'prefix', ''),
			postfix  = attrDefault($num, 'postfix', ''),
			duration = attrDefault($num, 'duration', 1000),
			delay    = attrDefault($num, 'delay', 1000);
        
        if(start < end){
            if(typeof scrollMonitor == 'undefined'){
                $num.html(prefix + end + postfix);
            } else {
                var tile_stats = scrollMonitor.create( el );
                tile_stats.fullyEnterViewport(function(){
                    var o = {curr: start};
                    TweenLite.to(o, duration/1000, {curr: end, ease: Power1.easeInOut, delay: delay/1000, onUpdate: function()
                        {
                            $num.html(prefix + Math.round(o.curr) + postfix);
                        }
                    });
                    tile_stats.destroy()
                });
            }
        }
    });

    // Form Wizard
	if($.isFunction($.fn.bootstrapWizard)) {
		$(".form-wizard").each(function(i, el) {
			var $this = $(el),				
				$progress = $this.find(".steps-progress div"),
				_index = $this.find('> ul > li.active').index();
			
			// Validation
			var checkFormWizardValidaion = function(tab, navigation, index) {
	  			if($this.hasClass('validate')) {
					var $valid = $this.valid();
					
					if( ! $valid) {
						$this.data('validator').focusInvalid();
						return false;
					}
				}
		  		return true;
			};
			$this.bootstrapWizard({
				tabClass: "",
		  		onTabShow: function($tab, $navigation, index) {
					setCurrentProgressTab($this, $navigation, $tab, $progress, index);
		  		},
		  		
		  		onNext: checkFormWizardValidaion,
		  		onTabClick: checkFormWizardValidaion
		  	});
		  	$this.data('bootstrapWizard').show( _index );
		});
	}

	// Root Wizard Current Tab
	function setCurrentProgressTab($rootwizard, $nav, $tab, $progress, index) {
		$tab.prevAll().addClass('completed');
		$tab.nextAll().removeClass('completed');
		
		var items      	  = $nav.children().length,
			pct           = parseInt((index+1) / items * 100, 10),
			$first_tab    = $nav.find('li:first-child'),
			margin        = (1/(items*2) * 100) + '%';//$first_tab.find('span').position().left + 'px';
		
		if( $first_tab.hasClass('active')) {
			$progress.width(0);
		} else {
			if(rtl()) {
				$progress.width( $progress.parent().outerWidth(true) - $tab.prev().position().left - $tab.find('span').width()/2 );
			} else {
				$progress.width( ((index-1) /(items-1)) * 100 + '%' ); //$progress.width( $tab.prev().position().left - $tab.find('span').width()/2 );
			}
		}
		$progress.parent().css({
			marginLeft: margin,
			marginRight: margin
		});
	}

	// Input Mask
	if($.isFunction($.fn.inputmask)) {
		$("[data-mask]").each(function(i, el) {
			var $this = $(el),
				mask = $this.data('mask').toString(),
				opts = {
					numericInput: attrDefault($this, 'numeric', false),
					radixPoint: attrDefault($this, 'radixPoint', ''),
					rightAlignNumerics: attrDefault($this, 'numericAlign', 'left') == 'right'
				},
				placeholder = attrDefault($this, 'placeholder', ''),
				is_regex = attrDefault($this, 'isRegex', '');
			
			if(placeholder.length) {
				opts[placeholder] = placeholder;
			}
			
			switch(mask.toLowerCase()) {
				case "phone":
					mask = "(999) 999-9999";
					break;
					
				case "currency":
				case "rcurrency":
				
					var sign = attrDefault($this, 'sign', '$');
					
					mask = "999,999,999.99";
					
					if($this.data('mask').toLowerCase() == 'rcurrency') {
						mask += ' ' + sign;
					} else {
						mask = sign + ' ' + mask;
					}
					
					opts.numericInput = true;
					opts.rightAlignNumerics = false;
					opts.radixPoint = '.';
					break;
					
				case "email":
					mask = 'Regex';
					opts.regex = "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}";
					break;
				
				case "fdecimal":
					mask = 'decimal';
					$.extend(opts, {
						autoGroup	   : true,
						groupSize	   : 3,
						radixPoint	   : attrDefault($this, 'rad', '.'),
						groupSeparator : attrDefault($this, 'dec', ',')
					});
			}
			
			if(is_regex) {
				opts.regex = mask;
				mask = 'Regex';
			}
			
			$this.inputmask(mask, opts);
		});
	}

	$(function() {
		if(localStorage.simA   == null) localStorage.simA   = "false";
		if(localStorage.simB1  == null) localStorage.simB1  = "false";
		if(localStorage.simB2  == null) localStorage.simB2  = "false";
		if(localStorage.simB1U == null) localStorage.simB1U = "false";
		if(localStorage.simB2U == null) localStorage.simB2U = "false";
      	$('#simA')
	        .prop('checked', localStorage.simB1 == "true")
	        .on('change', function() {
	        localStorage.simA = this.checked;
	        if(localStorage.simA == "true") {
	            $('.sim-A').show();
	        } else {
	            $('.sim-A').hide();
	        }
	    }).trigger('change');
	        
	    $('#simB1')
	        .prop('checked', localStorage.simB1 == "true")
	        .on('change', function() {
	        localStorage.simB1 = this.checked;
	        if(localStorage.simB1 == "true") {
	            $('.sim-b1').show();
	        } else {
	            $('.sim-b1').hide();
	        }
	    }).trigger('change');

	    $('#simB2')
	        .prop('checked', localStorage.simB2 == "true")
	        .on('change', function() {
	        localStorage.simB2 = this.checked;
	        if(localStorage.simB2 == "true") {
	            $('.sim-b2').show();
	        } else {
	            $('.sim-b2').hide();
	        }
	    }).trigger('change');

	    $('#simB1u')
	        .prop('checked', localStorage.simB1u == "true")
	        .on('change', function() {
	        localStorage.simB1u = this.checked;
	        if(localStorage.simB1u == "true") {
	            $('.sim-b1u').show();
	        } else {
	            $('.sim-b1u').hide();
	        }
	    }).trigger('change');

	    $('#simB2u')
	        .prop('checked', localStorage.simB2u == "true")
	        .on('change', function() {
	        localStorage.simB2u = this.checked;
	        if(localStorage.simB2u == "true") {
	            $('.sim-b2u').show();
	        } else {
	            $('.sim-b2u').hide();
	        }
	    }).trigger('change');
	});

	$(function() {
		if(localStorage.tes_hrd   == null) localStorage.tes_hrd   = "false";
		if(localStorage.tes_teori  == null) localStorage.tes_teori  = "false";
		if(localStorage.tes_praktek  == null) localStorage.tes_praktek  = "false";
      	$('#tes_hrd')
	        .prop('checked', localStorage.tes_hrd == "true")
	        .on('change', function() {
	        localStorage.tes_hrd = this.checked;
	        if(localStorage.tes_hrd == "true") {
	            $('.content_test_hrd').show();
	        } else {
	            $('.content_test_hrd').hide();
	        }
	    }).trigger('change');
	        
	    $('#tes_teori')
	        .prop('checked', localStorage.tes_teori == "true")
	        .on('change', function() {
	        localStorage.tes_teori = this.checked;
	        if(localStorage.tes_teori == "true") {
	            $('.content_test_teori').show();
	        } else {
	            $('.content_test_teori').hide();
	        }
	    }).trigger('change');

	    $('#tes_praktek')
	        .prop('checked', localStorage.tes_praktek == "true")
	        .on('change', function() {
	        localStorage.tes_praktek = this.checked;
	        if(localStorage.tes_praktek == "true") {
	            $('.content_test_praktek').show();
	        } else {
	            $('.content_test_praktek').hide();
	        }
	    }).trigger('change');
	});

	function removePelamar(people_id){
	    swal({
	        title: "Konfirmasi",
	        text: "Hapus pelamar ini ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: '#FF6666',
	        confirmButtonText: 'Ya, okay',
	        cancelButtonText: "Emm, Batal",
	        confirmButtonClass: "btn-danger",
	        closeOnConfirm: false,
	        closeOnCancel: true
	    }, function() {
			$.ajax({
				url: "<?=site_url()?>hrDepartment/pelamar/manual/sysmpelamarall/destroy_pelamar",
				type: "post",
				data: {people_id:people_id},
				success:function(){
					table.ajax.reload();
					swal({
					  	title: "Good job!",
					  	text: "Pelamar berhasil dihapus",
					  	icon: "success",
					  	button: "Aww yiss!",
					});
				},
				error:function(){
					table.ajax.reload();
					swal("Oops", "error");
				}
			})
        });
        return false;
  	};

  	function activatedPelamar(people_id){
	    swal({
	        title: "Konfirmasi",
	        text: "Lakukan interview kembali untuk pelamar ini ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: '#FF6666',
	        confirmButtonText: 'Ya, okay',
	        cancelButtonText: "Emm, Batal",
	        confirmButtonClass: "btn-danger",
	        closeOnConfirm: false,
	        closeOnCancel: true
	    }, function() {
			$.ajax({
				url: "<?=site_url()?>hrDepartment/pelamar/manual/sysmpelamarall/activated_pelamar",
				type: "post",
				data: {people_id:people_id},
				success:function(data){
					if (data == "true"){
						table.ajax.reload();
						swal("Naiss!","Pelamar berhasil diaktivasi. Silahkan isi data interview pelamar.", "success");
					} else if (data == "Error Activated"){
						table.ajax.reload();
						swal("Oops","Maaf anda belum bisa melakukan interview kembali pada pelamar ini karena masa aktif belum terlewati.", "error");
					} else {
						table.ajax.reload();
						swal("Oops","Gagal memproses. Reload halaman dan coba lagi.", "error");
					}
					
				},
				error:function(){
					table.ajax.reload();
					swal("Oops","Ada yang salah. Reload halaman ini, lalu coba lagi.", "error");
				}
			})
        });
        return false;
  	};

  	$('#modal-add-teori').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button = $(event.relatedTarget) 
			var id     = button.data('id')
			var interview_date = button.data('interview_date')
			var score_teori_edit = button.data('score_teori')
			var name  = button.data('name')
			var modal = $(this)
			modal.find('.modal-title').text('Ubah / Input Nilai Tes Teori ' + name)
			modal.find('#score_teori_edit').val(score_teori_edit)
			modal.find('#id').val(id)
		}
	});

	function save_edit_teori(){
	 	var formdata = $("#form-edit-teori").serialize(),
	 		table = $('#tablePelamarAll').DataTable();
		if($("#form-edit-teori").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>hrDepartment/pelamar/manual/sysmpelamarall/edit_score_teori",
			formdata,
			function(data) {
				if(data == "Success"){
					table.ajax.reload();
					$('#modal-add-teori').modal('hide');
					swal("Naiss!", "Data berhasil disimpan", "success");
				} else {
					table.ajax.reload();
					$('#modal-add-teori').modal('hide');
					swal("Oops!", "Data gagal disimpan", "error");
				}
			});	
		}
	}

	$('#modal-add-praktek').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button = $(event.relatedTarget) 
			var id     = button.data('id')
			var praktekdate = button.data('praktek_date')
			var score_practice1_edit = button.data('score_practice1')
			var score_practice2_edit = button.data('score_practice2')
			var score_practice3_edit = button.data('score_practice3')
			var score_practice4_edit = button.data('score_practice4')
			var score_practice5_edit = button.data('score_practice5')
			var conclusion_edit     = button.data('conclusion')
			var conclusion_ket_edit = button.data('conclusion_ket')
			var reference_edit      = button.data('reference')
			var modal = $(this)
			modal.find('.modal-title').text('Ubah / Input Nilai Tes Praktek ' + name)
			modal.find('#score_practice1_edit').val(score_practice1_edit)
			modal.find('#score_practice2_edit').val(score_practice2_edit)
			modal.find('#score_practice3_edit').val(score_practice3_edit)
			modal.find('#score_practice4_edit').val(score_practice4_edit)
			modal.find('#score_practice5_edit').val(score_practice5_edit)
			modal.find('#conclusion_ket_edit').val(conclusion_ket_edit)
			modal.find('#reference_edit').val(reference_edit)
			modal.find('#people_id').val(id)
			modal.find('#praktek_date').val(praktekdate)
			$("#statusinterview_edit option[value="+conclusion_edit+"]").prop('selected', true);
		}

		// if (conclusion_edit == 3 && conclusion_edit == 2) {
		// 	$('#sembunyi').removeClass('hidden');
		// } else {
		// 	$('#sembunyi').addClass('hidden');
		// }
	});

	$('#modal-interview').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button  = $(event.relatedTarget) 
			var id      = button.data('id')
			var name    = button.data('name')
			var noreg   = button.data('noreg')
			var jabatan = button.data('jabatan')
			var site    = button.data('site')
			var hrd     = button.data('inhrd')
			var teori   = button.data('inteori')
			var praktek = button.data('inpraktek')
			var modal   = $(this)
			modal.find('.modal-title').text('Formulir Interview : ' + noreg)
			modal.find('#people_id').val(id)
			modal.find('#fullname').val(name)
			modal.find('#interviewsite').val(site).trigger('change')
			modal.find('#jabatan').val(jabatan).trigger('change')
			if (site !== '') {
				$("#tes_berkas").attr("disabled", true);
				$(".group-seleksi1 label").addClass("text-coret");
			} else {
				$("#tes_berkas").removeAttr("disabled");
			}
			if (hrd !== '') {
				$("#tes_hrd").attr("disabled", true);
				$(".group-seleksi2 label").addClass("text-coret");
			} else {
				$("#tes_hrd").removeAttr("disabled");
			}
			if (teori !== '') {
				$("#tes_teori").attr("disabled", true);
				$(".group-seleksi3 label").addClass("text-coret");
			} else {
				$("#tes_teori").removeAttr("disabled");
			}
			if (praktek !== '') {
				$("#tes_praktek").attr("disabled", true);
				$(".group-seleksi4 label").addClass("text-coret");
			} else {
				$("#tes_praktek").removeAttr("disabled");
			}
		}
	});

	function save_edit_praktek(){
	 	var formdata = $("#form-edit-praktek").serialize(),
	 		table = $('#tablePelamarAll').DataTable();
		if($("#form-edit-praktek").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>hrDepartment/pelamar/manual/sysmpelamarall/edit_score_praktek",
			formdata,
			function(data) {
				if(data == "Success"){
					table.ajax.reload();
					$('#modal-add-praktek').modal('hide');
					swal("Naiss!", "Data berhasil disimpan", "success");
				} else {
					table.ajax.reload();
					$('#modal-add-praktek').modal('hide');
					swal("Oops!", "Data gagal disimpan", "error");
				}
			});	
		}
	}

	function ceknokatepe(){
	    var noktp = $('#noktp').val(); 
	    if( noktp == "" || noktp.length < 15){  
	        $("#ktp-availability-status").html('Masukkan minimal 16 karakter.').css('color', 'red');  
	    } else if (noktp.length > 17) {
	    	$("#ktp-availability-status").html('Maksimal hanya 17 karakter saja.').css('color', 'red');
	    } else {
	        $.ajax({
	            type: "POST",
	            url: "<?=base_url();?>hrDepartment/pelamar/manual/sysmpelamarall/check_noktp",
	            cache: false,    
	            data: 'noktp=' + $("#noktp").val(),
	            success: function(response){ 
	                try {
	                    if(response == "false"){
	                        $("#ktp-availability-status").html('KTP pelamar belum terdaftar').css('color', 'green');
							$("#idktp").val(noktp);
	                    } else {
	                        $("#ktp-availability-status").html('KTP pelamar sudah terdaftar, tidak bisa duplikasi data.').css('color', 'red');
	                    }          
	                } catch(e) {  
	                    swall("Oops!", "Terjadi kesalahan.. Reload halaman ini dan pastikan koneksi internet Anda stabil.", "error");
	                }  
	            },
	            error: function(){      
	                swall("Oops!", "Terjadi kesalahan.. Reload halaman ini dan pastikan koneksi internet Anda stabil.", "error");
	            }
	        });
	    }
	}

	function save_interview(){
		$("#loading").removeClass("hidden");
	 	var formdata = $("#form-interview").serialize(),
	 		table = $('#tablePelamarAll').DataTable();
		if($("#form-interview").valid() == false){
			$("#loading").addClass("hidden");
			return false;
		} else {
			$("#loading").addClass("hidden");
			$.post("<?=base_url();?>hrDepartment/pelamar/manual/sysmpelamarall/save_interview",
			formdata,
			function(data) {
				if(data == "Success"){
					localStorage.clear();
					table.ajax.reload();
					$('#modal-interview').modal('hide');
					swal("Naiss!", "Data berhasil disimpan", "success");
					$("#info-seleksi").addClass("hidden");
				} else if (data == "ESelection") {
					swal("Hmmm", "Anda belum memilih jenis seleksi.", "info");
					$("#info-seleksi").removeClass("hidden");
				} else {
					table.ajax.reload();
					$('#modal-interview').modal('hide');
					swal("Oops!", "Data gagal disimpan", "error");
					$("#info-seleksi").addClass("hidden");
				}
			});	
		}
	}
</script>
