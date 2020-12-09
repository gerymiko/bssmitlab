<section id="page-title" class="page-title-mini">
	<div class="container clearfix">
		<h1 class="white">Formulir Registrasi</h1>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li>Daftar</li>	
			<li class="active" style="color: #FFF; font-weight: 700">ALAMAT &amp; SURAT IZIN MENGEMUDI (Tahap 3)</li>
		</ol>
	</div>
</section><br />

<section id="content">
	<div class="container clearfix">
		<div class="accordion accordion-bg clearfix">
			<div class="acctitle">Ketentuan dalam pengisian form pendaftaran</div>
			<div class="panel-body noradius">
				<ul class="iconlist iconlist-color nobottommargin">
					<li><i class="icon-ok"></i>Centang pada form jika jenis KTP adalah E-KTP dan berlaku seumur hidup.</li>
					<li><i class="icon-ok"></i>Keseluruhan form dengan simbol (*) wajib di isi.</li>
					<li><i class="icon-ok"></i>Alamat domisili adalah tempat tinggal yang ditempati sekarang saat ini.</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<form action="<?=site_url()?>sysdaftar/step_4" method="post" role="form" id="formlisence" class="nobottommargin">
				<div class="col-md-8">
					<div class="panel panel-default nobottommargin noradius">
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Nomor KTP <b class="red">*</b></label>
										<input type="text" id="plisence_number" name="plisence_number" maxlength="17" value="<?=$this->input->cookie('ktp',TRUE);?>" class="num required form-under-line" readonly/>
									</div>	
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Kota diterbitkan KTP <b class="red">*</b></label>
										<select name="plisence_keluaran_ktp" id="plisence_keluaran_ktp" class="js-select2 form-under-line required">
											<option value="">Pilih Kota</option>
		                                    <?php
		                                        foreach ($kota as $row) {
		                                            echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
		                                        }
		                                    ?>
		                                </select>
		                                <div id="errorTerbitan"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label class="bold">Tanggal Terbit KTP <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="datestart_ktp" id="datestart_ktp" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('datestart_ktp',TRUE);?>"  autocomplete="off" />
		                                <div id="errorBDate"></div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="bold">Jenis KTP <b class="red">*</b></label><br>
										<input id="tipektp" class="checkbox-style" name="tipektp" type="checkbox" checked="checked">
										<label for="tipektp" class="checkbox-style-3-label">Seumur Hidup</label>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="bold">Berlaku S/d</label>
										<div style="padding: 3px;"></div>
										<input type="text" name="dateend_ktp" id="dateend_ktp" class="form-under-line datepickerz" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('dateend_ktp',TRUE);?>" disabled autocomplete="off"/>
		                                <div id="errorBDate"></div>
									</div>
								</div>
							</div>
							
							<hr>

							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Alamat sesuai KTP <b class="red">*</b></label>
										<textarea rows="1" name="alamatKTP" id="alamatKTP" maxlength="100" class="alphanumeric required form-under-line" style="text-transform: capitalize;"><?=$this->input->cookie('alamatKTP',TRUE);?></textarea>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="bold">Kota <b class="red">*</b></label>
										<select name="alamat_kota_ktp" id="alamat_kota_ktp" class="js-select2 form-under-line required">
											<option value="">Pilih Kota</option>
		                                    <?php
		                                        foreach ($kota as $row) {
		                                            echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
		                                        }
		                                    ?>
		                                </select>
		                            </div>
	                                <div id="errorAlamatKTP"></div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label class="bold">Kode Pos <b class="red">*</b></label>
										<div style="padding: 2px;"></div>
										<input type="text" id="zip_code_ktp" name="zip_code_ktp" maxlength="7" value="<?=$this->input->cookie('zip_code_ktp',TRUE);?>" class="num form-under-line required" autocomplete="off" />
									</div>	
								</div>
							</div>

							<hr>
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Alamat Domisili <b class="red">*</b></label>
										<textarea rows="1" name="alamatDOM" id="alamatDOM" maxlength="100" class="alphanumeric required form-under-line" style="text-transform: capitalize;"><?=$this->input->cookie('alamatDOM',TRUE);?></textarea>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="bold">Kota <b class="red">*</b></label>
										<select name="alamat_kota_dom" id="alamat_kota_dom" class="js-select2 form-under-line required">
											<option value="">Pilih Kota</option>
		                                    <?php
		                                        foreach ($kota as $row) {
		                                            echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
		                                        }
		                                    ?>
		                                </select>
		                            </div>
	                                <div id="errorAlamatDOM"></div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label class="bold">Kode Pos <b class="red">*</b></label>
										<div style="padding: 2px;"></div>
										<input type="text" id="zip_code_dom" name="zip_code_dom" maxlength="7" value="<?=$this->input->cookie('zip_code_dom',TRUE);?>" class="num form-under-line required" autocomplete="off" />
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="panel panel-default nobottommargin noradius">
						<div class="panel-body">
							<p class="nomargin bold">Pilih jenis SIM yang anda miliki ?</p>
							<p>Anda dapat memilih lebih dari 1 SIM jika Anda memilikinya.</p>
							<div>
								<input id="simA" class="checkbox-style" name="simA" type="checkbox" value="1">
								<label for="simA" class="checkbox-style-3-label">SIM A</label>
							</div>
							<div>
								<input id="simB1" class="checkbox-style" name="simB1" type="checkbox" value="2">
								<label for="simB1" class="checkbox-style-3-label">SIM B1</label>
							</div>
							<div>
								<input id="simB2" class="checkbox-style" name="simB2" type="checkbox" value="3">
								<label for="simB2" class="checkbox-style-3-label">SIM B2</label>
							</div>
							<div>
								<input id="simB2U" class="checkbox-style" name="simB2U" type="checkbox" value="4">
								<label for="simB2U" class="checkbox-style-3-label">SIM B2 UMUM</label>
							</div>
							<div>
								<input id="simC" class="checkbox-style" name="simC" type="checkbox" value="5">
								<label for="simC" class="checkbox-style-3-label">SIM C</label>
							</div>
							<div>
								<input id="simD" class="checkbox-style" name="simD" type="checkbox" value="6">
								<label for="simD" class="checkbox-style-3-label">SIM D</label>
							</div>
							<div style="padding: 5px;"></div>
						</div>
					</div>
				</div>
		</div>
	</div>
