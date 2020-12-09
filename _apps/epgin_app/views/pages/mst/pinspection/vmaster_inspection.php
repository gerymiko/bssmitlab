<section class="content-header">
   <h4>Master Inspeksi <b class="text-blue"><?=$this->session->userdata('site')?></b></h4>
</section>
<section class="content">
   <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
         <li class="active"><a href="#tab_1" data-toggle="tab">Inspeksi HDR</a></li>
         <li><a href="#tab_2" data-toggle="tab">Inspeksi DTL</a></li>
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
               <table id="table_inspeksi_hdr" class="table table-border table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="text-center">Kode</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
         <div class="tab-pane" id="tab_2">
            <div class="desktop" id="content-filter">
               <div class="box-body">
                  <form id="form-filter" action="#" class="form-horizontal">              
                     <div class="col-md-4">
                        <div class="form-group" style="margin-bottom: 0px;">
                           <select class="form-control select2" id="nama_ins">
                              <option></option>
                              <?php
                                 foreach ($list_inspection as $row) {
                                    echo '<option value="'.$row->id.'">'.$row->inspection_name.'</option>';
                                 }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group" style="margin-bottom: 0px;">
                           <input type="text" class="form-control _CalPhaNum" id="kode_ins" placeholder="Kode Inspeksi">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group" style="margin-bottom: 0px;">
                           <input type="text" class="form-control _CalPhaNum" id="kode_itm" placeholder="Kode Item">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group" style="margin-bottom: 0px;">
                           <select class="form-control" id="tipe_ins">
                              <option value="">Pilih Tipe</option>
                              <option value="main">Main</option>
                              <option value="additional">Additional</option>
                           </select>
                         </div>
                     </div>
                     <div class="col-md-1 text-center desktop">
                        <div class="form-group" style="margin-bottom: 0px;">
                           <button type="button" id="btn-filter" class="btn btn-flat btn-danger"><i class="fas fa-filter"></i></button>
                           <button type="button" id="btn-reset" class="btn btn-flat btn-default"><i class="fas fa-sync"></i></button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="box-header">
               <h3 class="box-title"></h3>
               <div class="box-tools pull-right">
                  <?php
                     if ($accessRights->id_level == 1) {
                        echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-module"><i class="fas fa-plus"></i></button>';
                     } else {
                        echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
                     }
                  ?>
               </div>
            </div>
            <div class="box-body">
               <table id="table_inspeksi_dtl" class="table table-border table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="text-center">Kode Ins</th>
                        <th>Kode Item</th>
                        <th>Inspeksi</th>
                        <th>Inspeksi Item</th>
                        <th>Tipe</th>
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
   tr.group, tr.group { background-image: linear-gradient(to left, #FAFAFB 0%, #E3E3E3 100%); font-weight: 600;font-size: 15px;text-transform: uppercase; } .form-group .select2-container{ margin-bottom:0px !important; }
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
    	$('#master-treeview, #link_master_inspeksi').addClass('active');
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
   	$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
   	$('.select2').select2({ placeholder: 'Nama Inspeksi', allowClear: true });
      var table1 = $('#table_inspeksi_hdr').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": false,
         "scrollX": true,
         "order": [],
         "ajax": {
            "url": '<?=site_url()?>inspection/t_inspection_hdr/<?=$accessRights->site?>',
            "type": 'POST',
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table1.ajax.reload();});}
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "code", "className": "text-center", "orderable": false },
            { "data": "name", "className": "text-left"},
            { "data": "type", "className": "text-center", "orderable": false },
            { "data": "status", "className": "text-center", "orderable": false },
            { "data": "action", "className": "text-center", "orderable": false  },
         ]
      });
      var groupColumn = 3;
   	var table2 = $('#table_inspeksi_dtl').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": false,
         "scrollX": true,
         "order": [],
         "ajax": {
            "url": '<?=site_url()?>inspection/t_inspection_dtl/<?=$accessRights->site?>',
            "type": 'POST',
            data : function(data) {data.nama_ins = $("#nama_ins").val();data.tipe_ins = $("#tipe_ins").val();data.kode_ins = $("#kode_ins").val();data.kode_itm = $("#kode_itm").val();},
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table2.ajax.reload();});}
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "ins_code", "className": "text-center", "orderable": false },
            { "data": "itm_code", "className": "text-center", "orderable": false  },
            { "data": "inspection_name", "className": "text-center", "visible": false},
            { "data": "inspection_item", "className": "text-left text-wrap", "orderable": false  },
            { "data": "type", "className": "text-left", "orderable": false },
            { "data": "action", "className": "text-center", "orderable": false  },
         ],
         "drawCallback": function (settings) {
            var api = this.api(), rows = api.rows({page:'current'}).nodes(), last = null;
            api.column(groupColumn, {page:'current'}).data().each(function (group, i){
               if (last !== group) {
                  $(rows).eq(i).before('<tr class="group"><td colspan="6" class="text-center">'+group+'</td></tr>');
                  last = group;
               }
            });
         }
      });
      $('#btn-filter').click(function(){
         table2.ajax.reload();
      });
      $('#btn-reset').click(function(){
         $('.select2').val(null).trigger('change');
         $('#form-filter')[0].reset();
         table2.ajax.reload();
      });
   });
</script>