<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PT Bina Sarana Sukses">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DASHBOARD | PT BINA SARANA SUKSES</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,100,700,900' rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
</head>
<body>
<div class="mdl-layout mdl-js-layout color--gray is-small-screen login">
    <main class="mdl-layout__content" style="background: url('<?=site_url()?>getimage/png/bg-loginx') center top no-repeat;background-size:cover;">
        <div class="mdl-card mdl-card__login mdl-shadow--2dp">
                <div class="mdl-card__supporting-text color--dark-gray">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                            <span class="mdl-card__title-text text-color--smooth-gray" style="color: #DA251C !important;">&copy; PT BINA SARANA SUKSES</span>
                        </div>
                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                            <span class="login-name text-color--white"><b style="font-weight: 600;">DASHBOARD</b></span>
                            <span class="login-secondary-text text-color--smoke">Plan and activity company monitoring system.</span>
                        </div>
                        <form id="form-login" action="#" method="post">
	                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
	                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
	                                <input class="mdl-textfield__input _CnUmB required" type="text" id="nik" name="nik">
	                                <label class="mdl-textfield__label" for="nik">NIK</label>
	                            </div>
	                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
	                                <input class="mdl-textfield__input _CalPhaNum required" type="password" id="password" name="password">
	                                <label class="mdl-textfield__label" for="password">Password</label>
	                            </div>
	                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select full-size">
                                    <input class="mdl-textfield__input required" type="text" id="site" readonly tabIndex="-1" name="site" />
                                    <label class="mdl-textfield__label" for="site">Site</label>
                                    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu dark_dropdown" for="site">
                                        <li class="mdl-menu__item" value="AGM">AGM</li>
                                        <li class="mdl-menu__item" value="PMSS">PMSS</li>
                                        <li class="mdl-menu__item" value="MAS">MAS</li>
                                    </ul>
                                    <label for="site">
                                        <i class="mdl-icon-toggle__label material-icons">arrow_drop_down</i>
                                    </label>
                                </div><br>
	                            <a href="<?=site_url()?>forgot" class="login-link">Forgot password?</a>
	                        </div>
	                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone submit-cell">
	                            <div class="mdl-layout-spacer"></div>
	                            <button type="button" id="btn_login" class="mdl-button mdl-js-button mdl-button--raised color--light-blue">
	                                SIGN IN
	                            </button>
	                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </main>
</div>
<script type="text/javascript">
	$( document ).ready(function() {
		<?php $pesan = $this->session->flashdata('pesan'); if(isset($pesan)){ ?>
            swal({ type:'<?=$pesan['type'];?>',title:'<?=$pesan['title'];?>',html:'<?=$pesan['message'];?>',timer:10000}); 
      	<?php } ?>
        $('._CalPhaNum').alphanum({ allowNumeric: true });
        $('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
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
<?php $this->load->view($footer); ?>
</body>
</html>