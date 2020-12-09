<section id="page-title" class="page-title-mini">
	<div class="container clearfix">
		<h1 class="white">Formulir Registrasi</h1>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li>Daftar</li>	
			<li class="active" style="color: #FFF; font-weight: 700">PENGALAMAN KERJA (Tahap 5)</li>
		</ol>
	</div>
</section><br />

<form action="<?=site_url()?>sysdaftar/step_6" method="post" role="form" id="formjobhis" class="nobottommargin">
	<section id="content">
		<div class="container clearfix">
			<div class="row">
				<div class="col-md-4">
					<div class="accordion accordion-bg clearfix">
						<div class="acctitle">Ketentuan dalam pengisian form pendaftaran</div>
						<div class="panel-body noradius">
							<ul class="iconlist iconlist-color nobottommargin">
								<li><i class="icon-ok"></i>Isi data <b>Pengalaman Kerja</b> di perusahaan terkahir Anda.</li>
								<li><i class="icon-ok"></i>Jika tidak memiliki pengalaman kerja atau termasuk lulusan baru (<b>FRESH GRADUATE</b>) <b>LEWATI</b> langkah ini.</li>
								<li><i class="icon-ok"></i>Keseluruhan form dengan simbol (*) wajib di isi.</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<p class="nobottommargin bold">Apakah anda memiliki pengalaman pekerjaan ? <b class="red">*</b></p>
					<div class="row">
						<div class="col-sm-4">
							<input class="radio-style required" type="radio" id="hasJobYa" name="hasJob" value="1" onclick="show1();">
							<label class="radio-style-2-label radio-small" for="hasJobYa">Ya</label>
						</div>
						<div class="col-sm-4">
							<input class="radio-style" type="radio" id="hasJobNo" name="hasJob" value="2" onclick="show2();">
							<label class="radio-style-2-label radio-small" for="hasJobNo">Tidak</label>
						</div>
					</div>
					<div id="contoh" class="content">
						<br />
						<div id="div1" class="hasJobYa" style="display: none;">
							<div class="clearfix nobottommargin bg-gray">
								<div class="acctitle acctitlec uppercase">Pengalaman Pekerjaan 1</div>
							</div>
							<div class="panel panel-default nobottommargin noradius tespang">
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Nama Perusahaan <b class="red">*</b></label>
												<input type="text" id="job_company1" name="job_company1" maxlength="100" value="<?=$this->input->cookie('job_company1',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Bidang Perusahaan <b class="red">*</b></label>
												<select name="job_part1" id="job_part1" class="select_job form-under-line required">
													<option value="">Pilih Bidang</option>
				                                    <?php
				                                        foreach ($sector as $row) {
				                                            echo '<option value="'.$row->sector_id.'">'.$row->sector_name.'</option>';
				                                        }
				                                    ?>
				                                </select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Jabatan Awal <b class="red">*</b></label>
												<input type="text" id="job_billet_first1" name="job_billet_first1" maxlength="100" value="<?=$this->input->cookie('job_billet_first1',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Jabatan Akhir <b class="red">*</b></label>
												<input type="text" id="job_billet_last1" name="job_billet_last1" maxlength="100" value="<?=$this->input->cookie('job_billet_last1',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Dari <b class="red">*</b></label>
												<input type="text" name="job_from1" id="job_from1" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('job_from1',TRUE);?>" autocomplete="off"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Sampai <b class="red">*</b></label>
												<input type="text" name="job_until1" id="job_until1" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('job_until1',TRUE);?>" autocomplete="off"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Gaji Akhir <b class="red">*</b></label>
												<input type="text" id="job_salary1" name="job_salary1" maxlength="100" value="<?=$this->input->cookie('job_salary1',TRUE);?>" class="num form-under-line required" autocomplete="off" />
												<i>* Hanya Angka ( Contoh : 8000000 )</i>
											</div>

										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Alasan Keluar <b class="red">*</b></label>
												<textarea rows="1" id="job_reason1" name="job_reason1" maxlength="150" class="alpha form-under-line required" style="text-transform: capitalize;"><?=$this->input->cookie('job_reason1',TRUE);?></textarea>
												<i>Jika masih bekerja diperusahaan ini mohon isi (Masih Bekerja)</i>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div>
								<input id="jobhis2" class="checkbox-style" name="jobhis2" type="checkbox" value="2">
								<label for="jobhis2" class="checkbox-style-3-label">Tambah Pengalaman  <i>( * Cek untuk menambahkan form )</i></label>
							</div>
						</div>
						<div class="jobhis2" style="display: none;">
							<div class="clearfix nobottommargin bg-gray">
								<div class="acctitle acctitlec uppercase">Pengalaman Pekerjaan 2</div>
							</div>
							<div class="panel panel-default nobottommargin noradius">
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Nama Perusahaan <b class="red">*</b></label>
												<input type="text" id="job_company2" name="job_company2" maxlength="100" value="<?=$this->input->cookie('job_company2',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Bidang Perusahaan <b class="red">*</b></label>
												<select name="job_part2" id="job_part2" class="select_job form-under-line required">
													<option value="">Pilih Bidang</option>
				                                    <?php
				                                        foreach ($sector as $row) {
				                                            echo '<option value="'.$row->sector_id.'">'.$row->sector_name.'</option>';
				                                        }
				                                    ?>
				                                </select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Jabatan Awal <b class="red">*</b></label>
												<input type="text" id="job_billet_first2" name="job_billet_first2" maxlength="100" value="<?=$this->input->cookie('job_billet_first2',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Jabatan Akhir <b class="red">*</b></label>
												<input type="text" id="job_billet_last2" name="job_billet_last2" maxlength="100" value="<?=$this->input->cookie('job_billet_last2',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Dari <b class="red">*</b></label>
												<input type="text" name="job_from2" id="job_from2" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('job_from2',TRUE);?>" autocomplete="off"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Sampai <b class="red">*</b></label>
												<input type="text" name="job_until2" id="job_until2" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('job_until2',TRUE);?>" autocomplete="off"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Gaji Akhir <b class="red">*</b></label>
												<input type="text" id="job_salary2" name="job_salary2" maxlength="100" value="<?=$this->input->cookie('job_salary2',TRUE);?>" class="num form-under-line required" autocomplete="off"/>
												<i>* Hanya Angka (8000000)</i>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Alasan Keluar <b class="red">*</b></label>
												<textarea rows="1" id="job_reason2" name="job_reason2" maxlength="150" class="alpha form-under-line required" style="text-transform: capitalize;"><?=$this->input->cookie('job_reason2',TRUE);?></textarea>
												<i>Jika masih bekerja diperusahaan ini mohon isi (Masih Bekerja)</i>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div>
								<input id="jobhis3" class="checkbox-style" name="jobhis3" type="checkbox" value="2">
								<label for="jobhis3" class="checkbox-style-3-label">Tambah Pengalaman  <i>( * Cek untuk menambahkan form )</i></label>
							</div>
						</div>
						<div class="jobhis3" style="display: none;">
							<div class="clearfix nobottommargin bg-gray">
								<div class="acctitle acctitlec uppercase">Pengalaman Pekerjaan 3</div>
							</div>
							<div class="panel panel-default nobottommargin noradius">
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Nama Perusahaan <b class="red">*</b></label>
												<input type="text" id="job_company3" name="job_company3" maxlength="100" value="<?=$this->input->cookie('job_company3',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Bidang Perusahaan <b class="red">*</b></label>
												<select name="job_part3" id="job_part3" class="select_job form-under-line required">
													<option value="">Pilih Bidang</option>
				                                    <?php
				                                        foreach ($sector as $row) {
				                                            echo '<option value="'.$row->sector_id.'">'.$row->sector_name.'</option>';
				                                        }
				                                    ?>
				                                </select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Jabatan Awal <b class="red">*</b></label>
												<input type="text" id="job_billet_first3" name="job_billet_first3" maxlength="100" value="<?=$this->input->cookie('job_billet_first3',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Jabatan Akhir <b class="red">*</b></label>
												<input type="text" id="job_billet_last3" name="job_billet_last3" maxlength="100" value="<?=$this->input->cookie('job_billet_last3',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Dari <b class="red">*</b></label>
												<input type="text" name="job_from3" id="job_from3" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('job_from3',TRUE);?>" autocomplete="off"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Sampai <b class="red">*</b></label>
												<input type="text" name="job_until3" id="job_until3" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('job_until3',TRUE);?>" autocomplete="off"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Gaji Akhir <b class="red">*</b></label>
												<input type="text" id="job_salary3" name="job_salary3" maxlength="100" value="<?=$this->input->cookie('job_salary3',TRUE);?>" class="num form-under-line required" autocomplete="off"/>
												<i>* Hanya Angka (8000000)</i>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Alasan Keluar <b class="red">*</b></label>
												<textarea rows="1" id="job_reason3" name="job_reason3" maxlength="150" class="alpha form-under-line required" style="text-transform: capitalize;"><?=$this->input->cookie('job_reason3',TRUE);?></textarea>
												<i>Jika masih bekerja diperusahaan ini mohon isi (Masih Bekerja)</i>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div>
								<input id="jobhis4" class="checkbox-style" name="jobhis4" type="checkbox" value="2">
								<label for="jobhis4" class="checkbox-style-3-label">Tambah Pengalaman  <i>( * Cek untuk menambahkan form )</i></label>
							</div>
						</div>
						<div class="jobhis4" style="display: none;">
							<div class="clearfix nobottommargin bg-gray">
								<div class="acctitle acctitlec uppercase">Pengalaman Pekerjaan 4</div>
							</div>
							<div class="panel panel-default nobottommargin noradius">
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Nama Perusahaan <b class="red">*</b></label>
												<input type="text" id="job_company4" name="job_company4" maxlength="100" value="<?=$this->input->cookie('job_company4',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Bidang Perusahaan <b class="red">*</b></label>
												<select name="job_part4" id="job_part4" class="select_job form-under-line required">
													<option value="">Pilih Bidang</option>
				                                    <?php
				                                        foreach ($sector as $row) {
				                                            echo '<option value="'.$row->sector_id.'">'.$row->sector_name.'</option>';
				                                        }
				                                    ?>
				                                </select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Jabatan Awal <b class="red">*</b></label>
												<input type="text" id="job_billet_first4" name="job_billet_first4" maxlength="100" value="<?=$this->input->cookie('job_billet_first4',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Jabatan Akhir <b class="red">*</b></label>
												<input type="text" id="job_billet_last4" name="job_billet_last4" maxlength="100" value="<?=$this->input->cookie('job_billet_last4',TRUE);?>" class="alpha form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Dari <b class="red">*</b></label>
												<input type="text" name="job_from4" id="job_from4" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('job_from4',TRUE);?>" autocomplete="off"/>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Sampai <b class="red">*</b></label>
												<input type="text" name="job_until4" id="job_until4" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('job_until4',TRUE);?>" autocomplete="off"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Gaji Akhir <b class="red">*</b></label>
												<input type="text" id="job_salary4" name="job_salary4" maxlength="100" value="<?=$this->input->cookie('job_salary4',TRUE);?>" class="num form-under-line required" autocomplete="off"/>
												<i>* Hanya Angka (8000000)</i>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="bold">Alasan Keluar <b class="red">*</b></label>
												<textarea rows="1" id="job_reason4" name="job_reason4" maxlength="150" class="alpha form-under-line required" style="text-transform: capitalize;"><?=$this->input->cookie('job_reason4',TRUE);?></textarea>
												<i>Jika masih bekerja diperusahaan ini mohon isi (Masih Bekerja)</i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- col-md-8 -->
			</div>
		</div>
	</section><br />

	<section id="content">
		<div class="container clearfix">
			<div class="col_full nobottommargin">
				<a href="<?=site_url('sysdaftar/step_4')?>" class="button button-small button-rounded button-reveal button-border tleft nomargin"><i class="icon-line-arrow-left"></i><span>Sebelumnya</span></a>
				<button class="button button-small button-rounded button-reveal button-border tright nomargin pull-right" type="submit"><i class="icon-line-arrow-right"></i><span>Selanjutnya</span></button>
			</div>
		</div>
	</section>
