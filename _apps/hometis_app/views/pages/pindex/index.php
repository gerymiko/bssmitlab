<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>HOMETIS | PT BINA SARANA SUKSES</title>
   <meta name="description" content="web.binasaranasukses.com/hometis" />
   <meta name="keywords" content="web.binasaranasukses.com/hometis" />
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta property="og:type" content="business.business">
   <meta property="og:title" content="PT BINA SARANA SUKSES">
   <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
   <meta property="og:url" content="web.binasaranasukses.com/hometis">
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
            <span class="logo-lg"><img src="<?=site_url();?>syslink/logo_dashboard" width="100"></span>
         </a>
         <?php $this->load->view($topmenu);?>
      </header>
      <aside class="main-sidebar">
         <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
               <li class="header ls1">MAIN NAVIGATION</li>
               <?php
                  if ($accessRights->id_level == 1){
                     foreach ($sidemenu as $row){
                        if ($row->module_name !== 'hm_detail' && $row->module_name !== 'master_system' && $row->module_name !== 'master_system_version' && $row->module_name !== 'master_system_module' && $row->module_name !== 'master_site' && $row->module_name !== 'master_user')
                           echo '<li id="link-'.$row->module_name.'"><a href="'.site_url('menu/').$row->module_name.'/'.$this->uri->segment(3).'"><i class="far fa-circle text-blue"></i> <span>'.$row->alias.'</span></a></li>';
                     }
                     echo '<li class="header ls1">ADMIN NAVIGATION</li>';
                     foreach ($sidemenu as $row){
                        if ($row->module_name !== 'hm_detail' && $row->module_name !== 'dashboard' && $row->module_name !== 'resume_hm')
                           echo '<li id="link-'.$row->module_name.'"><a href="'.site_url('menu/').$row->module_name.'/'.$this->uri->segment(3).'"><i class="far fa-circle text-blue"></i> <span>'.$row->alias.'</span></a></li>';
                     }
                     echo '<li id="link-logs"><a href="'.site_url('menu/logs/').$this->uri->segment(3).'"><i class="far fa-circle text-blue"></i> <span>Logs</span></a></li>';
                  } elseif ($accessRights->id_level == 3){
                     foreach ($sidemenu as $row){
                        if ($row->module_name !== 'hm_detail' && $row->module_name !== 'master_system' && $row->module_name !== 'master_system_version' && $row->module_name !== 'master_system_module' && $row->module_name !== 'master_site' && $row->module_name !== 'master_user' )
                           echo '<li id="link-'.$row->module_name.'"><a href="'.site_url('menu/').$row->module_name.'/'.$this->uri->segment(3).'"><i class="far fa-circle text-blue"></i> <span>'.$row->alias.'</span></a></li>';
                     }
                  } else {
                     foreach ($sidemenu as $row){
                        if ($row->module_name !== 'hm_detail' && $row->module_name !== 'master_system' && $row->module_name !== 'master_system_version' && $row->module_name !== 'master_system_module' && $row->module_name !== 'master_site' && $row->module_name !== 'master_user')
                           echo '<li id="link-'.$row->module_name.'"><a href="'.site_url('menu/').$row->module_name.'/'.$this->uri->segment(3).'"><i class="far fa-circle text-blue"></i> <span>'.$row->alias.'</span></a></li>';
                     }
                     echo '<li class="header ls1">ADMIN NAVIGATION</li>';
                     foreach ($sidemenu as $row){
                        if ($row->module_name !== 'hm_detail' && $row->module_name !== 'dashboard' && $row->module_name !== 'resume_hm' && $row->module_name !== 'master_system' && $row->module_name !== 'master_system_version' && $row->module_name !== 'master_system_module' && $row->module_name !== 'master_site')
                           echo '<li id="link-'.$row->module_name.'"><a href="'.site_url('menu/').$row->module_name.'/'.$this->uri->segment(3).'"><i class="far fa-circle text-blue"></i> <span>'.$row->alias.'</span></a></li>';
                     }
                  }
               ?>
               <li class="header ls1">SITE MENU</li>
               <li>
                  <a href="<?=site_url()?>menu/site">
                     <i class="far fa-circle text-blue"></i> <span>Change Site</span>
                  </a>
               </li>
            </ul>
         </section>
      </aside>
      <div class="content-wrapper">
         <?php $this->load->view($content);?>
      </div>
      <footer class="main-footer">
         <strong>Copyright &copy; <?=date("Y");?> <a href="#" class="text-red">PT BINA SARANA SUKSES</a></strong>
      </footer>
   </div>
   <a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>
   <?php $this->load->view($footer); ?>
   <script>
      $(function () {
         $('[data-toggle="popover"]').popover();
         $('[data-toggle="tooltip"]').tooltip();
         $('body').tooltip({selector: '[data-toggle="tooltip"]'});
         $('a[data-toggle="push-menu"]').on('click', function(e){ 
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
            $(".dataTables_scrollHeadInner").css( "width", "100%" );
            $(".dataTables_scrollHeadInner table").css( "width", "100%" );
         });
         $('.modal').on('hidden.bs.modal', function(){ var modal = $(this);modal.validate().resetForm();modal.find('.error').removeClass('error'); });
         $(window).scroll(function(){ if ($(this).scrollTop() > 100){ $('#scroll').fadeIn();} else { $('#scroll').fadeOut();}}); 
         $('#scroll').click(function(){ $("html, body").animate({ scrollTop: 0 }, 600);return false;}); 
      });
      $(document).ajaxStart(function(){ Pace.restart();});
   </script>
</body>
</html>
