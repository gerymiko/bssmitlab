<!DOCTYPE html>
<html lang="en">
<head>
	<title>EPGIN | PT BINA SARANA SUKSES</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="<?=site_url();?>getimage/png/favicon"/>
	<?php
        function siteURL(){
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $domainName = $_SERVER['HTTP_HOST'].'/';
            return $protocol.$domainName;
        }
        define('SITE_URL', siteURL());
        $this->load->view($header);
    ?>
    <style type="text/css">
        .opo {
            background: url(<?=site_url()?>getimage/jpg/bgf-min) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100 opo">
			<div class="wrap-login100">
				<form class="login100-form validate-form" id="form-forgot" action="#" method="post">
					<span class="login100-form-title p-b-26">LUPA SANDI ?</span><br>
					<p>Ketikkan email atau nomor telepon Anda yang telah terdaftar. Sistem akan mengirim tautan untuk mengatur ulang kata sandi Anda.</p>
					<div class="p-t-20">
						<select class="form-control required " id="choose_one">
							<option value="">Pilih</option>
							<option value="1">Nomor HP</option>
							<option value="2">Email</option>
						</select>
					</div>

					<div class="p-t-20">
						<div id="content-phone" style="display: none;">
							<div class="input-group">
								<input type="text" name="forgotphone" id="forgotphone" maxlength="15" class="form-control _CnUmB required" placeholder="Isi disini . . .">
								<div class="input-group-btn">
									<button type="button" onclick="forgot_password();" class="btn btn-primary">K I R I M</button>
								</div>
							</div>
						</div>
						<div id="content-email" style="display: none;">
							<div class="input-group">
								<input type="text" name="forgotemail" id="forgotemail" maxlength="100" class="form-control _CalPhaNum required" placeholder="Isi disini . . .">
								<div class="input-group-btn">
									<button type="button" onclick="forgot_password();" class="btn btn-primary">K I R I M</button>
								</div>
							</div>
						</div>
					</div>

					<p class="p-t-20">atau Anda sudah mengingatnya ? Kembali ke halaman <a class="text-bold text-blue" href="<?=site_url()?>">login</a></p>

					<div class="p-t-50">
						<h5 class="text-center text-bold">&copy; <?=date("Y");?> <b class="text-red">PT BINA SARANA SUKSES</b></h5>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php $this->load->view($footer); ?>
	<script type="text/javascript">
		$( document ).ready(function() {
			<?php $pesan = $this->session->flashdata('pesan'); if(isset($pesan)){ ?>
	            swal({ type:'<?=$pesan['type'];?>',title:'<?=$pesan['title'];?>',html:'<?=$pesan['message'];?>',timer:10000}); 
	      	<?php } ?>
		    $('._CnUmB').numeric({allowThouSep: false,   allowDecSep: false, allowPlus: false, allowMinus: false});
			$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '_.@' });
			$('#form-forgot').on('keyup keypress', function(e){ var keyCode = e.keyCode || e.which;if(keyCode === 13){ e.preventDefault();return false;}});
			$('#choose_one').change(function(){
		        $(this).find("option:selected").each(function(){
		            var optionValue = $(this).attr("value");
		            if(optionValue==1){
		                $('#content-phone').toggle(200);$('#content-email').hide(200);$("#forgotemail").val("");$("#forgotemail").attr("disabled", true);$("#forgotphone").attr("disabled", false);
		            } else if(optionValue==2){
		                $('#content-phone').hide(200);$('#content-email').toggle(200);$("#forgotphone").val("");$("#forgotphone").attr("disabled", true);$("#forgotemail").attr("disabled", false);
		            } else {
		            	$('#content-phone').hide(200);$('#content-email').hide(200);
		            }
		        });
		    });
		});
	</script>
</body>
</html>