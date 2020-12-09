<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="PT BINA SARANA SUKSES" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>MOSENTO | PT BINA SARANA SUKSES</title>
    <meta name="description" content="web.binasaranasukses.com/mosento" />
    <meta name="keywords" content="web.binasaranasukses.com/mosento" />
    <meta name="author" content="PT BINA SARANA SUKSES" />
    <meta property="og:type" content="business.business">
    <meta property="og:title" content="PT BINA SARANA SUKSES">
    <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
    <meta property="og:url" content="web.binasaranasukses.com/mosento">
    <meta property="og:image" content="<?=site_url();?>s_url/logo_favicon">
    <meta property="business:contact_data:street_address" content="Jl. Pantai Indah Utara 2, Pantai Indah Kapuk Penjaringan">
    <meta property="business:contact_data:locality" content="Jakarta">
    <meta property="business:contact_data:region" content="DKI Jakarta">
    <meta property="business:contact_data:postal_code" content="14460">
    <meta property="business:contact_data:country_name" content="Indonesia">
    <link rel="shortcut icon" type="image/png" href="<?=site_url();?>s_url/logo_favicon"/>
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
<body class="hold-transition login-page bg-blue">
    <div class="login-box">
        <div class="login-logo">
            <img src="<?=site_url();?>s_url/logo" alt="BSS MOSENTO" class="logo" width="250">
        </div>
        <div class="login-box-body">
            <p class="login-box-msg"><i>Please login first</i></p>
            <form id="form-login" action="#" method="post">
                <div id="notify"></div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control num required" name="nik" id="nik" placeholder="NIK" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="10">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control required" name="password" id="password" placeholder="Password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25">
                        <span class="input-group-btn">
                            <button type="button" class="btn bg-navy btn-flat" id="btn-show-pass"><i id="btn-icon" class="fa fa-lock"></i></button>
                        </span>
                    </div>
                    <div id="error"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-8">
                        <a href="<?=site_url()?>forgot">Forgot password ?</a>
                    </div>
                    <div class="col-xs-4">
                        <button type="button" id="btn_login" class="btn bg-navy btn-block btn-flat">LOGIN</button>
                    </div>
                </div>
            </form>

            <div class="social-auth-links text-center" id="gplay-app">
                <p>- OR -</p>
                <h4 class="text-red text-bold">Download anywhere</h4>
                <p>Available for all android smartphone. Download now !</p>
                <a href="http://bit.ly/3BssMos" rel="noopener"><img src="<?=site_url();?>s_url/icon_gplay" alt="BSS MOSENTO" class="gplay store" width="120"></a>
            </div>
        </div><br>
        <div class="text-center">&copy; <?=date("Y");?> <b class="text-red">PT BINA SARANA SUKSES</b></div>
    </div>
    <?php
        $this->load->view($footer);
    ?>
    <script>
        $(document).ready(function() {
            $('#form-login').validate();
            $("#btn_login").click(function () {
                var dataform  = $('#form-login').serializeArray();
                if($("#form-login").valid() == false){
                    return false;
                } else {
                    $.ajax({
                        url: '<?=site_url();?>authenticate',
                        type: 'POST',
                        data: dataform,
                        dataType : 'JSON',
                        cache : false,
                        success: function(validator) {
                            if (validator.success == true) {
                                document.location.href = validator.redirect;
                            } else {
                                $("#notify").html(validator.message);
                            }
                        }
                    });
                };
            });
        });

        document.getElementById("password").addEventListener("keyup", function(event){
            event.preventDefault();
            if (event.keyCode == 13) {
                document.getElementById("btn_login").click();
            }
        });

        document.getElementById("nik").addEventListener("keyup", function(event){
            event.preventDefault();
            if (event.keyCode == 13) {
                document.getElementById("btn_login").click();
            }
        });

        $("#btn-show-pass").click(function () {
            if ($("#password").attr("type") == "password") {
                $("#password").attr("type", "text");
                $("#btn-icon").removeClass("fa-lock");
                $("#btn-icon").addClass("fa-unlock");
            } else {
                $("#password").attr("type", "password");
                $("#btn-icon").removeClass("fa-unlock");
                $("#btn-icon").addClass("fa-lock")
            }
        });
        $('.num').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
    </script>
</body>
</html>
