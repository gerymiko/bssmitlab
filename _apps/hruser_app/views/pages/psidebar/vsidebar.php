<section class="sidebar">
  <ul class="sidebar-menu" data-widget="tree">
    <li class="bg-gray">
      <a href="<?=site_url();?>cpanel/syspanel">
        <i class="fas fa-dot-circle text-red"></i> <span> Dashboard</span>
      </a>
    </li>
    <li id="li-PngCti">
      <a id="hf-PngCti" href="<?=site_url();?>cleave/sysleave">
        <i class="fas fa-dot-circle text-blue"></i> <span>Pengajuan Cuti</span>
      </a>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fas fa-dot-circle text-blue"></i> <span>Pengajuan Tiket <b class="pull-right">+</b></span>
        <span class="pull-right-container">
          <i class="fas fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li id="li-crSch"><a id="hr-crSch" href="<?=site_url();?>cticket/syschedule">- Cari Jadwal</a></li>
        <li id="li-dtPngn"><a id="hr-dtPngn" href="<?=site_url();?>cticket/sysfiling">- Data Pengajuan</a></li>
      </ul>
    </li>
    <li id="li-PngIzn">
      <a id="hf-PngIzn" href="<?=site_url();?>cpermit/syspermit">
        <i class="fas fa-dot-circle text-blue"></i> <span>Pengajuan Izin</span>
      </a>
    </li>
    <li id="li-PngRsgn">
      <a id="hf-PngRsgn" href="<?=site_url();?>cresign/sysresign">
        <i class="fas fa-dot-circle text-blue"></i> <span>Pengunduran Diri</span>
      </a>
    </li>
  </ul>
</section>