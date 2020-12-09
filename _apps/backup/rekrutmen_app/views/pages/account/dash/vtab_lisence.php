<div class="feature-box media-box">
	<div class="fbox-desc">
		<h3>Berkas KTP &amp; SIM
			<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#addSIM">
				<span id="mobileshow"><i class="fa fa-plus"></i></span> <span class="desktop-view">Tambah</span>
			</button>
			<span class="subtitle f13">
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
										$array1 = array('SIM A', 'SIM B1', 'SIM B2', 'SIM B2 UMUM', 'SIM C', 'SIM D');
										$array2 = array();
									    foreach ($plisence as $key => $value){
									        $array2[$key] = $value['plisence_type'];
									    }
									    $arraySIM = array_diff($array1, $array2);
										foreach ($arraySIM as $row) {
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
								<input type="text" name="plisence_date_end_sim" class="datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off" maxlength="10" />
	                            <div id="errorBDate"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Nomor SIM <b class="red">*</b></label>
								<input type="text" name="plisence_number_sim" class="num form-control input-sm required" maxlength="20">
							</div>
							<div class="form-group">
								<label>Tanggal dikeluarkan <b class="red">*</b></label>
								<input type="text" name="plisence_date_start_sim" class="datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off" maxlength="10" />
	                            <div id="errorBDate"></div>
							</div>
							<div class="form-group">
								<label>Unggah Berkas <b class="red">*</b></label>
								<input type="file" name="file_add_sim" id="file_add_sim" class="form-control input-sm">
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
					<div class="progress-sim bottommargin" style="display:none;">
		            	<div id="progress-bar-sim" class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
		            </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary" id="btn-add-sim" disabled="disabled">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="uploadLisence" tabindex="-1" role="dialog" aria-labelledby="LabelBerkas" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelBerkas">Unggah Berkas</h5>
				<button type="button" class="close" data-dismiss="modal" style="position: fixed;top: 15px;right: 20px;">×</button>
			</div>
			<form id="form-upload-lisence" method="post" action="#" enctype="multipart/form-data" role="form" class="nomargin">
				<input type="hidden" name="plisence_id" id="plisence_id">
				<div class="modal-body">
					<div class="form-group">
						<label for="ptipe" class="col-form-label">Jenis Berkas</label>
						<input type="text" class="form-control input-sm required" id="ptipe" readonly="readonly">
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
		            <div class="progress-berkas bottommargin" style="display:none;">
		            	<div id="progress-bar-lisence" class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
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

<script type="text/javascript" src="<?=site_url();?>../bssmitlab/_assets/global/select2/select2.min.js"></script>

<script type="text/javascript">
	$('#form-add-sim').validate();
	$('#form-upload-lisence').validate();
	$('#plisence_keluaran_sim').select2();

	$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});

	$('#showLisence').on('show.bs.modal', function (event) {
    	var button = $(event.relatedTarget)
		var image  = button.data('src')
		var modal  = $(this)
        modal.find(".showimage").attr("src", image);
    });
    $('#uploadLisence').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button    = $(event.relatedTarget) 
			var fid       = button.data('id')
			var ftipe     = button.data('tipe')
			var modal     = $(this)
			modal.find('#LabelBerkas').text('Unggah Berkas ' + ftipe)
			modal.find('#plisence_id').val(fid)
			modal.find('#ptipe').val(ftipe)
		}
	});

	$('.datepicker').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		startView: 2,
		daysOfWeekHighlighted: "0"
	});

	var url_lang = "<?=site_url();?>s_url/dt_language";
	var table1 = $('#tableLisence').DataTable({
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

	$(document).ready(function (e) {
		//SIM
		$('#file_add_sim').change(
            function(){
                if ($(this).val()) {
                    $('#btn-add-sim').attr('disabled',false);
					$("#form-add-sim").on("submit", (function(e) {
						e.preventDefault();
						var progressBar2 = $('#progress-bar-sim');
						
						if($("#form-add-sim").valid() == false){
							return false;
						} else {
							$.ajax({
								url: "<?=site_url();?>account/sadd_sim",
								type: "POST",
								data:  new FormData(this),
								contentType: false,
								cache: false,
								processData:false,
								success: function(data){
									if(data !== 'Success'){
										$('#addSIM').modal('hide');
										$('.progress-sim').hide();
										$('#btn-add-sim').removeClass('hidden');
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
											$('#btn-add-sim').addClass('hidden');
											progressBar2.css({width: percentComplete + "%"});
											progressBar2.text(percentComplete + '%');
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

		//LISENCE
        $('#file_lisence').change(
            function(){
                if ($(this).val()) {
                    $('#btn-lisence').attr('disabled',false);
					var progressBar3 = $('#progress-bar-lisence');
					$("#form-upload-lisence").on('submit',(function(e) {
						e.preventDefault();

						$.ajax({
							url: "<?=site_url();?>account/supload_lisence",
							type: "POST",
							data:  new FormData(this),
							contentType: false,
							cache: false,
							processData:false,
							success: function(data){
								if(data !== 'Success'){
									$('#uploadLisence').modal('hide');
									$('#progress-bar-lisence').hide();
									$('#btn-lisence').removeClass('hidden');
									swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
								} else {
									$('#uploadLisence').modal('hide');
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
										$('#btn-lisence').addClass('hidden');
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
    });
</script>