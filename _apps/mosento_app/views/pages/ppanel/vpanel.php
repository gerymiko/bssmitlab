<section class="content-header">
   <h4>Dashboard <b class="text-red"><?=$accessRights->site?></b></h4>
</section>
<section class="content">
   <div class="alert alert-danger alert-dismissible hidden">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Attention!</h4>
      Sorry for the inconvenience, the website is currently under maintenance on DOZER unit. Maybe there will be a time when an error will appear or the website cannot be accessed for a while. Thank you for your attention. 
   </div>
   <div class="row">
      <div class="col-md-3">
         <div class="info-box">
            <span class="info-box-icon bg-white"><?=$count_unit;?></span>
            <div class="info-box-content bg-white">
               <span class="info-box-text"><b>Registered<br> Unit</b> ON <br>this site</span>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <a href="<?=site_url('report/critical/').$accessRights->site;?>" class="hand">
            <div class="info-box">
               <span class="info-box-icon bg-white"><?=$critical_today;?></span>
               <div class="info-box-content bg-white">
                  <span class="info-box-text">Today <b class="text-red">Critical</b><br> Report</span>
                  <span class="label label-primary" data-tooltip="See More">DETAILS</span>
               </div>
            </div>
         </a>
      </div>
      <div class="col-md-3">
         <a href="<?=site_url('report/caution/').$accessRights->site;?>" class="hand">
            <div class="info-box">
               <span class="info-box-icon bg-white"><?=$caution_today;?></span>
               <div class="info-box-content bg-white">
                  <span class="info-box-text">Today <b class="text-yellow">Caution</b><br> Report</span>
                  <span class="label label-primary" data-tooltip="See More">DETAILS</span>
               </div>
            </div>
         </a>
      </div>
      <div class="col-md-3">
         <a href="<?=site_url('report/fault/').$accessRights->site;?>" class="hand">
            <div class="info-box">
               <span class="info-box-icon bg-white"><?=$fault_today;?></span>
               <div class="info-box-content bg-white">
                  <span class="info-box-text">Today <b class="text-orange">Warning</b> &<br> <b class="text-orange">Fault</b> Report</span>
                  <span class="label label-primary" data-tooltip="See More">DETAILS</span>
               </div>
            </div>
         </a>
      </div>
   </div>
   <div class="box box-primary">
      <div class="box-header">
         <h3 class="box-title text-bold label label-primary">DOZER</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div>
      </div>
      <div class="box-body no-padding">
         <div class="content" style="min-height: 0px;">
            <form id="form-filter-dzr" action="#" class="form-horizontal">
               <div class="col-md-3">
                  <div class="form-group" style="margin-bottom: 5px">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                        <input type="text" class="form-control _CalPhaNum daterange" id="date_range_dzr" name="date_range_dzr" placeholder="Choose date">
                     </div>
                  </div>
                  <label for="date_range" generated="true" class="error hidden"></label>
               </div>
               <div class="col-md-3">
                  <div class="form-group" style="margin-bottom: 5px">
                     <input type="text" id="sn_dzr" name="sn_dzr" class="form-control _CalPhaNum" placeholder="Serial Number" maxlength="6">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group" style="margin-bottom: 5px">
                     <input type="text" id="hull_dzr" name="hull_dzr" class="form-control _CalPhaNum" placeholder="Hull Number" maxlength="6">
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group" style="margin-bottom: 5px">
                     <select class="form-control" name="unit_dzr" id="unit_dzr">
                        <option value="">Unit Number</option>
                        <?php
                           foreach ($list_unit as $row) {
                              if ($row->type_unit == "Dozer Truck") {
                                 echo '<option value="'.$row->unit.'">'.$row->unit.'</option>';
                              }
                           }
                        ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="form-group" style="margin-bottom: 5px;margin-left:-12px;">
                     <button type="button" id="btn-filter-dzr" class="btn btn-flat btn-danger" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
                     <button type="button" id="btn-reset-dzr" class="btn btn-flat btn-default" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
                  </div>
               </div>
            </form>   
         </div>               
         <table id="table_unit_dozer" class="table table-hover">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Unit</th>
                  <th>SN</th>
                  <th>Hull</th>
                  <th>Site</th>
                  <th class="text-center">Last Update</th>
                  <th></th>
               </tr>
            </thead>
         </table>
      </div>
   </div>

   <div class="box box-primary">
      <div class="box-header">
         <h3 class="box-title text-bold label label-primary">EXCAVATOR</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div>
      </div>
      <div class="box-header with-border">
         <form id="form-filter-exc" action="#" class="form-horizontal">
            <div class="col-md-3">
               <div class="form-group" style="margin-bottom: 5px">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                     <input type="text" class="form-control _CalPhaNum daterange" id="date_range_exc" name="date_range_exc" placeholder="Choose date">
                  </div>
               </div>
               <label for="date_range" generated="true" class="error hidden"></label>
            </div>
            <div class="col-md-3">
               <div class="form-group" style="margin-bottom: 5px">
                  <input type="text" id="sn_exc" name="sn_exc" class="form-control _CalPhaNum" placeholder="Serial Number" maxlength="6">
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group" style="margin-bottom: 5px">
                  <input type="text" id="hull_exc" name="sn_exc" class="form-control _CalPhaNum" placeholder="Hull Number" maxlength="6">
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group" style="margin-bottom: 5px">
                  <select class="form-control" name="unit_exc" id="unit_exc">
                     <option value="">Unit Number</option>
                     <?php
                        foreach ($list_unit as $row) {
                           if ($row->type_unit == "Excavator") {
                              echo '<option value="'.$row->unit.'">'.$row->unit.'</option>';
                           }
                        }
                     ?>
                  </select>
               </div>
            </div>
            <div class="col-md-1">
               <div class="form-group" style="margin-bottom: 5px;margin-left:-12px;">
                  <button type="button" id="btn-filter-exc" class="btn btn-flat btn-danger" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
                  <button type="button" id="btn-reset-exc" class="btn btn-flat btn-default" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
               </div>
            </div>
         </form>
      </div>
      <div class="box-body no-padding">
         <table id="table_unit_exca" class="table table-hover">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Unit</th>
                  <th>SN</th>
                  <th>Hull</th>
                  <th>Site</th>
                  <th class="text-center">Last Update</th>
                  <th></th>
               </tr>
            </thead>
         </table>
      </div>
   </div>

   <div class="box box-primary">
      <div class="box-header">
         <h3 class="box-title text-bold label label-primary">HEAVY DUMP TRUCK</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div>
      </div>
      <div class="box-header with-border">
         <form id="form-filter-hd" action="#" class="form-horizontal">
            <div class="col-md-3">
               <div class="form-group" style="margin-bottom: 5px">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                     <input type="text" class="form-control _CalPhaNum daterange" id="date_range_hd" name="date_range_hd" placeholder="Choose date">
                  </div>
               </div>
               <label for="date_range" generated="true" class="error hidden"></label>
            </div>
            <div class="col-md-3">
               <div class="form-group" style="margin-bottom: 5px">
                  <input type="text" id="sn_hd" name="sn_hd" class="form-control _CalPhaNum" placeholder="Serial Number" maxlength="6">
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group" style="margin-bottom: 5px">
                  <input type="text" id="hull_hd" name="hull_hd" class="form-control _CalPhaNum" placeholder="Hull Number" maxlength="6">
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group" style="margin-bottom: 5px">
                  <select class="form-control" name="unit_hd" id="unit_hd">
                     <option value="">Unit Number</option>
                     <?php
                        foreach ($list_unit as $row) {
                           if ($row->type_unit == "Heavy Dump Truck") {
                              echo '<option value="'.$row->unit.'">'.$row->unit.'</option>';
                           }
                        }
                     ?>
                  </select>
               </div>
            </div>
            <div class="col-md-1">
               <div class="form-group" style="margin-bottom: 5px;margin-left:-12px;">
                  <button type="button" id="btn-filter-hd" class="btn btn-flat btn-danger" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
                  <button type="button" id="btn-reset-hd" class="btn btn-flat btn-default" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
               </div>
            </div>
         </form>
      </div>
      <div class="box-body no-padding">
         <table id="table_unit_hd" class="table table-hover">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Unit</th>
                  <th>SN</th>
                  <th>Hull</th>
                  <th>Site</th>
                  <th class="text-center">Last Update</th>
                  <th></th>
                  <th></th>
               </tr>
            </thead>
         </table>
      </div>
   </div>
