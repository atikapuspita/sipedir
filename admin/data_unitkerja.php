<?php
  include "../koneksi/config.php";

  include "c_unitkerja/c_tambahunit.php";
  include "c_unitkerja/c_editunit.php";

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
  <link rel="stylesheet" href="../AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../tampilan/tampilan.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../css/a.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../AdminLTE/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE/dist/css/adminlte.min.css">
  <link href="https://code.jquery.com/ui/1.11.2/themes/black-tie/jquery-ui.css" rel="stylesheet"/>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php
      include "header_admin.php";
      include "sidebar_admin.php";
      
      $user = mysqli_query($koneksi, "SELECT * FROM tb_unit_kerja INNER JOIN tb_pegawai ON tb_unit_kerja.id_pegawai = tb_pegawai.id_pegawai  ");
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Unit Kerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Unit Kerja</li>
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
             
		        <h3  class="card-title">Data Ketua Jurusan ( <?php echo ($j>0)?$j:0; ?> )</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-header">
              
              <a data-toggle ="modal" data-target ="#modal-tambah" class = "btn btn-block btn-default" style ="width : 12%"><i class="fas fa-plus-circle"></i>  Tambah Data</a>
                  
              </div>
              <div class="card-body">
              
                  <table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th><center>No</center></th>
                          <th><center>Nama Unit</center></th>
                          <th><center>NIP/NPAK, NIDN</center></th>
                          <th><center>Nama Pegawai</center></th>
                          <th><center>Status</center></th>
                          <th><center>Aksi</center></th>
                      </tr>
                    </thead>
                  
                    <tbody>
                      <?php $i = 1; ?>
                          <?php foreach ($user as $row) : ?>
                          <tr>
                            <td><center><?= $i ?></center></td>
                            <td><?php echo $row['nama_unit']; ?></td>
                            <td><?php echo $row['nip_npak']; ?></td>
                            <td><?php echo $row['nama_pegawai']; ?></td>
                            <td><?php echo $row['status'] ==1 ? 'Aktif':'Tidak Aktif'; ?></td>
                            <td><center>
                                <a data-toggle ="modal" data-target="#modaldetail<?php echo $row["id_unit"]; ?>" class = "btn btn-default" title="Detail"><i class="far fa-eye"></i></a> 
                                <a data-toggle ="modal" data-target="#myModal<?php echo $row['id_unit']; ?>" class = "btn btn-default" title="Edit"><i class="nav-icon fas fa-edit"></i> </a>
                                <a href="c_unitkerja/c_hapusunit.php?id_unit=<?= $row["id_unit"]; ?>" class = "btn btn-default" title="Hapus"><i class="fas fa-trash-alt"></i> </a>
                            </td></center>
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

  <!-- /.Modals Tambah --> 
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Unit Kerja</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method ="post" action ="">
          <div class="modal-body">

            <div class="form-group">
              <label for="exampleSelectRounded0">Nama Pegawai</label>
              <select type="text" class="form-control select2bs4" aria-describedby="emailHelp" name="id_pegawai" id="id_pegawai">
                <option>Pilih Pegawai</option>
                  <?php $tb_pegawai = mysqli_query($koneksi, "SELECT * FROM tb_pegawai");
                    foreach ($tb_pegawai as $dtg) : 
                  ?>
                    <option value="<?php echo $dtg['id_pegawai'] ?>" nama_pegawai="<?php echo $dtg['nama_pegawai'] ?>"><?php echo $dtg['nama_pegawai'] ?></option>
                  <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
                <label for="id_prodi">Nama Unit</label>
                <input type="text" class="form-control" id="nama_unit" name="nama_unit" placeholder="Nama Unit" maxlength="75" required>
            </div>
            <div class="form-group">
                <label for="status ">Status</label>
                <select class="custom-select" id="status" name="status" required>
                  <option value="" selected>Pilih Status</option>
                  <option value="1">Aktif</option>
                  <option value="0">Tidak Aktif</option>
                </select>
            </div>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name = "tambah">Save changes</button>
            </div>
          </div>
        </form>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<!-- / modal edit  -->
