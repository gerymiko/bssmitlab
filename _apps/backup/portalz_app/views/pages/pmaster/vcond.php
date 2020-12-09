<section class="content-header" id="header-content">
	<h1>
		<div class="btn-group">
			<button type="button" class="btn bg-blue btn-xs">4</button>
			<button type="button" class="btn bg-navy btn-xs">B</button>
	    </div>
		<span class="label no-padding text-black">Master Syarat</span>
		<button type="button" data-tooltip="Tambah Syarat" data-tooltip-location="left" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modal-add-cond" data-backdrop="static" data-keyboard="false">
			<i class="fas fa-plus"></i>
		</button>
	</h1>
</section>
<section class="content" id="main-content">
	<div class="box">
		<div class="box-body">
			<table id="table_cond" class="table table-border table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th class="text-center">Syarat</th>
						<th class="text-center">Jabatan</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$("#recruit, #master-treeview, #master-cond").addClass("active");
		var table = $('#table_cond').DataTable({
			"processing": true,
			"serverSide": true,
			"stateSave": true,
			"order": [],
			"dom": 'Bfrtip',
	        "buttons": [ 'pageLength', { text: 'Reload', action: function (e, dt, node, config){ table.ajax.reload(); }} ],
	        "lengthMenu": [ [10, 25, 50, 100],['10 Baris', '25 Baris', '50 Baris', '100 Baris'] ],
			"responsive": true,
			"ajax": {
				"url": '<?=site_url()?>web/table/master_cond',
				"type": 'POST',
				// data : function(data){
				// 	data.people_fullname = $('#people_fullname').val();data.fullname = $('#fullname').val();data.KodeJB = $('#KodeJB').val();data.domisili = $('#domisili').val();data.freshgraduate = $('#freshgraduate').val();data.status_interview = $('#status_interview').val();
	   //          },
				// error: function(data){ swal({ title: "", html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.', type: "", confirmButtonText: 'Okay' }).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": '<div class="loadings"><div class="spinner-wrapper"><span class="spinner-text">LOADING</span><span class="spinner"></span></div></div>' },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false, "width": "2%" },
				{ "data": "cond", "className": "text-left", "searchable": false, "orderable": false },
				{ "data": "position", "className": "text-center", "orderable": false },
				{ "data": "status", "className": "text-center", "orderable": false },
				{ "data": "action", "className": "text-right", "orderable": false },
			],
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