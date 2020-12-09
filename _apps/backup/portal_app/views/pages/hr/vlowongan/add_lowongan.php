<div class="row">
	<div class="col-md-11">
		<h4 style="margin-top: 0"><span class="label label-success">Lowongan</span> Tambah Lowongan - <small>Form untuk menambahkan lowongan.</small></h4>
	</div>
	<div class="col-md-1">
		<a onClick="ajax_load('<?=$this->input->post('last_link');?>')" class="btn btn-red pull-right">
			<i class="entypo-left-open"></i>
			Kembali
		</a>
	</div>
</div>
<hr>
<div class="panel panel-gray">
	<form role="form" method="post" id="addlowongan" name="addlowongan" class="validate">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label><strong>Jabatan </strong><b class="red">*</b>
							<span data-balloon-length="large" data-balloon="Jika lowongan sudah pernah dibuat sebelumnya, gunakan fitur UPDATE lowongan." data-balloon-pos="up" >
	                            <i class="entypo-info-circled"></i>
	                        </span>
						</label>
						<div class="side-by-side clearfix">
	                        <select name="jabatan_alias" id="jabatan_alias" class="js-example-theme-multiple required" maxlength="50" tabindex="2" data-validate="required">
	                            <option value="">Pilih</option>
	                            <?php
	                            	foreach ($listjabatan as $row) {
	                            		echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.'</option>';
	                            	}
	                            ?>
	                        </select>
	                    </div>
	                    <span id="availability-loker" class="red" style="display: none;">Lowongan pernah dibuat sebelumnya, gunakan fitur UPDATE untuk memposting ulang lowongan tersebut.</span>
	                    <div id="loading-check" style="display: none;">
	                    	<img src="../../bssmitlab/_assets/images/logo/giphy.gif" width="80">
	                    </div>
					</div>
					<div class="form-group">
						<input class="form-control hidden" name="KodeJB" id="KodeJB">
					</div>
					<div class="form-group">
						<input class="form-control hidden" name="KodeDP" id="KodeDP">
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label class="control-label"><strong>Kode Lowongan</strong> <b class="red">*</b> 
									<span data-balloon="Isilah sesuai dengan jabatan" data-balloon-pos="up" >
                                        <i class="entypo-info-circled"></i>
                                    </span>
								</label>
								<input class="form-control input-lg required" name="kode_lowongan" id="kode_lowongan" data-validate="required" placeholder="Contoh : BSS-IT-PRGMMR">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label"><strong>Jumlah Rekrut </strong><b class="red">*</b></label>
								<input type="text" name="jml_rekrut" class="form-control input-lg required" data-validate="required" onkeypress="return onlyNumerics(event,this);" placeholder="Contoh : 10">
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<label class="control-label"><b>Durasi Lowongan</b> <b class="red">*</b></label>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tanggal Buka :</label>
								<input type="text" name="tgl_open" class="form-control datepicker required" data-validate="required" placeholder="Contoh : 2018-03-07">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tanggal Tutup :</label>
								<input type="text" name="tgl_close" class="form-control datepicker required" data-validate="required" placeholder="Contoh : 2018-03-07">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<label class="control-label"><b>Gaji yang Ditawarkan</b>
						<span data-balloon-length="large" data-balloon="Anda dapat mengosongkan kolom ini jika tidak ingin menampilkan gaji yang ditawarkan." data-balloon-pos="up" >
                            <i class="entypo-info-circled"></i>
                        </span>
					</label>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Terendah :</label>
								<input type="text" name="min_salary" class="form-control" onkeypress="return onlyNumerics(event,this);" placeholder="Contoh : 1000000">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tertinggi :</label>
								<input type="text" name="max_salary" class="form-control" onkeypress="return onlyNumerics(event,this);" placeholder="Contoh : 8000000">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-invert">
				<div class="panel-heading">
					<div class="panel-title">
						KUALIFIKASI
					</div>
					<div class="panel-options">
						<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><strong>Jenis Kelamin </strong><b class="red">*</b></label>
								<select class="form-control required" name="jenis_kelamin">
									<option value="">Pilih</option>
									<option value="L">Laki - laki</option>
									<option value="P">Perempuan</option>
									<option value="L;P">Keduanya</option>
								</select>
							</div>
							
							<div class="form-group">
								<label class="control-label"><strong>Lulusan Minimal </strong><b class="red">*</b></label>
								<div class="row">
									<div class="col-md-6">
										<div class="checkbox" style="padding-left: 0px">
				                            <label>
				                                <input type="checkbox" name="edutype_id[]" value="2">
				                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
				                            </label>
				                            <label style="padding-left: 10px">SMP</label>
				                        </div>
										<div class="checkbox" style="padding-left: 0px">
				                            <label>
				                                <input type="checkbox" name="edutype_id[]" value="3">
				                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
				                            </label>
				                            <label style="padding-left: 10px">SMA</label>
				                        </div>
				                        <div class="checkbox" style="padding-left: 0px">
				                            <label>
				                                <input type="checkbox" name="edutype_id[]" value="4">
				                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
				                            </label>
				                            <label style="padding-left: 10px">SMK</label>
				                        </div>
				                        <div class="checkbox" style="padding-left: 0px">
				                            <label>
				                                <input type="checkbox" name="edutype_id[]" value="5">
				                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
				                            </label>
				                            <label style="padding-left: 10px">D1</label>
				                        </div>
				                        <div class="checkbox" style="padding-left: 0px">
				                            <label>
				                                <input type="checkbox" name="edutype_id[]" value="6">
				                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
				                            </label>
				                            <label style="padding-left: 10px">D2</label>
				                        </div>
									</div>
									<div class="col-md-6">
										<div class="checkbox" style="padding-left: 0px">
				                            <label>
				                                <input type="checkbox" name="edutype_id[]" value="7">
				                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
				                            </label>
				                            <label style="padding-left: 10px">D3</label>
				                        </div>
				                        <div class="checkbox" style="padding-left: 0px">
				                            <label>
				                                <input type="checkbox" name="edutype_id[]" value="8">
				                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
				                            </label>
				                            <label style="padding-left: 10px">S1</label>
				                        </div>
				                        <div class="checkbox" style="padding-left: 0px">
				                            <label>
				                                <input type="checkbox" name="edutype_id[]" value="9">
				                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
				                            </label>
				                            <label style="padding-left: 10px">S2</label>
				                        </div>
				                        <div class="checkbox" style="padding-left: 0px">
				                            <label>
				                                <input type="checkbox" name="edutype_id[]" value="10">
				                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
				                            </label>
				                            <label style="padding-left: 10px">S3</label>
				                        </div>
				                        <div class="checkbox" style="padding-left: 0px">
				                            <label>
				                                <input type="checkbox" name="edutype_id[]" value="11">
				                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
				                            </label>
				                            <label style="padding-left: 10px">Lainnya</label>
				                        </div>	
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><strong>Jurusan </strong><b class="red">*</b></label>
								<input type="text" name="edu_jurusan" class="form-control required" placeholder="Contoh : IPA, Teknik Mesin, Otomotif, Administrasi, Management" data-validate="required">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<div class="row">
											<div class="col-md-8">
												<label class="control-label"><strong>Pengalaman</strong>
													<span data-balloon-length="large" data-balloon="Kosongkan jika tidak ingin menyeleksi berdasarkan pengalaman." data-balloon-pos="up" >
							                            <i class="entypo-info-circled"></i>
							                        </span>
												</label>
												<input type="text" name="experience" class="form-control" data-validate="required" placeholder="Contoh : 2" onkeypress="return onlyNumerics(event,this);">
											</div>
											<div class="col-md-4">
												<div style="padding-top: 30px;"></div>
												<span>Tahun</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><strong>Bidang Pengalaman</strong></label>
										<input type="text" name="experience_subject" class="form-control" data-validate="required" placeholder="Contoh : Pertambangan, Migas, dll">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label"><b>Usia </b><b class="red">*</b></label>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Minimal :</label>
										<input type="text" name="min_usia" class="form-control required" data-validate="required" onkeypress="return onlyNumerics(event,this);" placeholder="18">
									</div>
									<div class="col-md-6">
										<label class="control-label">Maksimal :</label>
										<input type="text" name="max_usia" class="form-control required" data-validate="required" onkeypress="return onlyNumerics(event,this);" placeholder="40">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-invert">
				<div class="panel-heading">
					<div class="panel-title">
						SKILL DIBUTUHKAN
					</div>
					<div class="panel-options">
						<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<h4><span class="label label-info">Skill Sesuai Jabatan</span></h4>
								<div id="skill"></div>
							</div>
							<div class="col-md-6">
								<h4><span class="label label-info">Skill Umum</span></h4>
								<div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="114">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Dapat membaca gambar tehnik</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="113">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Pengetahuan kebersihan kerja</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="112">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Pengetahuan keselamatan kerja</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="111">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Dapat membaca satuan ukuran</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Pengetahuan alat kerja</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="110">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Pengetahuan alat ukur</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="108">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Mampu mengoperasikan Komputer</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="5">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Miscrosoft Power Point</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="4">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Miscrosoft Visio</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="3">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Miscrosoft Excel</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="2">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Miscrosoft Words</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="skill_id[]" value="1">
		                                <span class='cr' style="border: 1px solid #fff;"><i class='cr-icon glyphicon glyphicon-ok'></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Miscrosoft Office</label>
		                        </div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-invert">
				<div class="panel-heading">
					<div class="panel-title">
						SERTIFIKAT DIBUTUHKAN
					</div>
					<div class="panel-options">
						<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<h4><span class="label label-success">Sertifikat Sesuai Jabatan</span></h4>
								<div id="sertifikat"></div>
							</div>
							<div class="col-md-6">
								<h4><span class="label label-success">Sertifikat Umum</span></h4>
								<div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="certificate_id[]" value="1">
		                                <span class="cr" style="border: 1px solid #fff;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
		                            </label>
		                            <label style="padding-left: 10px">AK3 Umum / POP</label>
		                        </div>
		                        <div class="checkbox" style="padding-left: 0px">
		                            <label>
		                                <input type="checkbox" name="certificate_id[]" value="2">
		                                <span class="cr" style="border: 1px solid #fff;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
		                            </label>
		                            <label style="padding-left: 10px">Diklat SMKP</label>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		    <div class="panel panel-invert">
				<div class="panel-heading">
					<div class="panel-title">
						SYARAT WAJIB
					</div>
					<div class="panel-options">
						<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<h4><span class="label label-danger">Syarat Umum</span></h4>
								<?php
									foreach ($msyarat as $row) {
										echo '
											<div class="checkbox" style="padding-left: 0px">
					                            <label>
					                                <input type="checkbox" name="syarat_id[]" value="'.$row->syarat_id.'">
					                                <span class="cr" style="border: 1px solid #fff;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
					                            </label>
					                            <label style="padding-left: 10px">'.$row->syarat_name.'</label>
					                        </div>
										';
									}
								?>
							</div>
							<div class="col-md-6">
								<h4><span class="label label-danger">Syarat Sesuai Jabatan</span></h4>
								<div id="syarat"></div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		    <label class="control-label"><b>Deskripsi Pekerjaan </b><b class="red">*</b>
				<span data-balloon-length="large" data-balloon="Deskripsi pekerjaan wajib diisi, agar pelamar dapat mengetahui jobdesk dari pekerjaan." data-balloon-pos="up" >
                    <i class="entypo-info-circled"></i>
                </span>
		    </label>
		    <textarea id="job_desc" class="form-control wysihtml5 required" name="job_desc" data-validate="required">
		    	&lt;p&gt;Contoh Deskripsi Pekerjaan :&nbsp;&lt;/p&gt;&lt;br&gt;
				&lt;p&gt;1. Analisa Kebutuhan, Desain Kebutuhan, Pengajuan Development.&lt;br&gt;
				2. Desain Data Flow Diagram, desain Entity Relational Diagram, desain Work Flow, Desain Wireframe, Desain Reporting.&lt;br&gt;
				3. Melakukan pengujian aplikasi sebelum di implementasikan.&lt;br&gt;
				4. Training dan sosialisasi Aplikasi, melakukan monitoring,review dan evaluasi hasil implementasi.&lt;br&gt;
				5. Analisa pengembangan.&lt;br&gt;
				* Hapus contoh diatas sebelum mengisi deskripsi pekerjaan&lt;/p&gt;

		    </textarea>
		    <span><i>* Penting mohon isi deskripsi pekerjaan yang terkait dengan lowongan tersebut.</i></span> 

		</div> <!-- panel-body -->

		<div class="panel-footer">
			<button type="button" name="submit" id="btn" onclick="simpanloker();" class="btn btn-red btn-icon icon-left">
					Simpan
				<i class="entypo-check"></i>
			</button>
			<a onClick="ajax_load('<?=$this->input->post('last_link');?>')" class="btn btn-primary btn-icon icon-left">
					Kembali
				<i class="entypo-back"></i>
			</a>
		</div>
	</form>
