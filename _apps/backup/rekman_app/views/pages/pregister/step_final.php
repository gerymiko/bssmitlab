<section id="page-title" class="page-title-mini">
	<div class="container clearfix">
		<h1 class="white">Formulir Registrasi</h1>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li>Daftar</li>	
			<li class="active" style="color: #FFF;font-weight: 700">Resume (Tahap Akhir)</li>
		</ol>
	</div>
</section><br />

<section id="content">
	<div class="container clearfix">
		<div class="accordion accordion-bg clearfix">
			<div class="acctitle">Ketentuan dalam pengisian form pendaftaran</div>
			<div class="panel-body noradius">
				<ul class="iconlist iconlist-color nobottommargin">
					<li><i class="icon-ok"></i>Mohon perhatikan data yang telah anda isi sebelumnya.</li>
				</ul>
			</div>
		</div>
		
		<!-- PERSONAL -->
		<div class="accordion accordion-bg clearfix nobottommargin">
			<div class="acctitle white" style="background-color: #343D46;">PERSONAL DIRI</div>
		</div>
		<div class="panel-body noradius">
        	<div class="col-md-6">
        		<table class="table">
        			<tbody>
        				<tr> 
							<td class="col-sm-4 nobordertop bold">Nama Lengkap</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=ucwords($this->input->cookie('firstname',TRUE).' '.$this->input->cookie('middlename',TRUE).' '.$this->input->cookie('lastname',TRUE))?>
								</td>
						</tr>
						<?php
							$bplace     = $this->input->cookie('bplace',TRUE);
							$tlahir     = $this->mod_karir_global->getCityBorn($bplace);
							
							$kotaktp    = $this->input->cookie('alamat_kota_ktp',TRUE);
							$addkotaktp = $this->mod_karir_global->getCityAddKTP($kotaktp);
							
							$kotadom    = $this->input->cookie('alamat_kota_dom',TRUE);
							$addkotadom = $this->mod_karir_global->getCityAddDOM($kotadom);
						?>
						<tr>
							<td class="col-sm-4 nobordertop bold">Tempat & Tanggal Lahir</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=ucwords($tlahir->city_name);?>, <?=date("d M Y", strtotime($this->input->cookie('bdate',TRUE)));?></td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop bold">Jenis Kelamin</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=$gender = ($this->input->cookie('gender',TRUE) == "L") ? "Laki - laki" : "Perempuan";?></td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop bold">Alamat KTP</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=ucwords($this->input->cookie('alamatKTP',TRUE));?></td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop"></td>
							<td class="col-sm-1 nobordertop"></td>
							<td class="nobordertop"><?=ucwords($addkotaktp->city_name);?>, <?=$this->input->cookie('zip_code_ktp',TRUE)?></td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop bold">Alamat Domisili</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=ucwords($this->input->cookie('alamatDOM',TRUE));?></td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop"></td>
							<td class="col-sm-1 nobordertop"></td>
							<td class="nobordertop"><?=ucwords($addkotadom->city_name);?>, <?=$this->input->cookie('zip_code_dom',TRUE)?></td>
						</tr>
        			</tbody>
        		</table>	
        	</div>
        	<div class="col-md-6">
        		<table class="table">
        			<tbody>
        				<tr>
							<td class="col-sm-4 nobordertop bold">Email</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=$email = ($this->input->cookie('email',TRUE) == NULL) ? "-" : $this->input->cookie('email',TRUE);?></td>
						</tr>
        				<tr>
							<td class="col-sm-4 nobordertop bold">Telepon &amp; Handphone</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop col-sm-4"><?=$phone = ($this->input->cookie('phone',TRUE) == NULL) ? "-" : $this->input->cookie('email',TRUE);?> / <?=$this->input->cookie('mobile',TRUE);?></td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop bold">Status</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=$status = ($this->input->cookie('status',TRUE) == NULL) ? "-" : $this->input->cookie('status',TRUE);?></td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop bold">Agama</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=ucfirst($this->input->cookie('agama',TRUE));?></td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop bold">Kewarganegaraan</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=$this->input->cookie('negara',TRUE);?></td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop bold">Golongan Darah</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=$this->input->cookie('darah',TRUE);?></td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop bold">Tinggi Badan</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop col-sm-1"><?=$this->input->cookie('tinggi',TRUE);?> Cm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Berat Badan : <?=$this->input->cookie('berat',TRUE);?> Kg</td> 
						</tr>
        			</tbody>
        		</table>
        	</div>
        </div><br />
		
		<!-- PENDIDIKAN -->
		<div class="accordion accordion-bg clearfix nobottommargin">
			<div class="acctitle white" style="background-color: #343D46;">PENDIDIKAN</div>
		</div>
		<div class="panel-body noradius">
    		<table class="table">
    			<tbody>
    				<?php
    					$jenjang = $this->input->cookie('edu_tipe',TRUE);
    					$edutipe = $this->mod_karir_global->getEduSelf($jenjang);
    				?>
    				<tr> 
						<td class="col-sm-5 nobordertop bold"><b>Jenjang</td>
						<td class="col-sm-1 nobordertop">:</td>
						<td class="nobordertop"><?=$edutipe->edutype_name;?></td>
					</tr>
					<tr>
						<td class="col-sm-5 nobordertop bold">Nama Universitas / Perguruan Tinggi</td>
						<td class="col-sm-1 nobordertop">:</td>
						<td class="nobordertop"><?=ucwords($this->input->cookie('edu_name',TRUE));?></td>
					</tr>
					<?php
    					$major = $this->input->cookie('edu_jurusan',TRUE);
    					$edumajor = $this->mod_karir_global->getMajorSelf($major);
    				?>
					<tr>
						<td class="col-sm-5 nobordertop bold">Jurusan</td>
						<td class="col-sm-1 nobordertop">:</td>
						<td class="nobordertop"><?=$edumajor->major_name;?></td>
					</tr>
					<?php
						$cityCollage = $this->input->cookie('edu_kota',TRUE);
						$edukota     = $this->mod_karir_global->getCityCollage($cityCollage);
					?>
					<tr>
						<td class="col-sm-5 nobordertop bold">Lokasi Sekolah / Perguruan Tinggi / Universitas</td>
						<td class="col-sm-1 nobordertop">:</td>
						<td class="nobordertop"><?=ucwords($edukota->city_name);?></td>
					</tr>
					<tr>
						<td class="col-sm-5 nobordertop bold">Tahun Lulus</td>
						<td class="col-sm-1 nobordertop">:</td>
						<td class="nobordertop"><?=$this->input->cookie('edu_datepass',TRUE);?></td>
					</tr>
					<tr>
						<td class="col-sm-5 nobordertop bold">Keterangan Lulus</td>
						<td class="col-sm-1 nobordertop">:</td>
						<td class="nobordertop"><?=ucwords($this->input->cookie('edu_keterangan',TRUE));?></td>
					</tr>
    			</tbody>
    		</table>	
    	</div><br />

        <div class="accordion accordion-bg clearfix nobottommargin">
			<div class="acctitle white" style="background-color: #343D46;">KTP (Kartu Tanda Penduduk) &amp; SIM (Surat Izin Mengemudi)</div>
		</div>
		<div class="panel-body noradius">
        	<div class="col-md-6">
        		<table class="table">
        			<tbody>
        				<?php
        					$ktpkota = $this->input->cookie('kota_ktp',TRUE);
        					$cityktp = $this->mod_karir_daftar->getCityKTP($ktpkota);
        				?>
        				<tr> 
							<td class="col-sm-4 nobordertop"><b>KTP <i>(Kartu Tanda Penduduk)</i></b></td>
						</tr>
        				<tr> 
							<td class="col-sm-4 nobordertop bold">Nomor KTP</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=$this->input->cookie('ktp',TRUE);?>
								</td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop bold">Kota Diterbitkan</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=$cityktp->city_name;?></td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop bold">Jenis KTP</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop">
								<?php
									if ($this->input->cookie('dateend_ktp',TRUE) == NULL) {
										echo $ktptype = "Seumur Hidup";
									} else {
										echo $ktptype = "Periodik";
									}
								?>
							</td>
						</tr>
						<tr>
							<td class="col-sm-4 nobordertop bold">Tanggal Diterbitkan</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=$this->input->cookie('datestart_ktp',TRUE);?></td>
						</tr>
						<?php
							if ($ktptype == "Periodik") {
								echo '
									<tr>
										<td class="col-sm-4 nobordertop bold">Berlaku S/d</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('dateend_ktp',TRUE).'</td>
									</tr>
								';
							}
						?>
        			</tbody>
        		</table>	
        	</div>
        	<?php
	        	$simAkota = $this->input->cookie('kota_sim_A',TRUE);
				$citysimA = $this->mod_karir_daftar->getCityLisSIMA($simAkota);
	        	if (!empty($this->input->cookie('plisence_number_A'))) {
	        		echo '
		            	<div class="col-md-6">
		            		<table class="table">
		            			<tbody>
		            				<tr> 
										<td class="col-sm-4 nobordertop"><b>SIM A <i>(Surat Izin Mengemudi)</i></b></td>
									</tr>
		            				<tr> 
										<td class="col-sm-4 nobordertop bold">Nomor SIM</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('plisence_number_A',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Kota Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$citysimA->city_name.'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Tanggal Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('datestart_A',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Berlaku S/d</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('dateend_A',TRUE).'</td>
									</tr>
		            			</tbody>
		            		</table>	
		            	</div>     	
	        		';
	        	}

	        	$simB1kota = $this->input->cookie('kota_sim_B1',TRUE);
				$citysimB1 = $this->mod_karir_daftar->getCityLisSIMB1($simB1kota);
	        	if (!empty($this->input->cookie('plisence_number_B1'))) {
	        		echo '
		            	<div class="col-md-6">
		            		<table class="table">
		            			<tbody>
		            				<tr> 
										<td class="col-sm-4 nobordertop"><b>SIM B1 <i>(Surat Izin Mengemudi)</i></b></td>
									</tr>
		            				<tr> 
										<td class="col-sm-4 nobordertop bold">Nomor SIM</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('plisence_number_B1',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Kota Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$citysimB1->city_name.'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Tanggal Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('datestart_B1',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Berlaku S/d</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('dateend_B1',TRUE).'</td>
									</tr>
		            			</tbody>
		            		</table>	
		            	</div>     	
	        		';
	        	}

	        	$simB2kota = $this->input->cookie('kota_sim_B2',TRUE);
				$citysimB2 = $this->mod_karir_daftar->getCityLisSIMB2($simB2kota);
	        	if (!empty($this->input->cookie('plisence_number_B2'))) {
	        		echo '
		            	<div class="col-md-6">
		            		<table class="table">
		            			<tbody>
		            				<tr> 
										<td class="col-sm-4 nobordertop"><b>SIM B2 <i>(Surat Izin Mengemudi)</i></b></td>
									</tr>
		            				<tr> 
										<td class="col-sm-4 nobordertop bold">Nomor SIM</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('plisence_number_B2',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Kota Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$citysimB2->city_name.'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Tanggal Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('datestart_B2',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Berlaku S/d</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('dateend_B2',TRUE).'</td>
									</tr>
		            			</tbody>
		            		</table>	
		            	</div>     	
	        		';
	        	}

	        	$simB2Ukota = $this->input->cookie('kota_sim_B2U',TRUE);
				$citysimB2U = $this->mod_karir_daftar->getCityLisSIMB2U($simB2Ukota);
	        	if (!empty($this->input->cookie('plisence_number_B2U'))) {
	        		echo '
		            	<div class="col-md-6">
		            		<table class="table">
		            			<tbody>
		            				<tr> 
										<td class="col-sm-4 nobordertop"><b>SIM B2 Umum <i>(Surat Izin Mengemudi)</i></b></td>
									</tr>
		            				<tr> 
										<td class="col-sm-4 nobordertop bold">Nomor SIM</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('plisence_number_B2U',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Kota Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$citysimB2U->city_name.'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Tanggal Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('datestart_B2U',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Berlaku S/d</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('dateend_B2U',TRUE).'</td>
									</tr>
		            			</tbody>
		            		</table>	
		            	</div>     	
	        		';
	        	}

	        	$simCkota = $this->input->cookie('kota_sim_C',TRUE);
				$citysimC = $this->mod_karir_daftar->getCityLisSIMC($simCkota);
	        	if (!empty($this->input->cookie('plisence_number_C'))) {
	        		echo '
		            	<div class="col-md-6">
		            		<table class="table">
		            			<tbody>
		            				<tr> 
										<td class="col-sm-4 nobordertop"><b>SIM C <i>(Surat Izin Mengemudi)</i></b></td>
									</tr>
		            				<tr> 
										<td class="col-sm-4 nobordertop bold">Nomor SIM</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('plisence_number_C',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Kota Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$citysimC->city_name.'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Tanggal Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('datestart_C',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Berlaku S/d</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('dateend_C',TRUE).'</td>
									</tr>
		            			</tbody>
		            		</table>	
		            	</div>     	
	        		';
	        	}

	        	$simDkota = $this->input->cookie('kota_sim_D',TRUE);
				$citysimD = $this->mod_karir_daftar->getCityLisSIMD($simDkota);
	        	if (!empty($this->input->cookie('plisence_number_D'))) {
	        		echo '
		            	<div class="col-md-6">
		            		<table class="table">
		            			<tbody>
		            				<tr> 
										<td class="col-sm-4 nobordertop"><b>SIM D <i>(Surat Izin Mengemudi)</i></b></td>
									</tr>
		            				<tr> 
										<td class="col-sm-4 nobordertop bold">Nomor SIM</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('plisence_number_D',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Kota Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$citysimD->city_name.'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Tanggal Diterbitkan</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('datestart_D',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 nobordertop bold">Berlaku S/d</td>
										<td class="col-sm-1 nobordertop">:</td>
										<td class="nobordertop">'.$this->input->cookie('dateend_D',TRUE).'</td>
									</tr>
		            			</tbody>
		            		</table>	
		            	</div>     	
	        		';
	        	}
	        ?>
        </div><br />

	    <?php
		    if (!empty($this->input->cookie('job_company1') || $this->input->cookie('job_company2') || $this->input->cookie('job_company3') || $this->input->cookie('job_company4'))) {

		    	echo '<div class="row">';

				if (!empty($this->input->cookie('job_company1'))) {

					$sector1   = $this->input->cookie('job_part1',TRUE);
					$job_part1 = $this->mod_karir_daftar->getSectorSelf1($sector1);

					echo '
		            	<div class="col-md-6">
    						<div class="accordion accordion-bg clearfix nobottommargin">
								<div class="acctitle white" style="background-color: #343D46;">PENGALAMAN KERJA 1</div>
							</div>
							<div class="panel-body noradius">
								<table class="nomargin">
									<tr style="padding: 10px;"> 
										<td class="col-sm-5 bold">Nama Perusahaan</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_company1',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Bidang Perusahaan</td>
										<td class="col-sm-1">:</td>
										<td>'.$job_part1->sector_name.'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Jabatan Awal</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_billet_first1',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Jabatan Akhir</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_billet_last1',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Dari</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_from1',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">S/d</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_until1',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Gaji</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_salary1',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Alasan Keluar</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_reason1',TRUE)).'</td>
									</tr>
								</table>
							</div>
		            	</div>
				    ';
				}

				if (!empty($this->input->cookie('job_company2'))) {
					$sector2   = $this->input->cookie('job_part2',TRUE);
					$job_part2 = $this->mod_karir_daftar->getSectorSelf2($sector2);
					echo '
		            	<div class="col-md-6">
    						<div class="accordion accordion-bg clearfix nobottommargin">
								<div class="acctitle white" style="background-color: #343D46;">PENGALAMAN KERJA 2</div>
							</div>
							<div class="panel-body noradius">
								<table class="nomargin">
									<tr> 
										<td class="col-sm-5 bold">Nama Perusahaan</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_company2',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Bidang Perusahaan</td>
										<td class="col-sm-1">:</td>
										<td>'.$job_part2->sector_name.'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Jabatan Awal</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_billet_first2',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Jabatan Akhir</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_billet_last2',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Dari</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_from2',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">S/d</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_until2',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Gaji</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_salary2',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Alasan Keluar</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_reason2',TRUE)).'</td>
									</tr>
								</table>
							</div>
		            	</div>
				    ';
				}

				if (!empty($this->input->cookie('job_company3'))) {
					$sector3   = $this->input->cookie('job_part3',TRUE);
					$job_part3 = $this->mod_karir_daftar->getSectorSelf3($sector3);
					echo '
		            	<div class="col-md-6">
    						<div class="accordion accordion-bg clearfix nobottommargin topmargin-sm">
								<div class="acctitle white" style="background-color: #343D46;">PENGALAMAN KERJA 3</div>
							</div>
							<div class="panel-body noradius">
								<table class="nomargin">
									<tr> 
										<td class="col-sm-5 bold">Nama Perusahaan</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_company3',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Bidang Perusahaan</td>
										<td class="col-sm-1">:</td>
										<td>'.$job_part3->sector_name.'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Jabatan Awal</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_billet_first3',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Jabatan Akhir</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_billet_last3',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Dari</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_from3',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">S/d</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_until3',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Gaji</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_salary3',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Alasan Keluar</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_reason3',TRUE)).'</td>
									</tr>
								</table>
							</div>
		            	</div>
				    ';
				}

				if (!empty($this->input->cookie('job_company4'))) {
					$sector4   = $this->input->cookie('job_part4',TRUE);
					$job_part4 = $this->mod_karir_daftar->getSectorSelf4($sector4);
					echo '
		            	<div class="col-md-6">
    						<div class="accordion accordion-bg clearfix nobottommargin topmargin-sm">
								<div class="acctitle white" style="background-color: #343D46;">PENGALAMAN KERJA 4</div>
							</div>
							<div class="panel-body noradius">
								<table class="nomargin">
									<tr> 
										<td class="col-sm-5 bold">Nama Perusahaan</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_company4',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Bidang Perusahaan</td>
										<td class="col-sm-1">:</td>
										<td>'.$job_part4->sector_name.'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Jabatan Awal</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_billet_first4',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Jabatan Akhir</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_billet_last4',TRUE)).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Dari</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_from4',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">S/d</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_until4',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Gaji</td>
										<td class="col-sm-1">:</td>
										<td>'.$this->input->cookie('job_salary4',TRUE).'</td>
									</tr>
									<tr>
										<td class="col-sm-4 bold">Alasan Keluar</td>
										<td class="col-sm-1">:</td>
										<td>'.ucwords($this->input->cookie('job_reason4',TRUE)).'</td>
									</tr>
								</table>
							</div>
		            	</div>
				    ';
				}

			    echo '</div><br>';
        	}
        ?>

		<div class="accordion accordion-bg clearfix nobottommargin">
			<div class="acctitle white" style="background-color: #343D46;">PERTANYAAN</div>
		</div>
		<div class="panel-body noradius">
        	<div class="col-md-12">
        		<table class="table">
        			<tbody>
        				<?php
        					$no = 0;
							foreach ($pertanyaan as $row) {
								$no++;
        						if ($no == 3) {
        							echo '
										<tr>
											<td class="col-sm-6 nobordertop bold">'.$no.'. '.$row->recquest_question.'</td>
											<td class="nobordertop">:</td>
											<td class="col-sm-6 nobordertop">'.$this->input->cookie('question_salary',TRUE).'</td>
										</tr>
            						';
        						} elseif ($no == 6) {
        							$answer_placement = ($this->input->cookie('question_placement',TRUE) == 1) ? "Bersedia" : "Tidak Bersedia";
        							echo '
										<tr>
											<td class="col-sm-6 nobordertop bold">'.$no.'. '.$row->recquest_question.'</td>
											<td class="nobordertop">:</td>
											<td class="col-sm-6 nobordertop">'.$answer_placement.'</td>
										</tr>
            						';
        						} elseif ($no == 7) {
        							$answer_shift = ($this->input->cookie('question_shift',TRUE) == 1) ? "Bersedia" : "Tidak Bersedia";
        							echo '
										<tr>
											<td class="col-sm-6 nobordertop bold">'.$no.'. '.$row->recquest_question.'</td>
											<td class="nobordertop">:</td>
											<td class="col-sm-6 nobordertop">'.$answer_shift.'</td>
										</tr>
            						';
        						} elseif ($no == 9) {
        							echo '
										<tr>
											<td class="col-sm-6 nobordertop bold">'.$no.'. '.$row->recquest_question.'</td>
											<td class="nobordertop">:</td>
											<td class="col-sm-6 nobordertop">'.ucwords($this->input->cookie('question_ref',TRUE)).'</td>
										</tr>
            						';
        						} elseif ($no == 10) {
        							echo '
										<tr>
											<td class="col-sm-6 nobordertop bold">'.$no.'. '.$row->recquest_question.'</td>
											<td class="nobordertop">:</td>
											<td class="col-sm-6 nobordertop">'.ucwords($this->input->cookie('question_refgency',TRUE)).'</td>
										</tr>
            						';
        						} elseif ($no == 1 || $no == 2 || $no == 4 || $no == 5 || $no == 8) {
        							echo '
										<tr>
											<td class="col-sm-6 nobordertop bold">'.$no.'. '.$row->recquest_question.'</td>
											<td class="nobordertop">:</td>
											<td class="col-sm-6 nobordertop">'.ucwords($this->input->cookie('question_reg'.$no,TRUE)).'</td>
										</tr>
            						';
        						}
        					}
        				?>
        			</tbody>
        		</table>
        	</div>
        </div><br />

		<div class="accordion accordion-bg clearfix nobottommargin">
			<div class="acctitle white" style="background-color: #343D46;">AKUN</div>
		</div>
		<div class="panel-body noradius">
        	<div class="col-md-12">
        		<table class="table nobottommargin">
        			<tbody>
						<tr> 
							<td class="col-sm-4 nobordertop bold">Username</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><?=$this->input->cookie('user',TRUE);?></td>
						</tr>
						<tr> 
							<td class="col-sm-4 nobordertop bold">Password</td>
							<td class="col-sm-1 nobordertop">:</td>
							<td class="nobordertop"><h5 style="text-decoration: line-through;"><?=$this->input->cookie('password',TRUE);?></h5></td>
						</tr>
        			</tbody>
        		</table>
        		<small><i>* Mohon simpan Username dan Password Anda dengan baik. Mohon untuk tidak memberitahukan Username dan Password anda kepada siapapun agar tidak disalah gunakan kedepannya.</i></small>
        	</div>
        </div><br />

		<form action="<?php echo site_url()?>sysdaftar/save_registrasi" method="post" role="form" id="formfinal" class="nobottommargin">
		    <section id="content">
				<div class="clearfix">
					<div class="col_full nobottommargin">
						<div class="form-group nomargin">
							<input id="checkagree" class="checkbox-style" name="checkagree" type="checkbox" required>
							<label for="checkagree" class="checkbox-style-3-label checkbox-small">Dengan mendaftar saya menerima kondisi dan kebijakan yang berlaku di perusahaan ini.</label>
						</div>
						<label for="checkagree" generated="true" class="error"></label>
					</div>
				</div>
			</section><br />

	        <section id="content">
				<div class="clearfix">
					<div class="col_full nobottommargin">
						<a href="<?php echo site_url('sysdaftar/step_6')?>" class="button button-small button-rounded button-reveal button-border tleft nomargin"><i class="icon-line-arrow-left"></i><span>Sebelumnya</span></a>
						<a class="button button-small button-rounded button-reveal button-blue button-border tright nomargin pull-right" onClick="simpanregistrasi()"><i class="icon-ok"></i><span>Selesai</span></a>
					</div>
				</div>
			</section>
		</form>
		
	</div>
