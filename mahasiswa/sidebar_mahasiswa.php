<?php

include "../AdminLTE/rel.html";
include "../AdminLTE/script.html";


$username_mhs = $_SESSION["id_mahasiswa"];
$user = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$username_mhs'");
$row = mysqli_fetch_array($user);
?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../AdminLTE/dist/img/logo_pnc.png" alt="SIAKAD" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIAKAD PNC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../admin/img/foto_mahasiswa/<?=$row['foto_mhs'];?>" class="img-circle" style="width:40px;height:40px" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block text-white">
            <?php foreach ($user as $row) :
            echo $row ['nama_mhs']; 
            endforeach; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                  <a href="index.php" class="nav-link">
                  <i class="nav-icon fas fa-home"></i>
                    <p>Dashboard</p>
                  </a>
              </li> 

                <li class="nav-item">
                  <a href="profile.php" class="nav-link">
                  <i class="nav-icon far fa-id-badge" size="7px"></i>
                    <p> Profile Mahasiswa</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="data_pengajuan.php" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                    <p> Pengajuan</p>
                  </a>
                </li>

            <li class="nav-header">AKSI</li>
            <li class="nav-item">
              <a href="../koneksi/logout.php" onclick="return confirm('Yakin untuk Logout?')" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li>
        </ul>
      </nav>
  </div>
</aside>
