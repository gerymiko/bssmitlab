<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Tahap Interview</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-danger btn-sm" id="btn_back_applicant">
					<span data-toggle="tooltip" title="Daftar pelamar">Kembali</span>
				</button>
			</div>
		</div>
		<form role="form" id="form_interview" method="post" action="#">
			<input type="hidden" name="people_id" value="<?=$this->my_encryption->encode($detail->people_id)?>">
			<input type="hidden" name="interview_id" value="<?=$this->my_encryption->encode($detail->interview_id)?>">
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Nama Pelamar</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fas fa-user-tie"></i>
								</div>
								<input class="form-control _CalPhaNum required pull-right" value="<?=$detail->people_fullname?>" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Kode</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fas fa-qrcode"></i>
								</div>
								<input class="form-control _CalPhaNum required pull-right" value="<?=$detail->people_noreg?>" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Jabatan</label>
							<select class="form-control select2 required" name="jabatan" id="jabatan">
	                            <option></option>
	                            <?php
	                            	foreach ($listjabatan as $row){
	                            		echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.' ['.$row->departemen.']</option>';
	                            	}
	                            ?>
	                        </select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Site</label>
							<select class="form-control select2 required" name="interview_site" id="interview_site">
				                <option></option>
				                <?php
		                        	foreach ($listsite as $row) {
		                        		echo '<option value="'.$row->KodeST.'">'.$row->NamaST.' ['.$row->KodeST.']</option>';
		                        	}
		                        ?>
				            </select>
						</div>
					</div>
				</div>
				<div id="content-step" class="box box-custom">
					<div class="box-header with-border">
						<h5 class="no-margin ls3">PILIH TAHAP SELEKSI</h5>
					</div>
					<div class="box-body">
						<?php
							if ($dinterview !== false) {
								$berkas    = ($dinterview->berkas == 1 && $dinterview->berkas_periksa == 1) ? "disabled checked" : "";
								$hrdteknis = ($dinterview->hrdteknis == 1 && $dinterview->interview_status == 1) ? "disabled" : "";
								$teori   = ($dinterview->teori == 1 && $dinterview->interview_status == 1) ? "disabled" : "";
								$praktek = ($dinterview->praktek == 1 && $dinterview->interview_status == 1) ? "disabled" : "";
							} else {
								$berkas= "";$hrdteknis = "";$teori= "";$praktek= "";
							}
						?>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<div class="checkbox">
			                            <label><input type="checkbox" name="test_type[]" id="test_file" value="1" <?=$berkas?> >Berkas</label>
			                        </div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="checkbox">
			                            <label><input type="checkbox" name="test_type[]" id="test_hrd" value="2" <?=$hrdteknis?> >Interview HRD &amp; Teknis</label>
			                        </div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="checkbox">
			                            <label><input type="checkbox" name="test_type[]" id="test_theory" value="3" <?=$teori?> >Tes Teori</label>
			                        </div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="checkbox">
			                            <label><input type="checkbox" name="test_type[]" id="test_practice" value="4" <?=$praktek?> >Tes Praktek</label>
			                        </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="content-desc" class="box box-custom">
					<div class="box-header with-border">
						<h5 class="no-margin ls3">KETERANGAN INTERVIEW</h5>
					</div>
					<div class="box-body">
						<div  class="row">
							<?php
								if ($dinterview !== false) {
									if ($dinterview->berkas == 1) {
										$periksa = ($dinterview->berkas_periksa == 1) ? "Berkas sudah diperiksa" : "Berkas belum diperiksa";
										echo '
											<div class="col-md-3">
												<label>Berkas</label>
												<ol style="padding-inline-start: 20px;">
													<li>'.$periksa.'</li>
													<li>Tanggal : '.date("d-m-Y", strtotime($dinterview->berkas_date)).'</li>
													<li>PIC : '.$dinterview->berkas_pic.'</li>
													<li>Keterangan : '.$dinterview->berkas_conclusion_desc.'</li>
													<li>Deskripsi : '.$dinterview->berkas_description.'</li>
													<li>Referensi : '.$dinterview->berkas_reference.'</li>
												</ol>
											</div>
										';
									} else {
										echo '
											<div class="col-md-3">
												<label>Berkas</label>
												<p>-</p>
											</div>
										';
									}
									if ($dinterview->hrdteknis == 1) {
										echo '
											<div class="col-md-3">
												<label>Interview HRD &amp; Teknis</label>
												<ol style="padding-inline-start: 20px;">
													<li>Tanggal Interview : '.date("d-m-Y", strtotime($dinterview->hrdteknis_date)).'</li>
													<li>PIC HRD : '.$dinterview->hrd_pic.'</li>
													<li>PIC Teknis : '.$dinterview->teknis_pic.'</li>
													<li>Keterangan : '.$dinterview->hrdteknis_conclusion_desc.'</li>
													<li>Deskripsi : '.$dinterview->hrdteknis_description.'</li>
													<li>Referensi : '.$dinterview->hrdteknis_reference.'</li>
												</ol>
											</div>
										';
									} else {
										echo '
											<div class="col-md-3">
												<label>Interview HRD &amp; Teknis</label>
												<p>-</p>
											</div>
										';
									}
									if ($dinterview->teori == 1) {
										echo '
											<div class="col-md-3">
												<label>Tes Teori</label>
												<ol style="padding-inline-start: 20px;">
													<li>Tanggal Tes : '.date("d-m-Y", strtotime($dinterview->teori_date)).'</li>
													<li>PIC Teori : '.$dinterview->teori_pic.'</li>
													<li>Keterangan : '.$dinterview->teori_conclusion_desc.'</li>
													<li>Deskripsi : '.$dinterview->teori_description.'</li>
													<li>Referensi : '.$dinterview->teori_reference.'</li>
												</ol>
											</div>
										';
									} else {
										echo '
											<div class="col-md-3">
												<label>Tes Teori</label>
												<p>-</p>
											</div>
										';
									}
									if ($dinterview->praktek == 1) {
										echo '
											<div class="col-md-3">
												<label>Tes Praktek</label>
												<ol style="padding-inline-start: 20px;">
													<li>Tanggal Tes : '.date("d-m-Y", strtotime($dinterview->praktek_date)).'</li>
													<li>PIC Praktek : '.$dinterview->praktek_pic.'</li>
													<li>Keterangan : '.$dinterview->praktek_conclusion_desc.'</li>
													<li>Deskripsi : '.$dinterview->praktek_description.'</li>
													<li>Referensi : '.$dinterview->praktek_reference.'</li>
												</ol>
											</div>
										';
									} else {
										echo '
											<div class="col-md-3">
												<label>Tes Praktek</label>
												<p>-</p>
											</div>
										';
									}
								} else {
									echo '
										<div class="col-md-3">
											<label>Berkas</label>
											<p>-</p>
										</div>
										<div class="col-md-3">
											<label>Interview HRD &amp; Teknis</label>
											<p>-</p>
										</div>
										<div class="col-md-3">
											<label>Tes Teori</label>
											<p>-</p>
										</div>
										<div class="col-md-3">
											<label>Tes Praktek</label>
											<p>-</p>
										</div>
									';
								}
							?>
						</div>
					</div>
				</div>
				<div id="content-file" class="box blacklist box-custom" style="display: none;">
					<div class="box-header with-border">
						<h5 class="no-margin ls3">1. BERKAS</h5>
					</div>
					<div class="box-body">
						<div  class="row">
							<div class="col-md-6">
								<label>Apakah anda sudah memeriksa semua berkas lamaran yang diperlukan ?</label>
								<ol>
									<li>Kartu Tanda Penduduk (KTP) - <em><b>Wajib</b></em></li>
									<li>Surat Izin Mengemudi (SIM) - <em>Jika diperlukan</em></li>
									<li>Ijazah - <em><b>Wajib</b></em></li>
									<li>Sertifikat Keahlian - <em>Jika diperlukan</em></li>
									<li>Surat Pengalaman Kerja - <em>Jika diperlukan</em></li>
								</ol>
								<div class="form-group">
									<div class="radio">
										<label>
											<input type="radio" name="election_file" id="election_file1" value="1">
											Sudah diperiksa keaslian dan kesesuaian dengan persyaratan rekrutmen.
										</label>
										<label>
											<input type="radio" name="election_file" id="election_file2" value="0">
											Belum dicek.
										</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">PIC</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fas fa-user-shield"></i>
										</div>
										<select name="pic" id="pic" class="form-control select2 pull-right required">
							                <option></option>
							                <?php
							                	foreach ($listpic as $row) {
							                		echo '<option value="'.$row->Nama.'-'.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
							                	}
							                ?>
							            </select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="content-hrd" class="box blacklist box-custom" style="display: none;">
					<div class="box-header with-border">
						<h5 class="no-margin ls3">2. INTERVIEW HRD &amp; TEKNIS</h5>
					</div>
					<div class="box-body">
						<div  class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Tanggal Interview</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="far fa-calendar-alt"></i>
										</div>
										<input class="form-control datepicker required pull-right" name="interviewdate_hrd" id="interviewdate_hrd" maxlength="10" placeholder="dd-mm-yyyy" />
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">PIC HRD</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fas fa-user-shield"></i>
										</div>
										<select name="hrd_nik" id="hrd_nik" class="form-control select2 pull-right required">
							                <option></option>
							                <?php
							                	foreach ($listpic as $row) {
							                		echo '<option value="'.$row->Nama.'-'.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
							                	}
							                ?>
							            </select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">PIC Teknis</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fas fa-user-shield"></i>
										</div>
										<select name="teknis_nik" id="teknis_nik" class="form-control select2 pull-right required">
							                <option></option>
							                <?php
							                	foreach ($listpic as $row) {
							                		echo '<option value="'.$row->Nama.'-'.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
							                	}
							                ?>
							            </select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="content-theory" class="box blacklist box-custom" style="display: none;">
					<div class="box-header with-border">
						<h5 class="no-margin ls3">3. TES TEORI</h5>
					</div>
					<div class="box-body">
						<div  class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Tanggal Tes</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="far fa-calendar-alt"></i>
										</div>
										<input class="form-control datepicker required pull-right" name="interviewdate_teori" id="interviewdate_teori" maxlength="10" placeholder="dd-mm-yyyy" />
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Nilai</label>
									<input type="text" name="score_teori" id="score_teori" class="form-control scores required" maxlength="5" placeholder="Ketik disini">
									<span>* Gunakan titik sebagai pengganti koma. Contoh: 76.90</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">PIC Teori</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fas fa-user-shield"></i>
										</div>
										<select name="teori_nik" id="teori_nik" class="form-control select2 pull-right required">
							                <option></option>
							                <?php
							                	foreach ($listpic as $row) {
							                		echo '<option value="'.$row->Nama.'-'.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
							                	}
							                ?>
							            </select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="content-practice" class="box blacklist box-custom" style="display: none;">
					<div class="box-header with-border">
						<h5 class="no-margin ls3">4. TES PRAKTEK</h5>
					</div>
					<div class="box-body">
						<div  class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Tanggal Tes</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="far fa-calendar-alt"></i>
										</div>
										<input class="form-control datepicker required pull-right" name="interviewdate_praktek" id="interviewdate_praktek" maxlength="10" placeholder="dd-mm-yyyy" />
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">PIC Trainer</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fas fa-user-shield"></i>
										</div>
										<select name="trainer_nik" id="trainer_nik" class="form-control select2 pull-right required">
							                <option></option>
							                <?php
							                	foreach ($listpic as $row) {
							                		echo '<option value="'.$row->Nama.'-'.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
							                	}
							                ?>
							            </select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label>Nilai I (15)</label>
									<input type="text" name="score_practice1" class="form-control required scores" maxlength="5" placeholder="Ketik disini">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Nilai II (10)</label>
									<input type="text" name="score_practice2" class="form-control required scores" maxlength="5" placeholder="Ketik disini">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Nilai III (10)</label>
									<input type="text" name="score_practice3" class="form-control required scores" maxlength="5" placeholder="Ketik disini">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Nilai IV (55)</label>
									<input type="text" name="score_practice4" class="form-control required scores" maxlength="5" placeholder="Ketik disini">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Nilai V (10)</label>
									<input type="text" name="score_practice5" class="form-control required scores" maxlength="5" placeholder="Ketik disini">
								</div>
							</div>
						</div>
						<span>*Gunakan titik (.) sebagai koma jika nilai desimal. Contoh ( 78.90 )</span>
					</div>
				</div>
				<div id="content-prompt" class="box box-custom">
					<div class="box-header with-border">
						<h5 class="no-margin ls3">KESIMPULAN</h5>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Apakah pelamar lulus ?</label>
									<select class="form-control required select2" name="statusinterview" id="statusinterview">
										<option value="">Pilih</option>
										<option value="2Tunda">Tunda</option>
										<option value="1Lanjut Tes HRD dan Teknis">Lanjut Tes HRD & Teknis</option>
										<option value="1Lanjut Tes Teori">Lanjut Tes Teori</option>
										<option value="1Lanjut Tes Praktek">Lanjut Tes Praktek</option>
										<option value="1Lanjut MCU">Lanjut MCU</option>
										<option value="0Blacklist">Blacklist</option>
										<option value="0Gagal Berkas">Gagal Berkas</option>
										<option value="0Gagal Interview HRD">Gagal Interview HRD</option>
										<option value="0Gagal Interview Teknis">Gagal Interview Teknis</option>
										<option value="0Gagal Teori">Gagal Teori</option>
										<option value="0Gagal Praktek">Gagal Praktek</option>
										<option value="0Gagal MCU">Gagal MCU</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Keterangan (Lulus / Tidak Lulus)</label>
									<textarea name="conclusion_ket" id="conclusion_ket" class="form-control _CalPhaNum required" row="3" maxlength="100" placeholder="Ketik disini"></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Referensi</label>
									<textarea class="form-control _CalPhaNum required" name="reference" id="reference" row="3" maxlength="100" placeholder="Ketik disini"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="button" id="btn_sv_interview" class="btn btn-primary">Simpan</button>
	            <button type="button" class="btn btn-default" id="btn_prev_applicant">Batal</button>
	        </div>
		</form>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('._CalPhaNum').alphanum({ allowNumeric: false, allow: '.-,' });
		$('._CnUmB').numeric({allowThouSep: true,	allowDecSep: false, allowPlus: false, allowMinus: false });
		$('.datepicker').datepicker({ autoclose: true,format:"dd-mm-yyyy",todayHighlight:true,daysOfWeekHighlighted:"0",todayBtn:"linked"});
		$('.scores').numeric({ allow: '.' });
		$("#jabatan").val('<?=$detail->KodeJB?>').trigger('change');
		$("#interview_site").select2({ placeholder: 'Pilih', allowClear: true });
		$("#interview_site").val('<?=$detail->interview_site?>').trigger('change');
		$("#btn_back_applicant, #btn_prev_applicant").click(function(){
			$("#main-content, #header-content").removeClass("hidden");
			$("#extra-content").addClass("hidden");
			localStorage.clear();
		});
		$('#form_interview').validate({
		    rules: { 'test_type[]': { required: true },'election_file': { required: true } },
		    messages: { 'test_type[]': { required: "Select one of the selection stages", }, 'election_file': { required: "Select the answer for the question above" }}		    
		});
		$("#statusinterview").on("change", function(){
			if ($("#statusinterview").val() == "0Blacklist"){
                $("#content-step").addClass('hidden');
                $(".blacklist").addClass('hidden');
                $("#reference").prop('disabled', true);
			} else {
                $("#content-step").removeClass('hidden');
                $(".blacklist").removeClass('hidden');
                $("#reference").prop('disabled', false);
			}
		})
		$("#btn_sv_interview").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_interview").serialize();
			if($("#form_interview").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("html, body").animate({ scrollTop: 0 }, 600);
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>form/add/interview",
				formdata,
				function(data) {
					if(data == "Success"){
						$("#loading").addClass("hidden");
						swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.', type: "", confirmButtonText: 'Okay', allowOutsideClick: false })
						.then(function(){
					    	$('#form_interview')[0].reset(); $("input[type=checkbox]").prop("checked", ""); $('.select2').val(null).trigger('change'); $("#main-content, #header-content").removeClass("hidden"); $("#extra-content").addClass("hidden"); $('#table_applicant').DataTable().ajax.reload(); localStorage.clear();});
					} else {
						$("#loading").addClass("hidden");
						swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
					}
				});   
			}
		});
	});
	$(function() {
		if(localStorage.test_file == null) localStorage.test_file = "false";
      	$('#test_file')
	        .prop('checked', localStorage.test_file == "true")
	        .on('change', function() {
	        localStorage.test_file = this.checked;
	        if(localStorage.test_file == "true") {
	            $('#content-file').show();
	        } else {
	            $('#content-file').hide();
	            localStorage.test_file == "false";
	        }
	    }).trigger('change');
	    if(localStorage.test_hrd == null) localStorage.test_hrd = "false";
      	$('#test_hrd')
	        .prop('checked', localStorage.test_hrd == "true")
	        .on('change', function() {
	        localStorage.test_hrd = this.checked;
	        if(localStorage.test_hrd == "true") {
	            $('#content-hrd').show();
	        } else {
	            $('#content-hrd').hide();
	            localStorage.test_hrd == "false";
	        }
	    }).trigger('change');
	    if(localStorage.test_theory == null) localStorage.test_theory = "false";
      	$('#test_theory')
	        .prop('checked', localStorage.test_theory == "true")
	        .on('change', function() {
	        localStorage.test_theory = this.checked;
	        if(localStorage.test_theory == "true") {
	            $('#content-theory').show();
	        } else {
	            $('#content-theory').hide();
	            localStorage.test_teori == "false";
	        }
	    }).trigger('change');
	    if(localStorage.test_practice == null) localStorage.test_practice = "false";
      	$('#test_practice')
	        .prop('checked', localStorage.test_practice == "true")
	        .on('change', function() {
	        localStorage.test_practice = this.checked;
	        if(localStorage.test_practice == "true") {
	            $('#content-practice').show();
	        } else {
	            $('#content-practice').hide();
	            localStorage.test_practice == "false";
	        }
	    }).trigger('change');
	});
</script>