<style type="text/css">
	.panel-table .panel-heading > .panel-title{ padding: 10px;}
</style>
<h4 style="margin-top: 0px;"><span class="label label-warning" style="color: #FFF;">PELAMAR</span> Pelamar Perjabatan - <small>Data pelamar perjabatan.</small></h4>
<hr>
<div class="panel panel-primary panel-table">
	<div class="panel-body">
		<table id="tablePelamarJabatan">
			<thead>
				<tr>
					<th class="text-center">Jabatan</th>
					<th class="text-center">Total Pelamar</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><div class="green-bg text-center" style="border: 1px solid #ddd; padding: 10px; margin-bottom:5px;">TOTAL KESELURUHAN PELAMAR</div></th>
					<th class="text-center"><div class="green-bg" style="border: 1px solid #ddd; padding: 10px; margin-bottom:5px;"><?=$totalPelamar;?></div></th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
    	$('#tablePelamarJabatan').DataTable( {
    		"ajax" : {
				"url"  : '<?php echo site_url('dtPelamarPerjabatan')?>',
				"type" : "POST",
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
		    },
			"ordering": false,
			"language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
			"columnDefs": [
    			{
	                "targets": [ 1 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	                "width": "15%"
	            },
	        ],
		});
	});
</script>