<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>MOSENTO | PT BINA SARANA SUKSES</title>
   <meta name="description" content="web.binasaranasukses.com/mosento" />
   <meta name="keywords" content="web.binasaranasukses.com/mosento" />
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta property="og:type" content="business.business">
   <meta property="og:title" content="PT BINA SARANA SUKSES">
   <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
   <meta property="og:url" content="web.binasaranasukses.com/mosento">
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
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
   <div class="wrapper">
      <div id="loading" class="loading hidden"></div>
      <header class="main-header">
         <a href="#" class="logo">
            <span class="logo-mini"><img src="<?=site_url();?>s_url/logo_small" width="40"></span>
            <span class="logo-lg"><img src="<?=site_url();?>s_url/logo" width="130"></span>
         </a>
         <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
               <i class="fas fa-bars"></i>
               <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
               <ul class="nav navbar-nav">
                  <li class="dropdown user user-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?=site_url();?>s_url/icon_user" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?=$this->session->userdata('nik');?></span>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="user-header">
                           <p>
                              <?=$this->session->userdata('fullname')?>
                              <small>You're <?php if($this->session->userdata('id_level') == 1 ){ echo 'Super Administrator'; } elseif ($this->session->userdata('id_level') == 2) { echo 'Administrator'; } else { echo 'Public User'; }?></small>
                           </p>
                        </li>
                        <li class="user-footer">
                           <div class="pull-left">
                              <a href="<?=site_url();?>menu/profile" class="btn btn-default btn-flat">Profile</a>
                           </div>
                           <div class="pull-right">
                              <a href="<?=site_url();?>logout" class="btn btn-danger btn-flat">Sign out</a>
                           </div>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </nav>
      </header>
      <aside class="main-sidebar">
         <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
               <li class="header ls1">MAIN NAVIGATION</li>
               <?php
                  if ($accessRights->id_level == 1){
                     foreach ($menu as $row) {
                        if ($row->name != "detail_warning_fault" && $row->name != "detail_payload" && $row->type == 'P') {
                           echo 
                           '<li id="link_'.$row->name.'">
                              <a href="'.site_url('menu/').$row->name.'/'.$this->uri->segment(3).'"><i class="fas fa-dot-circle"></i> <span>'.$row->alias.'</span></a>
                           </li>';
                        }
                     }
                     echo '<li class="header ls1">ADMIN NAVIGATION</li>';
                     foreach ($menu as $row) {
                        if ($row->name != "detail_warning_fault" && $row->name != "detail_payload" && $row->type == 'S' || $row->type == 'A') {
                           echo 
                           '<li id="link_'.$row->name.'">
                              <a href="'.site_url('menu/').$row->name.'/'.$this->uri->segment(3).'"><i class="fas fa-dot-circle"></i> <span>'.$row->alias.'</span></a>
                           </li>';
                        }
                     }
                  } elseif ($accessRights->id_level == 2) {
                     foreach ($menu as $row) {
                        if ($row->name != "detail_warning_fault" && $row->name != "detail_payload" && $row->type == 'P') {
                           echo 
                           '<li id="link_'.$row->name.'">
                              <a href="'.site_url('menu/').$row->name.'/'.$this->uri->segment(3).'"><i class="fas fa-dot-circle"></i> <span>'.$row->alias.'</span></a>
                           </li>';
                        }
                     }
                     echo '<li class="header ls1">ADMIN NAVIGATION</li>';
                     foreach ($menu as $row) {
                        if ($row->name != "detail_warning_fault" && $row->name != "detail_payload" && $row->type == 'A') {
                           echo 
                           '<li id="link_'.$row->name.'">
                              <a href="'.site_url('menu/').$row->name.'/'.$this->uri->segment(3).'"><i class="fas fa-dot-circle"></i> <span>'.$row->alias.'</span></a>
                           </li>';
                        }
                     }
                  } else {
                     foreach ($menu as $row) {
                        if ($row->name != "detail_warning_fault" && $row->name != "detail_payload" && $row->type == 'P') {
                           echo 
                           '<li id="link_'.$row->name.'">
                              <a href="'.site_url('menu/').$row->name.'/'.$this->uri->segment(3).'"><i class="fas fa-dot-circle"></i> <span>'.$row->alias.'</span></a>
                           </li>';
                        }
                     }
                  }
               ?>
               <li class="header ls1">SITE MENU</li>
               <li>
                  <a href="<?=site_url()?>menu/site">
                     <i class="fas fa-dot-circle"></i> <span>Change Site</span>
                  </a>
               </li>
            </ul>
         </section>
      </aside>
      <div class="content-wrapper">
         <?php $this->load->view($content);?>
      </div>
      <footer class="main-footer">
         <strong>Copyright &copy; <?=date("Y");?> <a class="text-red" href="#">PT BINA SARANA SUKSES</a></strong>
      </footer>
   </div>
   <?php $this->load->view($footer); ?>
   <a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>
   <script>
      $(function(){$('[data-toggle="tooltip"]').tooltip();$('body').tooltip({selector: '[data-toggle="tooltip"]'});$(window).scroll(function(){if ($(this).scrollTop() > 100){$('#scroll').fadeIn();} else {$('#scroll').fadeOut();}});$('#scroll').click(function(){$("html, body").animate({ scrollTop: 0 }, 600);return false;});
         $('a[data-toggle="push-menu"]').on('click', function(e){$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();$(".dataTables_scrollHeadInner").css( "width", "100%" );$(".dataTables_scrollHeadInner table").css( "width", "100%" );});
      });
   </script>
</body>
</html>
