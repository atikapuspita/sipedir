<?php
  include "../../koneksi/config.php";

  include "c_editpengajuan.php";
  include "function_verifikasi.php";

  session_start();
  $id_pegawai = $_SESSION['id_pegawai'];
  
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
  <link rel="stylesheet" href="../../tampilan/tampilan.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../AdminLTE/dist/css/adminlte.min.css">


</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php
      include "header_doswal.php";
      include "sidebar_doswal.php";

      $doswal = mysqli_query($koneksi, "SELECT id_doswal,id_kelas FROM tb_doswal WHERE id_pegawai = '$id_pegawai' and status='1'");
      $hasil = mysqli_fetch_array($doswal);
      $id_kelas = empty($hasil["id_kelas"]) ? "" : $hasil["id_kelas"];
      $id_doswal = empty($hasil["id_doswal"]) ? "" : $hasil["id_doswal"];
      
      $user = mysqli_query($koneksi, "SELECT * FROM tb_pengajuan INNER JOIN tb_mahasiswa ON tb_pengajuan.id_mahasiswa = tb_mahasiswa.id_mahasiswa WHERE status_pengajuan = '0' AND id_kelas = '$id_kelas' order by tb_pengajuan.tgl_pengajuan desc;");
      $data = mysqli_query($koneksi, "SELECT * FROM tb_verifikasi INNER JOIN tb_pengajuan ON tb_verifikasi.id_pengajuan = tb_pengajuan.id_pengajuan");
      $jabatan = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_pegawai = '$id_pegawai'");
      $result = mysqli_fetch_array($jabatan);

      
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pengajuan Pengunduran Diri</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pengajuan Pengunduran Diri</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
    if( isset($_POST["verifikasi"]) ){
    verifikasi($_POST);
};?>

<?php 
    if( isset($_POST["Ditolak"]) ){
    verifikasi($_POST);
};?>

      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th><center>No</center></th>
                          <th><center>Nama Mahasiswa</center></th>
                          <th><center>Tanggal Pengajuan</center></th>
                          <th><center>Surat Pengunduran Diri</center></th>
                          <th><center>Surat Orang Tua </center></th>
                          <th><center>Berkas Pendukung</center></th>
                          <th><center>Status </center></th>
                          <th  width="16%" ><center>Verifikasi</center></th>
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
                            <td><?php echo $row['nama_mhs']; ?></td>
                            <td><?php echo "<a>". $h." ". $nm. " ". $t. "</a>" ?></td>
                            <td><center><a target="_blank" href="../../admin/surat_pengajuan.php?id_pengajuan=<?= $row["id_pengajuan"]; ?>" class ="badge badge-success">Unduh Formulir</center></td></a></td>
                            <td><center><b>
                              <a target="_blank" href="../../pdf/orangtua/<?php echo $row['surat_persetujuan_ortu']; ?>" class ="badge badge-info">Lihat Berkas</a></b>
                            </center></td> 
                            <td><center><b>
                              <?php if($row['berkas_pendukung'] == ""){
                              ?> 
                              <a  href="#" class ="badge badge-secondary">Lihat Berkas</a></b>
                              <?php
                              } else { ?>
                              <a target="_blank" href="../../pdf/berkas/<?php echo $row['berkas_pendukung']; ?>" class ="badge badge-warning">Lihat Berkas</a></b>
                              <?php } ?>
                               
                              
                            </center></td>

                           <?php 
                              if (empty($row['status_pengajuan'])) {
                                  $status_pengajuan = "Belum diverifikasi";
                                  $warna = 'warning';
                              } else {
                                  if ($row['status_pengajuan'] == "1") {
                                      $status_pengajuan = "Diiverifikasi Dosen Wali";
                                      $warna = 'info';
                                  } elseif ($row['status_pengajuan'] == "2") {
                                      $status_pengajuan = "Diiverifikasi Perpustakaan";
                                      $warna = 'primary';
                                  } elseif ($row['status_pengajuan'] == "3") {
                                    $status_pengajuan = "Diiverifikasi Bagian Keuangan";
                                    $warna = 'primary';
                                } elseif ($row['status_pengajuan'] == "4") {
                                  $status_pengajuan = "Pengajuan Diterima";
                                  $warna = 'primary';
                                }  elseif ($row['status_pengajuan'] == "5") {
                                      $status_pengajuan = "Ditolak";
                                      $warna = 'danger';
                                } else {
                                    $status_pengajuan = "Status not found"; 
                                    $warna = '';
                                }
                              } ?>
                              <td><center><?php echo "<a class='badge badge-".$warna."'>".$status_pengajuan."</a>"; ?></center></td>
                              <td><center>
                              <?php
                                  if (empty($row['status_pengajuan'])) { ?>
                                  <!-- <div class="containner"> -->
                            
                            <div class="row text-center d-flex justify-content-center">
                              <div class="col">
                                <form action="" method="post">
                                  <input type="hidden" name="id_pengajuan" value="<?= $row['id_pengajuan']; ?>">
                                  <input type="hidden" name="id_doswal" value="<?= $id_doswal; ?>">
                                  <input type="hidden" name="status_verifikasi" value="Diverifikasi">
                                    <button type ="submit" class = "btn btn-outline-success btn-block btn-sm mr-6" name="verifikasi" value="verifikasi"  onclick="return confirm('Anda yakin menerima pengajuan ini?')" >
                                          <i class = "fa fa-check-circle"></i> Terima</button>
                                </form>
                              </div>
                              <div class = "col">
                              <button type="submit" class="btn btn-outline-danger btn-sm btn-block" name="verifikasi" value="verifikasi" data-toggle="modal" data-target="#modaltolak<?php echo $row['id_pengajuan'];?>">
                                  <i class = "fas fa-times-circle"></i> Tolak</button>
                              </div>
                            </div>
                          </div>
                                  <?php } else {
                                      echo "<a class = 'badge badge-info'>Terverifikasi</a>";
                                  }
                                  ?>
                            </td></center>
                          </tr>

                          <div class="modal fade" id="modaltolak<?php echo $row['id_pengajuan'];?>">
                                      <div class="modal-dialog modal-s">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Tolak Pengajuan</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true"> &times;</span>
                                          </button>
                                              </div>
                                              
                                              <div class="modal-body">
                                              <form action="" method="post">
                                                <input type="hidden" name="id_pengajuan" value="<?= $row['id_pengajuan']; ?>">
                                                <input type="hidden" name="id_doswal" value="<?= $id_doswal; ?>">
                                                <input type="hidden" name="status_verifikasi" value="Ditolak">
                                                <label>Alasan Ditolak</label>
                                                <input type="text" name="alasan_tolak" class="form-control" required>
                                              </div>
                                              <div class="modal-footer justify-content-between">
                                              <a href="data_verifikasi.php" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</a>
                                              <button type="submit" class="btn btn-outline-danger btn-sm" name="Ditolak" onclick="return confirm('Anda yakin menolak pengajuan ini?')">
                                                    <i class = "fas fa-times-circle"></i> Tolak</button>
                                                </form>
                                              </div>
                                          </div>
                                          <!-- /.modal-content -->
                                      </div>
                                      <!-- /.modal-dialog -->
                                  </div>
                                  <!-- /.modal -->
                          
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
<!-- Page specific script -->
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
  

<script type="text/javascript">
  $(document).ready(function(){
    $("#npm").on("change", function(){
      var nama_mhs = $("#npm option:selected").attr("nama_mhs");
      $("#nama_mhs").val(nama_mhs);
    });

  });
</script>
</body>
</html>