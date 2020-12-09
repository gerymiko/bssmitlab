<section class="content-header">
   <h4>Master Unit <b class="text-blue"><?=$this->session->userdata('site')?></b></h4>
</section>
<section class="content">
   <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
         <li class="active"><a href="#tab_1" data-toggle="tab">Unit</a></li>
         <li><a href="#tab_2" data-toggle="tab">Aktifitas Unit</a></li>
         <li><a href="#tab_3" data-toggle="tab">Kategori Unit</a></li>
         <li><a href="#tab_4" data-toggle="tab">Pemetaan Unit</a></li>
      </ul>
      <div class="tab-content">
         <div class="tab-pane active" id="tab_1">
            <div class="desktop" id="content-filter">
               <form id="form-filter" action="#" class="form-horizontal">              
                  <div class="col-md-3">
                     <div class="form-group" style="margin-bottom: 0px;">
                        <select class="form-control select2" id="kategori">
                           <option></option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group" style="margin-bottom: 0px;">
                        <select class="form-control select2" id="aktifitas">
                           <option></option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group" style="margin-bottom: 0px;">
                        <input type="text" class="form-control _CalPhaNum" id="noequip" placeholder="No. Equipment">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group" style="margin-bottom: 0px;">
                        <input type="text" class="form-control _CalPhaNum" id="nolambung" placeholder="No. Lambung">
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
            <div style="padding: 20px;"></div>
   			<table id="table_unit" class="table table-border table-striped table-hover" width="100%">
   				<thead>
   					<tr>
   						<th>#</th>
   						<th>Aktivitas</th>
   						<th class="text-center">Kategori</th>
   						<th>No. Equip</th>
   						<th>No. Lambung</th>
                     <th>Panjang</th>
                     <th>Lebar</th>
                     <th>Tinggi</th>
                     <th>Vessel</th>
   						<th></th>
   					</tr>
   				</thead>
   			</table>
         </div>
         <div class="tab-pane" id="tab_2">
            <table id="table_unit_activity" class="table table-border table-striped table-hover" width="100%">
               <thead>
                  <tr>
                     <th>#</th>
                     <th class="text-center">Aktifitas</th>
                     <th>Status</th>
                     <th></th>
                  </tr>
               </thead>
            </table>
         </div>
         <div class="tab-pane" id="tab_3">
            <table id="table_unit_category" class="table table-border table-striped table-hover" width="100%">
               <thead>
                  <tr>
                     <th>#</th>
                     <th class="text-center">Kategori</th>
                     <th>Status</th>
                     <th></th>
                  </tr>
               </thead>
            </table>
         </div>
         <div class="tab-pane" id="tab_4">
            <table id="table_unit_mapping" class="table table-border table-striped table-hover" width="100%">
               <thead>
                  <tr>
                     <th>#</th>
                     <th class="text-center">Aktifitas</th>
                     <th>Kategori</th>
                     <th>No. Lambung</th>
                     <th>No. Equip</th>
                     <th>Periode Awal</th>
                     <th>Periode Akhir</th>
                     <th>Kapasitas</th>
                     <th></th>
                  </tr>
               </thead>
            </table>
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
    	$('#master-treeview, #link_master_unit').addClass('active');
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
		$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
		$('#kategori').select2({ placeholder: 'Pilih Kategori', allowClear: true });
      $('#aktifitas').select2({ placeholder: 'Pilih Aktifitas', allowClear: true });
      var groupColumn1 = 1;
		var table1 = $('#table_unit').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
			"url": '<?=site_url('unit/t_unit/').$accessRights->site?>',
			"type": 'POST',
				error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table1.ajax.reload();});}
				},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "activity", "className": "text-center", "orderable": false, "visible": false },
				{ "data": "category", "className": "text-left", "orderable": false },
				{ "data": "noequip", "className": "text-center", "orderable": false },
				{ "data": "nolambung", "className": "text-center", "orderable": false },
            { "data": "panjang", "className": "text-center", "orderable": false },
            { "data": "lebar", "className": "text-center", "orderable": false },
            { "data": "tinggi", "className": "text-center", "orderable": false },
            { "data": "vessel", "className": "text-center", "orderable": false },
				{ "data": "action", "className": "text-center", "orderable": false  },
		 	],
         "drawCallback": function ( settings ) {
            var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
            api.column(groupColumn1, { page:'current' } ).data().each( function ( group, i ){
               if ( last !== group ) {
                  $(rows).eq( i ).before( '<tr class="group"><td colspan="9" class="text-center">'+group+'</td></tr>' );
                  last = group;
               }
            });
         }
		});

      var table2 = $('#table_unit_activity').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "order": [],
         "ajax": {
         "url": '<?=site_url('unit/t_unit_activity/').$accessRights->site?>',
         "type": 'POST',
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table2.ajax.reload();});}
            },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "nama", "className": "text-left", "orderable": false },
            { "data": "status", "className": "text-center", "orderable": false },
            { "data": "action", "className": "text-center", "orderable": false },
         ]
      });

      var table3 = $('#table_unit_category').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "order": [],
         "ajax": {
         "url": '<?=site_url('unit/t_unit_category/').$accessRights->site?>',
         "type": 'POST',
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table3.ajax.reload();});}
            },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "nama", "className": "text-left", "orderable": false },
            { "data": "status", "className": "text-center", "orderable": false },
            { "data": "action", "className": "text-center", "orderable": false },
         ]
      });

      var groupColumn2 = 1;
      var table4 = $('#table_unit_mapping').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "order": [],
         "ajax": {
         "url": '<?=site_url('unit/t_unit_mapping/').$accessRights->site?>',
         "type": 'POST',
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table4.ajax.reload();});}
            },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "activity", "className": "text-left", "orderable": false, "visible": false },
            { "data": "category", "className": "text-center", "orderable": false },
            { "data": "no_lambung", "className": "text-center", "orderable": false },
            { "data": "no_equipment", "className": "text-center", "orderable": false },
            { "data": "periode_awal", "className": "text-center", "orderable": false },
            { "data": "periode_akhir", "className": "text-center", "orderable": false },
            { "data": "capacity", "className": "text-center", "orderable": false },
            { "data": "action", "className": "text-center", "orderable": false },
         ],
         "drawCallback": function ( settings ) {
            var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
            api.column(groupColumn2, { page:'current' } ).data().each( function ( group, i ){
               if ( last !== group ) {
                  $(rows).eq( i ).before( '<tr class="group"><td colspan="8" class="text-center">'+group+'</td></tr>' );
                  last = group;
               }
            });
         }
      });

   });
</script>