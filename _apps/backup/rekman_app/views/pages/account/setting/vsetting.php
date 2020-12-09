<div id="content">
	<div class="container-fluid">
		<div class="heading-block topmargin">
			<h2 class="thin">Halaman <b>Pengaturan</b></h2>
			<span data-animate="fadeIn">Pengaturan username dan password ada dihalaman ini.</span>
		</div>
	</div>
</div>

<div class="panel-body">
	<div class="tabs tabs-alt clearfix" id="tabs-profile">
		<ul class="tab-nav clearfix">
			<li><a href="#tab-feeds">Pengaturan Akun</a></li>
		</ul>

		<div class="tab-container">
			<div class="tab-content clearfix" id="tab-feeds">
				<p class="text-justify">Gunakan form dibawah ini untuk merubah password Anda. </p>
				<div class="alert alert-success" id="notif_success" style="display: none;"><i class="fa fa-info"></i> Password anda berhasil diubah. Kami telah mengirimkan ke nomor Anda dan email Anda.
				<button type="button" class="close" data-dismiss="alert">×</button>
				</div>
				<div class="noradius">
					<div class="panel-body">
						<div class="col-md-6">
							<form id="form-new-password" method="post" action="#" role="form" class="nobottommargin">
								<div class="form-group">
									<label class="col-form-label">Password Lama <b class="red">*</b></label>
									<input type="text" name="password_old" id="password_old" maxlength="100" class="alpha form-control required" placeholder="Ketik disini . . ." aria-required="true" aria-invalid="true"/>
									<span id="passmatch"></span>
								</div>
								<div class="form-group" >
									<label class="bold">Password Baru <b class="red">*</b></label>
									<div class="input-group">     
										<input style="z-index: 1" type="password" class="form-control" id="password" name="password" maxlength="20" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>
										<div class="input-group-btn" style="z-index: 1;">                   
				                            <a class="btn btn-default btn-icn" id="showHide">
				                                <i class="icon-eye"></i>
				                            </a>
				                        </div>
				                    </div>
				                </div>
								<div class="form-group" >
									<label class="bold">Ketik Ulang Password <b class="red">*</b></label>
									<div class="input-group">     
										<input style="z-index: 1" type="password" class="form-control" id="repassword" name="repassword" maxlength="20" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>
										<div class="input-group-btn" style="z-index: 1">                   
				                            <a class="btn btn-default btn-icn" id="showHide2">
				                                <i class="icon-eye"></i>
				                            </a>
				                        </div>
				                    </div>
				                </div>
				                <button type="button" class="btn btn-sm btn-primary" onclick="save_new_password();">Simpan</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/global/alphanum/jquery.alphanum.js"></script>

<script type="text/javascript">

	function save_new_password(){
		var datapass = $("#form-new-password").serialize();
		if($("#form-new-password").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>account/save_new_password",
			datapass,
			function(data){
				if(data == "Success"){
					$("#notif_success").show();
					$('#form-new-password')[0].reset();
					swal("Naiss!", "Password berhasil diubah.", "success");
				} else if(data == "Error 1"){
					swal("Oops!", "Gagal diproses. Password yang Anda masukkan tidak sama dengan yang terdaftar.", "error");
				} else if(data == "Error 2"){
					swal("Oops!", "Gagal diproses. Password yang Anda masukkan sama dengan yang sebelumnya. Gunakan password yang lain.", "error");
				} else {
					swal("Oops!", "Gagal diproses. Coba lagi", "error");
				}
			});	
		}
	}

	$(document).ready(function(){
	    $('#password_old').blur(checkOldPassword);
	});

	function checkOldPassword(){
	    var password_old = $('#password_old').val();
	    $.ajax({
            type: "POST",
            url: "config/checkOldPassword",
            cache: false,
            data: 'password_old=' + $('#password_old').val(),
            success: function(response){ 
                try {
                    if(response == "false"){
                    	$('.form-group').first().removeClass("has-success");
                    	$('.form-group').first().addClass("has-error");
                    	$('#passmatch').show();
                        $('#passmatch').html('Password yang anda masukkan tidak sama dengan yang terdaftar').css('color', 'red');
                    } else {
                    	$('.form-group').first().removeClass("has-error");
                    	$('#passmatch').hide();
                    	$('.form-group').first().addClass("has-success");
                    }       
                } catch(e) {  
                    swal("Opss!", "Terjadi kesalahan sistem, mohon refresh ulang halaman ini atau cek koneksi internet anda", "error");
                }  
            },
            error: function(){      
                swal("Opss!", "Terjadi kesalahan sistem, mohon refresh ulang halaman ini atau cek koneksi internet anda", "error");
            }
        });
	}

	$('#password_old').alphanum({allowSpace: false, disallow: ''});

	$("#showHide").click(function () {
	    if ($("#password").attr("type") == "password") {
	        $("#password").attr("type", "text");
	        $("#showHide").show("<i class='fa fa-eye-slash' style='color: #FFF; padding: 0px;'></i>");
	    } else {
	        $("#password").attr("type", "password");
	        $("#showHide").show("<i class='fa fa-eye-slash' style='color: #FFF; padding: 0px;'></i>");
	    }
	});
	$("#showHide2").click(function () {
	    if ($("#repassword").attr("type") == "password") {
	        $("#repassword").attr("type", "text");
	        $("#showHide2").show("<i class='icon-eye' style='color: #C3C3C3; padding: 0px;'></i>");
	    } else {
	        $("#repassword").attr("type", "password");
	        $("#showHide2").show("<i class='icon-eye' style='color: #C3C3C3; padding: 0px;'></i>");
	    }
	});
</script>
