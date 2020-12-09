<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>EPGIN | PT BINA SARANA SUKSES</title>
   <meta name="description" content="web.binasaranasukses.com/epgin" />
   <meta name="keywords" content="web.binasaranasukses.com/epgin" />
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta property="og:type" content="business.business">
   <meta property="og:title" content="PT BINA SARANA SUKSES">
   <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
   <meta property="og:url" content="web.binasaranasukses.com/epgin">
   <meta property="og:image" content="<?=site_url();?>getimage/png/favicon">
   <meta property="business:contact_data:street_address" content="Jl. Pantai Indah Utara 2, Pantai Indah Kapuk Penjaringan">
   <meta property="business:contact_data:locality" content="Jakarta">
   <meta property="business:contact_data:region" content="DKI Jakarta">
   <meta property="business:contact_data:postal_code" content="14460">
   <meta property="business:contact_data:country_name" content="Indonesia">
   <link rel="shortcut icon" type="image/png" href="<?=site_url();?>getimage/png/favicon"/>
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
<body class="hold-transition skin-blue-light fixed sidebar-mini">
   <div class="wrapper">
      <div id="loading" class="loading hidden"></div>
      <header class="main-header mobilex">
         <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle mobilex text-orange" data-toggle="push-menu" role="button">
               <i class="fas fa-bars"></i>
               <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- <div class="navbar-custom-menu">
               <ul class="nav navbar-nav">
                  <li class="dropdown tasks-menu hand">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?=$this->session->userdata('site')?>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="header">Pilih site</li>
                        <li>
                           <ul class="menu">
                              <?php
                                 foreach ($list_site as $row) {
                                    echo '
                                       <li><a href="'.site_url('page/welcome/').$row->code.'">'.$row->code.' ('.$row->name.')</a></li>
                                    ';
                                 }
                              ?>
                           </ul>
                        </li>
                     </ul>
                  </li>
                  <li class="dropdown user user-menu hand">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?=site_url()?>getimage/png/user" class="user-image" alt="User Image">
                     </a>
                     <ul class="dropdown-menu">
                        <li class="user-footer">
                           <div class="pull-left">
                              <a href="#" class="btn btn-default btn-flat">Profil</a>
                           </div>
                           <div class="pull-right">
                              <a href="<?=site_url()?>logout" class="btn bg-red btn-flat"><i class="fas fa-power-off f10"></i> Keluar</a>
                           </div>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div> -->
         </nav>
      </header>
      <<!-- nav class="navbar navbar-static-top desktopx" style="margin-bottom: 0;border: none;">
         <div class="navbar-custom-menu pull-right">
            <ul class="nav navbar-nav">
               <li class="dropdown tasks-menu hand">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                     <b class="text-black"><?=$this->session->userdata('site')?></b>
                  </a>
                  <ul class="dropdown-menu">
                     <li class="header bg-navy">Pilih site</li>
                     <li>
                        <ul class="menu">
                           <?php
                              foreach ($list_site as $row) {
                                 echo '
                                    <li><a class="text-black" href="'.site_url('page/welcome/').$row->code.'">'.$row->code.' ('.$row->name.')</a></li>
                                 ';
                              }
                           ?>
                        </ul>
                     </li>
                  </ul>
               </li>
               <li class="dropdown user user-menu hand">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                     <img src="<?=site_url()?>getimage/png/user" class="user-image" alt="User Image">
                  </a>
                  <ul class="dropdown-menu">
                     <li class="user-footer">
                        <div class="pull-left">
                           <a href="#" class="btn btn-default btn-flat">Profil</a>
                        </div>
                        <div class="pull-right">
                           <a href="<?=site_url()?>logout" class="btn bg-red btn-flat"><i class="fas fa-power-off f10"></i> Keluar</a>
                        </div>
                     </li>
                  </ul>
               </li>
            </ul>
         </div>
      </nav> -->

      <aside class="main-sidebar">
         <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
               <li>
                  <a href="#" class="sidebar-toggle desktopx text-navy" data-toggle="push-menu" role="button">
                     <i class="fas fa-bars"></i>
                     <span class="sr-only">Toggle navigation</span>
                  </a>
               </li>
               <li class="header ls1">MENU</li>
               <?php
                  if ($accessRights->id_level == 1){
                     foreach ($menu as $row) {
                        if ($row->type == 'P') {
                           echo 
                           '<li id="link_'.$row->alias.'">
                              <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-caret-right f10"></i> <span>'.$row->name.'</span></a>
                           </li>';
                        }
                     }
                     echo '<li class="header ls1">ADMIN MENU</li>';
                     foreach ($menu as $row) {
                        if ($row->type == 'S' || $row->type == 'A') {
                           echo 
                           '<li id="link_'.$row->alias.'">
                              <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-caret-right f10"></i> <span>'.$row->name.'</span></a>
                           </li>';
                        }
                     }
                  } elseif ($accessRights->id_level == 2) {
                     foreach ($menu as $row) {
                        if ($row->type == 'P') {
                           echo 
                           '<li id="link_'.$row->alias.'">
                              <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-caret-right f10"></i> <span>'.$row->name.'</span></a>
                           </li>';
                        }
                     }
                     echo '<li class="header ls1">ADMIN MENU</li>';
                     foreach ($menu as $row) {
                        if ($row->type == 'A') {
                           echo 
                           '<li id="link_'.$row->alias.'">
                              <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-caret-right f10"></i> <span>'.$row->name.'</span></a>
                           </li>';
                        }
                     }
                  } else {
                     foreach ($menu as $row) {
                        if ($row->type == 'P') {
                           echo 
                           '<li id="link_'.$row->alias.'">
                              <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-caret-right f10"></i> <span>'.$row->name.'</span></a>
                           </li>';
                        }
                     }
                  }
               ?>
            </ul>
         </section>
      </aside>
      <div class="content-wrapper">        
         <?php $this->load->view($content);?>
      </div>
      <footer class="main-footer">
         <div class="pull-right hidden-xs f10" style="padding-top: 4px;"><b>EPGIN</b> version 1.0.0</div>
         Copyright &copy; <?=date("Y");?> <strong><a href="#" class="text-red">PT BINA SARANA SUKSES</a></strong>
      </footer>
   </div>
   <a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>
   <?php $this->load->view($footer); ?>
   <script>
      $(function () {
         $('a[data-toggle="push-menu"]').on('click', function(e){ $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();$(".dataTables_scrollHeadInner").css( "width", "100%" );$(".dataTables_scrollHeadInner table").css( "width", "100%" );});
         $('.modal').on('hidden.bs.modal', function(){ var modal = $(this);modal.validate().resetForm();modal.find('.error').removeClass('error'); });
         $(window).scroll(function(){ if ($(this).scrollTop() > 100){ $('#scroll').fadeIn();} else { $('#scroll').fadeOut();}}); 
         $('#scroll').click(function(){ $("html, body").animate({ scrollTop: 0 }, 600);return false;});
      });
      $(document).ajaxStart(function(){ Pace.restart();});
   </script>
</body>
</html>
