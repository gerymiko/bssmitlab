<nav class="navbar navbar-static-top">
   <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <i class="fas fa-bars"></i>
      <span class="sr-only">Toggle navigation</span>
   </a>

   <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
         <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <img src="<?=site_url();?>s_url/icon_user" class="user-image" alt="user">
               <span class="hidden-xs"><?=$this->session->userdata('bssID');?></span>
            </a>
            <ul class="dropdown-menu">
               <li class="user-header">
                  <p>
                     <?=$this->session->userdata('bssID')?>
                     <small><?=$this->session->userdata('users_fullname')?></small>
                     <small>You're <?php if($this->session->userdata('level_id') == 1 ){ echo 'Super Administrator'; } elseif ($this->session->userdata('level_id') == 2) { echo 'Administrator'; } else { echo 'Public Admin'; }?></small>
                  </p>
               </li>
               <li class="user-footer">
                  <div class="pull-left">
                     <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                     <a href="<?=site_url();?>logivalja" class="btn btn-danger btn-flat">Keluar</a>
                  </div>
               </li>
            </ul>
         </li>
      </ul>
   </div>
</nav>