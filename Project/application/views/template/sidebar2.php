<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url("panti")?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Panti</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <?php if(!$registrasi['status'] == 0){?>
  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url("panti")?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    List
  </div>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url("panti/addKasus")?>">
      <i class="fas fa-fw fa-plus"></i>
      <span>Tambah Kasus</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url("panti/listKasusPanti")?>">
      <i class="fas fa-fw fa-table"></i>
      <span>List Kasus</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    Akun
  </div>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('panti/permintaan_verifikasi') ?>">
      <i class="fas fa-fw fa-cog"></i>
      <span>Permintaan Verifikasi</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url("panti/detaildata") ?>">
      <i class="fas fa-fw fa-edit"></i>
      <span>Edit Data Panti</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('panti/profilpanti') ?>">
      <i class="fas fa-fw fa-user"></i>
      <span>Profil</span></a>
  </li>
  
  <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>
        <?php } else {?>
   <li class="nav-item">
    <a class="nav-link" href="<?= base_url("panti")?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    List
  </div>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-plus"></i>
      <span>Tambah Kasus</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-table"></i>
      <span>List Kasus</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    Akun
  </div>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('panti/permintaan_verifikasi') ?>">
      <i class="fas fa-fw fa-cog"></i>
      <span>Permintaan Verifikasi</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-edit"></i>
      <span>Edit Data Panti</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link"href="#">
      <i class="fas fa-fw fa-user"></i>
      <span>Profil</span></a>
  </li>
  
  <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>
  <?php } ?>
  

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
 
</ul>
<!-- End of Sidebar -->

