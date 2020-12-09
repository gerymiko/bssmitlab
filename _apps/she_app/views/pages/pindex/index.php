<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PT Bina Sarana Sukses">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SHE | PT BINA SARANA SUKSES</title>
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
        @media (max-width: 800px) {
            
        }
    </style>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header is-small-screen">
    <div class="loading hidden" id="loading"></div>
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <div class="mdl-layout-spacer"></div>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <header><b>SHE REPORTS</b></header>
        <div class="scroll__wrapper" id="scroll__wrapper">
            <div class="scroller" id="scroller">
                <div class="scroll__container" id="scroll__container">
                    <nav class="mdl-navigation">
                        <div class="mdl-layout-spacer"></div>
                        <hr>
                        <small style="padding-left: 20px;color: #DA251C;"><b>&copy; <?=date("Y")?> PT BINA SARANA SUKSES</b></small>
                    </nav>
                </div>
            </div>
            <div class='scroller__bar' id="scroller__bar"></div>
        </div>
    </div>
    <main class="mdl-layout__content">
        <?php $this->load->view($content); ?>
    </main>
</div>
<?php $this->load->view($footer); ?>
<script type="text/javascript">
    $(document).ready(function (){
        $('.modal').appendTo("body");
    });
</script>
</body>
</html>
