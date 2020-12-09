<section class="content-header">
   <h4>Master Parameter Raport Hauling <b class="text-blue"><?=$this->session->userdata('site')?></b></h4>
</section>
<section class="content">
   	<div class="nav-tabs-custom">
      	<ul class="nav nav-tabs">
         	<li class="active"><a href="#tab_1" data-toggle="tab">Raport Hauling HDR</a></li>
         	<li><a href="#tab_2" data-toggle="tab">Raport Hauling DTL</a></li>
        </ul>
        <div class="tab-content">
        	<div class="tab-pane active" id="tab_1">
        		<div class="box-header">
        			<h3 class="box-title"></h3>
        			<div class="box-tools pull-right">
        				<?php
	        				if ($accessRights->id_level == 1) {
	        					echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-raport-hauling-hdr"><i class="fas fa-plus"></i></button>';
	        				} else {
	        					echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
	        				}
        				?>
        			</div>
        		</div>
        		<div class="box-body">
        			<table id="table_raport_hdr" class="table table-border table-striped table-hover" width="100%">
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
	        					echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-raport-hauling-dtl"><i class="fas fa-plus"></i></button>';
	        				} else {
	        					echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
	        				}
        				?>
        			</div>
        		</div>
        		<div class="box-body">
        			<table id="table_raport_dtl" class="table table-border table-striped table-hover" width="100%">
        				<thead>
        					<tr>
        						<th>#</th>
        						<th class="text-center">Parameter</th>
        						<th>Batas Atas</th>
        						<th>Batas Bawah</th>
        						<th>Dynamic Value</th>
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
<div class="modal" id="modal-add-raport-hauling-hdr">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Data Raport Hauling HDR</h4>
            </div>
            <form id="form-add-raport-hauling-hdr" action="#" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Parameter</label>
                        <input type="text" name="parameter" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control _CalPhaNum required" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Site</label>
                        <select class="form-control required" name="site">
                            <option value="">Pilih</option>
                            <option value="AGM">AGM</option>
                            <option value="PMSS">PMSS</option>
                            <option value="MAS">MAS</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer no-border">
                    <button type="button" id="btn_add_raport_hauling_hdr" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-edit-raport-hauling-hdr">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Ubah Data Raport Hauling HDR</h4>
            </div>
            <form id="form-edit-raport-hauling-hdr" action="#" method="post">
                <input type="hidden" name="id_hdr" id="id_hdr">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Parameter</label>
                        <input type="text" name="parameter" id="parameter" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control _CalPhaNum required" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Site</label>
                        <select class="form-control required" name="site" id="site">
                            <option value="">Pilih</option>
                            <option value="AGM">AGM</option>
                            <option value="PMSS">PMSS</option>
                            <option value="MAS">MAS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control required" name="active" id="active_hdr">
                            <option value="">Pilih</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer no-border">
                    <button type="button" id="btn_edit_raport_hauling_hdr" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-add-raport-hauling-dtl">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Data Raport Hauling DTL</h4>
            </div>
            <form id="form-add-raport-hauling-dtl" action="#" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Parameter HDR</label>
                        <select class="form-control select2 required" name="id_parameter_hdr">
                            <option></option>
                            <?php
                                foreach ($list_parameter_hdr as $row) {
                                    echo '<option value="'.$row->id.'">'.$row->parameter.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div style="padding: 15px;"></div>
                    <div class="form-group">
                        <label class="control-label">Batas Atas</label>
                        <input type="text" name="batas_atas" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Batas bawah</label>
                        <input type="text" name="batas_atas" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Dynamic Value</label>
                        <input type="text" name="dynamic_value" class="form-control _CalPhaNum" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nilai</label>
                        <input type="text" name="nilai" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                </div>
                <div class="modal-footer no-border">
                    <button type="button" id="btn_add_raport_hauling_dtl" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-edit-raport-hauling-dtl">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Ubah Data Raport Hauling DTL</h4>
            </div>
            <form id="form-edit-raport-hauling-dtl" action="#" method="post">
                <input type="hidden" name="id_dtl" id="id_dtl">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Parameter HDR</label>
                        <select class="form-control select2 required" name="id_parameter_hdr" id="id_parameter_hdr">
                            <option></option>
                            <?php
                                foreach ($list_parameter_hdr as $row) {
                                    echo '<option value="'.$row->id.'">'.$row->parameter.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div style="padding: 15px;"></div>
                    <div class="form-group">
                        <label class="control-label">Batas Atas</label>
                        <input type="text" name="batas_atas" id="batas_atas" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Batas bawah</label>
                        <input type="text" name="batas_bawah" id="batas_bawah" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Dynamic Value</label>
                        <input type="text" name="dynamic_value" id="dynamic_value" class="form-control _CalPhaNum" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nilai</label>
                        <input type="text" name="nilai" id="nilai" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control required" name="active" id="active_dtl">
                            <option value="">Pilih</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer no-border">
                    <button type="button" id="btn_edit_raport_hauling_dtl" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style type="text/css">
   tr.group, tr.group { background-image: linear-gradient(to left, #FAFAFB 0%, #E3E3E3 100%); font-weight: 600;font-size: 15px;text-transform: uppercase; }
</style>
<script type="text/javascript">
    $(document).ready(function (){
      	$('#master-treeview, #link_master_raport_hauling').addClass('active');
        $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
        $('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
        $('.select2').select2({ placeholder: 'Choose', allowClear: true });
        $('.modal').on('hidden.bs.modal', function (e) {
            $(this)
            .find("input,select,textarea").val('').end();$(".select2").val([]).trigger("change");
        });
      	var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
      	var table1 = $('#table_raport_hdr').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
				"url": '<?=site_url('raport_hauling/t_master_raport_hauling_hdr/').$accessRights->site?>',
				"type": 'POST',
				error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table1.ajax.reload();});}
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "parameter", "className": "text-left", "orderable": false },
				{ "data": "keterangan", "className": "text-left", "orderable": false },
				{ "data": "status", "className": "text-center", "orderable": false },
				{ "data": "action", "className": "text-center", "orderable": false },
			]
		});

        $('#modal-edit-raport-hauling-hdr').on('show.bs.modal', function (event) {
            if (event.namespace == 'bs.modal') {
                var button = $(event.relatedTarget)
                var id_hdr = button.data('id_hdr')
                var parameter = button.data('parameter')
                var keterangan   = button.data('keterangan')
                var active = button.data('active')
                var site = button.data('site')
                var modal  = $(this)
                modal.find('#id_hdr').val(id_hdr)
                modal.find('#parameter').val(parameter)
                modal.find('#keterangan').val(keterangan)
                modal.find('#active_hdr').val(active).trigger('change')
                modal.find('#site').val(site).trigger('change')
            }
        });
        $("#btn_add_raport_hauling_hdr").click(function () {
         $("#loading").removeClass("hidden");
         var formdata = $("#form-add-raport-hauling-hdr").serialize();
         if($("#form-add-raport-hauling-hdr").valid() == false){
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.post("<?=site_url('sadd/raport_hauling_hdr/').$accessRights->site?>",
            formdata,
            function(data) {
               if(data == "Success"){
                  table1.ajax.reload();
                  $("#loading").addClass("hidden");
                  $('#modal-add-raport-hauling-hdr').modal('hide');
                  swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
               } else if(data == "unauthority"){
                  $('#modal-add-raport-hauling-hdr').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
               } else {
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
               }
            });   
         }
      });
        $("#btn_edit_raport_hauling_hdr").click(function () {
         $("#loading").removeClass("hidden");
         var formdata = $("#form-edit-raport-hauling-hdr").serialize();
         if($("#form-edit-raport-hauling-hdr").valid() == false){
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.post("<?=site_url('sedd/raport_hauling_hdr/').$accessRights->site?>",
            formdata,
            function(data) {
               if(data == "Success"){
                  table1.ajax.reload();
                  $("#loading").addClass("hidden");
                  $('#modal-edit-raport-hauling-hdr').modal('hide');
                  swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
               } else if(data == "unauthority"){
                  $('#modal-edit-raport-hauling-hdr').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
               } else {
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
               }
            });   
         }
      });
        

		var groupColumn = 1;
		var table2 = $('#table_raport_dtl').DataTable({
		 	"processing": true,
		 	"serverSide": true,
		 	"responsive": true,
		 	"order": [],
		 	"ajax": {
		    	"url": '<?=site_url('raport_hauling/t_master_raport_hauling_dtl/').$accessRights->site?>',
		    	"type": 'POST',
		    	error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table2.ajax.reload();});}
		 	},
		 	"language": { "processing": bar },
		 	"columns": [
		    	{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
		    	{ "data": "parameter", "className": "text-center", "orderable": false, 'visible': false },
		    	{ "data": "batas_atas", "className": "text-center", "orderable": false },
		    	{ "data": "batas_bawah", "className": "text-left", "orderable": false },
		    	{ "data": "dynamic_value", "className": "text-center", "orderable": false },
		    	{ "data": "nilai", "className": "text-center", "orderable": false },
		    	{ "data": "status", "className": "text-center", "orderable": false },
		    	{ "data": "action", "className": "text-center", "orderable": false },
		 	],
			 "drawCallback": function ( settings ) {
		    	var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
		    	api.column(groupColumn, { page:'current' } ).data().each( function ( group, i ){
		       		if ( last !== group ) {
		          		$(rows).eq( i ).before( '<tr class="group"><td colspan="8" class="text-center">'+group+'</td></tr>' );
		          		last = group;
		       		}
	    		});
		 	}
		});
        $('#modal-edit-raport-hauling-dtl').on('show.bs.modal', function (event) {
            if (event.namespace == 'bs.modal') {
                var button = $(event.relatedTarget)
                var id_dtl = button.data('id_dtl')
                var id_parameter_hdr = button.data('id_parameter_hdr')
                var batas_atas = button.data('batas_atas')
                var batas_bawah   = button.data('batas_bawah')
                var dynamic_value   = button.data('dynamic_value')
                var nilai   = button.data('nilai')
                var active = button.data('active')
                var modal  = $(this)
                modal.find('#id_dtl').val(id_dtl)
                modal.find('#id_parameter_hdr').val(id_parameter_hdr)
                modal.find('#batas_atas').val(batas_atas)
                modal.find('#batas_bawah').val(batas_bawah)
                modal.find('#dynamic_value').val(dynamic_value)
                modal.find('#nilai').val(nilai)
                modal.find('#active_dtl').val(active).trigger('change')
            }
        });
        $("#btn_add_raport_hauling_dtl").click(function () {
         $("#loading").removeClass("hidden");
         var formdata = $("#form-add-raport-hauling-dtl").serialize();
         if($("#form-add-raport-hauling-dtl").valid() == false){
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.post("<?=site_url('sadd/raport_hauling_dtl/').$accessRights->site?>",
            formdata,
            function(data) {
               if(data == "Success"){
                  table2.ajax.reload();
                  $("#loading").addClass("hidden");
                  $('#modal-add-raport-hauling-dtl').modal('hide');
                  swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
               } else if(data == "unauthority"){
                  $('#modal-add-raport-hauling-dtl').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
               } else {
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
               }
            });   
         }
      });
        $("#btn_edit_raport_hauling_dtl").click(function () {
         $("#loading").removeClass("hidden");
         var formdata = $("#form-edit-raport-hauling-dtl").serialize();
         if($("#form-edit-raport-hauling-dtl").valid() == false){
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.post("<?=site_url('sedd/raport_hauling_dtl/').$accessRights->site?>",
            formdata,
            function(data) {
               if(data == "Success"){
                  table2.ajax.reload();
                  $("#loading").addClass("hidden");
                  $('#modal-edit-raport-hauling-dtl').modal('hide');
                  swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
               } else if(data == "unauthority"){
                  $('#modal-edit-raport-hauling-dtl').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
               } else {
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
               }
            });   
         }
      });
    });
</script>