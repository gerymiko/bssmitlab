<section class="content-header">
   <h4>Master Matching Fleet <b class="text-blue"><?=$this->session->userdata('site')?></b></h4>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"></h3>
			<div class="box-tools pull-right">
				<?php
					if ($accessRights->id_level == 1) {
						echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-match-fleet"><i class="fas fa-plus"></i></button>';
					} else {
						echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
					}
				?>
			</div>
		</div>
		<div class="box-body">
			<!-- <div class="dragscroll" style="overflow: scroll; cursor: grab; cursor : -o-grab; cursor : -moz-grab; cursor : -webkit-grab;"> -->
				<table id="table_match_fleet" class="table table-bordered table-striped table-hover" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Kategori Loader</th>
							<th>Kategori Hauler</th>
							<th>Distance</th>
							<th>Capacity</th>
							<th>Loading</th>
							<th>Loaded</th>
							<th>Dumping</th>
							<th>Empty</th>
							<th>Spotting</th>
							<th>Efisiensi</th>
							<th>Cycle Time</th>
							<th>Pdty/Jam</th>
							<th>Konversi</th>
							<th>Pdty/Jam/Km</th>
							<th>Keperluan Unit</th>
							<th>Match Factor</th>
							<th></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Kategori Loader</th>
							<th>Kategori Hauler</th>
							<th>Distance</th>
							<th>Capacity</th>
							<th>Loading</th>
							<th>Loaded</th>
							<th>Dumping</th>
							<th>Empty</th>
							<th>Spotting</th>
							<th>Efisiensi</th>
							<th>Cycle Time</th>
							<th>Pdty/Jam</th>
							<th>Konversi</th>
							<th>Pdty/Jam/Km</th>
							<th>Keperluan Unit</th>
							<th>Match Factor</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			<!-- </div> -->
		</div>
	</div>
</section>
<div class="modal" id="modal-add-match-fleet">
	<div class="modal-dialog modal700">
		<div class="modal-content">
			<div class="modal-header no-border">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Tambah Matching Fleet</h4>
			</div>
			<form id="form-add-match-fleet" action="#" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Kategori Loader</label>
								<input type="text" name="category_loader" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Distance</label>
								<input type="text" name="distance" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Loading</label>
								<input type="text" name="loading" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Dumping</label>
								<input type="text" name="dumping" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Spotting</label>
								<input type="text" name="spotting" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Cycle Time</label>
								<input type="text" name="cycle_time" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Konversi</label>
								<input type="text" name="konversi" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Keperluan Unit</label>
								<input type="text" name="keperluan_unit" class="form-control _CalPhaNum required" maxlength="50">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Kategori Hauler</label>
								<input type="text" name="category_hauler" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Kapasitas</label>
								<input type="text" name="capacity" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Loaded</label>
								<input type="text" name="loaded" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Empty</label>
								<input type="text" name="empty" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Efisiensi</label>
								<input type="text" name="efisiensi" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Pdty / jam</label>
								<input type="text" name="pdty_jam" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Pdty / Jam / Km</label>
								<input type="text" name="pdty_jam_km" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Match Factor</label>
								<input type="text" name="match_factor" class="form-control _CalPhaNum required" maxlength="50">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer no-border">
					<button type="button" id="btn_add_match_fleet" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal" id="modal-edit-match-fleet">
	<div class="modal-dialog modal700">
		<div class="modal-content">
			<div class="modal-header no-border">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Ubah Matching Fleet</h4>
			</div>
			<form id="form-edit-match-fleet" action="#" method="post">
				<input type="hidden" name="id_mfleet" id="id_mfleet">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Kategori Loader</label>
								<input type="text" name="category_loader" id="category_loader" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Distance</label>
								<input type="text" name="distance" id="distance" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Loading</label>
								<input type="text" name="loading" id="loading" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Dumping</label>
								<input type="text" name="dumping" id="dumping" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Spotting</label>
								<input type="text" name="spotting" id="spotting" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Cycle Time</label>
								<input type="text" name="cycle_time" id="cycle_time" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Konversi</label>
								<input type="text" name="konversi" id="konversi" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Keperluan Unit</label>
								<input type="text" name="keperluan_unit" id="keperluan_unit" class="form-control _CalPhaNum required" maxlength="50">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Kategori Hauler</label>
								<input type="text" name="category_hauler" id="category_hauler" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Kapasitas</label>
								<input type="text" name="capacity" id="capacity" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Loaded</label>
								<input type="text" name="loaded" id="loaded" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Empty</label>
								<input type="text" name="empty" id="empty" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Efisiensi</label>
								<input type="text" name="efisiensi" id="efisiensi" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Pdty / jam</label>
								<input type="text" name="pdty_jam" id="pdty_jam" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Pdty / Jam / Km</label>
								<input type="text" name="pdty_jam_km" id="pdty_jam_km" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Match Factor</label>
								<input type="text" name="match_factor" id="match_factor" class="form-control _CalPhaNum required" maxlength="50">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer no-border">
					<button type="button" id="btn_edit_match_fleet" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style type="text/css">
	.dtSelected { background-color: rgba(8,158,96,0.11);}
