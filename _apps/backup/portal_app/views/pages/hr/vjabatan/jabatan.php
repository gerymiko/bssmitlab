<h4 style="margin-top: 0px;"><span class="label label-danger">MANAJEMEN DATA</span> Jabatan - <small>Data keseluruhan Jabatan PT. BSS</small></h4>
<hr>
<div class="panel panel-invert">
	<div class="panel-heading">
		<div class="panel-title">
			<span class="label label-warning">TOTAL DATA JABATAN : <?=$totalJabatan;?></span>
		</div>
		<div class="panel-options">
			<a href="#modal-add-jabatan" data-toggle="modal" data-target="#modal-add-jabatan" class="btn btn-red white btn-xs" style="margin-top: 8px !important; padding: 5px"><i class="entypo-plus"></i> Jabatan</a>
			<a href="#modal-tahapan" data-toggle="modal" data-target="#modal-tahapan" class="btn btn-red white" style="margin-top: 8px !important; padding: 5px"><i class="entypo-plus"></i> Tahapan Tes</a>
		</div>
	</div>
	<div class="panel-body">
		<table class="table table-hover table-bordered" id="tableJabatan" style="background-color: #FFF;color: #000;">
			<thead>
				<tr>
					<th class="text-center bold">No</th>
					<th class="text-center bold">Kode DP</th>
					<th class="text-center bold">Kode JB</th>
					<th class="text-center bold">Nama Jabatan</th>	
					<th class="text-center bold">Status</th>
					<th class="text-center bold"><i class="fa fa-cogs"></i></th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div id="modal-add-jabatan" class="modal animated fadeIn all-modals modal-gray" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-primary"><i class="entypo-plus"></i> Jabatan</span></h3>
			</div>
			<form role="form" method="post" id="addjabatan" name="addjabatan" class="validate">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><b>Pilih Departemen</b>
							<span data-balloon-length="large" data-balloon="Jika tidak ada daftar departemen yang dicari, tambahkan terlebih dulu dimenu Departemen" data-balloon-pos="up" >
	                            <i class="entypo-info-circled"></i>
	                        </span>
						</label>
						<div class="side-by-side clearfix">
	                        <select name="KodeDP" id="KodeDPZ" class="js-example-theme-multiple required" maxlength="50" tabindex="2" data-validate="required">
	                            <option value="">Pilih</option>
	                            <?php
	                            	foreach ($listdept as $row) {
	                            		echo '<option value="'.$row->KodeDP.'">'.$row->Nama.'</option>';
	                            	}
	                            ?>
	                        </select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="control-label"><b>Kode Jabatan</b></label>
					    <div><input type="text" name="KodeJB" class="form-control required" data-validate="required" maxlength="10" placeholder="Contoh : HRD026"></div>
					</div>
					<div class="form-group">
						<label class="control-label"><b>Nama Jabatan</b></label>
					    <div><input type="text" name="Nama" class="form-control required" data-validate="required" placeholder="Contoh : Supervisor Trainer" maxlength="35"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-icon" data-dismiss="modal">
							Batal
						<i class="entypo-cancel"></i>
					</button>
					<button type="button" name="submit" onclick="simpanjabatan();" class="btn btn-red btn-icon">
							Simpan
						<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal animated fadeIn all-modals" id="modal-edit-jabatan">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-danger">Edit Departemen</span></h3>
			</div>
			<form role="form" method="post" id="editjabatan" name="editjabatan" class="validate">
				<input type="hidden" name="KodeJB" id="kodepake">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><b>Pilih Departemen</b>
							<span data-balloon-length="large" data-balloon="Jika tidak ada daftar departemen yang dicari, tambahkan terlebih dulu dimenu Departemen" data-balloon-pos="up" >
	                            <i class="entypo-info-circled"></i>
	                        </span>
						</label>
						<div class="side-by-side clearfix">
	                        <select name="KodeDP" id="KodeDPs" class="js-example-theme-multiple required" maxlength="50" tabindex="2" data-validate="required">
	                            <option value="">Pilih</option>
	                            <?php
	                            	foreach ($listdept as $row) {
	                            		echo '<option value="'.$row->KodeDP.'">'.$row->Nama.'</option>';
	                            	}
	                            ?>
	                        </select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="control-label"><b>Kode Jabatan</b></label>
					    <div><input type="text" class="form-control" id="KodeJB" disabled></div>
					</div>
					<div class="form-group">
						<label class="control-label"><b>Nama Jabatan</b></label>
					    <div><input type="text" name="Nama" id="Nama" class="form-control required" data-validate="required" maxlength="25"></div>
					</div>
					<div class="form-group">
						<label class="control-label">Status</label>
						<select class="form-control" name="status_jabatan" id="status">
							<option value="1">Aktif</option>
							<option value="0">Non-Aktif</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" name="submit" onclick="simpaneditjabatan();" class="btn btn-primary btn-icon">
							Simpan
						<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal-tahapan" class="modal animated fadeIn all-modals modal-gray" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-warning">Tahapan Tes</span></h3>
			</div>
			<form role="form" method="post" id="tahapanseleksi" name="tahapanseleksi" class="validate">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><b>Pilih Jabatan</b></label>
						<div class="side-by-side clearfix">
	                        <select name="jabatan" id="jabatan" class="js-example-theme-multiple required" maxlength="50" tabindex="2" data-validate="required">
	                            <option value="">Pilih</option>
	                            <?php
	                            	foreach ($listjabatan as $row) {
	                            		echo '<option value="'.$row->KodeJB.'">'.$row->Nama.' ('.$row->KodeDP.')</option>';
	                            	}
	                            ?>
	                        </select>
	                    </div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><strong>Tahapan Tes</strong></label>
								<div id="tahapantes"></div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button class="btn btn-default btn-icon" data-dismiss="modal">
							Tutup
						<i class="entypo-cancel"></i>
					</button>
					<button type="button" name="submit" onclick="simpantahapanseleksi();" class="btn btn-red btn-icon">
							Simpan
						<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

 	var table;

	$(document).ready(function() {
    	table = $('#tableJabatan').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order":[],
			"ajax" : {
				"url"  : '<?php echo site_url('dtJabatan')?>',
				"type" : "POST",
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
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
					"width": "10%",
				},
				{
					"targets": [ 2 ],
					"className": "text-center",
					"width": "10%",
				},
				{
					"targets": [ 3 ],
					"className": "text-left"
				},
				{
					"targets": [ 4, 5 ],
					"className": "text-center",
					"orderable": false,
					"searchable": false,
					"width": "10%",
				}
			],
			"language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
			"fnDrawCallback": function (oSettings){
                var i;
				for (i = 0; i <= <?=$totalJabatan;?>; i++) { 
				    $(this).find('#ubah'+[i]).each(function () {
                    	var sTitle;
                    	sTitle = 'Ubah';
                    	this.setAttribute('rel', 'tooltip');
                    	this.setAttribute('title', sTitle);
	                    $(this).tooltip({
	                        html: true
	                    });
	                });
	                $(this).find('#hapus'+[i]).each(function () {
                    	var sTitle;
                    	sTitle = 'Hapus';
                    	this.setAttribute('rel', 'tooltip');
                    	this.setAttribute('title', sTitle);
	                    $(this).tooltip({
	                        html: true
	                    });
	                });
				}
            }
		});
	});

	jQuery(document).ready(function(){
	    jQuery("body").append( jQuery(".page-container .all-modals") );
	});

	$(document).ready(function() {
		$('#KodeDPZ').select2();
		$('#KodeDPs').select2();
		$('#jabatan').select2();
	});

	function simpanjabatan(){
	 	var paramstr = $("#addjabatan").serialize();
		if($("#addjabatan").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?php echo base_url();?>addjabatan",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-add-jabatan').modal('toggle');
					swal("Naiss!", "Data berhasil disimpan", "success");
					document.getElementById("addjabatan").reset();
					table.ajax.reload();
				} else {
					$('#modal-add-jabatan').modal('toggle');
					swal({
					    title: "Oops!",   
					    text: "Terjadi kesalahan saat memproses !",   
					    type: "error" 
					});
					table.ajax.reload();
				}
			});	
		}
	}

	function simpaneditjabatan(){
	 	var paramstr = $("#editjabatan").serialize();
		if($("#editjabatan").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?php echo base_url();?>editjabatan",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-edit-jabatan').modal('toggle');
					swal("Naiss!", "Data berhasil disimpan", "success");
					table.ajax.reload();
				} else {
					$('#modal-edit-jabatan').modal('toggle');
					swal({
					    title: "Oops!",   
					    text: "Terjadi kesalahan saat memproses !",   
					    type: "error" 
					});
					table.ajax.reload();
				}
			});	
		}
	}

	$('#modal-edit-jabatan').on('show.bs.modal', function (event) {
		var button    = $(event.relatedTarget)
		var kodedp    = button.data('kodedp')
		var kodepake  = button.data('kodepake')
		var kodejb    = button.data('kodejb')
		var nama      = button.data('nama')
		var status    = button.data('status')
		var modal     = $(this)
		modal.find('#KodeDPs').val(kodedp)
		modal.find('#kodepake').val(kodepake)
		modal.find('#KodeJB').val(kodejb)
		modal.find('#Nama').val(nama)
		modal.find('#status').val(status)
	});

	$(document).ready(function(){
    	$('#jabatan').change(function() {
    		var opt = 'jabatan=' + $(this).val();
    		$.ajax({
    			type: "POST",
    			url: "../getTahapan",
    			data: opt,
    			success:function(data){
    				$("#tahapantes").html(data);
    			}
    		});
    	});
    });

    function simpantahapanseleksi(){
	 	var paramstr = $("#tahapanseleksi").serialize();
		if($("#tahapanseleksi").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?php echo base_url();?>simpantahapanseleksi",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-tahapan').modal('hide');
					swal("Naiss!", "PIC berhasil disimpan", "success");
					table.ajax.reload();
				} else {
					$('#modal-tahapan').modal('hide');
					swal({
					    title: "Oops!",   
					    text: "Terjadi kesalahan saat memproses! Coba lagi",   
					    type: "error" 
					});
					$('#modal-add-pic').modal('hide');
				}
			});	
		}
	}
</script>