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
               <div class="slider-table">
   					<table id="table_ticket_ordered" class="table table-striped table-hover" width="100%">
                     <thead class="bg-purple-active">
                        <tr>
                           <th></th>
                           <th>No</th>
                           <th>No. Dok</th>
                           <th>Tgl Berangkat</th>
                           <th>Dari</th>
                           <th>Tujuan</th>
                           <th>Berangkat</th>
                           <th>Tiba</th>
                           <th>Maskapai</th>
                           <th>Harga</th>
                           <th>Status</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                  </table><br>
               </div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal" id="ticket-invoice-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-invoice-modalLabel" aria-hidden="true">
   <div class="modal-dialog modal70" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">No. Pengajuan</h4>
         </div>
         <div class="modal-body">
            <form id="form-invoice-ticket" method="post">
               <input type="hidden" name="nodoc" id="nodoc">
               <input type="hidden" name="kodedp" id="kodedp">
               <input type="hidden" name="kodejb" id="kodejb">
               <input type="hidden" name="site" id="site">
               <div class="row">
                  <div class="col-xs-6">
                     <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" id="nik" class="form-under-line input-sm" readonly>
                     </div>
                     <div class="form-group">
                        <label>Dana Transportasi</label>
                        <input type="text" name="dana_trans" id="dana_trans" class="form-under-line input-sm" readonly>
                     </div> 
                     <div class="form-group">
                        <label>Dana Tiket</label>
                        <input type="text" name="price" id="price" class="form-under-line input-sm" readonly>
                     </div> 
                  </div>
                  <div class="col-xs-6">
                     <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="karyawan" id="karyawan" class="form-under-line input-sm" readonly>
                     </div>
                     <div class="form-group">
                        <label>Dana Konsumsi</label>
                        <input type="text" name="dana_kons" id="dana_kons" class="form-under-line input-sm" readonly>
                     </div>
                     <div class="form-group">
                        <label>Total Pengajuan Dana</label>
                        <input type="text" name="total" id="total" class="form-under-line input-sm" readonly>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-12">
                     <div class="form-group">
                        <label>Keterangan</label>
                        <textarea rows="4" class="form-control required" name="desc" id="desc"></textarea>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal"><em>Batal</em></button>
            <button type="button" id="btn_invoice" class="btn btn-warning"><em>Simpan</em></button>
         </div>
      </div>
   </div>
</div>

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
            '<td class="col-xs-2">NIK</td>'+
            '<td>'+d.nik+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Nama Lengkap</td>'+
            '<td>'+d.nama+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Site</td>'+
            '<td>'+d.site+'</td>'+
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
      $("#li-TkOrdr").addClass("bg-purple");
      $("#href-TkOrdr").addClass("white");

      $('#ticket-invoice-modal').on('show.bs.modal', function (event) {
         if (event.namespace == 'bs.modal') {
            var button     = $(event.relatedTarget)
            var nik        = button.data('nik')
            var nodoc      = button.data('nodoc')
            var karyawan   = button.data('karyawan')
            var site       = button.data('site')
            var kodejb     = button.data('kodejb')
            var kodedp     = button.data('kodedp')
            var dana_trans = button.data('dana_trans')
            var dana_kons  = button.data('dana_kons')
            var price      = button.data('price')
            var total      = button.data('total')
            var desc       = button.data('desc')
            var modal      = $(this)

            modal.find('.modal-title').text('No. Pengajuan : ' + nodoc)
            modal.find('#nodoc').val(nodoc)
            modal.find('#nik').val(nik)
            modal.find('#karyawan').val(karyawan)
            modal.find('#kodedp').val(kodedp)
            modal.find('#kodejb').val(kodejb)
            modal.find('#site').val(site)
            modal.find('#dana_trans').val(dana_trans)
            modal.find('#dana_kons').val(dana_kons)
            modal.find('#price').val(price)
            modal.find('#total').val(total)
            modal.find('#desc').val(desc)
         }
      })
      
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
            { "data": "status" },
            { "data": "action" }
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
               "targets": [ 1, 4, 5, 6, 7, 8, 9, 10, 11],
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

      $("#btn_invoice").click(function () {
         $('#loading').removeClass('hidden');
         var formdata = $("#form-invoice-ticket").serialize(),
            table    = $('#table_ticket_ordered').DataTable();
         if($("#form-invoice-ticket").valid() == false){
            return false;
            $('#loading').addClass('hidden');
         } else {
            $.post("<?=base_url();?>cinvoice/sysinvoice/save_invoice_ticket",
            formdata,
            function(data) {
               if(data == "Success"){
                  $('#loading').addClass('hidden');
                  $('#ticket-invoice-modal').modal('hide');
                  swal("Naiss!", "Pengajuan dana berhasil disimpan", "success");
                  table.ajax.reload();
               } else {
                  $('#loading').addClass('hidden');
                  $('#ticket-invoice-modal').modal('hide');
                  swal("Oops!", "Maaf pengajuan gagal diproses. Muat ulang halaman ini dan coba lagi", "error");
                  table.ajax.reload();
               }
            });   
         }
      });

   });
</script>