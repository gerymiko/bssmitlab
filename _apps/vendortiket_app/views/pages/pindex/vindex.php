<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>VENDOR TIKET | PT BINA SARANA SUKSES</title>
   <meta name="description" content="web.binasaranasukses.com/vendor_tiket" />
   <meta name="keywords" content="web.binasaranasukses.com/vendor_tiket" />
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta property="og:type" content="business.business">
   <meta property="og:title" content="PT BINA SARANA SUKSES">
   <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
   <meta property="og:url" content="web.binasaranasukses.com/vendor_tiket">
   <meta property="og:image" content="<?=site_url();?>s_url/logo_favicon">
   <meta property="business:contact_data:street_address" content="Jl. Pantai Indah Utara 2, Pantai Indah Kapuk Penjaringan">
   <meta property="business:contact_data:locality" content="Jakarta">
   <meta property="business:contact_data:region" content="DKI Jakarta">
   <meta property="business:contact_data:postal_code" content="14460">
   <meta property="business:contact_data:country_name" content="Indonesia">
   <link rel="shortcut icon" type="image/png" href="<?=site_url();?>syslink/logo_favicon"/>
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
<body id="body" class="hold-transition skin-red-light sidebar-mini">
   <div class="wrapper">

      <header class="main-header">
         <a href="#" class="logo">
            <span class="logo-mini"><img src="<?=site_url();?>syslink/logo_small"></span>
            <span class="logo-lg"><img src="<?=site_url();?>syslink/logo_small"></span>
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
                        <i class="fas fa-users-cog"></i>
                        <span class="hidden-xs"><?=$this->session->userdata('users_fullname');?></span>
                     </a>

                     <ul class="dropdown-menu">
                        <li class="user-header">
                           <p>
                              <small><?=$this->session->userdata('users_fullname')?></small>
                           </p>
                        </li>
                        <li class="user-footer">
                           <div class="pull-left">
                              <a href="<?=site_url();?>cpanel/syspanel/logout" class="btn btn-default btn-flat">Keluar</a>
                           </div>
                            <div class="pull-right">
                              <a href="<?=site_url();?>cpanel/sysprofil/profil" class="btn bg-red btn-flat">Profil</a>
                           </div>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </nav>
      </header>

      <aside class="main-sidebar">
         <?php
         $this->load->view($sidebar);
         ?>
      </aside>

      <div class="content-wrapper">
         <?php
         $this->load->view($content);
         ?>
      </div>

      <footer class="main-footer">
         <!-- <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
         </div> -->
         <strong>&copy; <?=date("Y")?> <a href="#" class="red">PT BINA SARANA SUKSES</a></strong>
      </footer>

   </div>

   <!-- Bottom Script -->
   <?php
   $this->load->view($footer);
   ?>

   <script>
      $(function () {
         var date = new Date();
         date.setDate(date.getDate());

         $('.datepicker').datepicker({ 
            autoclose: true,
            format: "dd-mm-yyyy",
            startDate: date,
            todayHighlight: true,
            daysOfWeekHighlighted: "0",
            todayBtn: "linked",
            numberOfMonths:[2,3]
         })

         $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
         })

         $('[data-toggle="popover"]').popover();
         $('[data-toggle="tooltip"]').tooltip();
      });
   </script>
</body>
</html>
