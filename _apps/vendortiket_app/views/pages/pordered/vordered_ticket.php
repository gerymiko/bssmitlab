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
               <form id="form-filter-order">
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
                           <input type="text" name="s_notiket" class="form-under-line" placeholder="No Tiket">
                        </div>
                     </div>
                  </div>
                  <button type="button" class="btn bg-purple btn-sm" id="btn-filter-order">Filter</button>
                  <button type="button" class="btn bg-yellow btn-sm" id="btn-reset-order">Reset</button>
               </form>
            </div>
         </div>
      </div>
   </div>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
            <div class="dataTables_processings"></div>
				<div class="box-header with-border">
					<h3 class="box-title">Data Tiket Terpesan</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
               <div class="slide-content">
   					<table id="table_ticket_ordered" class="table table-striped table-hover" width="100%">
                     <thead class="bg-purple-active">
                        <tr>
                           <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                           <th>No</th>
                           <th>No. Dok</th>
                           <th>Tgl Brgkt</th>
                           <th>Dari</th>
                           <th>Tujuan</th>
                           <th>Berangkat</th>
                           <th>Tiba</th>
                           <th>Maskapai</th>
                           <th>Harga</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                  </table>
               </div>
				</div>
			</div>
		</div>
	</div>
</section>

<style type="text/css">
   td.details-control {
      background: url('<?=site_url();?>syslink/icon_detail/details_open') no-repeat center center;
      cursor: pointer;
   }
   tr.shown td.details-control {
      background: url('<?=site_url();?>syslink/icon_detail/details_close') no-repeat center center;
   }
</style>

<script type="text/javascript">
   function format ( d ) {
      return '<table cellpadding="0" cellspacing="0" style="padding-left:0px;" class="table table-bordered no-margin">'+
         '<tr>'+
            '<td class="col-xs-2">Tanggal Pengajuan</td>'+
            '<td>'+d.req_date+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">NIK</td>'+
            '<td>'+d.nik+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Nama</td>'+
            '<td>'+d.nama+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Tipe</td>'+
            '<td>'+d.tipe+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Keterangan</td>'+
            '<td>'+d.desc+'</td>'+
         '</tr>'+
      '</table>';
   }

   $(function (){
      $("#li-TktOrd").addClass("bg-red");
      $("#hf-TktOrd").addClass("white");
      
      var table = $('#table_ticket_ordered').DataTable({
         "processing": true,
         "serverSide": true,
         "autoWidth": false,
         "order": [],
         "ajax": {
            "url"  : '<?=site_url()?>cordered/sysordered/table_ticket_ordered',
            "type" : 'POST',
            error: function(data) {
               swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
            }
         },
         "language": {
            "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>',
            "search": '', 
            "searchPlaceholder": "Cari...",
         },
         "columns": [
            {
               "className": 'details-control',
               "data": null,
               "defaultContent": '',
               "orderable": false, 
               "targets": 0
            },
            { "data": "no" },
            { "data": "nodoc" },
            { "data": "flight_date" },
            { "data": "flight_from" },
            { "data": "flight_to" },
            { "data": "jam_pergi" },
            { "data": "jam_tiba" },
            { "data": "airline_name" },
            { "data": "harga" },
            { "data": "status" }
         ],
         "columnDefs": [
            {
               "targets": [ 0 ],
               "className": 'details-control',
               "orderable": false,
               "data": null,
               "defaultContent": ''
            },
            {
               "targets": [ 1, 4, 5, 6, 7, 8, 9, 10],
               "className": "text-center",
               "searchable": false,
               "orderable": false,
            },
            {
               "targets": [ 2, 3 ],
               "className": "text-center"
            },
         ],
      });

      $('#btn-filter-order').click(function(){ 
         table.ajax.reload();
      });
      
      $('#btn-reset-order').click(function(){ 
         $('#form-filter-order')[0].reset();
         table.ajax.reload();
      });

      $('#table_ticket_ordered tbody').on('click', 'td.details-control', function () {
         var tr  = $(this).closest('tr');
         var row = table.row( tr );
 
         if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
         } else {
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
         }
      });
   });
</script>