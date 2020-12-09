<section class="content-header">
   <h4>Master User &amp; Hak Akses</h4>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"></h3>
			<div class="box-tools pull-right">
				<?php
					if ($accessRights->id_level == 1 || $accessRights->id_level == 2) {
						echo '<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-add-user"><i class="fas fa-user-plus"></i></button> <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-moduser">+ Akses</button>';
					} else {
						echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
					}
				?>
			</div>
		</div>
		<div class="box-body">
			<table id="table_user" class="table table-border table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>NIK</th>
						<th class="text-center">Nama Lengkap</th>
						<th>Tipe</th>
						<th>Masuk Terakhir</th>
						<th>Status</th>
						<th>Akses</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="modal-module">
	<div class="modal-dialog modal700" role="document">
		<div class="modal-content">
			<div class="modal-header no-border">
				<h4 class="modal-title text-black">Module Granted</h4>
			</div>
			<form id="form-module" method="post" action="#">
				<input type="hidden" name="id_user" id="id_user">
				<div class="modal-body">
					<p class="text-black">Please select an accessible module for this user.</p>
					<div class="load-bar loaduser" style="display: none;"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>
					<div id="modulex"></div>
				</div>
				<div class="modal-footer no-border">
					<button type="button" data-dismiss="modal" class="btn btn-default"><i class="fas fa-times"></i></button>
					<button type="button" id="btn_module" class="btn bg-yellow">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-add-moduser">
	<div class="modal-dialog modal700" role="document">
		<div class="modal-content">
			<div class="modal-header no-border">
				<h4 class="modal-title text-black">Add Module User</h4>
			</div>
			<form id="form-add-moduser" method="post" action="#">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label">User Name</label>
						<select name="id_user" id="id_user_mod" class="form-control select2 required">
							<option></option>
							<?php
								foreach ($list_user as $row) {
									echo '<option value="'.$this->my_encryption->encode($row->id_user).'">'.$row->fullname.' ('.$row->nik.')</option>';
								}
							?>
						</select>
						<div class="load-bar loaduser" style="display: none;"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>
					</div>
					<p class="text-black">Please select an accessible module for this user.</p>
					<div id="moduleUser"></div>
				</div>
				<div class="modal-footer no-border">
					<button type="button" data-dismiss="modal" class="btn btn-default"><i class="fas fa-times"></i></button>
					<button type="button" id="btn_add_moduser" class="btn bg-yellow">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-add-user">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header no-border">
				<h4 class="modal-title text-black">Tambah User</h4>
			</div>
			<form id="form-add-user" method="post" action="#">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label">Level User</label>
						<select class="form-control select2 required" name="level" id="level_add">
							<option></option>
							<?php
								if ($accessRights->id_level == 1){
									foreach ($list_level as $row){
										echo '<option value="'.$row->id_level.'">'.$row->name.'</option>';
									}
								} else {
									foreach ($list_level as $row){
										if ($row->id_level != 1) {
											echo '<option value="'.$row->id_level.'">'.$row->name.'</option>';
										}
									}
								}
							?>
						</select>
					</div>
					<div style="padding: 15px;"></div>
					<div class="form-group">
						<label class="control-label">Nama Karyawan</label>
						<select name="nik" id="nik_add" class="form-control select2 required" maxlength="100">
							<option></option>
							<?php
								foreach ($list_employee as $row) {
									echo '<option value="'.$row->NIK.'">'.$row->Nama.' ('.$row->jabatan.')</option>';
								}
							?>
						</select>
						<div class="load-bar loademployee" style="display: none;"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>
					</div>
					<span id="availability-admin" class="text-red" style="display: none;">User has been registered.</span>
					<div id="bssID"></div>
					<div class="form-group">
						Note : E-mail dan nomor ponsel penting untuk mengatur ulang kata sandi ketika pengguna lupa kata sandi.
					</div>
				</div>
				<div class="modal-footer no-border">
					<button type="button" data-dismiss="modal" class="btn btn-default"><i class="fas fa-times"></i></button>
					<button type="button" id="btn_add_user" class="btn bg-yellow">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-user">
	<div class="modal-dialog modal700" role="document">
		<div class="modal-content">
			<div class="modal-header no-border">
				<h4 class="modal-title text-black">Ubah Data User</h4>
			</div>
			<form id="form-edit-user" method="post" action="#">
				<input type="hidden" name="id_user" id="id_user_edit">
				<input type="hidden" name="nik" id="nik">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<?php if ($accessRights->id_level == 1) { ?>
								<div class="form-group">
									<label class="control-label">Level User</label>
									<select class="form-control select2 required" name="level" id="level">
										<?php
											foreach ($list_level as $row) {
												echo '<option value="'.$row->id_level.'">'.$row->name.'</option>';
											}
										?>
									</select>
								</div>
							<?php } ?>
							<div style="padding: 17px"></div>
							<div class="form-group">
								<label class="control-label">Nama Karyawan</label>
								<input type="text" name="fullname" id="fullname" class="form-control _CalPhaNum required" maxlength="150">
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="email" name="email" id="email" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Kata Sandi Baru</label>
								<input type="text" name="new_password" id="new_password" class="form-control _CalPhaNum" maxlength="50">
								<span>* Leave <b>BLANK</b> if you don't want to change password.</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nomor HP</label>
								<input type="text" name="mobile" id="mobile" class="form-control _CnUmB required" maxlength="15">
							</div>
							<div class="form-group">
								<label class="control-label">NIK</label>
								<input type="text" name="nik_edit" id="nik_edit" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Status Aktif</label>
								<select class="form-control required" name="active" id="active">
									<option value="1">Aktif</option>
									<option value="0">Tidak Aktif</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						Note :
						<ol>
							<li>E-mail dan nomor ponsel penting untuk mengatur ulang kata sandi ketika pengguna lupa kata sandi.</li>
							<li>Mohon gunakan hanya kombinasi HURUF dan ANGKA untuk kata sandi.</li>
						</ol>
					</div>
				</div>
				<div class="modal-footer no-border">
					<button type="button" data-dismiss="modal" class="btn btn-default"><i class="fas fa-times"></i></button>
					<button type="button" id="btn_edit_user" class="btn bg-yellow">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('#master-treeview, #link_master_user').addClass('active');
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-@' });
      	$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
      	$('.select2').select2({ placeholder: 'Choose', allowClear: true });
		var table = $('#table_user').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "scrollX": true,
            "order": [],
            "ajax": {
                "url": '<?=site_url('user/t_user/').$accessRights->site?>',
                "type": 'POST',
                data : function(data) { data.date_range = $("#date_range").val(); },
                error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table.ajax.reload();});}
            },
            "language": { "processing": bar },
            "columns": [
                { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
		   		{ "data": "nik", "className": "text-center", "orderable": false },
		   		{ "data": "nama", "className": "text-left", "orderable": false },
		   		{ "data": "type", "className": "text-center", "orderable": false },
		   		{ "data": "last_login", "className": "text-center", "orderable": false },
		   		{ "data": "status", "className": "text-center", "orderable": false },
		   		{ "data": "module", "className": "text-center", "orderable": false },
		   		{ "data": "action", "className": "text-center", "orderable": false }
            ],
        });
		$('#modal-module').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button  = $(event.relatedTarget) 
				var id_user = button.data('id_user')
				var nik     = button.data('nik')
				var modal   = $(this)
				modal.find('.modal-title').text('Module Granted : '+nik)
				modal.find('#id_user').val(id_user)
			}
		});
		$('#modal-edit-user').on('show.bs.modal', function (event) {
         if (event.namespace == 'bs.modal') {
            var button   = $(event.relatedTarget) 
            var id_user  = button.data('id_user')
            var level    = button.data('level')
            var nik      = button.data('nik')
            var fullname = button.data('fullname')
            var mobile   = button.data('mobile')
            var username = button.data('username')
            var email    = button.data('email')
            var active   = button.data('active')
            var modal    = $(this)
            modal.find('#id_user_edit').val(id_user)
            modal.find('#nik').val(nik)
            modal.find('#fullname').val(fullname)
            modal.find('#mobile').val(mobile)
            modal.find('#username').val(username)
            modal.find('#email').val(email)
            modal.find('#level').val(level).trigger('change')
            modal.find('#active').val(active).trigger('change')
         }
      });
		$('#nik_add').change(function() {
			var opt = $(this).val();
			$.ajax({
				type: "POST",
				url: "<?=site_url('get/employee/').$accessRights->site?>",
				data: {opt:opt},
				success:function(data){ $("#bssID").html(data); }
			});
		});
		$('#nik_add').change(function(){
			$(".loademployee").show();
			$.ajax({
				type : "POST",
				url  : "<?=site_url('check/user/').$accessRights->site?>",
				cache: false,    
				data:'nik_add=' + $("#nik_add").val(),
				success: function(response){
					try {
						if(response == "false"){
							$(".loademployee").hide();$("#btn_add").addClass('hidden');$("#availability-admin").show();
						} else {
							$(".loademployee").hide();$("#availability-admin").hide();
						}         
					} catch(e) { alert('Exception while request..'); }  
				},
				error: function(){ alert('Error while request..'); }
			});
		});
		$('#id_user_mod').change(function(){
			$(".loaduser").show();
			var id = $(this).val();
			$.ajax({
				"type": "POST",
				"url": "<?=site_url('get/module_user/').$accessRights->site?>",
				"data": {"id":id},
				success:function(data){ $(".loaduser").hide();$("#moduleUser").html(data); }
			});
		});
		$('#modal-module').on('hidden.bs.modal',function(e){
			$(this)
			$("#modulex").html('');
		});
		$("#btn_module").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = JSON.stringify($("#form-module").serializeArray());
			if($("#form-module").valid() == false){
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.ajax({
					"type": "POST",
					"url": "<?=base_url('sedd/module_user/').$accessRights->site?>",
					"data": {"formdata":formdata},
					success:function(data){
						if(data == "Success"){
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',confirmButtonText: 'Okay'});
						} else {
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save. Reload this page and try again.',type: "",confirmButtonText: 'Okay'});
						}
					}
				});  
			}
		});
		$("#btn_add_user").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form-add-user").serialize();
			if($("#form-add-user").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('There was an error filling the data, please check again.');
				return false;
			} else {
				$.post("<?=site_url('sadd/user/').$accessRights->site?>",
				formdata,
				function(data) {
					if(data == "Success"){
						$('#modal-add-user').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>The user was successfully registered.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else if(data == "registered"){
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>The user already registered!',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else if(data == "unauthority"){
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Unauthority!',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else {
						$('#modal-add-user').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					}
				});
			}
		});
		$("#btn_edit_user").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form-edit-user").serialize();
			if($("#form-edit-user").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('There was an error filling the data, please check again.');
				return false;
			} else {
				$.post("<?=site_url('sedd/user/').$accessRights->site?>",
					formdata,
					function(data) {
						if(data == "Success"){
							$('#modal-edit-user').modal('toggle');
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data was successfully edited.',type: "",confirmButtonText: 'Okay',});
							table.ajax.reload();
						} else if(data == "unauthority"){
							$('#modal-edit-module').modal('toggle');
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
						} else if(data == "notsecure"){
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Password must use alphabet and number combination.',type: "",confirmButtonText: 'Okay',});
						} else {
							$('#modal-edit-user').modal('toggle');
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
							table.ajax.reload();
						}
					});
			}
		});
		$("#btn_add_moduser").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = JSON.stringify($("#form-add-moduser").serializeArray());
			if($("#form-add-moduser").valid() == false){
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.ajax({
					"type": "POST",
					"url": "<?=base_url('sedd/module_user/').$accessRights->site?>",
					"data": {"formdata":formdata},
					success:function(data){
						if(data == "Success"){
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',confirmButtonText: 'Okay'});
						} else {
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save. Reload this page and try again.',type: "",confirmButtonText: 'Okay'});
						}
					}
				});  
			}
		});
	});
	function getModule(id){
		$(".loaduser").show();
		$.ajax({
			"type": "POST",
			"url": "<?=site_url('get/module_user/').$accessRights->site?>",
			"data": {"id":id},
			success:function(data){ $(".loaduser").hide();$("#modulex").html(data);}
		});
	}
	function checkAccess(id){
		if( $('#'+id).is(':checked') ){
			$('#cb'+id+' input:checkbox').each(function(){ var ids = $(this).attr('id');$('#'+ids).prop('checked', true);$('#'+ids).removeAttr('disabled');});
		} else {
			$('#cb'+id+' input:checkbox').each(function(){var ids = $(this).attr('id');$('#'+ids).prop('checked', false);$('#'+ids).attr('disabled', 'disabled');});
		}
	}
</script>