</section>
<style type="text/css">
   .dataTables_filter{ display:none; }
   #table_unit_dozer_paginate, #table_unit_exca_paginate, #table_unit_hd_paginate { display:none !important; padding-right: 10px !important; }
   tr.group, tr.group { background-image: linear-gradient(to left, #FAFAFB 0%, #FAFAFB 100%); font-weight: 600;font-size: 15px; }
</style>
<script type="text/javascript">
   $(document).ready(function (){
      <?php $pesan = $this->session->flashdata('pesan');
         if(isset($pesan)){ ?>
            swal({ type:'<?=$pesan['type'];?>',title:'<?=$pesan['title'];?>',html:'<?=$pesan['message'];?>',timer:3000}); 
      <?php } ?>
      var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
      $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '/- ' });
      $('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
      $('#link_dashboard').addClass('active');
      $('.daterange').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Clear' } });
      $('.daterange').on('apply.daterangepicker', function(ev, picker){
         $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
      });
      $('.daterange').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
      var groupColumnDozer = 1;
      var tableDozer = $('#table_unit_dozer').DataTable({
         "processing": true,
         "serverSide": true,
         "scrollY": "300px",
         "pageLength": 1000,
         "scrollCollapse": true,
         "info": false,
         "bLengthChange": false,
         "order": [[ groupColumnDozer, 'asc' ]],
         "ajax": {
            "url"  : '<?=site_url('dashboard/t_dozer/').$this->uri->segment(3)?>',
            "type" : 'POST',
            data : function ( data ) { data.date_range = $("#date_range_dzr").attr("value");data.sn = $("#sn_dzr").attr("value");data.unit = $("#unit_dzr").attr("value");data.hull = $("#hull_dzr").val(); },
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){tableDozer.ajax.reload();});}
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "unit", "className": "text-center", "visible": false },
            { "data": "serial", "className": "text-center", "orderable": false },
            { "data": "hull", "className": "text-center", "orderable": false },
            { "data": "site", "className": "text-center", "orderable": false },
            { "data": "lastupdate", "className": "text-center", "orderable": false },
            { "data": "warningfault", "className": "text-center", "orderable": false }
         ],
         "drawCallback": function ( settings ) {
            var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
            api.column(groupColumnDozer, { page:'current' } ).data().each( function ( group, i ){
               if ( last !== group ) {
                  $(rows).eq( i ).before( '<tr class="group"><td colspan="6" class="text-center">'+group+'</td></tr>' );
                  last = group;
               }
            });
         }
      });
      $('#table_unit_dozer tbody').on( 'click', 'tr.group', function (){
         var currentOrder = tableDozer.order()[0];
         if ( currentOrder[0] === groupColumnDozer && currentOrder[1] === 'asc' ){
            tableDozer.order( [ groupColumnDozer, 'desc' ] ).draw();
         } else {
            tableDozer.order( [ groupColumnDozer, 'asc' ] ).draw();
         }
      });
      $('#btn-filter-dzr').click(function(){
         if($("#date_range_dzr").val() == "" && $("#sn_dzr").val() == "" && $("#unit_dzr").val() == "" && $("#hull_dzr").val() == ""){
            toastr.error('Please input one of the following input first!');
            return false;
         } else {
            $('#table_unit_dozer').DataTable().ajax.reload();
         }
      });
      $('#btn-reset-dzr').click(function(){
         $('#form-filter-dzr')[0].reset();
         $('#table_unit_dozer').DataTable().ajax.reload();
         $('#unit_dzr').val("").trigger('change');
      });

      var groupColumnExca = 1;
      var tableExca = $('#table_unit_exca').DataTable({
         "processing": true,
         "serverSide": true,
         "scrollY": "300px",
         "pageLength": 1000,
         "scrollCollapse": true,
         "info": false,
         "bLengthChange": false,
         "order": [[ groupColumnExca, 'asc' ]],
         "ajax": {
            "url"  : '<?=site_url()?>dashboard/t_exca/<?=$this->uri->segment(3)?>',
            "type" : 'POST',
            data : function ( data ) { data.date_range = $("#date_range_exc").attr("value");data.sn = $("#sn_exc").attr("value");data.unit = $("#unit_exc").attr("value");data.hull = $("#hull_exc").val(); },
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){tableDozer.ajax.reload();});}
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "unit", "className": "text-left", "visible": false },
            { "data": "serial", "className": "text-center", "orderable": false },
            { "data": "hull", "className": "text-center", "orderable": false },
            { "data": "site", "className": "text-center", "orderable": false },
            { "data": "lastupdate", "className": "text-center", "orderable": false },
            { "data": "warningfault", "className": "text-center", "orderable": false },
         ],
         "drawCallback": function ( settings ) {
            var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
            api.column(groupColumnExca, { page:'current' } ).data().each( function ( group, i ){
               if ( last !== group ) {
                  $(rows).eq( i ).before( '<tr class="group"><td colspan="6" class="text-center">'+group+'</td></tr>' );
                  last = group;
               }
            });
         }
      });
      $('#table_unit_exca tbody').on( 'click', 'tr.group', function (){
         var currentOrder = tableExca.order()[0];
         if ( currentOrder[0] === groupColumnExca && currentOrder[1] === 'asc' ){
            tableExca.order( [ groupColumnExca, 'desc' ] ).draw();
         } else {
            tableExca.order( [ groupColumnExca, 'asc' ] ).draw();
         }
      });
      $('#btn-filter-exc').click(function(){
         if($("#date_range_exc").val() == "" && $("#sn_exc").val() == "" && $("#unit_exc").val() == "" && $("#hull_exc").val() == ""){
            toastr.error('Please input one of the following input first!');
            return false;
         } else {
            $('#table_unit_exca').DataTable().ajax.reload();
         }
      });
      $('#btn-reset-exc').click(function(){
         $('#form-filter-exc')[0].reset();
         $('#table_unit_exca').DataTable().ajax.reload();
         $('#unit_exc').val("").trigger('change');
      });

      var groupColumnHD = 1;
      var tableHD = $('#table_unit_hd').DataTable({
         "processing": true,
         "serverSide": true,
         "scrollY": "500px",
         "pageLength": 1000,
         "scrollCollapse": true,
         "info": false,
         "bLengthChange": false,
         "order": [[ groupColumnHD, 'asc' ]],
         "ajax": {
            "url"  : '<?=site_url()?>dashboard/t_hd/<?=$this->uri->segment(3)?>',
            "type" : 'POST',
            data : function ( data ) { data.date_range_hd = $("#date_range_hd").val();data.sn_hd = $("#sn_hd").val();data.unit_hd = $("#unit_hd").val();data.hull_hd = $("#hull_hd").val(); },
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){tableDozer.ajax.reload();});}
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "unit", "className": "text-left", "visible": false },
            { "data": "serial", "className": "text-center", "orderable": false },
            { "data": "hull", "className": "text-center", "orderable": false },
            { "data": "site", "className": "text-center", "orderable": false },
            { "data": "lastupdate", "className": "text-center", "orderable": false },
            { "data": "warningfault", "className": "text-center", "orderable": false },
            { "data": "payload", "className": "text-center", "orderable": false }
         ],
         "drawCallback": function ( settings ) {
            var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
            api.column(groupColumnHD, { page:'current' } ).data().each( function ( group, i ){
               if ( last !== group ) {
                  $(rows).eq( i ).before( '<tr class="group"><td colspan="7" class="text-center">'+group+'</td></tr>' );
                  last = group;
               }
            });
         }
      });
      $('#btn-filter-hd').click(function(){
         if($("#date_range_hd").val() == "" && $("#sn_hd").val() == "" && $("#unit_hd").val() == "" && $("#hull_hd").val() == ""){
            toastr.error('Please input one of the following input first!');
            return false;
         } else { $('#table_unit_hd').DataTable().ajax.reload();}
      });
      $('#btn-reset-hd').click(function(){
         $('#form-filter-hd')[0].reset();
         $('#table_unit_hd').DataTable().ajax.reload();
         $('#unit_hd').val("").trigger('change');
      });
      $('#table_unit_hd tbody').on( 'click', 'tr.group', function (){
         var currentOrder = tableHD.order()[0];
         if ( currentOrder[0] === groupColumnHD && currentOrder[1] === 'asc' ){
            tableHD.order( [ groupColumnHD, 'desc' ] ).draw();
         } else {
            tableHD.order( [ groupColumnHD, 'asc' ] ).draw();
         }
      });
   });
</script>