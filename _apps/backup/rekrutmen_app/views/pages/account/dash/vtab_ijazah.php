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
		<th>No. Ijazah</th>
		<th>Status</th>
		<th class="center">Aksi</th>
	</thead>
</table>

<div class="modal fade" id="unggahIjazah" tabindex="-1" role="dialog" aria-labelledby="LabelIjazah" aria-hidden="true">
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
								<select class="form-control required" name="plisence_keluaran_ijazah" id="plisence_keluaran_ijazah">
									<option value="0">Pilih Kota</option>
			                        <?php foreach ($kota as $row) { echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>'; } ?>
								</select>
								<div id="errorTerbitanIjazah"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Nomor Ijazah <b class="red">*</b></label>
								<input type="text" class="form-control input-sm required" id="noijazah" name="plisence_number_ijazah" maxlength="30">
							</div>
							<div class="form-group">
								<label>Tanggal dikeluarkan <b class="red">*</b></label>
								<input type="text" name="plisence_date_start_ijazah" maxlength="10" class="datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
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
					<div class="progress-ijazah bottommargin" style="display:block;">
		            	<div id="progress-bar-ijazah" class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
		            </div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary btn-sm" type="submit" id="upload-btn-ijazah" disabled="disabled">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addIjazah" tabindex="-1" role="dialog" aria-labelledby="LabelIjazah" aria-hidden="true">
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
								<select class="form-control required" name="plisence_keluaran_add_ijazah">
									<option value="0">Pilih Kota</option>
			                        <?php foreach ($kota as $row) { echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>'; } ?>
								</select>
								<div id="errorTerbitanIjazah"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Nomor Ijazah <b class="red">*</b></label>
								<input type="text" class="form-control input-sm required" id="noijazah"  name="plisence_number_add_ijazah" maxlength="30">
							</div>
							<div class="form-group">
								<label>Tanggal dikeluarkan <b class="red">*</b></label>
								<input type="text" name="plisence_date_start_add_ijazah" maxlength="10" class="datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
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
					<div class="progress-add-ijazah bottommargin" style="display:none;">
		            	<div id="progress-bar-add-ijazah" class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
		            </div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary btn-sm" type="submit" id="btn-add-ijazah" disabled="disabled">Simpan</button>
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
				<img class="imageIjazah img-responsive" width="100%" src="" style="padding-bottom: 5px;">
				<i>* Reload halaman jika file masih tidak ada setelah unggah berkas.</i>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=site_url();?>../bssmitlab/_assets/global/select2/select2.min.js"></script>

<script type="text/javascript">

	$('#form-ijazah').validate();
	$('#form-add-ijazah').validate();
	$('#plisence_keluaran_add_ijazah').select2({dropdownParent: $('#addIjazah')});
	$('#plisence_keluaran_ijazah').select2({dropdownParent: $('#unggahIjazah')});

	$('#showIjazah').on('show.bs.modal', function (event) {
    	var button = $(event.relatedTarget)
		var image  = button.data('src')
		var modal  = $(this)
        modal.find(".imageIjazah").attr("src", image);
    });

	$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});
	$('.numdate').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false});
	$('.alpha').alphanum({allowNumeric: false});
	$('#noijazah').alphanum({ allow: '-/()_ .', });

	var url_lang = "<?=site_url();?>s_url/dt_language";
	var table4   = $('#tableIjazah').DataTable({
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

	$(document).ready(function (e) {
		//IJAZAH
		$('#file_ijazah').change(
            function(){
                if ($(this).val()) {
                    $('#upload-btn-ijazah').attr('disabled',false);
					var progressBar1 = $('#progress-bar-ijazah');
					var table4       = $('#tableIjazah').DataTable();
					$("#form-ijazah").on('submit',(function(e) {
						e.preventDefault();

						if($("#form-ijazah").valid() == false){
							return false;
						} else {
							$.ajax({
								url: "<?=site_url();?>account/sadd_ijazah",
								type: "POST",
								data:  new FormData(this),
								contentType: false,
								cache: false,
								processData:false,
								success: function(data){
									if(data == 'Error'){
										$('#unggahIjazah').modal('hide');
										$('.progress-ijazah').hide();
										$('#upload-btn-ijazah').removeClass('hidden');
										swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
										table4.ajax.reload();
									} else if( data == 'Done'){
										$('.progress-ijazah').hide();
										swal("Oops!", "Gagal diproses. Anda sudah mengunggah file.", "error");
									} else {
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
											$('#upload-btn-ijazah').addClass('hidden');
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
					$("#form-add-ijazah").on('submit',(function(e) {
						e.preventDefault();

						if($("#form-add-ijazah").valid() == false){
							return false;
						} else {
							$.ajax({
								url: "<?=site_url();?>account/sadd_ijazah",
								type: "POST",
								data:  new FormData(this),
								contentType: false,
								cache: false,
								processData:false,
								success: function(data){
									if(data !== 'Success'){
										$('#addIjazah').modal('hide');
										$('.progress-add-ijazah').hide();
										$('#btn-add-ijazah').removeClass('hidden');
										swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
									} else {
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
											$('#btn-add-ijazah').addClass('hidden');
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
	});
</script>