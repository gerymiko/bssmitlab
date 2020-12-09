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
            <a href="#" class="sidebar-toggle mobilex text-blue" data-toggle="push-menu" role="button">
               <i class="fas fa-bars"></i>
               <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
               <ul class="nav navbar-nav">
                  <li class="dropdown messages-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <?=$this->session->userdata('site')?>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="header bg-navy">Pilih Site</li>
                        <li>
                           <ul class="menu">
                              <?php
                                 foreach ($list_site as $row) {
                                    if ($row->status_active == 1) {
                                       echo '<li><a href="'.site_url('page/welcome/').$row->code.'">'.$row->code.' ('.$row->name.')</a></li>';
                                    } else {
                                       echo '<li><a data-toggle="modal" data-target="#modal-warning">'.$row->code.' ('.$row->name.')</a></li>';
                                    }
                                 }
                              ?>
                           </ul>
                        </li>
                     </ul>
                  </li>
                  <li class="dropdown user user-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?=site_url()?>getimage/png/user" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?=$this->session->userdata('nik')?></span>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="user-header" style="background-image: linear-gradient(to right, #f83600 0%, #f9d423 100%);color: #fff;">
                           <b><?=$this->session->userdata('fullname')?></b>
                        </li>
                        <li class="box box-default no-margin">
                           <div class="box-footer no-padding">
                             <ul class="nav nav-pills nav-stacked">
                               <li><a class="hand" href="#">Pengaturan <span class="pull-right"><i class="text-gray fas fa-cog"></i></span></a></li>
                               <li><a class="hand" href="<?=site_url()?>logout">Keluar <span class="pull-right text-red"><i class="fas fa-power-off"></i></span></a>
                               </li>
                             </ul>
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
               <li>
                  <a href="#" class="sidebar-toggle desktopx text-blue" data-toggle="push-menu" role="button">
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
                              <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-circle f10 text-yellow"></i> <span>'.$row->name.'</span></a>
                           </li>';
                        }
                     }
                     echo '<li class="header ls1">ADMIN MENU</li>';
                     echo '<li class="treeview" id="master-treeview">
                              <a href="#">
                                 <i class="fas fa-circle f10 text-yellow"></i> <span>Master</span>
                                 <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                 </span>
                              </a>
                              <ul class="treeview-menu">';
                                 $no = 0;
                                 foreach ($menu as $row) {
                                    if (substr($row->alias, 0, 6) == 'master') {
                                       echo '<li id="link_'.$row->alias.'">
                                          <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><span class="label bg-blue">'.$no.'</span> <span>'.substr($row->name, 6).'</span></a>
                                       </li>';
                                    }
                                    $no++;
                                 }
                              echo '</ul>
                           </li>';
                     foreach ($menu as $row) {
                        if ($row->type == 'S' && substr($row->alias, 0, 6) != 'master') {
                           echo '<li id="link_'.$row->alias.'">
                              <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-circle f10 text-yellow"></i> <span>'.$row->name.'</span></a>
                           </li>';
                        }
                     }
                  } elseif ($accessRights->id_level == 2) {
                     foreach ($menu as $row) {
                        if ($row->type == 'P') {
                           echo 
                           '<li id="link_'.$row->alias.'">
                              <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-circle f10 text-yellow"></i> <span>'.$row->name.'</span></a>
                           </li>';
                        }
                     }
                     echo '<li class="header ls1">ADMIN MENU</li>';
                     foreach ($menu as $row) {
                        if ($row->type == 'A') {
                           echo 
                           '<li id="link_'.$row->alias.'">
                              <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-circle f10 text-yellow"></i> <span>'.$row->name.'</span></a>
                           </li>';
                        }
                     }
                  } else {
                     foreach ($menu as $row) {
                        if ($row->type == 'P') {
                           echo 
                           '<li id="link_'.$row->alias.'">
                              <a href="'.site_url('menu/').$row->alias.'/'.$this->uri->segment(3).'"><i class="fas fa-circle f10 text-yellow"></i> <span>'.$row->name.'</span></a>
                           </li>';
                        }
                     }
                  }
               ?>
            </ul>
         </section>
      </aside>
      <div class="content-wrapper">
         <nav class="navbar navbar-static-top desktopx" style="margin-bottom:0;background-image:linear-gradient(120deg, #fdfbfb 0%, #E3E3E3 100%);z-index: 800;">
            <div class="navbar-custom-menu">
               <ul class="nav navbar-nav" style="float: right;">
                  <li class="dropdown messages-menu">
                     <a href="#" class="dropdown-toggle text-black" data-toggle="dropdown" aria-expanded="true">
                        <?=$this->session->userdata('site')?>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="header bg-navy">Pilih Site</li>
                        <li>
                           <ul class="menu">
                              <?php
                                 foreach ($list_site as $row) {
                                    if ($row->status_active == 1) {
                                       echo '<li><a href="'.site_url('page/welcome/').$row->code.'">'.$row->code.' ('.$row->name.')</a></li>';
                                    } else {
                                       echo '<li><a data-toggle="modal" data-target="#modal-warning">'.$row->code.' ('.$row->name.')</a></li>';
                                    }
                                 }
                              ?>
                           </ul>
                        </li>
                     </ul>
                  </li>
                  <li class="dropdown user user-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?=site_url()?>getimage/png/user" class="user-image" alt="User Image">
                        <span class="hidden-xs text-black"><?=$this->session->userdata('nik')?></span>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="user-header" style="background-image: linear-gradient(to right, #f83600 0%, #f9d423 100%);color: #fff;">
                           <b><?=$this->session->userdata('fullname')?></b>
                        </li>
                        <li class="box box-default no-margin">
                           <div class="box-footer no-padding">
                             <ul class="nav nav-pills nav-stacked">
                               <li><a class="hand" href="#">Pengaturan <span class="pull-right"><i class="text-gray fas fa-cog"></i></span></a></li>
                               <li><a class="hand" href="<?=site_url()?>logout">Keluar <span class="pull-right text-red"><i class="fas fa-power-off"></i></span></a>
                               </li>
                             </ul>
                           </div>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </nav>
         <?php $this->load->view($content);?>
      </div>
      <footer class="main-footer">
         <div class="pull-right hidden-xs f10" style="padding-top: 4px;"><b>EPGIN</b> v1</div>
         &copy; <?=date("Y");?> <strong><a href="#" class="text-red">PT BINA SARANA SUKSES</a></strong>
      </footer>
   </div>
   <a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>
   <div class="modal" tabindex="-1" role="dialog" id="modal-warning">
      <div class="modal-dialog center" role="document">
         <div class="modal-content">
            <div class="modal-header no-border">
               <h4 class="modal-title">Informasi
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </h4>
            </div>
            <div class="modal-body">
               <p>EPGIN di site ini masih dalam PROGRESS pemasangan.</p>
            </div>
            <div class="modal-footer no-border">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
         </div>
      </div>
   </div>
   <?php $this->load->view($footer); ?>
   <script>
      $(function () {
         $('a[data-toggle="push-menu"], a[data-toggle="tab"]').on('click', function(e){ $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();$(".dataTables_scrollHeadInner").css( "width", "100%" );$(".dataTables_scrollHeadInner table").css( "width", "100%" );$($.fn.dataTable.tables( true ) ).DataTable().columns.adjust().responsive.recalc();});
         $('.modal').on('hidden.bs.modal', function(){ var modal = $(this);modal.validate().resetForm();modal.find('.error').removeClass('error'); });
         $(window).scroll(function(){ if ($(this).scrollTop() > 100){ $('#scroll').fadeIn();} else { $('#scroll').fadeOut();}}); 
         $('#scroll').click(function(){ $("html, body").animate({ scrollTop: 0 }, 600);return false;}); 
      });
      $(document).ajaxStart(function(){ Pace.restart();});
   </script>
</body>
</html>