</div>

<style type="text/css">
	.panel-invert > .panel-body{
		background-color : #FFFFFF;
		color: #000;
	}
</style>

<script type="text/javascript">
	jQuery(document).ready(function(){
	    jQuery("body").append( jQuery(".page-container .all-modals") );
	});

	$(document).ready(function() {
		$('#jabatan_alias').select2();
	});

	$(document).ready(function() {
		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd',
			todayBtn: true,
			timePicker: true,
			autoclose: true
		});
	});

	// Datepicker
	if($.isFunction($.fn.datepicker)){
		$(".datepicker").each(function(i, el){
			var $this = $(el),
				opts = {
					format: attrDefault($this, 'format', 'dd-mm-yyyy'),
					startDate: attrDefault($this, 'startDate', ''),
					endDate: attrDefault($this, 'endDate', ''),
					daysOfWeekDisabled: attrDefault($this, 'disabledDays', ''),
					startView: attrDefault($this, 'startView', 0),
					rtl: rtl()
				},
				$n = $this.next(),
				$p = $this.prev();
							
			$this.datepicker(opts);
			
			if($n.is('.input-group-addon') && $n.has('a')){
				$n.on('click', function(ev){
					ev.preventDefault();
					$this.datepicker('show');
				});
			}
			
			if($p.is('.input-group-addon') && $p.has('a')){
				$p.on('click', function(ev){
					ev.preventDefault();
					$this.datepicker('show');
				});
			}
		});
	}

	$(document).ready(function(){
    	$('#jabatan_alias').change(function() {
    		var opt = 'skill=' + $(this).val();
    		$.ajax({
    			type: "POST",
    			url: "../getSkill",
    			data: opt,
    			beforeSend: function() {
					$("#loading-check").show();
				},
    			success:function(data){
    				$("#skill").html(data);
    				$("#loading-check").hide();
    			}
    		});
    	});
    });

    $(document).ready(function(){
    	$('#jabatan_alias').change(function() {
    		var opt = 'sertifikat=' + $(this).val();
    		$.ajax({
    			type: "POST",
    			url: "../getSertifikat",
    			data: opt,
    			beforeSend: function() {
					$("#loading-check").show();
				},
    			success:function(data){
    				$("#sertifikat").html(data);
    				$("#loading-check").hide();
    			}
    		});
    	});
    });

    $(document).ready(function(){
    	$('#jabatan_alias').change(function() {
    		var opt = 'syarat=' + $(this).val();
    		$.ajax({
    			type: "POST",
    			url: "../getSyarat",
    			data: opt,
    			beforeSend: function() {
					$("#loading-check").show();
				},
    			success:function(data){
    				$("#syarat").html(data);
    				$("#loading-check").hide();
    			}
    		});
    	});
    });

    function simpanloker(){
	 	var paramstr = $("#addlowongan").serialize();
		if($("#addlowongan").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$("#loading-image").show();
			$.post("<?php echo base_url();?>addlowongannew",
			paramstr,
			function(data) {
				if(data == "Success"){
					$("#loading-image").hide();
					swal("Naiss!", "Lowongan berhasil disimpan", "success");
					document.getElementById("addlowongan").reset();
				} else {
					swal({
					    title: "Oops!",   
					    text: "Lowongan sudah pernah dibuat! Gunakan fitur edit lowongan untuk merubah status menjadi Aktif",   
					    type: "error" 
					});
					document.getElementById("addlowongan").reset();
					$("#loading-image").hide();
				}
			});	
		}
	}

	jQuery(function($){
	    var $idjb = $('#KodeJB');
	    var $iddp = $('#KodeDP');
	    var lowongan = $('#jabatan_alias').val(); 

	    $('select[name="jabatan_alias"]').change(function(){
	        $idjb.val($(this).val());
	        $iddp.val($(this).val().slice(0, -3));
	        $("#loading-check").show();
	        $.ajax({
				type : "post",
				url  : "../checkloker",
				cache: false,    
		        data:'jabatan_alias=' + $("#jabatan_alias").val(),
		        success: function(response){
		            try {
		                if(response == "false"){
		                	$("#loading-check").hide();
		                    swal({
							    title: "Oops!",   
							    text: "Lowongan sudah pernah dibuat! Gunakan fitur edit lowongan untuk merubah status menjadi Aktif",   
							    type: "error" 
							});
							$("#availability-loker").show();
		                } else {
		                	$("#loading-check").hide();
		                	$("#availability-loker").hide();
		                }         
		            } catch(e) {  
		                alert('Exception while request..');
		            }  
		        },
		        error: function(){      
		            alert('Error while request..');
		        }
		    });
	    }).triggerHandler('change');
	});

	$('#job_desc').wysihtml5();
</script>