<section class="content-header" id="header-content">
	<h1>
		<span class="label no-padding text-black">Master User</span> 
		<button type="button" data-tooltip="Tambah User" data-tooltip-location="left" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modal-add-user" data-backdrop="static" data-keyboard="false">
			<i class="fas fa-plus"></i>
		</button>
	</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body slide-content">
			<table id="table_user" class="table table-border table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>NIK</th>
						<th class="text-center">Nama</th>
						<th>Level</th>
						<th>Jabatan</th>
						<th>Status</th>
						<th>Akses Terakhir</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="modal-add-user">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-black">Tambah User</h4>
			</div>
			<form id="form-add-user" method="post" action="#">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label">Level User</label>
						<select class="form-control select2 required" name="level">
							<option></option>
							<?php
								if ($accessRights->level_id == 1){
									foreach ($list_level as $row){
										echo '<option value="'.$row->level_id.'">'.$row->level_name.'</option>';
									}
								} else {
									foreach ($list_level as $row){
										if ($row->level_id != 1 && $row->level_id != 2) {
											echo '<option value="'.$row->level_id.'">'.$row->level_name.'</option>';
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Nama User</label>
						<select class="form-control select2 required" name="nik" id="nik_add">
							<option></option>
							<?php
								foreach ($list_user as $row) {
									echo '<option value="'.$row->NIK.'">'.$row->Nama.' ('.$row->NIK.')</option>';
								}
							?>
						</select>
						<div class="load-bar loademployee" style="display: none;"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>
					</div>
					<span id="availability-admin" class="text-red" style="display: none;">User sudah terdaftar.</span>
					<div id="bssID"></div>
					<div class="form-group">
						<p>Catatan :
						<ol>
							<li>E-mail dan nomor ponsel penting untuk mengatur ulang kata sandi ketika pengguna lupa kata sandi.</li>
							<li>Username dan Password akan otomatis terkirim ke nomor ponsel pengguna yang didaftarkan.</li>
						</ol></p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default"><i class="fas fa-times"></i></button>
					<button type="button" id="btn_add_user" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-user">
	<div class="modal-dialog modal700" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-black">Ubah User</h4>
			</div>
			<form id="form-edit-user" method="post" action="#">
				<input type="hidden" name="users_id" id="users_id_edit">
				<input type="hidden" name="nik" id="nik">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<?php if ($accessRights->level_id == 1) { ?>
								<div class="form-group">
									<label class="control-label">Level User</label>
									<select class="form-control select2 required" name="level" id="level">
										<?php
											foreach ($list_level as $row) {
												echo '<option value="'.$row->level_id.'">'.$row->level_name.'</option>';
											}
										?>
									</select>
								</div>
							<?php } ?>
							<div class="form-group">
								<label class="control-label">Nama User</label>
								<input type="text" name="fullname" id="fullname" class="form-control _CalPhaNum required" maxlength="150" readonly>
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="email" name="email" id="email" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Password Baru</label>
								<input type="text" name="new_password" id="new_password" class="form-control _CalPhaNum" maxlength="50">
								<span>* <b> KOSONGKAN </b> jika anda tidak ingin merubah kata sandi.</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nomor Ponsel</label>
								<input type="text" name="mobile" id="mobile" class="form-control _CnUmB required" maxlength="15">
							</div>
							<div class="form-group">
								<label class="control-label">Username</label>
								<input type="text" name="username" id="username" class="form-control _CalPhaNum required" maxlength="50">
							</div>
							<div class="form-group">
								<label class="control-label">Status Aktif</label>
								<select class="form-control required" name="active" id="active">
									<option value="1">Aktif</option>
									<option value="0">Non-Aktif</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<p>Catatan :
						<ol>
							<li>E-mail dan nomor ponsel penting untuk mengatur ulang kata sandi ketika pengguna lupa kata sandi.</li>
							<li>Username dan Password akan otomatis terkirim ke nomor ponsel pengguna yang didaftarkan.</li>
						</ol></p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default"><i class="fas fa-times"></i></button>
					<button type="button" id="btn_edit_user" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
   	$(document).ready(function(){
      	$("#privilege").addClass("active");
      	$('.select2').select2({ placeholder: 'Pilih', allowClear: true });
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,@' });
		$('._CnUmB').numeric({allowThouSep: true,	allowDecSep: false, allowPlus: false, allowMinus: false });
      	var table = $('#table_user').DataTable({
			"processing": true,
			"serverSide": true,
			"stateSave": true,
			"order": [],
			"dom": 'Bfrtip',
	        "buttons": [ 'pageLength', { text: 'Reload', action: function (e, dt, node, config){ table.ajax.reload();}} ],
	        "lengthMenu": [[10, 25, 50, 100], ['10 Baris', '25 Baris', '50 Baris', '100 Baris']],
			"ajax": {
				"url": '<?=site_url()?>table/user',
				"type": 'POST',
				error: function(data){ swal({ title: "", html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.', type: "", confirmButtonText: 'Okay'}).then(function(){ table.ajax.reload(); });},
			},
			"language": { "processing": '<div class="loadings"><div class="spinner-wrapper"><span class="spinner-text">LOADING</span><span class="spinner"></span></div></div>' },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "nik", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "name", "className": "text-left", "orderable": false },
				{ "data": "level", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "position", "className": "text-center", "orderable": false },
				{ "data": "status", "className": "text-center", "orderable": false },
				{ "data": "lastlogin", "className": "text-center", "searchable": false },
				{ "data": "action", "className": "text-center", "orderable": false }
			],
		});
		$('#nik_add').change(function() {
			var opt = $(this).val();
			$.ajax({
				type: "POST",
				url: "<?=site_url('get/employee')?>",
				data: {opt:opt},
				success:function(data){ $("#bssID").html(data); }
			});
		});
		$('#nik_add').change(function(){
			$(".loademployee").show();
			$.ajax({
				type : "POST",
				url  : "<?=site_url('check/user')?>",
				cache: false,    
				data:'nik_add=' + $("#nik_add").val(),
				success: function(response){
					try {
						if(response == "false"){
							$(".loademployee").hide();$("#btn_add").addClass('hidden');$("#availability-admin").show();
							$("#bssID").addClass("hidden");
						} else {
							$(".loademployee").hide();$("#availability-admin").hide();
							$("#bssID").removeClass("hidden");
						}         
					} catch(e) { alert('Exception while request..'); }  
				},
				error: function(){ alert('Error while request..'); }
			});
		});
		$('.modal').on('hidden.bs.modal', function (e) {
	        $(this)
	        .find("input,select,textarea").val('').end();$(".select2").val([]).trigger("change");
	    });
	    $("#btn_add_user").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form-add-user").serialize();
			if($("#form-add-user").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, periksa lagi.');
				return false;
			} else {
				$.post("<?=site_url('sadd/user')?>",
				formdata,
				function(data) {
					if(data == "Success"){
						$('#modal-add-user').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Pengguna berhasil terdaftar.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else if(data == "registered"){
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Pengguna sudah terdaftar!',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else {
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan data, terjadi kesalahan, muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
					}
				});
			}
		});
		$('#modal-edit-user').on('show.bs.modal', function (event) {
         	if (event.namespace == 'bs.modal') {
	            var button   = $(event.relatedTarget) 
	            var users_id  = button.data('users_id')
	            var level    = button.data('level')
	            var nik      = button.data('nik')
	            var fullname = button.data('fullname')
	            var mobile   = button.data('mobile')
	            var username = button.data('username')
	            var email    = button.data('email')
	            var active   = button.data('active')
	            var modal    = $(this)
	            modal.find('#users_id_edit').val(users_id)
	            modal.find('#nik').val(nik)
	            modal.find('#fullname').val(fullname)
	            modal.find('#mobile').val(mobile)
	            modal.find('#username').val(username)
	            modal.find('#email').val(email)
	            modal.find('#level').val(level).trigger('change')
	            modal.find('#active').val(active).trigger('change')
	    	}
      	});
      	$("#btn_edit_user").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form-edit-user").serialize();
			if($("#form-edit-user").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, periksa lagi.');
				return false;
			} else {
				$.post("<?=site_url('sedd/user')?>",
					formdata,
					function(data) {
						if(data == "Success"){
							$('#modal-edit-user').modal('toggle');
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil diubah.',type: "",confirmButtonText: 'Okay',});
							table.ajax.reload();
						} else if(data == "unauthority"){
							$('#modal-edit-module').modal('toggle');
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>Tidak punya otoritas.',type: "",confirmButtonText: 'Okay',});
						} else if(data == "notsecure"){
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Kata sandi harus menggunakan kombinasi alfabet dan angka.',type: "",confirmButtonText: 'Okay',});
						} else {
							$('#modal-edit-user').modal('toggle');
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan data, terjadi kesalahan, muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
							table.ajax.reload();
						}
					});
			}
		});
   	});
</script>