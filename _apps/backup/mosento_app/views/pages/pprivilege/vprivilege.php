<section class="content-header">
   	<h1>Privilege<small>Access configuration</small></h1>
   	<ol class="breadcrumb">
      	<li><a href="<?=site_url()?>dashboard">Home</a></li>
      	<li class="active">Privilege</li>
   	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-bluecrown-light"><i class="fas fa-user-shield"></i></span>
				<div class="info-box-content">
					<span class="info-box-text text-black">Total<br> Administrator</span>
					<span class="info-box-number"><?=$count_admin;?></span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-bluecrown-light"><i class="fas fa-user-friends"></i></span>
				<div class="info-box-content">
					<span class="info-box-text text-black">Total<br> Public User</span>
					<span class="info-box-number"><?=$count_user;?></span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-bluecrown-light"><i class="fas fa-users"></i></span>
				<div class="info-box-content">
					<span class="info-box-text text-black">Total<br> User</span>
					<span class="info-box-number"><?=$count_all_user;?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">List User</h3>
			<div class="box-tools pull-right">
				<?php
					if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2) {
						echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-user">Add User</button>';
					} else {
						echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
					}
				?>
				
			</div>
		</div>
		<div class="box-body">
			<table id="table_privilege" class="table table-bordered table-hover nowrap" width="100%">
				<thead class="bg-dark-gray">
					<tr>
						<th>#</th>
						<th>NIK</th>
						<th class="text-center">Fullname</th>
						<th class="text-center">Email</th>
						<th>Type</th>
						<th>Username</th>
						<th>Last Login</th>
						<th>Status</th>
						<th><i class="fas fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>

