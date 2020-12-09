<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-default">
            <div class="box-header with-border">
               <h3 class="box-title">Cari Jadwal Penerbangan</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               </div>
            </div>
            <div class="box-body">
               <form method="post" autocomplete="off">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Kota Asal</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fas fa-plane-departure"></i>
                              </div>
                              <select class="form-control" id="city_from" name="city_from">
                                 <option value="BDJ-Banjarmasin" selected>Banjarmasin</option>
                                 <?php
                                    foreach ($city as $row) {
                                       echo '<option value="'.$row->airport_code.'">'.$row->city_name.' ['.$row->airport_code.']</option>';
                                    }
                                 ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Kota Tujuan</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fas fa-plane-arrival"></i>
                              </div>
                              <select class="form-control" id="city_to" name="city_to">
                                 <option value="PLM-Palembang" selected>Palembang</option>
                                 <?php
                                    foreach ($city as $row) {
                                       echo '<option value="'.$row->airport_code.'">'.$row->city_name.' ['.$row->airport_code.']</option>';
                                    }
                                 ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Tanggal Pergi</label>
                           <div class="input-group date">
                              <div class="input-group-addon">
                                 <i class="fas fa-calendar-alt"></i>
                              </div>
                              <input type="text" class="form-control pull-right datepicker" id="depart_date" name="depart_date" value="07-05-2019">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <button type="button" id="btn_sflight" class="btn bg-purple btn-sm"><em>Cari Sekarang</em></button>
                  </div>
               </form>
            </div>
         </div>

         <button class="btn btn-sm btn-block bg-yellow-active btn-flat text-center ls4" style="margin-top: 5px;" data-toggle="modal" data-target="#request-modal"><b><em>PESAN</em></b></button>

         <div class="box box-default hidden" id="box-result">
            <div class="dataTables_processings"></div>
            <div class="box-header">
               <h3 class="box-title">Hasil Pencarian . . .</h3>
               <div class="box-tools pull-right">
                  <div id="countdown_timer"></div>
               </div>
            </div>
            <div class="box-body no-padding">
               <table id="table_result_schedule" class="table table-hover">
                  <thead class="bg-purple-active">
                     <tr>
                        <th>Maskapai</th>
                        <th>Maskapai2</th>
                        <th>Ket</th>
                        <th>Berangkat</th>
                        <th>Tiba</th>
                        <th>Berangkat2</th>
                        <th>Tiba2</th>
                        <th>Durasi</th>
                        <th>Transit</th>
                        <th>Status</th>
                        <th>Harga</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
</section>

