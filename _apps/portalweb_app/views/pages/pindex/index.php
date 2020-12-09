<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>PORTAL WEB | PT BINA SARANA SUKSES</title>
   <meta name="description" content="web.binasaranasukses.com/portalweb" />
   <meta name="keywords" content="web.binasaranasukses.com/portalweb" />
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta property="og:type" content="business.business">
   <meta property="og:title" content="PT BINA SARANA SUKSES">
   <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
   <meta property="og:url" content="web.binasaranasukses.com/portalweb">
   <meta property="og:image" content="<?=site_url();?>getimage/png/logo_sm">
   <meta property="business:contact_data:street_address" content="Jl. Pantai Indah Utara 2, Pantai Indah Kapuk Penjaringan">
   <meta property="business:contact_data:locality" content="Jakarta">
   <meta property="business:contact_data:region" content="DKI Jakarta">
   <meta property="business:contact_data:postal_code" content="14460">
   <meta property="business:contact_data:country_name" content="Indonesia">
   <link rel="shortcut icon" type="image/png" href="<?=site_url();?>getimage/png/logo_sm"/>
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
        .wall {
            background: url(<?=site_url()?>getimage/jpg/wall) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
            background-size:  cover;
        }
   </style>
</head>
<body class="hold-transition skin-red-light layout-top-nav">
   <div class="wrapper">
      <div id="loading" class="loading hidden"></div>
      <header class="main-header">
         <nav class="navbar navbar-static-top">
            <div class="container">
               <div class="navbar-header">
                  <!-- <a href="#" class="navbar-brand"><img src="<?=site_url();?>getlogo/png/logo-small" width="60"></a> -->
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                     <i class="fa fa-bars"></i>
                  </button>
               </div>
               <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                  <ul class="nav navbar-nav">
                     <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                     <li><a href="#">Link</a></li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="#">Action</a></li>
                           <li><a href="#">Another action</a></li>
                           <li><a href="#">Something else here</a></li>
                           <li class="divider"></li>
                           <li><a href="#">Separated link</a></li>
                           <li class="divider"></li>
                           <li><a href="#">One more separated link</a></li>
                        </ul>
                     </li>
                  </ul>
                  <form class="navbar-form navbar-left" role="search">
                     <div class="form-group">
                        <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                     </div>
                  </form>
               </div>
            </div>
         </nav>
      </header>

      <div class="content-wrapper">
         <div class="container">
            <section class="content-header">
               <h1>
                  WEB PORTAL
                  <small>Choose what you want!</small>
               </h1>
            </section>

            <section class="content">
               <?php $this->load->view($content);?>
            </section>
         </div>
      </div>

      <footer class="main-footer">
         <div class="container">
            <div class="pull-right hidden-xs">
               <b>v</b>1.0
            </div>
            Copyright &copy; <?=date("Y");?> <strong><a href="#" class="text-red">PT BINA SARANA SUKSES</a></strong>
         </div>
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
