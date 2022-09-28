<?php
    session_start();
    include "../koneksi/config.php";
    include "c_profil/c_editpassword.php";
    include "c_profil/c_editprofile_perpustakaan.php";



?>

<?php

 $id_pegawai = $_SESSION["id_pegawai"];

 $user = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_pegawai = '$id_pegawai'");
 $tik = mysqli_fetch_array($user);

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
  <link rel="stylesheet" href="../css/a.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE/dist/css/adminlte.min.css">

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include "header_perpustakaan.php"; ?>
    <?php include "sidebar_perpustakaan.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
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
          <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Data Pengguna</h3>
                    </div> 
                    <div class="card card-secondary card-outline">
                        <div class="card-body box-profile">
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                    <b>NIP/NPAK</b> <a class="float-right text-secondary"><td><?php echo $tik['nip_npak']; ?></td></a>
                                </li>

                                <li class="list-group-item">
                                    <b>Nama Lengkap</b> <a class="float-right text-secondary"><td><?php echo $tik['nama_pegawai']; ?></td></a>
                                </li>

                                <li class="list-group-item">
                                    <b>No.Telp</b> <a class="float-right text-secondary"><td><?php echo $tik['no_telp_pegawai']; ?></td></a>
                                </li>

                                <li class="list-group-item">
                                    <b>Tanda Tangan</b> <a class="float-right text-secondary"><td><img src="../admin/img/ttd_pegawai/<?php echo $tik['ttd_pegawai'];?>" alt="Foto" width="150"</td></a>
                                </li>
                            </ul>
                            <a data-toggle ="modal" data-target="#ubahpassword<?php echo $tik['nip_npak']; ?>" class="btn btn-secondary"><b>Ubah Password</b></a>
                            <a data-toggle ="modal" data-target="#myModal<?php echo $tik['nip_npak']; ?>" class="btn btn-secondary"><b>Ubah Profile</b></a>
                          </div>
                        <!-- /.card-body -->
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
      <div class="modal fade" id="myModal<?php echo $row['nip_npak']; ?>" role="dialog">
        <div class="modal-dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Pengguna</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form role="form" action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
           
            
            <div class="form-group" hidden>
                  <label>NIP/NPAK</label>
                  <input name = "id_pegawai" type="text" class="form-control" value="<?php echo $row['id_pegawai']; ?>" readonly>
              </div>

              <div class="form-group">
                  <label>Nama Pegawai</label>
                  <input name = "nama_pegawai" type="text" class="form-control" value="<?php echo $row['nama_pegawai']; ?>">
              </div>

              <div class="form-group">
                  <label>Username</label>
                  <input name = "username" type="text" class="form-control" value="<?php echo $row['username']; ?>">
              </div>
              

                <div class="form-group" hidden>
                <label>Jabatan</label>
                  <input name = "jabatan" type="text" class="form-control" value="<?php echo $row['jabatan']; ?>" readonly>
             </div>

              <div class="form-group">
                  <label>No.Telp</label>
                  <input name = "no_telp_pegawai" type="number" class="form-control" value="<?php echo $row['no_telp_pegawai']; ?>">
              </div>

              <div class="form-group">
                    <label>Foto Pegawai</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="hidden" name = "foto_pegawai" class="form-control" value="<?php echo $row['foto_pegawai']; ?>" >
                        <input type="file" name = "foto_pegawai" id="foto_pegawai" class="form-control" accept="image/png,image/gif,image/jpeg"/>
                      </div>
                    </div>
                    <i style="float: left;font-size: 14px;color: red">Abaikan jika tidak merubah foto</i> <br>
                    </div>

              <div class="form-group">
                <label>Tanda Tangan</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="hidden" name = "ttd_pegawai" class="form-control" value="<?php echo $row['ttd_pegawai']; ?>" >
                      <input type="file" name = "ttd_pegawai" id="ttd_pegawai" class="form-control" accept="image/png,image/gif,image/jpeg"/>
                    </div>
                  </div>
                  <i style="float: left;font-size: 14px;color: red">Abaikan jika tidak merubah tanda tangan</i>
                  </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name = "edit">Save changes</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
              </div>
      <?php endforeach ?>


      <!-- edit password -->
      <!-- / modal edit  -->
      <?php $no = 0;
      foreach ($user as $row) : $no++; ?>
      <div class="modal fade" id="ubahpassword<?php echo $row['nip_npak']; ?>" role="dialog">
        <div class="modal-dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Password Pengguna</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form role="form" action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
         
              
              <div class="form-group" hidden>
                  <label>NIP/NPAK</label>
                  <input name = "nip_npak" type="text" class="form-control" value="<?php echo $row['id_pegawai']; ?>" readonly>
              </div>

              <div class="form-group">
                  <label>Password Lama</label><span class="text-red">*</span></label>
                  <input type="password" class="form-control" name="passwordLama" placeholder="Password" id="myPassword" value="<?php echo $row['password']; ?>">
                  <input type="checkbox" onclick="myFunction()"> Lihat Password
              </div>

              <div class="form-group">
                  <label>Password Baru</label><span class="text-red">*</span></label>
                  <input type="password" class="form-control" name="password1" id="password1" placeholder="Masukan password baru" >
              </div>

              <div class="form-group">
                  <label>Ulangi Password Baru</label><span class="text-red">*</span></label>
                  <input type="password" class="form-control" name="password2" id="password2" placeholder="Ulangi password baru" >
              </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name = "edit_password">Save changes</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      </div>
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