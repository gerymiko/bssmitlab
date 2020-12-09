<section class="content-header">
   <h4>Master Event <b class="text-blue"><?=$this->session->userdata('site')?></b></h4>
</section>
<section class="content">
   	<div class="nav-tabs-custom">
      	<ul class="nav nav-tabs">
         	<li class="active"><a href="#tab_1" data-toggle="tab">Event</a></li>
         	<li><a href="#tab_2" data-toggle="tab">Event Level</a></li>
        </ul>
        <div class="tab-content">
        	<div class="tab-pane active" id="tab_1">
        		<div class="box-header">
        			<h3 class="box-title"></h3>
        			<div class="box-tools pull-right">
        				<?php
	        				if ($accessRights->id_level == 1) {
	        					echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-event"><i class="fas fa-plus"></i></button>';
	        				} else {
	        					echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
	        				}
        				?>
        			</div>
        		</div>
        		<div class="box-body">
        			<table id="table_event" class="table table-border table-striped table-hover" width="100%">
        				<thead>
        					<tr>
        						<th>#</th>
        						<th class="text-center">Nama Event</th>
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
        	<div class="tab-pane" id="tab_2">
        		<div class="box-header">
        			<h3 class="box-title"></h3>
        			<div class="box-tools pull-right">
        				<?php
	        				if ($accessRights->id_level == 1) {
	        					echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-event-level"><i class="fas fa-plus"></i></button>';
	        				} else {
	        					echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
	        				}
        				?>
        			</div>
        		</div>
        		<div class="box-body">
        			<table id="table_event_level" class="table table-border table-striped table-hover" width="100%">
        				<thead>
        					<tr>
        						<th>#</th>
        						<th class="text-center">Nama Event</th>
        						<th>Urut</th>
        						<th>Notif</th>
        						<th>Toleransi Waktu</th>
        						<th>IDx</th>
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
<div class="modal" id="modal-add-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Event</h4>
            </div>
            <form id="form-add-event" action="#" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Nama Event</label>
                        <input type="text" name="nama" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Urut</label>
                        <input type="text" name="urut" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jam Mulai DS</label>
                        <input type="text" name="jam_mulai_ds" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jam Selesai DS</label>
                        <input type="text" name="jam_selesai_ds" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jam Mulai NS</label>
                        <input type="text" name="jam_mulai_ns" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jam Selesai NS</label>
                        <input type="text" name="jam_selesai_ns" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                </div>
                <div class="modal-footer no-border">
                    <button type="button" id="btn_add_event" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-edit-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Ubah Event</h4>
            </div>
            <form id="form-edit-event" action="#" method="post">
                <input type="hidden" name="id_event" id="id_event">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Nama Event</label>
                        <input type="text" name="nama" id="nama" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Urut</label>
                        <input type="text" name="urut" id="urut" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jam Mulai DS</label>
                        <input type="text" name="jam_mulai_ds" id="jam_mulai_ds" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jam Selesai DS</label>
                        <input type="text" name="jam_selesai_ds" id="jam_selesai_ds" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jam Mulai NS</label>
                        <input type="text" name="jam_mulai_ns" id="jam_mulai_ns" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jam Selesai NS</label>
                        <input type="text" name="jam_selesai_ns" id="jam_selesai_ns" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control required" name="active" id="active">
                           <option value="">Choose</option>
                           <option value="1">Active</option>
                           <option value="0">Non-active</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer no-border">
                    <button type="button" id="btn_edit_event" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-add-event-level">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Event Level</h4>
            </div>
            <form id="form-add-event-level" action="#" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Nama Event</label>
                        <select class="form-control select2 required" name="id_event">
                            <option></option>
                            <?php
                                foreach ($list_event as $row) {
                                    echo '<option value="'.$row->id.'">'.$row->nama.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Urut</label>
                        <input type="text" name="urut" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Notifikasi</label>
                        <input type="text" name="notif" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Toleransi Waktu (dalam menit)</label>
                        <input type="text" name="toleransi_waktu" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">IDx</label>
                        <input type="text" name="idx" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                </div>
                <div class="modal-footer no-border">
                    <button type="button" id="btn_add_event_level" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-edit-event-level">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Event Level</h4>
            </div>
            <form id="form-edit-event-level" action="#" method="post">
                <input type="hidden" name="id" id="id_event_level">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Nama Event</label>
                        <select class="form-control select2 required" name="id_event" id="id_event_edit">
                        <option></option>
                            <?php
                                foreach ($list_event as $row) {
                                   echo '<option value="'.$row->id.'">'.$row->nama.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Urut</label>
                        <input type="text" name="urut" id="urut_level" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Notifikasi</label>
                        <input type="text" name="notif" id="notif" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Toleransi Waktu (dalam menit)</label>
                        <input type="text" name="toleransi_waktu" id="toleransi_waktu" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">IDx</label>
                        <input type="text" name="idx" id="idx" class="form-control _CalPhaNum required" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control required" name="active" id="active_level">
                           <option value="">Choose</option>
                           <option value="1">Active</option>
                           <option value="0">Non-active</option>
                        </select>
                     </div>
                </div>
                <div class="modal-footer no-border">
                    <button type="button" id="btn_edit_event_level" class="btn btn-primary">Simpan</button>
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
      	$('#master-treeview, #link_master_event').addClass('active');
        $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-:' });
        $('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
        $('.select2').select2({ placeholder: 'Choose', allowClear: true });
      	var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
      	var table1 = $('#table_event').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
				"url": '<?=site_url()?>event/t_event/<?=$accessRights->site?>',
				"type": 'POST',
				error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table1.ajax.reload();});}
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "nama", "className": "text-left", "orderable": false },
				{ "data": "urut", "className": "text-center", "orderable": false },
				{ "data": "jam_mulai_ds", "className": "text-center", "orderable": false },
				{ "data": "jam_selesai_ds", "className": "text-center", "orderable": false },
				{ "data": "jam_mulai_ns", "className": "text-center", "orderable": false },
				{ "data": "jam_selesai_ns", "className": "text-center", "orderable": false },
				{ "data": "status", "className": "text-center", "orderable": false },
				{ "data": "action", "className": "text-center", "orderable": false },
			]
		});

		var groupColumn = 1;
		var table2 = $('#table_event_level').DataTable({
		 	"processing": true,
		 	"serverSide": true,
		 	"responsive": true,
		 	"order": [],
		 	"ajax": {
		    	"url": '<?=site_url()?>event/t_event_level/<?=$accessRights->site?>',
		    	"type": 'POST',
		    	error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table2.ajax.reload();});}
		 	},
		 	"language": { "processing": bar },
		 	"columns": [
		    	{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
		    	{ "data": "event", "className": "text-center", "orderable": false, 'visible': false },
		    	{ "data": "urut", "className": "text-center", "orderable": false },
		    	{ "data": "notif", "className": "text-left", "orderable": false },
		    	{ "data": "toleransi_waktu", "className": "text-center", "orderable": false },
		    	{ "data": "idx", "className": "text-center", "orderable": false },
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
        $('#modal-edit-event').on('show.bs.modal', function (event) {
            if (event.namespace == 'bs.modal') {
                var button = $(event.relatedTarget)
                var id_event = button.data('id_event')
                var nama = button.data('nama')
                var urut   = button.data('urut')
                var jam_mulai_ds  = button.data('jam_mulai_ds')
                var jam_selesai_ds   = button.data('jam_selesai_ds')
                var jam_mulai_ns  = button.data('jam_mulai_ns')
                var jam_selesai_ns   = button.data('jam_selesai_ns')
                var active = button.data('active')
                var modal  = $(this)
                modal.find('#id_event').val(id_event)
                modal.find('#nama').val(nama)
                modal.find('#urut').val(urut)
                modal.find('#jam_mulai_ds').val(jam_mulai_ds)
                modal.find('#jam_selesai_ds').val(jam_selesai_ds)
                modal.find('#jam_mulai_ns').val(jam_mulai_ns)
                modal.find('#jam_selesai_ns').val(jam_selesai_ns)
                modal.find('#active').val(active).trigger('change')
            }
        });
        $('.modal').on('hidden.bs.modal', function (e) {
            $(this)
            .find("input,select,textarea").val('').end();$(".select2").val([]).trigger("change");
        });
        $("#btn_edit_event").click(function () {
            $("#loading").removeClass("hidden");
            var formdata = $("#form-edit-event").serialize();
            if($("#form-edit-event").valid() == false){
                $("#loading").addClass("hidden");
                return false;
            } else {
                $.post("<?=site_url('sedd/event/').$accessRights->site?>",
                formdata,
                function(data) {
                    if(data == "Success"){
                        table1.ajax.reload();
                        $("#loading").addClass("hidden");
                        $('#modal-edit-event').modal('hide');
                        swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
                    } else if(data == "unauthority"){
                        $('#modal-edit-event').modal('toggle');
                        $("#loading").addClass("hidden");
                        swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
                    } else {
                        $("#loading").addClass("hidden");
                        swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
                    }
                });   
            }
        });
        $("#btn_add_event").click(function () {
            $("#loading").removeClass("hidden");
            var formdata = $("#form-add-event").serialize();
            if($("#form-add-event").valid() == false){
                $("#loading").addClass("hidden");
                return false;
            } else {
                $.post("<?=site_url('sadd/event/').$accessRights->site?>",
                formdata,
                function(data) {
                    if(data == "Success"){
                        table1.ajax.reload();
                        $("#loading").addClass("hidden");
                        $('#modal-add-event').modal('hide');
                        swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
                    } else if(data == "unauthority"){
                        $('#modal-add-event').modal('toggle');
                        $("#loading").addClass("hidden");
                        swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
                    } else {
                        $("#loading").addClass("hidden");
                        swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
                    }
                });   
            }
        });
        $('#modal-edit-event-level').on('show.bs.modal', function (event) {
            if (event.namespace == 'bs.modal') {
                var button = $(event.relatedTarget)
                var id_event_level = button.data('id_event_level')
                var id_event_edit = button.data('id_event_edit')
                var urut_level   = button.data('urut_level')
                var toleransi_waktu  = button.data('toleransi_waktu')
                var notif   = button.data('notif')
                var idx  = button.data('idx')
                var active_level = button.data('active_level')
                var modal  = $(this)
                modal.find('#id_event_level').val(id_event_level)
                modal.find('#urut_level').val(urut_level)
                modal.find('#toleransi_waktu').val(toleransi_waktu)
                modal.find('#notif').val(notif)
                modal.find('#idx').val(idx)
                modal.find('#active_level').val(active_level).trigger('change')
                modal.find('#id_event_edit').val(id_event_edit).trigger('change')
            }
        });
        $("#btn_edit_event_level").click(function () {
            $("#loading").removeClass("hidden");
            var formdata = $("#form-edit-event-level").serialize();
            if($("#form-edit-event-level").valid() == false){
                $("#loading").addClass("hidden");
                return false;
            } else {
                $.post("<?=site_url('sedd/event_level/').$accessRights->site?>",
                formdata,
                function(data) {
                    if(data == "Success"){
                        table2.ajax.reload();
                        $("#loading").addClass("hidden");
                        $('#modal-edit-event-level').modal('hide');
                        swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
                    } else if(data == "unauthority"){
                        $('#modal-edit-event-level').modal('toggle');
                        $("#loading").addClass("hidden");
                        swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
                    } else {
                        $("#loading").addClass("hidden");
                        swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
                    }
                });   
            }
        });
        $("#btn_add_event_level").click(function () {
            $("#loading").removeClass("hidden");
            var formdata = $("#form-add-event-level").serialize();
            if($("#form-add-event-level").valid() == false){
                $("#loading").addClass("hidden");
                return false;
            } else {
                $.post("<?=site_url('sadd/event_level/').$accessRights->site?>",
                formdata,
                function(data) {
                    if(data == "Success"){
                        table2.ajax.reload();
                        $("#loading").addClass("hidden");
                        $('#modal-add-event-level').modal('hide');
                        swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
                    } else if(data == "unauthority"){
                        $('#modal-add-event-level').modal('toggle');
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