<?php $no = 0;
$prodi = mysqli_query($koneksi, "SELECT * FROM tb_unit_kerja");
foreach ($user as $row) : $no++; ?>
  <div class="modal fade" id="myModal<?php echo $row['id_unit']; ?>" role="dialog">
    <div class="modal-dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data Unit Kerja</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form role="form" action="" method="post">
            <div class="modal-body">
                  <div class="form-group" hidden>
                    <input name = "id_unit" type="text" class="form-control" value="<?php echo $row['id_unit']; ?>" readonly/>
                  </div>
                  <div class="form-group">
                    <label for="id_prodi">Nama Pegawai</label>
                    <select type="text" class="form-control select2bs4"  name="id_pegawai" id="id_pegawai<?=$no?>" require>
                      <option value=""> Pilih Pegawai</option>
                        <?php 
                          $result= mysqli_query($koneksi, "SELECT * FROM tb_pegawai");                
                          while ($pgw= mysqli_fetch_array($result)) {
                        ?>
                          <option value="<?php echo $pgw['id_pegawai'] ?>" <?= $row['id_pegawai']==$pgw['id_pegawai'] ? 'selected' : '' ?> ><?php echo $pgw['nama_pegawai'] ?></option>
                        <?php } ?>
                    </select>
                  </div>  
                  <div class="form-group">
                      <label for="id_jurusan">Nama Unit</label>
                      <input type="text" class="form-control" id="nama_unit" name="nama_unit" value="<?php echo $row['nama_unit']; ?>" required>
                  </div>
                  <div class="form-group">
                      <label for="status ">Status</label>
                      <select class="custom-select" id="status" name="status" required>
                        <option value="" selected>Pilih Status</option>
                        <option value="1" <?=1==$row['status']? 'selected':''?>>Aktif</option>
                        <option value="0" <?=0==$row['status']? 'selected':''?>>Tidak Aktif</option>
                      </select>
                  </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="edit" id ="edit" class="btn btn-primary" name = "edit">Save changes</button>
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

      <!-- Modal Lihat Detail -->
      <?php $no = 0;
      foreach ($user as $row) : $no++; ?>
<div class="modal fade" id="modaldetail<?php echo $row['id_unit']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Biodata Unit Kerja</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
             
                          <div class="row container">
                            <div class="col-12">
                                <ul class="list-group">
                                <!-- <li class="list-group-item"><span class="float-left">Id Unit</span><span class="float-right"><b><?= $row['id_unit']; ?></b></span></li> -->
                                    <li class="list-group-item"><span class="float-left">NIP/NPAK,NIDN</span><span class="float-right"><b><?= $row['nip_npak']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Nama Pegawai</span><span class="float-right"><b><?= $row['nama_pegawai']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Username</span><span class="float-right"><b><?= $row['username']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Password</span><span class="float-right"><b><?= $row['password']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Nama Unit</span><span class="float-right"><b><?= $row['nama_unit']; ?></b></span></li>
                                  </ul>
                </div>
                          </div>
              
             

            </div>
            <div class="modal-footer justify-content-between">
                <a href="index.php" type="submit" class="btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach ?>


  <?php include "../AdminLTE/footer.php" ?>


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
<!-- Select2 -->
<script src="../AdminLTE/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../AdminLTE/dist/js/demo.js"></script>

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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../AdminLTE/dist/js/pages/dashboard.js"></script>


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
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
} );
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#nip_npak").on("change", function(){
      var nama_pegawai = $("#nip_npak option:selected").attr("nama_pegawai");
      $("#nama_pegawai").val(nama_pegawai);
    });

  });
</script>
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

<script>
$(document).Detail();

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

</body>
</html>