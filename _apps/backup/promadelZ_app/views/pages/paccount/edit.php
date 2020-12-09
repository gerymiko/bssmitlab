<form id="form-edit-account" action="#" method="#">
	<input type="hidden" id="id" name="id" value="<?=$this->my_encryption->encode($dserial->id_user)?>">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Nama Lengkap</label>
				<input type="text" name="fullname" placeholder="Nama Lengkap" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama Lengkap'" required="" class="form-control _CalPhaNum noradius required" value="<?=$dserial->fullname?>">
			</div>
			<div class="form-group">
				<label>No. HP</label>
				<input type="text" name="mobile" placeholder="No. HP" onfocus="this.placeholder = ''" onblur="this.placeholder = 'No. HP'" required="" class="form-control _CalPhaNum required noradius" value="<?=$dserial->mobile?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required="" class="form-control _CalPhaNum required noradius" value="<?=$dserial->email?>">
			</div>
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" class="form-control _CalPhaNum required noradius" value="<?=$dserial->username?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group" >
				<label>Password Lama</label>
				<input type="text" name="old_password" id="old_password" class="form-control _CalPhaNum required noradius old">
				<span id="passmatch"></span>
			</div>
			<div class="form-group" >
				<label>Ingin merubah password ?</label><br>
				<input type="checkbox" name="change_password" id="change_password"> Ya
			</div>
			<div class="form-group">
				<label>Password Baru</label>
				<div class="input-group mb-3">
					<input type="password" name="new_password" id="new_password" class="form-control _CalPhaNum required noradius" disabled>
					<div class="input-group-append">
						<button type="button" class="genric-btn default-border medium" id="btn-show-pass"><i id="btn-icon" class="fa fa-lock"></i></button>
					</div>
				</div>
				<span>Mohon untuk menggunakan kombinasi <b>huruf</b> dan <b>angka</b> saja.</span>
			</div>
		</div>
	</div>
	<br>
	<button type="button" id="btn_edit" class="genric-btn primary ls4">Simpan</button>
	<button type="button" id="btn_edit_disable" class="genric-btn disable hidden">
	    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
	    Memproses...
	</button>
	<button type="button" class="genric-btn default-border" id="btn_cancel">Batal</button>
</form>

<style type="text/css">
	.has-success { border: 1px solid #00CC00 !important; }
	.has-error { border: 1px solid #DA251C !important; }
</style>

<script type="text/javascript">
	$(document).ready(function (){
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,@' });
    	$('._CnUmB').numeric({allowThouSep: true, allowDecSep: false, allowPlus: false, allowMinus: false });
    	$('#old_password').blur(checkOldPassword);
    	$("#btn-show-pass").click(function () {
            if ($("#new_password").attr("type") == "password") {
                $("#new_password").attr("type", "text");
                $("#btn-icon").removeClass("fa-lock");
                $("#btn-icon").addClass("fa-unlock");
            } else {
                $("#new_password").attr("type", "password");
                $("#btn-icon").removeClass("fa-unlock");
                $("#btn-icon").addClass("fa-lock")
            }
        });
        $("#btn_edit").click(function() {
	        $('#btn_edit').addClass('hidden');
	        $('#btn_edit_disable').removeClass('hidden');
	        var dataform = $('#form-edit-account').serializeArray();
	        if($("#form-edit-account").valid() == false){
	        	toastr.error('Kesalahan dalam pengisian kolom. Mohon cek kembali');
	            $('#btn_edit').removeClass('hidden');
	            $('#btn_edit_disable').addClass('hidden');
	            return false;
	        } else {
	        	$.post("<?=site_url();?>account/caccount/sysaccount/save_change_account",
				dataform,
				function(data) {
					if(data == "success"){
	               		swal({
							title: "",
							html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Perubahan berhasil disimpan.',
							type: "",
							confirmButtonText: 'Okay',
						}).then(function(){
							location.reload();
	                  	});
	                }  else if(data == "same") {
	                  	$('#btn_edit').removeClass('hidden');
                        $('#btn_edit_disable').addClass('hidden');
	                    swal({
	                    	title: "",
	                    	html: '<i class="fas fa-exclamation-circle f40 margin10 text-yellow"></i><br>Mohon tidak menggunakan password lama.',
	                    	type: "",
	                    	confirmButtonText: 'Okay',
	                    });
	                } else {
	                  	$('#btn_edit').removeClass('hidden');
                        $('#btn_edit_disable').addClass('hidden');
	                    swal({
	                    	title: "",
	                    	html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.',
	                    	type: "",
	                    	confirmButtonText: 'Okay',
	                    });
	                }
				});
	        }
	    });
	    $("#btn_cancel").click(function(){
			$("html, body").animate({ scrollTop: $('#content-account').offset().top }, 600);
			Pace.restart();
	      	$("#content-account").removeClass("hidden");
	        $("#content-change").addClass("hidden");
	   	});

        function checkOldPassword(){
			var old_password = $('#old_password').val(),
			id = $('#id').val();
			$.ajax({
				type: "POST",
				url: "<?=site_url()?>account/caccount/sysaccount/check_old_password",
				cache: false,
				data: { old_password:old_password, id:id },
				success: function(response){ 
					try {
						if(response == "false"){
							$('.old').first().removeClass("has-success");
							$('.old').first().addClass("has-error");
							$('#passmatch').show();
							$('#passmatch').html('Kata sandi yang Anda masukkan tidak sama dengan yang terdaftar').css('color', 'red');
						} else {
							$('.old').first().removeClass("has-error");
							$('#passmatch').hide();
							$('.old').first().addClass("has-success");
						}       
					} catch(e) {  
						swal("Oops!", "Terjadi kesalahan sistem, muat ulang halaman ini atau periksa koneksi internet Anda", "error");
					}  
				},
				error: function(){      
					swal("Oops!", "Terjadi kesalahan sistem, muat ulang halaman ini atau periksa koneksi internet Anda", "error");
				}
			});
		}
    });
</script>