<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Data Pengajuan Tiket Dinas</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<table id="table_ticket_filing" class="table table-bordered table-hover">
                  <thead class="bg-gray-active">
                     <tr>
                        <th>No</th>
                        <th>No. Dok</th>
                        <th>Tanggal</th>
                        <th>Kota Asal</th>
                        <th>Tujuan</th>
                        <th>Berangkat</th>
                        <th>Tiba</th>
                        <th>Maskapai</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Tipe</th>
                        <th>Ket</th>
                        <th>No. Tiket</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
   $(function (){
      $("#li-Pocl").addClass("bg-purple");
      $("#href-Pocl").addClass("white");
      
      var table = $('#table_ticket_filing').DataTable({
         "processing": true,
         "serverSide": true,
         "scrollX":        true,
         "scrollCollapse": true,
         "order": [],
         "ajax": {
            "url"  : '<?=site_url()?>cticket/sysfiling/table_ticket_filing',
            "type" : 'POST',
            // error: function(data) {
            //    swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
            // }
         },
         // "columnDefs": [
         //    {
         //       "targets": [ 0, 9, 10, 11, 12, 13 ],
         //       "className": "text-center",
         //       "searchable": false,
         //       "orderable": false,
         //    },
         //    {
         //       "targets": [ 1, 2, 3, 4, 5, 6, 7, 8 ],
         //       "className": "text-center"
         //    },
         // ],
      });
   });
</script>