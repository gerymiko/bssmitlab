<section class="content-header" id="header-content">
	<h1>
		<div class="btn-group">
			<button type="button" class="btn bg-blue btn-xs">4</button>
			<button type="button" class="btn bg-navy btn-xs">D</button>
	    </div>
		<span class="label no-padding text-black">Master PIC</span>
		<button type="button" data-tooltip="Tambah PIC" data-tooltip-location="left" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modal-add-pic" data-backdrop="static" data-keyboard="false">
			<i class="fas fa-plus"></i>
		</button>
	</h1>
</section>
<section class="content" id="main-content">
	<div class="box">
		<div class="box-body">
			<table id="table_pic" class="table table-hover table-border table-striped" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>NIK</th>
						<th class="text-center">Nama PIC</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<div id="modal-add-pic" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah PIC Interview</h4>
			</div>
			<form id="from-add-pic" method="post" action="#">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><b>Nama Karyawan</b></label>
                        <select class="form-control select2 required" name="users_id" id="users_id">
                            <option></option>
                            <?php
                            	foreach ($listpic as $row){
                            		echo '<option value="'.$row->users_id.'">'.$row->users_fullname.'</option>';
                            	}
                            ?>
                        </select>
					</div>
					<div class="form-group">
						<label class="control-label"><strong>Tahapan Seleksi</strong></label>
						<div id="selection_step"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i></button>
					<button type="button" class="btn btn-primary" id="btn_add_pic">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="modal-edit-pic" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah PIC Interview</h4>
			</div>
			<form id="from-edit-pic" method="post" action="#">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><strong>Tahapan Seleksi</strong></label>
						<div id="selection_step"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i></button>
					<button type="button" class="btn btn-primary" id="btn_edit_pic">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#recruit, #master-treeview, #master-pic").addClass("active");
		$(".select2").select2({ placeholder: 'Pilih', allowClear: true });
		var table = $('#table_pic').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"dom": 'Bfrtip',
	        "buttons": [ 'pageLength', { text: 'Reload', action: function (e, dt, node, config){ table.ajax.reload(); }} ],
	        "lengthMenu": [ [10, 25, 50, 100],['10 Baris', '25 Baris', '50 Baris', '100 Baris'] ],
			"responsive": true,
			"ajax": {
				"url": '<?=site_url()?>cmaster/syspic/table_pic',
				"type": 'POST',
				// data : function(data){
				// 	data.people_fullname = $('#people_fullname').val();data.fullname = $('#fullname').val();data.KodeJB = $('#KodeJB').val();data.domisili = $('#domisili').val();data.freshgraduate = $('#freshgraduate').val();data.status_interview = $('#status_interview').val();
	   //          },
				// error: function(data){ swal({ title: "", html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.', type: "", confirmButtonText: 'Okay' }).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": '<div class="loadings"><div class="spinner-wrapper"><span class="spinner-text">LOADING</span><span class="spinner"></span></div></div>' },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false, "width": "1%" },
				{ "data": "nik", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "name", "className": "text-left", "orderable": false },
				{ "data": "status", "className": "text-center", "orderable": false },
				{ "data": "action", "className": "text-right", "orderable": false },
			],
		});
    	$('#users_id').change(function() {
			var opt = $(this).val();
			$.ajax({
				type: "POST",
				url: "<?=site_url('cmaster/syspic/get_step_selection')?>",
				data: {opt:opt},
				success:function(data){ $("#selection_step").html(data); }
			});
		});
    	$("#btn_add_pic").click(function () {
    		$("#loading").removeClass("hidden");
    		var formdata = $("#from-add-pic").serialize();
    		if($("#from-add-pic").valid() == false){
    			$("#loading").addClass("hidden");
    			return false;
    		} else { 
    			$.post("<?=site_url()?>cmaster/syspic/save_add_pic",
				formdata,
				function (data){
					if(data == "Success"){
						table.ajax.reload();
						$("#loading").addClass("hidden");
						$('#modal-add-pic').modal('hide');
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Module was successfully registered.',type: "",confirmButtonText: 'Okay',});
					} else {
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
					}
				});
    		}
    	});
    });
	function removeThis(id, name){
	    swal({
	        title: "",
	        html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Non-Aktifkan syarat ini? <br>(<b>'+name+'</b>).',
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
					url: "<?=site_url()?>web/deactivated/#",
					type: "post",
					data: { id:id },
					success:function(data){
						if(data == "Success"){
							swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Berhasil dinon-aktifkan.', type: "", confirmButtonText: 'Okay', allowOutsideClick: false }).then(function(){ $('#table_skill').DataTable().ajax.reload(); });
						} else {
							swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal dinon-aktifkan. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
						}
					},
				});
			}
        });
    };
</script>