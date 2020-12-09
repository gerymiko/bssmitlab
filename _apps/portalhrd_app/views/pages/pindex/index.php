<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>PORTAL HRD | PT BINA SARANA SUKSES</title>
   <meta name="description" content="web.binasaranasukses.com/portalhrd" />
   <meta name="keywords" content="web.binasaranasukses.com/portalhrd" />
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta property="og:type" content="business.business">
   <meta property="og:title" content="PT BINA SARANA SUKSES">
   <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
   <meta property="og:url" content="web.binasaranasukses.com/portalhrd">
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
</head>
<body class="hold-transition skin-blue-light fixed sidebar-mini">
   <div class="wrapper">
      <div id="loading" class="loading hidden"></div>
      <header class="main-header mobilex">
         <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle mobilex text-navy" data-toggle="push-menu" role="button">
               <i class="fas fa-bars"></i>
               <span class="sr-only">Toggle navigation</span>
            </a>
         </nav>
      </header>
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
               <li id="dashboard" class="hidden">
                  <a href="<?=site_url()?>m/dashboard">
                     <i class="fas fa-caret-right"></i> <span>Dashboard</span>
                  </a>
               </li>
               <?php if($accessRights->level_id == 1 || $accessRights->level_id == 2 ){ ?>
                  <li id="privilege">
                     <a href="<?=site_url()?>m/privilege">
                        <i class="fas fa-caret-right"></i> <span>Master User</span>
                     </a>
                  </li>
                  <li id="logs">
                     <a href="<?=site_url()?>m/weblogs">
                        <i class="fas fa-caret-right"></i> <span>Master Log</span>
                     </a>
                  </li>
               <?php } ?>
               <li id="profile">
                  <a href="<?=site_url()?>m/myprofile">
                     <i class="fas fa-caret-right"></i> <span>Profil Saya</span>
                  </a>
               </li>
               <li class="header ls1">REKRUTMEN KARYAWAN</li>
               <li class="treeview" id="recruit">
                  <a href="#">
                     <i class="fas fa-caret-right"></i> <span>Website</span>
                     <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                     </span>
                  </a>
                  <ul class="treeview-menu">
                     <li id="recruit-vacancy"><a href="<?=site_url()?>m/web/vacancy"><span class="label bg-navy">1</span> Daftar Lowongan</a></li>
                     <li class="treeview" id="recruit-treeview">
                        <a href="#"><span class="label bg-navy">2</span> Pelamar
                           <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                           </span>
                        </a>
                        <ul class="treeview-menu">
                           <li id="recruit-register"><a href="<?=site_url()?>m/web/applicant/registered"><span class="label bg-gray">A</span> Pengguna Terdaftar</a></li>
                           <li id="recruit-applicant"><a href="<?=site_url()?>m/web/applicant/all"><span class="label bg-gray">B</span> Seluruh Pelamar</a></li>
                           <li id="recruit-qualify"><a href="<?=site_url()?>m/web/applicant/qualified"><span class="label bg-gray">C</span> Kualifikasi</a></li>
                           <li id="recruit-failed"><a href="<?=site_url()?>m/web/applicant/failed"><span class="label bg-gray">E</span> Pelamar Gagal</a></li>
                           <li id="recruit-pre_election"><a href="<?=site_url()?>m/web/applicant/pre_election"><span class="label bg-gray">F</span> Pra-pemilihan</a></li>
                           <li id="recruit-agreement"><a href="<?=site_url()?>m/web/applicant/agreement"><span class="label bg-gray">G</span> Agreement</a></li>
                        </ul>
                     </li>
                     <li class="treeview" id="monitor-treeview">
                        <a href="#"><span class="label bg-navy">3</span> Monitoring Interview
                           <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                           </span>
                        </a>
                        <ul class="treeview-menu">
                           <li id="monitor-recap"><a href="<?=site_url()?>m/web/applicant/monitoring"><span class="label bg-gray">A</span> Rekap Monitoring</a></li>
                           <li><a href="#"><span class="label bg-gray">B</span> Pelamar Lolos</a></li>
                        </ul>
                     </li>
                     <li class="treeview" id="master-treeview">
                        <a href="#"><span class="label bg-navy">4</span> Master Data
                           <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                           </span>
                        </a>
                        <ul class="treeview-menu">
                           <li id="master-skill"><a href="<?=site_url()?>m/web/master/skill"><span class="label bg-gray">A</span> Kemampuan</a></li>
                           <li id="master-cond"><a href="<?=site_url()?>m/web/master/condition"><span class="label bg-gray">B</span> Syarat</a></li>
                           <li id="master-cert"><a href="<?=site_url()?>m/web/master/certificate"><span class="label bg-gray">C</span> Sertifikat</a></li>
                           <li id="master-pic"><a href="<?=site_url()?>m/web/master/pic"><span class="label bg-gray">D</span> PIC</a></li>
                           <li id="master-dept"><a href="<?=site_url()?>m/web/master/department"><span class="label bg-gray">E</span> Departemen</a></li>
                           <li id="master-pos"><a href="<?=site_url()?>m/web/master/#"><span class="label bg-gray">F</span> Jabatan</a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <li class="treeview" id="recman">
                  <a href="#">
                     <i class="fas fa-caret-right"></i> <span>Formulir</span>
                     <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                     </span>
                  </a>
                  <ul class="treeview-menu">
                     <li id="recman-applicant"><a href="<?=site_url()?>m/form/applicant/all"><span class="label bg-navy">1</span> Pelamar</a></li>
                     <li id="recman-applicant-fail"><a href="<?=site_url()?>m/form/applicant/failed"><span class="label bg-navy">2</span> Pelamar Gagal</a></li>
                     <li id="recman-applicant-mcu"><a href="<?=site_url()?>m/form/applicant/medical"><span class="label bg-navy">3</span> Pelamar MCU</a></li>
                  </ul>
               </li>
               <li class="header ls1">KESEHATAN KARYAWAN</li>
               <li>
                  <a target="_blank" href="http://web.binasaranasukses.com/hrmcu" rel="noopener" >
                     <i class="fas fa-caret-right"></i> <span>Pemeriksaan medis (MCU)</span>
                  </a>
               </li>
               <li class="header ls1">PENILAIAN KARYAWAN</li>
               <li>
                  <a target="_blank" href="http://web.binasaranasukses.com/api/profiling" rel="noopener" >
                     <i class="fas fa-caret-right"></i> <span>Profiling</span>
                  </a>
               </li>
               <li class="header"></li>
               <li style="background-color: #EBEBEB;">
                  <a href="<?=site_url();?>m/logivalja">
                     <i class="fas fa-power-off f9"></i> <span>Keluar</span>
                  </a>
               </li>
            </ul>
         </section>
      </aside>
      <div class="content-wrapper">
         <?php $this->load->view($content);?>
      </div>
      <footer class="main-footer">
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
