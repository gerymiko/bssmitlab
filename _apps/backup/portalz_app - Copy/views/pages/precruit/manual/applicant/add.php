<section class="content">
   <div class="box box-primary">
      <div class="box-header">
         <h3 class="box-title">Tambah Pelamar</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-danger btn-sm" id="btn_back_applicant1">
               <span data-toggle="tooltip" title="Daftar pelamar">Kembali</span>
            </button>
         </div>
      </div>
      <form role="form" id="form_add_applicant" method="post" action="#">
         <div class="box-body">
            <div id="content-personal" class="box box-custom">
               <div class="box-body">
                  <h5 class="ls3">1. Personal</h5>
                  <div class="row">
                     <div class="col-md-3">
                        <div class="form-group">
                           <label class="control-label">Cek Nomor KTP</label>
                           <input class="form-control _CnUmB required" name="noktp" id="noktp" maxlength="17" placeholder="Ketik disini">
                           <label id="ktp-status" class="hidden error"></label>
                        </div>
                        <div class="form-group">
                           <label class="control-label">Jenis Kelamin</label>
                           <select class="form-control required" name="people_gender" id="people_gender">
                              <option value="">Pilih</option>
                              <option value="L">Laki - laki</option>
                              <option value="P">Perempuan</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label class="control-label">Nama Lengkap</label>
                           <input class="form-control _CalPhaNum required" name="people_fullname" id="people_fullname" maxlength="35" placeholder="Ketik disini">
                        </div>
                        <div class="form-group">
                           <label class="control-label">Nomor HP</label>
                           <input class="form-control _CnUmB required" name="people_mobile" id="people_mobile" maxlength="13" placeholder="Ketik disini">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label class="control-label">Tempat Lahir</label>
                           <input class="form-control _CalPhaNum required" name="people_birth_place" id="people_birth_place" maxlength="35" placeholder="Ketik disini">
                        </div>
                        <div class="form-group">
                           <label class="control-label">Jabatan dilamar</label>
                           <select class="form-control select2 required" id="jabatan" name="jabatan">
                              <option></option>
                              <?php
                                 foreach ($listjabatan as $row){
                                    echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.' ['.$row->departemen.']</option>';
                                 }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label class="control-label">Tanggal Lahir</label>
                           <div class="input-group date">
                              <div class="input-group-addon">
                                 <i class="far fa-calendar-alt"></i>
                              </div>
                              <input class="form-control data-mask required pull-right" name="people_birth_date" id="people_birth_date" maxlength="10" placeholder="dd-mm-yyyy"/>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label">Tanggal Melamar</label>
                           <div class="input-group date">
                              <div class="input-group-addon">
                                 <i class="far fa-calendar-alt"></i>
                              </div>
                              <input class="form-control data-mask required pull-right" name="tgl_melamar" id="tgl_melamar" maxlength="10" placeholder="dd-mm-yyyy"/>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="content-address" class="box box-custom">
               <div class="box-body">
                  <h5 class="ls3">2. Alamat</h5>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label">Alamat</label>
                           <input class="form-control _CalPhaNum required" name="people_address" id="people_address" maxlength="150" placeholder="Ketik disini">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="control-label">Kota</label>
                           <input class="form-control _CalPhaNum required" name="people_address_city" id="people_address_city" maxlength="150" placeholder="Ketik disini">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label class="control-label">Kode Pos</label>
                           <input class="form-control _CnUmB required" name="people_address_zip" id="people_address_zip" maxlength="7" placeholder="Ketik disini">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="content-education" class="box box-custom">
               <div class="box-body">
                  <h5 class="ls3">3. Pendidikan</h5>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="control-label">Jenjang</label>
                           <select name="grade" id="grade" class="form-control select2 required">
                           <option></option>
                              <?php
                                 foreach ($grade as $row) {
                                    echo '<option value="'.$row->edutype_id.'">'.$row->edutype_name.'</option>';
                                 }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label">Nama Sekolah / Univ. / P.T.</label>
                           <input class="form-control _CalPhaNum required" name="people_education_name" id="people_education_name" maxlength="150" placeholder="Ketik disini">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="content-lisence" class="box box-custom">
               <div class="box-body">
                  <h5 class="ls3">4. Surat Izin Mengemudi (SIM)</h5>
                  <label class="control-label">Pilih Jenis SIM yang dimiliki</label>
                  <div class="row">
                     <div class="col-md-2">
                        <div class="form-group">
                           <div class="checkbox">
                              <label><input type="checkbox" class="checkcus" name="sim_A" id="sim_A" value="1">SIM A</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <div class="checkbox">
                              <label><input type="checkbox" class="checkcus" name="sim_B1" id="sim_B1" value="2">SIM B1</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <div class="checkbox">
                              <label><input type="checkbox" class="checkcus" name="sim_B2" id="sim_B2" value="3">SIM B2</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <div class="checkbox">
                              <label><input type="checkbox" class="checkcus" name="sim_B1U" id="sim_B1U" value="4">SIM B1 UMUM</label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <div class="checkbox">
                              <label><input type="checkbox" class="checkcus" name="sim_B2U" id="sim_B2U" value="5">SIM B2 UMUM</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="content-sim-a" style="display: none;">
                     <div class="row">
                        <div class="col-md-2">
                           <label class="control-label">&nbsp;</label>
                           <p class="text-right">
                              <span class="label label-info">SIM A</span>
                           </p>
                        </div>
                        <div class="col-md-5">
                           <div class="form-group">
                              <label class="control-label">Nomor SIM</label>
                              <input class="form-control _CnUmB required" name="no_sim_A" id="no_sim_A" placeholder="Ketik disini" maxlength="17" />
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label class="control-label">Berlaku S/d</label>
                              <div class="input-group date">
                                 <div class="input-group-addon">
                                    <i class="far fa-calendar-alt"></i>
                                 </div>
                                 <input class="form-control data-mask required pull-right" name="period_sim_A" id="period_sim_A" maxlength="10" placeholder="dd-mm-yyyy"/>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="content-sim-b1" style="display: none;">
                     <div class="row">
                        <div class="col-md-2">
                           <label class="control-label">&nbsp;</label>
                           <p class="text-right">
                              <span class="label label-info">SIM B1</span>
                           </p>
                        </div>
                        <div class="col-md-5">
                           <div class="form-group">
                              <label class="control-label">Nomor SIM</label>
                              <input class="form-control _CnUmB required" name="no_sim_B1" id="no_sim_B1" placeholder="Ketik disini" maxlength="17" />
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label class="control-label">Berlaku S/d</label>
                              <div class="input-group date">
                                 <div class="input-group-addon">
                                    <i class="far fa-calendar-alt"></i>
                                 </div>
                                 <input class="form-control data-mask required pull-right" name="period_sim_B1" id="period_sim_B1" maxlength="10" placeholder="dd-mm-yyyy"/>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="content-sim-b2" style="display: none;">
                     <div class="row">
                        <div class="col-md-2">
                           <label class="control-label">&nbsp;</label>
                           <p class="text-right">
                              <span class="label label-info">SIM B2</span>
                           </p>
                        </div>
                        <div class="col-md-5">
                           <div class="form-group">
                              <label class="control-label">Nomor SIM</label>
                              <input class="form-control _CnUmB required" name="no_sim_B2" id="no_sim_B2" placeholder="Ketik disini" maxlength="17" />
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label class="control-label">Berlaku S/d</label>
                              <div class="input-group date">
                                 <div class="input-group-addon">
                                    <i class="far fa-calendar-alt"></i>
                                 </div>
                                 <input class="form-control data-mask required pull-right" name="period_sim_B2" id="period_sim_B2" maxlength="10" placeholder="dd-mm-yyyy"/>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="content-sim-b1u" style="display: none;">
                     <div class="row">
                        <div class="col-md-2">
                           <label class="control-label">&nbsp;</label>
                           <p class="text-right">
                              <span class="label label-info">SIM B1 UMUM</span>
                           </p>
                        </div>
                        <div class="col-md-5">
                           <div class="form-group">
                              <label class="control-label">Nomor SIM</label>
                              <input class="form-control _CnUmB required" name="no_sim_B1U" id="no_sim_B1U" placeholder="Ketik disini" maxlength="17" />
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label class="control-label">Berlaku S/d</label>
                              <div class="input-group date">
                                 <div class="input-group-addon">
                                    <i class="far fa-calendar-alt"></i>
                                 </div>
                                 <input class="form-control data-mask required pull-right" name="period_sim_B1U" id="period_sim_B1U" maxlength="10" placeholder="dd-mm-yyyy"/>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="content-sim-b2u" style="display: none;">
                     <div class="row">
                        <div class="col-md-2">
                           <label class="control-label">&nbsp;</label>
                           <p class="text-right">
                              <span class="label label-info">SIM B2 UMUM</span>
                           </p>
                        </div>
                        <div class="col-md-5">
                           <div class="form-group">
                              <label class="control-label">Nomor SIM</label>
                              <input class="form-control _CnUmB required" name="no_sim_B2U" id="no_sim_B2U" placeholder="Ketik disini" maxlength="17" />
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label class="control-label">Berlaku S/d</label>
                              <div class="input-group date">
                                 <div class="input-group-addon">
                                    <i class="far fa-calendar-alt"></i>
                                 </div>
                                 <input class="form-control data-mask required pull-right" name="period_sim_B2U" id="period_sim_B2U" maxlength="10" placeholder="dd-mm-yyyy"/>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="content-experience" class="box box-custom">
               <div class="box-body">
                  <h5 class="ls3">5. Pengalaman Kerja</h5>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="control-label">Nama Perusahaan</label>
                           <input class="form-control _CalPhaNum" name="people_exp_company[]" id="people_exp_company" maxlength="150" placeholder="Ketik disini">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label class="control-label">Jabatan</label>
                           <input class="form-control _CalPhaNum" name="people_exp_position[]" id="people_exp_position" maxlength="150" placeholder="Ketik disini">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label class="control-label">Dari</label>
                           <input class="form-control data-mask" name="people_exp_period1[]" id="people_exp_period1" maxlength="10" placeholder="dd-mm-yyyy">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label class="control-label">Sampai</label>
                           <input class="form-control data-mask" name="people_exp_period2[]" id="people_exp_period2" maxlength="10" placeholder="dd-mm-yyyy">
                        </div>
                     </div>
                     <div class="col-md-1">
                        <button type="button" id="btn_add_exp_more" class="btn bg-purple btn-xs pull-right martop30">+ Tambah</button>
                     </div>
                  </div>
                  <div id="content-exp-more"></div>
               </div>
            </div>
            <div id="content-skill" class="box box-custom">
               <div class="box-body">
                  <h5 class="ls3">6. Kemampuan / Keahlian</h5>
                  <div class="row">
                     <div class="col-md-5">
                        <div class="form-group">
                           <label class="control-label">Kemampuan</label>
                           <input class="form-control _CalPhaNum" name="people_skill[]" id="people_skill" maxlength="150" placeholder="Ketik disini">
                        </div>
                     </div>
                     <div class="col-md-5">
                        <div class="form-group">
                           <label class="control-label">Bidang / Unit / Alat</label>
                           <input class="form-control _CalPhaNum" name="people_skill_unit[]" id="people_skill_unit" maxlength="150" placeholder="Ketik disini">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <button type="button" id="btn_add_skill_more" class="btn bg-purple btn-xs pull-left martop30">+ Tambah</button>
                     </div>
                  </div>
                  <div id="content-skill-more"></div>
               </div>
            </div>
         </div>
         <div class="box-footer">
            <button type="button" class="btn btn-primary" id="btn_sv_applicant">Simpan</button>
            <button type="button" class="btn btn-default" id="btn_back_applicant2">Batal</button>
         </div>
      </form>
   </div>
