<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Detail opsi tiket ke BSS</h3>
				</div>
				<div class="box-body table-responsive no-padding">
					<table id="table-detail-option-ticket" class="table table-hover">
						<thead class="bg-purple-active">
							<tr class="bg-purple">
								<th class="text-center">No</th>
								<th>No. Dok</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>Maskapai</th>
								<th>Berangkat</th>
								<th>Tiba</th>
								<th>Harga</th>
								<th>Status</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	<a href="<?=site_url();?>coptional/sysoptional/ticket_optional" class="btn btn-sm bg-red"><em>Kembali</em></a>
</section>

<script type="text/javascript">
	$(function (){
		$("#li-OpsTkt").addClass("bg-red");
      	$("#hf-OpsTkt").addClass("white");

		var table = $('#table-detail-option-ticket').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": false,
			"bFilter": false,
			"bLengthChange": false,
			"bInfo": false,
			"bPaginate": false,
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>coptional/sysoptional/table_detail_ticket_optional/<?=$this->uri->segment(4);?>',
				"type" : 'POST',
				error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
			},
			"columnDefs": [
	            {
	               "targets": [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ],
	               "className": "text-center",
	               "searchable": false,
	               "orderable": false,
	            },
	        ],
	        "createdRow": function( row, data, dataIndex){
	            if( data[8] ==  `Tiket Disetujui`){
	                $(row).addClass('bg-gray-active');
	            }
	        },
		});
	});
</script>