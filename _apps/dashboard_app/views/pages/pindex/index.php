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
            <button id="sitex" class="mdl-button mdl-js-button">
                <?=$this->session->userdata('site');?>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-shadow--2dp settings-dropdown"
                for="sitex">
                <?php
                    foreach ($list_site as $row) {
                        if ($row->status_active == 1) {
                            echo '<a class="mdl-menu__item" href="'.site_url('page/first/').$row->code.'">'.$row->code.'</a>';
                        } else {
                            echo '<a class="mdl-menu__item" data-toggle="modal" data-target="#modal-warning">'.$row->code.'</a>';
                        }
                    }
                ?>
            </ul>
            <div class="avatar-dropdown" id="icon">
                <span><?=$this->session->userdata('nik')?></span>
                <img src="<?=site_url()?>getimage/png/user">
            </div>
            <ul class="mdl-menu mdl-list mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-shadow--2dp account-dropdown"
                for="icon">
                <li class="mdl-list__item mdl-list__item--two-line">
                    <span class="mdl-list__item-primary-content">
                        <span><?=$this->session->userdata('nik')?></span>
                        <span class="mdl-list__item-sub-title">Super Administrator</span>
                    </span>
                </li>
                <li class="list__item--border-top"></li>
                <li class="mdl-menu__item mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                        <i class="material-icons mdl-list__item-icon">settings</i>
                        Settings
                    </span>
                </li>
                <a href="<?=site_url()?>logout">
                    <li class="mdl-menu__item mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon text-color--secondary">exit_to_app</i>
                            Log out
                        </span>
                    </li>
                </a>
            </ul>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <header><b>DASHBOARD</b></header>
        <div class="scroll__wrapper" id="scroll__wrapper">
            <div class="scroller" id="scroller">
                <div class="scroll__container" id="scroll__container">
                    <nav class="mdl-navigation">
                        <?php
                        if ($accessRights->id_level == 1){
                            foreach ($menu as $row) {
                                if ($row->type == 'P') {
                                    echo 
                                    '<a class="mdl-navigation__link" id="link_'.$row->name.'" href="'.site_url('menu/').$row->name.'/'.$this->uri->segment(3).'">
                                        <i class="material-icons" role="presentation">'.$row->icon.'</i>
                                        '.$row->alias.'
                                    </a>';
                                }
                            }
                            echo '
                            <div class="sub-navigation" id="subnavigation-master">
                                <a class="mdl-navigation__link" id="treeview-master">
                                    <i class="material-icons">view_agenda</i>
                                    Master
                                    <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                                <div class="mdl-navigation">';
                                foreach ($menu as $row) {
                                    if (substr($row->name, 0, 6) == 'master') {
                                        echo '
                                        <a class="mdl-navigation__link" id="link_'.$row->name.'" href="'.site_url('menu/').$row->name.'/'.$this->uri->segment(3).'">
                                             '.substr($row->alias, 7).'
                                        </a>';
                                    }
                                }
                                echo '</div>
                            </div>';
                            foreach ($menu as $row) {
                                if ($row->type == 'S' && substr($row->name, 0, 6) !== 'master') {
                                    echo '
                                    <a class="mdl-navigation__link" id="link_'.$row->name.'" href="'.site_url('menu/').$row->name.'/'.$this->uri->segment(3).'">
                                        <i class="material-icons" role="presentation">'.$row->icon.'</i>
                                        '.$row->alias.'
                                    </a>';
                                }
                            }
                        } 
                        // elseif ($accessRights->id_level == 2) {
                        //     foreach ($menu as $row) {
                        //         if ($row->type == 'P') {
                        //             echo 
                        //             '<li id="link_'.$row->alias.'">
                        //             <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-circle f10 text-yellow"></i> <span>'.$row->name.'</span></a>
                        //             </li>';
                        //         }
                        //     }
                        //     echo '<li class="header ls1">ADMIN MENU</li>';
                        //     foreach ($menu as $row) {
                        //         if ($row->type == 'A') {
                        //             echo 
                        //             '<li id="link_'.$row->alias.'">
                        //             <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-circle f10 text-yellow"></i> <span>'.$row->name.'</span></a>
                        //             </li>';
                        //         }
                        //     }
                        // } else {
                        //     foreach ($menu as $row) {
                        //         if ($row->type == 'P') {
                        //             echo 
                        //             '<li id="link_'.$row->alias.'">
                        //             <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-circle f10 text-yellow"></i> <span>'.$row->name.'</span></a>
                        //             </li>';
                        //         }
                        //     }
                        // }
                        ?>
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
<div class="modal" tabindex="-1" role="dialog" id="modal-warning" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>DASHBOARD on this site still have no data.</p>
            </div>
            <div class="modal-footer no-border">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view($footer); ?>
<script type="text/javascript">
    $(document).ready(function (){
        $('.modal').appendTo("body");
    });
</script>
</body>
</html>
