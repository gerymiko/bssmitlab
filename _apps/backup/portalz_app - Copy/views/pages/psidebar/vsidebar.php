<section class="sidebar">
   <ul class="sidebar-menu" data-widget="tree">
      <li class="header">NAVIGASI UTAMA</li>
      <li class="" id="dashboard">
         <a href="<?=site_url()?>menu/dashboard">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
         </a>
      </li>
      <?php if($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 2 ){ ?>
      <li class="" id="privilege">
         <a href="<?=site_url()?>cprivilege/sysprivilege">
            <i class="fas fa-user-lock"></i> <span>Hak Akses</span>
         </a>
      </li>
      <?php } ?>
      <li class="header">REKRUTMEN</li>
      <li class="treeview" id="recruit">
         <a href="#">
            <i class="fas fa-globe"></i><span> Web Karir</span>
            <span class="pull-right-container">
               <span><i class="fas fa-angle-down pull-right"></i></span>
            </span>
         </a>
         <ul class="treeview-menu">
            <li id="recruit-vacancy"><a href="<?=site_url()?>recweb/menu/vacancy"><span class="label label-primary">1</span> Daftar Lowongan</a></li>
            <li class="treeview" id="recruit-treeview">
               <a href="#"><span class="label label-primary">2</span> Pelamar
                  <span class="pull-right-container">
                     <span class="label label-warning pull-right">6</span>
                  </span>
               </a>
               <ul class="treeview-menu">
                  <li id="recruit-register"><a href="<?=site_url()?>recweb/menu/applicant/register"><span class="label label-danger">A</span> Pengguna Terdaftar</a></li>
                  <li id="recruit-applicant"><a href="<?=site_url()?>recweb/menu/applicant/list"><span class="label label-danger">B</span> Seluruh Pelamar</a></li>
                  <li id="recruit-qualify"><a href="<?=site_url()?>recweb/menu/applicant/qualify"><span class="label label-danger">C</span> Kualifikasi</a></li>
                  <li id="recruit-failed"><a href="<?=site_url()?>recweb/menu/applicant/failed"><span class="label label-danger">E</span> Pelamar Gagal</a></li>
                  <li id="recruit-election"><a href="crecruit/web/#"><span class="label label-danger">F</span> Pra-pemilihan</a></li>
                  <li id="recruit-agreement"><a href="crecruit/web/#"><span class="label label-danger">G</span> Agreement</a></li>
               </ul>
            </li>
            <li class="treeview" id="monitor-treeview">
               <a href="#"><span class="label label-primary">3</span> Monitoring Interview
                  <span class="pull-right-container">
                     <span class="label label-warning pull-right">2</span>
                  </span>
               </a>
               <ul class="treeview-menu">
                  <li id="monitor-recap"><a href="<?=site_url()?>recweb/menu/applicant/monitor"><span class="label label-danger">A</span> Rekap Monitoring</a></li>
                  <li><a href="#"><span class="label label-danger">B</span> Pelamar Lolos</a></li>
               </ul>
            </li>
            <li class="treeview">
               <a href="#"><span class="label label-primary">4</span> Master Data
                  <span class="pull-right-container">
                     <span class="label label-warning pull-right">6</span>
                  </span>
               </a>
               <ul class="treeview-menu">
                  <li><a href="#"><span class="label label-danger">A</span> Kemampuan</a></li>
                  <li><a href="#"><span class="label label-danger">B</span> Syarat</a></li>
                  <li><a href="#"><span class="label label-danger">C</span> Sertifikat</a></li>
                  <li><a href="#"><span class="label label-danger">D</span> PIC</a></li>
                  <li><a href="#"><span class="label label-danger">E</span> Departemen</a></li>
                  <li><a href="#"><span class="label label-danger">F</span> Jabatan</a></li>
               </ul>
            </li>
         </ul>
      </li>
      <li class="treeview" id="recman">
         <a href="#">
            <i class="fas fa-clipboard"></i><span> Manual</span>
            <span class="pull-right-container">
               <span><i class="fas fa-angle-down pull-right"></i></span>
            </span>
         </a>
         <ul class="treeview-menu">
            <li id="recman-applicant"><a href="<?=site_url()?>recman/menu/status/applicant"><span class="label label-primary">1</span> Pelamar</a></li>
            <li id="recman-applicant-fail"><a href="<?=site_url()?>recman/menu/failed/applicant"><span class="label label-primary">2</span> Pelamar Gagal</a></li>
            <li id="recman-applicant-mcu"><a href="<?=site_url()?>recman/menu/medical/applicant"><span class="label label-primary">3</span> Pelamar MCU</a></li>
         </ul>
      </li>
      <li class="header">MEDIKAL</li>
      <li>
         <a target="_blank" href="http://web.binasaranasukses.com/hrmcu" rel="noopener" >
            <i class="fas fa-file-medical-alt"></i> <span>Medical Check Up</span>
         </a>
      </li>
      <li class="header">PROFILING</li>
      <li>
         <a target="_blank" href="http://web.binasaranasukses.com/api/profiling" rel="noopener" >
            <i class="far fa-id-card"></i> <span>Data Profiling</span>
         </a>
      </li>
   </ul>
</section>