</section><br />

<section id="content">
	<div class="container clearfix">
        <div class="row">
            <div class="sim-1" style="display:none;">
                <div class="col-md-6">
                    <div class="panel panel-default noradius">
						<div class="panel-heading">Surat Ijin Mengemudi ( SIM ) A</div>
						<div class="panel-body">
							<h6>Kendaraan Bermotor Roda Empat dan Tiga</h6>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Nomor SIM <b class="red">*</b></label>
										<input type="text" id="plisence_number_A" name="plisence_number_A" maxlength="17" value="<?=( NULL == $this->input->cookie('plisence_number_A',TRUE) || '' == $this->input->cookie('plisence_number_A',TRUE)  ? '' : $this->input->cookie('plisence_number_A',TRUE));?>" class="num required form-under-line" autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Kota diterbitkan <b class="red">*</b></label>
										<select name="kota_sim_A" id="kota_sim_A" class="js-select2 form-under-line required" style="width: 100% !important">
											<option value="">Pilih Kota</option>
						                    <?php
						                        foreach ($kota as $row) {
						                            echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
						                        }
						                    ?>
						                </select>
						            </div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Tanggal Terbit <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_start_A" id="plisence_date_start_A" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('datestart_A',TRUE);?>" autocomplete="off" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Berlaku S/d <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_end_A" id="plisence_date_end_A" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('dateend_A',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="sim-2" style="display:none;">
                <div class="col-6 col-sm-6">
                    <div class="panel panel-default noradius">
						<div class="panel-heading">Surat Ijin Mengemudi ( SIM ) B1</div>
						<div class="panel-body">
							<h6>Kendaraan Bermotor Dengan Berat 1000 Kg</h6>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Nomor SIM <b class="red">*</b></label>
										<input type="text" id="plisence_number_B1" name="plisence_number_B1" maxlength="17" value="<?=( NULL == $this->input->cookie('plisence_number_B1',TRUE) || '' == $this->input->cookie('plisence_number_B1',TRUE)  ? '' : $this->input->cookie('plisence_number_B1',TRUE));?>" class="num required form-under-line" autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Kota diterbitkan <b class="red">*</b></label>
										<select name="kota_sim_B1" id="kota_sim_B1" class="js-select2 form-under-line required" style="width: 100% !important">
											<option value="0">Pilih Kota</option>
						                    <?php
						                        foreach ($kota as $row) {
						                            echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
						                        }
						                    ?>
						                </select>
						            </div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Tanggal Terbit <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_start_B1" id="plisence_date_start_B1" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('datestart_B1',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Berlaku S/d <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_end_B1" id="plisence_date_end_B1" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('dateend_B1',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="sim-3" style="display:none;">
                <div class="col-6 col-sm-6">
                    <div class="panel panel-default noradius">
						<div class="panel-heading">Surat Ijin Mengemudi ( SIM ) B2</div>
						<div class="panel-body">
							<h6>Kendaraan Bermotor Dengan Berat 1000 Kg</h6>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Nomor SIM <b class="red">*</b></label>
										<input type="text" id="plisence_number_B2" name="plisence_number_B2" maxlength="17" value="<?=( NULL == $this->input->cookie('plisence_number_B2',TRUE) || '' == $this->input->cookie('plisence_number_B2',TRUE)  ? '' : $this->input->cookie('plisence_number_B2',TRUE));?>" class="num required form-under-line" autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Kota diterbitkan <b class="red">*</b></label>
										<select name="kota_sim_B2" id="kota_sim_B2" class="js-select2 form-under-line required" style="width: 100% !important">
											<option value="0">Pilih Kota</option>
						                    <?php
						                        foreach ($kota as $row) {
						                            echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
						                        }
						                    ?>
						                </select>
						            </div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Tanggal Terbit <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_start_B2" id="plisence_date_start_B2" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('datestart_B2',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Berlaku S/d <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_end_B2" id="plisence_date_end_B2" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('dateend_B2',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="sim-4" style="display:none;">
                <div class="col-6 col-sm-6">
                	<div class="panel panel-default noradius">
						<div class="panel-heading">Surat Ijin Mengemudi ( SIM ) B2 Umum</div>
						<div class="panel-body">
							<h6>Kendaraan penarik atau Kendaraan Bermotor dengan gandengan dengan berat > 1.000 kg</h6>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Nomor SIM <b class="red">*</b></label>
										<input type="text" id="plisence_number_B2U" name="plisence_number_B2U" maxlength="17" value="<?=( NULL == $this->input->cookie('plisence_number_B2U',TRUE) || '' == $this->input->cookie('plisence_number_B2U',TRUE)  ? '' : $this->input->cookie('plisence_number_B2U',TRUE));?>" class="num required form-under-line" autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Kota diterbitkan <b class="red">*</b></label>
										<select name="kota_sim_B2U" id="kota_sim_B2U" class="js-select2 form-under-line required" style="width: 100% !important">
											<option value="0">Pilih Kota</option>
						                    <?php
						                        foreach ($kota as $row) {
						                            echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
						                        }
						                    ?>
						                </select>
						            </div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Tanggal Terbit <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_start_B2U" id="plisence_date_start_B2U" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('datestart_B2U',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Berlaku S/d <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_end_B2U" id="plisence_date_end_B2U" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('dateend_B2U',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="sim-5" style="display:none;">
                <div class="col-6 col-sm-6">
                    <div class="panel panel-default noradius">
						<div class="panel-heading">Surat Ijin Mengemudi ( SIM ) C</div>
						<div class="panel-body">
							<h6>Kendaraan Bermotor Roda Dua</h6>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Nomor SIM <b class="red">*</b></label>
										<input type="text" id="plisence_number_C" name="plisence_number_C" maxlength="17" value="<?=( NULL == $this->input->cookie('plisence_number_C',TRUE) || '' == $this->input->cookie('plisence_number_C',TRUE)  ? '' : $this->input->cookie('plisence_number_C',TRUE));?>" class="num required form-under-line"  autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Kota diterbitkan <b class="red">*</b></label>
										<select name="kota_sim_C" id="kota_sim_C" class="js-select2 form-under-line required" style="width: 100% !important">
											<option value="0">Pilih Kota</option>
						                    <?php
						                        foreach ($kota as $row) {
						                            echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
						                        }
						                    ?>
						                </select>
						            </div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Tanggal Terbit <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_start_C" id="plisence_date_start_C" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('datestart_C',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Berlaku S/d <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_end_C" id="plisence_date_end_C" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('dateend_C',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="sim-6" style="display:none;">
                <div class="col-6 col-sm-6">
                    <div class="panel panel-default noradius">
						<div class="panel-heading">Surat Ijin Mengemudi ( SIM ) D</div>
						<div class="panel-body">
							<h6>Kendaraan Bermotor Untuk Penyandang Cacat</h6>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Nomor SIM <b class="red">*</b></label>
										<input type="text" id="plisence_number_D" name="plisence_number_D" maxlength="17" value="<?=( NULL == $this->input->cookie('plisence_number_D',TRUE) || '' == $this->input->cookie('plisence_number_D',TRUE)  ? '' : $this->input->cookie('plisence_number_D',TRUE));?>" class="num required form-under-line" autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Kota diterbitkan <b class="red">*</b></label>
										<select name="kota_sim_D" id="kota_sim_D" class="js-select2 form-under-line required" style="width: 100% !important">
											<option value="0">Pilih Kota</option>
						                    <?php
						                        foreach ($kota as $row) {
						                            echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
						                        }
						                    ?>
						                </select>
						            </div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Tanggal Terbit <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_start_D" id="plisence_date_start_D" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('datestart_D',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Berlaku S/d <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="plisence_date_end_D" id="plisence_date_end_D" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('dateend_D',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
	</div>
</section>

<section id="content">
	<div class="container clearfix">
		<div class="col_full nobottommargin">
			<a href="<?=site_url('sysdaftar/step_2')?>" class="button button-small button-rounded button-reveal button-border tleft nomargin"><i class="icon-line-arrow-left"></i><span>Sebelumnya</span></a>
			<button class="button button-small button-rounded button-reveal button-border tright nomargin pull-right" type="submit"><i class="icon-line-arrow-right"></i><span>Selanjutnya</span></button>
		</div>
	</form>
	</div>
</section><br />

<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/rekrutmen/css/components/radio-checkbox.css" type="text/css" />
<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/select2/select2.min.css" type="text/css" />
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/select2/select2.min.js"></script>
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/global/alphanum/jquery.alphanum.js"></script>
<style type="text/css"> .select2 { width: 100% !important; } </style>

<?php 
	$pesan = $this->session->flashdata('pesan');
	if (isset($pesan)){ ?>
	<script>
	  $(document).ready(function(){
	      swal({   
	        title: "<?= $pesan["title"]; ?>",   
	        text: "<?= $pesan["message"]; ?>",
	        type: "<?= $pesan['class']; ?>",   
	        confirmButtonText: "Ok" 
	      });
	  });    
	</script>
<?php } ?>

<script type="text/javascript">
	$('.js-select2').select2({
		placeholder: "Pilih kota",
	});
	$("#plisence_keluaran_ktp").val(<?=($this->input->cookie('kota_ktp',TRUE) !== null) ? $this->input->cookie('kota_ktp',TRUE) : 0;?>).trigger('change');
	$("#alamat_kota_ktp").val(<?=($this->input->cookie('alamat_kota_ktp',TRUE) !== null) ? $this->input->cookie('alamat_kota_ktp',TRUE) : 0;?>).trigger('change');
	$("#alamat_kota_dom").val(<?=($this->input->cookie('alamat_kota_dom',TRUE) !== null) ? $this->input->cookie('alamat_kota_dom',TRUE) : 0;?>).trigger('change');

	$("#kota_sim_A").val(<?=($this->input->cookie('kota_sim_A',TRUE) !== null) ? $this->input->cookie('kota_sim_A',TRUE) : 0;?>).trigger('change');
	$("#kota_sim_B1").val(<?=($this->input->cookie('kota_sim_B1',TRUE) !== null) ? $this->input->cookie('kota_sim_B1',TRUE) : 0;?>).trigger('change');
	$("#kota_sim_B2").val(<?=($this->input->cookie('kota_sim_B2',TRUE) !== null) ? $this->input->cookie('kota_sim_B2',TRUE) : 0;?>).trigger('change');
	$("#kota_sim_B2U").val(<?=($this->input->cookie('kota_sim_B2U',TRUE) !== null) ? $this->input->cookie('kota_sim_B2U',TRUE) : 0;?>).trigger('change');
	$("#kota_sim_C").val(<?=($this->input->cookie('kota_sim_C',TRUE) !== null) ? $this->input->cookie('kota_sim_C',TRUE) : 0;?>).trigger('change');
	$("#kota_sim_D").val(<?=($this->input->cookie('kota_sim_D',TRUE) !== null) ? $this->input->cookie('kota_sim_D',TRUE) : 0;?>).trigger('change');

	$(document).ready(function () {
		var validobj = $('#formlisence').validate({
			onkeyup: false,
	        errorClass: "error",

		    highlight: function (element, errorClass, validClass) {
	            var elem = $(element);
	            if (elem.hasClass("select2-offscreen")) {
	                $("#s2id_" + elem.attr("id") + " ul").addClass(errorClass);
	            } else {
	                elem.addClass(errorClass);
	            }
	        },

	        unhighlight: function (element, errorClass, validClass) {
	            var elem = $(element);
	            if (elem.hasClass("select2-offscreen")) {
	                $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
	            } else {
	                elem.removeClass(errorClass);
	            }
	        },

		    errorPlacement: function(error, element) {
			    if (element.attr("name") == "plisence_keluaran_ktp") {
			    	error.insertAfter('#errorTerbitan');
			  	} else if(element.attr("name") == "alamat_kota_ktp") {
			  		error.insertAfter('#errorAlamatKTP');
			  	} else if(element.attr("name") == "alamat_kota_dom") {
			  		error.insertAfter('#errorAlamatDOM');
			  	} else {
			  		error.insertAfter(element);
			  	}
			},
		});

		$(document).on("change", ".select2-offscreen", function () {
	        if (!$.isEmptyObject(validobj.submitted)) {
	            validobj.form();
	        }
	    });

	    $(document).on("select2-opening", function (arg) {
	        var elem = $(arg.target);
	        if ($("#s2id_" + elem.attr("id") + " ul").hasClass("error")) {
	            $(".select2-drop ul").addClass("error");
	        } else {
	            $(".select2-drop ul").removeClass("error");
	        }
	    });

	    jQuery.extend(jQuery.validator.messages, {
		    required: "Kolom ini wajib diisi.",
		    remote: "Silakan perbaiki kolom ini.",
		    email: "Format email salah.",
		    url: "Format URL salah.",
		    date: "Harap masukkan tanggal yang benar.",
		    dateISO: "Harap masukkan tanggal yang benar (ISO).",
		    number: "Harap masukkan nomor yang benar.",
		    digits: "Harap masukkan hanya angka.",
		    equalTo: "Silakan masukkan nilai yang sama lagi.",
		    accept: "Harap masukkan nilai dengan ekstensi yang benar.",
		    maxlength: jQuery.validator.format("Harap masukkan tidak lebih dari {0} karakter."),
		    minlength: jQuery.validator.format("Harap masukkan setidaknya {0} karakter."),
		    rangelength: jQuery.validator.format("Masukkan nilai antara {0} dan {1} karakter."),
		    range: jQuery.validator.format("Harap masukkan nilai antara {0} dan {1}."),
		    max: jQuery.validator.format("Harap masukkan nilai kurang dari atau sama dengan {0}."),
		    min: jQuery.validator.format("Harap masukkan nilai yang lebih besar dari atau sama dengan {0}.")
		});
	});

	$(function() {
	    if ($("#tipektp").is(":checked")) {
	        $("#dateend_ktp").attr("disabled", "disabled");
	    }
	    $("#tipektp").click(function() {
	        var ep = $("#dateend_ktp");
	        if (ep) {
	            ep.removeAttr("disabled");
	            if (this.checked) {
	                ep.attr("disabled", "disabled");
	            }
	        }
	    });
	});

	$(function() {
        $('.datepickerz').datepicker({
			autoclose: true,
			format: "dd-mm-yyyy",
			todayHighlight: true,
			startView: 2,
			daysOfWeekHighlighted: "0"
		});
	});

	$('.alpha').alphanum({allowNumeric: false});
	$('.num').numeric();

	$(function() {
		if(localStorage.simA   == null) localStorage.simA   = "false";
		if(localStorage.simB1  == null) localStorage.simB1  = "false";
		if(localStorage.simB2  == null) localStorage.simB2  = "false";
		if(localStorage.simB2U == null) localStorage.simB2U = "false";
		if(localStorage.simC   == null) localStorage.simC   = "false";
		if(localStorage.simD   == null) localStorage.simD   = "false";
	      
	    $('#simA')
	        .prop('checked', localStorage.simA == "true")
	        .on('change', function() {
	        localStorage.simA = this.checked;
	        if(localStorage.simA == "true") {
	            $('.sim-1').show();
	        } else {
	            $('.sim-1').hide();
	            var cookie_name = 'plisence_number_A';
	        }
	    })
	    .trigger('change');
	        
	    $('#simB1')
	        .prop('checked', localStorage.simB1 == "true")
	        .on('change', function() {
	        localStorage.simB1 = this.checked;
	        if(localStorage.simB1 == "true") {
	            $('.sim-2').show();
	        } else {
	            $('.sim-2').hide();
	        }
	    })
	    .trigger('change');

	    $('#simB2')
	        .prop('checked', localStorage.simB2 == "true")
	        .on('change', function() {
	        localStorage.simB2 = this.checked;
	        if(localStorage.simB2 == "true") {
	            $('.sim-3').show();
	        } else {
	            $('.sim-3').hide();
	        }
	    })
	    .trigger('change');

	    $('#simB2U')
	        .prop('checked', localStorage.simB2U == "true")
	        .on('change', function() {
	        localStorage.simB2U = this.checked;
	        if(localStorage.simB2U == "true") {
	            $('.sim-4').show();
	        } else {
	            $('.sim-4').hide();
	        }
	    })
	    .trigger('change');

	    $('#simC')
	        .prop('checked', localStorage.simC == "true")
	        .on('change', function() {
	        localStorage.simC = this.checked;
	        if(localStorage.simC == "true") {
	            $('.sim-5').show();
	        } else {
	            $('.sim-5').hide();
	        }
	    })
	    .trigger('change');

	    $('#simD')
	        .prop('checked', localStorage.simD == "true")
	        .on('change', function() {
	        localStorage.simD = this.checked;
	        if(localStorage.simD == "true") {
	            $('.sim-6').show();
	        } else {
	            $('.sim-6').hide();
	        }
	    })
	    .trigger('change');
	});
</script>