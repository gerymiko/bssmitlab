<table id="table_result" class="table table-bordered" width="100%" style="border: 2px solid #000;">
	<thead class="bg-gray">
		<tr>
			<th>No</th>
			<th>No. Doc</th>
			<th>Hari / Tanggal</th>
			<th>Judul Inspeksi</th>
			<th>Lokasi</th>
			<th>Departemen</th>
			<th>NIK Inspektor</th>
			<th>Nama Inspektor</th>
			<th>Jam</th>
			<th>Shift</th>
			<th>NIK Validasi</th>
			<th>Nama Validasi</th>
			<th>Tanggal Validasi</th>
			<th></th>
		</tr>
	</thead>
</table>
<?php
	if ($this->uri->segment(6) == "" || $this->uri->segment(6) == null) {
		$link = site_url('table/result/').$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5);
	} else {
		$link = site_url('table/results/').$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6);
	}
?>
<script type="text/javascript">
	$(document).ready(function (){
		var table1 = $('#table_result').DataTable({
			"processing": true,
			"serverSide": true,
			"select": true,
	     	"bLengthChange": false,
	     	"pagingType": "listbox",
			"ordering": false,
			"destroy":true,
			"order": [],
			"ajax": {
				"url": '<?=$link;?>',
				"type": 'POST',
			},
			"columns": [
	    		{ "data": "no", "className": "text-center", "searchable": false },
	    		{ "data": "nodoc", "className": "text-center" },
	    		{ "data": "tanggal", "className": "text-center" },
	    		{ "data": "judul_inspeksi", "className": "text-left" },
	    		{ "data": "lokasi", "className": "text-left" },
	    		{ "data": "departemen", "className": "text-center" },
	    		{ "data": "inspektor", "className": "text-center" },
	    		{ "data": "nama", "className": "text-center" },
	    		{ "data": "jam", "className": "text-center" },
	    		{ "data": "shift", "className": "text-center" },
	    		{ "data": "nik_validasi", "className": "text-center" },
	    		{ "data": "nama_validasi", "className": "text-center" },
	    		{ "data": "tanggal_validasi", "className": "text-center" },
	    		{ "data": "action", "className": "text-center" },
			],
		});
		$('#length_change').val(table1.page.len());
		$('#length_change').change( function() { table1.page.len($(this).val()).draw(); });
		$("#paginationx").append($(".dataTables_paginate"));
	});
	function detail(nodoc){
		$("#table-content").addClass("hidden");
		$("#table-detail").removeClass("hidden");
		nodocx = nodoc.replace(/\//g, '-'),
		$("#table-detail").load("<?=site_url()?>result/detail/<?=$this->uri->segment(3)?>/"+nodocx, function(){
			$(".dataTables_paginate").addClass('hidden');
			$("#btn_back").removeClass("hidden");
		});
	}
</script>