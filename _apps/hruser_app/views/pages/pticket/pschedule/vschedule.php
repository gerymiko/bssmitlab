<section class="content-header">
   <h1>PENGAJUAN <b>TIKET</b>
      <small><em>Human Resource Department System</em></small>
   </h1>
</section>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-default">
            <div class="box-body">
               Persyaratan pemesanan tiket :
               <ol>
                  <li>Batas pemesanan tiket : Pada hari kerja paling lambat jam 15:00 WITA.</li>
                  <li>Jika tidak tampil daftar tiket mohon reload halaman ini dan coba lagi.</li>
                  <li>Harga yang tertera pada tabel hanya harga perkiraan bukan harga aktual.</li>
               </ol>
            </div>
         </div>

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
                                 <option value="BPN-Balikpapan" selected>Balikpapan</option>
                                 <?php
                                    foreach ($city as $row) {
                                       echo '<option value="'.$row->airport_code.'-'.$row->city_name.'">'.$row->city_name.' ['.$row->airport_code.']</option>';
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
                                       echo '<option value="'.$row->airport_code.'-'.$row->city_name.'">'.$row->city_name.' ['.$row->airport_code.']</option>';
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
                              <input type="text" class="form-control pull-right datepicker" id="depart_date" name="depart_date" value="01-05-2019">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <button type="button" id="btn_sflight" class="btn btn-flat btn-warning btn-sm"><em>Cari Sekarang</em></button>
                  </div>
               </form>
            </div>
         </div>

         <!-- <button class="btn btn-sm btn-block btn-warning btn-flat text-center ls4" data-toggle="modal" data-target="#request-modal"><b><em>PESAN</em></b></button> -->

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

<div class="modal fade" id="request-modal" tabindex="-1" role="dialog" aria-labelledby="request-modalLabel" aria-hidden="true">
   <div class="modal-dialog modal70" role="document">
      <div class="modal-content modal70">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Pengajuan Tiket Cuti</h4>
         </div>
         <div class="modal-body">
            <form id="form-request-ticket" method="post">
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
                              <input type="text" class="form-under-line input-sm" name="karyawan" readonly value="<?=$dkaryawan->Nama;?>">
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">SITE</label>
                              <input type="text" class="form-under-line input-sm" name="site" readonly value="<?=$dkaryawan->KodeST;?>">
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Jenis Pengajuan</label>
                              <select class="form-control input-sm required" name="jenis_tiket" id="jenis_tiket">
                                 <option value="0">Pilih</option>
                                 <option value="1">Tiket Pergi</option>
                                 <option value="2">Tiket Pulang</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="col-form-label">NIK</label>
                              <input type="text" class="form-under-line input-sm" name="nik" readonly value="<?=$dkaryawan->NIK;?>">
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">POH</label>
                              <input type="text" class="form-under-line input-sm" name="foh" readonly value="<?=$dkaryawan->POH;?>">
                           </div>
                           <div class="form-group">
                              <label class="col-form-label">Referensi No. Dok Cuti</label>
                              <select class="form-control input-sm required" name="nodoc_ref" id="nodoc_ref" disabled="disabled">
                                 <option value="0">Pilih</option>
                                 <?php
                                    foreach ($list_tiket as $row) {
                                       echo '
                                          <option>'.$row->nopengajuancuti.'</option>
                                       ';
                                    }
                                 ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label class="col-form-label">Keterangan</label>
                              <div id="keterangan_status"></div>
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
            <button type="button" onclick="save_order_ticket();" class="btn btn-primary"><em>Pesan Tiket</em></button>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
   $(document).ready(function () {
      $("#li-crSch").addClass("bg-purple");
      $("#hr-crSch").addClass("white");
      $(".treeview").addClass("active menu-open");

      // var val_jenis_tiket = $('#jenis_tiket').children("option:selected").val();
      // console.log(val_jenis_tiket);

      $('#jenis_tiket').change(function(){ 
            $('#nodoc_ref').removeAttr('disabled');
            if ($('#jenis_tiket').val() == 0) {
               $('#nodoc_ref').attr('disabled', true);
               $('#nodoc_ref option[value=0]').attr('selected','selected');
            }
      });

      $('#nodoc_ref').change(function(){
         var nodoc_ref = $(this).children("option:selected").val(),
            jenis_tiket = $('#jenis_tiket').children("option:selected").val();
      });

      $('#request-modal').on('show.bs.modal', function (event) {
         if (event.namespace == 'bs.modal') {
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
         }
      })

      $("#city_from, #city_to").select2({
         placeholder: "Pilih",
         allowClear: true
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

         if (city_from !== '' && city_to !== '' && depart_date !== '' ) {
            $('#box-result').removeClass('hidden');

            var table = $('#table_result_schedule').DataTable({
               "processing": true,
               "serverSide": true,
               "autoWidth": false,
               "bInfo": false,
               "bPaginate": false,
               "bFilter": false,
               "bLengthChange": false,
               "scrollX": true,
               "scrollCollapse": true,
               "cache" : false,
               "order": [],
               "ajax": {
                  url: '<?=site_url()?>cticket/syschedule/cari_jadwal',
                  type: 'POST',
                  dataType: 'JSON',
                  cache: false,
                  data : function ( data ){
                     data.city_from   = city_from;
                     data.city_to     = city_to;
                     data.depart_date = depart_date;
                  },
                  error: function ( data ){
                     swal("Oh Noez!", "Gagal menarik data! Muat ulang halaman ini dan coba lagi", "error");
                     $('#box-result').addClass('hidden');
                  },
                  dataSrc: function ( data ){
                     return data.data;
                     table.ajax.reload();
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

                        return '<button class="btn btn-sm btn-block btn-warning btn-flat text-center ls4" style="margin-top: 5px;" data-toggle="modal" data-target="#request-modal" data-kode_maskapai="'+row.airline_code+'" data-maskapai="'+row.airline+'" data-depart="'+row.depart_time+'" data-arrive="'+row.arrive_time+'" data-depart_city="'+row.departure_city+'" data-arrive_city="'+city_to3+'" data-depart_date="'+row.depart_date+'" data-price="'+row.price+'"><b><em>PESAN</em></b></button>'
                     }
                  }
               ],
            });

            $('.detail-penerbangan').tooltip({selector: '[data-toggle="tooltip"]'});

            $('#table_result_schedule tbody').on('click', 'a.detail-penerbangan', function () {
               var tr  = $(this).closest('tr'),
                  row = table.row( tr ),
                  transit = tr.find("td:nth-child(6)").text();

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
            swal("Oh Noez!", "Pilih keberangkatan, tujuan dan tanggal berangkat terlebih dahulu", "error");
         }   
      });

   });

   function save_order_ticket(){
      var paramstr = $("#form-request-ticket").serialize();
      if($("#form-request-ticket").valid() == false || $("jenis_tiket").val() == 0 ){
         return false;
      } else {
         $.post("<?=base_url();?>cticket/syschedule/save_order_ticket",
         paramstr,
         function(data) {
            if(data == 1){
               $('#request-modal').modal('hide');
               swal("Naiss!", "Pengajuan tiket berhasil disimpan, mohon menunggu admin memproses pengajuan anda", "success");
            } else if(data == 2) {
               $('#request-modal').modal('hide');
               swal("Oops!", "Anda telah melakukan pengajuan untuk jenis tiket pada cuti ini.", "error");
            } else if(data == 3) {
               $('#request-modal').modal('hide');
               swal("Oops!", "Mohon pilih jenis tiket Anda.", "error");
            } else if(data == "penegasan") {
               $('#request-modal').modal('hide');
               swal("Oops!", "Cuti anda belum ada penegasannya. Mohon tunggu hingga surat penegasan terbit.", "error");
            } else {
               $('#request-modal').modal('hide');
               swal("Oops!", "Pengajuan tiket gagal, reload halaman ini dan coba lagi", "error");
            }
         });   
      }
   }
</script>