<div class="modal fade" id="request-modal" role="dialog" aria-labelledby="request-modalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content modal70">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Pengajuan Tiket Dinas</h4>
         </div>
         <div class="modal-body">
            <form id="form-request-ticket-official" method="post">
               <input type="hidden" name="kode_maskapai" id="kode_maskapai">
               <div class="box box-default">
                  <div class="box-header">
                     <h3 class="box-title">Detail Karyawan</h3>
                  </div>
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="col-form-label">Nama Karyawan</label>
                              <select class="form-control required" id="karyawan" name="karyawan" required="required">
                                 <option>Pilih</option>
                                 <?php
                                    foreach ($list_karyawan as $row) {
                                       echo '<option value="'.$row->NIK.'">'.$row->NaKar.' - '.$row->jabatan.'</option>';
                                    }
                                 ?>
                              </select>
                           </div>
                           <div style="padding: 17px !important;" ></div>
                           <div class="form-group">
                              <label class="col-form-label">SITE</label>
                              <input type="text" name="site" class="form-control" id="site" readonly >
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Referensi No. Dok Dinas</label>
                              <select class="form-control required" name="jenis_tiket" id="jenis_tiket">
                                 <option value="0">Pilih</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="col-form-label">NIK</label>
                              <input type="text" name="nik" class="form-control" id="nik" readonly >
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Jenis Tiket</label>
                              <select class="form-control required" name="jenis_tiket" id="jenis_tiket">
                                 <option value="0">Pilih</option>
                                 <option value="1">Tiket Pergi</option>
                                 <option value="2">Tiket Pulang</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="box box-default">
                  <div class="box-header">
                     <h3 class="box-title">Detail Tiket</h3>
                  </div>
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="col-form-label">Maskapai</label>
                              <input type="text" class="form-under-line input-sm" name="maskapai" readonly id="maskapai">
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Jam Berangkat</label>
                              <input type="text" class="form-under-line input-sm" name="jam_depart" readonly id="depart">
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Kota Asal</label>
                              <input type="text" class="form-under-line input-sm" name="depart_city" readonly id="depart_city">
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Harga</label>
                              <input type="text" class="form-under-line input-sm" name="price" readonly id="price">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="col-form-label">Tanggal</label>
                              <input type="text" class="form-under-line input-sm" name="depart_date" readonly id="depart_date">
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Jam Tiba</label>
                              <input type="text" class="form-under-line input-sm" name="jam_arrive" readonly id="arrive">
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Kota Tujuan</label>
                              <input type="text" class="form-under-line input-sm" name="arrive_city" readonly id="arrive_city">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal"><em>Batal</em></button>
            <button type="button" onclick="save_order_ticket_official();" class="btn btn-primary"><em>Pesan Tiket</em></button>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
   $(document).ready(function () {
      $('#karyawan').change(function() {
         var nik = $(this).val();
         $.ajax({
            type: "POST",
            url: "<?=base_url();?>cschedule/syschedule/get_detailkaryawan",
            data: {nik:nik},
            success:function(data){
               var obj = JSON.parse(data);
               $("#nik").val(obj.NIK);
               $("#site").val(obj.KodeST);
            }
         });
      });

      $("#li-SrcSch").addClass("bg-purple");
      $("#href-SrcSch").addClass("white");

      $("#city_from, #city_to, #karyawan").select2({
         placeholder: "Pilih",
         allowClear: true
      });

      $('#request-modal').on('show.bs.modal', function (event) {
         var button        = $(event.relatedTarget)
         var maskapai      = button.data('maskapai')
         var kode_maskapai = button.data('kode_maskapai')
         var depart        = button.data('depart')
         var arrive        = button.data('arrive')
         var depart_city   = button.data('depart_city')
         var arrive_city   = button.data('arrive_city')
         var depart_date   = button.data('depart_date')
         var price         = button.data('price')
         var modal         = $(this)

         modal.find('#maskapai').val(maskapai)
         modal.find('#depart').val(depart)
         modal.find('#arrive').val(arrive)
         modal.find('#depart_city').val(depart_city)
         modal.find('#arrive_city').val(arrive_city)
         modal.find('#depart_date').val(depart_date)
         modal.find('#price').val(price)
         modal.find('#kode_maskapai').val(kode_maskapai)
      })

      $('.modal').on('hidden.bs.modal', function (e) {
         $(this)
         .find("input").val('').end()
         $("#karyawan").val([]).trigger("change");
      });

      function format_transit ( data ) {
         return '<table cellpadding="5" cellspacing="0" border="0">'+
            '<div class="row">'+
               '<div class="col-md-3">'+
                  '<h4>Rincian Penerbangan :</h4>'+
               '</div>'+
               '<div class="col-md-9">'+
                  '<div class="row">'+
                     '<div class="col-xs-3">'+
                        '<ol class="schedule-detail">'+
                           '<li>'+data.pic+'<br>'+data.flight_number+'</li>'+
                           '<li>'+data.airline_transit_pic+'<br>'+data.airline_transit.flight_date+'<br>'+data.airline_transit.flight_number+'</li>'+
                        '</ol>'+
                     '</div>'+
                     '<div class="col-xs-4">'+
                        '<ol class="schedule-detail-time">'+
                           '<li>'+data.depart_time+' | '+data.departure_city+'<br>'+data.arrive_time+' | '+data.arrival_city+'<br><i class="far fa-clock"></i> Durasi '+data.status+'</li>'+
                           '<li>'+data.airline_transit.departure_time+' | '+data.airline_transit.departure_city+'<br>'+data.airline_transit.arrival_time+' | '+data.airline_transit.arrival_city+'<br><i class="far fa-clock"></i> Durasi '+data.airline_transit.duration+' menit</li>'+
                        '</ol>'+
                     '</div>'+
                     '<div class="col-xs-4">'+
                        '<ol class="schedule-detail-time">'+
                           '<li>Bagasi : '+data.baggage+' Kg<br>'+data.price+'<br>(Termasuk Airline Fee, IWJR, dan PPN)</li>'+
                           '<li></li>'+
                        '</ol>'+
                     '</div>'+
                  '</div>'+
               '</div>'+
            '</div>'+
         '</table>';
      }

      function format_direct ( data ) {
         return '<table cellpadding="5" cellspacing="0" border="0">'+
            '<div class="row">'+
               '<div class="col-md-3">'+
                  '<h4>Rincian Penerbangan :</h4>'+
               '</div>'+
               '<div class="col-md-9">'+
                  '<div class="row">'+
                     '<div class="col-xs-3">'+
                        '<ol class="schedule-detail">'+
                           '<li>'+data.pic+'<br>'+data.flight_number+'</li>'+
                        '</ol>'+
                     '</div>'+
                     '<div class="col-xs-4">'+
                        '<ol class="schedule-detail-time">'+
                           '<li>'+data.depart_time+' | '+data.departure_city+'<br>'+data.arrive_time+' | '+data.arrival_city+'<br><i class="far fa-clock"></i> Durasi '+data.status+'</li>'+
                        '</ol>'+
                     '</div>'+
                     '<div class="col-xs-4">'+
                        '<ol class="schedule-detail-time">'+
                           '<li>Bagasi : '+data.baggage+' Kg<br>'+data.price+'<br>(Termasuk Airline Fee, IWJR, dan PPN)</li>'+
                           '<li></li>'+
                        '</ol>'+
                     '</div>'+
                  '</div>'+
               '</div>'+
            '</div>'+
         '</table>';
      }

      function sorting(json_object, key_to_sort_by) {
         function sortByKey(a, b) {
           var x = a[key_to_sort_by];
           var y = b[key_to_sort_by];
           return ((x < y) ? -1 : ((x > y) ? 1 : 0));
         }
         json_object.sort(sortByKey);
      }

      $('#btn_sflight').click(function(e) {
         e.preventDefault();
         if ( $.fn.DataTable.isDataTable('#table_result_schedule') ) {
           $('#table_result_schedule').DataTable().destroy();
         }

         $('#table_result_schedule tbody').empty();
         $('#table_result_schedule').DataTable().destroy();

         var city_from2 = $('#city_from').val(),
            city_to2    = $('#city_to').val(),
            depart_date = $('#depart_date').val();

         var city_from = city_from2.split("-")[0],
            city_to  = city_to2.split("-")[0],
            city_to3 = city_to2.split("-")[1];

         if (city_from !== '' && city_to !== '' && depart_date !== '') {
            $('#box-result').removeClass('hidden');

            // var timeLeft = 60;
            // var elem     = document.getElementById('countdown_timer');
            // var timerId  = setInterval(countdown, 1000);

            // function countdown() {
            //    if (timeLeft == 0) {
            //       clearTimeout(timerId);
            //       swal({
            //          title: "<h4>Silakan klik refresh untuk lihat harga terkini</h4>",
            //          text: "Maskapai penerbangan terus memperbarui harga tiket mereka dari waktu ke waktu mengikuti permintaan & ketersediaan. Ini normal, jangan khawatir.", 
            //          confirmButtonText:  'Refresh'}).then(function(){ 
            //             $( "#btn_sflight" ).click();
            //          }
            //       );
            //    } else {
            //       elem.innerHTML = 'Waktu ketersediaan jadwal : ' + timeLeft + ' detik tersisa';
            //       timeLeft--;
            //    }
            // }

            var table = $('#table_result_schedule').DataTable({
               "processing": true,
               "serverSide": true,
               "autoWidth": false,
               "bInfo": false,
               "bPaginate": false,
               "bFilter": false,
               "bLengthChange": false,
               "destroy": true,
               "scrollX": true,
               "order": [],
               "ajax": {
                  "url": '<?=site_url()?>cschedule/syschedule/search_flight',
                  "type": 'POST',
                  "dataType": 'JSON',
                  "cache": false,
                  data : function ( data ){
                     data.city_from    = city_from;
                     data.city_to      = city_to;
                     data.depart_date  = depart_date;
                  },
                  error: function ( data ){
                     swal("Oh Noez!", "Gagal menarik data! Muat ulang halaman ini dan coba lagi", "error");
                     $('#box-result').addClass('hidden');
                  },
                  dataSrc: function ( data ){
                     return data.data;
                     table.ajax.reload();
                     // countdown();
                  } 
               },
               "language": { "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>' },
               "columns": [ 
                  { data: 'pic' },
                  { data: 'airline' },
                  { data: 'flight_number' },
                  { data: 'departure' },
                  { data: 'arrival' },
                  { data: 'depart_time' },
                  { data: 'arrive_time' },
                  { data: 'duration' },
                  { data: 'transit' },
                  { data: 'status' },
                  { data: 'price' },
               ],
               "columnDefs": [
                  {
                     "targets": [ 1, 5, 6, 9 ],
                     "orderable": false,
                     "visible": false,
                  },
                  {
                     "targets": [ 0, 2, 3, 4, 7, 8 ],
                     "className": "text-center",
                     "searchable": false,
                     "orderable": false,
                  },
                  {
                     "targets": [ 10 ],
                     "className": "f15 text-center",
                     "searchable": false,
                     "orderable": false,
                  },
                  {
                     "targets": 11,
                     "searchable": false,
                     "orderable": false,
                     "className": "text-center",
                     render : function(data ,type, row) {
                        return '<button class="btn btn-sm btn-block bg-yellow-active btn-flat text-center ls4" style="margin-top: 5px;" data-toggle="modal" data-target="#request-modal" data-kode_maskapai="'+row.airline_code+'" data-maskapai="'+row.airline+'" data-depart="'+row.depart_time+'" data-arrive="'+row.arrive_time+'" data-depart_city="'+row.departure_city+'" data-arrive_city="'+row.arrival_city+'" data-transit_city="'+row.arrival_city+'" data-depart_date="'+row.depart_date+'" data-price="'+row.price+'"><b><em>PESAN</em></b></button>'
                     }
                  }
               ],
            });

            $('#table_result_schedule tbody').on('click', 'a.detail-penerbangan', function () {
               var tr  = $(this).closest('tr');
               var row = table.row( tr );
               var transit = tr.find("td:nth-child(6)").text();

               if (transit == "Transit") {
                  if ( row.child.isShown() ){
                     row.child.hide();
                     tr.removeClass('shown');
                  } else {
                     row.child( format_transit(row.data()) ).show();
                     tr.addClass('shown');
                  }
               } else {
                  if ( row.child.isShown() ){
                     row.child.hide();
                     tr.removeClass('shown');
                  } else {
                     row.child( format_direct(row.data()) ).show();
                     tr.addClass('shown');
                  }
               }
            });            

         } else {
            swal("Oh Noez!", "Pilih keberangkatan, tujuan dan jenis pesawat terlebih dahulu", "error");
         }   
      });
   });

   function save_order_ticket_official(){
      var formdata = $("#form-request-ticket-official").serialize();
      var table    = $('#table_result_schedule').DataTable();
      if($("#form-request-ticket-official").valid() == false){
         return false;
      } else {
         $.post("<?=base_url();?>cschedule/syschedule/save_order_ticket_official",
         formdata,
         function (data){
            if(data == 1){
               $('#request-modal').modal('hide');
               swal("Naiss!", "Tiket telah berhasil dipilih.", "success");
               table.ajax.reload();
            } else if (data == 2) {
               $('#request-modal').modal('hide');
               swal("Oops!", "Tiket sudah diajukan.", "error");
               table.ajax.reload();
            } else {
               $('#request-modal').modal('hide');
               swal("Oops!", "Tiket gagal dipilih, reload halaman ini dan coba lagi.", "error");
               table.ajax.reload();
            }
         });   
      }
   }
</script>