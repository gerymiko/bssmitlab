<section class="content-header" id="header-content">
	<h1>
	   	<div class="btn-group">
			<button type="button" class="btn bg-blue btn-xs">2</button>
			<button type="button" class="btn bg-navy btn-xs">F</button>
	    </div>
	    <span class="label no-padding text-black">Pelamar <b>Pra-Pemilihan</b></span>
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
	                  	<input type="text" class="form-control _CalPhaNum" id="nomcu" placeholder="No. MCU">
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
	                  		<option value="">Pilih Hasil MCU</option>
	                  		<option value="1">FIT</option>
	                  		<option value="0">UNFIT</option>
	                  	</select>
	                </div>
	            </div>
	            <div class="col-md-2">
	            	<div class="form-group" style="margin-bottom: 0px;">
	                  	<input type="text" class="form-control" id="date_range" placeholder="Tanggal MCU">
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
			<table id="table_pre_election" class="table table-border table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th></th>
						<th>Nama Lengkap</th>
						<th>Posisi</th>
						<th>No. MCU</th>
						<th>Tipe</th>
						<th>Hasil MCU</th>
						<th>Tanggal</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<style type="text/css"> .form-group .select2-container { margin-bottom:0px !important; }</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#recruit, #recruit-pre_election, #recruit-treeview").addClass("active");
		$('.select2').select2({ placeholder: 'Pilih', allowClear: true });
		$('._CalPhaNum').alphanum({ allowNumeric: false, allow: '.-,' });
		$('._CnUmB').numeric({allowThouSep: true,	allowDecSep: false, allowPlus: false, allowMinus: false });
		$('#date_range').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Batal' } });
		$('#date_range').on('apply.daterangepicker', function(ev, picker){ $(this).val(picker.startDate.format('DD-MM-YYYY') + ' sd ' + picker.endDate.format('DD-MM-YYYY'));});
        $('#date_range').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
		var oldExportAction = function (self, e, dt, button, config) {
            if (button[0].className.indexOf('buttons-excel') >= 0) {
                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                } else { $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config); }
            } else if (button[0].className.indexOf('buttons-print') >= 0) { $.fn.dataTable.ext.buttons.print.action(e, dt, button, config); }
        };
        var newExportAction = function (e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function (e, s, data) {
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function (e, settings) {
                    oldExportAction(self, e, dt, button, config);
                    dt.one('preXhr', function (e, s, data) {
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    setTimeout(dt.ajax.reload, 0);
                    return false;
                });
            });
            dt.ajax.reload();
        };
		var table = $('#table_pre_election').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"stateSave": true,
			"dom": 'Bfrtip',
	        "order": [],
	        "buttons": [ 'pageLength', { extend : 'excel', text : 'Export Excel', action: newExportAction }, { text: 'Reload',
            	action: function (e, dt, node, config){ table.ajax.reload(); }}],
	        "lengthMenu": [ [10, 25, 50, 100], ['10 Baris', '25 Baris', '50 Baris', '100 Baris'] ],
			"order": [],
			"ajax": {
				"url": '<?=site_url()?>crecruit/web/pre_election/syspre_election/table_pre_election',
				"type": 'POST',
				// "data" : function(data){ data.people_fullname = $('#people_fullname').val();data.KodeJB = $('#KodeJB').val();data.domisili = $('#domisili').val();data.freshgraduate = $('#freshgraduate').val();},
				// error: function(data){ swal({ title: "", html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.', type: "", confirmButtonText: 'Okay' }).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": '<div class="loadings"><div class="spinner-wrapper"><span class="spinner-text">LOADING</span><span class="spinner"></span></div></div>'},
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "detail", "className": "text-center", "orderable": false },
				{ "data": "name", "className": "text-left", "orderable": false },
				{ "data": "position", "className": "text-left", "orderable": false },
				{ "data": "nomcu", "className": "text-left", "orderable": false },
				{ "data": "type", "className": "text-center", "orderable": false },
				{ "data": "result", "className": "text-center", "orderable": false },
				{ "data": "date", "className": "text-center" },
				{ "data": "action", "className": "text-center", "orderable": false },
			]
		});
		$('#btn-filter').click(function(){ table.ajax.reload();});
		$('#btn-reset').click(function(){ $('#form-filter')[0].reset();$('#KodeJB').val(null).trigger('change');table.ajax.reload();});
		$('#hideshow').on('click', function(event){ $('#content-filter').toggle('show'); });
	});
	function detailApplicant(id){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>web/detail/applicant/"+id);
	}
  	function pass_selection(pelamar_id, name){
	    swal({
	        title: "",
	        html: '<i class="fas fa-question-circle f40 margin10 text-orange"></i><br>Apakah pelamar (<b>'+name+'</b>) lolos seleksi dan akan dilanjutkan ke tahap agreement?',
	        type: "",
	        showCancelButton: true,
			focusConfirm: false,
			confirmButtonText: 'Lanjutkan Agreement',
			confirmButtonAriaLabel: 'Ok',
			cancelButtonText: '<i class="fas fa-times"></i>',
			cancelButtonAriaLabel: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>web/passed/applicant/"+pelamar_id,
					type: "post",
					data: { id:id },
					success:function(data){
						if(data == "Success"){
							swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.', type: "", confirmButtonText: 'Okay' });
						    $('#table_pre_election').DataTable().ajax.reload();
						} else {
							swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal dihapus. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay'});
						}
					},
				});
			}
        });
	}

  	function done(pelamar_id){
  		swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Pelamar ini telah terdaftar di tahap Agreement.', type: "", confirmButtonText: 'Okay', timer: 3000 });
  	}
</script>