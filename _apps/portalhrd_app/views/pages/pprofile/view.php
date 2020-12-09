<section class="content-header" id="header-content">
	<h1>
		<span class="label no-padding text-black">Profil Saya</span> 
	</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-4">
        	<div class="box box-widget widget-user">
        		<div class="widget-user-header bg-white">
        			<h3 class="widget-user-username"><?=$user->users_fullname?></h3>
        			<h5 class="widget-user-desc"><?=$user->jabatan?></h5>
        		</div>
        		<div class="widget-user-image">
        			<img class="img-circle" src="<?=site_url();?>getimage/png/user" alt="User Avatar">
        		</div>
        		<div class="box-footer">
        			<div class="row">
        				<div class="col-sm-12">
        					<div class="description-block">
        						<h5 class="description-header"><?php if($user->level_id == 1 ){ echo 'Super Administrator'; } elseif ($user->level_id == 2) { echo 'Administrator'; } else { echo 'Public User'; }?></h5>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="col-md-8">
        	<div class="box no-radius">
        		<form role="form" class="form-horizontal">
        			<div class="box-body"><br><br>
        				<form id="form-data">
	        				<div class="col-md-4">
								<div class="form-group">
									<label class="col-sm-4" style="text-align: left;">NIK</label>
									<label class="col-sm-8" style="text-align: left;"><div id="nik_ajx"></div></label>
								</div>
								<div class="form-group">
									<label class="col-sm-4" style="text-align: left;">Site</label>
									<label class="col-sm-8" style="text-align: left;"><div id="site_ajx"></div></label>
								</div>
	        				</div>
	        				<div class="col-md-8">
	        					<div class="form-group">
									<label class="col-sm-4" style="text-align: left;">Email</label>
									<label class="col-sm-8" style="text-align: left;"><div id="email_ajx"></div></label>
								</div>
								<div class="form-group">
									<label class="col-sm-4" style="text-align: left;">Mobile</label>
									<label class="col-sm-8" style="text-align: left;"><div id="phone_ajx"></div></label>
								</div>
	        				</div>
	        			</form>
        			</div>
        			<div class="box-footer no-border">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit-password" data-backdrop="static" data-keyboard="false">Ganti Password</button>
						<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#modal-edit-data" data-backdrop="static" data-keyboard="false">Ubah Data</button>
        			</div>
        		</form>
        	</div>
        </div>
    </div>
</section>
<div class="modal" id="modal-edit-password">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ganti Password</h4>
			</div>
			<form id="form-edit-password" action="#" method="post">
				<input type="hidden" name="nik" id="nik" value="<?=$user->bssID;?>">
				<div class="modal-body">
					<div class="form-group old">
						<label class="control-label">Password Lama</label>
						<input type="text" name="old_password" id="old_password" class="form-control required" aria-required="true" aria-invalid="true" maxlength="25">
						<span id="passmatch"></span>
						<div class="load-bar hidden"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>
					</div>
					<div class="form-group">
						<label class="control-label">Password Baru</label>
						<div class="input-group">
							<input type="password" class="form-control _CalPhaNum required" name="new_password" id="new_password" placeholder="Password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25">
							<span class="input-group-btn">
								<button type="button" class="btn bg-default btn-flat" id="btn-show-pass"><i id="btn-icon" class="far fa-eye-slash"></i></button>
							</span>
						</div>
						<span>* Hanya kombinasi <b>angka dan alfabet</b> untuk kata sandi!</span>
						<label for="new_password" generated="true" class="error"></label>
					</div>
					<div class="form-group">
						<label class="control-label">Ketik Ulang Password</label>
						<div class="input-group">
							<input type="password" class="form-control _CalPhaNum required" name="repassword" id="repassword" placeholder="Re-password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25">
							<span class="input-group-btn">
								<button type="button" class="btn bg-default btn-flat" id="btn-show-repass"><i id="rebtn-icon" class="far fa-eye-slash"></i></button>
							</span>
						</div>
						<label for="repassword" generated="true" class="error"></label>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i></button>
					<button type="button" id="btn_edit_pass" class="btn btn-primary">Simpan</button>
				</div>   
			</form>
		</div>
	</div>