<?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2) { ?>
<div class="modal" id="modal-add-user">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Add User</h4>
			</div>
			<form id="form-add-user" action="#" method="post">
				<input type="hidden" name="code" id="code">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label">Level Access</label>
						<select class="form-control" name="level" id="level">
							<option value="0">Choose</option>
							<?php
								foreach ($level as $row) {
									echo '<option value="'.$row->id_level.'">'.$row->level_name.'</option>';
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Employee Name</label>
						<select name="users_id" id="users_id" class="form-control required" maxlength="100">
							<option></option>
                            <?php
                            	foreach ($list_employee as $row) {
                            		echo '<option value="'.$row->NIK.'">'.$row->Nama.' ('.$row->jabatan.')</option>';
                            	}
                            ?>
                        </select>
                        <div class="load-bar loaduser" style="display: none;"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>
					</div>
					<span id="availability-admin" class="text-red" style="display: none;">User has been registered.</span>

					<div id="bssID"></div>

					<div class="form-group">
						Note :
						<ol>
							<li>NIK will be used as a standard username and password.</li>
							<li>E-mails and mobile numbers are <b>important</b> to reset passwords when the user forgets the password.</li>
						</ol>
					</div>
	            </div>
	            <div class="modal-footer">
					<button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Cancel</button>
					<button type="button" id="btn_add" class="btn btn-sm btn-primary">Save</button>
	            </div>	
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-edit-users">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Edit User</h4>
			</div>
			<form id="form-edit-user" action="#" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Level Access</label>
								<select class="form-control required" name="level_edit" id="level_edit">
									<option>Choose</option>
									<?php
										foreach ($level as $row) {
											echo '<option value="'.$row->id_level.'">'.$row->level_name.'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">Employee NIK</label>
								<input type="text" name="nik_edit" id="nik_edit" class="form-control required" readonly>
							</div>
							<div class="form-group">
								<label class="control-label">Employee Name</label>
								<input type="text" name="name_edit" id="name_edit" class="form-control required" readonly>
							</div>
							<div class="form-group">
								<label class="control-label">Status</label>
								<select class="form-control required" name="status_edit" id="status_edit">
									<option value="1">Active</option>
									<option value="0">Deactivated</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="email" name="email_edit" id="email_edit" class="form-control mails required" maxlength="100">
							</div>
							<div class="form-group">
								<label class="control-label">Phone Number</label>
								<input type="text" name="mobile_edit" id="mobile_edit" class="form-control num required" maxlength="15">
							</div>
							<div class="form-group">
								<label class="control-label">Username</label>
								<input type="text" name="username_edit" id="username_edit" class="form-control required" readonly>
							</div>
							<div class="form-group">
								<label class="control-label">New Password</label>
								<input type="text" name="password_edit" id="password_edit" class="form-control" maxlength="20">
								<span><em>*Leave blank if you don't want to change the password.</em></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						Note :
						<ol>
							<li>Use <b>only a combination of numbers and letters</b> for passwords</li>
							<li>E-mails and mobile numbers are <b>important</b> to reset passwords when the user forgets the password.</li>
						</ol>
					</div>
	            </div>
	            <div class="modal-footer">
					<button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Cancel</button>
					<button type="button" id="btn_edit" class="btn btn-sm btn-primary">Save</button>
	            </div>	
			</form>
		</div>
	</div>
</div>
<?php } ?>

<script type="text/javascript">
   	$(document).ready(function (){
		$("#users_id").select2({ placeholder: "Choose", allowClear: true });
		$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});
		$('.mails').alphanum({ allow: '@-_. '});
		
	   	var table = $('#table_privilege').DataTable({
	   		"processing": true,
	   		"serverSide": true,
	   		"responsive": true,
	   		"scrollX": true,
	   		"order":[],
	   		"ajax": {
	   			"url": '<?=site_url()?>privilege/t_privilege',
	   			"type": 'POST',
	   			error: function(data) {
					swal({
						animation: false,
						focusConfirm: false,
						text: "Failed to pull data. Click OK to get data"}).then(function(){ 
							table.ajax.reload();
						}
					);
	   			},
	   		},
	   		"language": { 
	   			"processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>',
	   		},
	   		"columns": [
		   		{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
		   		{ "data": "nik", "className": "text-center", "orderable": false },
		   		{ "data": "nama", "className": "text-left", "orderable": false },
		   		{ "data": "email", "className": "text-left", "orderable": false },
		   		{ "data": "type", "className": "text-center", "orderable": false  },
		   		{ "data": "username", "className": "text-center", "orderable": false  },
		   		{ "data": "last_login", "className": "text-center", "orderable": false  },
		   		{ "data": "status", "className": "text-center", "orderable": false  },
		   		{ "data": "action", "className": "text-center", "orderable": false  },
	   		]
	   	});

	   	$('#users_id').change(function() {
    		var opt = $(this).val();
    		$.ajax({
    			type: "POST",
    			url: "<?=site_url()?>privilege/getDataEm",
    			data: {opt:opt},
    			success:function(data){ $("#bssID").html(data); }
    		});
    	});

    	$('#users_id').change(function(){
	        $(".loaduser").show();
	        $.ajax({
				type : "POST",
				url  : "<?=site_url()?>privilege/checkData",
				cache: false,    
		        data:'users_id=' + $("#users_id").val(),
		        success: function(response){
		            try {
		                if(response == "false"){
		                	$(".loaduser").hide();
		                	$("#btn_add").addClass('hidden');
		                    $("#availability-admin").show();
		                } else {
		                	$(".loaduser").hide();
		                	$("#availability-admin").hide();
		                }         
		            } catch(e) { alert('Exception while request..'); }  
		        },
		        error: function(){ alert('Error while request..'); }
		    });
	    });

	    $('#btn_add').click(function(){
	    	var formData = $("#form-add-user").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-add-user").valid() == false){
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=site_url();?>privilege/s_addUser",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-add-user').modal('toggle');
						$("#loading").addClass("hidden");
						swal("Yeay!", "The user was successfully registered", "success");
						table.ajax.reload();
					} else if(data == "registered") {
						$('#modal-add-user').modal('toggle');
						$("#loading").addClass("hidden");
						swal("Attention", "User already registered!", "warning");
						table.ajax.reload();
					} else {
						$('#modal-add-user').modal('toggle');
						$("#loading").addClass("hidden");
						swal("Oops", "Failed to save data, an error occurred, reload this page and try again.", "error");
						table.ajax.reload();
					}
				});	
			}
	    });

	    $('#btn_edit').click(function(){
	    	$("#loading").removeClass("hidden");
	    	var formData = $("#form-edit-user").serialize();
			if($("#form-edit-user").valid() == false){
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=site_url();?>privilege/s_editUser",
				formData,
				function(data) {
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-users').modal('toggle');
						swal("Yeay!", "The data was successfully changed", "success");
						table.ajax.reload();
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-users').modal('toggle');
						swal("Oops", "Failed to save data, an error occurred, reload this page and try again.", "error");
						table.ajax.reload();
					}
				});	
			}
	    });

	    $('#modal-edit-users').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget) 
				var nik    = button.data('nik')
				var nama   = button.data('nama')
				var email  = button.data('email')
				var user   = button.data('user')
				var status = button.data('status')
				var level  = button.data('level')
				var mobile = button.data('mobile')
				var modal  = $(this)
				modal.find('.modal-title').text('Edit User : ' + nik)
				modal.find('#nik_edit').val(nik)
				modal.find('#name_edit').val(nama)
				modal.find('#email_edit').val(email)
				modal.find('#username_edit').val(user)
				modal.find('#mobile_edit').val(mobile)
				modal.find('#level_edit').val(level).trigger('change')
				modal.find('#status_edit').val(status).trigger('change')
			}
		});
	});
</script>
