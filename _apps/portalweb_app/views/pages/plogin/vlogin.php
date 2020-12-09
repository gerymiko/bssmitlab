<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="PT BINA SARANA SUKSES" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>PORTAL HRD | PT BINA SARANA SUKSES</title>
    <meta name="description" content="web.binasaranasukses.com/portalhrd" />
    <meta name="keywords" content="web.binasaranasukses.com/portalhrd" />
    <meta name="author" content="PT BINA SARANA SUKSES" />
    <meta property="og:type" content="business.business">
    <meta property="og:title" content="PT BINA SARANA SUKSES">
    <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
    <meta property="og:url" content="web.binasaranasukses.com/portalhrd">
    <meta property="og:image" content="<?=site_url();?>getimage/png/logo_sm">
    <meta property="business:contact_data:street_address" content="Jl. Pantai Indah Utara 2, Pantai Indah Kapuk Penjaringan">
    <meta property="business:contact_data:locality" content="Jakarta">
    <meta property="business:contact_data:region" content="DKI Jakarta">
    <meta property="business:contact_data:postal_code" content="14460">
    <meta property="business:contact_data:country_name" content="Indonesia">
    <link rel="shortcut icon" type="image/png" href="<?=site_url();?>getimage/png/logo_sm"/>
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
        #notif {
            width: 100%;
            margin: 0;
            padding: 12px;
            background: #DA251C !important;
            text-align: center;
        }
    </style>
</head>
<body class="hold-transition login-page bg-navy">
    <div id="notif"> 
        <p class="no-margin">Portal sekarang berubah menjadi "PORTAL HRD" dan berubah link aksesnya menjadi "<a class="text-white text-bold" href="https://web.binasaranasukses.com/portalhrd">https://web.binasaranasukses.com/portalhrd</a>"
            <span class="notif-accept hand" title="Close"><i class="fas fa-times pull-right" style="margin-top: 3px;"></i></span></p>
    </div>
    <div class="login-box ">
        <div class="login-logo">
            <img src="<?=site_url();?>getimage/png/logoA" alt="BSS SYSTEM" class="logo" width="280">
        </div>
        <div class="login-box-body bg-navy">
            <div id="notify"></div>
            <form id="form-login" action="#" method="post">
                <div class="form-group">
                    <input type="text" name="nik" id="nik" maxlength="15" class="form-control _CnUmB required" placeholder="N I K" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control _CalPhaNum required" name="password" id="password" placeholder="P A S S W O R D" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25" >
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-flat" id="btn-show-pass"><i id="btn-icon" class="far fa-eye"></i></button>
                        </span>
                    </div>
                    <label for="password" class="error"></label>
                </div>
                <button type="button" id="btn_login" class="btn bg-red btn-block btn-flat">MASUK</button>
                <br>
                <a class="text-bold" href="<?=site_url()?>forgot">Lupa password ?</a><br><br>
                <small><p class="text-left">Akses dari browser <b>smartphone</b> dan <b>desktop</b> anda kapanpun dan dimanapun!</p></small>
                <small class="pull-right">v3.1</small>
            </form>
        </div>
        <div class="text-center">&copy; <?=date("Y");?> <b class="text-red">PT BINA SARANA SUKSES</b></div>
    </div>
    <?php $this->load->view($footer); ?>
    <script>
        $(document).ready(function() {
            $('._CnUmB').numeric({allowThouSep: false,   allowDecSep: false, allowPlus: false, allowMinus: false});
            $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '_.@' });
            $('#form-login').validate();
            $("#btn_login").click(function () {
                var dataform  = $('#form-login').serializeArray();
                if($("#form-login").valid() == false){
                    return false;
                } else {
                    $.ajax({
                        url: '<?=site_url();?>check/authentication',
                        type: 'POST',
                        data: dataform,
                        dataType: 'JSON',
                        cache: false,
                        success: function(validator) {
                            if (validator.success == true) {
                                document.location.href = validator.redirect;
                            } else {
                                $("#notify").html(validator.message);
                                window.setTimeout(function() {
                                    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                                        $(this).remove(); 
                                    });
                                }, 2000);
                            }
                        }
                    });
                };
            });
            $('.notif-accept').click(function () { 
                days   = 1;
                myDate = new Date();
                myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
                document.cookie = "comply_cookie = comply_yes; expires = " + myDate.toGMTString(); 
                $("#notif").slideUp("slow"); 
            });
        });
        document.getElementById("password").addEventListener("keyup", function(event){ event.preventDefault(); if (event.keyCode == 13) { document.getElementById("btn_login").click(); } }); document.getElementById("nik").addEventListener("keyup", function(event){ event.preventDefault(); if (event.keyCode == 13) { document.getElementById("btn_login").click(); } });
        $("#btn-show-pass").click(function () {
            if ($("#password").attr("type") == "password") { $("#password").attr("type", "text"); $("#btn-icon").removeClass("fa-eye"); $("#btn-icon").addClass("fa-eye-slash"); } else { $("#password").attr("type", "password"); $("#btn-icon").removeClass("fa-eye-slash"); $("#btn-icon").addClass("fa-eye"); } });
        $('.num').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
        window.setTimeout(function() { $(".alert").fadeTo(1000, 0).slideUp(1000, function(){ $(this).remove(); });}, 4000);
    </script>
</body>
</html>
