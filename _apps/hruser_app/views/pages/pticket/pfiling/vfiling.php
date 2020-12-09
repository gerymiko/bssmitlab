<section class="content-header">
	<h1>PENGAJUAN <b>TIKET</b>
		<small><em>Human Resource Department System</em></small>
	</h1>
</section>
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
               <form id="form-filter-filing">
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
                  <button type="button" class="btn bg-purple btn-sm btn-flat" id="btn-filter-filing">Filter</button>
                  <button type="button" class="btn bg-yellow btn-sm btn-flat" id="btn-reset-filing">Reset</button>
               </form>
            </div>
         </div>
      </div>
   </div>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Data Pengajuan Tiket</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
               <div class="slider-table">
   					<table id="table_ticket_filing" class="table table-striped table-hover" width="100%">
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
                           <th>Status</th>
                           <th>Tipe</th>
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
   function format ( d ){
      return '<table cellpadding="0" cellspacing="0" style="padding-left:0px;" class="table table-bordered no-margin">'+
      '<tr>'+
         '<td class="col-xs-2">Tanggal Pengajuan</td>'+
         '<td>'+d.submission_date+'</td>'+
      '</tr>'+
      '<tr>'+
         '<td class="col-xs-2">Jenis Tiket</td>'+
         '<td><b>'+d.jenis+'</b></td>'+
      '</tr>'+
      '<tr>'+
         '<td class="col-xs-2">NIK</td>'+
         '<td>'+d.nik+'</td>'+
      '</tr>'+
      '<tr>'+
         '<td class="col-xs-2">Nama Karyawan</td>'+
         '<td>'+d.name+'</td>'+
      '</tr>'+
      '<tr>'+
         '<td class="col-xs-2">Site</td>'+
         '<td>'+d.site+'</td>'+
      '</tr>'+
      '<tr>'+
         '<td class="col-xs-2">Harga Tiket</td>'+
         '<td>'+d.flight_price+'</td>'+
      '</tr>'+
      '<tr>'+
         '<td class="col-xs-2">Dana Transportasi</td>'+
         '<td>'+d.transport_funds+'</td>'+
      '</tr>'+
      '<tr>'+
         '<td class="col-xs-2">Dana Konsumsi</td>'+
         '<td>'+d.consump_funds+'</td>'+
      '</tr>'+
      '<tr>'+
         '<td class="col-xs-2">Subtotal</td>'+
         '<td>'+d.subtotal+'</td>'+
      '</tr>'+
      '<tr>'+
         '<td class="col-xs-2">Keterangan</td>'+
         '<td>'+d.descript+'</td>'+
      '</tr>'+
      '</table>';
   }

   $(function (){
      $("#li-dtPngn").addClass("bg-purple");
      $("#hr-dtPngn").addClass("white");
      $(".treeview").addClass("active menu-open");
      
      var table = $('#table_ticket_filing').DataTable({
         "processing": true,
         "serverSide": true,
         "order": [],
         "ajax": {
            "url": '<?=site_url()?>cticket/sysfiling/table_ticket_filing',
            "type": 'POST',
            error: function(data) {
               swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
            }
         },
         "language": {
            "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>'
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
            { "data": "status" },
            { "data": "type" },
            { "data": "action" },
         ],
         "columnDefs": [
            {
               "targets": [ 0, 1, 4, 5, 6, 7, 8, 9, 10, 11 ],
               "className": "text-center",
               "searchable": false,
               "orderable": false,
            },
            {
               "targets": [ 2, 3  ],
               "className": "text-center"
            },
         ],
      });

      $('#table_ticket_filing tbody').on('click', 'td.details-control', function () {
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

      $('#btn-filter-filing').click(function(){ 
         table.ajax.reload();
      });
      
      $('#btn-reset-filing').click(function(){ 
         $('#form-filter-filing')[0].reset();
         table.ajax.reload();
      });
   });
</script>