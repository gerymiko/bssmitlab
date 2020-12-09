<div class="feature-box media-box">
	<div class="fbox-desc">
		<h3>Pengalaman Kerja 
			<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#addPengalaman">
				<span id="mobileshow"><i class="fa fa-plus"></i></span> <span class="desktop-view">Tambah</span>
			</button>
			<span class="subtitle f13">
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

<div class="modal fade" id="unggahJob" tabindex="-1" role="dialog" aria-labelledby="LabelJob" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelJob">Unggah Berkas Pengalaman
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-uploadfile-job" method="post" action="#" enctype="multipart/form-data" role="form" class="nomargin">
				<input type="hidden" name="pjobhistory_id" id="pjobhistory_id_upload">
				<div class="modal-body">
					<div class="form-group">
						<label for="ptipe" class="col-form-label">Nama Perusahaan</label>
						<input type="text" class="alpha form-control input-sm required" name="pjobhistory_company" id="company_upload" readonly="readonly">
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
		            <div class="progress-job bottommargin" style="display:none;">
		            	<div id="progress-bar-job" class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
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
								<div class="input-group">
									<input type="text" name="pjobhistory_thn_start_add" class="datepicker form-control input-sm required" maxlength="10" placeholder="DD-MM-YYYY" autocomplete="off">
									<div class="input-group-btn">                   
			                            <a class="btn btn-icn btn-default btn-sm">
			                                <i class="icon-calendar f10"></i>
			                            </a>
			                        </div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-form-label">Gaji Akhir <b class="red">*</b></label>
								<div class="input-group">
									<div class="input-group-btn">                   
			                            <a class="btn btn-icn btn-default btn-sm">
			                                Rp
			                            </a>
			                        </div>
									<input type="text" name="pjobhistory_gaji_akhir_add" class="num form-control input-sm required" maxlength="10"  placeholder="Rupiah">
								</div>
								<i>* Hanya angka</i>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Bidang Perusahaan <b class="red">*</b></label>
								<select name="pjobhistory_bidang_add" class="num form-control required" id="pjobhistory_bidang_add">
									<option>Pilih</option>
									<?php
										foreach ($sector as $row) {
											echo '<option value="'.$row->sector_id.'">'.$row->sector_name.'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label class="col-form-label">Jabatan Akhir <b class="red">*</b></label>
								<input type="text" name="pjobhistory_jabatan_akhir_add" maxlength="100" class="alpha form-control input-sm required" placeholder="Ketik disini . . ." />
							</div>
							<div class="form-group">
								<label class="col-form-label">Sampai <b class="red">*</b></label>
								<div class="input-group">
									<input type="text" name="pjobhistory_thn_end_add" class="datepicker form-control input-sm required" maxlength="10" placeholder="DD-MM-YYYY" autocomplete="off">
									<div class="input-group-btn">                   
			                            <a class="btn btn-icn btn-default btn-sm">
			                                <i class="icon-calendar f10"></i>
			                            </a>
			                        </div>
								</div>
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

					<div class="progress-job-add bottommargin" style="display:none;">
		            	<div id="progress-bar-job-add" class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
		            </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" id="btn-add-job" disabled="disabled" class="btn btn-primary">Simpan</button>
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
								<input type="text" name="pjobhistory_company" id="company" class="alpha form-control input-sm required" maxlength="100" />
							</div>
							<div class="form-group">
								<label class="col-form-label">Jabatan Awal <b class="red">*</b></label>
								<input type="text" name="pjobhistory_jabatan_awal" id="jabatan_awal" class="alpha form-control input-sm required" maxlength="50" />
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
								<select name="pjobhistory_bidang" class="num form-control required" id="bidang">
									<option>Pilih</option>
									<?php
										foreach ($sector as $row) {
											echo '<option value="'.$row->sector_id.'">'.$row->sector_name.'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label class="col-form-label">Jabatan Akhir <b class="red">*</b></label>
								<input type="text" name="pjobhistory_jabatan_akhir" id="jabatan_akhir" class="alpha form-control input-sm required" maxlength="50" />
							</div>
							<div class="form-group">
								<label class="col-form-label">Sampai <b class="red">*</b></label>
								<input type="text" name="pjobhistory_thn_end" id="thn_end" class="datepicker form-control input-sm required" autocomplete="off"/>
							</div>
							<div class="form-group">
								<label class="col-form-label">Alasan Keluar <b class="red">*</b></label>
								<textarea class="alpha form-control required" rows="2" name="pjobhistory_reason" id="reason" maxlength="100"></textarea>
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

<div class="modal fade" id="showJobfile" tabindex="-1" role="dialog" aria-labelledby="LabelJobfile" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelJobfile">Berkas Pengalaman</h5>
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

<script type="text/javascript" src="<?=site_url();?>../bssmitlab/_assets/global/select2/select2.min.js"></script>

<script type="text/javascript">

	$('#form-add-job').validate();
	$('#form-edit-job').validate();
	$('#pjobhistory_bidang_add').select2({dropdownParent: $('#addPengalaman')});
	$('#bidang').select2({dropdownParent: $('#editJob')});

	$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});
	$('.alpha').alphanum({allowNumeric: false});
	
	$('.datepicker').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		startView: 2,
		daysOfWeekHighlighted: "0"
	});

	var url_lang = "<?=site_url();?>s_url/dt_language";
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
	    "language": { "url": url_lang },
		"drawCallback": function ( settings ) {
			$("#tableJobhistory thead").remove();
		}
	});

	$('#unggahJob').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button  = $(event.relatedTarget) 
			var id      = button.data('id')
			var company = button.data('company')
			var modal   = $(this)
			modal.find('#pjobhistory_id_upload').val(id)
			modal.find('#company_upload').val(company)
		}
	});

    $('#showJobfile').on('show.bs.modal', function (event) {
    	if (event.namespace == 'bs.modal') {
			var button  = $(event.relatedTarget)
			var jobfile = button.data('src')
			var name    = button.data('name')
			var modal   = $(this)
			modal.find('.modal-title white').text('Lihat Berkas ' + name)
	        modal.find(".showjobfile").attr("src", jobfile);
	    }
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

	function save_edit_job(){
		var paramstr = $("#form-edit-job").serialize();
		var table6   = $('#tableJobhistory').DataTable();
		if($("#form-edit-job").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>account/sedit_job",
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
	        text: "Apakah Anda yakin ingin menghapus pengalaman ini ?",
	        type: "warning",
	        showCancelButton: true,
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>account/delete_job",
					type: "post",
					data: { pjobhistory_id:pjobhistory_id },
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

  	$(document).ready(function (e) {
		//JOB
        $('#file_job').change(
            function(){
                if ($(this).val()) {
                    $('#btn-job').attr('disabled',false);
                    var progressBar4 = $('#progress-bar-job');
					$("#form-uploadfile-job").on('submit',(function(e) {
						e.preventDefault();

						$.ajax({
							url: "<?=site_url();?>account/supload_job",
							type: "POST",
							data:  new FormData(this),
							contentType: false,
							cache: false,
							processData:false,
							success: function(data){
								if(data !== 'Success'){
									$('#unggahJob').modal('hide');
									$('.progress-job').hide();
									$('#btn-job').removeClass('hidden');
									swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
								} else {
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
										$('#btn-job').addClass('hidden');
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
                    $('#btn-add-job').attr('disabled',false);

                    var progressBarAddJob = $('#progress-bar-job-add');
					$("#form-add-job").on('submit',(function(e) {
						e.preventDefault();

						if($("#form-add-job").valid() == false){
							return false;
						} else {
							$.ajax({
								url: "<?=site_url();?>account/sadd_job",
								type: "POST",
								data:  new FormData(this),
								contentType: false,
								cache: false,
								processData:false,
								success: function(data){
									if(data !== 'Success'){
										$('#addPengalaman').modal('hide');
										$('.progress-job-add').hide();
										$('#btn-add-job').removeClass('hidden');
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
								xhr: function() {
									var xhr = new XMLHttpRequest();
									xhr.upload.addEventListener("progress", function(event) {
										if (event.lengthComputable) {
											var percentComplete = Math.round( (event.loaded / event.total) * 100 );
											$('.progress-job-add').show();
											$('#btn-add-job').addClass('hidden');
											progressBarAddJob.css({width: percentComplete + "%"});
											progressBarAddJob.text(percentComplete + '%');
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
    });
</script>