</style>
<script type="text/javascript">
    $(document).ready(function (){
      	$('#master-treeview, #link_master_matching_fleet').addClass('active');
      	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
   		$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
      	var table = $('#table_match_fleet').DataTable({
			"processing": true,
			"serverSide": true,
			"select": true,
			"scrollX": true,
			"pageLength": 50,
			"stateSave": true,
			"order": [],
			"ajax": {
				"url": '<?=site_url('match_fleet/t_match_fleet/').$accessRights->site?>',
				"type": 'POST',
				error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table.ajax.reload();});}
			},
			"language": { "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>' },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "category_loader", "className": "text-center", "orderable": false },
				{ "data": "category_hauler", "className": "text-center", "orderable": false},
				{ "data": "distance", "className": "text-center", "orderable": false  },
				{ "data": "capacity", "className": "text-center", "orderable": false  },
				{ "data": "loading", "className": "text-center", "orderable": false  },
				{ "data": "loaded", "className": "text-center", "orderable": false  },
				{ "data": "dumping", "className": "text-center", "orderable": false  },
				{ "data": "empty", "className": "text-center", "orderable": false  },
				{ "data": "spotting", "className": "text-center", "orderable": false  },
				{ "data": "efisiensi", "className": "text-center", "orderable": false  },
				{ "data": "cycle_time", "className": "text-center", "orderable": false  },
				{ "data": "pdty_jam", "className": "text-center", "orderable": false  },
				{ "data": "konversi", "className": "text-center", "orderable": false  },
				{ "data": "pdty_jam_km", "className": "text-center", "orderable": false  },
				{ "data": "keperluan_unit", "className": "text-center", "orderable": false  },
				{ "data": "match_factor", "className": "text-center", "orderable": false  },
				{ "data": "action", "className": "text-center", "orderable": false  },
			]
		});
		table.on('click', 'tr', function(){
          	$(document).find('tr').removeClass("dtSelected");
         	$(table.row(this).selector.rows).addClass("dtSelected");
      	});
      	$('#modal-edit-match-fleet').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget)
				var id_mfleet = button.data('id_mfleet')
				var category_loader = button.data('category_loader')
				var category_hauler = button.data('category_hauler')
				var distance = button.data('distance')
				var capacity = button.data('capacity')
				var loading = button.data('loading')
				var loaded = button.data('loaded')
				var dumping = button.data('dumping')
				var empty = button.data('empty')
				var spotting = button.data('spotting')
				var efisiensi = button.data('efisiensi')
				var cycle_time = button.data('cycle_time')
				var pdty_jam = button.data('pdty_jam')
				var konversi = button.data('konversi')
				var pdty_jam_km = button.data('pdty_jam_km')
				var keperluan_unit = button.data('keperluan_unit')
				var match_factor = button.data('match_factor')
				var modal  = $(this)
				modal.find('#id_mfleet').val(id_mfleet)
				modal.find('#category_loader').val(category_loader)
				modal.find('#category_hauler').val(category_hauler)
				modal.find('#distance').val(distance)
				modal.find('#capacity').val(capacity)
				modal.find('#loading').val(loading)
				modal.find('#loaded').val(loaded)
				modal.find('#dumping').val(dumping)
				modal.find('#empty').val(empty)
				modal.find('#spotting').val(spotting)
				modal.find('#efisiensi').val(efisiensi)
				modal.find('#cycle_time').val(cycle_time)
				modal.find('#pdty_jam').val(pdty_jam)
				modal.find('#konversi').val(konversi)
				modal.find('#pdty_jam_km').val(pdty_jam_km)
				modal.find('#keperluan_unit').val(keperluan_unit)
				modal.find('#match_factor').val(match_factor)
			}
		});
		$("#btn_edit_match_fleet").click(function () {
         	$("#loading").removeClass("hidden");
         	var formdata = $("#form-edit-match-fleet").serialize();
         	if($("#form-edit-match-fleet").valid() == false){
            	$("#loading").addClass("hidden");
           		return false;
         	} else {
            	$.post("<?=site_url('sedd/match_fleet/').$accessRights->site?>",
            	formdata,
	            function(data) {
	               if(data == "Success"){
	                  table.ajax.reload();
	                  $("#loading").addClass("hidden");
	                  $('#modal-edit-match-fleet').modal('hide');
	                  swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
	               } else if(data == "unauthority"){
	                  $('#modal-edit-match-fleet').modal('toggle');
	                  $("#loading").addClass("hidden");
	                  swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
	               } else {
	                  $("#loading").addClass("hidden");
	                  swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
	               }
	            });   
         	}
      	});
      	$("#btn_add_match_fleet").click(function () {
         	$("#loading").removeClass("hidden");
         	var formdata = $("#form-add-match-fleet").serialize();
         	if($("#form-add-match-fleet").valid() == false){
            	$("#loading").addClass("hidden");
           		return false;
         	} else {
            	$.post("<?=site_url('sadd/match_fleet/').$accessRights->site?>",
            	formdata,
	            function(data) {
	               if(data == "Success"){
	                  table.ajax.reload();
	                  $("#loading").addClass("hidden");
	                  $('#modal-add-match-fleet').modal('hide');
	                  swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
	               } else if(data == "unauthority"){
	                  $('#modal-add-match-fleet').modal('toggle');
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