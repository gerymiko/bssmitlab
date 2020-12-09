<div class="feature-box media-box">
	<div class="fbox-desc">
		<h3>Berkas Sertifikat
			<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#addSertifikat">
				<span id="mobileshow"><i class="fa fa-plus"></i></span> <span class="desktop-view">Tambah</span>
			</button>
			<span class="subtitle f13">
				Unggah berkas Sertifikat Anda dengan format <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran maksimal <b>5Mb</b>.
			</span>
		</h3><br />
	</div>
</div>
<div class="bottommargin-xs">
	<input type="text" class="sm-form-control" name="cari_sertifikat" id="cari_sertifikat" placeholder="Cari . . ." >
</div>
<table id="tableCertificate" class="table table-border table-stripped" width="100%">
	<thead>
		<th class="center">No</th>
		<th>Nama Sertifikat</th>
		<th>Masa Berlaku</th>
		<th>Keterangan</th>
		<th class="center">Aksi</th>
	</thead>
</table>

<div class="modal fade" id="addSertifikat" role="dialog" aria-labelledby="LabelSertifikat" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelSertifikat">Tambah Sertifikat
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-add-certificate" enctype="multipart/form-data" method="post" action="#" role="form" class="nobottommargin">
				<div class="modal-body">
					<div>
						<input class="radio-style required" type="radio" id="available" value="available" name="certificate_id" onclick="show1();" checked="checked">
						<label class="radio-style-2-label radio-small bold" for="available">Sertifikat Tersedia</label>
		            </div>
					<div id="availablecertificate">
						<div class="form-group">
							<label class="col-form-label">Nama Sertifikat<b class="red">*</b></label>
							<select class="form-control" name="pcertificate_name1" id="pcertificate_name1">
								<option value="0">Pilih</option>
								<?php
									foreach ($list_certificate as $row) {
										echo '<option value="'.$row->certificate_id.'">'.$row->certificate_name.'</option>';
									}
								?>
							</select>
							<i>Jika sertifikat Anda tidak tersedia disistem kami, pilih menu <b>Sertifikat Lainnya</b> dibawah ini.</i>
						</div>
					</div>
					<div>
						<input class="radio-style required" type="radio" id="another" value="another" name="certificate_id" onclick="show2();">
						<label class="radio-style-2-label radio-small bold" for="another">Sertifikat Lainnya</label>
		            </div>
					<div id="anothercertificate" class="myDiv">
						<div class="form-group">
							<label class="col-form-label">Nama Sertifikat <b class="red">*</b></label>
							<input type="text" name="pcertificate_name2" maxlength="40" class="alphanum form-control required input-sm" id="pcertificate_name2" placeholder="Ketik disini bila sertifikat tidak ada didaftar . . ." />
						</div>
					</div>
					<hr>
					<div class="form-group">
						<label>Masa Berlaku <b class="red">*</b></label><br>
						<select class="form-control required input-sm" name="pcertificate_type" id="pcertificate_type">
							<option value="0">Pilih</option>
	                        <option value="1">Jangka Panjang</option>
	                        <option value="2">Periodik</option>
						</select>
						<div id="errorCertMasa"></div>
					</div>
					<div class="form-group" style="display: none;" id="pcertificate_validity">
						<label>Berlaku S/d <b class="red">*</b></label>
						<input type="text" id="pvalidity" name="pcertificate_validity" maxlength="10" class="datepicker form-control input-sm" placeholder="DD-MM-YYYY" autocomplete="off"/>
                        <br>
					</div>

					<div class="form-group">
						<label>Unggah Berkas <b class="red">*</b></label>
						<input type="file" name="pcertificate_file" id="pcertificate_file" class="form-control input-sm required">
					</div>
					<div class="form-group">
						<p class="nobottommargin">Ketentuan :</p>
						<ul>
							<ol>1. Mohon unggah file berformat <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran berkas maksimal <b>5Mb</b>.</ol>
							<ol>2. <b>Hanya sertifikat keahlian sesuai bidang</b>. Sertifikat seminar, bela diri, surat izin, KKN, Ijazah, praktikum, Piagam TIDAK TERMASUK dalam sertifikat yang kami butuhkan. </ol>
							<ol>3. <b>Perhatikan</b> dengan baik file yang akan Anda unggah, karena jika terjadi kesalahan unggah atau salah berkas sistem tidak dapat memperbaharui file Anda.</ol>
						</ul>
					</div>
					<div class="progress-certificate bottommargin" style="display:none;">
		            	<div id="progress-bar-certificate" class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
		            </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary" id="btn-add-certificate" disabled="disabled">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="showCertificate" tabindex="-1" role="dialog" aria-labelledby="LabelShow" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelShow">Lihat Berkas
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<div class="modal-body">
				<img class="showimagefile img-responsive" width="100%" src="" style="padding-bottom: 5px;">
				<i>* Reload halaman jika file masih tidak ada setelah unggah berkas.</i>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.myDiv{ display: none; }
