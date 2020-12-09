<div class="feature-box media-box">
	<div class="fbox-desc">
		<h3>Alamat 
			<span class="subtitle">
				Tentang alamat sesuai KTP dan alamat domisili
			</span>
		</h3><br />
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<p class="nobottommargin"><b><?=ucwords($daddktp->address);?></b></p>
		<small>Alamat KTP</small>
		<div style="padding: 5px;"></div>
		<p class="nobottommargin"><b><?=$daddktp->city_name;?></b></p>
		<small>Kota</small>
		<div style="padding: 5px;"></div>
		<p class="nobottommargin"><b><?=$daddktp->zip_code;?></b></p>
		<small>Kode Pos</small>
		<div style="padding: 5px;"></div>
		<button class="btn btn-sm btn-primary nomargin" data-toggle="modal" data-target="#editAddress1" data-id1="<?=$daddktp->paddress_id;?>" data-type1="<?=$daddktp->paddress_type;?>" data-address1="<?=$daddktp->address;?>" data-zip1="<?=$daddktp->zip_code;?>">Ubah</button>
		<div style="padding: 10px;"></div>
	</div>
	<div class="col-sm-6">
		<p class="nobottommargin"><b><?=ucwords($dadddom->address);?></b></p>
		<small>Alamat Domisili</small>
		<div style="padding: 5px;"></div>
		<p class="nobottommargin"><b><?=$dadddom->city_name;?></b></p>
		<small>Kota Domisili</small>
		<div style="padding: 5px;"></div>
		<p class="nobottommargin"><b><?=$dadddom->zip_code;?></b></p>
		<small>Kode Pos</small>
		<div style="padding: 5px;"></div>
		<button class="btn btn-sm btn-primary nomargin" data-toggle="modal" data-target="#editAddress2" data-id2="<?=$dadddom->paddress_id;?>" data-type2="<?=$dadddom->paddress_type;?>" data-address2="<?=$dadddom->address;?>" data-zip2="<?=$dadddom->zip_code;?>">Ubah</button>
		<div style="padding: 10px;"></div>
	</div>
</div>

<div class="modal fade" id="editAddress1" tabindex="-1" role="dialog" aria-labelledby="LabelAddress1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelAddress1">Ubah Alamat KTP</h5>
				<button type="button" class="close" data-dismiss="modal" style="position: fixed;top: 15px;right: 20px;">×</button>
			</div>
			<form id="form-edit-address1" method="post" role="form" class="nomargin">
				<input type="hidden" name="paddress_id1" id="paddress_id1">
				<input type="hidden" name="paddress_type1" id="paddress_type1">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-form-label">Alamat <b class="red">*</b></label>
						<textarea class="alphanum form-control input-sm required" name="address1" id="address1" rows="2"></textarea>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Kota <b class="red">*</b></label><br>
								<select class="form-control required" name="paddress_city1" id="paddress_city1">
			                        <?php
			                            foreach ($kota as $row) {
			                                echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
			                            }
			                        ?>	
								</select>
								<div id="errorAdd1"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Kode Pos <b class="red">*</b></label>
								<input type="text" class="num form-control input-sm required" maxlength="7" name="zip_code1" id="zip_code1">
							</div>
						</div>
					</div>
					<i><small><b>Catatan</b> : Kolom bertanda (*) wajib diisi.</small></i>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="save_edit_address1();" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editAddress2" tabindex="-1" role="dialog" aria-labelledby="LabelAddress2" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelAddress2">Ubah Alamat Domisili</h5>
				<button type="button" class="close" data-dismiss="modal" style="position: fixed;top: 15px;right: 20px;">×</button>
			</div>
			<form id="form-edit-address2" method="post" role="form" class="nomargin">
				<input type="hidden" name="paddress_id2" id="paddress_id2">
				<input type="hidden" name="paddress_type2" id="paddress_type2">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-form-label">Alamat <b class="red">*</b></label>
						<textarea class="alphanum form-control input-sm required" name="address2" id="address2" rows="2"></textarea>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Kota <b class="red">*</b></label><br>
								<select class="form-control required" name="paddress_city2" id="paddress_city2">
			                        <?php
			                            foreach ($kota as $row) {
			                                echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
			                            }
			                        ?>	
								</select>
								<div id="errorAdd2"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Kode Pos <b class="red">*</b></label>
								<input type="text" class="num form-control input-sm required" maxlength="7" name="zip_code2" id="zip_code2">
							</div>
						</div>
					</div>
					<i><small><b>Catatan</b> : Kolom bertanda (*) wajib diisi.</small></i>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="save_edit_address2();" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<link rel="stylesheet" href="<?=site_url();?>../bssmitlab/_assets/global/select2/select2.min.css">
<script type="text/javascript" src="<?=site_url();?>../bssmitlab/_assets/global/select2/select2.min.js"></script>

<script type="text/javascript">
	$('#paddress_city1').val(<?=($daddktp->city_id !== NULL) ? $daddktp->city_id : 0;?>).trigger('change');
	$('#paddress_city2').val(<?=($dadddom->city_id !== NULL) ? $dadddom->city_id : 0;?>).trigger('change');

	$('#paddress_city1').select2({dropdownParent: $('#editAddress1')});
	$('#paddress_city2').select2({dropdownParent: $('#editAddress2')});

	$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});
	$('.numdate').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false});
	$('.alpha').alphanum({allowNumeric: false});
	$('.alphanum').alphanum({ allow: '-/()_ .', });

	$('#editAddress1').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button    = $(event.relatedTarget) 
			var fid1      = button.data('id1')
			var ftipe1    = button.data('type1')
			var faddress1 = button.data('address1')
			var fzip1     = button.data('zip1')
			var modal     = $(this)
			modal.find('.modal-title white').text('Alamat ' + ftipe1)
			modal.find('#paddress_id1').val(fid1)
			modal.find('#address1').val(faddress1)
			modal.find('#zip_code1').val(fzip1)
			modal.find('#paddress_type1').val(ftipe1)
		}
	});

	$('#editAddress2').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button    = $(event.relatedTarget) 
			var fid2      = button.data('id2')
			var ftipe2    = button.data('type2')
			var faddress2 = button.data('address2')
			var fzip2     = button.data('zip2')
			var modal     = $(this)
			modal.find('.modal-title white').text('Alamat ' + ftipe2)
			modal.find('#paddress_id2').val(fid2)
			modal.find('#address2').val(faddress2)
			modal.find('#zip_code2').val(fzip2)
			modal.find('#paddress_type2').val(ftipe2)
		}
	});

	function save_edit_address1(){
		var paramstr = $("#form-edit-address1").serialize();
		if($("#form-edit-address1").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>save_edit_address_ktp",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#editAddress1').modal('hide');
					swal({
						title: "Naiss!", 
						text: "Data berhasil diperbaharui", 
						type: "success"}).then(function(){ 
							location.reload();
						}
					);
				} else {
					$('#editAddress1').modal('hide');
					swal("Oops!", "Gagal diproses. Coba lagi", "error");
				}
			});	
		}
	}

	function save_edit_address2(){
		var paramstr = $("#form-edit-address2").serialize();
		if($("#form-edit-address2").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>save_edit_address_domisili",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#editAddress2').modal('hide');
					swal({
						title: "Naiss!", 
						text: "Data berhasil diperbaharui", 
						type: "success"}).then(function(){ 
							location.reload();
						}
					);
				} else {
					$('#editAddress2').modal('hide');
					swal("Oops!", "Gagal diproses. Coba lagi", "error");
				}
			});	
		}
	}
</script>