<section class="content-header">
   	<h1>Master Module <small class="text-blue">Configuration</small></h1>
</section>
<section class="content">
	<div class="box no-radius">
		<div class="box-header no-border">
			<h3 class="box-title">List Module</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-module">Add Module</button>
			</div>
		</div>
		<div class="box-body">
			<table id="table_module_config" class="table table-bordered table-hover nowrap" width="100%" style="color: #262D37;">
				<thead class="bg-cgray">
					<tr>
						<th>#</th>
						<th class="text-center">Name</th>
						<th class="text-center">Alias</th>
						<th class="text-center">Description</th>
						<th>Status</th>
						<th><i class="fas fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="modal-add-module">
   <div class="modal-dialog center" role="document">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-black">Add Module</h4>
         </div>
         <form id="form-add-module" method="post" action="#">
            <div class="modal-body">
            	<div class="form-group">
            		<label class="control-label">System</label>
            		<select class="form-control required" name="module_system" id="module_system">
            			<option></option>
            			<?php
            				foreach ($list_system as $row) {
            					echo '<option value="'.$row->id.'">'.$row->name.'</option>';
            				}
            			?>
            		</select>
            	</div>
				<div class="form-group">
					<label class="control-label">Module Name</label>
					<input type="text" class="form-control _CalPhaNum required" name="module_name" maxlength="50">
				</div>
				<div class="form-group">
					<label class="control-label">Description</label>
					<input type="text" class="form-control _CalPhaNum required" name="module_desc" maxlength="100">
				</div>
				<div class="form-group">
					<label class="control-label">Alias</label>
					<input type="text" class="form-control _CalPhaNum required" name="module_alias" maxlength="50">
				</div>
				<div class="form-group">
					<label class="control-label">Module Status</label>
					<select class="form-control required" name="module_status">
						<option value="1">Active</option>
						<option value="0">Non-Active</option>
					</select>
				</div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_add_module" class="btn btn-sm btn-danger">Save</button>
               <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-module">
   <div class="modal-dialog center" role="document">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-black">Add Module</h4>
         </div>
         <form id="form-edit-module" method="post" action="#">
         	<input type="hidden" name="id_module" id="id_module_edit">
            <div class="modal-body">
				<div class="form-group">
					<label class="control-label">Module Name</label>
					<input type="text" class="form-control _CalPhaNum required" name="module_name" id="module_name_edit" maxlength="100">
				</div>
				<div class="form-group">
					<label class="control-label">Description</label>
					<input type="text" class="form-control _CalPhaNum required" name="module_desc" id="module_desc_edit" maxlength="150">
				</div>
				<div class="form-group">
					<label class="control-label">Alias</label>
					<input type="text" class="form-control _CalPhaNum required" name="module_alias" id="module_alias_edit" maxlength="50">
				</div>
				<div class="form-group">
					<label class="control-label">Module Status</label>
					<select class="form-control required" name="module_status" id="modul_status_edit">
						<option value="1">Active</option>
						<option value="0">Non-Active</option>
					</select>
				</div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_edit_module" class="btn btn-sm btn-danger">Save</button>
               <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '_-' });
		$("#module_system").select2({ placeholder: "Choose", allowClear: true });
		$('#link-master_system_module').addClass('active');
		var tableMod = $('#table_module_config').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"dom": 'Bfrtip',
			"buttons": ['pageLength'],
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>dtable/module/<?=$this->uri->segment(3)?>',
				"type" : 'POST',
				error: function(data){
					swal({
						animation: false,
						focusConfirm: false,
						text: "Failed to pull data. Click OK to get data"
					}).then(function(){ tableMod.ajax.reload(); });
				},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "name", "className": "text-left", "orderable": false },
				{ "data": "alias", "className": "text-left", "orderable": false},
				{ "data": "desc", "className": "text-left", "orderable": false},
				{ "data": "status", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "detail", "className": "text-center", "searchable": false, "orderable": false }
			]
		});
		$('#btn_add_module').click(function(){
	    	var formData = $("#form-add-module").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-add-module").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('There was an error filling the data, please check again.');
				return false;
			} else {
				$.post("<?=site_url();?>sadd/module/<?=$this->uri->segment(3)?>",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-add-module').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
						tableMod.ajax.reload();
					} else if(data == "unauthority") {
						$('#modal-add-module').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
					} else if(data == "register") {
						$('#modal-add-module').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Module already registered!',type: "",confirmButtonText: 'Okay',});
					} else {
						$('#modal-add-module').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
					}
				});	
			}
	    });
	    $('#btn_edit_module').click(function(){
	    	var formData = $("#form-edit-module").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-edit-module").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('There was an error filling the data, please check again.');
				return false;
			} else {
				$.post("<?=site_url();?>sedd/module/<?=$this->uri->segment(3)?>",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-edit-module').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
						tableMod.ajax.reload();
					} else if(data == "unauthority") {
						$('#modal-edit-module').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
					} else {
						$('#modal-edit-module').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
						tableMod.ajax.reload();
					}
				});	
			}
	    });
	    $('.modal').on('hidden.bs.modal', function (e) {
		 	$(this)
		 	.find("input,select").val('').end();$("#module_system").val([]).trigger("change");
		});
		$('#modal-edit-module').on('show.bs.modal', function (event) {
         	if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget) 
				var id     = button.data('id')
				var name   = button.data('name')
				var alias  = button.data('alias')
				var desc   = button.data('desc')
				var active = button.data('active')
				var modal  = $(this)
	            modal.find('.modal-title').text('Edit Module : '+name)
	            modal.find('#id_module_edit').val(id)
	            modal.find('#module_name_edit').val(name)
	            modal.find('#module_alias_edit').val(alias)
	            modal.find('#module_desc_edit').val(desc)
	            modal.find('#modul_status_edit').val(active).trigger('change')
         	}
      	});
	});
	function removeData(id, name){
	    swal({
	        title: "",html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Delete this module (<b>'+name+'</b>).',type: "",
	        showCancelButton: true,focusConfirm: false,confirmButtonText: 'Okay, Delete',confirmButtonAriaLabel: 'Okay',cancelButtonText: '<i class="fas fa-times"></i>',cancelButtonAriaLabel: 'Cancel',
	    }).then((result) => {
			if (result.value){
			    $.ajax({
					url: "<?=site_url()?>sdel/module/<?=$this->uri->segment(3)?>",
					type: "post",
					data: { id:id, name:name },
					success:function(data){
						if(data == "Success"){
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',
						    }).then(function(){$('#table_module_config').DataTable().ajax.reload();});
						} else if(data == "unauthority"){
							swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay'});
						} else {
							swal({itle: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to delete. Reload this page and try again.',type: "",confirmButtonText: 'Okay'});
						}
					},
				});
			}
	    });
	}
</script>