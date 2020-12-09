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
               <form id="form-filter-option">
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
                  <button type="button" class="btn bg-purple btn-sm" id="btn-filter-option">Filter</button>
                  <button type="button" class="btn bg-yellow btn-sm" id="btn-reset-option">Reset</button>
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
					<h3 class="box-title">Data Opsi Tiket dari Vendor</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
               <div class="slider-table">
   					<table id="table_ticket_option" class="table table-striped table-hover" width="100%">
                     <thead class="bg-purple-active">
                        <tr>
                           <th>&nbsp;&nbsp;</th>
                           <th>No</th>
                           <th>No. Dok</th>
                           <th>Tgl Berangkat</th>
                           <th>Kota Asal</th>
                           <th>Tujuan</th>
                           <th>Berangkat</th>
                           <th>Tiba</th>
                           <th>Maskapai</th>
                           <th>Status</th>
                           <th></th>
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
            '<td>'+d.submission_date+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Status</td>'+
            '<td>'+d.status+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">NIK</td>'+
            '<td>'+d.nik+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Nama</td>'+
            '<td>'+d.name+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Tipe</td>'+
            '<td>'+d.type+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Perkiraan Harga</td>'+
            '<td>'+d.price+'</td>'+
         '</tr>'+
      '</table>';
   }

   $(function (){
      $("#li-OpsNVnDr").addClass("bg-purple");
      $("#href-OpsNVnDr").addClass("white");

      var table = $('#table_ticket_option').DataTable({
         "processing": true,
         "serverSide": true,
         "autoWidth": false,
         "order": [],
         "ajax": {
            "url"  : '<?=site_url()?>coption/sysoption/table_ticket_option',
            "type" : 'POST',
            error: function(data) {
               swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
            }
         },
         "language": {
            "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>',
            "search": '', 
            "searchPlaceholder": "Cari...",
            "paginate": {
               "next": '<i class="fas fa-caret-right"></i>',
               "previous": '<i class="fas fa-caret-left"></i>'
            }
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
            { "data": "depart_time" },
            { "data": "arrival_time" },
            { "data": "airline_name" },
            { "data": "sts_tiket" },
            { "data": "button" }
         ],
         "columnDefs": [
            {
               "targets": [ 0, 1, 3, 4, 5, 6, 7, 8, 9, 10 ],
               "className": "text-center",
               "searchable": false,
               "orderable": false,
            },
            {
               "targets": [ 2 ],
               "className": "text-center"
            },
         ],
      });

      $('#table_ticket_option tbody').on('click', 'td.details-control', function () {
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

      $('#btn-filter-option').click(function(){ 
         table.ajax.reload();
      });
      
      $('#btn-reset-option').click(function(){ 
         $('#form-filter-option')[0].reset();
         table.ajax.reload();
      });
   });
</script>