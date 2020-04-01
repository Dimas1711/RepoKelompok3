<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url("admin/tampil")?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?= site_url("admin/tampil")?>">
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
    <a class="nav-link" href="<?= site_url("admin/kasus")?>">
      <i class="fas fa-fw fa-table"></i>
      <span>List User</span></a>
  </li>

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="<?= site_url("admin/kasus")?>">
      <i class="fas fa-fw fa-table"></i>
      <span>List Donasi</span></a>
  </li>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="<?= site_url("admin/kasus")?>">
      <i class="fas fa-fw fa-table"></i>
      <span>List Panti</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    Permintaan
  </div>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url("panti/verifikasi")?>">
      <i class="fas fa-fw fa-clipboard"></i>
      <span>Verifikasi Akun Panti</span></a>
  </li>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="<?= site_url("admin/kasus")?>">
      <i class="fas fa-fw fa-clipboard"></i>
      <span>Verifikasi Donasi</span></a>
  </li>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="<?= site_url("admin/kasus")?>">
      <i class="fas fa-fw fa-clipboard"></i>
      <span>Top Up Dana</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    Akun
  </div>
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="<?= site_url("admin/kasus")?>">
      <i class="fas fa-fw fa-cog"></i>
      <span>Setting Akun</span></a>
  </li>
  <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

  

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->








<!-- Heading -->
  <!-- <div class="sidebar-heading">
    Addons
  </div> -->

  <!-- Nav Item - Pages Collapse Menu -->
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Login Screens:</h6>
        <a class="collapse-item" href="login.html">Login</a>
        <a class="collapse-item" href="register.html">Register</a>
        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
        <div class="collapse-divider"></div>
        <h6 class="collapse-header">Other Pages:</h6>
        <a class="collapse-item" href="404.html">404 Page</a>
        <a class="collapse-item" href="<?= base_url("assets/")?>blank.html">Blank Page</a>
      </div>
    </div>
  </li> -->