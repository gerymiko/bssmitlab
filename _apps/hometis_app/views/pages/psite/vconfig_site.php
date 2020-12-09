<section class="content-header">
   	<h1>Master Site <small class="text-blue">Configuration</small></h1>
</section>
<section class="content">
	<div class="box no-radius">
		<div class="box-header no-border">
			<h3 class="box-title">List Site</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-site">Add Site</button>
			</div>
		</div>
		<div class="box-body">
			<table id="table_site_config" class="table table-bordered table-hover nowrap" width="100%" style="color: #262D37;">
				<thead class="bg-cgray">
					<tr>
						<th>#</th>
						<th>Site Code</th>
						<th class="text-center">Site Name</th>
						<th>Status</th>
						<th><i class="fas fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="modal-add-site">
   <div class="modal-dialog center" role="document">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-black">Add Site</h4>
         </div>
         <form id="form-add-site" method="post" action="#">
            <div class="modal-body">
				<div class="form-group">
					<label class="control-label">Site Code</label>
					<select name="code" id="code" class="form-control select2 required">
						<option></option>
						<?php
							foreach ($list_site as $row){
								echo '<option value="'.$row->KodeST.'">'.$row->Nama.' ['.$row->KodeST.']</option>';
							}
						?>
					</select>
				</div>
				<input type="hidden" class="form-control _CalPhaNum required" name="name" id="name" maxlength="100">
				<div class="form-group">
					<label class="control-label">Site Status</label>
					<select class="form-control required" name="status">
						<option value="1">Active</option>
						<option value="0">Non-Active</option>
					</select>
				</div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
               <button type="button" id="btn_add_site" class="btn btn-sm btn-danger">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-site">
   <div class="modal-dialog center" role="document">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-black">Edit Site</h4>
         </div>
         <form id="form-edit-site" method="post" action="#">
         	<input type="hidden" name="id_site" id="id_site">
            <div class="modal-body">
            	<div class="form-group">
            		<label class="control-label">Site Name</label>
					<input type="text" class="form-control _CalPhaNum required" name="site_name" id="site_name" maxlength="100">
				</div>
				<div class="form-group">
            		<label class="control-label">Site Code</label>
					<input type="text" class="form-control _CalPhaNum required" name="site_code" id="site_code" maxlength="10">
				</div>
				<div class="form-group">
					<label class="control-label">Site Status</label>
					<select class="form-control required" name="site_status" id="site_status">
						<option value="1">Active</option>
						<option value="0">Non-Active</option>
					</select>
				</div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
               <button type="button" id="btn_edit_site" class="btn btn-sm btn-danger">Save</button>
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
		$('#link-master_site').addClass('active');
		$('#code').change(function() {
         	var opt = $(this).val();
			$.ajax({
				type: "POST",
				url: "<?=site_url()?>get/site_name/<?=$this->uri->segment(3)?>",
				data: {opt:opt},
				success:function(data){ $("#name").val(data); }
			});
      	});
      	$('#modal-add-site').on('hidden.bs.modal',function(e){
	        $(this)
	        $(".select2").val([]).trigger('change');
	    });
		var tableSite = $('#table_site_config').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"dom" : 'Bfrtip',
			"buttons" : ['pageLength'],
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>dtable/site/<?=$this->uri->segment(3)?>',
				"type" : 'POST',
				error: function(data){swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){tableSite.ajax.reload();});},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "code", "className": "text-center", "orderable": false},
				{ "data": "name", "className": "text-left", "orderable": false },
				{ "data": "status", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "detail", "className": "text-center", "searchable": false, "orderable": false }
			]
		});
		$('#btn_add_site').click(function(){
	    	var formData = $("#form-add-site").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-add-site").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('There was an error filling the data, please check again.');
				return false;
			} else {
				$.post("<?=site_url();?>sadd/site/<?=$this->uri->segment(3)?>",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-add-site').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>The site was successfully registered.',type: "",confirmButtonText: 'Okay',});
						tableSite.ajax.reload();
					} else if(data == "registered") {
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>The site already registered!',type: "",confirmButtonText: 'Okay',});
					} else {
						$('#modal-add-site').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
						tableSite.ajax.reload();
					}
				});	
			}
	    });
	    $('#btn_edit_site').click(function(){
	    	var formData = $("#form-edit-site").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-edit-site").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('There was an error filling the data, please check again.');
				return false;
			} else {
				$.post("<?=site_url();?>sedd/site/<?=$this->uri->segment(3)?>",
				formData,
				function(data){
					if(data == "Success"){
						$('#modal-edit-site').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>The site was successfully registered.',type: "",confirmButtonText: 'Okay',});
						tableSite.ajax.reload();
					} else {
						$('#modal-edit-site').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
					}
				});	
			}
	    });
	    $('#modal-edit-site').on('show.bs.modal', function (event) {
         	if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget) 
				var id     = button.data('id')
				var name   = button.data('name')
				var code   = button.data('code')
				var active = button.data('active')
				var modal  = $(this)
	            modal.find('#id_site').val(id)
	            modal.find('#site_name').val(name)
	            modal.find('#site_code').val(code)
	            modal.find('#site_status').val(active).trigger('change')
         	}
      	});
	});
	function removeData(id, name){
	    swal({
	        title: "",
	        html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Deactivated this site (<b>'+name+'</b>).',
	        type: "",
	        showCancelButton: true,
			focusConfirm: false,
			confirmButtonText: 'Okay, Deactivated',
			confirmButtonAriaLabel: 'Ok',
			cancelButtonText: '<i class="fas fa-times"></i>',
			cancelButtonAriaLabel: 'Cancel',
	    }).then((result) => {
			if (result.value){
			    $.ajax({
					url: "<?=site_url()?>sdel/site/<?=$this->uri->segment(3)?>",
					type: "post",
					data: { id:id, name:name },
					success:function(data){
						if(data == "Success"){
							swal({
						        title: "",
						        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data successfully deleted.',
						        type: "",
						        confirmButtonText: 'Okay',
						    }).then(function(){
								$('#table_site_config').DataTable().ajax.reload();
							});
						} else {
							swal({
						        title: "",
						        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to delete. Reload this page and try again.',
						        type: "",
						        confirmButtonText: 'Okay',
						    });
						}
					},
				});
			}
	    });
	}
</script>