<h4 style="margin-top: 0px;"><span class="label label-danger">MANAJEMEN DATA</span> Departemen - <small>Data keseluruhan departemen PT. BSS</small></h4>
<hr>
<div class="panel panel-invert">
	<div class="panel-heading">
		<div class="panel-title">
			<span class="label label-info">TOTAL DATA DEPARTEMEN : <?=$totalDepartemen;?></span>
		</div>
		<div class="panel-options">
			<a href="#modal-add-dept" data-toggle="modal" data-target="#modal-add-dept" class="btn btn-red white btn-xs" style="margin-top: 8px !important; padding: 5px"><i class="entypo-plus"></i> Departemen</a>
		</div>
	</div>
	<div class="panel-body">
		<table class="table table-hover table-bordered" id="tableDepartemen" style="background-color: #FFF;color: #000;">
			<thead>
				<tr>
					<th class="text-center bold">No</th>
					<th class="text-center bold">Kode DP</th>
					<th class="text-center bold">Nama Departemen</th>
					<th class="text-center bold">Status</th>
					<th class="text-center bold"><i class="fa fa-cogs"></i></th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div id="modal-add-dept" class="modal animated fadeIn all-modals modal-gray" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-primary"><i class="entypo-plus"></i> Departemen</span></h3>
			</div>
			<form role="form" method="post" id="adddept" name="adddept" class="validate">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><b>Kode Departemen</b></label>
					    <div><input type="text" name="KodeDP" class="form-control required" data-validate="required" maxlength="10" placeholder="Contoh : HRD"></div>
					</div>
					<div class="form-group">
						<label class="control-label"><b>Nama Departemen</b></label>
					    <div><input type="text" name="Nama" class="form-control required" data-validate="required" placeholder="Contoh : HRDGA" maxlength="25"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-icon" data-dismiss="modal">
							Batal
						<i class="entypo-cancel"></i>
					</button>
					<button type="button" name="submit" onclick="simpandept();" class="btn btn-red btn-icon">
							Simpan
						<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal animated fadeIn all-modals" id="modal-edit-dept">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-danger">Edit Departemen</span></h3>
			</div>
			<form role="form" method="post" id="editdept" name="editdept" class="validate">
				<input type="hidden" name="KodeDP" id="kodepakai">
				<div class="modal-body">
					<div class="modal-body">
						<div class="form-group">
							<label class="control-label"><b>Kode Departemen</b></label>
						    <div><input type="text" class="form-control" id="KodeDP" disabled></div>
						</div>
						<div class="form-group">
							<label class="control-label"><b>Nama Departemen</b></label>
						    <div><input type="text" name="Nama" id="Nama" class="form-control required" data-validate="required" maxlength="25"></div>
						</div>
						<div class="form-group">
							<label class="control-label">Status</label>
							<select class="form-control" name="department_status" id="status">
								<option value="1">Aktif</option>
								<option value="0">Non-Aktif</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" name="submit" onclick="simpaneditdept();" class="btn btn-primary btn-icon">
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
    	table = $('#tableDepartemen').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order":[],
			"ajax" : {
				"url"  : '<?php echo site_url('dtDepartment')?>',
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
					"width": "20%",
				},
				{
					"targets": [ 2 ],
					"className": "text-left"
				},
				{
					"targets": [ 3 ],
					"className": "text-center",
					"width": "10%",
					"orderable": false,
				},
				{
					"targets": [ 4 ],
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
				for (i = 0; i <= <?=$totalDepartemen;?>; i++) { 
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

	function simpandept(){
	 	var paramstr = $("#adddept").serialize();
		if($("#adddept").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?php echo base_url();?>adddepartment",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-add-dept').modal('hide');
					swal("Naiss!", "Data berhasil disimpan", "success");
					document.getElementById("adddept").reset();
					table.ajax.reload();
				} else {
					$('#modal-add-dept').modal('toggle');
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

	function simpaneditdept(){
	 	var paramstr = $("#editdept").serialize();
		if($("#editdept").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?php echo base_url();?>editdepartment",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-edit-dept').modal('toggle');
					swal("Naiss!", "Data berhasil disimpan", "success");
					table.ajax.reload();
				} else {
					$('#modal-edit-dept').modal('toggle');
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

	$(document).ready(function(){
	    var form = $('#adddept'),
	        original = form.serialize()

	    form.submit(function(){
	        window.onbeforeunload = null
	    })

	    window.onbeforeunload = function(){
	        if (form.serialize() != original)
	            return 'Are you sure you want to leave?'
	    }
	})

	$('#modal-edit-dept').on('show.bs.modal', function (event) {
		var button    = $(event.relatedTarget)
		var kodedp    = button.data('kodedp')
		var kodepakai = button.data('kodepakai')
		var nama      = button.data('nama')
		var status    = button.data('status')
		var modal     = $(this)
		modal.find('#KodeDP').val(kodedp)
		modal.find('#kodepakai').val(kodepakai)
		modal.find('#Nama').val(nama)
		modal.find('#status').val(status)
	})
</script>