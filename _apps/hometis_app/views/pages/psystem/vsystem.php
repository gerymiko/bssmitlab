<section class="content-header">
   	<h1>Master System <small class="text-blue">Configuration</small></h1>
</section>
<section class="content">
	<div class="box no-radius">
		<div class="box-header no-border">
			<h3 class="box-title">List System</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-system">Add System</button>
			</div>
		</div>
		<div class="box-body">
			<table id="table_system" class="table table-bordered table-hover nowrap" width="100%" style="color: #262D37;">
				<thead class="bg-cgray">
					<tr>
						<th>#</th>
						<th>Code</th>
						<th class="text-center">Name</th>
						<th class="text-center">Description</th>
						<th>Status</th>
						<th><i class="fas fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="modal-add-system">
   <div class="modal-dialog center modal70" role="document">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-black">Add System</h4>
         </div>
         <form id="form-add-system" method="post" action="#">
            <div class="modal-body">
            	<div class="row">
            		<div class="col-md-6">
            			<div class="form-group">
							<label class="control-label">Code</label>
							<input type="text" name="code" class="form-control _CalPhaNum required" maxlength="100">
						</div>
						<div class="form-group">
							<label class="control-label">Description</label>
							<textarea class="form-control _CalPhaNum required" maxlength="150" name="desc" rows="3"></textarea>
						</div>
            		</div>
            		<div class="col-md-6">
            			<div class="form-group">
							<label class="control-label">Name</label>
							<input type="text" name="name" class="form-control _CalPhaNum required" maxlength="100">
						</div>
						<div class="form-group">
							<label class="control-label">Site Status</label>
							<select class="form-control required" name="status">
								<option value="1">Active</option>
								<option value="0">Non-Active</option>
							</select>
						</div>
            		</div>
            	</div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
               <button type="button" id="btn_add_system" class="btn btn-sm btn-danger">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-system">
   <div class="modal-dialog center" role="document">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-black">Edit Site</h4>
         </div>
         <form id="form-edit-system" method="post" action="#">
         	<input type="hidden" name="id_system" id="id_system">
            <div class="modal-body">
            	<div class="form-group">
					<label class="control-label">Code</label>
					<input type="text" name="code" id="code_sys" class="form-control _CalPhaNum required" maxlength="100">
				</div>
				<div class="form-group">
					<label class="control-label">Name</label>
					<input type="text" name="name" id="name_sys" class="form-control _CalPhaNum required" maxlength="100">
				</div>
				<div class="form-group">
					<label class="control-label">Description</label>
					<input type="text" name="desc" id="desc_sys" class="form-control _CalPhaNum required" maxlength="100">
				</div>
				<div class="form-group">
					<label class="control-label">Site Status</label>
					<select class="form-control required" name="status" id="status_sys">
						<option value="1">Active</option>
						<option value="0">Non-Active</option>
					</select>
				</div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
               <button type="button" id="btn_edit_system" class="btn btn-sm btn-danger">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-' });
		$(".select2").select2({ placeholder: "Choose", allowClear: true });
		$('#link-master_system').addClass('active');
		$('#modal-add-system').on('hidden.bs.modal',function(e){ $(this).find("input,textarea").val('').end(); $(".select2").val([]).trigger('change');})
		var table = $('#table_system').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"dom" : 'Bfrtip',
			"buttons" : ['pageLength'],
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>dtable/system/<?=$this->uri->segment(3)?>',
				"type" : 'POST',
				error: function(data){swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table.ajax.reload();});},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "code", "className": "text-center", "orderable": false},
				{ "data": "name", "className": "text-left", "orderable": false },
				{ "data": "desc", "className": "text-left", "orderable": false },
				{ "data": "status", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "detail", "className": "text-center", "searchable": false, "orderable": false }
			]
		});
		$('#btn_add_system').click(function(){
	    	var formData = $("#form-add-system").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-add-system").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('There was an error filling the data, please check again.');
				return false;
			} else {
				$.post("<?=site_url();?>sadd/system/<?=$this->uri->segment(3)?>",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-add-system').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else if(data == "unauthority"){
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>You do not have access!',type: "",confirmButtonText: 'Okay',});
					} else if(data == "registered"){
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Data already registered!',type: "",confirmButtonText: 'Okay',});
					} else {
						$('#modal-add-system').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
					}
				});	
			}
	    });
	    $('#btn_edit_system').click(function(){
	    	var formData = $("#form-edit-system").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-edit-system").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('There was an error filling the data, please check again.');
				return false;
			} else {
				$.post("<?=site_url();?>sedd/system/<?=$this->uri->segment(3)?>",
				formData,
				function(data){
					if(data == "Success"){
						$('#modal-edit-system').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else if(data == "unauthority"){
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>You do not have access!',type: "",confirmButtonText: 'Okay',});
					} else {
						$('#modal-edit-system').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
					}
				});	
			}
	    });
	    $('#modal-edit-system').on('show.bs.modal', function (event) {
         	if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget) 
				var id     = button.data('id')
				var code   = button.data('code')
				var name   = button.data('name')
				var desc   = button.data('desc')
				var active = button.data('active')
				var modal  = $(this)
	            modal.find('#id_system').val(id)
	            modal.find('#code_sys').val(code)
	            modal.find('#name_sys').val(name)
	            modal.find('#desc_sys').val(desc)
	            modal.find('#status_sys').val(active).trigger('change')
         	}
      	});
	});
	function removeData(id, name){
	    swal({
	        title: "",html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Deactivated this system (<b>'+name+'</b>).',
	        type: "",showCancelButton: true,focusConfirm: false,confirmButtonText: 'Okay, Deactivated',confirmButtonAriaLabel: 'Ok',cancelButtonText: '<i class="fas fa-times"></i>',cancelButtonAriaLabel: 'Cancel'
	    }).then((result) => {
			if (result.value){
			    $.ajax({
					url: "<?=site_url()?>sdel/system/<?=$this->uri->segment(3)?>",
					type: "post",
					data: { id:id, name:name },
					success:function(data){
						if(data == "Success"){
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data successfully deactivated.',type: "",confirmButtonText: 'Okay',
						    }).then(function(){$('#table_system').DataTable().ajax.reload();});
						} else {
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to delete. Reload this page and try again.',type: "",confirmButtonText: 'Okay'});
						}
					},
				});
			}
	    });
	}
</script>