</div>
<div class="modal" id="modal-edit-data">
	<div class="modal-dialog modal70">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Data</h4>
			</div>
			<form id="form-edit-data" action="#" method="post">
				<input type="hidden" name="nik_data" id="nik_data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="text" name="email" id="email_data" class="form-control required" maxlength="50">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nomor Ponsel</label>
								<input type="text" name="phone" id="phone_data" class="form-control _CnUmB required" maxlength="15">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i></button>
					<button type="button" id="btn_edit_data" class="btn btn-primary">Simpan</button>
				</div>   
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$("#profile").addClass("active");
		$('._CalPhaNum').alphanum({ allowNumeric: true });
      	$('._CnUmB').numeric({allowThouSep: false,   allowDecSep: false, allowPlus: false, allowMinus: false});
      	$('#old_password').blur(checkOldPassword);
		$("#btn-show-pass").click(function () {
			if ($("#new_password").attr("type") == "password") { $("#new_password").attr("type", "text");$("#btn-icon").removeClass("fa-eye-slash");$("#btn-icon").addClass("fa-eye");
			} else { $("#new_password").attr("type", "password");$("#btn-icon").removeClass("fa-eye");$("#btn-icon").addClass("fa-eye-slash") }
		});
		$("#btn-show-repass").click(function () {
			if ($("#repassword").attr("type") == "password") { $("#repassword").attr("type", "text");$("#rebtn-icon").removeClass("fa-eye-slash");$("#rebtn-icon").addClass("fa-eye");
			} else { $("#repassword").attr("type", "password");$("#rebtn-icon").removeClass("fa-eye");$("#rebtn-icon").addClass("fa-eye-slash")}
		});
		$('#form-edit-password').validate({
			rules: { old_password: "required",new_password: "required",repassword: "required",repassword: { equalTo: "#new_password" }},
			messages: { old_password: "Enter your old password.",new_password: "Enter your new password.",repassword: "The password does not match."}
		});
		$('#form-edit-data').validate({ rules: { phone: { required: true, number: true }, email: { required: true, email : true }}});
		$('#modal-edit-passwordl').on('hidden.bs.modal', function (e) { $(this).find("input").val('').end(); });
		$('#btn_edit_pass').click(function(){
			$("#loading").removeClass("hidden");
			var formData = $("#form-edit-password").serialize();
			if($("#form-edit-password").valid() == false){
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=site_url('sedd/password')?>",
				formData,
				function(data) {
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-password').modal('toggle');
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Password berhasil diubah. Anda harus melakukan login kembali.',type: "",confirmButtonText: 'Okay', allowOutsideClick: false }).then(function() { window.location.href = 'https://web.binasaranasukses.com/hrdrekrutmen/m/logivalja'; });
					} else if(data == "same") {
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>Gunakan password yang berbeda dari sebelumnya.',type: "",confirmButtonText: 'Okay',});
					} else if(data == "notsecure") {
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>Gunakan kombinasi huruf dan angka.',type: "",confirmButtonText: 'Okay',});
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-password').modal('toggle');
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan data, terjadi kesalahan, muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
					}
				});   
			}
		});
		$('#btn_edit_data').click(function(){
			$("#loading").removeClass("hidden");
			var formData = $("#form-edit-data").serialize();
			if($("#form-edit-data").valid() == false){
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=site_url('sedd/profile')?>",
				formData,
				function(data) {
					if(data == "Success"){
						getContentData();
						$("#loading").addClass("hidden");
						$('#modal-edit-data').modal('toggle');
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data was successfully changed.',type: "",confirmButtonText: 'Okay',});
					} else if(data == "nochange") {
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>No data changes.',type: "",confirmButtonText: 'Okay',});
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-data').modal('toggle');
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
					}
				});
			}
		});
	});
	function checkOldPassword(){
		$('.load-bar').removeClass('hidden');
		var old_password = $('#old_password').val(), nik = $('#nik').val();
		$.ajax({
			type: "POST",
			url: "<?=site_url('get/oldpassword')?>",
			cache: false,
			data: { old_password:old_password, nik:nik },
			success: function(response){ 
				$('.load-bar').addClass('hidden');
				try {
					if(response == "false"){ $('.old').first().removeClass("has-success");$('.old').first().addClass("has-error");$('#passmatch').show();$('#passmatch').html('Kata sandi yang Anda masukkan tidak sama dengan yang terdaftar').css('color', 'red');
					} else { $('.old').first().removeClass("has-error");$('#passmatch').hide();$('.old').first().addClass("has-success");}       
				} catch(e) { 
					swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Terjadi kesalahan sistem, segarkan halaman ini atau periksa koneksi internet Anda.',type: "",confirmButtonText: 'Okay',});
				}  
			}
		});
	}
 	window.onload = function() { getContentData(); };
    function getContentData(){
	    $.ajax({
            url: "<?=site_url('profile/getUserData/').$this->my_encryption->encode($user->bssID)?>",
            dataType: "json", cache: false,
            success: function(data) {
            	$('#nik_ajx').html(data[0].nik);$('#site_ajx').html(data[0].site);$('#email_ajx').html(data[0].email);$('#phone_ajx').html(data[0].phone);$('#nik_data').val(data[0].nik);$('#email_data').val(data[0].email);$('#phone_data').val(data[0].phone);
	        }
        });              
    }
</script>