<div class="feature-box media-box">
	<div class="fbox-desc">
		<h3>Pendidikan Formal 
			<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#editFormal">
				<span id="mobileshow"><i class="fa fa-pencil-alt"></i></span> <span class="desktop-view">Ubah</span>
			</button>
			<span class="subtitle">
				Daftarkan hanya pendidikan terakhir saja.
			</span>
		</h3><br />
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<p class="nobottommargin"><b><?=$dedufor->edutype_name;?></b></p>
		<small>Jenjang Pendidikan</small>
		<div style="padding: 5px;"></div>
		<p class="nobottommargin"><b><?=ucfirst($dedufor->edu_name);?></b></p>
		<small>Nama Sekolah / Perguruan Tinggi / Universitas</small>
		<div style="padding: 5px;"></div>
		<p class="nobottommargin"><b><?=$dedufor->major_name;?></b></p>
		<small>Jurusan</small>
		<div style="padding: 5px;"></div>
	</div>
	<div class="col-sm-6">
		<p class="nobottommargin"><b><?=date("Y", strtotime($dedufor->edu_tahun_lulus));?></b></p>
		<small>Tahun Lulus</small>
		<div style="padding: 5px;"></div>
		<p class="nobottommargin"><b><?=($dedufor->edu_keterangan == NULL) ? "-" : ucfirst($dedufor->edu_keterangan);?></b></p>
		<small>Keterangan</small>
		<div style="padding: 5px;"></div>
	</div>
</div>

<div class="divider"><i class="icon-circle"></i></div>

<div class="feature-box media-box">
	<div class="fbox-desc">
		<h3>Pendidikan Informal
			<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#addInformal">
				<span id="mobileshow"><i class="fa fa-plus"></i></span> <span class="desktop-view">Tambah</span>
			</button>
			<span class="subtitle" style="font-size: 13px;">Pendidikan informal mencakup dari pelatihan, sertifikasi, dan keahlian bidang.</span>
		</h3>
	</div><br />
	<div class="bottommargin-xs">
		<input type="text" class="sm-form-control" name="cari_informal" id="cari_informal" placeholder="Cari . . .">
	</div>
	<div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;">
		<table id="tableInformal" class="table table-hover table-bordered nobottommargin" width="100%" style="border: 2px solid #DDDDDD;">
			<thead class="bg-darkgray">
				<th class="text-center">No</th>
				<th>Nama Pelatihan</th>
				<th>Penyelenggara</th>
				<th>Masa</th>
				<th>Keterangan</th>
				<th><i class="fa fa-cog"></i></th>
			</thead>
		</table>
	</div>
	<span id="mobileshow"><i>* Geser untuk melihat tombol ubah/hapus data</i></span>
</div>
<br />

