<h4 style="margin-top: 0"><span class="label label-primary">Medical Check-Up</span> Master Klinik - <small>Data keseluruhan klinik yang bekerjasama dengan perusahaan.</small></h4>
<hr>
<div class="panel panel-primary" data-collapsed="0">
	<div class="panel-heading">
		<div class="panel-title white" >
			DATA KLINIK
		</div>
		<div class="panel-options">
			<button type="button" class="btn btn-red btn-icon icon-left" style="margin-top: 6px;">
				Klinik
				<i class="entypo-plus"></i>
			</button>
		</div>
	</div>
	<div class="panel-body">
		<table class="table table-hover table-bordered" id="tableKlinik">
			<thead>
				<tr>
					<th class="text-center bold">No</th>
					<th class="text-center bold">Nama Klinik</th>
					<th class="text-center bold">Alamat</th>
					<th class="text-center bold">Kota</th>
					<th class="text-center bold">No. Telepon</th>
					<th class="text-center bold">Harga</th>
					<th class="text-center bold">Status</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<script type="text/javascript">

 	var table;

	$(document).ready(function() {
    	table = $('#tableKlinik').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtKlinik')?>',
				"type" : "POST",
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
		    },
		    "columnDefs": [
    			{
	                "targets": [ 0 ],
	                "searchable": false,
	                "orderable": false,
	                "width": "2%",
	                "className": "text-center"
	            },
	            {
					"targets": 1,
					"className": "text-left"
				},
				{
					"targets": 2,
					"className": "text-left"
				},
				{
					"targets": 3,
					"className": "text-left"
				},
				{
					"targets": 4,
					"className": "text-center"
				},
				{
					"targets": 5,
					"className": "text-center"
				},
				{
					"targets": 6,
					"className": "text-center",
					"width": "4%",
					"orderable": false,
				},
			],
			"language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
		});
	});
</script>