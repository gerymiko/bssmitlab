<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>PORTAL HRD | PT BINA SARANA SUKSES</title>
   <meta name="description" content="web.binasaranasukses.com/portal" />
   <meta name="keywords" content="web.binasaranasukses.com/portal" />
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta property="og:type" content="business.business">
   <meta property="og:title" content="PT BINA SARANA SUKSES">
   <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
   <meta property="og:url" content="web.binasaranasukses.com/portal">
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
<body class="hold-transition skin-blue-light fixed sidebar-mini">
   <div class="wrapper">
      <div id="loading" class="loading hidden"></div>
      <header class="main-header">
         <a href="#" class="logo">
            <span class="logo-mini"><img src="<?=site_url();?>syslink/logo_small" width="40"></span>
            <span class="logo-lg"><img src="<?=site_url();?>syslink/logo" width="100"></span>
         </a>
         <?php $this->load->view($topmenu);?>
      </header>
      <aside class="main-sidebar">
         <?php $this->load->view($sidemenu);?>
      </aside>
      <div class="content-wrapper">
         <?php $this->load->view($content);?>
      </div>
      <footer class="main-footer">
         <div class="pull-right hidden-xs">
            <b>Version</b> 3.0.0
         </div>
         <strong>Copyright &copy; <?=date("Y");?> <a href="#" class="text-red">PT BINA SARANA SUKSES</a></strong>
      </footer>
   </div>
   <a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>

   <?php $this->load->view($footer); ?>
   <script>
      $(function () {
         $('a[data-toggle="push-menu"]').on('click', function(e){ 
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
            $(".dataTables_scrollHeadInner").css( "width", "100%" );
            $(".dataTables_scrollHeadInner table").css( "width", "100%" );
         });
         $('.modal').on('hidden.bs.modal', function(){ var modal = $(this);modal.validate().resetForm();modal.find('.error').removeClass('error'); });
         $(".select2").select2({ placeholder: "Pilih", allowClear: true });
         $(window).scroll(function(){ if ($(this).scrollTop() > 100){ $('#scroll').fadeIn();} else { $('#scroll').fadeOut();}}); 
         $('#scroll').click(function(){ $("html, body").animate({ scrollTop: 0 }, 600);return false;}); 
      });
      $(document).ajaxStart(function(){ Pace.restart();});
   </script>
</body>
</html>
