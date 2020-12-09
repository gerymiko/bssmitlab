<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PT Bina Sarana Sukses">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SHE REPORTS | PT BINA SARANA SUKSES</title>
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
    <style type="text/css">
        .select2 {
            border-radius: 0;
            color: #000;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            line-height: 40px;
        }
        .select2-container .select2-selection--single{
            height: 40px;
        }
    </style>
</head>
<body>
<div class="mdl-layout mdl-js-layout color--gray is-small-screen login">
    <main class="mdl-layout__content" style="background: url('<?=site_url()?>getimage/jpg/bg-loginx') center top no-repeat;background-size:cover;">
        <div class="mdl-card mdl-card__login mdl-shadow--2dp">
                <div class="mdl-card__supporting-text" style="background: #fff;color: #000;">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                            <span class="login-name"><b style="font-weight: 600;">SHE REPORTS</b></span>
                            <span class="login-secondary-text text-color--smoke">Silahkan pilih site terlebih dahulu.</span>
                        </div>
                        <div style="padding: 10px;"></div>
                        <form id="form-site" action="#" method="post" style="width: 100%;">
	                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                                <div class="form-group">
                                    <select class="select2 required form-control" name="site" id="site" style="width: 100%;">
                                        <option></option>
                                        <?php
                                            foreach ($list_site as $row) {
                                                echo '<option value="'.$row->KodeST.'">'.$row->KodeST.' ('.$row->Nama.')</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <label class="error" for="site"></label>
	                            <!-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select full-size">
                                    <input class="mdl-textfield__input required" type="text" id="site" readonly tabIndex="-1" name="site" />
                                    <label class="mdl-textfield__label" for="site">Site</label>
                                    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu dark_dropdown" for="site">
                                        
                                    </ul>
                                    <label for="site">
                                        <i class="mdl-icon-toggle__label material-icons">arrow_drop_down</i>
                                    </label>
                                </div> -->
	                        </div>
                            <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone submit-cell">
                                <div class="mdl-layout-spacer"></div>
                                <button type="button" id="btn_next" class="mdl-button mdl-js-button mdl-button--raised color--light-blue">
                                    GO
                                </button>
                            </div>
                            <div style="padding: 20px;"></div>
	                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                                <span class="mdl-card__title-text text-color--smooth-gray" style="color: #DA251C !important;">&copy; <?=date("Y")?> PT BINA SARANA SUKSES</span>
                                <small>Contractor and Mining Services</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </main>
</div>
<?php $this->load->view($footer); ?>
<script type="text/javascript">
    $(document).ready(function (){
        $('.select2').select2({ placeholder: 'Pilih', allowClear: true });
        $("#btn_next").click(function () {
            var dataform  = $('#form-site').serializeArray();
            if($("#form-site").valid() == false){ return false;
            } else {
                $.ajax({
                    url: '<?=site_url();?>goto/reports',
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