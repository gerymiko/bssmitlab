<section id="page-title" class="page-title-mini">
	<div class="container clearfix">
		<h1 class="white">Formulir Registrasi</h1>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li>Daftar</li>
			<li class="active" style="color: #FFF;font-weight: 700">Akun (Tahap 1)</li>
		</ol>
	</div>
</section><br />

<section id="content">
	<div class="container clearfix">
		<div class="accordion accordion-bg clearfix">
			<div class="acctitle">Ketentuan dalam pengisian form pendaftaran</div>
			<div class="panel-body noradius">
				<ul class="iconlist iconlist-color nobottommargin">
					<li><i class="icon-ok"></i>Username dan password dapat digunakan untuk melakukan login dan melamar pekerjaan yang tersedia dihalaman utama website <b class="red">PT. BINA SARANA SUKSES</b>.</li>
					<li><i class="icon-ok"></i>Username hanya menggunakan <b>ANGKA</b> dan <b>HURUF</b> tanpa menggunakan <b>SPASI</b>.</li>
					<li><i class="icon-ok"></i>Ada <b>6 TAHAP</b> dalam pengisian data diri untuk dapat melamar di perusahaan kami. Mohon dapat mengikuti dan mengisi keseluruhan data sesuai dengan data diri anda yang sebenarnya. Pemalsuan KTP, SIM, IJAZAH dan SERTIFIKAT dapat terkena sanksi hukum pidana sesuai Undang-undang negara Republik Indonesia.</li>
					<li><i class="icon-ok"></i>Disetiap tahap terdapat instruksi pengisian formulir, mohon dapat diperhatikan dengan seksama.</li>
				</ul>
			</div>
		</div>

		<style type="text/css">
			ul { list-style: none; margin-bottom: 0; }
		</style>

		<div class="panel panel-default nobottommargin noradius">
			<div class="panel-body">
				<p>Isi username dan password untuk melakukan login setelah pendaftaran selesai.</p><hr />
				
				<div id="errorContainer">
					<div class="panel-body tes">
						<p class="nobottommargin">Harap perbaiki kesalahan pada kolom berikut dan coba lagi :</p>
						<ul>
					</div>
				</div>

				<form action="<?php echo site_url()?>sysdaftar/step_2" method="post" role="form" id="formlogin" class="nobottommargin">
					<div class="row">
						<div class="col-md-4">
							<label class="bold">Username <b class="red">*</b></label>
							<input type="text" id="username" name="username" maxlength="20" value="<?php echo $this->input->cookie('user',TRUE);?>" class="form-control" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>
							<div style="padding: 2px;"></div>
							<span id="user-availability-status" style="color: #21CB21"></span>
						</div>

						<div class="col-md-4">
							<div class="form-group" >
								<label class="bold">Password <b class="red">*</b></label>
								<div class="input-group">     
									<input style="z-index: 1" type="password" class="form-control" id="password" name="password" maxlength="20" value="<?php echo $this->input->cookie('password',TRUE);?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>
									<div class="input-group-btn" style="z-index: 1">                   
			                            <a class="btn button-red button-3d btn-icn" id="showHide">
			                                <i class="icon-eye" style="color: #FFF;"></i>
			                            </a>
			                        </div>
			                    </div>
			                </div>
						</div>

						<div class="col-md-4">
							<div class="form-group" >
								<label class="bold">Ketik Ulang Password <b class="red">*</b></label>
								<div class="input-group">     
									<input style="z-index: 1" type="password" class="form-control" id="repassword" name="repassword" maxlength="20" value="<?php echo $this->input->cookie('repassword',TRUE);?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>
									<div class="input-group-btn" style="z-index: 1">                   
			                            <a class="btn button-red button-3d btn-icn" id="showHide2">
			                                <i class="icon-eye" style="color: #FFF;"></i>
			                            </a>
			                        </div>
			                    </div>
			                </div>
						</div>
					</div>
					<div style="padding: 5px;"></div>
					<div class="col_full nobottommargin">
						<button class="button button-small button-rounded button-reveal button-border tright nomargin" type="submit"><i class="icon-line-arrow-right"></i><span>Selanjutnya</span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section><br />

<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/global/alphanum/jquery.alphanum.js"></script>

<?php 
	$pesan = $this->session->flashdata('pesan');
	if (isset($pesan)){ ?>
	<script>
	  $(document).ready(function(){
	      swal({   
	        title: "<?=$pesan["title"]; ?>",   
	        text: "<?=$pesan["message"]; ?>",
	        type: "<?=$pesan['class']; ?>",   
	        confirmButtonText: "Ok" 
	      });
	  });    
	</script>
<?php } ?>

<script type="text/javascript">
	$('#formlogin').validate({
	    rules: {
	        username: "required",
	        password: "required",
	        repassword: "required",
	        repassword: {
		    	equalTo: "#password"
		    }
	    },
	    messages: {
	        username: "Masukkan username.",
	        password: "Masukkan password.",
	        repassword: "Masukkan password yang sama.",
	    },
	    errorContainer: $('#errorContainer'),
	    errorLabelContainer: $('#errorContainer ul'),
	    wrapper: 'li'
	});

	$(document).ready(function(){
	    $('#username').blur(checkAvailability1);
	});

	$('#username').alphanum({allowSpace: false, disallow: ''});

	function checkAvailability1(){
	    var username = $('#username').val();
	    if(username == "" || username.length < 5){  
	        $("#user-availability-status").html('Masukkan minimal 5 karakter.').css('color', 'red');  
	    } else if (username.length > 20) {
	    	$("#user-availability-status").html('Maksimal 20 karakter.').css('color', 'red');
	    } else {
	        $.ajax({
	            type: "POST",
	            url: "registration/checkAvailUser",
	            cache: false,
	            data: 'username=' + $('#username').val(),
	            success: function(response){ 
	                try {
	                    if(response == "false"){
	                        $('#user-availability-status').html('Username dapat digunakan').css('color', 'green');
	                    } else {
	                        $('#user-availability-status').html('Username tidak dapat digunakan. Gunakan username yang lain.').css('color', 'red');
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
	}
	
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

