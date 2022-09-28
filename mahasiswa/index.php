<?php
session_start();
    include "../koneksi/config.php";
    include "c_tambahpengajuan.php";


?>

<?php
 $username_mhs = $_SESSION["id_mahasiswa"];
 $user = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$username_mhs'");

  $status = mysqli_query($koneksi, "SELECT * FROM tb_pengajuan WHERE id_mahasiswa='$username_mhs' AND status_pengajuan !='5'");
  $cek = mysqli_num_rows($status);


    $data_pengajuan = mysqli_query($koneksi, "SELECT * FROM tb_pengajuan");
    $jumlah_pengajuan = mysqli_num_rows($data_pengajuan);
?>

<?php
    date_default_timezone_set('Asia/Jakarta');
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

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php 

    if ($cek > 0) {
    $modal="modal-tolak";

      } else {
        $modal="myModal";
     }
?>

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
            <h1>Selamat Datang, 
            <?php 
                foreach ($user as $row) : 
                echo $row['nama_mhs']; 
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
            <div class="row">
              <div class=" col-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item col-12"><a class="nav-link active" href="#activity" data-toggle="tab"><center>Syarat dan Ketentuan Pengajuan Pengunduran Diri</center></a></li>
                        <ul>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12 col-lg-8">
                          <div class="tab-content">
                              <div class="active tab-pane" id="activity">
                                  <div class="post">
                                      <p><ol>
                                          <li>Pengajuan dapat dilakukan dengan mengklik "Ajukan Permohonan"</li>
                                          <li>Isi formulir sesuai dengan isian yang telah disediakan</li>
                                          <li>Sertakan berkas pendukung jika ada</li>
                                          <li>Klik "Save Changes" untuk melakukan pengajuan pengunduran diri</li>
                                          <li>Mahasiswa dapat mengecek status pengajuan pada menu Pengajuan</li>
                                          <li>Tunggu proses pengajuan hingga status pengajuan menjadi "Pengajuan Diterima"</li>
                                          <li>Nilai mahasiswa dan Surat Keputusan dapat diunduh ketika pengajuan diterima pada menu Pengajuan</li>
                                          <li>Selama proses verifikasi, mahasiswa hanya dapat melakukan pengajuan sekali</li>
                                      </ol></p>
                                  </div>
                              </div>
                          </div>

                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="info-box" style="box-shadow: 0 0 0px black,0 0px 0px black;">
                              <a data-toggle ="modal" data-target="#<?=$modal?>" class = "btn btn-default" style="border: none;background:none;">
                              <img src="../landing page/csslanding/img/syarat.png" alt="Employee" class="img-fluid float-left" style="max-width: 80px !important;"></a>
                              <div data-toggle ="modal" data-target="#<?=$modal?>" class="info-box-content" style="cursor: pointer;" >
                                  <span class="info-box-text">Ajukan Permohonan</span>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
    </section>
  </div>

<!-- /.Modals Tambah --> 
<div class="modal fade" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Pengajuan Pengunduran Diri</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method ="post" action ="" enctype="multipart/form-data">
            <div class="modal-body">
            <input type="text" class="form-control" id="npm" name='id_mahasiswa' value="<?= $username_mhs;?>" hidden>
              <div class="form-group">
                  <label>Semester</label>
                  <select class="custom-select" name="semester" required>
                    <option value="" selected>Pilih Semester</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                  </select>
              </div>

              <div class="form-group">
                  <label>Alasan</label>
                  <select class="form-control" name="alasan" id="alasan" required>
                    <option value="" selected>Pilih Alasan</option>
                    <option value="Di terima kerja">Di terima kerja</option>
                    <option value="Pindah Kampus">Pindah Kampus</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
              </div>

            <div class="form-group">
                  <label>Tanggal Pengajuan</label>
                  <input name = "tgl_pengajuan" type="date" class="form-control" id="tgl_pengajuan" placeholder="tgl_pengajuan" min="<?= date('Y-m-d')?>" max="<?= date('Y-m-d')?>" required/>
              </div>

              <div class="form-group">
                  <label>Nama Orang Tua/Wali</label>
                  <input name = "nama_ortu" type="text" class="form-control" id="nama_ortu" placeholder="nama orang tua" required/>
              </div>

              <div class="form-group" hidden>
                  <label>Status Pengajuan</label>
                  <input name = "status_pengajuan" type="text" class="form-control" id="status_pengajuan" >
              </div>


                <div class="form-group">
                    <label>Tanda Tangan Orang Tua/Wali *</label>
                    <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="form-control" id="ttd_ortu" name = "ttd_ortu" accept="image/png,image/gif,image/jpeg" required/>
                    </div>
                    </div>
                </div>
                <i style="float: left;font-size: 14px;color: red">Tipe file JPEG/JPG/PNG dengan batas max 5 mb</i> <br>
                <div class="form-group">
                    <label>Surat Persetujuan Orang Tua/Wali *</label>
                    <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="form-control" id="srt_ortu" name = "srt_ortu" accept="application/pdf" required/>
                    </div>
                    </div>
                </div>
                <i style="float: left;font-size: 14px;color: red">Tipe file PDF dengan batas max 5 mb</i> <br>
                <div class="form-group">
                    <label>Berkas Pendukung</label>
                    <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="form-control" id="berkas" name = "berkas" accept="application/pdf"/>
                    </div>
                    </div>
                </div>
                <i style="float: left;font-size: 14px;color: red">Tipe file PDF dengan batas max 5 mb</i> <br>
                </div>

              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name = "tambah">Save changes</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div id="modal-tolak" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tidak Bisa Melakukan Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Pengajuan tidak bisa dilakukan karena dalam tahap verifikasi</p>
                <form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <?php include "../AdminLTE/footer.php" ?>
</div>

<?php 

endforeach; 

?>
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

<!-- <script>
  function myFunction() {
  var x = document.getElementById("myPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
    x.type = "password";
    }
  }
</script> -->


</body>
</html>