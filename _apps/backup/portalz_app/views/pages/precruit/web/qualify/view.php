<section class="content-header" id="header-content">
	<h1>
	   	<div class="btn-group">
			<button type="button" class="btn bg-blue btn-xs">2</button>
			<button type="button" class="btn bg-navy btn-xs">C</button>
	    </div>
	    <span class="label no-padding text-black">Pelamar <b>Kualifikasi Web</b></span>
	</h1>
</section>
<div id="extra-content" class="hidden"></div>
<section class="content" id="main-content">
	<div class="row mobile">
		<div class="col-md-12">
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-danger" id="hideshow">Filter</button>
				<button class="btn bg-red">
					<i class="fas fa-filter"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="box box-primary desktop" id="content-filter">
		<div class="box-body">
			<form id="form-filter" action="#" class="form-horizontal">					
				<div class="col-md-2">
					<div class="form-group" style="margin-bottom: 0px;">
	                  	<input type="text" class="form-control _CalPhaNum" id="people_fullname" placeholder="Nama Lengkap">
	                </div>
				</div>
				<div class="col-md-2">
	                <div class="form-group" style="margin-bottom: 0px;">
	                  	<input type="text" class="form-control _CalPhaNum" id="domisili" placeholder="Domisili">
	                </div>
	            </div>
				<div class="col-md-3">
	                <div class="form-group" style="margin-bottom: 0px;">
                        <select class="form-control select2" id="KodeJB">
                            <option></option>
                            <?php
                            	foreach ($listjabatan as $row){
                            		echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.' ['.$row->departemen.']</option>';
                            	}
                            ?>
                        </select>
					</div>
	            </div>
				<div class="col-md-2">
	                <div class="form-group" style="margin-bottom: 0px;">
	                  	<select class="form-control hand" id="freshgraduate">
	                  		<option value="">Pilih Lulusan Baru</option>
	                  		<option value="1">Ya</option>
	                  		<option value="0">Tidak</option>
	                  	</select>
	                </div>
	            </div>
	            <div class="col-md-2">
	            	<div class="form-group" style="margin-bottom: 0px;">
	                  	<select class="form-control hand" id="status_interview">
	                  		<option value="">Pilih Status Interview</option>
	                  		<option value="1">Sudah dipanggil</option>
	                  		<option value="0">Belum dipanggil</option>
	                  	</select>
	                </div>
	            </div>
	            <div class="col-md-1 text-center desktop">
	            	<div class="form-group" style="margin-bottom: 0px;">
						<button type="button" id="btn-filter" class="btn btn-flat btn-danger"><i class="fas fa-filter"></i></button>
						<button type="button" id="btn-reset" class="btn btn-flat btn-default"><i class="fas fa-sync"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="box">
		<div class="box-body slider-content">
			<table id="table_qualify" class="table table-border table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>#</th>
						<th>Nama</th>
						<th data-tooltip="Lulusan Baru" data-tooltip-location="right">FG <i class="far fa-question-circle"></i></th>
						<th>Usia</th>
						<th>JK</th>
						<th>Posisi</th>
						<th>Domisili</th>
						<th>Tgl Lamar</th>
						<th>Status</th>
						<th><i class="fas fa-cog"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<style type="text/css"> .form-group .select2-container { margin-bottom:0px !important; }</style>
<script type="text/javascript">
	function format (d){
		return '<table cellpadding="0" cellspacing="0" style="padding-left:0px;" class="table table-bordered no-margin">'+
		'<tr>'+
			'<td class="">KSPM & HRD</td>'+
			'<td class="">'+d.kspm_status+'</td>'+
			'<td>'+d.kspm+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="">Teknis</td>'+
			'<td class="">'+d.teknis_status+'</td>'+
			'<td>'+d.teknis+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="">Tes Teori</td>'+
			'<td class="">'+d.teori_status+'</td>'+
			'<td>'+d.teori+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="">Tes Praktek</td>'+
			'<td class="">'+d.praktek_status+'</td>'+
			'<td>'+d.praktek+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="">Tes MCU</td>'+
			'<td class="">'+d.mcu_status+'</td>'+
			'<td>'+d.mcu+'</td>'+
		'</tr>'+
		'</table>';
    }
	$(document).ready(function(){
		$("#recruit, #recruit-qualify, #recruit-treeview").addClass("active");
		$('.select2').select2({ placeholder: 'Pilih', allowClear: true });
		$('._CalPhaNum').alphanum({ allowNumeric: false, allow: '.-,' });
		$('._CnUmB').numeric({allowThouSep: true,	allowDecSep: false, allowPlus: false, allowMinus: false });
		var table = $('#table_qualify').DataTable({
			"processing": true,
			"serverSide": true,
			"stateSave": true,
			"dom": 'Bfrtip',
	        "buttons": [ 'pageLength',{ text: 'Reload', action: function (e, dt, node, config){ table.ajax.reload(); }} ],
	        "lengthMenu": [[10, 25, 50, 100],['10 Baris', '25 Baris', '50 Baris', '100 Baris']],
	        "responsive": {
		        details: {
		            renderer: function(api, rowIdx, columns){
		                var data = $.map(columns,function(col, i){
		                    return col.hidden ?
		                        '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
		                            '<td>'+col.title+':'+'</td> '+
		                            '<td>'+col.data+'</td>'+
		                        '</tr>' : '';
		                }).join('');
		                return data ? $('<table/>').append(data) : false;
		            }
		        }
		    },
			"order": [],
			"ajax": {
				"url": '<?=site_url()?>web/table/qualified',
				"type": 'POST',
				"data" : function(data){ data.people_fullname = $('#people_fullname').val();data.KodeJB = $('#KodeJB').val();data.domisili = $('#domisili').val();data.freshgraduate = $('#freshgraduate').val();},
				error: function(data){ swal({ title: "", html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.', type: "", confirmButtonText: 'Okay' }).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": '<div class="loadings"><div class="spinner-wrapper"><span class="spinner-text">LOADING</span><span class="spinner"></span></div></div>' },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "sms", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "name", "className": "text-left", "orderable": false },
				{ "data": "fg", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "age", "className": "text-center", "orderable": false },
				{ "data": "gender", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "position", "className": "text-left", "orderable": false },
				{ "data": "domisili", "className": "text-left", "orderable": false },
				{ "data": "date", "className": "text-center" },
				{ "data": "status", "className": "text-center", "orderable": false },
				{ "data": "action", "className": "text-center", "orderable": false },
			]
		});
		$('#btn-filter').click(function(){ table.ajax.reload(); });
		$('#btn-reset').click(function(){ $('#form-filter')[0].reset(); $('#KodeJB').val(null).trigger('change'); table.ajax.reload(); });
		$('#hideshow').on('click', function(event){ $('#content-filter').toggle('show'); });
		$('#table_qualify tbody').on('click', 'a.details-control', function (){
			var tr  = $(this).closest('tr'), row = table.row( tr );
			if (row.child.isShown()){ row.child.hide();tr.removeClass('shown'); } else { row.child(format(row.data())).show();tr.addClass('shown'); }
		});
	});

	function detailApplicant(id){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>web/detail/applicant/"+id);
	}
</script>