<div class="modal fade" id="addInformal" tabindex="-1" role="dialog" aria-labelledby="LabelInformal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelInformal">Tambah Pelatihan / Sertifikasi
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-add-informal" method="post" role="form" class="nobottommargin">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-form-label">Nama Pelatihan <b class="red">*</b></label>
						<input type="text" name="informaledu_name" maxlength="100" class="alphanum form-control input-sm required" placeholder="Ketik disini . . ." />
					</div>
					<div class="form-group">
						<label class="col-form-label">Nama Tempat Penyelenggara <b class="red">*</b></label>
						<input type="text" name="informaledu_tempat" maxlength="100" class="alphanum form-control input-sm required" placeholder="Ketik disini . . ." />
					</div>
					<label>Masa Pelatihan</label>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Dari <b class="red">*</b></label>
								<input type="text" name="informaledu_dari" maxlength="10" class="datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Sampai <b class="red">*</b></label>
								<input type="text" name="informaledu_sampai" maxlength="10" class="datepicker form-control input-sm required" placeholder="DD-MM-YYYY" autocomplete="off"/>
							</div>	
						</div>
					</div>
					<div class="form-group">
						<label class="col-form-label">Keterangan <b class="red">*</b></label>
						<textarea class="alphanum form-control required" rows="2" maxlength="100" name="informaledu_keterangan" placeholder="Ketik disini . . ."></textarea>
					</div>
					<i><small><b>Catatan</b> : Kolom bertanda (*) wajib diisi.</small></i>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" class="btn btn-primary" onclick="save_add_informal();">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editFormal" style="overflow:hidden;" role="dialog" aria-labelledby="LabelFormal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white" id="LabelFormal">Ubah Pendidikan Formal
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-edit-eduformal" method="post" role="form" class="nomargin">
				<input type="hidden" name="peducation_id" value="<?=$dedufor->peducation_id;?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Jenjang Pendidikan <b class="red">*</b></label>
								<select class="form-control input-sm required" name="edutype_id">
									<option selected="selected" class="bgcolor white" value="<?=($dedufor->edutype_id !== NULL) ? ucfirst($dedufor->edutype_id) : 0;?>"><?=$dedufor->edutype_name;?> (Selected)</option>
									<?php
										foreach ($list_edu as $row) {
											echo '<option value="'.$row->edutype_id.'">'.$row->edutype_name.'</option>';
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Nama Sekolah / Perguruan Tinggi / Univ. <b class="red">*</b></label>
								<input type="text" class="form-control input-sm required capitalize" maxlength="100" name="edu_name" value="<?=$dedufor->edu_name;?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Kota <b class="red">*</b></label>
								<select class="form-control required" name="edu_place" id="edu_place">
									<option value="0">Pilih Kota</option>
			                        <?php
			                            foreach ($kota as $row) {
			                                echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
			                            }
			                        ?>	
								</select>
								<div id="errorKotaEdu"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Jurusan <b class="red">*</b></label>
								<select name="edu_jurusan" id="edu_jurusan" class="form-control required">
									<option value="0">Pilih Jurusan</option>
                                    <?php
                                        foreach ($major as $row) {
                                            echo '<option value="'.$row->major_id.'">'.$row->major_name.'</option>';
                                        }
                                    ?>
                                </select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Tahun Lulus <b class="red">*</b></label>
								<input type="text" name="edu_tahun_lulus" maxlength="10" class="datepicker form-control input-sm required" value="<?=date("d-m-Y", strtotime($dedufor->edu_tahun_lulus));?>" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-form-label">Keterangan <b class="red">*</b></label>
						<textarea class="alphanum form-control input-sm required" rows="2" maxlength="100" name="edu_keterangan"><?=$dedufor->edu_keterangan;?></textarea>
					</div>
					<i><small><b>Catatan</b> : Kolom bertanda (*) wajib diisi.</small></i>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="save_edit_eduformal();" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editInformal" tabindex="-1" role="dialog" aria-labelledby="LabelInformal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelInformal">Ubah Pelatihan / Sertifikasi
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-edit-informal" method="post" role="form" class="nobottommargin">
				<input type="hidden" name="informaledu_id" id="informaledu_id">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-form-label">Nama Pelatihan <b class="red">*</b></label>
						<input type="text" name="informaledu_name" maxlength="100" class="alphanum form-control input-sm required" id="informaledu_name" />
					</div>
					<div class="form-group">
						<label class="col-form-label">Nama Tempat Penyelenggara <b class="red">*</b></label>
						<input type="text" name="informaledu_tempat" maxlength="100" class="alphanum form-control input-sm required" id="informaledu_tempat" />
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Dari <b class="red">*</b></label>
								<input type="text" name="informaledu_dari" maxlength="10" class="datepicker form-control input-sm required" autocomplete="off" id="informaledu_dari" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Sampai <b class="red">*</b></label>
								<input type="text" name="informaledu_sampai" maxlength="10" class="datepicker form-control input-sm required" autocomplete="off" id="informaledu_sampai" />
							</div>	
						</div>
					</div>
					<div class="form-group">
						<label class="col-form-label">Keterangan <b class="red">*</b></label>
						<textarea class="alphanum form-control required" rows="2" maxlength="100" name="informaledu_keterangan" id="informaledu_keterangan"></textarea>
					</div>
					<i><small><b>Catatan</b> : Kolom bertanda (*) wajib diisi.</small></i>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" class="btn btn-primary" onclick="save_edit_informal();">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=site_url();?>../bssmitlab/_assets/global/select2/select2.min.js"></script>

<script type="text/javascript">
	$('#edu_place').val(<?=($dedufor->city_id !== NULL) ? $dedufor->city_id : 0;?>).trigger('change');
	$('#edu_jurusan').val(<?=($dedufor->edu_jurusan !== NULL) ? $dedufor->edu_jurusan : 0;?>).trigger('change');

	$('#edu_jurusan').select2({ placeholder: "Pilih Jurusan" });
	$('#edu_place').select2({ placeholder: "Pilih Kota" });

	$('.alphanum').alphanum({ allow: '-/()_ .', });

	$('.datepicker').datepicker({
		autoclose: true,
		format: "dd-mm-yyyy",
		todayHighlight: true,
		startView: 2,
		daysOfWeekHighlighted: "0"
	});
	
	var url_lang = "<?=site_url();?>s_url/dt_language";
	var table3 = $('#tableInformal').DataTable( {
		"processing" : true,
		"serverSide" : true,
		"bInfo": false,
		"bLengthChange": false,
		"pageLength": 5,
		"ajax" : {
			"url"  : '<?=site_url()?>table_informal',
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
                "targets": [ 1, 2 ],
                "className": "text-left"
            },
            {
                "targets": [ 3 ],
                "className": "text-center",
                "searchable": false,
                "orderable": false,
                "width": "5%",
            },
            {
                "targets": [ 4 ],
                "className": "text-left",
                "searchable": false,
                "orderable": false,
                "width": "15%",
            },
            {
                "targets": [ 5 ],
                "className": "text-center",
                "searchable": false,
                "orderable": false,
                "width": "10%",
            }
        ],
	});
	$('#cari_informal').keyup(function(){
	    table3.search($(this).val()).draw() ;
	});

	$('#editInformal').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button      = $(event.relatedTarget) 
			var fid         = button.data('id')
			var fnama       = button.data('nama')
			var ftempat     = button.data('tempat')
			var fdari       = button.data('dari')
			var fsampai     = button.data('sampai')
			var fketerangan = button.data('keterangan')
			var modal       = $(this)
			modal.find('#informaledu_id').val(fid)
			modal.find('#informaledu_name').val(fnama)
			modal.find('#informaledu_tempat').val(ftempat)
			modal.find('#informaledu_dari').val(fdari)
			modal.find('#informaledu_sampai').val(fsampai)
			modal.find('#informaledu_keterangan').val(fketerangan)
		}
	});

	function save_edit_eduformal(){
		var paramstr = $("#form-edit-eduformal").serialize();
		if($("#form-edit-eduformal").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>account/sedit_eduformal",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#editFormal').modal('hide');
					swal({
						title: "Naiss!", 
						text: "Data berhasil diperbaharui", 
						type: "success"}).then(function(){ 
							location.reload();
						}
					);
				} else {
					$('#editFormal').modal('hide');
					swal("Oops!", "Gagal diproses. Coba lagi", "error");
				}
			});	
		}
	}

	function save_add_informal(){
	 	var paramstr = $("#form-add-informal").serialize();
	 	var table    = $('#tableInformal').DataTable();
		if($("#form-add-informal").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>account/sadd_informal",
			paramstr,
			function(data) {
				if(data){
					$('#addInformal').modal('hide');
					swal("Naiss!", "Data berhasil disimpan", "success");
					table.ajax.reload();
				} else {
					$('#addInformal').modal('hide');
					swal("Oops!", "Data gagal disimpan", "error");
					table.ajax.reload();
				}
			});	
		}
	}

	function save_edit_informal(){
		var paramstr = $("#form-edit-informal").serialize();
		var table    = $('#tableInformal').DataTable();
		if($("#form-edit-informal").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>account/sedit_informal",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#editInformal').modal('hide');
					swal("Naiss!", "Data berhasil diperbaharui", "success");
					table.ajax.reload();
				} else {
					$('#editInformal').modal('hide');
					swal("Oops!", "Gagal diproses. Coba lagi", "error");
					table.ajax.reload();
				}
			});	
		}
	}

	function delete_informal(informaledu_id){
		var table = $('#tableInformal').DataTable();
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah Anda yakin ingin menghapus data ini ?",
	        type: "warning",
	        showCancelButton: true,
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>account/delete_informal",
					type: "post",
					data: {informaledu_id:informaledu_id},
					success:function(){
						table.ajax.reload();
						swal("Naiss!", "Data berhasil dihapus", "success");
					},
					error:function(){
						table.ajax.reload();
						swal("Oops!", "Data gagal dihapus. Coba lagi", "error");
					},
				});
			}
        });
  	};
</script>