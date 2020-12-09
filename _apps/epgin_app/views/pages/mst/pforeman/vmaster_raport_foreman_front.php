<section class="content-header">
   <h4>Master Raport Foreman Front <b class="text-blue"><?=$this->session->userdata('site')?></b></h4>
</section>
<section class="content">
   <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
         <li class="active"><a href="#tab_1" data-toggle="tab">Foreman HDR</a></li>
         <li><a href="#tab_2" data-toggle="tab">Foreman DTL</a></li>
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
               <table id="table_raport_foreman_front_hdr" class="table table-border table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="text-center">Parameter</th>
                        <th class="text-center">Keterangan</th>
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
                        echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-"><i class="fas fa-plus"></i></button>';
                     } else {
                        echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
                     }
                  ?>
               </div>
            </div>
            <div class="box-body">
               <table id="table_raport_foreman_front_dtl" class="table table-border table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="text-center">Parameter</th>
                        <th>Batas Atas</th>
                        <th>Batas Bawah</th>
                        <th>Nilai Dinamis</th>
                        <th>Nilai Gradasi</th>
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
   tr.group, tr.group { background-image: linear-gradient(to left, #FAFAFB 0%, #E3E3E3 100%); font-weight: 600;font-size: 15px;text-transform: uppercase;letter-spacing: 1px; } .form-group .select2-container{ margin-bottom:0px !important; }
</style>
<script type="text/javascript">
    $(document).ready(function (){
      var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
      $('#master-treeview, #link_master_raport_foreman_front').addClass('active');
      $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
      $('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
      $('.select2').select2({ placeholder: 'Nama Parameter', allowClear: true });
      var table1 = $('#table_raport_foreman_front_hdr').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": false,
         "order": [],
         "ajax": {
            "url": '<?=site_url()?>foreman/t_raport_foreman_front_hdr/<?=$accessRights->site?>',
            "type": 'POST',
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table1.ajax.reload();});}
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "parameter", "className": "text-left", "orderable": false },
            { "data": "keterangan", "className": "text-left", "orderable": false  },
            { "data": "status", "className": "text-center", "orderable": false },
            { "data": "action", "className": "text-center", "orderable": false  },
         ]
      });
      var groupColumn = 1;
      var table2 = $('#table_raport_foreman_front_dtl').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": false,
         "order": [],
         "ajax": {
            "url": '<?=site_url()?>foreman/t_raport_foreman_front_dtl/<?=$accessRights->site?>',
            "type": 'POST',
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table2.ajax.reload();});}
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "parameter", "className": "text-left", "orderable": false, "visible": false },
            { "data": "batas_atas", "className": "text-center", "orderable": false  },
            { "data": "batas_bawah", "className": "text-center", "orderable": false },
            { "data": "dynamic", "className": "text-center", "orderable": false },
            { "data": "nilai", "className": "text-center", "orderable": false },
            { "data": "status", "className": "text-center", "orderable": false },
            { "data": "action", "className": "text-center", "orderable": false  },
         ],
         "drawCallback": function (settings) {
            var api = this.api(), rows = api.rows({page:'current'}).nodes(), last = null;
            api.column(groupColumn, {page:'current'}).data().each(function (group, i){
               if (last !== group) {
                  $(rows).eq(i).before('<tr class="group"><td colspan="8" class="text-center">'+group+'</td></tr>');
                  last = group;
               }
            });
         }
      });
   });
</script>