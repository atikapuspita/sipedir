<?php
  include "../koneksi/config.php";

  include "c_tambahpengajuan.php";
  include "c_editpengajuan.php";
  include "function_upload.php";

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
  <link rel="stylesheet" href="../AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../tampilan/tampilan.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE/dist/css/adminlte.min.css">
  <link href="https://code.jquery.com/ui/1.11.2/themes/black-tie/jquery-ui.css" rel="stylesheet"/>


</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php
      include "header_admin.php";
      include "sidebar_admin.php";
        
      $user = mysqli_query($koneksi, "SELECT * FROM tb_pengajuan INNER JOIN tb_mahasiswa ON tb_pengajuan.id_mahasiswa = tb_mahasiswa.id_mahasiswa where tb_pengajuan.status_pengajuan='4' ;");
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
            <h1>Data Surat Keputusan dan Nilai</h1>
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
              <?php
                $q = mysqli_query($koneksi, "select * from tb_pengajuan");
                $j = mysqli_num_rows($q);
              ?>
		        <h3  class="card-title">Data Pengajuan Pengunduran Diri ( <?php echo ($j>0)?$j:0; ?> )</h3><br>
            
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                          <th><center>No</center></th>
                          <th width ="15%"><center>Nama Mahasiswa</center></th>
                          <th width ="15%"><center>Alasan</center></th>
                          <th><center>Tanggal Pengajuan</center></th>
                          <th><center>Nama Orang Tua </center></th>
                          <th><center>SK </center></th>
                          <th><center>Nilai</center></th>
                          <th><center>Status </center></th>
                          <th width="14%"><center>Verifikasi </center></th>
                          <th><center>Aksi</center></th>
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
                            <td><?php echo $row['alasan']; ?></td>
                            <td><?php echo "<a>". $h." ". $nm. " ". $t. "</a>" ?></td>
                            <td><?php echo $row["nama_ortu"]; ?></td>
                            <td><center><a target="_blank" href="../pdf/sk/<?= $row["file_sk"]; ?>" class ="badge badge-success">Unduh SK</center></td></a></td>
                            <td><center><a target="_blank" href="../pdf/nilai/<?= $row["nilai"]; ?>" class ="badge badge-success">Unduh Nilai</center></td></a></td>
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
                              $status_pengajuan = "Diiverifikasi Kajur";
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
                                  if ($row['status_pengajuan'] == "4") { ?>
                              <div class="row text-center d-flex justify-content-center">
                                
                                <div class = "col">
                              <button type="submit" class="btn btn-outline-primary btn-sm btn-block" name="verifikasi" value="verifikasi" data-toggle="modal" data-target="#modalupload<?php echo $row['id_pengajuan'];?>">
                                  <i class = "fas fa-upload"></i> Upload </button>
                              </div>
                            </div>
                          </div>
                                  <?php } else {
                                      echo "<a class = 'badge badge-info'>Terverifikasi</a>";
                                  }
                                  ?>
                           </center> </td>

                          <div class="modal fade" id="modalupload<?php echo $row['id_pengajuan'];?>">
                                      <div class="modal-dialog modal-s">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Upload SK & Nilai</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true"> &times;</span>
                                                  </button>
                                              </div>
                                              
                                              <div class="modal-body">
                                              <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id_pengajuan" value="<?= $row['id_pengajuan']; ?>">
                                                <label>Nomor SK</label>
                                                <input name = "no_sk" type="text" class="form-control" value="<?php echo $row['no_sk']; ?>">
                                                <input type="hidden" name="status_verifikasi" value="upload">
                                                <label>Input SK</label>
                                                <input type="hidden" name="sklama" value="<?= $row['file_sk']; ?>" >
                                                <input type="file" name="sk" class="form-control" >
                                                <label>Input Nilai</label>
                                                <input type="hidden" name="nilailama" value="<?= $row['nilai']; ?>" >
                                                <input type="file" name="nilai" class="form-control" >
                                              </div>
                                              <div class="modal-footer justify-content-between">
                                              <a href="data_verifikasi.php" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</a>
                                              <button type="submit" class="btn btn-outline-primary btn-sm" name="upload" >
                                                    <i class = "fas fa-upload"></i> upload</button>
                                                </form>
                                              </div>
                                          </div>
                                          <!-- /.modal-content -->
                                      </div>
                                      <!-- /.modal-dialog -->
                                  </div>
                                  <!-- /.modal -->
                          
                            <td><center>
                                <a data-toggle ="modal" data-target="#modaldetail<?php echo $row['id_pengajuan']; ?>" class = "btn btn-default"><i class="far fa-eye" title="Details"></i></h6></a> 
                                <a href="hapus_pengajuan.php?id_pengajuan=<?php echo $row['id_pengajuan']; ?>" class = "btn btn-default"><i class="fas fa-trash-alt" title="Hapus"></i></a>                                  
                            </center>
                            
                          </td>
                            
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

  

 <!-- Modal Lihat Detail -->
 <?php $no = 0;
      foreach ($user as $row) : $no++; ?>
<?php
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
$status_pengajuan = "Diiverifikasi Kajur";
$warna = 'primary';
}  elseif ($row['status_pengajuan'] == "5") {
    $status_pengajuan = "Ditolak";
    $warna = 'danger';
} else {
  $status_pengajuan = "Status not found"; 
  $warna = '';
} 
}
?>
<div class="modal fade" id="modaldetail<?php echo $row['id_pengajuan']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pengajuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
            
              <div class="row container">
                            <div class="col-12">
                                <ul class="list-group">
                                <li class="list-group-item"><span class="float-left">Id Pengajuan</span><span class="float-right"><b><?= $row['id_pengajuan']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Nama Mahasiswa</span><span class="float-right"><b><?= $row['nama_mhs']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Semester</span><span class="float-right"><b><?= $row['semester']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Tanggal Pengajuan</span><span class="float-right"><b><td><?php echo "<a>". $h." ". $nm. " ". $t. "</a>" ?></td></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Status Pengajuan</span><span class="float-right"><b><?php echo "<a class='badge badge-".$warna."'>".$status_pengajuan."</a>"; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Formulir</span><span class="float-right"><b><a href="surat_pengajuan.php?id_pengajuan=<?php echo $row['id_pengajuan']; ?>" class ="badge badge-warning">Unduh Formulir</a></b></span></li>
                                    
                                </ul>
                            </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <a href="index.php" type="submit" class="btn btn-secondary" data-dismiss="modal">Close</a>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php endforeach ?>


  <?php
  include "../AdminLTE/footer.php"
  ?>


<!-- jQuery -->
<script src="../AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../AdminLTE/plugins/jszip/jszip.min.js"></script>
<script src="../AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../AdminLTE/dist/js/demo.js"></script>
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

<script>
$(document).Details();

// prevent mouse event, handle focus events only
$('input').on('mouseover mouseleave', function(e) { e.stopPropagation(); });
</script>

<script>
$(document).Edit();

// prevent mouse event, handle focus events only
$('input').on('mouseover mouseleave', function(e) { e.stopPropagation(); });
</script>

<script>
$(document).Hapus();

// prevent mouse event, handle focus events only
$('input').on('mouseover mouseleave', function(e) { e.stopPropagation(); });
</script>

<script>
$(document).Download();

// prevent mouse event, handle focus events only
$('input').on('mouseover mouseleave', function(e) { e.stopPropagation(); });
</script>

</body>
</html>