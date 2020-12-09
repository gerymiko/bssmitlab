<section class="content-header" id="header-content">
   	<h1>Daftar <b>Lowongan</b><small>Web</small></h1>
   	<ol class="breadcrumb">
      	<li><a href="#">Rekrutmen</a></li>
      	<li><a href="#">Web</a></li>
      	<li class="active">Lowongan</li>
   	</ol>
</section>
<div id="extra-content" class="hidden"></div>
<section class="content" id="main-content">
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-navy"><?=$lowonganaktif;?></span>
				<div class="info-box-content">
					<span class="info-box-text">Lowongan</span>
					<span class="info-box-number">Aktif<small></small></span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-navy"><?=$lowongannonaktif;?></span>
				<div class="info-box-content">
					<span class="info-box-text">Lowongan</span>
					<span class="info-box-number">Non-Aktif</span>
				</div>
			</div>
		</div>
		<div class="clearfix visible-sm-block"></div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-navy"><?=$lowonganterdaftar;?></span>
				<div class="info-box-content">
					<span class="info-box-text">Total</span>
					<span class="info-box-number">Lowongan</span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<form id="form-filter">
				<div class="form-group">
					<select class="form-control" id="lowongan_status" name="lowongan_status">
						<option value="">Pilih status lowongan</option>
						<option value="1">BUKA</option>
						<option value="0">TUTUP</option>
					</select>
					<div style="padding: 2px;"></div>
					<button type="button" class="btn btn-danger btn-sm" id="btn-filter">Filter</button>
					<button type="button" class="btn btn-default btn-sm" id="btn-reset">Reset</button>
				</div>
			</form>
		</div>
	</div>
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title"></h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-primary btn-sm" onclick="btn_add_vacancy();">+ Lowongan</button>
			</div>
		</div>
		<div class="box-body">
			<table id="table_vacancy" class="table table-bordered table-hover" style="width:100%">
				<thead class="bg-cgray">
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Dept.</th>
						<th>Jabatan</th>
						<th>Jml. Rekrut</th>
						<th>Tgl Buka</th>
						<th>Status</th>
						<th><i class="fas fa-cog"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<!-- <div class="modal" id="modal-add-vacancy">
	<div class="modal-dialog modal900">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Tambah Lowongan</h4>
			</div>
			<form id="form-add-vacancy" action="#" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Jabatan</label>
		                        <select name="jabatan_alias" id="jabatan_alias" class="form-control select2 required" maxlength="50">
		                            <option></option>
		                            <?php
		                            	foreach ($listjabatan as $row){
		                            		echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.' ['.$row->departemen.']</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<span id="availability-loker" class="text-red" style="display: none;"><small>Lowongan pernah dibuat sebelumnya, gunakan fitur UPDATE untuk memposting ulang lowongan ini.</small></span>
							<div class="load-bar loadloker" style="display: none;"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>
							<div class="form-group">
								<input type="hidden" class="form-control _CalPhaNum" name="KodeJB" id="KodeJB">
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control _CalPhaNum" name="KodeDP" id="KodeDP">
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label">Kode Lowongan</label>
										<input class="form-control _CalPhaNum required" name="kode_lowongan" id="kode_lowongan" placeholder="Contoh : BSS-IT-PRGMMR" maxlength="25">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Jumlah Rekrut</label>
										<input type="text" name="jml_rekrut" class="form-control _CnUmB required" placeholder="Contoh : 10" maxlength="2">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label class="control-label">Durasi Lowongan</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Tanggal Buka</label>
										<input type="text" name="tgl_open" class="form-control datepicker required" placeholder="Contoh : <?=date('d-m-Y')?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Tanggal Buka</label>
										<input type="text" name="tgl_close" class="form-control datepicker required" placeholder="Contoh : <?=date('d-m-Y', strtotime('+1 month'))?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<label class="control-label" data-tooltip="*Kosongkan jika tidak ingin memberi informasi gaji">Gaji ditawarkan <i class="fas fa-info-circle"></i></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Terendah</label>
										<input type="text" name="min_salary" id="rupiah1" class="form-control" maxlength="10" placeholder="Contoh : 1.000.000">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Tertinggi</label>
										<input type="text" name="max_salary" id="rupiah2" class="form-control" maxlength="10" placeholder="Contoh : 8.000.000">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default no-radius">
						<div class="panel-body">
							<h4><span class="label label-info">KUALIFIKASI</span></h4>
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label class="control-label">Jenis Kelamin</label>
										<select class="form-control required" name="jenis_kelamin" id="jenis_kelamin" maxlength="3">
											<option value="">Pilih</option>
											<option value="L">Laki - laki</option>
											<option value="P">Perempuan</option>
											<option value="L;P">Keduanya</option>
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Lulusan Minimal</label>
										<div class="row">
											<div class="col-md-6">
												<div class="checkbox">
						                            <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="2">SMP</label>
						                        </div>
												<div class="checkbox">
						                            <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="3">SMA</label>
						                        </div>
						                        <div class="checkbox">
						                            <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="4">SMK</label>
						                        </div>
						                        <div class="checkbox">
						                            <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="5">D1</label>
						                        </div>
						                        <div class="checkbox">
						                            <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="6">D2</label>
						                        </div>
											</div>
											<div class="col-md-6">
												<div class="checkbox">
						                            <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="7">D3</label>
						                        </div>
						                        <div class="checkbox">
						                            <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="8">S1</label>
						                        </div>
						                        <div class="checkbox">
						                            <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="9">S2</label>
						                        </div>
						                        <div class="checkbox">
						                            <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="10">S3</label>
						                        </div>
						                        <div class="checkbox">
						                            <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="11">Lainnya</label>
						                        </div>	
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<label class="control-label">Jurusan</label>
										<input type="text" name="edu_jurusan" class="form-control _CalPhaNum required" placeholder="Contoh : IPA, Teknik Mesin, Otomotif, Administrasi, Management, dll" maxlength="200">
									</div>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label class="control-label">Pengalaman (Tahun)</label>
												<input type="text" name="experience" class="form-control _CnUmB" maxlength="2" placeholder="Contoh : 2">
											</div>
										</div>
										<div class="col-md-7">
											<div class="form-group">
												<label class="control-label">Bidang Pengalaman</label>
												<input type="text" name="experience_subject" class="form-control _CalPhaNum" placeholder="Contoh : Pertambangan, Migas, dll" maxlength="100">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label">Usia</label>
										<div class="row">
											<div class="col-md-6">
												<label class="control-label">Minimal (Tahun)</label>
												<input type="text" name="min_usia" maxlength="2" class="form-control _CnUmB required" placeholder="18">
											</div>
											<div class="col-md-6">
												<label class="control-label">Maksimal (Tahun)</label>
												<input type="text" name="max_usia" maxlength="2" class="form-control _CnUmB required" placeholder="40">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default no-radius">
						<div class="panel-body">
							<h4><span class="label label-info">KEMAMPUAN DIBUTUHKAN</span></h4>
							<div class="row">
								<div class="col-md-6">
									<label class="control-label">Skill sesuai jabatan</label>
									<div id="skill"></div>
								</div>
								<div class="col-md-6">
									<label class="control-label">Skill Umum</label>
									<div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="114">Dapat membaca gambar tehnik</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="113">Pengetahuan kebersihan kerja</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="112">Pengetahuan keselamatan kerja</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="111">Dapat membaca satuan ukuran</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="">Pengetahuan alat kerja</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="110">Pengetahuan alat ukur</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="108">Mampu mengoperasikan Komputer</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="5">Miscrosoft Power Point</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="4">Miscrosoft Visio</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="3">Miscrosoft Excel</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="2">Miscrosoft Words</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="skill_id[]" value="1">Miscrosoft Office</label>
			                        </div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default no-radius">
						<div class="panel-body">
							<h4><span class="label label-info">SERTIFIKAT DIBUTUHKAN</span></h4>
							<div class="row">
								<div class="col-md-6">
									<label class="control-label">Sertifikat Sesuai Jabatan</label>
									<div id="sertifikat"></div>
								</div>
								<div class="col-md-6">
									<label class="control-label">Sertifikat Umum</label>
									<div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="certificate_id[]" value="1">AK3 Umum / POP</label>
			                        </div>
			                        <div class="checkbox">
			                            <label><input type="checkbox" class="checkcus" name="certificate_id[]" value="2">Diklat SMKP</label>
			                        </div>
			                    </div>
			                </div>
						</div>
					</div>
					<div class="panel panel-default no-radius">
						<div class="panel-body">
							<h4><span class="label label-info">SYARAT LOWONGAN</span></h4>
							<div class="row">
								<div class="col-md-6">
									<label class="control-label">Syarat Umum</label>
									<?php
										foreach ($msyarat as $row) {
											echo '
												<div class="checkbox">
						                            <label><input type="checkbox" class="checkcus" name="syarat_id[]" value="'.$row->syarat_id.'">'.$row->syarat_name.'</label>
						                        </div>
											';
										}
									?>
								</div>
								<div class="col-md-6">
									<label class="control-label">Syarat Sesuai Jabatan</label>
									<div id="syarat"></div>
			                    </div>
			                </div>
						</div>
					</div>
					<label class="control-label">Deskripsi Pekerjaan</label>
				    <textarea id="job_desc" name="job_desc" class="form-control wysihtml5 required">
				    	&lt;p&gt;Contoh Deskripsi Pekerjaan :&nbsp;&lt;/p&gt;
						&lt;p&gt;1. Analisa Kebutuhan, Desain Kebutuhan, Pengajuan Development.&lt;br&gt;
						2. Desain Data Flow Diagram, desain Entity Relational Diagram, desain Work Flow, Desain Wireframe, Desain Reporting.&lt;br&gt;
						3. Melakukan pengujian aplikasi sebelum di implementasikan.&lt;br&gt;
						4. Training dan sosialisasi Aplikasi, melakukan monitoring,review dan evaluasi hasil implementasi.&lt;br&gt;
						5. Analisa pengembangan.&lt;br&gt;
						* Hapus contoh diatas sebelum mengisi deskripsi pekerjaan&lt;/p&gt;
				    </textarea>
				    <span><i>* Penting mohon isi deskripsi pekerjaan yang terkait dengan lowongan tersebut.</i></span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-sm" data-dismiss="modal">Tutup</button>
           			<button type="button" id="btn_add_vacancy" class="btn btn-primary btn-sm">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div> -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#recruit").addClass("active");
		$("#recruit-vacancy").addClass("active");
		// $("#jabatan_edit").select2({ placeholder: "Pilih", allowClear: true });
		// $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,' });
		// $('._CnUmB').numeric({allowThouSep: true,	allowDecSep: false, allowPlus: false, allowMinus: false });
		// $('.datepicker').datepicker({ autoclose: true,format:"dd-mm-yyyy",todayHighlight:true,daysOfWeekHighlighted:"0",todayBtn:"linked" });
		var table = $('#table_vacancy').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"dom": 'Bfrtip',
	        "buttons": [ 'pageLength' ],
	        "lengthMenu": [
	        	[10, 25, 50, 100], 
	        	['10 Baris', '25 Baris', '50 Baris', '100 Baris']
	        ],
			"ajax": {
				"url": '<?=site_url()?>crecruit/web/vacancy/sysvacancy/table_vacancy',
				"type": 'POST',
				data : function (data){
					data.lowongan_status = $('#lowongan_status').val();
				},
				error: function(data){
					swal({
				        title: "",
				        html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.',
				        type: "",
				        confirmButtonText: 'Okay',
				    }).then(function(){ table.ajax.reload(); });
				},
			},
			"language": { 
	   			"processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>',
	   		},
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "kode", "className": "text-left", "orderable": false },
				{ "data": "dept", "className": "text-left" },
				{ "data": "jb", "className": "text-left" },
				{ "data": "jmlrec", "className": "text-center", "orderable": false  },
				{ "data": "dateopen", "className": "text-center", "orderable": false  },
				{ "data": "status", "className": "text-center", "orderable": false  },
				{ "data": "action", "className": "text-center", "orderable": false  },
			]
		});
		$('#btn-filter').click(function(){ 
			table.ajax.reload();
		});
		$('#btn-reset').click(function(){ 
			$('#form-filter')[0].reset();
			table.ajax.reload();  
		});		
	});
	function btn_add_vacancy(){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>crecruit/web/vacancy/sysvacancy/vadd_vacancy", function(){
			$('.datepicker').datepicker({ autoclose: true,format:"dd-mm-yyyy",todayHighlight:true,daysOfWeekHighlighted:"0",todayBtn:"linked" });
		});
	}
	function btn_edit_vacancy(id, kode){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>crecruit/web/vacancy/sysvacancy/vedit_vacancy/"+id+"/"+kode, function(){
			$('.datepicker').datepicker({ autoclose: true,format:"dd-mm-yyyy",todayHighlight:true,daysOfWeekHighlighted:"0",todayBtn:"linked" });
		});
	}
	function btn_detail_vacancy(id){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>crecruit/web/vacancy/sysvacancy/vdetail_vacancy/"+id);
	}
	function removeThis(id, name){
	    swal({
	        title: "",
	        html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Non-Aktifkan loker ini (<b>'+name+'</b>).',
	        type: "",
	        showCancelButton: true,
			focusConfirm: false,
			confirmButtonText: 'Okay, Lanjutkan',
			confirmButtonAriaLabel: 'Ok',
			cancelButtonText: '<i class="fas fa-times"></i>',
			cancelButtonAriaLabel: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>crecruit/web/vacancy/sysvacancy/deactivated_vacancy",
					type: "post",
					data: { id:id },
					success:function(data){
						if(data == "Success"){
							swal({
						        title: "",
						        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Loker berhasil dinon-aktifkan.',
						        type: "",
						        confirmButtonText: 'Okay',
						    }).then(function(){
								$('#table_vacancy').DataTable().ajax.reload();
							});
						} else {
							swal({
						        title: "",
						        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal dinon-aktifkan. Muat ulang halaman ini dan coba lagi.',
						        type: "",
						        confirmButtonText: 'Okay',
						    });
						}
					},
				});
			}
        });
	}
</script>