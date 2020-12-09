<section class="content">
   <div class="box box-primary">
      <div class="box-header with-border">
         <h3 class="box-title">Ubah Lowongan</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-danger btn-sm" id="btn_show_list_vacancy">
               <span data-toggle="tooltip" title="Kembali ke daftar loker">Kembali</span>
            </button>
         </div>
      </div>
      <form role="form" id="form_edit_vacancy" method="post" action="#">
         <input type="hidden" name="lowongan_id" id="lowongan_id" value="<?=$this->my_encryption->encode($dvacan->lowongan_id)?>">
         <div class="box-body">
            <div class="row">
               <div class="col-md-4">
                  <div class="form-group">
                     <label class="control-label">Jabatan</label>
                     <input class="form-control _CalPhaNum required" name="jabatan" id="jabatan" value="<?=$dvacan->jabatan_alias?>" readonly>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label class="control-label">Kode Lowongan</label>
                     <input class="form-control _CalPhaNum required" name="kode_lowongan" id="kode_lowongan" placeholder="Contoh : BSS-IT-PRGMMR" maxlength="25" value="<?=$dvacan->kode_lowongan?>">
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label class="control-label">Status Lowongan</label>
                     <select class="form-control required" name="loker_status" id="loker_status">
                        <option>Pilih</option>
                        <option value="1">Buka</option>
                        <option value="0">Tutup</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label class="control-label">Durasi Lowongan</label>
               </div>
               <div class="col-md-6">
                  <label class="control-label" data-tooltip="*Kosongkan jika tidak ingin memberi informasi gaji">Gaji yang Ditawarkan <i class="fas fa-info-circle"></i></label>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3">
                  <div class="form-group">
                     <label class="control-label">Tanggal Buka</label>
                     <input type="text" name="tgl_open" class="form-control datepicker required" placeholder="Contoh : <?=date('d-m-Y')?>" value="<?=date('d-m-Y', strtotime($dvacan->tgl_open))?>">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label class="control-label">Tanggal Buka</label>
                     <input type="text" name="tgl_close" class="form-control datepicker required" placeholder="Contoh : <?=date('d-m-Y', strtotime('+1 month'))?>" value="<?=date('d-m-Y', strtotime($dvacan->tgl_close))?>">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label class="control-label">Terendah</label>
                     <input type="text" name="min_salary" id="rupiah1" class="form-control" maxlength="10" placeholder="Contoh : 1.000.000" value="<?=$dvacan->min_salary?>">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label class="control-label">Tertinggi</label>
                     <input type="text" name="max_salary" id="rupiah2" class="form-control" maxlength="10" placeholder="Contoh : 8.000.000" value="<?=$dvacan->max_salary?>">
                  </div>
               </div>
            </div>
            <div class="panel panel-default no-radius">
               <div class="panel-body">
                  <h4><span class="label label-info">KUALIFIKASI</span></h4>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="control-label">Jenis Kelamin</label>
                           <select class="form-control required" name="jenis_kelamin" id="jenis_kelamin" maxlength="3">
                              <option value="">Pilih</option>
                              <option value="L">Laki - laki</option>
                              <option value="P">Perempuan</option>
                              <option value="L;P">Keduanya</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="control-label">Jurusan</label>
                           <input type="text" name="edu_jurusan" class="form-control _CalPhaNum required" placeholder="Contoh : IPA, Teknik Mesin, Otomotif, Administrasi, Management, dll" maxlength="200" value="<?=$dvacan->edu_jurusan?>" >
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="control-label">Jumlah Rekrut</label>
                           <input type="text" name="jml_rekrut" class="form-control _CalPhaNum required" placeholder="Contoh : 10" maxlength="3" value="<?=$dvacan->jml_rekrut?>" >
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="control-label">Lulusan Minimal</label>
                           <?php
                              foreach($meduc as $row) {
                                 echo '<div class="checkbox"><label>
                                       <input type="checkbox" ';
                                          foreach ($deduc as $key) {
                                            if ($key->edutype_id == $row->edutype_id){
                                                echo 'checked ';
                                                break;
                                            }
                                          }
                                 echo 'class="checkcus" name="edutype_id[]" value="'.$row->edutype_id.'">'.$row->edutype_name.'</label></div>';
                              }
                           ?>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="control-label">Pengalaman (Tahun)</label>
                           <input type="text" name="experience" class="form-control _CnUmB" maxlength="2" placeholder="Contoh : 2" value="<?=$dvacan->experience?>">
                        </div>
                        <div class="form-group">
                           <label class="control-label">Minimal (Tahun)</label>
                           <input type="text" name="min_usia" maxlength="2" class="form-control _CnUmB required" placeholder="18" value="<?=$dvacan->min_usia?>">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="control-label">Bidang Pengalaman</label>
                           <input type="text" name="experience_subject" class="form-control _CalPhaNum" placeholder="Contoh : Pertambangan, Migas, dll" maxlength="100" value="<?=$dvacan->experience_subject?>">
                        </div>
                        <div class="form-group">
                           <label class="control-label">Maksimal (Tahun)</label>
                           <input type="text" name="max_usia" maxlength="2" class="form-control _CnUmB required" placeholder="40" value="<?=$dvacan->max_usia?>">
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
                        <?php
                           $countskillreq = count($mskillreq);
                           if ($countskillreq !== 0) {
                              foreach($mskillreq as $row) {
                                 echo' <div class="checkbox"><label>
                                       <input type="checkbox" name="skill_id[]"';
                                 foreach ($dskill as $key) {
                                    if ($key->skill_id == $row->skill_id){
                                       echo 'checked ';
                                       break;
                                    }
                                 }
                                 echo 'class="checkcus" value="'.$row->skill_id.'">'.$row->skill_name.'</label></div>';
                              }
                           } else { echo 'Tidak ada skill khusus untuk jabatan ini.'; }    
                        ?>
                     </div>
                     <div class="col-md-6">
                        <label class="control-label">Skill Umum</label>
                        <?php
                           $countskillum = count($mskillumum);
                           if ($countskillum !== 0) {
                              foreach($mskillumum as $row) {
                                 echo' <div class="checkbox" style="padding-left: 0px;">
                                    <label>
                                       <input type="checkbox" name="skill_id[]"';
                                          foreach ($dskill as $key) {
                                             if ($key->skill_id == $row->skill_id){
                                                echo 'checked ';
                                                break;
                                             }
                                          }
                                 echo 'class="checkcus" value="'.$row->skill_id.'">'.$row->skill_name.'</label></div>';
                              }
                           } else { echo 'Tidak ada skill umum untuk jabatan ini.'; }
                        ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel panel-default no-radius">
               <div class="panel-body">
                  <h4><span class="label label-info">SERTIFIKAT DIBUTUHKAN</span></h4>
                  <div class="row">
                     <div class="col-md-6">
                        <label class="control-label">Sertifikat Sesuai Jabatan</label><br>
                        <?php
                           $countsertreq = count($msertreq);
                           if ($countsertreq !== 0) {
                              foreach($msertreq as $row) {
                                 echo' <div class="checkbox"><label>
                                    <input type="checkbox" name="certificate_id[]"';
                                 foreach ($dsert as $key) {
                                    if ($key->certificate_id == $row->certificate_id){
                                       echo 'checked ';
                                       break;
                                    }
                                 }
                                 echo 'class="checkcus" value="'.$row->certificate_id.'">'.$row->certificate_name.'</label>
                                 </div>';
                              }
                           } else { echo 'Tidak ada sertifikat khusus untuk jabatan ini.'; }  
                        ?>
                     </div>
                     <div class="col-md-6">
                        <label class="control-label">Sertifikat Umum</label>
                        <?php
                           $countsertum = count($msertumum);
                           if ($countsertum !== 0) {
                              foreach($msertumum as $row) {
                                 echo' <div class="checkbox"><label>
                                    <input type="checkbox" name="certificate_id[]"';
                                 foreach ($dsert as $key) {
                                    if ($key->certificate_id == $row->certificate_id){
                                       echo 'checked ';
                                       break;
                                    }
                                 }
                                 echo 'class="checkcus" value="'.$row->certificate_id.'">'.$row->certificate_name.'</label></div>';
                              }
                           } else { echo 'Tidak ada sertifikat umum untuk jabatan ini.'; }
                        ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel panel-default no-radius">
               <div class="panel-body">
                  <h4><span class="label label-info">SYARAT LOWONGAN</span></h4>
                  <div class="row">
                     <div class="col-md-6">
                        <label class="control-label">Syarat Umum</label><br>
                        <?php
                           $countsyarum = count($msyaratumum);
                           if ($countsyarum !== 0) {
                              foreach ($msyaratumum as $row) {
                                 echo '<div class="checkbox"><label>
                                          <input type="checkbox" name="syarat_id[]"';
                                 foreach ($dsyarat as $key) {
                                    if ($key->syarat_id == $row->syarat_id){
                                       echo 'checked ';
                                       break;
                                    }
                                 }
                                 echo 'class="checkcus" value="'.$row->syarat_id.'">'.$row->syarat_name.'</label></div>';
                              }
                           } else { echo 'Tidak ada syarat umum untuk jabatan ini.'; }
                        ?>
                     </div>
                     <div class="col-md-6">
                        <label class="control-label">Syarat Sesuai Jabatan</label><br>
                        <?php
                           $countsyareq = count($msyaratreq);
                           if ($countsyareq !== 0) {
                              foreach ($msyaratreq as $row) {
                                 echo '<div class="checkbox"><label>
                                          <input type="checkbox" name="syarat_id[]"';
                                 foreach ($dsyarat as $key) {
                                    if ($key->syarat_id == $row->syarat_id) {
                                       echo 'checked ';
                                       break;
                                    }
                                 }
                                 echo 'class="checkcus" value="'.$row->syarat_id.'">'.$row->syarat_name.'</label></div>';
                              }
                           } else { echo 'Tidak ada syarat khusus untuk jabatan ini.'; }
                        ?>
                     </div>
                  </div>
               </div>
            </div>
            <label class="control-label">Deskripsi Pekerjaan</label>
            <textarea id="job_desc" name="job_desc" class="form-control wysihtml5 required"><?=$dvacan->job_desc?></textarea>
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
      $('._CnUmB').numeric({allowThouSep: true, allowDecSep: false, allowPlus: false, allowMinus: false });
      $('#jenis_kelamin').val('<?=$dvacan->jenis_kelamin?>').trigger('change');
      $('#loker_status').val('<?=$dvacan->lowongan_status?>').trigger('change');

      $("#btn_show_list_vacancy, #back_show_list_vacancy").click(function(){
         $("#main-content, #header-content").removeClass("hidden");
         $("#extra-content").addClass("hidden");
      });
      $("#btn_edit_vacancy").click(function(){
         $("#loading").removeClass("hidden");
         var formdata = $("#form_edit_vacancy").serialize();
         if($("#form_edit_vacancy").valid() == false){
            toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.post("<?=base_url();?>crecruit/web/vacancy/sysvacancy/save_edit_vacancy",
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
                     $('#table_vacancy').DataTable().ajax.reload();
                     $("#main-content, #header-content").removeClass("hidden");
                     $("#extra-content").addClass("hidden");
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
</script>