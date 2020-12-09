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
            background: url(<?=site_url()?>getimage/jpg/bg-min) no-repeat center center fixed; 
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
				<form class="login100-form validate-form" id="form-login" action="#" method="post">
					<span class="login100-form-title p-b-26">
						<img src="<?=site_url();?>getimage/png/logo" alt="BSS SYSTEM" class="logo" width="150">
					</span><br>
					<div class="wrap-input100">
						<input class="input100 _CnUmB required" type="text" name="nik" id="nik" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" value="1007425">
						<span class="focus-input100" data-placeholder="N I K"></span>
					</div>
					<label for="nik" generated="true" class="error"></label>
					<div class="wrap-input100">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye fs-19"></i>
						</span>
						<input class="input100 _CalPhaNum required" type="password" name="password" id="password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25" value="gerymiko29">
						<span class="focus-input100" data-placeholder="Kata Sandi"></span>
					</div>
					<label for="password" generated="true" class="error"></label>
					<div class="wrap-input100">
						<select class="input100 select2 required" name="site" id="site">
                        	<option></option>
                        	<?php
                        		foreach ($site as $row) {
                        			echo '<option value="'.$row->code.'">'.$row->code.'</option>';
                        		}
                        	?>
                        </select>
					</div>
					<label for="site" generated="true" class="error"></label>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="button" class="login100-form-btn" id="btn_login">M A S U K</button>
						</div>
					</div>
					<div class="text-center p-t-50">
						<a class="txt2" href="<?=site_url()?>forgot"><span class="txt1">Lupa kata sandi ?</span></a>
					</div><br>
					<h5 class="text-center text-bold">&copy; <?=date("Y");?> <b class="text-red">PT BINA SARANA SUKSES</b></h5>
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
			$("#btn_login").click(function () {
		        var dataform  = $('#form-login').serializeArray();
		        if($("#form-login").valid() == false){ return false;
		        } else {
		            $.ajax({
		                url: '<?=site_url();?>login/authentication',
		                type: 'POST',
		                data: dataform,
		                dataType: 'JSON',
		                cache: false,
		                success: function(validator) {
		                    if (validator.success == true) {
		                        document.location.href = validator.redirect;
		                    } else {
		                        toastr.error(validator.message, 'Terjadi kesalahan!');
		                        $('.input100').addClass('text-red');
		                    }
		                }
		            });
		        };
		    });
		});
	</script>
</body>
</html>