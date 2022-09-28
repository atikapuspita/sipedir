<?php
    include "../koneksi/config.php";
    include "c_editmahasiswa.php";

session_start();

?>

<?php
 $username_mhs = $_SESSION["id_mahasiswa"];
 $user = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa INNER JOIN tb_kelas on tb_kelas.id_kelas=tb_mahasiswa.id_kelas INNER JOIN tb_prodi  ON tb_kelas.id_prodi = tb_prodi.id_prodi INNER JOIN tb_jurusan on tb_jurusan.id_jurusan=tb_prodi.id_jurusan WHERE id_mahasiswa = '$username_mhs'");
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
    <?php include "header_mahasiswa.php"; ?>
    <?php include "sidebar_mahasiswa.php"; ?>

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
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
  

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card ">
                        <div class="card-header bg-secondary">
                            <h3 class="card-title">Profile Mahasiswa</h3>
                        </div> 
                            <div class="card-body box-profile">
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>NPM</b> <a class="float-right text-secondary"><td><?php echo $tik['npm']; ?></td></a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Nama Lengkap</b> <a class="float-right text-secondary"><td><?php echo $tik['nama_mhs']; ?></td></a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Tahun Anggkatan</b> <a class="float-right text-secondary"><td><?php echo $tik['thn_angkatan']; ?></td></a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Alamat</b> <a class="float-right text-secondary"><td><?php echo $tik['alamat']; ?></td></a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>No.Telp</b> <a class="float-right text-secondary"><td><?php echo $tik['no_telp_mhs']; ?></td></a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Tanda Tangan</b> <a class="float-right text-secondary"><td><img src="../admin/img/ttd_mahasiswa/<?php echo $tik['ttd_mhs'];?>"alt="Foto" width="150" ></td></a>
                                    </li>
                                </ul>
                                <a data-toggle ="modal" data-target="#editpw<?php echo $tik['npm']; ?>" class="btn btn-secondary"><b>Ubah Password</b></a>
                                <a data-toggle ="modal" data-target="#myModal<?php echo $tik['npm']; ?>" class="btn btn-secondary"><b>Ubah Profile</b></a>
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
      <div class="modal fade" id="myModal<?php echo $tik['npm']; ?>" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Mahasiswa</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form role="form" action="c_editmahasiswa.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
            <?php
              $npm=$tik['npm'];
              $result= mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa where npm='$npm'");                
              while ($bio= mysqli_fetch_array($result)) {
            ?>
            <input type="hidden" name="npm" value="<?=$bio['npm'] ?>">

              <div class="form-row">
              <div class="form-group col-6">
                  <label for="nama_mhs">Nama Mahasiswa</label>
                  <input name = "nama_mhs" type="text" class="form-control" value="<?php echo $bio['nama_mhs']; ?>">
              </div>

            
              <div class="form-group col-6">
                  <label>Username</label>
                  <input name = "username_mhs" type="text" class="form-control" value="<?php echo $bio['username_mhs']; ?>">
              </div>
              </div>

              

            <div class="form-row">
              <div class="form-group col-6">
                  <label for="alamat">Alamat</label>
                  <input name = "alamat" type="text" class="form-control" value="<?php echo $bio['alamat']; ?>">
              </div>

              <div class="form-group col-6">
                  <label>No.Telp</label>
                  <input name = "no_telp_mhs" type="number" class="form-control" value="<?php echo $bio['no_telp_mhs']; ?>">
              </div>
            </div> 

            <div class= "row">
            <div class="col-lg-6">
           <div class="form-group">
              <label>Foto Mahasiswa</label><br>
              <img src="../admin/img/foto_mahasiswa/<?php echo $tik['foto_mhs'];?>"alt="Foto" width="50" ><br>
              <div class="input-group">
                <div class="custom-file">
                  <input type="hidden" name = "foto_mhs" class="form-control" value="<?php echo $bio['foto_mhs']; ?>" >
                  <input type="file" name = "foto_mhs" id="foto_mhs" class="form-control" accept="image/png,image/gif,image/jpeg"/>
                </div>
              </div>
                <i style="float: left;font-size: 14px;color: red">Abaikan jika tidak merubah foto</i> <br>
           </div>
              </div>

            <div class="col-lg-6">
            <div class="form-group">
              <label>Tanda Tangan</label><br>
              <img src="../admin/img/ttd_mahasiswa/<?php echo $tik['ttd_mhs'];?>"alt="Foto" width="100" ><br><br>
                <div class="input-group">
                  <div class="custom-file">
                  <input type="hidden" name = "ttd_mhs" class="form-control" value="<?php echo $bio['ttd_mhs']; ?>" >
                  <input type="file" name = "ttd_mhs" id="ttd_mhs" class="form-control" accept="image/png,image/gif,image/jpeg"/>
                </div>
              </div>
                <i style="float: left;font-size: 14px;color: red">Abaikan jika tidak merubah tanda tangan</i> <br>
            </div>
            </div>
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

      <?php endforeach ?>

             <!-- edit password -->
        <!-- / modal edit  -->
<?php $no = 0;
foreach ($user as $row) : $no++; ?>
  <div class="modal fade" id="editpw<?php echo $tik['npm']; ?>" role="dialog">
    <div class="modal-dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Ubah Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>

          <form role="form" action="c_editpassword.php" method="get">
            <div class="modal-body">
              <?php
                $npm=$tik['npm'];
                $result= mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa where npm='$npm'");                
                while ($bio= mysqli_fetch_array($result)) {
              ?>

            <div class="form-group" hidden>
              <label>NPM</label>
              <input name = "npm" type="text" class="form-control" value="<?php echo $bio['npm']; ?>">
            </div>

              <div class="form-group">
                  <label>Password Lama</label><span class="text-red">*</span></label>
                  <input type="password" class="form-control" name="passwordLama" placeholder="Password" id="myPassword" value="<?php echo $bio['password_mhs']; ?>">
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
                <button type="submit" class="btn btn-primary" name = "edit">Save changes</button>
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

</div>


    <?php include "../AdminLTE/footer.php" ?>

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