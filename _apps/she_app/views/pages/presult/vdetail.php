<table id="table_detail_result" class="table table-bordered" width="100%" style="border: 2px solid #000;">
	<thead class="bg-gray">
		<tr>
			<th>No</th>
			<th>No. Dok</th>
			<th>Hari / Tanggal</th>
			<th>Judul Inspeksi</th>
			<th>Lokasi</th>
			<th>Departemen</th>
			<th>NIK Inspektor</th>
			<th>Nama Inspektor</th>
			<th>Jam</th>
			<th><i>Shift</i></th>
			<th>Item</th>
			<th>Kode Bahaya</th>
			<th>Ya / Tidak</th>
			<th>Temuan</th>
			<th>Perbaikan</th>
			<th>Keterangan</th>
			<th>NIK <i>Close</i></th>
			<th>Tanggal <i>Close</i></th>
			<th>Kode Item</th>
			<th>Item Tambahan</th>
			<th>Foto <i>Before</i></th>
			<th>Foto <i>After</i></th>
		</tr>
	</thead>
</table>
<script type="text/javascript">
	$(document).ready(function (){
		var table2 = $('#table_detail_result').DataTable({
			"processing": true,
			"serverSide": true,
			"select": true,
	     	"bLengthChange": false,
			"ordering": false,
			"pagingType": "listbox",
			"order": [],
			"ajax": {
				"url": '<?=site_url('table/detail_result/').$this->uri->segment(3).'/'.$this->uri->segment(4)?>',
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
	    		{ "data": "item", "className": "text-left" },
	    		{ "data": "kode_bahaya", "className": "text-center" },
	    		{ "data": "ya_tidak", "className": "text-center" },
	    		{ "data": "temuan", "className": "text-left" },
	    		{ "data": "perbaikan", "className": "text-left" },
	    		{ "data": "keterangan", "className": "text-left" },
	    		{ "data": "nik_close", "className": "text-center" },
	    		{ "data": "tgl_close", "className": "text-center" },
	    		{ "data": "kode_itm", "className": "text-center" },
	    		{ "data": "item_tambahan", "className": "text-center" },
	    		{ "data": "file_before", "className": "text-center" },
	    		{ "data": "file_after", "className": "text-center" },
			],
		});
		$('#length_change').val(table2.page.len());
		$('#length_change').change( function() { table2.page.len($(this).val()).draw(); });
		$('#table_result_paginate').addClass('hidden');
		$('#paginationxdet').append($('.dataTables_paginate'));
		$('#btn_back').click(function(){
			$('#table-detail').addClass('hidden');
			$('#table-content').removeClass('hidden');
			$("#table_detail_result_paginate").addClass('hidden');
			$("#table_result_paginate").removeClass('hidden');
			$('#table_result_detail').DataTable().clear();
			$('#table_result_detail').DataTable().destroy();
		})
	});
</script>