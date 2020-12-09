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
<body id="body" class="hold-transition skin-blue layout-top-nav">
   <div class="wrapper">
      <div id="loading" class="loading hidden"></div>
      <header class="main-header">
         <nav class="navbar navbar-static-top">
            <?php $this->load->view($menu); ?>
         </nav>
      </header>
      <div class="content-wrapper">
         <div class="container">
            <?php $this->load->view($content);?>
         </div>
      </div>
      <footer class="main-footer">
         <div class="container">
            <strong>Copyright &copy; <?=date("Y");?> <a class="text-red" href="#">PT BINA SARANA SUKSES</a>.</strong> All rights reserved.
         </div>
      </footer>
   </div>

   <!-- Bottom Script -->
   <?php $this->load->view($footer); ?>

   <a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>

   <script>
      $(function () {
         $('[data-toggle="popover"]').popover();
         $('[data-toggle="tooltip"]').tooltip();
         $('body').tooltip({selector: '[data-toggle="tooltip"]'});

         $(window).scroll(function(){ 
            if ($(this).scrollTop() > 100) { 
               $('#scroll').fadeIn(); 
            } else { 
               $('#scroll').fadeOut(); 
            } 
         }); 

         $('#scroll').click(function(){ 
            $("html, body").animate({ scrollTop: 0 }, 600); 
            return false; 
         }); 
      });
   </script>

</body>
</html>
