<section class="content-header">
   <h4>Master TOD <b class="text-blue"><?=$this->session->userdata('site')?></b></h4>
</section>
<section class="content">
   <div class="nav-tabs-custom">
      <ul class="nav nav-tabs" id="myTab">
         <li class="active"><a href="#tab_1" data-toggle="tab">Prod. HDR</a></li>
         <li><a href="#tab_2" data-toggle="tab">Prod. Param. SUB</a></li>
         <li><a href="#tab_3" data-toggle="tab">Prod. Kamus SUB</a></li>
         <li><a href="#tab_4" data-toggle="tab">Prod. Nilai</a></li>
         <li><a href="#tab_5" data-toggle="tab">Prod. Nilai DTL</a></li>
         <li><a href="#tab_6" data-toggle="tab">TOD Foreman</a></li>
         <li><a href="#tab_7" data-toggle="tab">Jadwal TOD Foreman</a></li>
         <li><a href="#tab_8" data-toggle="tab">Corrective Action</a></li>
      </ul>
      <div class="tab-content">
         <div class="tab-pane active" id="tab_1">
            <div class="box-header">
               <h3 class="box-title"></h3>
               <div class="box-tools pull-right">
                  <?php
                     if ($accessRights->id_level == 1) {
                        echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-"><i class="fas fa-plus"></i></button>';
                     } else {
                        echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
                     }
                  ?>
               </div>
            </div>
            <div class="box-body">
               <table id="table_tod_prod_param_hdr" class="table table-border table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="text-center">Parameter</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
         <div class="tab-pane" id="tab_2">
            <div class="box-header">
               <h3 class="box-title"></h3>
               <div class="box-tools pull-right">
                  <?php
                     if ($accessRights->id_level == 1) {
                        echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-param-sub"><i class="fas fa-plus"></i></button>';
                     } else {
                        echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
                     }
                  ?>
               </div>
            </div>
            <div class="box-body">
               <table id="table_tod_prod_param_sub" class="table table-border table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="text-center">Parameter</th>
                        <th class="text-center">Parameter Sub.</th>
                        <th>Nilai</th>
                        <th>Standard</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
            </div>
            <div class="modal" id="modal-add-param-sub">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header no-border">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Tambah Data Parameter Sub</h4>
                     </div>
                     <form id="form-add-param-sub" action="#" method="post">
                        <div class="modal-body">
                           <div class="form-group">
                              <label class="control-label">Parameter HDR</label>
                              <select name="id_parameter_hdr" class="form-control select2 required">
                                 <option></option>
                                 <?php
                                    foreach ($list_param_hdr as $row) {
                                       echo '<option value="'.$row->id.'">'.$row->nama.'</option>';
                                    }
                                 ?>
                              </select>
                           </div>
                           <div class="form-group">
                              <label class="control-label">Parameter Sub</label>
                              <input type="text" name="parameter_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Nilai</label>
                              <input type="text" name="nilai_param_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Standard</label>
                              <input type="text" name="standard_sub" class="form-control _CalPhaNum required">
                           </div>
                        </div>
                        <div class="modal-footer no-border">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
                           <button type="button" id="btn_add_param_sub" class="btn btn-primary">Simpan</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="modal" id="modal-edit-param-sub">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header no-border">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Ubah Produksi Prameter Sub</h4>
                     </div>
                     <form id="form-edit-param-sub" action="#" method="post">
                        <input type="hidden" name="id_param_sub" id="id_param_sub">
                        <div class="modal-body">
                           <div class="form-group">
                              <label class="control-label">Parameter HDR</label>
                              <input type="text" name="parameter_hdr" id="parameter_hdr" readonly class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Parameter Sub</label>
                              <input type="text" name="parameter_sub" id="parameter_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Nilai</label>
                              <input type="text" name="nilai_param_sub" id="nilai_param_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Standard</label>
                              <input type="text" name="standard_sub" id="standard_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Status</label>
                              <select class="form-control required" name="status_sub" id="status_sub">
                                 <option value="1">Aktif</option>
                                 <option value="0">Tidak Aktif</option>
                              </select>
                           </div>
                        </div>
                        <div class="modal-footer no-border">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
                           <button type="button" id="btn_edit_param_sub" class="btn btn-primary">Simpan</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane" id="tab_3">
            <div class="box-header">
               <h3 class="box-title"></h3>
               <div class="box-tools pull-right">
                  <?php
                     if ($accessRights->id_level == 1) {
                        echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-param-sub-dictionary"><i class="fas fa-plus"></i></button>';
                     } else {
                        echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
                     }
                  ?>
               </div>
            </div>
            <div class="box-body">
               <table id="table_tod_prod_param_sub_dictionary" class="table table-border table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Nama HDR</th>
                        <th class="text-center">TOD Foreman</th>
                        <th>Nama</th>
                        <th>UOM</th>
                        <th class="text-center">Keterangan</th>
                        <th>Status Jenis</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
            </div>
            <div class="modal" id="modal-add-param-sub-dictionary">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header no-border">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Tambah Data Parameter Sub Dictionary</h4>
                     </div>
                     <form id="form-add-param-sub-dictionary" action="#" method="post">
                        <div class="modal-body">
                           <div class="form-group">
                              <label class="control-label">TOD Foreman</label>
                              <select name="id_mst_tod_foreman" class="form-control select2 required">
                                 <option></option>
                                 <?php
                                    foreach ($list_tod_foreman as $row) {
                                       echo '<option value="'.$row->id.'">'.$row->isi.'</option>';
                                    }
                                 ?>
                              </select>
                           </div>
                           <div class="form-group">
                              <label class="control-label">Parameter Sub Dictionary</label>
                              <input type="text" name="parameter_sub_dictionary" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">UOM (Satuan ukur)</label>
                              <input type="text" name="uom" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Keterangan</label>
                              <input type="text" name="keterangan_sub_dictionary" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Status Jenis</label>
                              <select class="form-control" name="status_jenis_dictionary">
                                 <option value="0">Pilih</option>
                                 <option value="1">1</option>
                                 <option value="0">0</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label class="control-label">Jenis</label>
                              <input type="text" name="jenis_dictionary" class="form-control _CalPhaNum">
                           </div>
                        </div>
                        <div class="modal-footer no-border">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
                           <button type="button" id="btn_add_param_sub_dictionary" class="btn btn-primary">Simpan</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="modal" id="modal-edit-param-sub-dictionary">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header no-border">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Ubah Produksi Prameter Sub Dictionary</h4>
                     </div>
                     <form id="form-edit-param-sub-dictionary" action="#" method="post">
                        <input type="hidden" name="id_param_sub_dictionary" id="id_param_sub_dictionary">
                        <div class="modal-body">
                           <div class="form-group">
                              <label class="control-label">TOD Foreman</label>
                              <textarea type="text" name="tod_foreman" id="tod_foreman" readonly class="form-control _CalPhaNum required"></textarea>
                           </div>
                           <div class="form-group">
                              <label class="control-label">Parameter Sub Dictionary</label>
                              <input type="text" name="parameter_sub_dictionary" id="parameter_sub_dictionary" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">UOM (Satuan ukur)</label>
                              <input type="text" name="uom" id="uom" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Keterangan</label>
                              <input type="text" name="keterangan_sub_dictionary" id="keterangan_sub_dictionary" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Status Jenis</label>
                              <select class="form-control" name="status_jenis_dictionary" id="status_jenis_dictionary">
                                 <option value="1">1</option>
                                 <option value="0">0</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label class="control-label">Jenis</label>
                              <input type="text" name="jenis_dictionary" id="jenis_dictionary" class="form-control _CalPhaNum">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Status</label>
                              <select class="form-control required" name="status_sub_dictionary" id="status_sub_dictionary">
                                 <option value="1">Aktif</option>
                                 <option value="0">Tidak Aktif</option>
                              </select>
                           </div>
                        </div>
                        <div class="modal-footer no-border">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
                           <button type="button" id="btn_edit_param_sub_dictionary" class="btn btn-primary">Simpan</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane" id="tab_4">
            <div class="box-header">
               <h3 class="box-title"></h3>
               <div class="box-tools pull-right">
                  <?php
                     if ($accessRights->id_level == 1) {
                        echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-param-score"><i class="fas fa-plus"></i></button>';
                     } else {
                        echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
                     }
                  ?>
               </div>
            </div>
            <div class="box-body">
               <table id="table_tod_prod_param_score" class="table table-border table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="text-center">Isi</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th class="text-center">Keterangan</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
            </div>
            <div class="modal" id="modal-add-param-score">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header no-border">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Tambah Data Parameter Nilai</h4>
                     </div>
                     <form id="form-add-param-score" action="#" method="post">
                        <div class="modal-body">
                           <div class="form-group">
                              <label class="control-label">Parameter HDR</label>
                              <select name="id_parameter_hdr" class="form-control select2 required">
                                 <option></option>
                                 <?php
                                    foreach ($list_param_hdr as $row) {
                                       echo '<option value="'.$row->id.'">'.$row->nama.'</option>';
                                    }
                                 ?>
                              </select>
                           </div>
                           <div class="form-group">
                              <label class="control-label">Parameter Sub</label>
                              <input type="text" name="parameter_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Nilai</label>
                              <input type="text" name="nilai_param_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Standard</label>
                              <input type="text" name="standard_sub" class="form-control _CalPhaNum required">
                           </div>
                        </div>
                        <div class="modal-footer no-border">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
                           <button type="button" id="btn_add_param_score" class="btn btn-primary">Simpan</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="modal" id="modal-edit-param-score">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header no-border">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Ubah Produksi Prameter Nilai</h4>
                     </div>
                     <form id="form-edit-param-score" action="#" method="post">
                        <input type="hidden" name="id_param_score" id="id_param_score">
                        <div class="modal-body">
                           <div class="form-group">
                              <label class="control-label">Parameter HDR</label>
                              <input type="text" name="parameter_hdr" id="parameter_hdr" readonly class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Parameter Sub</label>
                              <input type="text" name="parameter_sub" id="parameter_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Nilai</label>
                              <input type="text" name="nilai_param_sub" id="nilai_param_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Standard</label>
                              <input type="text" name="standard_sub" id="standard_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Status</label>
                              <select class="form-control required" name="status_sub" id="status_sub">
                                 <option value="1">Aktif</option>
                                 <option value="0">Tidak Aktif</option>
                              </select>
                           </div>
                        </div>
                        <div class="modal-footer no-border">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
                           <button type="button" id="btn_edit_param_score" class="btn btn-primary">Simpan</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane" id="tab_5">
            <div class="box-header">
               <h3 class="box-title"></h3>
               <div class="box-tools pull-right">
                  <?php
                     if ($accessRights->id_level == 1) {
                        echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-score-dtl"><i class="fas fa-plus"></i></button>';
                     } else {
                        echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
                     }
                  ?>
               </div>
            </div>
            <div class="box-body">
               <table id="table_tod_prod_param_score_dtl" class="table table-border table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="text-center">Isi</th>
                        <th>Parameter Nilai</th>
                        <th>Model Unit</th>
                        <th>Batas Atas</th>
                        <th>Batas Bawah</th>
                        <th>Opsi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
            </div>
            <div class="modal" id="modal-add-param-score-dtl">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header no-border">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Tambah Data Parameter Nilai DTL</h4>
                     </div>
                     <form id="form-add-param-score" action="#" method="post">
                        <div class="modal-body">
                           <div class="form-group">
                              <label class="control-label">Parameter HDR</label>
                              <select name="id_parameter_hdr" class="form-control select2 required">
                                 <option></option>
                                 <?php
                                    foreach ($list_param_hdr as $row) {
                                       echo '<option value="'.$row->id.'">'.$row->nama.'</option>';
                                    }
                                 ?>
                              </select>
                           </div>
                           <div class="form-group">
                              <label class="control-label">Parameter Sub</label>
                              <input type="text" name="parameter_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Nilai</label>
                              <input type="text" name="nilai_param_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Standard</label>
                              <input type="text" name="standard_sub" class="form-control _CalPhaNum required">
                           </div>
                        </div>
                        <div class="modal-footer no-border">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
                           <button type="button" id="btn_add_param_score" class="btn btn-primary">Simpan</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="modal" id="modal-edit-param-score-dtl">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header no-border">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Ubah Produksi Prameter Nilai</h4>
                     </div>
                     <form id="form-edit-param-score" action="#" method="post">
                        <input type="hidden" name="id_param_score" id="id_param_score">
                        <div class="modal-body">
                           <div class="form-group">
                              <label class="control-label">Parameter HDR</label>
                              <input type="text" name="parameter_hdr" id="parameter_hdr" readonly class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Parameter Sub</label>
                              <input type="text" name="parameter_sub" id="parameter_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Nilai</label>
                              <input type="text" name="nilai_param_sub" id="nilai_param_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Standard</label>
                              <input type="text" name="standard_sub" id="standard_sub" class="form-control _CalPhaNum required">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Status</label>
                              <select class="form-control required" name="status_sub" id="status_sub">
                                 <option value="1">Aktif</option>
                                 <option value="0">Tidak Aktif</option>
                              </select>
                           </div>
                        </div>
                        <div class="modal-footer no-border">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
                           <button type="button" id="btn_edit_param_score" class="btn btn-primary">Simpan</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane" id="tab_6">
            <div class="box-header">
               <h3 class="box-title"></h3>
               <div class="box-tools pull-right">
                  <?php
                     if ($accessRights->id_level == 1) {
                        echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-"><i class="fas fa-plus"></i></button>';
                     } else {
                        echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
                     }
                  ?>
               </div>
            </div>
            <div class="box-body">
               <table id="table_tod_foreman" class="table table-border table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th class="text-center">Isi</th>
                        <th>Jml Scanning</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
         <div class="tab-pane" id="tab_7">
            <div class="box-header">
               <h3 class="box-title"></h3>
               <div class="box-tools pull-right">
                  <?php
                     if ($accessRights->id_level == 1) {
                        echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-"><i class="fas fa-plus"></i></button>';
                     } else {
                        echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
                     }
                  ?>
               </div>
            </div>
            <div class="box-body">
               <table id="table_tod_foreman_schedule" class="table table-border table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="text-center">Isi</th>
                        <th>Urut</th>
                        <th>Jam Mulai DS</th>
                        <th>Jam Selesai DS</th>
                        <th>Jam Mulai NS</th>
                        <th>Jam Selesai NS</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
         <div class="tab-pane" id="tab_8">
            <div class="box-header">
               <h3 class="box-title"></h3>
               <div class="box-tools pull-right">
                  <?php
                     if ($accessRights->id_level == 1) {
                        echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-"><i class="fas fa-plus"></i></button>';
                     } else {
                        echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
                     }
                  ?>
               </div>
            </div>
            <div class="box-body">
               <table id="table_corrective_action" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>HDR</th>
                        <th>TOD</th>
                        <th>Aksi</th>
                        <th>Jenis</th>
                        <th>Nilai</th>
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
<style type="text/css">
   tr.group, tr.group { background-image: linear-gradient(to left, #FAFAFB 0%, #E3E3E3 100%); font-weight: 600;font-size: 12px;text-transform: uppercase;word-wrap: break-word; }
</style>
<script type="text/javascript">
   $(document).ready(function (){
    	var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
    	$('#master-treeview, #link_master_prod_tod').addClass('active');
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
   	$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
   	$('.select2').select2({ placeholder: 'Pilih', allowClear: true });
      if (location.hash) {
         $("a[href='" + location.hash + "']").tab("show");
      }
      $(document.body).on("click", "a[data-toggle='tab']", function(event) {
         location.hash = this.getAttribute("href");
      });
      $(window).on("popstate", function() {
         var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
         $("a[href='" + anchor + "']").tab("show");
      });
   	var table1 = $('#table_tod_prod_param_hdr').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "order": [],
         "ajax": {
            "url": '<?=site_url()?>tod/t_produksi_param_hdr/<?=$accessRights->site?>',
            "type": 'POST',
            // error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table1.ajax.reload();});}
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "nama", "className": "text-left", "orderable": false },
            { "data": "status", "className": "text-center", "orderable": false },
            { "data": "action", "className": "text-center", "orderable": false },
         ]
      });

      setTimeout(function(){
         var groupColumn1 = 1;
         var table2 = $('#table_tod_prod_param_sub').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
               "url": '<?=site_url()?>tod/t_produksi_param_sub/<?=$accessRights->site?>',
               "type": 'POST',
               error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table2.ajax.reload();});}
            },
            "language": { "processing": bar },
            "columns": [
               { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
               { "data": "nama_hdr", "className": "text-left", "orderable": false, 'visible': false },
               { "data": "nama_sub", "className": "text-left", "orderable": false },
               { "data": "score", "className": "text-center", "orderable": false },
               { "data": "standard", "className": "text-center", "orderable": false },
               { "data": "status_sub", "className": "text-center", "orderable": false },
               { "data": "action", "className": "text-center", "orderable": false },
            ],
            "drawCallback": function ( settings ) {
               var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
               api.column(groupColumn1, { page:'current' } ).data().each( function ( group, i ){
                  if ( last !== group ) {
                     $(rows).eq( i ).before( '<tr class="group"><td colspan="6" class="text-center">'+group+'</td></tr>' );
                     last = group;
                  }
               });
            }
         });
         $('#modal-edit-param-sub').on('show.bs.modal', function (event) {
            if (event.namespace == 'bs.modal') {
               var button = $(event.relatedTarget)
               var id_param_sub = button.data('id_param_sub')
               var parameter_hdr = button.data('parameter_hdr')
               var parameter_sub   = button.data('parameter_sub')
               var nilai_param_sub   = button.data('nilai_param_sub')
               var standard_sub   = button.data('standard_sub')
               var status_sub = button.data('status_sub')
               var modal  = $(this)
               modal.find('#id_param_sub').val(id_param_sub)
               modal.find('#parameter_hdr').val(parameter_hdr)
               modal.find('#parameter_sub').val(parameter_sub)
               modal.find('#nilai_param_sub').val(nilai_param_sub)
               modal.find('#standard_sub').val(standard_sub)
               modal.find('#status_sub').val(status_sub).trigger('change')
            }
         });
         $("#btn_add_param_sub").click(function () {
            $("#loading").removeClass("hidden");
            var formdata = $("#form-add-param-sub").serialize();
            if($("#form-add-param-sub").valid() == false){
               $("#loading").addClass("hidden");
               return false;
            } else {
               $.post("<?=site_url('sadd/prod_param_sub/').$accessRights->site?>",
               formdata,
               function(data) {
                  if(data == "Success"){
                     table2.ajax.reload();
                     $("#loading").addClass("hidden");
                     $('#modal-add-param-sub').modal('hide');
                     swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
                  } else if(data == "unauthority"){
                     $('#modal-add-param-sub').modal('toggle');
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
                  } else {
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
                  }
               });   
            }
         });
         $("#btn_edit_param_sub").click(function () {
            $("#loading").removeClass("hidden");
            var formdata = $("#form-edit-param-sub").serialize();
            if($("#form-edit-param-sub").valid() == false){
               $("#loading").addClass("hidden");
               return false;
            } else {
               $.post("<?=site_url('sedd/prod_param_sub/').$accessRights->site?>",
               formdata,
               function(data) {
                  if(data == "Success"){
                     table2.ajax.reload();
                     $("#loading").addClass("hidden");
                     $('#modal-edit-param-sub').modal('hide');
                     swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
                  } else if(data == "unauthority"){
                     $('#modal-edit-param-sub').modal('toggle');
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
                  } else {
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
                  }
               });  
            }
         });
      }, 1000);

      setTimeout(function(){
         var groupColumnDict = 1;
         var table3 = $('#table_tod_prod_param_sub_dictionary').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
               "url": '<?=site_url()?>tod/t_produksi_param_sub_dictionary/<?=$accessRights->site?>',
               "type": 'POST',
               error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table3.ajax.reload();});}
            },
            "language": { "processing": bar },
            "columns": [
               { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
               { "data": "nama_hdr", "className": "text-center", "orderable": false, 'visible': false },
               { "data": "isi", "className": "text-left text-wrap", "orderable": false },
               { "data": "nama", "className": "text-left", "orderable": false },
               { "data": "uom", "className": "text-center", "orderable": false },
               { "data": "keterangan", "className": "text-left", "orderable": false },
               { "data": "status_jenis", "className": "text-center", "orderable": false },
               { "data": "jenis", "className": "text-center", "orderable": false },
               { "data": "status", "className": "text-center", "orderable": false },
               { "data": "action", "className": "text-center", "orderable": false },
            ],
            "drawCallback": function ( settings ) {
               var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
               api.column(groupColumnDict, { page:'current' } ).data().each( function ( group, i ){
                  if ( last !== group ) {
                     $(rows).eq( i ).before( '<tr class="group"><td colspan="9" class="text-center">'+group+'</td></tr>' );
                     last = group;
                  }
               });
            }
         });
         $('#modal-edit-param-sub-dictionary').on('show.bs.modal', function (event) {
            if (event.namespace == 'bs.modal') {
               var button = $(event.relatedTarget)
               var id_param_sub_dictionary = button.data('id_param_sub_dictionary')
               var tod_foreman   = button.data('tod_foreman')
               var parameter_sub_dictionary   = button.data('parameter_sub_dictionary')
               var uom   = button.data('uom')
               var keterangan_sub_dictionary   = button.data('keterangan_sub_dictionary')
               var status_jenis_dictionary = button.data('status_jenis_dictionary')
               var jenis_dictionary = button.data('jenis_dictionary')
               var status_sub_dictionary = button.data('status_sub_dictionary')
               var modal  = $(this)
               modal.find('#id_param_sub_dictionary').val(id_param_sub_dictionary)
               modal.find('#tod_foreman').val(tod_foreman)
               modal.find('#parameter_sub_dictionary').val(parameter_sub_dictionary)
               modal.find('#uom').val(uom)
               modal.find('#keterangan_sub_dictionary').val(keterangan_sub_dictionary)
               modal.find('#status_jenis_dictionary').val(status_jenis_dictionary).trigger('change')
               modal.find('#jenis_dictionary').val(jenis_dictionary)
               modal.find('#status_sub_dictionary').val(status_sub_dictionary).trigger('change')
            }
         });
         $("#btn_add_param_sub_dictionary").click(function () {
            $("#loading").removeClass("hidden");
            var formdata = $("#form-add-param-sub-dictionary").serialize();
            if($("#form-add-param-sub-dictionary").valid() == false){
               $("#loading").addClass("hidden");
               return false;
            } else {
               $.post("<?=site_url('sadd/prod_param_sub_dictionary/').$accessRights->site?>",
               formdata,
               function(data) {
                  if(data == "Success"){
                     table3.ajax.reload();
                     $("#loading").addClass("hidden");
                     $('#modal-add-param-sub-dictionary').modal('hide');
                     swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
                  } else if(data == "unauthority"){
                     $('#modal-add-param-sub-dictionary').modal('toggle');
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
                  } else {
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
                  }
               });   
            }
         });
         $("#btn_edit_param_sub_dictionary").click(function () {
            $("#loading").removeClass("hidden");
            var formdata = $("#form-edit-param-sub-dictionary").serialize();
            if($("#form-edit-param-sub-dictionary").valid() == false){
               $("#loading").addClass("hidden");
               return false;
            } else {
               $.post("<?=site_url('sedd/prod_param_sub_dictionary/').$accessRights->site?>",
               formdata,
               function(data) {
                  if(data == "Success"){
                     table3.ajax.reload();
                     $("#loading").addClass("hidden");
                     $('#modal-edit-param-sub-dictionary').modal('hide');
                     swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
                  } else if(data == "unauthority"){
                     $('#modal-edit-param-sub-dictionary').modal('toggle');
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
                  } else {
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
                  }
               });  
            }
         });
      }, 1100);

      setTimeout(function(){
         var groupColumn2 = 1;
         var table4 = $('#table_tod_prod_param_score').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
               "url": '<?=site_url()?>tod/t_produksi_param_score/<?=$accessRights->site?>',
               "type": 'POST',
               error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table3.ajax.reload();});}
            },
            "language": { "processing": bar },
            "columns": [
               { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
               { "data": "isi", "className": "text-left", "orderable": false, "visible": false },
               { "data": "nama", "className": "text-left", "orderable": false },
               { "data": "nilai", "className": "text-center", "orderable": false },
               { "data": "keterangan", "className": "text-left", "orderable": false },
               { "data": "status", "className": "text-center", "orderable": false },
               { "data": "action", "className": "text-center", "orderable": false },
            ],
            "drawCallback": function ( settings ) {
               var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
               api.column(groupColumn2, { page:'current' } ).data().each( function ( group, i ){
                  if ( last !== group ) {
                     $(rows).eq( i ).before( '<tr class="group"><td colspan="6" class="text-center">'+group+'</td></tr>' );
                     last = group;
                  }
               });
            }
         });
      }, 1200);

      setTimeout(function(){
         var groupColumn3 = 1;
         var table5 = $('#table_tod_prod_param_score_dtl').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
               "url": '<?=site_url()?>tod/t_produksi_param_score_dtl/<?=$accessRights->site?>',
               "type": 'POST',
               error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table5.ajax.reload();});}
            },
            "language": { "processing": bar },
            "columns": [
               { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
               { "data": "isi", "className": "text-left", "orderable": false, "visible": false },
               { "data": "nama_score", "className": "text-center", "orderable": false },
               { "data": "model_unit", "className": "text-center", "orderable": false },
               { "data": "batas_atas", "className": "text-center", "orderable": false },
               { "data": "batas_bawah", "className": "text-center", "orderable": false },
               { "data": "opsi", "className": "text-center", "orderable": false },
               { "data": "keterangan", "className": "text-center", "orderable": false },
               { "data": "status", "className": "text-center", "orderable": false },
               { "data": "action", "className": "text-center", "orderable": false },
            ],
            "drawCallback": function ( settings ) {
               var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
               api.column(groupColumn3, { page:'current' } ).data().each( function ( group, i ){
                  if ( last !== group ) {
                     $(rows).eq( i ).before( '<tr class="group"><td colspan="9" class="text-center">'+group+'</td></tr>' );
                     last = group;
                  }
               });
            }
         });
      }, 1300);

      setTimeout(function(){
         var groupColumn4 = 1;
         var table6 = $('#table_tod_foreman').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
               "url": '<?=site_url('tod/t_tod_foreman/').$accessRights->site?>',
               "type": 'POST',
               error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table6.ajax.reload();});}
            },
            "language": { "processing": bar },
            "columns": [
               { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
               { "data": "nama", "className": "text-center", "orderable": false, "visible": false },
               { "data": "isi", "className": "text-left", "orderable": false },
               { "data": "scanning", "className": "text-center", "orderable": false },
               { "data": "status", "className": "text-center", "orderable": false },
               { "data": "action", "className": "text-center", "orderable": false },
            ],
            "drawCallback": function ( settings ) {
               var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
               api.column(groupColumn4, { page:'current' } ).data().each( function ( group, i ){
                  if ( last !== group ) {
                     $(rows).eq( i ).before( '<tr class="group"><td colspan="6" class="text-center">'+group+'</td></tr>' );
                     last = group;
                  }
               });
            }
         });
      }, 1400);

      setTimeout(function(){
         var groupColumn4 = 1;
         var table7 = $('#table_tod_foreman_schedule').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
               "url": '<?=site_url('tod/t_tod_foreman_schedule/').$accessRights->site?>',
               "type": 'POST',
               error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table7.ajax.reload();});}
            },
            "language": { "processing": bar },
            "columns": [
               { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
               { "data": "isi", "className": "text-center", "orderable": false, "visible": false },
               { "data": "urut", "className": "text-center", "orderable": false },
               { "data": "jam_mulai_ds", "className": "text-center", "orderable": false },
               { "data": "jam_selesai_ds", "className": "text-center", "orderable": false },
               { "data": "jam_mulai_ns", "className": "text-center", "orderable": false },
               { "data": "jam_selesai_ns", "className": "text-center", "orderable": false },
               { "data": "status", "className": "text-center", "orderable": false },
               { "data": "action", "className": "text-center", "orderable": false },
            ],
            "drawCallback": function ( settings ) {
               var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
               api.column(groupColumn4, { page:'current' } ).data().each( function ( group, i ){
                  if ( last !== group ) {
                     $(rows).eq( i ).before( '<tr class="group"><td colspan="8" class="text-center">'+group+'</td></tr>' );
                     last = group;
                  }
               });
            }
         });
      }, 1500);

      setTimeout(function(){
         var groupColumn5 = 1;
         var table8 = $('#table_corrective_action').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "order": [],
            "ajax": {
               "url": '<?=site_url('tod/t_corrective_action/').$accessRights->site?>',
               "type": 'POST',
               error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table8.ajax.reload();});}
            },
            "language": { "processing": bar },
            "columns": [
               { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
               { "data": "nama_hdr", "className": "text-center", "orderable": false, "visible": false },
               { "data": "tod", "className": "text-left text-wrap", "orderable": false },
               { "data": "actions", "className": "text-left", "orderable": false },
               { "data": "jenis", "className": "text-center", "orderable": false },
               { "data": "nama_score", "className": "text-center", "orderable": false },
               { "data": "status", "className": "text-center", "orderable": false },
               { "data": "action", "className": "text-center", "orderable": false },
            ],
            "drawCallback": function ( settings ) {
               var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
               api.column(groupColumn5, { page:'current' } ).data().each( function ( group, i ){
                  if ( last !== group ) {
                     $(rows).eq( i ).before( '<tr class="group"><td colspan="7" class="text-center">'+group+'</td></tr>' );
                     last = group;
                  }
               });
            }
         });
      }, 1600);
   });
</script>