<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default collapsed-box">
				<div class="box-header" data-widget="collapse">
					<h3 class="box-title">Cari data tiket</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<form id="form-filter">
						<div class="row">
							<div class="col-xs-3">
								<div class="form-group">
									<input type="text" name="s_nodoc" class="form-under-line" placeholder="No Dok">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<input type="text" name="s_tgl" class="form-under-line datepicker" placeholder="Tanggal">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<input type="text" name="s_nik" class="form-under-line num" placeholder="NIK">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<input type="text" name="s_tipe" class="form-under-line" placeholder="Tipe">
								</div>
							</div>
						</div>
						<button type="button" class="btn bg-purple btn-sm" id="btn-filter">Filter</button>
						<button type="button" class="btn bg-yellow btn-sm" id="btn-reset">Reset</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Data Pengajuan Tiket Karyawan</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<table id="table_ticket_filing" class="table table-striped table-hover nowrap" width="100%">
	                  	<thead class="bg-purple-active">
							<tr>
								<th>No</th>
								<th>No. Dok</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>Tgl</th>
								<th>Dari</th>
								<th>Tujuan</th>
								<th>Berangkat</th>
								<th>Tiba</th>
								<th>Maskapai</th>
								<th>Harga</th>
								<th>Status</th>
								<th>Tipe</th>
								<th>Aksi</th>
							</tr>
	                  </thead>
	               </table>
				</div>
				<div class="dataTables_processings"></div>
			</div>
		</div>
	</div>
</section>

<div class="modal" id="request-vendor-modal" tabindex="-1" role="dialog" aria-labelledby="request-modalLabel" aria-hidden="true">
   <div class="modal-dialog modal70" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">No. Pengajuan</h4>
         </div>
         <div class="modal-body">
            <form id="form-request-ticket-vendor" method="post">
            	<input type="hidden" name="nodoc" id="nodoc">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-form-label">NIK</label>
							<input type="text" class="form-under-line input-sm" name="nik" readonly id="nik">
						</div>
						<div class="form-group">
							<label class="col-form-label">Maskapai</label>
							<input type="text" class="form-under-line input-sm" name="airline" readonly id="airline">
						</div>
						<div class="form-group">
							<label class="col-form-label">Jam Berangkat</label>
							<input type="text" class="form-under-line input-sm" name="depart_time" readonly id="depart_time">
						</div>
						<div class="form-group">
							<label class="col-form-label">Kota Asal</label>
							<input type="text" class="form-under-line input-sm" name="depart_city" readonly id="depart_city">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-form-label">Karyawan</label>
							<input type="text" class="form-under-line input-sm" name="karyawan" readonly id="karyawan">
						</div>
						<div class="form-group">
							<label class="col-form-label">Tanggal Berangkat</label>
							<input type="text" class="form-under-line input-sm" name="depart_date" readonly id="depart_date">
						</div>
						<div class="form-group">
							<label class="col-form-label">Jam Tiba</label>
							<input type="text" class="form-under-line input-sm" name="arrival_time" readonly id="arrival_time">
						</div>
						<div class="form-group">
							<label class="col-form-label">Kota Tujuan</label>
							<input type="text" class="form-under-line input-sm" name="arrival_city" readonly id="arrival_city">
						</div>
					</div>
				</div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal"><em>Batal</em></button>
            <button type="button" onclick="save_order_ticket_vendor();" class="btn btn-primary"><em>Pesan Tiket ke Vendor</em></button>
         </div>
      </div>
   </div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$("#li-PKyWN").addClass("bg-purple");
		$("#href-PKyWN").addClass("white");

		var table = $('#table_ticket_filing').DataTable({
			processing: true,
			serverSide: true,
			scrollX: true,
			scrollCollapse: true,
            fixedColumns: {
            	leftColumns: 2,
	            rightColumns: 2
	        },
			order: [],
			ajax: {
				url  : '<?=site_url()?>csubmission/sysubmission/table_ticket_submission',
				type : 'POST',
				error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
			},
			language: {
				processing: '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>',
				search: '', 
				searchPlaceholder: "Cari...",
			},
			columnDefs: [
				{
					targets: [ 0, 2, 3, 5, 6, 7, 8, 10, 11, 12, 13 ],
					className: "text-center",
					searchable: false,
					orderable: false,
				},
				{
					targets: [ 1, 4, 9 ],
					className: "text-center"
				},
			],
		});

		$('#btn-filter').click(function(){ 
			table.ajax.reload();
		});
		$('#btn-reset').click(function(){ 
			$('#form-filter')[0].reset();
			table.ajax.reload();
		});

		$('#request-vendor-modal').on('show.bs.modal', function (event) {
			var button       = $(event.relatedTarget)
			var nodoc		 = button.data('nodoc')
			var nik          = button.data('nik')
			var karyawan     = button.data('karyawan')
			var airline      = button.data('airline')
			var depart_time  = button.data('depart_time')
			var arrival_time = button.data('arrival_time')
			var depart_city  = button.data('depart_city')
			var arrival_city = button.data('arrival_city')
			var depart_date  = button.data('depart_date')
			var modal        = $(this)

			modal.find('#nik').val(nik)
			modal.find('#karyawan').val(karyawan)
			modal.find('#airline').val(airline)
			modal.find('#depart_time').val(depart_time)
			modal.find('#arrival_time').val(arrival_time)
			modal.find('#depart_city').val(depart_city)
			modal.find('#arrival_city').val(arrival_city)
			modal.find('#depart_date').val(depart_date)
			modal.find('#nodoc').val(nodoc)
			modal.find('.modal-title').text('No. Pengajuan : ' + nodoc)
		});
	});

	function save_order_ticket_vendor(){
		var paramstr = $("#form-request-ticket-vendor").serialize();
		var table    = $('#table_ticket_filing').DataTable();
		if($("#form-request-ticket-vendor").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>csubmission/sysubmission/save_order_ticket_vendor",
			paramstr,
			function(data) {
				if(data == 1){
					$('#request-vendor-modal').modal('hide');
					swal("Naiss!", "Berhasil diteruskan ke Vendor Tiket.", "success");
					table.ajax.reload();
				} else {
					$('#request-vendor-modal').modal('hide');
					swal("Oops!", "gagal diteruskan ke Vendor Tiket, Reload halaman ini dan coba lagi.", "error");
					table.ajax.reload();
				}
			});   
		}
	}
   
</script>
