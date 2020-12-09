<section class="content">
   <div class="box box-primary">
      <div class="box-header with-border">
         <h3 class="box-title">Tambah Lowongan</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-danger btn-sm" id="btn_show_list_vacancy">
               <span data-toggle="tooltip" title="Kembali ke daftar loker">Kembali</span>
            </button>
         </div>
      </div>
      <form role="form" id="form_edit_vacancy" method="post" action="#">
         <div class="box-body">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Jabatan</label>
                     <select name="jabatan_alias" id="jabatan_alias" class="form-control select2 required" maxlength="50">
                        <option></option>
                        <?php
                           foreach ($listjabatan as $row){
                              echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.' ['.$row->departemen.']</option>';
                           }
                        ?>
                     </select>
                  </div>
                  <span id="availability-loker" class="text-red" style="display: none;"><small>Lowongan pernah dibuat sebelumnya, gunakan fitur UPDATE untuk memposting ulang lowongan ini.</small></span>
                  <div class="load-bar loadloker" style="display: none;"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>
                  <div class="form-group">
                     <input type="hidden" class="form-control _CalPhaNum" name="KodeJB" id="KodeJB">
                  </div>
                  <div class="form-group">
                     <input type="hidden" class="form-control _CalPhaNum" name="KodeDP" id="KodeDP">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="row">
                     <div class="col-md-8">
                        <div class="form-group">
                           <label class="control-label">Kode Lowongan</label>
                           <input class="form-control _CalPhaNum required" name="kode_lowongan" id="kode_lowongan" placeholder="Contoh : BSS-IT-PRGMMR" maxlength="25">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="control-label">Jumlah Rekrut</label>
                           <input type="text" name="jml_rekrut" class="form-control _CnUmB required" placeholder="Contoh : 10" maxlength="2">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label class="control-label">Durasi Lowongan</label>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label">Tanggal Buka</label>
                           <input type="text" name="tgl_open" class="form-control datepicker required" placeholder="Contoh : <?=date('d-m-Y')?>">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label">Tanggal Buka</label>
                           <input type="text" name="tgl_close" class="form-control datepicker required" placeholder="Contoh : <?=date('d-m-Y', strtotime('+1 month'))?>">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <label class="control-label" data-tooltip="*Kosongkan jika tidak ingin memberi informasi gaji">Gaji ditawarkan <i class="fas fa-info-circle"></i></label>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label">Terendah</label>
                           <input type="text" name="min_salary" id="rupiah1" class="form-control" maxlength="10" placeholder="Contoh : 1.000.000">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label">Tertinggi</label>
                           <input type="text" name="max_salary" id="rupiah2" class="form-control" maxlength="10" placeholder="Contoh : 8.000.000">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel panel-default no-radius">
               <div class="panel-body">
                  <h4><span class="label label-info">KUALIFIKASI</span></h4>
                  <div class="row">
                     <div class="col-md-5">
                        <div class="form-group">
                           <label class="control-label">Jenis Kelamin</label>
                           <select class="form-control required" name="jenis_kelamin" id="jenis_kelamin" maxlength="3">
                              <option value="">Pilih</option>
                              <option value="L">Laki - laki</option>
                              <option value="P">Perempuan</option>
                              <option value="L;P">Keduanya</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label class="control-label">Lulusan Minimal</label>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="checkbox">
                                    <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="2">SMP</label>
                                 </div>
                                 <div class="checkbox">
                                    <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="3">SMA</label>
                                 </div>
                                 <div class="checkbox">
                                    <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="4">SMK</label>
                                 </div>
                                 <div class="checkbox">
                                    <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="5">D1</label>
                                 </div>
                                 <div class="checkbox">
                                    <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="6">D2</label>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="checkbox">
                                    <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="7">D3</label>
                                 </div>
                                 <div class="checkbox">
                                    <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="8">S1</label>
                                 </div>
                                 <div class="checkbox">
                                    <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="9">S2</label>
                                 </div>
                                 <div class="checkbox">
                                    <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="10">S3</label>
                                 </div>
                                 <div class="checkbox">
                                    <label><input type="checkbox" class="checkcus" name="edutype_id[]" value="11">Lainnya</label>
                                 </div>   
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-7">
                        <div class="form-group">
                           <label class="control-label">Jurusan</label>
                           <input type="text" name="edu_jurusan" class="form-control _CalPhaNum required" placeholder="Contoh : IPA, Teknik Mesin, Otomotif, Administrasi, Management, dll" maxlength="200">
                        </div>
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label class="control-label">Pengalaman (Tahun)</label>
                                 <input type="text" name="experience" class="form-control _CnUmB" maxlength="2" placeholder="Contoh : 2">
                              </div>
                           </div>
                           <div class="col-md-7">
                              <div class="form-group">
                                 <label class="control-label">Bidang Pengalaman</label>
                                 <input type="text" name="experience_subject" class="form-control _CalPhaNum" placeholder="Contoh : Pertambangan, Migas, dll" maxlength="100">
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <label class="control-label">Usia</label>
                           <div class="row">
                              <div class="col-md-6">
                                 <label class="control-label">Minimal (Tahun)</label>
                                 <input type="text" name="min_usia" maxlength="2" class="form-control _CnUmB required" placeholder="18">
                              </div>
                              <div class="col-md-6">
                                 <label class="control-label">Maksimal (Tahun)</label>
                                 <input type="text" name="max_usia" maxlength="2" class="form-control _CnUmB required" placeholder="40">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel panel-default no-radius">
               <div class="panel-body">
                  <h4><span class="label label-info">KEMAMPUAN DIBUTUHKAN</span></h4>
                  <div class="row">
                     <div class="col-md-6">
                        <label class="control-label">Skill sesuai jabatan</label>
                        <div id="skill"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="control-label">Skill Umum</label>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="114">Dapat membaca gambar tehnik</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="113">Pengetahuan kebersihan kerja</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="112">Pengetahuan keselamatan kerja</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="111">Dapat membaca satuan ukuran</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="">Pengetahuan alat kerja</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="110">Pengetahuan alat ukur</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="108">Mampu mengoperasikan Komputer</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="5">Miscrosoft Power Point</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="4">Miscrosoft Visio</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="3">Miscrosoft Excel</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="2">Miscrosoft Words</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="skill_id[]" value="1">Miscrosoft Office</label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel panel-default no-radius">
               <div class="panel-body">
                  <h4><span class="label label-info">SERTIFIKAT DIBUTUHKAN</span></h4>
                  <div class="row">
                     <div class="col-md-6">
                        <label class="control-label">Sertifikat Sesuai Jabatan</label>
                        <div id="sertifikat"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="control-label">Sertifikat Umum</label>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="certificate_id[]" value="1">AK3 Umum / POP</label>
                        </div>
                        <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="certificate_id[]" value="2">Diklat SMKP</label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel panel-default no-radius">
               <div class="panel-body">
                  <h4><span class="label label-info">SYARAT LOWONGAN</span></h4>
                  <div class="row">
                     <div class="col-md-6">
                        <label class="control-label">Syarat Umum</label>
                        <?php
                        foreach ($msyarat as $row) {
                           echo '
                           <div class="checkbox">
                           <label><input type="checkbox" class="checkcus" name="syarat_id[]" value="'.$row->syarat_id.'">'.$row->syarat_name.'</label>
                           </div>
                           ';
                        }
                        ?>
                     </div>
                     <div class="col-md-6">
                        <label class="control-label">Syarat Sesuai Jabatan</label>
                        <div id="syarat"></div>
                     </div>
                  </div>
               </div>
            </div>
            <label class="control-label">Deskripsi Pekerjaan</label>
            <textarea id="job_desc" name="job_desc" class="form-control wysihtml5 required">
               &lt;p&gt;Contoh Deskripsi Pekerjaan :&nbsp;&lt;/p&gt;
               &lt;p&gt;1. Analisa Kebutuhan, Desain Kebutuhan, Pengajuan Development.&lt;br&gt;
               2. Desain Data Flow Diagram, desain Entity Relational Diagram, desain Work Flow, Desain Wireframe, Desain Reporting.&lt;br&gt;
               3. Melakukan pengujian aplikasi sebelum di implementasikan.&lt;br&gt;
               4. Training dan sosialisasi Aplikasi, melakukan monitoring,review dan evaluasi hasil implementasi.&lt;br&gt;
               5. Analisa pengembangan.&lt;br&gt;
               * Hapus contoh diatas sebelum mengisi deskripsi pekerjaan&lt;/p&gt;
            </textarea>
            <span><i>* Penting mohon isi deskripsi pekerjaan yang terkait dengan lowongan tersebut.</i></span>
         </div>
         <div class="box-footer">
            <button type="button" id="btn_edit_vacancy" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-default" id="back_show_list_vacancy">Batal</button>
         </div>
      </form>
   </div>
