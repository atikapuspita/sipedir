<?php
  include "../../koneksi/config.php";

  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIAKAD PNC</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../../css/a.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../AdminLTE/dist/css/adminlte.min.css">


</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php
      include "header.php";
      include "sidebar.php";
      
      $user = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa INNER JOIN tb_pengajuan ON tb_pengajuan.id_mahasiswa = tb_mahasiswa.id_mahasiswa 
                          INNER JOIN tb_kelas ON tb_mahasiswa.id_kelas = tb_kelas.id_kelas INNER JOIN tb_prodi on tb_kelas.id_prodi = tb_prodi.id_prodi INNER JOIN tb_jurusan on tb_jurusan.id_jurusan=tb_prodi.id_jurusan WHERE status_pengajuan = '4' ");
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Pengunduran Diri</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Laporan Pengunduran Diri</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <a class="no-print btn btn-sm btn-primary" href="cetak.php" target="_blank"><i class="fas fa-print"></i> Cetak Laporan</a>
            </div>
              <!-- /.card-header -->
              <div class="card-body" id="print-area-2">
                  <table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th><center>No</center></th>
                          <th><center>NPM</center></th>
                          <th><center>Nama Mahasiswa</center></th>
                          <th><center>Jurusan</center></th>
                          <th><center>NOMOR SK</center></th>
                          <th><center>Tanggal Pengajuan</center></th>
                          <th><center>Tahun Akademik</center></th>
                      </tr>
                    </thead>
                  
                    <tbody>
                    <?php $i = 1; ?>
                    
                    <?php foreach ($user as $row) : 
                    $t = substr($row['tgl_pengajuan'],0,4);
                    $b = substr($row['tgl_pengajuan'],5,2);
                    $h = substr($row['tgl_pengajuan'],8,2);
                
                        if($b == "01"){
                            $nm = "Januari";
                        } elseif($b == "02"){
                            $nm = "Februari";
                        } elseif($b == "03"){
                            $nm = "Maret";
                        } elseif($b == "04"){
                            $nm = "April";
                        } elseif($b == "05"){
                            $nm = "Mei";
                        } elseif($b == "06"){
                            $nm = "Juni";
                        } elseif($b == "07"){
                            $nm = "Juli";
                        } elseif($b == "08"){
                            $nm = "Agustus";
                        } elseif($b == "09"){
                            $nm = "September";
                        } elseif($b == "10"){
                            $nm = "Oktober";
                        } elseif($b == "11"){
                            $nm = "November";
                        } elseif($b == "12"){
                            $nm = "Desember";
                        }
                      ?>
                            <tr>
                                <td><center><?= $i ?></center></td>
                            <td><?php echo $row['npm']; ?></td>
                            <td><?php echo $row['nama_mhs']; ?></td>
                            <td><?php echo $row['nama_jurusan']; ?></td>
                            <td><?php echo $row["no_sk"]; ?></td>
                            <td><center><?php echo "<a>". $h." ". $nm. " ". $t. "</a>" ?></center></td>
                            <td><center><?php echo $row["thn_angkatan"]; ?></center></td>
                          </tr>
                          
                            <?php $i++ ; ?>
  
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  
              </div>
            <!-- /.card-body -->
            </div>
          <!-- /.card -->
          </div>
        <!-- /.col -->
        </div>
      <!-- /.row -->
      </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->




  <?php
include "../../AdminLTE/footer.php"
?>


<!-- jQuery -->
<script src="../../AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../AdminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../AdminLTE/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../AdminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../AdminLTE/plugins/moment/moment.min.js"></script>
<script src="../../AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../AdminLTE/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../AdminLTE/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../AdminLTE/dist/js/pages/dashboard.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
  </script>

</body>
</html>