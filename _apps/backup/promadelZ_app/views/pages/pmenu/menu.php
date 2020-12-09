<a class="navbar-brand main_logo" href="<?=site_url()?>"> <img src="<?=siteURL()?>bssmitlab/_assets/promadel/img/logo/logo.png" alt="logo"> </a>
<a class="navbar-brand single_page_logo" href="<?=site_url()?>"> <img src="<?=siteURL()?>bssmitlab/_assets/promadel/img/logo/footer_logo.png" alt="logo"> </a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
aria-expanded="false" aria-label="Toggle navigation">
    <span class="menu_icon"></span>
</button>
<div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" id="home" href="<?=site_url()?>">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="about" href="<?=site_url()?>about">Tentang</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" id="feature" href="<?=site_url()?>cfeature/sysfeature">Fitur</a>
        </li> -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="information">
                Informasi
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?=site_url()?>news">Berita</a>
                <a class="dropdown-item" href="<?=site_url()?>faq">Bantuan</a>
            </div>
        </li>
        <?php
            if ($this->session->userdata('id_user') !== null) {
                echo '
                    <li class="nav-item">
                        <a class="nav-link" id="forum" href="'.site_url('forum').'">Forum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="account" href="'.site_url('bio').'">Akun</a>
                    </li>
                ';
            } else {
                echo '
                    <li class="nav-item">
                        <a class="nav-link" id="contact" href="'.site_url('contact').'">Kontak</a>
                    </li>';
            }
        ?>
    </ul>
</div>
<?php
    if ($this->session->userdata('id_user') == null) {
        echo '<a href="#" class="d-none d-sm-block btn_1" id="btn_masuk" data-toggle="modal" data-target="#modal-login">MASUK</a>';
    } else {
        echo '<a href="'.site_url('account/ausloggen').'" id="btn_logout" class="d-none d-sm-block btn_1">KELUAR</a>';
    }
?>
