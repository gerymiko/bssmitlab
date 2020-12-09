<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Detail opsi tiket</h3>
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
								<th>Durasi</th>
								<th>Harga Aktual</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	<a href="<?=site_url();?>coption/sysoption/ticket_option" class="btn btn-sm bg-red"><em>Kembali</em></a>
</section>

<div class="modal" id="ticket-selected-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-selected-modalLabel" aria-hidden="true">
	<div class="modal-dialog modal70" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">No. Pengajuan</h4>
			</div>
			<div class="modal-body">
				<form id="form-selected-ticket" method="post">
					<input type="hidden" name="id" id="id">
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<label>NIK</label>
								<input type="text" name="nik" id="nik" class="form-under-line input-sm" readonly>
							</div>
							<div class="form-group">
								<label>Jam Berangkat</label>
								<input type="text" name="depart_time" id="depart_time" class="form-under-line input-sm" readonly>
							</div>
							<div class="form-group">
								<label>Maskapai</label>
								<input type="text" name="airline" id="airline" class="form-under-line input-sm" readonly>
							</div>	
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="karyawan" id="karyawan" class="form-under-line input-sm" readonly>
							</div>
							<div class="form-group">
								<label>Jam Tiba</label>
								<input type="text" name="arrival_time" id="arrival_time" class="form-under-line input-sm" readonly>
							</div>
							<div class="form-group">
								<label>Harga</label>
								<input type="text" name="price" id="price" class="form-under-line input-sm" readonly>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary pull-left" data-dismiss="modal"><em>Batal</em></button>
				<button type="button" onclick="save_ticket_selected();" class="btn btn-primary"><em>Pilih Tiket</em></button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function (){
		$("#li-OpsNVnDr").addClass("bg-purple");
      	$("#href-OpsNVnDr").addClass("white");
      	
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
				"url"  : '<?=site_url()?>coption/sysoption/table_detail_ticket_option/<?=$this->uri->segment(4);?>',
				"type" : 'POST',
				error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
			},
			"columns": [
	            { "data": "no" },
	            { "data": "nodoc" },
	            { "data": "nik" },
	            { "data": "name" },
	            { "data": "airline_name" },
	            { "data": "depart_time" },
	            { "data": "arrival_time" },
	            { "data": "duration" },
		        { "data": {
	                "display": "price.display",
	                "sort": "price.sort"
	            } },
	            { "data": "status" },
	            { "data": "button" }
	        ],
			"columnDefs": [
	            {
	               "targets": [ 0, 1, 2, 3, 4, 5, 6, 9, 10 ],
	               "className": "text-center",
	               "searchable": false,
	               "orderable": false,
	            },
	            {
	               "targets": [ 7, 8 ],
	               "className": "text-center",
	               "searchable": false,
	            },
	        ],
	        createdRow: function( row, data, dataIndex){
	            if( data['status'] ==  `Tiket Dipilih`){
	                $(row).addClass('bg-gray-active');
	            }
	        },
		});

		$('#ticket-selected-modal').on('show.bs.modal', function (event) {
			var button       = $(event.relatedTarget)
			var id           = button.data('id')
			var nodoc        = button.data('nodoc')
			var nik          = button.data('nik')
			var karyawan     = button.data('karyawan')
			var airline      = button.data('airline')
			var depart_time  = button.data('depart_time')
			var arrival_time = button.data('arrival_time')
			var price        = button.data('price')
			var modal        = $(this)

			modal.find('#id').val(id)
			modal.find('#nik').val(nik)
			modal.find('#karyawan').val(karyawan)
			modal.find('#airline').val(airline)
			modal.find('#depart_time').val(depart_time)
			modal.find('#arrival_time').val(arrival_time)
			modal.find('#nodoc').val(nodoc)
			modal.find('#price').val(price)
			modal.find('.modal-title').text('No. Pengajuan : ' + nodoc)
		});
	});

	function save_ticket_selected(){
		var formdata = $("#form-selected-ticket").serialize();
		var table    = $('#table-detail-option-ticket').DataTable();
		if($("#form-selected-ticket").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>coption/sysoption/save_ticket_selected",
			formdata,
			function(data) {
				if(data == 1){
					$('#ticket-selected-modal').modal('hide');
					swal("Naiss!", "Tiket telah berhasil dipilih", "success");
					table.ajax.reload();
				} else if (data == 2) {
					$('#ticket-selected-modal').modal('hide');
					swal("Oops!", "Maaf anda sudah memilih tiket", "error");
					table.ajax.reload();
				} else {
					$('#ticket-selected-modal').modal('hide');
					swal("Oops!", "Tiket gagal dipilih, reload halaman ini dan coba lagi", "error");
					table.ajax.reload();
				}
			});   
		}
	}
</script>