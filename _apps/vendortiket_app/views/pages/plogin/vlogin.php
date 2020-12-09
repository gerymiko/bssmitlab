<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="PT BINA SARANA SUKSES" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>VENDOR TIKET | PT BINA SARANA SUKSES</title>
    <meta name="description" content="web.binasaranasukses.com/vendor_tiket" />
    <meta name="keywords" content="web.binasaranasukses.com/vendor_tiket" />
    <meta name="author" content="PT BINA SARANA SUKSES" />
    <meta property="og:type" content="business.business">
    <meta property="og:title" content="PT BINA SARANA SUKSES">
    <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
    <meta property="og:url" content="web.binasaranasukses.com/vendor_tiket">
    <meta property="og:image" content="<?=site_url();?>s_url/logo_favicon">
    <meta property="business:contact_data:street_address" content="Jl. Pantai Indah Utara 2, Pantai Indah Kapuk Penjaringan">
    <meta property="business:contact_data:locality" content="Jakarta">
    <meta property="business:contact_data:region" content="DKI Jakarta">
    <meta property="business:contact_data:postal_code" content="14460">
    <meta property="business:contact_data:country_name" content="Indonesia">
    <link rel="shortcut icon" type="image/png" href="<?=site_url();?>syslink/logo_favicon"/>
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
<body class="hold-transition login-page bg-light-blue">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b class="red">BSS</b> <b>VENDOR</b> TIKET</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg"><i>Silahkan login terlebih dahulu</i></p>
            <div id="notify"></div>
            <form id="form-login" method="post">
                <div id="notify"></div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control required" name="username" id="username" placeholder="Username" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" value="geryvendor">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control required" name="password" id="password" placeholder="Password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" value="55555">
                        <span class="input-group-btn">
                            <button type="button" class="btn bg-red btn-flat" id="btn-show-pass"><i id="btn-icon" class="fa fa-lock"></i></button>
                        </span>
                    </div>
                    <div id="error"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-8">
                        <a href="#">Lupa password</a>
                    </div>
                    <div class="col-xs-4">
                        <button type="button" id="btn_login" class="btn bg-red btn-block btn-flat">MASUK</button>
                    </div>
                </div>
            </form>

        </div><br>
        <div class="text-center">&copy; <?=date("Y");?> PT BINA SARANA SUKSES</div>
    </div>
    <?php
        $this->load->view($footer);
    ?>
    <script>
        $(document).ready(function() {
            $("#btn_login").click(function () {
                var formlogin = $('#form-login');
                var dataform  = $('#form-login').serializeArray();
                if(formlogin.valid() == false){
                    return false;
                } else {
                    $.ajax({
                        url: '<?=site_url();?>syslogin/auth_login',
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
                }
            });
        });

        document.getElementById("password").addEventListener("keyup", function(event){
            event.preventDefault();
            if (event.keyCode == 13) {
                document.getElementById("btn_login").click();
            }
        });

        document.getElementById("password").addEventListener("keyup", function(event){
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
    </script>
</body>
</html>