</form><br />

<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/select2/select2.min.css" type="text/css" />
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/select2/select2.min.js"></script>
<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/rekrutmen/css/components/radio-checkbox.css" type="text/css" />
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/global/alphanum/jquery.alphanum.js"></script>
<style type="text/css"> .select2 { width: 100% !important; } </style>

<?php 
	$pesan = $this->session->flashdata('pesan');
	if (isset($pesan)){ ?>
	<script>
	  $(document).ready(function(){
	      swal({   
	        title: "<?=$pesan["title"]; ?>",   
	        text: "<?=$pesan["message"]; ?>",
	        type: "<?=$pesan['class']; ?>",   
	        confirmButtonText: "Ok" 
	      });
	  });    
	</script>
<?php } ?>

<script type="text/javascript">
	$(function() {
        $('.datepickerz').datepicker({
			autoclose: true,
			format: "dd-mm-yyyy",
			todayHighlight: true,
			startView: 2,
			daysOfWeekHighlighted: "0"
		});
	});
	$('#formjobhis').validate();
	jQuery.extend(jQuery.validator.messages, { required: "Kolom ini wajib diisi." });
	$('.alpha').alphanum({allowNumeric: true});
	$('.num').numeric();
	$('.select_job').select2({ placeholder: "Pilih Bidang" });
	$("#job_part1").val(<?=($this->input->cookie('job_part1',TRUE) !== null) ? $this->input->cookie('job_part1',TRUE) : 0;?>).trigger('change');
	$("#job_part2").val(<?=($this->input->cookie('job_part2',TRUE) !== null) ? $this->input->cookie('job_part2',TRUE) : 0;?>).trigger('change');
	$("#job_part3").val(<?=($this->input->cookie('job_part3',TRUE) !== null) ? $this->input->cookie('job_part3',TRUE) : 0;?>).trigger('change');
	$("#job_part4").val(<?=($this->input->cookie('job_part4',TRUE) !== null) ? $this->input->cookie('job_part4',TRUE) : 0;?>).trigger('change');

	function show1(){
		document.getElementById('div1').style.display ='block';
	}
	function show2(){
		document.getElementById('div1').style.display = 'none';
	}

	$(function() {
		if(localStorage.hasJobYa == null) localStorage.hasJobYa  = "false";
		if(localStorage.jobhis2  == null) localStorage.jobhis2   = "false";
		if(localStorage.jobhis3  == null) localStorage.jobhis3   = "false";
		if(localStorage.jobhis4  == null) localStorage.jobhis4   = "false";

		$('#hasJobYa')
	        .prop('checked', localStorage.hasJobYa == "true")
	        .on('change', function() {
	        localStorage.hasJobYa = this.checked;
	        if(localStorage.hasJobYa == "true") {
	            $('.hasJobYa').show();
	        } else {
	            $('.hasJobYa').hide();
	        }
	    })
	    .trigger('change');
	      
	    $('#jobhis2')
	        .prop('checked', localStorage.jobhis2 == "true")
	        .on('change', function() {
	        localStorage.jobhis2 = this.checked;
	        if(localStorage.jobhis2 == "true") {
	            $('.jobhis2').show();
	        } else {
	            $('.jobhis2').hide();
	        }
	    })
	    .trigger('change');

	    $('#jobhis3')
	        .prop('checked', localStorage.jobhis3 == "true")
	        .on('change', function() {
	        localStorage.jobhis3 = this.checked;
	        if(localStorage.jobhis3 == "true") {
	            $('.jobhis3').show();
	        } else {
	            $('.jobhis3').hide();
	        }
	    })
	    .trigger('change');

	    $('#jobhis4')
	        .prop('checked', localStorage.jobhis4 == "true")
	        .on('change', function() {
	        localStorage.jobhis4 = this.checked;
	        if(localStorage.jobhis4 == "true") {
	            $('.jobhis4').show();
	        } else {
	            $('.jobhis4').hide();
	        }
	    })
	    .trigger('change');
	});
</script>
