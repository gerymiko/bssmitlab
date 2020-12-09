<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-default collapsed-box">
            <div class="box-header" data-widget="collapse">
               <h3 class="box-title">Cari data invoice</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               </div>
            </div>
            <div class="box-body">
               <form id="form-filter-order">
                  <div class="row">
                     <div class="col-xs-3">
                        <div class="form-group">
                           <input type="text" name="s_nodoc" class="form-under-line" placeholder="NoDok Pengajuan Dana">
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
                           <input type="text" name="s_notiket" class="form-under-line" placeholder="NoDok Pengajuan Tiket">
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
               <h3 class="box-title">Data Invoice</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               </div>
            </div>
            <div class="box-body">
               <div class="slide-content">
                  <table id="table_invoice" class="table table-striped table-hover" width="100%">
                     <thead class="bg-purple-active">
                        <tr>
                           <th>&nbsp;&nbsp;</th>
                           <th>No</th>
                           <th>No. Dok</th>
                           <th>Tanggal</th>
                           <th>NIK</th>
                           <th>Nama</th>
                           <th>Site</th>
                           <th>Subtotal</th>
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
            '<td class="col-xs-2">No. Pengajuan Tiket</td>'+
            '<td>'+d.nodoc_ticket+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Keterangan</td>'+
            '<td>'+d.keterangan+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Tgl Berangkat</td>'+
            '<td>'+d.flight_date+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Maskapai</td>'+
            '<td>'+d.airline_name+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Dari</td>'+
            '<td>'+d.flight_from+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Tujuan</td>'+
            '<td>'+d.flight_to+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Harga Tiket</td>'+
            '<td>'+d.ticket_price+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Dana Transportasi</td>'+
            '<td>'+d.trans_price+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Dana Konsumsi</td>'+
            '<td>'+d.cons_price+'</td>'+
         '</tr>'+
      '</table>';
   }

   $(function (){
      $("#li-dInv").addClass("bg-purple");
      $("#href-dInv").addClass("white");

      var table = $('#table_invoice').DataTable({
         "processing": true,
         "serverSide": true,
         "autoWidth": false,
         "order": [],
         "ajax": {
            "url"  : '<?=site_url()?>cinvoice/sysinvoice/table_invoice_ticket',
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
            { "data": "invoice_date.tgl" },
            { "data": "nik" },
            { "data": "name" },
            { "data": "site" },
            { "data": "price" },
            { "data": "button" }
         ],
         "columnDefs": [
            {
               "targets": [ 0, 1, 4, 5, 6, 7, 8 ],
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

      $('#table_invoice tbody').on('click', 'td.details-control', function () {
         var tr  = $(this).closest('tr'),
             row = table.row( tr );
         if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
         } else {
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
         }
      });
   });

   function bayar(){
      swal('informasi', 'Apakah sudah dibayar untuk invoice tiket ini ?', 'warning');
   }
</script>