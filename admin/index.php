<?php
    include "../koneksi/config.php";
    // include "c_editadmin.php";

session_start();

?>

<?php

 $id_pegawai = $_SESSION["id_pegawai"];

 $user = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_pegawai = '$id_pegawai'");
 $tik = mysqli_fetch_array($user);

 ?>

<?php
    $data_pengajuan = mysqli_query($koneksi, "SELECT * FROM tb_pengajuan ");
    $jumlah_pengajuan = mysqli_num_rows($data_pengajuan);
?>

<?php
    $data_doswal = mysqli_query($koneksi, "SELECT * FROM tb_verifikasi_doswal WHERE status_pengajuan = '1'");
    $jumlah_doswal = mysqli_num_rows($data_doswal);
?>

<?php
    $data_kajur = mysqli_query($koneksi, "SELECT * FROM tb_verifikasi_unit WHERE status_pengajuan = '2'");
    $jumlah_kajur = mysqli_num_rows($data_kajur);
?>




<?php
    $data_verifikasi = mysqli_query($koneksi, "SELECT * FROM tb_verifikasi_kajur WHERE status_pengajuan = '4'");
    $jumlah_verifikasi = mysqli_num_rows($data_verifikasi);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIAKAD | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="../css/a.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE/dist/css/adminlte.min.css">

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include "header_admin.php"; ?>
    <?php include "sidebar_admin.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Selamat Datang, 
            <?php 
                echo $tik['nama_pegawai']; 
            ?>
             ! 
            </h1>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $jumlah_pengajuan; ?></h3>
                            <p>Pengajuan Pengunduran Diri</p>
                        </div>  
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                </div>
<!-- 
                <div class="col-lg-3 col-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $jumlah_doswal; ?></h3>
                            <p>Verifikasi Dosen Wali</p>
                        </div>  
                        <div class="icon">
                            <i class="ion ion-easel"></i>
                        </div>
                    </div>
                </div> -->

                
            <!-- <div class="col-lg-3 col-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $jumlah_kajur; ?></h3>
                            <p>Verifikasi Perpustakaan</p>
                        </div>  
                        <div class="icon">
                            <i class="ion ion-easel"></i>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="col-lg-3 col-4">
                    <div class="small-box bg-seccondary">
                        <div class="inner">
                            <h3><?php echo $jumlah_keuangan; ?></h3>
                            <p>Verifikasi Bagian Keuangan</p>
                        </div>  
                        <div class="icon">
                            <i class="ion ion-easel"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $jumlah_perpustakaan; ?></h3>
                            <p>Verifikasi Perustakaan</p>
                        </div>  
                        <div class="icon">
                            <i class="ion ion-easel"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $jumlah_wadir; ?></h3>
                            <p>Verifikasi Wakil Direktur</p>
                        </div>  
                        <div class="icon">
                            <i class="ion ion-easel"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $jumlah_direktur; ?></h3>
                            <p>Verifikasi Bagian Administrasi</p>
                        </div>  
                        <div class="icon">
                            <i class="ion ion-easel"></i>
                        </div>
                    </div>
                </div> -->

                <div class="col-lg">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $jumlah_verifikasi; ?></h3>
                            <p>Data Terverifikasi</p>
                        </div>  
                        <div class="icon">
                            <i class="fas fa-check-square"></i>
                        </div>
                    </div>
                </div>
            </div>
                
            </div>
    </section>
    </div>

           <!-- / modal edit  -->
           <?php $no = 0;
      foreach ($user as $row) : $no++; ?>
      <div class="modal fade" id="myModal<?php echo $tik['nip_npak']; ?>" role="dialog">
        <div class="modal-dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Pegawai</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form role="form" action="c_editadmin.php" method="get" enctype="multipart/form-data">
            <div class="modal-body">
            <?php
              $nip_npak=$tik['nip_npak'];
              $result= mysqli_query($koneksi, "SELECT * FROM tb_pegawai where nip_npak='$nip_npak'");                
              while ($bio= mysqli_fetch_array($result)) {
            ?>
            
            <div class="form-row">
            <div class="form-group col-6">
                  <label>NIP/NPAK</label>
                  <input name = "nip_npak" type="text" class="form-control" value="<?php echo $bio['nip_npak']; ?>" readonly>
              </div>

              <div class="form-group col-6">
                  <label>Nama Pegawai</label>
                  <input name = "nama_pegawai" type="text" class="form-control" value="<?php echo $bio['nama_pegawai']; ?>">
              </div>
              </div>

              <div class="form-row">
              <div class="form-group col-6">
                  <label>Username</label>
                  <input name = "username" type="text" class="form-control" value="<?php echo $bio['username']; ?>">
              </div>
              
              <div class="form-group col-6">
                  <label>PasswordLama</label><span class="text-red">*</span></label>
                  <input type="password" class="form-control" name="passwordLama" placeholder="Password" id="myPassword" value="<?php echo $bio['password']; ?>">
                  <input type="checkbox" onclick="myFunction()"> Lihat Password
              </div>
              </div>

              <div class= "form-row">
              <div class="form-group col-6">
                  <label>Password Baru</label><span class="text-red">*</span></label>
                  <input type="password" class="form-control" name="password1" id="password1" placeholder="Masukan password baru" >
              </div>

              <div class="form-group col-6">
                  <label>Ulangi Password Baru</label><span class="text-red">*</span></label>
                  <input type="password" class="form-control" name="password2" id="password2" placeholder="Ulangi password baru" >
              </div>

              </div>

              <div class="form-row">
                <div class="form-group col-6">
                <label>Jabatan</label>
                  <input name = "jabatan" type="text" class="form-control" value="<?php echo $bio['jabatan']; ?>" readonly>
             </div>

              <div class="form-group col-6">
                  <label>No.Telp</label>
                  <input name = "no_telp_pegawai" type="number" class="form-control" value="<?php echo $bio['no_telp_pegawai']; ?>">
              </div>
              </div>

              <div class="form-group">
                    <label>Foto Pegawai</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="hidden" name = "foto_pegawai" class="form-control" value="<?php echo $bio['foto_pegawai']; ?>" >
                        <input type="file" name = "foto_pegawai" id="foto_pegawai" class="form-control" />
                      </div>
                    </div>
                    <i style="float: left;font-size: 14px;color: red">Abaikan jika tidak merubah tanda tangan</i> <br>
                    </div>

              <div class="form-group">
                <label>Tanda Tangan</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="hidden" name = "ttd_pegawai" class="form-control" value="<?php echo $bio['ttd_pegawai']; ?>" >
                      <input type="file" name = "ttd_pegawai" id="ttd_pegawai" class="form-control" />
                    </div>
                  </div>
                  <i style="float: left;font-size: 14px;color: red">Abaikan jika tidak merubah tanda tangan</i>
                  </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name = "edit_data">Save changes</button>
              </div>
              <?php 
                }
              ?>  
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
              </div>
      <?php endforeach ?>


    <?php include "../AdminLTE/footer.php" ?>
</div>

<!-- jQuery -->
<script src="../AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../AdminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../AdminLTE/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../AdminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../AdminLTE/plugins/moment/moment.min.js"></script>
<script src="../AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../AdminLTE/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../AdminLTE/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../AdminLTE/dist/js/pages/dashboard.js"></script>

<script>
  function myFunction() {
  var x = document.getElementById("myPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
    x.type = "password";
    }
  }
</script>

</body>
</html>