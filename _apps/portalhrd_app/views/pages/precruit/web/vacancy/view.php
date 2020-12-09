<section class="content-header" id="header-content">
	<h1><span class="label no-padding text-black">Daftar Lowongan Web <button type="button" class="btn btn-primary btn-sm pull-right" onclick="btn_add_vacancy();" data-tooltip="Tambah Lowongan" data-tooltip-location="left"><i class="fas fa-plus"></i></button></span></h1>
</section>
<div id="extra-content" class="hidden"></div>
<section class="content" id="main-content">
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box info-box-sm">
				<span class="info-box-icon info-box-icon-sm bg-white"><?=$lowonganaktif;?></span>
				<div class="info-box-content info-box-content-sm">
					<span class="info-box-text">Lowongan <br>Aktif</span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box info-box-sm">
				<span class="info-box-icon info-box-icon-sm bg-white"><?=$lowongannonaktif;?></span>
				<div class="info-box-content info-box-content-sm">
					<span class="info-box-text">Lowongan <br>Non-Aktif</span>
				</div>
			</div>
		</div>
		<div class="clearfix visible-sm-block"></div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box info-box-sm">
				<span class="info-box-icon info-box-icon-sm bg-white"><?=$lowonganterdaftar;?></span>
				<div class="info-box-content info-box-content-sm">
					<span class="info-box-text">Total <br>Lowongan</span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<form id="form-filter">
				<div class="form-group">
					<select class="form-control" id="lowongan_status" name="lowongan_status">
						<option value="">Pilih status lowongan</option>
						<option value="1">BUKA</option>
						<option value="0">TUTUP</option>
					</select>
					<div style="padding: 2px;"></div>
					<button type="button" class="btn btn-danger btn-sm" id="btn-filter" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
					<button type="button" class="btn btn-default btn-sm" id="btn-reset" data-tooltip="Reset"><i class="fas fa-undo"></i></button>
				</div>
			</form>
		</div>
	</div>
	<div class="box">
		<div class="box-body">
			<table id="table_vacancy" class="table table-border table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode</th>
						<th>Dept.</th>
						<th>Jabatan</th>
						<th>Jml. Rekrut</th>
						<th>Tgl Buka</th>
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
		$("#recruit, #recruit-vacancy").addClass("active");
		var table = $('#table_vacancy').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"dom": 'Bfrtip',
	        "buttons": [ 'pageLength', { text: 'Reload', action: function (e, dt, node, config){ table.ajax.reload(); }} ],
	        "lengthMenu": [ [10, 25, 50, 100], ['10 Baris', '25 Baris', '50 Baris', '100 Baris'] ],
			"ajax": {
				"url": '<?=site_url()?>web/table/vacancy',
				"type": 'POST',
				data : function (data){ data.lowongan_status = $('#lowongan_status').val();},
				error: function(data){ swal({ title: "", html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.', type: "", confirmButtonText: 'Okay' }).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": '<div class="loadings"><div class="spinner-wrapper"><span class="spinner-text">LOADING</span><span class="spinner"></span></div></div>' },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "kode", "className": "text-left", "orderable": false },
				{ "data": "dept", "className": "text-left" },
				{ "data": "jb", "className": "text-left" },
				{ "data": "jmlrec", "className": "text-center", "orderable": false  },
				{ "data": "dateopen", "className": "text-center", "orderable": false  },
				{ "data": "status", "className": "text-center", "orderable": false  },
				{ "data": "action", "className": "text-center", "orderable": false  }
			]
		});
		$('#btn-filter').click(function(){ table.ajax.reload();});
		$('#btn-reset').click(function(){ $('#form-filter')[0].reset();table.ajax.reload();});		
	});
	function btn_add_vacancy(){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>web/add/vacancy", function(){
			$('.datepicker').datepicker({ autoclose: true,format:"dd-mm-yyyy",todayHighlight:true,daysOfWeekHighlighted:"0",todayBtn:"linked" });
		});
	}
	function btn_edit_vacancy(id, kode){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>web/edit/vacancy/"+id+"/"+kode, function(){
			$('.datepicker').datepicker({ autoclose: true,format:"dd-mm-yyyy",todayHighlight:true,daysOfWeekHighlighted:"0",todayBtn:"linked" });
		});
	}
	function btn_detail_vacancy(id){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>web/detail/vacancy/"+id);
	}
	function removeThis(id, name){
	    swal({
	        title: "",
	        html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Non-Aktifkan loker ini (<b>'+name+'</b>).',
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
					url: "<?=site_url()?>web/deactivated/vacancy",
					type: "post",
					data: { id:id },
					success:function(data){
						if(data == "Success"){
							swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Loker berhasil dinon-aktifkan.', type: "", confirmButtonText: 'Okay', allowOutsideClick: false }).then(function(){ $('#table_vacancy').DataTable().ajax.reload(); });
						} else {
							swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal dinon-aktifkan. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
						}
					},
				});
			}
        });
	}
</script>