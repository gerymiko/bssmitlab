<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Data Tiket disetujui oleh BSS</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<table id="table_ticket_approved" class="table table-striped table-hover">
                  <thead class="bg-purple-active">
                     <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>No</th>
                        <th>No. Dok</th>
                        <th>Tgl Brgkt</th>
                        <th>Kota Asal</th>
                        <th>Tujuan</th>
                        <th>Berangkat</th>
                        <th>Tiba</th>
                        <th>Maskapai</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal" id="booking-modal" tabindex="-1" role="dialog" aria-labelledby="booking-modalLabel" aria-hidden="true">
   <div class="modal-dialog modal70" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">No. Pengajuan</h4>
         </div>
         <div class="modal-body">
            <form id="form-booking-ticket" method="post">
               <input type="hidden" name="nodoc" id="nodoc">
               <div class="row">
                  <div class="col-xs-6">
                     <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" id="nik" class="form-under-line input-sm" readonly>
                     </div>
                     <div class="form-group">
                        <label>Asal</label>
                        <input type="text" name="depart_city" id="depart_city" class="form-under-line input-sm" readonly>
                     </div>
                     <div class="form-group">
                        <label>Jam Berangkat</label>
                        <input type="text" name="depart_time" id="depart_time" class="form-under-line input-sm" readonly>
                     </div>
                     <div class="form-group">
                        <label>Maskapai</label>
                        <input type="text" name="airline" id="airline" class="form-under-line input-sm" readonly>
                     </div>
                     <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" name="depart_date" id="depart_date" class="form-under-line input-sm" readonly>
                     </div>
                  </div>
                  <div class="col-xs-6">
                     <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="karyawan" id="karyawan" class="form-under-line input-sm" readonly>
                     </div>
                     <div class="form-group">
                        <label>Tujuan</label>
                        <input type="text" name="arrival_city" id="arrival_city" class="form-under-line input-sm" readonly>
                     </div>
                     <div class="form-group">
                        <label>Jam Tiba</label>
                        <input type="text" name="arrival_time" id="arrival_time" class="form-under-line input-sm" readonly>
                     </div>
                     <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="price" id="price" class="form-under-line input-sm" readonly>
                     </div>
                     <div class="form-group">
                        <label>Tiket</label>
                        <input type="file" name="file_ticket" id="file_ticket" class="form-control input-sm">
                     </div>
                  </div>
               </div>
               <div class="progress-booking" style="display:block;">
                  <div id="progress-bar-booking" class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal"><em>Batal</em></button>
            <button type="submit" id="btn_booking_ticket" class="btn btn-primary" disabled><em>Kirim</em></button>
         </div>
         </form>
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
      return '<table cellpadding="0" cellspacing="0" style="padding-left:0px;" class="table table-striped no-margin">'+
         '<tr>'+
            '<td class="col-xs-2">NIK</td>'+
            '<td>'+d.nik+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Nama</td>'+
            '<td>'+d.name+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">No. KTP</td>'+
            '<td>'+d.noktp+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Tipe</td>'+
            '<td>'+d.type+'</td>'+
         '</tr>'+
      '</table>';
   }

   $(function (){
      $("#li-TktAgrd").addClass("bg-red");
      $("#hf-TktAgrd").addClass("white");

      var table = $('#table_ticket_approved').DataTable({
         "processing": true,
         "serverSide": true,
         "scrollX": true,
         "scrollCollapse": true,
         "autoWidth": false,
         "order": [],
         "ajax": {
            "url"  : '<?=site_url()?>capproved/sysapproved/table_ticket_approved',
            "type" : 'POST',
            error: function(data) {
               swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
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
            { "data": "price" },
            { "data": "status" },
            { "data": "action" }
        ],
         "columnDefs": [
            {
               "targets": [ 0, 1, 4, 5, 6, 7, 8, 9, 10, 11 ],
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

      $('#table_ticket_approved tbody').on('click', 'td.details-control', function () {
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

      $('#booking-modal').on('show.bs.modal', function (event) {
         var button       = $(event.relatedTarget)
         var nodoc        = button.data('nodoc')
         var nik          = button.data('nik')
         var karyawan     = button.data('karyawan')
         var airline      = button.data('airline')
         var depart_time  = button.data('depart_time')
         var arrival_time = button.data('arrival_time')
         var depart_city  = button.data('depart_city')
         var arrival_city = button.data('arrival_city')
         var depart_date  = button.data('depart_date')
         var price        = button.data('price')
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
         modal.find('#price').val(price)
         modal.find('.modal-title').text('No. Pengajuan : ' + nodoc)
      });

      $('#file_ticket').change(
         function(){
             if ($(this).val()) {
                 $('#btn_booking_ticket').attr('disabled',false);
            var progressBar = $('#progress-bar-booking');
            $("#form-booking-ticket").on('submit',(function(e) {
               e.preventDefault();

               if($("#form-booking-ticket").valid() == false){
                  return false;
               } else {
                  $.ajax({
                     url: "<?=site_url();?>capproved/sysapproved/save_booking_ticket",
                     type: "POST",
                     data: new FormData(this),
                     contentType: false,
                     cache: false,
                     processData:false,
                     success: function(data){
                        if(data !== 'Success'){
                           $('#booking-modal').modal('hide');
                           $('.progress-booking').hide();
                           $('#btn_booking_ticket').removeClass('hidden');
                           swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
                        } else {
                           $('#booking-modal').modal('hide');
                           swal({
                              title: "Naiss!", 
                              text: "Informasi tiket telah diteruskan kepada PT BSS", 
                              type: "success"}).then(function(){ 
                                 location.reload();
                              }
                           );
                        }
                     },
                     xhr: function() {
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(event) {
                           if (event.lengthComputable) {
                              var percentComplete = Math.round( (event.loaded / event.total) * 100 );
                              $('#btn_booking_ticket').addClass('hidden');
                              $('.progress-booking').show();
                              progressBar.css({width: percentComplete + "%"});
                              progressBar.text(percentComplete + '%');
                           };
                        }, false);
                        return xhr;
                     }     
                  });
               }
            }));
         }
      });
   });
</script>