</section><br />

<style type="text/css"> .nobordertop { border-top: none !important; } </style>
<link rel="stylesheet" href="<?php echo siteURL();?>bssmitlab/_assets/rekrutmen/css/components/radio-checkbox.css" type="text/css" />

<script type="text/javascript">
	function deleteAllCookies() {
	    var cookies = document.cookie.split(";");

	    for (var i = 0; i < cookies.length; i++) {
	        var cookie = cookies[i];
	        var eqPos = cookie.indexOf("=");
	        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
	        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
	    }
	}

	function simpanregistrasi(){
	    if ($('#formfinal').valid() === false) {
			swal("Oops","Mohon beri tanda cek pada halaman ini", "error");
		} else {
			swal({
			  title: "Konfirmasi",
			  text: "Apakah data anda sudah benar ?",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Lanjutkan',
			  showLoaderOnConfirm: true,
			}).then((isConfirm) => {
				if (isConfirm.value) {
					$.ajax({
						url: "<?=site_url()?>sysdaftar/save_registrasi",
						type: "post",
						success:function(data){
							if (data == "Success") {
								swal({
						            title: "Naiss!",
						            text: "Selamat, anda telah terdaftar. Silahkan login untuk melamar pekerjaan dan lengkapi data diri dan upload berkas KTP, SIM dan IJAZAH anda.",
						            type: "success"
						        }).then(function(){
						            window.location = "http://bss.com/rekrutmen/syslogin/login";
						        });
						    } else {
						    	swal("Oops","Gagal menyimpan data. Reload halaman ini kemudian coba lagi", "error");
						    }
						}
					});
				}
			});
  		}
  	};
</script>