</section>

<script type="text/javascript">
   $(document).ready(function(){
      $('.wysihtml5').wysihtml5();
      $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,' });
      $('._CnUmB').numeric({allowThouSep: true, allowDecSep: true, allowPlus: false, allowMinus: false });
      $(".select2").select2({ placeholder: "Pilih", allowClear: true });

      $('#jabatan_alias').change(function(){
         var $idjb = $('#KodeJB'), $iddp = $('#KodeDP');
         $idjb.val($(this).val());
           $iddp.val($(this).val().slice(0, -3));
           $(".loadloker").show();
           $.ajax({
            type : "POST",
            url  : "<?=site_url()?>crecruit/web/vacancy/sysvacancy/check_vacancy",
            cache: false,    
              data:'jabatan_alias=' + $("#jabatan_alias").val(),
              success: function(response){
                  try {
                      if(response == "false"){
                        $(".loadloker").hide();
                        $("#btn_add_vacancy").addClass('hidden');
                          $("#availability-loker").show();
                      } else {
                        $(".loadloker").hide();
                        $("#availability-loker").hide();
                        $("#btn_add_vacancy").removeClass('hidden');
                      }         
                  } catch(e) { 
                     swal({
                       title: "",
                       html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Terjadi kesalahan. Reload halaman ini.',
                       type: "",
                       confirmButtonText: 'Okay',
                   });
                  }  
              },
          });
       });
       $('#form-add-vacancy').validate({
          rules: { 
            'edutype_id[]': { required: true } ,
            'skill_id[]': { required: true } ,
            'syarat_id[]': { required: true } 
          },
          messages: {
            'edutype_id[]': { required: "Minimal pilih salah satu opsional", },
            'skill_id[]': { required: "Minimal pilih salah satu opsional", },
            'syarat_id[]': { required: "Minimal pilih salah satu opsional", }
         }         
      });
       $('#jabatan_alias, #jabatan_edit').change(function(){
         var opt = 'skill=' + $(this).val();
         $.ajax({
            type: "POST",
            url: "<?=site_url()?>crecruit/web/vacancy/sysvacancy/getSkill",
            data: opt,
            success: function(data){
               $("#skill").html(data);
            }
         });
      });
      $('#jabatan_alias, #jabatan_edit').change(function(){
         var opt = 'sertifikat=' + $(this).val();
         $.ajax({
            type: "POST",
            url: "<?=site_url()?>crecruit/web/vacancy/sysvacancy/getSertifikat",
            data: opt,
            success: function(data){
               $("#sertifikat").html(data);
            }
         });
      });
      $('#jabatan_alias, #jabatan_edit').change(function(){
         var opt = 'syarat=' + $(this).val();
         $.ajax({
            type: "POST",
            url: "<?=site_url()?>crecruit/web/vacancy/sysvacancy/getSyarat",
            data: opt,
            success: function(data){
               $("#syarat").html(data);
            }
         });
      });
      var rupiah = document.getElementById("rupiah1");
      rupiah.addEventListener("keyup", function(e){
         rupiah.value = formatRupiah(this.value, "");
      });
      var rupiah2 = document.getElementById("rupiah2");
      rupiah2.addEventListener("keyup", function(e){
         rupiah2.value = formatRupiah(this.value, "");
      });

      $("#btn_show_list_vacancy, #back_show_list_vacancy").click(function(){
         $("#main-content, #header-content").removeClass("hidden");
         $("#extra-content").addClass("hidden");
      });

      $("#btn_add_vacancy").click(function(){
         $("#loading").removeClass("hidden");
         var formdata = $("#form-add-vacancy").serialize(),table = $('#table_vacancy').DataTable();
         if($("#form-add-vacancy").valid() == false){
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.post("<?=base_url();?>crecruit/web/vacancy/sysvacancy/save_add_vacancy",
            formdata,
            function(data) {
               if(data == "Success"){
                  $("#loading").addClass("hidden");
                  $('#modal-add-vacancy').modal('hide');
                  swal({
                       title: "",
                       html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',
                       type: "",
                       confirmButtonText: 'Okay',
                   }).then(function(){ table.ajax.reload(); });
               } else if (data == 'duplicate') {
                  $("#loading").addClass("hidden");
                  $('#modal-add-vacancy').modal('hide');
                  swal({
                       title: "",
                       html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Duplikat data, cek apakah data sudah terdaftar atau belum.',
                       type: "",
                       confirmButtonText: 'Okay',
                   });
               } else {
                  $("#loading").addClass("hidden");
                  $('#modal-add-vacancy').modal('hide');
                  swal({
                       title: "",
                       html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.',
                       type: "",
                       confirmButtonText: 'Okay',
                   });
               }
            });   
         }
      });
   });

   function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, "").toString(),
      split  = number_string.split(","),
      sisa   = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);
      if (ribuan) {
         separator = sisa ? "." : "";
         rupiah += separator + ribuan.join(".");
      }
      rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
      return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
   }
</script>