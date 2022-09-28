<?php
  include "../koneksi/config.php";
  include "c_tambahpengajuan.php";


  session_start();
  date_default_timezone_set('Asia/Jakarta');
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
  

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php
      include "header_mahasiswa.php";
      include "sidebar_mahasiswa.php";
      
      $id_mahasiswa = $_SESSION['id_mahasiswa'];
      $user =  "SELECT tb_pengajuan.*,tb_mahasiswa.*,tb_verifikasi_doswal.alasan_tolak as t1,tb_verifikasi_unit.alasan_tolak as t2,tb_verifikasi_kajur.alasan_tolak as t3 FROM tb_pengajuan INNER JOIN tb_mahasiswa ON tb_pengajuan.id_mahasiswa = tb_mahasiswa.id_mahasiswa LEFT JOIN tb_verifikasi_doswal on tb_verifikasi_doswal.id_pengajuan=tb_pengajuan.id_pengajuan LEFT JOIN tb_verifikasi_kajur on tb_verifikasi_kajur.id_pengajuan=tb_pengajuan.id_pengajuan LEFT JOIN tb_verifikasi_unit on tb_verifikasi_unit.id_pengajuan=tb_pengajuan.id_pengajuan WHERE tb_pengajuan.id_mahasiswa='$id_mahasiswa' GROUP BY tb_pengajuan.id_pengajuan; ";
      $result = mysqli_query($koneksi,$user);
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

      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">Data Pengunduran Diri</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">

              <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                          <th><center>No</center></th>
                          <th><center>Nama Mahasiswa</center></th>
                          <th><center>Tanggal Pengajuan</center></th>
                          <th><center>Alasan</center></th>
                          <th><center>Berkas Pendukung</center></th>
                          <th><center>Persetujuan Ortu</center></th>
                          <th><center>Status </center></th>
                          <th><center>Aksi</center></th>
                      </tr>
                    </thead>
                  
                    <tbody>
                      <?php $i = 1; ?>
                      <?php                                                  
                       
                       
                        $no= 1;
                        while($d = mysqli_fetch_array($result)) {
                                                  
                          $t = substr($d['tgl_pengajuan'],0,4);
                          $b = substr($d['tgl_pengajuan'],5,2);
                          $h = substr($d['tgl_pengajuan'],8,2);
                      
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
                            <td><?php echo $d['nama_mhs']; ?></td>
                            <td><?php echo  "<a>". $h." ". $nm. " ". $t. "</a>" ?></td>
                            <td><?php echo $d['alasan']; ?></td>
                            <td><center><b>
                              <?php if($d['berkas_pendukung'] == ""){
                              ?> 
                              <a  href="#" class ="badge badge-secondary">Lihat Berkas</a></b>
                              <?php
                              } else { ?>
                              <a target="_blank" href="../pdf/berkas/<?php echo $d['berkas_pendukung']; ?>" class ="badge badge-warning">Lihat Berkas</a></b>
                              <?php } ?>
                               
                              
                            </center></td>
                            <td><center><b>
                             
                              <a target="_blank" href="../pdf/orangtua/<?php echo $d['surat_persetujuan_ortu']; ?>" class ="badge badge-warning">Lihat Berkas</a></b>
                           
                               
                              
                            </center></td>  
                            <?php 
                            $alasan="";
                              if (empty($d['status_pengajuan'])) {
                                  $status_pengajuan = "Belum diverifikasi";
                                  $warna = 'warning';
                              } else {
                                  if ($d['status_pengajuan'] == "1") {
                                      $status_pengajuan = "Diiverifikasi Dosen Wali";
                                      $warna = 'info';
                                  } elseif ($d['status_pengajuan'] == "2") {
                                      $status_pengajuan = "Diiverifikasi Perpustakaan";
                                      $warna = 'primary';
                                  } elseif ($d['status_pengajuan'] == "3") {
                                    $status_pengajuan = "Diiverifikasi Bagian Keuangan";
                                    $warna = 'primary';
                                } elseif ($d['status_pengajuan'] == "4") {
                                  $status_pengajuan = "Pengajuan Diterima";
                                  $warna = 'primary';
                                 
                              } elseif ($d['status_pengajuan'] == "5") {
                                      $status_pengajuan = "Ditolak";
                                  $alasan=$d['t1']?"alasan : ".$d['t1']:"";
                                  $alasan=$d['t2']?"alasan : ".$d['t2']:$alasan;
                                  $alasan=$d['t3']?"alasan : ". $d['t3']:$alasan;
                                  $warna = 'danger';
                                } else {
                                    $status_pengajuan = "Status not found"; 
                                    $warna = '';
                                }
                              } ?>
                              <td><center><?php echo "<a class='badge badge-".$warna."'>".$status_pengajuan."</a><br>".$alasan; ?></center></td>
                            <td>
                                <?php
                                  if ($d['status_pengajuan'] == '4') { ?>
                                  <center>
                                  <a target="_blank" class="btn btn-default" href="../admin/surat_pengajuan.php?id_pengajuan=<?= $d["id_pengajuan"]; ?>"><i class="fas fa-print"></i> Surat Pengajuan</a>
                                  <a target="_blank" class="btn btn-default" href="../pdf/sk/<?= $d["file_sk"]; ?>"><i class="fas fa-print"></i> Surat Keputusan</a>
                                  <a target="_blank" href="../pdf/nilai/<?= $d["nilai"]; ?>" class ="btn btn-default"><i class="fas fa-print"></i> Unduh Nilai</a>
                                  <a data-toggle="modal" data-target="#modaltimeline<?= $d['id_pengajuan']; ?>" class ="btn btn-default"><i class="fas fa-history"></i></a>
                                  </center>
                                <?php } elseif ($d['status_pengajuan'] == '0') { ?>
                                  <center>
                                  <a data-toggle ="modal" data-target="#modaldetail<?php echo $d['id_pengajuan']; ?>" class ="btn btn-default"><i class="far fa-eye"></i></a> 
                                    <a data-toggle ="modal" data-target="#edit<?php echo $d['id_pengajuan']; ?>" class = "btn btn-default"><i class="nav-icon fas fa-edit"></i></a> 
                                    <a data-toggle="modal" data-target="#modaltimeline<?= $d['id_pengajuan']; ?>" class ="btn btn-default"><i class="fas fa-history"> </i></a> 
                                    </center>
                                    <?php } else { ?>
                                      <center>
                                        <!-- <a data-toggle ="modal" data-target="#modaldetail<?php echo $d['id_pengajuan']; ?>" class ="btn btn-default"><i class="far fa-eye"></i></a>  -->
                                        <a data-toggle="modal" data-target="#modaltimeline<?= $d['id_pengajuan']; ?>" class ="btn btn-default"><i class="fas fa-history"></i></a> 
                                        </center>
                                   <?php } ?>
                                      <?php include "timeline.php"; ?>
                              </td>
                          </tr>
                          
                            <?php $i++ ; ?>

                            <?php
                            }
                          ?>
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

  <!-- /.Modals Tambah --> 
      

        <!-- /.modal-dialog -->

              <!-- / modal edit  -->
              <?php $no = 0;
      foreach ($result as $row) : $no++; ?>
      <div class="modal fade" id="edit<?php echo $row['id_pengajuan']; ?>" role="dialog">
        <div class="modal-dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Pengajuan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form role="form" action="c_editpengajuan.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
            <?php
              $id_pengajuan=$row['id_pengajuan'];
              $results= mysqli_query($koneksi, "SELECT * FROM tb_pengajuan where id_pengajuan='$id_pengajuan'");                
              while ($bio= mysqli_fetch_array($results)) {
            ?>

            <div class="form-group" hidden>
                  <label>Id Pengajuan</label>
                  <input name = "id_pengajuan" type="text" class="form-control" value="<?php echo $bio['id_pengajuan']; ?>" readonly/>
              </div>
              <div class="form-group" hidden>
                  <label>Semester</label>
                  <select class="custom-select" name="semester">
                    <option value="" disabled>Pilih Semester</option>
                    <option value="1" <?= $bio['semester']==1 ? 'selected':""; ?>>1</option>
                    <option value="2" <?= $bio['semester']==2 ? 'selected':""; ?>>2</option>
                    <option value="3" <?= $bio['semester']==3 ? 'selected':""; ?>>3</option>
                    <option value="4" <?= $bio['semester']==4 ? 'selected':""; ?>>4</option>
                    <option value="5" <?= $bio['semester']==5 ? 'selected':""; ?>>5</option>
                    <option value="6" <?= $bio['semester']==6 ? 'selected':""; ?>>6</option>
                    <option value="7" <?= $bio['semester']==7 ? 'selected':""; ?>>7</option>
                    <option value="8" <?= $bio['semester']==8 ? 'selected':""; ?>>8</option>
                  </select>
              </div>
              <div class="form-group">
                  <label>Alasan</label>
                  <select class="form-control" name="alasan" id="alasan" required>
                    <option value="" >Pilih Alasan</option> 
                    <option value="Di terima kerja" <?php echo $bio['alasan']=='Di terima kerja'?'selected':''; ?>>Di terima kerja</option>
                    <option value="Pindah Kampus" <?php echo $bio['alasan']=='Pindah Kampus'?'selected':''; ?>>Pindah Kampus</option>
                    <option value="Menikah" <?php echo $bio['alasan']=='Menikah'?'selected':''; ?>>Menikah</option>
                    <option value="Sakit" <?php echo $bio['alasan']=='Sakit'?'selected':''; ?>>Sakit</option>
                    <option value="Lainnya" <?php echo $bio['alasan']=='Lainnya'?'selected':''; ?>>Lainnya</option>
                  </select>
              </div>

              <div class="form-group" hidden>
                  <label>Tanggal Pengajuan</label>
                  <input name = "tgl_pengajuan" type="date" class="form-control" min="<?php echo $bio['tgl_pengajuan']; ?>" value="<?php echo $bio['tgl_pengajuan']; ?>">
              </div>

              <div class="form-group">
                  <label>Nama Orang Tua</label>
                  <input name = "nama_ortu" type="text" class="form-control" value="<?php echo $bio['nama_ortu']; ?>">
              </div>

              <div class="form-group">
                <label for="ttd_ortu">Tanda Tangan Orang Tua</label><br>
                <img src="../admin/img/ttd_orangtua/<?php echo $bio['ttd_ortu'];?>"alt="Foto" width="100" ><br><br>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name = "ttd_ortu" class="form-control" value="<?php echo $bio['ttd_ortu']; ?>" >
                        <input type="file" name = "ttd_ortu" id="ttd_ortu" class="form-control" accept="image/png,image/gif,image/jpeg"/>
                    </div>
                  </div>
                  <i style="float: left;font-size: 14px;color: red">Tipe file JPEG/JPG/PNG dengan batas max 5 mb</i> <br>
              </div>
              <div class="form-group">
                <label for="ttd_ortu">Surat Persetujuan Ortu</label><br>
               <a target="_blank" class="btn btn-success btn-sm mb-1" href="../pdf/orangtua/<?php echo $bio['surat_persetujuan_ortu']; ?>">Lihat Berkas</a>
                <br>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="ortu" class="form-control" value="<?php echo $bio['surat_persetujuan_ortu']; ?>" >
                        <input type="file" name="ortu" id="ortu" class="form-control" accept="application/pdf"/>
                    </div>
                  </div>
                  <i style="float: left;font-size: 14px;color: red">Tipe file JPEG/JPG/PNG dengan batas max 5 mb</i> <br>
              </div>
              <div class="form-group">
                <label for="ttd_ortu">Berkas</label><br>
               <a target="_blank" class="btn btn-success btn-sm mb-1" href="../pdf/berkas/<?php echo $bio['berkas_pendukung']; ?>">Lihat Berkas</a>
                <br>
                  <div class="input-group">
                    <div class="custom-file">
                    <input type="hidden" name="berkas" class="form-control" value="<?php echo $bio['berkas_pendukung']; ?>" >
                        <input type="file" name="berkas" id="berkas" class="form-control" accept="application/pdf"/>
                    </div>
                  </div>
                  <i style="float: left;font-size: 14px;color: red">Tipe file JPEG/JPG/PNG dengan batas max 5 mb</i> <br>
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

      
<!-- Modal Lihat Detail -->
<?php $no = 0;
      foreach ($result as $row) : $no++; ?>
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
            <?php
              $id_pengajuan=$row['id_pengajuan'];
              $results= mysqli_query($koneksi, "SELECT * FROM tb_pengajuan join tb_mahasiswa on tb_mahasiswa.id_mahasiswa=tb_pengajuan.id_mahasiswa where id_pengajuan='$id_pengajuan'");                
              while ($bio= mysqli_fetch_array($results)) {
            ?>
              <div class="row container">
                            <div class="col-12">
                                <ul class="list-group">
                                <li class="list-group-item"><span class="float-left">Id Pengajuan</span><span class="float-right"><b><?= $row['id_pengajuan']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Nama Mahasiswa</span><span class="float-right"><b><?= $bio['nama_mhs']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Semester</span><span class="float-right"><b><?= $row['semester']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Tanggal Pengajuan</span><span class="float-right"><b><?= $row['tgl_pengajuan']; ?></b></span></li>
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
                            }  ?>
                                    <li class="list-group-item"><span class="float-left">Status Pengajuan</span><span class="float-right"><b><?= "<a class='badge badge-".$warna."'>".$status_pengajuan."</a>"; ?></b></span></li>
                                    
                                      <li class="list-group-item"><span class="float-left">Formulir</span><span class="float-right"><b><a href="../admin/surat_pengajuan.php?id_pengajuan=<?= $row["id_pengajuan"]; ?>" class ="badge badge-success">Unduh Formulir</a></b></span></li>
                                  
                                  
                                    </ul>
                            </div>
                </div>
              <?php }?>

            </div>
            <div class="modal-footer justify-content-between">
                <a href="index.php" type="submit" class="btn btn-secondary" data-dismiss="modal">Close</a>
                </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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



</body>
</html>