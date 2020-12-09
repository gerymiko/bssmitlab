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
<div class="mdl-layout mdl-js-layout color--gray is-small-screen login" style="background: url('<?=site_url()?>getimage/png/bg-loginx') center top no-repeat;background-size:cover;">
    <div class="loading hidden" id="loading"></div>
    <main class="mdl-layout__content">
    <div class="mdl-card mdl-card__login mdl-shadow--2dp">
        <div class="mdl-card__supporting-text color--dark-gray">
            <div class="mdl-grid">
                <form id="form-forgot" method="post" action="#">
                    <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                        <span class="mdl-card__title-text text-color--smooth-gray" style="color: #DA251C !important;">&copy; PT BINA SARANA SUKSES</span>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                        <span class="mdl-card__title-text text-color--white"><b style="font-weight: 600;">DASHBOARD</b></span>
                    </div><br>
                    <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                        <span class="login-name text-color--white"><h6>Forgot password?</h6></span>
                        <span class="login-secondary-text text-color--smoke">Enter your email or phone number that registered on our system below to recieve link to reset your password</span>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                        <select class="mdl-textfield__input text-color--white required" id="choose_one" name="choose_one">
                            <option class="text-color--smooth-gray" value="">Choose</option>
                            <option class="text-color--smooth-gray" value="selected_phone">Phone Number</option>
                            <option class="text-color--smooth-gray" value="selected_email">Email</option>
                        </select>
                        <br>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size" id="content-phone" style="display: none;">
                            <input class="mdl-textfield__input _CnUmB required" type="text" id="forgotphone" name="forgotphone">
                            <label class="mdl-textfield__label" for="forgotphone">Phone Number</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size" id="content-email" style="display: none;">
                            <input class="mdl-textfield__input _CalPhaNum required" type="email" id="forgotemail" name="forgotemail">
                            <label class="mdl-textfield__label" for="forgotemail">Email</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                        <span class="login-secondary-text text-color--smoke">Or if you remember, go back to <a href="<?=site_url()?>login">login</a> section.</span>
                    </div><br>
                    <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone submit-cell">
                        <div class="mdl-layout-spacer"></div>
                        <buttons type="button" class="mdl-button mdl-js-button mdl-button--raised color--light-blue" id="btn_send_verification" >SEND VERIFICATION
                        </buttons>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </main>
</div>
<style type="text/css">
    #choose_one { padding: 10px 5px 10px 5px; }
</style>
<script type="text/javascript">
	$( document ).ready(function() {
		$('._CnUmB').numeric({allowThouSep: false,   allowDecSep: false, allowPlus: false, allowMinus: false});
        $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '_.-@' });
        $('#form-forgot').on('keyup keypress', function(e){ var keyCode = e.keyCode || e.which;if(keyCode === 13){ e.preventDefault();return false;}});
        $('#choose_one').change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue=="selected_phone"){
                    $('#content-phone').toggle(200);$('#content-email').hide(200);$("#forgotemail").val("");$("#forgotemail").attr("disabled", true);$("#forgotphone").attr("disabled", false);
                } else if(optionValue=="selected_email"){
                    $('#content-phone').hide(200);$('#content-email').toggle(200);$("#forgotphone").val("");$("#forgotphone").attr("disabled", true);$("#forgotemail").attr("disabled", false);
                } else {
                    $('#content-phone').hide(200);$('#content-email').hide(200);
                }
            });
        });
        $("#btn_send_verification").on("click", function () {
            $("#loading").removeClass("hidden");
            var forgot = $("#form-forgot").serialize();
            if($("#form-forgot").valid() == false){
                $("#loading").addClass("hidden");
                return false;
            } else {
                $.post("<?=site_url('forgot/check');?>",
                forgot,
                function(data) {
                    if (data =="ErrorPhone") {
                        $("#loading").addClass("hidden");
                        swal("Hmmmm...", "The phone you entered does not match the registered one", "info");
                    } else if(data =="ErrorEmail") {
                        $("#loading").addClass("hidden");
                        swal("Hmmmm...", "The email you entered does not match the registered one", "info");
                    } else if(data =="activePhone") {
                        $("#loading").addClass("hidden");
                        swal("Hmmmm...", "We have sent a link to change password to your phone number", "info");
                    } else if(data =="activeEmail") {
                        $("#loading").addClass("hidden");
                        $("#form-forgot").addClass("hidden");
                        swal("Hmmmm...", "We have sent a link to change password to your email. Please check in INBOX or SPAM folder", "info");
                    } else if(data =="Success Phone") {
                        $("#loading").addClass("hidden");
                        $("#form-forgot").addClass("hidden");
                        swal("Yeay!", "We have sent a link to change password to your phone number.", "success");
                    } else if(data =="Success Email") {
                        $("#loading").addClass("hidden");
                        $("#form-forgot").addClass("hidden");
                        swal("Yeay!", "We have sent a link to change password to your email. Please check in INBOX or SPAM folder", "success");
                    } else {
                        $("#loading").addClass("hidden");
                        alert("Something goes wrong. Reload this page then try again");
                    }
                });     
            }
        });
	});
</script>
<?php $this->load->view($footer); ?>
</body>
</html>