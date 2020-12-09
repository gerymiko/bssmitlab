<div class="panel panel-primary panel-table">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><?=$totalMCU;?> Pelamar</h3>
			<span>Tahap Interview MCU</span>
		</div>
		
		<div class="panel-options">
			<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
			<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
			<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
		</div>
	</div>
	<div class="panel-body">	
		<table class="table table-responsive" id="tableMonitorMcu">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Lulusan Baru</th>
					<th>Posisi</th>
					<th>Waktu &amp; Tgl</th>
					<th>Lokasi</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<script type="text/javascript">

 	var tbMCU;

	$(document).ready(function() {
    	tbMCU = $('#tableMonitorMcu').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtMonitorMCU')?>',
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
                if( data[2] ==  `Yes`){
                    $(row).addClass('cloud-bg');
                }
            },
		});
	});
</script>