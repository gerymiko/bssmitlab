<div class="container">
   <div class="navbar-header">
      <a href="<?=site_url();?>"><img src="<?=site_url();?>s_url/logo" alt="BSS MOSENTO" class="logo" /></a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
         <i class="fa fa-bars"></i>
      </button>
   </div>
   <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
      <ul class="nav navbar-nav">
         <li class=""><a href="<?=site_url();?>dashboard">Home</a></li>
         <li><a href="<?=site_url();?>unit">Unit</a></li>
         <li><a href="<?=site_url();?>variable">Variable</a></li>
         <li><a href="<?=site_url();?>perform">Performance</a></li>
         <?php
            if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2 ) {
               echo '<li><a href="'.site_url().'privilege">Privilege</a></li>';
            }
         ?>
      </ul>
   </div>
   <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
         <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <img src="<?=site_url();?>s_url/icon_user" class="user-image" alt="user">
               <span class="hidden-xs"><?=$this->session->userdata('nik');?></span>
            </a>
            <ul class="dropdown-menu">
               <li class="user-header">
                  <p>
                     <?=$this->session->userdata('nik')?>
                     <small><?=$this->session->userdata('nama')?></small>
                     <small>You're <?php if($this->session->userdata('level') == 1 ){ echo 'Super Administrator'; } elseif ($this->session->userdata('level') == 2) { echo 'Administrator'; } else { echo 'Public User'; }?></small>
                  </p>
               </li>
               <li class="user-footer">
                  <div class="pull-left">
                     <a href="<?=site_url();?>profile" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                     <a href="<?=site_url();?>logout" class="btn btn-danger btn-flat">Sign out</a>
                  </div>
               </li>
            </ul>
         </li>
      </ul>
   </div>
</div>