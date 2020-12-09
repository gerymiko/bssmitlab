<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="PT BINA SARANA SUKSES" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>HOMETIS | PT BINA SARANA SUKSES</title>
    <meta name="description" content="web.binasaranasukses.com/hometis" />
    <meta name="keywords" content="web.binasaranasukses.com/hometis" />
    <meta name="author" content="PT BINA SARANA SUKSES" />
    <meta property="og:type" content="business.business">
    <meta property="og:title" content="PT BINA SARANA SUKSES">
    <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
    <meta property="og:url" content="web.binasaranasukses.com/hometis">
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
    <style type="text/css">
        .opo {
            background: url(<?=site_url()?>s_url/wall) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
        }
    </style>
</head>
<body class="hold-transition login-page opo">
    <div class="login-box">
        <div class="login-logo">
           <img src="<?=site_url();?>s_url/logo" alt="BSS HOMETIS" class="logo" width="170">
        </div>
        <div class="login-box-body bg-hometis">
            <p class="login-box-msg"><i>Please login first</i></p>
            <div id="notify"></div>
            <form id="form-login" action="#" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control _CalPhaNum required" name="username" id="username" value="gewy" placeholder="Username" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control _CalPhaNum required" name="password" id="password" placeholder="Password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25" value="gery29">
                        <span class="input-group-btn">
                            <button type="button" class="btn bg-white btn-flat" id="btn-show-pass"><i id="btn-icon" class="fas fa-eye text-gray"></i></button>
                        </span>
                    </div>
                    <label for="password" generated="true" class="error"></label>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-8">
                        <a href="<?=site_url()?>forgot">Forget password?</a>
                    </div>
                    <div class="col-xs-4">
                        <button type="button" id="btn_login" class="btn bg-red btn-block btn-flat">SIGN IN</button>
                    </div>
                </div>
                <br>
                <small><p class="text-center">Access from your <b>smartphone</b> and <b>desktop</b> browser anywhere and anytime!</p></small>
            </form>
        </div><br>
        <div class="text-center">&copy; <?=date("Y");?> <b class="text-red">PT BINA SARANA SUKSES</b></div>
    </div>
    <?php $this->load->view($footer); ?>
    <script>
        $(document).ready(function(){$('#form-login').validate();$("#btn_login").click(function(){var dataform=$('#form-login').serializeArray();if($("#form-login").valid()==false){return false;}else{$.ajax({url:'<?=site_url();?>check/auth/login',type:'POST',data:dataform,dataType:'JSON',cache:false,success:function(validator){if(validator.success==true){document.location.href=validator.redirect;}else{$("#notify").html(validator.message);window.setTimeout(function(){$(".alert").fadeTo(1000,0).slideUp(1000,function(){$(this).remove();});},2000);}}});};});});document.getElementById("password").addEventListener("keyup",function(event){event.preventDefault();if(event.keyCode==13){document.getElementById("btn_login").click();}});document.getElementById("username").addEventListener("keyup",function(event){event.preventDefault();if(event.keyCode==13){document.getElementById("btn_login").click();}});$("#btn-show-pass").click(function(){if($("#password").attr("type")=="password"){$("#password").attr("type","text");$("#btn-icon").removeClass("fa-eye");$("#btn-icon").addClass("fa-eye-slash");}else{$("#password").attr("type","password");$("#btn-icon").removeClass("fa-eye-slash");$("#btn-icon").addClass("fa-eye")}});$('._CalPhaNum').alphanum({allowNumeric:true,allow:'._@*-'});window.setTimeout(function(){$(".alert").fadeTo(1000,0).slideUp(1000,function(){$(this).remove();});},4000);
    </script>
</body>
</html>