</style>

<script type="text/javascript" src="<?=site_url();?>../bssmitlab/_assets/global/select2/select2.min.js"></script>

<script type="text/javascript">
	function show1(){
		document.getElementById('anothercertificate').style.display ='none';
		document.getElementById('availablecertificate').style.display = 'block';
		$("#pcertificate_name2").attr('disabled','disabled');
		$("#pcertificate_name1").removeAttr('disabled');
	}
	function show2(){
		document.getElementById('anothercertificate').style.display = 'block';
		document.getElementById('availablecertificate').style.display = 'none';
		$("#pcertificate_name1").attr('disabled','disabled');
		$("#pcertificate_name2").removeAttr('disabled');
	}

	$('#form-add-cert').validate();
	$('#pcertificate_name1').select2({dropdownParent: $('#addSertifikat')});

	$('.alphanum').alphanum({ allow: '-/()_ .', });

	var select = document.getElementById("pcertificate_type");
	select.onchange = function() {
	    if(select.value == "2") {
	       document.getElementById("pcertificate_validity").style.display = "inline";
	    } else {
	       document.getElementById("pcertificate_validity").style.display = "none";
	    }
	}

	$('#showCertificate').on('show.bs.modal', function (event) {
    	var button = $(event.relatedTarget)
		var image  = button.data('src')
		var modal  = $(this)
        modal.find(".showimagefile").attr("src", image);
    });

    $('.datepicker').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		startView: 2,
		daysOfWeekHighlighted: "0"
	});

	var url_lang = "<?=site_url();?>s_url/dt_language";
	var table4   = $('#tableCertificate').DataTable({
		"bLengthChange": false,
		"processing": true,
		"serverSide": true,
		"bInfo": false,
		"ajax": {
			"url"  : '<?=site_url()?>table_certificate',
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
                "targets": [ 1],
                "className": "text-left",
                "orderable": false,
                "width": "20%",
            },
            {
                "targets": [ 2],
                "className": "text-center",
                "searchable": false,
                "orderable": false,
                "width": "20%",
            },
            {
                "targets": [ 3],
                "className": "text-center",
                "searchable": false,
                "orderable": false,
                "width": "15%",
            },
            {
                "targets": [ 4 ],
                "className": "text-center",
                "searchable": false,
                "orderable": false,
                "width": "20%",
            },
        ],
	});
	$('#cari_sertifikat').keyup(function(){
	    table4.search($(this).val()).draw() ;
	});

	function delete_certificate(pcertificate_id){
		var table = $('#tableCertificate').DataTable();
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah Anda yakin ingin menghapus data sertifikat ini ?",
	        type: "warning",
	        showCancelButton: true,
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>account/delete_certificate",
					type: "post",
					data: {pcertificate_id:pcertificate_id},
					success:function(){
						table.ajax.reload();
						swal("Naiss!", "Data berhasil dihapus", "success");
					},
					error:function(){
						table.ajax.reload();
						swal("Oops!", "Data gagal dihapus. Reload halaman ini kemudian coba lagi.", "error");
					},
				});
			}
        });
  	};

	$(document).ready(function (e) {
		$('#pcertificate_file').change(
            function(){
                if ($(this).val()) {
                    $('#btn-add-certificate').attr('disabled',false);

					var progressBarCert = $('#progress-bar-certificate');

					$("#form-add-certificate").on('submit',(function(e) {
						e.preventDefault();

						if($("#form-add-certificate").valid() == false){
							return false;
						} else {
							$.ajax({
								url: "<?=site_url();?>account/sadd_certificate",
								type: "POST",
								data:  new FormData(this),
								contentType: false,
								cache: false,
								processData:false,
								success: function(data){
									if(data !== 'Success'){
										$('#addSertifikat').modal('hide');
										$('.progress-certificate').hide();
										$('#btn-add-certificate').removeClass('hidden');
										swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
									} else {
										$('#addSertifikat').modal('hide');
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
											$('#btn-add-certificate').addClass('hidden');
											$('.progress-certificate').show();
											progressBarCert.css({width: percentComplete + "%"});
											progressBarCert.text(percentComplete + '%');
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