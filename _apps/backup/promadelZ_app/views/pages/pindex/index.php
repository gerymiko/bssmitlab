<!DOCTYPE html>
<html lang="ID">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Promadel</title>
    <link rel="icon" href="<?=siteURL()?>bssmitlab/_assets/promadel/img/favicon.png">
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
    <header class="main_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <?php $this->load->view($menu) ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <?php $this->load->view($content) ?>
    <footer class="footer_part">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-4 col-lg-4">
                    <div class="single_footer_part">
                        <a href="#" class="footer_logo_iner"> <img src="<?=siteURL()?>bssmitlab/_assets/promadel/img/logo/footer_logo.png" alt="#"> </a>
                        <p>Aplikasi menejemen administrasi untuk instansi desa dan kota untuk menunjang peningkatan performa instasi negara dalam pelayanan masyarakat</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-3">
                    <div class="single_footer_part">
                        <h4>Tentang Kami</h4><br>
                        <ul class="list-unstyled">
                            <li><a href="#">Kreatif</a></li>
                            <li><a href="<?=site_url()?>ccontact/syscontact">Hubungi Kami</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-5">
                    <div class="single_footer_part">
                        <h4>Tautan</h4><br>
                        <ul class="list-unstyled">
                            <div class="row">
                                <div class="col-sm-6">
                                    <li><a href="#">Fitur</a></li>
                                    <li><a href="<?=site_url()?>cinfo/sysnews">Berita</a></li>
                                    <?php
                                        if ($this->session->userdata('id_user') !== null) {
                                            echo '';
                                        } else {
                                            echo ' <li class="hand"><a data-toggle="modal" data-target="#modal-login">Masuk</a></li>';
                                        }
                                    ?>
                                </div>
                                <div class="col-sm-6">
                                    <li><a href="#">Ketentuan Layanan</a></li>
                                    <li><a href="<?=site_url()?>cinfo/sysfaq">Bantuan</a></li>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-8">
                    <div class="copyright_text">
                        <p>Copyright &copy;<?=date("Y")?> <a href="https://barengin.com" target="_blank"><b>BARENGIN.COM</b></a></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer_icon social_icon">
                        <ul class="list-unstyled">
                            <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>

    <div id="ftco-loader" class="show fullscreen hidden">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
        </svg>
    </div>

    <div class="modal" id="modal-login">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-header" style="border: none;">
                        <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
                    </div>
                    <form id="form-login" action="#" method="#"><br>
                        <h3 class="text-center text-heading ls5">MASUK KE <b class="f26">AKUN</b></h3>
                        <div class="modal-body">
                            <div id="notify"></div>
                            <div class="form-group old">
                                <input type="text" name="username" id="username" class="single-input _CalPhaNum required" aria-required="true" aria-invalid="true" maxlength="20" placeholder="Username" >
                                <span id="passmatch"></span>
                            </div>
                            <div class="form-group old">
                                <input type="password" class="single-input required" name="password" id="password" placeholder="Password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25" >
                                <span id="passmatch"></span>
                            </div>
                            <a href="#">Lupa Password?</a>
                        </div>
                        <div class="modal-footer" style="border: none;">
                            <button type="button" class="genric-btn default-border circle" data-dismiss="modal">Tutup</button>
                            <button type="button" id="btn_login" class="genric-btn primary circle f15 ls4">MASUK</button>
                            <button type="button" id="btn_login_disable" class="genric-btn disable circle hidden">
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                Memproses...
                            </button>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        $this->load->view($footer);
    ?>
    <script type="text/javascript">
        $(function (){
            $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,@' });
            $(window).scroll(function(){ if ($(this).scrollTop() > 100){ $('#scroll').fadeIn();} else { $('#scroll').fadeOut();}}); 
            $('#scroll').click(function(){ $("html, body").animate({ scrollTop: 0 }, 600);return false;});
            document.getElementById("password").addEventListener("keyup", function(event){
                event.preventDefault();
                if (event.keyCode == 13){ document.getElementById("btn_login").click(); }
            });
            document.getElementById("username").addEventListener("keyup", function(event){
                event.preventDefault();
                if (event.keyCode == 13){ document.getElementById("btn_login").click(); }
            });
            $("#btn_login").click(function(){
                $('#btn_login').addClass('hidden');
                $('#btn_login_disable').removeClass('hidden');
                var formlogin = $('#form-login'), dataform = $('#form-login').serializeArray();
                if($("#form-login").valid() == false){
                    $('#btn_login').removeClass('hidden');
                    $('#btn_login_disable').addClass('hidden');
                    return false;
                } else {
                    $.ajax({
                        url: '<?=site_url()?>anmeldung/check',
                        type: 'POST',
                        data: dataform,
                        dataType : 'JSON',
                        cache : false,
                        success: function(validator) {
                            if (validator.success == true){
                                document.location.href = validator.redirect;
                            } else {
                                $("#notify").html(validator.message);
                                $('#btn_login').removeClass('hidden');
                                $('#btn_login_disable').addClass('hidden');
                                window.setTimeout(function(){
                                    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){ $(this).remove(); });
                                }, 2000);
                            }
                        }
                    });
                }
            });
            $("btn_logout").click(function(){ $('.main_menu').removeClass('single_page_menu'); });
            window.setTimeout(function(){
                $(".alert").fadeTo(1000, 0).slideUp(1000, function(){ $(this).remove(); });
            }, 4000);   
        });
    </script>
    <!-- <script src="//code.jivosite.com/widget.js" data-jv-id="N1jCCxXPTL" async></script> -->
</body>

</html>