<h4 style="margin-top: 0px;"><span class="label label-info">MASTER REKRUTMEN</span> Master Syarat - <small>Data keseluruhan syarat wajib</small></h4>
<hr>
<div class="panel panel-invert">
	<div class="panel-heading">
		<div class="panel-title">
			DATA SYARAT	
		</div>
		<div class="panel-options">
			<a href="#modal-add-syarat" data-toggle="modal" data-target="#modal-add-syarat" class="btn btn-red white" style="margin-top: 8px !important; padding: 5px"><i class="entypo-plus"></i> Syarat Wajib</a>
		</div>
	</div>
	<div class="panel-body">
		<table class="table table-hover table-bordered" id="tableMasterSyarat" style="background: #fff;color: #000;">
			<thead>
				<tr>
					<th class="text-center bold">No</th>
					<th class="text-center bold">Syarat Wajib</th>
					<th class="text-center bold">Jabatan</th>
					<th class="text-center bold">Status</th>
					<th class="text-center bold"><i class="fa fa-cogs"></i></th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div id="modal-add-syarat" class="modal animated fadeIn all-modals modal-gray" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-primary">+ Syarat Wajib</span></h3>
			</div>
			<form role="form" method="post" id="addmastersyarat" name="addssyarat" class="validate">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><b>Jabatan</b></label>
						<div class="side-by-side clearfix">
	                        <select name="KodeJB" id="KodeJB2" class="js-example-theme-multiple required" maxlength="50" tabindex="2" data-validate="required">
	                            <option value="">Pilih</option>
	                            <option value="0">Seluruh Jabatan</option>
	                            <?php
	                            	foreach ($listjabatan as $row) {
	                            		echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.'</option>';
	                            	}
	                            ?>
	                        </select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="control-label"><b>Syarat Wajib</b></label>
					    <div><input type="text" name="syarat_name[]" class="form-control required" data-validate="required"></div>
					</div>
					<div class="input_fields_wrap"></div>
					<a class="add_field_button pull-right" href="#">+ Tambahkan lagi</a>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default btn-icon" data-dismiss="modal">
							Tutup
						<i class="entypo-cancel"></i>
					</button>
					<button type="button" name="submit" onclick="simpansyarat();" class="btn btn-red btn-icon">
							Simpan
						<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal animated fadeIn all-modals" id="modal-edit-syarat">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-danger">Edit Syarat</span></h3>
			</div>
			<form role="form" method="post" id="editsyarat" name="editsyarat" class="validate">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="syarat_id" class="form-control" id="syarat_id">
					</div>
					<div class="form-group">
						<label class="col-form-label">Jabatan</label>
						<input type="text" class="form-control" id="jabatan" disabled="disabled">
					</div>
					<div class="form-group">
						<label class="col-form-label">Syarat</label>
						<input type="text" name="syarat_name" class="form-control" id="syarat_name" maxlength="100">
					</div>
					<div class="form-group">
						<label class="col-form-label">Status Syarat</label>
						<select class="form-control" name="syarat_status" id="syarat_status">
							<option value="0">Non-Aktif</option>
							<option value="1">Aktif</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" name="submit" onclick="simpaneditsyarat();" class="btn btn-primary btn-icon">
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
    	table = $('#tableMasterSyarat').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtMasterSyarat')?>',
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
	                "width": "2%"
	            },
	            {
					"targets": [ 1 ],
					"className": "text-left",
					"orderable": false,
				},
				{
					"targets": [ 2 ],
					"className": "text-left"
				},
				{
					"targets": [ 3 ],
					"className": "text-center",
					"orderable": false,
				},
				{
					"targets": [ 4 ],
					"className": "text-center",
					"orderable": false,
					"searchable": false,
					"width": "8%"
				}
	        ],
	        "language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
			"createdRow": function( row, data, dataIndex){
                if( data[3] ==  `Non-Aktif`){
                    $(row).addClass('red-bg');
                }
            },
		});
	});

	jQuery(document).ready(function(){
	    jQuery("body").append( jQuery(".page-container .all-modals") );
	});

	$(document).ready(function() {
		$('#KodeJB2').select2();
	});

	$(document).ready(function() {
	    var max_fields      = 10; 
	    var wrapper         = $(".input_fields_wrap"); 
	    var add_button      = $(".add_field_button"); 
	    
	    var x = 1; 
	    $(add_button).click(function(e){ 
	        e.preventDefault();
	        if(x < max_fields){ 
	            x++; 
	            $(wrapper).append('<div class="form-group"><div class="row"><div class="col-sm-10"><input type="text" name="syarat_name[]" class="form-control"/></div><div class="col-sm-2"><div style="padding-top: 5px"></div><a href="#" class="btn btn-red btn-xs remove_field"><i class="entypo-cancel"></i></a></div></div></div>'); 
	        }
	    });
	    
	    $(wrapper).on("click",".remove_field", function(e){
	        e.preventDefault(); $(this).parent().parent().remove(); x--;
	    })
	});

	function simpansyarat(){
	 	var paramstr = $("#addmastersyarat").serialize();
		if($("#addmastersyarat").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?php echo base_url();?>addmastersyarat",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-add-syarat').modal('hide');
					swal("Naiss!", "Lowongan berhasil disimpan", "success");
					document.getElementById("addmastersyarat").reset();
					table.ajax.reload();
				} else {
					swal("Oow!", "Lowongan gagal disimpan", "danger");
				}
			});	
		}
	}

	function simpaneditsyarat(){
	 	var paramstr = $("#editsyarat").serialize();
		if($("#editsyarat").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?php echo base_url();?>editsyarat",
			paramstr,
			function(data) {
				if(data == "Success"){
					$("#loading-image").hide();
					$('#modal-edit-syarat').modal('toggle');
					swal("Naiss!", "Perubahan berhasil disimpan", "success");
					table.ajax.reload();
				} else {
					$('#modal-edit-syarat').modal('toggle');
					swal({
					    title: "Oops!",   
					    text: "Terjadi kesalahan saat memproses !",   
					    type: "error" 
					});
					$("#loading-image").hide();
					table.ajax.reload();
				}
			});	
		}
	}

	$('#modal-edit-syarat').on('show.bs.modal', function (event) {
		var button  = $(event.relatedTarget)
		var id      = button.data('id')
		var name    = button.data('name')
		var status  = button.data('status')
		var jabatan = button.data('jabatan')
		var modal   = $(this)
		modal.find('#syarat_id').val(id)
		modal.find('#syarat_name').val(name)
		modal.find('#syarat_status').val(status)
		modal.find('#jabatan').val(jabatan)
	})
</script>