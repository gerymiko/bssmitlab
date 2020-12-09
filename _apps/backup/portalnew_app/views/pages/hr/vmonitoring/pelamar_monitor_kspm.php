<h4 style="margin-top: 0px;"><span class="label label-danger">PELAMAR</span> Interview KSPM - <small>Data keseluruhan pelamar yang menjalani proses interview KSPM.</small></h4>
<hr>
<div class="panel panel-primary panel-table">
	<div class="panel-body" style="background: #FFF;">
		<div class="row">
			<div class="panel-title col-md-3">
				<div class="tile-stats stat-tile" style="height: 90px; background: #333333;">
					<div class="icon" style="bottom: 40px;"><i class="fa fa-toggle-on"></i></div>
					<h3><?=$totalKSPM;?> Pelamar</h3>
					<p>Tahap Interview KSPM</p>
					<span class="pie-chart"><canvas width="95" height="95" style="display: inline-block; vertical-align: top; width: 95px; height: 95px;"></canvas></span>
				</div>
			</div>
			<div class="panel-title col-md-3">
				<div class="tile-stats stat-tile" style="height: 90px; background: #333333;">
					<form id="form-filter" class="form-horizontal">
						<div class="form-group">
							<p>
								<select class="form-control" id="interview_hrd" name="interview_hrd">
									<option value="">Pilih status interview</option>
									<option value="2">Proses</option>
									<option value="1">Selesai</option>
								</select>
								<br>
								<button type="button" class="btn btn-default btn-icon" id="btn-filter">
									Filter
									<i class="entypo-search"></i>
								</button>
								<button type="button" class="btn btn-red btn-icon" id="btn-reset">
									Reset
									<i class="entypo-arrows-ccw"></i>
								</button>
							</p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">	
		<div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;">
			<table class="table table-responsive" id="tableMonitorKspm">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Pelamar</th>
						<th class="text-center">Lulusan Baru</th>
						<th class="text-center">Posisi</th>
						<th class="text-center">PIC</th>
						<th class="text-center">Waktu &amp; Tgl</th>
						<th class="text-center">Lokasi</th>
						<th class="text-center">Status</th>
						<th class="text-center"><i class="fa fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">

 	var tbKSPM;

	$(document).ready(function() {
    	tbKSPM = $('#tableMonitorKspm').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtMonitorKspm')?>',
				"type" : "POST",
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
		    },
		    "language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
		    "createdRow": function( row, data, dataIndex){
                if( data[2] ==  '<i class="fa fa-check"></i>'){
                    $(row).addClass('cloud-bg');
                }
            },
            "columnDefs": [
    			{
	                "targets": [ 0 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false
	            },
	            {
	                "targets": [ 2 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false
	            },
	            {
	                "targets": [ 7 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false
	            },
	        ],
		});
	});

	function gagalseleksikspm(pelamar_id){
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah pelamar ini tidak lolos seleksi interview KSPM ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: '#FF6666',
	        confirmButtonText: 'Ya, Setuju',
	        cancelButtonText: "Batal",
	        confirmButtonClass: "btn-danger",
	        closeOnConfirm: false,
	        closeOnCancel: true
	    },

		function() {
			$.ajax({
				url: "<?php echo site_url()?>gagalseleksikspm/",
				type: "post",
				data: {pelamar_id:pelamar_id},
				success:function(){
					swal("Good Job!","Pelamar telah digagalkan.", "success");
				},
				error:function(){
					swal("Oops","Terjadi kesalahan saat memproses data! Coba lagi...", "error");
				}
			})
        });
        return false;
  	};
</script>