</section>
<script type="text/javascript">
   $(document).ready(function(){
      var content = $("#content-exp-more"), x = 0;
      var contentSkill = $("#content-skill-more"), y = 0;
      $('#btn_add_exp_more').click(function(e){ 
         e.preventDefault();
         if(x < 5){ 
            x++; 
            $(content).append('<div class="row"><div class="col-md-4"><div class="form-group"><label class="control-label">Nama Perusahaan</label><input class="form-control _CalPhaNum required" name="people_exp_company[]" maxlength="150" placeholder="Ketik disini"></div></div><div class="col-md-3"><div class="form-group"><label class="control-label">Jabatan</label><input class="form-control _CalPhaNum required" name="people_exp_position[]" maxlength="150" placeholder="Ketik disini"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label">Dari</label><input class="form-control data-mask required" name="people_exp_period1[]" maxlength="10" placeholder="dd-mm-yyyy"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label">Sampai</label><input class="form-control data-mask required" name="people_exp_period2[]" maxlength="10" placeholder="dd-mm-yyyy"></div></div><div class="col-md-1 text-left"><button id="btn_remove_exp_more" class="btn btn-danger btn-xs martop30"><i class="fa fa-times"></i></button></div></div>');
            $('.data-mask').inputmask('dd-mm-yyyy');
            $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,' });
         } else {
            swal("", "Batas pengalaman hanya 6 kolom.", "");
         }
      });
      $(content).on("click", "#btn_remove_exp_more", function(e){ e.preventDefault(); $(this).parent().parent().remove(); x--; });
      $('#btn_add_skill_more').click(function(e){ 
         e.preventDefault();
         if(y < 5){ 
            y++; 
            $(contentSkill).append('<div class="row"><div class="col-md-5"><div class="form-group"><label class="control-label">Kemampuan</label><input class="form-control _CalPhaNum required" name="people_skill[]" id="people_skill" maxlength="150" placeholder="Ketik disini"></div></div><div class="col-md-5"><div class="form-group"><label class="control-label">Bidang / Unit / Alat</label><input class="form-control _CalPhaNum required" name="people_skill_unit[]" id="people_skill_unit" maxlength="150" placeholder="Ketik disini"></div></div><div class="col-md-2 text-left"><button id="btn_remove_skill_more" class="btn btn-danger btn-xs martop30"><i class="fa fa-times"></i></button></div></div>');
            $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,' });
         } else {
            swal("", "Batas kemampuan hanya 6 kolom.", "");
         }
      });
      $(contentSkill).on("click", "#btn_remove_skill_more", function(e){ e.preventDefault(); $(this).parent().parent().remove(); y--; });

      $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,' });
      $('._CnUmB').numeric({allowThouSep: true, allowDecSep: false, allowPlus: false, allowMinus: false });
      $('.data-mask').inputmask('dd-mm-yyyy');
      $('#noktp').blur(checkktp);
      $("#btn_sv_applicant").click(function (){
         $("#loading").removeClass("hidden");
         var formdata = $("#form_add_applicant").serialize();
         if($("#form_add_applicant").valid() == false){
            toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
            $("html, body").animate({ scrollTop: 0 }, 600);
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.post("<?=base_url();?>recman/applicant/add/applicant",
            formdata,
            function(data) {
               if(data == "Success"){
                  $("#loading").addClass("hidden");
                  swal({
                     title: "",
                     html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',
                     type: "",
                     confirmButtonText: 'Okay',
                  }).then(function(){
                     $('#form_add_applicant')[0].reset();
                     $("input[type=checkbox]").prop("checked", "")
                     $('.select2').val(null).trigger('change');
                     $("#main-content, #header-content").removeClass("hidden");
                     $("#extra-content").addClass("hidden");
                     $('#table_applicant').DataTable().ajax.reload();
                     localStorage.clear();
                  });
               } else if(data == "Duplicate") {
                  $("#loading").addClass("hidden");
                  swal({
                     title: "",
                     html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Duplikat data pelamar. Pelamar sudah terdaftar.',
                     type: "",
                     confirmButtonText: 'Okay',
                  });
               } else {
                  $("#loading").addClass("hidden");
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
   $(function() {
      if(localStorage.sim_A == null) localStorage.sim_A = "false";
      $('#sim_A')
         .prop('checked', localStorage.sim_A == "true")
         .on('change', function(){
         localStorage.sim_A = this.checked;
         if(localStorage.sim_A == "true"){
            $('#content-sim-a').show();
         } else {
            $('#content-sim-a').hide();
            localStorage.sim_A == "false";
         }
      }).trigger('change');
      if(localStorage.sim_B1 == null) localStorage.sim_B1 = "false";
      $('#sim_B1')
         .prop('checked', localStorage.sim_B1 == "true")
         .on('change', function(){
         localStorage.sim_B1 = this.checked;
         if(localStorage.sim_B1 == "true"){
            $('#content-sim-b1').show();
         } else {
            $('#content-sim-b1').hide();
            localStorage.sim_B1 == "false";
         }
      }).trigger('change');
      if(localStorage.sim_B2 == null) localStorage.sim_B2 = "false";
      $('#sim_B2')
         .prop('checked', localStorage.sim_B2 == "true")
         .on('change', function(){
         localStorage.sim_B2 = this.checked;
         if(localStorage.sim_B2 == "true"){
            $('#content-sim-b2').show();
         } else {
            $('#content-sim-b2').hide();
            localStorage.sim_B2 == "false";
         }
      }).trigger('change');
      if(localStorage.sim_B1U == null) localStorage.sim_B1U = "false";
      $('#sim_B1U')
         .prop('checked', localStorage.sim_B1U == "true")
         .on('change', function(){
         localStorage.sim_B1U = this.checked;
         if(localStorage.sim_B1U == "true"){
            $('#content-sim-b1u').show();
         } else {
            $('#content-sim-b1u').hide();
            localStorage.sim_B1U == "false";
         }
      }).trigger('change');
      if(localStorage.sim_B2U == null) localStorage.sim_B2U = "false";
      $('#sim_B2U')
         .prop('checked', localStorage.sim_B2U == "true")
         .on('change', function(){
         localStorage.sim_B2U = this.checked;
         if(localStorage.sim_B2U == "true"){
            $('#content-sim-b2u').show();
         } else {
            $('#content-sim-b2u').hide();
            localStorage.sim_B2U == "false";
         }
      }).trigger('change');
   });
   function checkktp(){
      var noktp = $('#noktp').val(); 
      if( noktp == "" || noktp.length < 15){
         $("#ktp-status").removeClass('hidden');
         $("#ktp-status").html('Masukkan minimal 16 karakter.').css('color', 'red');  
      } else {
         $.ajax({
            type: "POST",
            url: "<?=base_url();?>recman/check/identity_number",
            cache: false,    
            data: 'noktp=' + $("#noktp").val(),
            success: function(response){ 
               try {
                  if(response == "true"){
                     toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
                     $("html, body").animate({ scrollTop: 0 }, 600);
                     $("#ktp-status").removeClass('hidden');
                     $("#ktp-status").html('KTP pelamar sudah terdaftar, tidak bisa duplikasi data.').css('color', 'red');
                  } else {
                     $("#ktp-status").addClass('hidden');
                  }          
               } catch(e) {
                  swal({
                     title: "",
                     html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Terjadi kesalahan.. Reload halaman ini dan pastikan koneksi internet Anda stabil.',
                     type: "",
                     confirmButtonText: 'Okay',
                  });
               }  
            }
         });
      }
   }
   $("#btn_back_applicant1, #btn_back_applicant2").click(function(){
      Pace.restart();
      $("#main-content, #header-content").removeClass("hidden");
      $("#extra-content").addClass("hidden");
   });
</script>