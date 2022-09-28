<?php
  include "../koneksi/config.php";

  include "c_doswal/c_tambahdoswal.php";
  include "c_doswal/c_editdoswal.php";

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
  <!-- Select2 -->
  <link rel="stylesheet" href="../AdminLTE/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
      
      $user = mysqli_query($koneksi, "SELECT * FROM tb_doswal INNER JOIN tb_pegawai ON tb_doswal.id_pegawai = tb_pegawai.id_pegawai INNER JOIN tb_kelas on tb_doswal.id_kelas = tb_kelas.id_kelas");
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Dosen Wali</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Dosen Wali</li>
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
              <?php
                $q = mysqli_query($koneksi, "select * from tb_doswal");
                $j = mysqli_num_rows($q);
              ?>
		        <h3  class="card-title">Data Dosen Wali ( <?php echo ($j>0)?$j:0; ?> )</h3></div> -->
              <!-- /.card-header -->
              <div class="card-header">
              <a data-toggle ="modal" data-target ="#modal-tambah" class = "btn btn-default" style ="width : 12%"><i class="fas fa-plus-circle"></i>  Tambah Data</a> 
              </div> 

              <div class="card-body">
                <!-- <a data-toggle ="modal" data-target ="#modal-tambah" class = "btn  btn-success mb-2" ><i class="fas fa-plus-circle"></i>  Tambah Data</a> <br> -->
                  <table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th><center>No</center></th>
                          <th><center>NIP/NPAK,NIDN</center></th>
                          <th><center>Nama Pegawai</center></th>
                          <th><center>Kelas</center></th>
                          <th><center>Status</center></th>
                          <th><center>Aksi</center></th>
                      </tr>
                    </thead>
                  
                    <tbody>
                      <?php $i = 1; ?>
                      
                      <?php foreach ($user as $row) : ?>
                          <tr>
                            <td><center><?= $i ?></center></td>
                            <td><?php echo $row['nip_npak']; ?></td>
                            <td><?php echo $row['nama_pegawai']; ?></td>
                            <td><?php echo $row['nama_kelas']; ?></td>
                            <td><?php echo $row['status']==1?'Aktif':'Tidak Aktif'; ?></td>
                            <td><center>
                                <a data-toggle ="modal" data-target="#modaldetail<?php echo $row["id_doswal"]; ?>" class = "btn btn-default" title="Detail"><i class="far fa-eye"></i></a>
                                <a data-toggle ="modal" data-target="#myModal<?php echo $row['id_doswal']; ?>" class = "btn btn-default" title="Edit"><i class="nav-icon fas fa-edit"></i></a>
                                <a href="c_doswal/c_hapusdoswal.php?id_doswal=<?= $row["id_doswal"]; ?>" class = "btn btn-default" title="Hapus"><i class="fas fa-trash-alt"></i></a>                                
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
          <h4 class="modal-title">Tambah Data Dosen Wali</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method ="post" action ="data_doswal.php">
          <div class="modal-body">
            
           <div class="form-group">
              <label for="exampleSelectRounded0">Nama Pegawai</label>
                <select type="text" class="form-control select2bs4" aria-describedby="emailHelp" name="id_pegawai" id="id_pegawai" required>
                  <option value=""> Pilih Pegawai</option>
                    <?php $tb_pegawai = mysqli_query($koneksi, "SELECT * FROM tb_pegawai ");
                      foreach ($tb_pegawai as $dtg) : 
                    ?>
                      <option value="<?php echo $dtg['id_pegawai'] ?>" ><?php echo $dtg['nama_pegawai'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
              <label for="exampleSelectRounded0">Nama Kelas</label>
                <select type="text" class="form-control select2bs4" aria-describedby="emailHelp" name="id_kelas" id="id_kelas" required>
                  <option value=""> Silahkan Pilih</option>
                    <?php $tb_kls = mysqli_query($koneksi, "SELECT * FROM tb_kelas ");
                      foreach ($tb_kls as $dtg) : 
                    ?>
                      <option value="<?php echo $dtg['id_kelas'] ?>" ><?php echo $dtg['nama_kelas'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                      <label for="status ">Status</label>
                      <select class="custom-select" id="status" name="status" required>
                        <option value="" selected>Pilih Status</option>
                        <option value="1" >Aktif</option>
                        <option value="0" >Tidak Aktif</option>
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
foreach ($user as $row) : $no++; ?>
  <div class="modal fade" id="myModal<?php echo $row['id_doswal']; ?>" role="dialog">
    <div class="modal-dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data Dosen Wali</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>

          <form role="form" action="" method="post">
            <div class="modal-body">
            <input type="hidden" name="id_doswal" value="<?=$row['id_doswal']?>">
              <form role="form" action="" method="post">
            <div class="modal-body">
            <input type="hidden" name="id_doswal" value="<?=$row['id_doswal']?>">
              <div class="form-group">
                <label for="exampleSelectRounded0">Nama Pegawai</label>
                  <select type="text" class="form-control select2bs4" aria-describedby="kelasHelp" name="id_pegawai" id="id_pegawai<?=$no ?>" required>
                    <option value=""> Pilih Pegawai</option>
                      <?php $tb_pegawai = mysqli_query($koneksi, "SELECT * FROM tb_pegawai ");
                        foreach ($tb_pegawai as $dtg) : 
                      ?>
                        <option value="<?php echo $dtg['id_pegawai'] ?>" <?= $dtg['id_pegawai'] == $row['id_pegawai'] ? 'selected':'' ?>><?php echo $dtg['nama_pegawai'] ?></option>
                      <?php endforeach; ?>
                  </select>
              </div>
              <div class="form-group">
                <label for="exampleSelectRounded0">Nama Kelas</label>
                  <select type="text" class="form-control select2bs4" aria-describedby="emailHelp" name="id_kelas" id="id_kelas<?php echo $row['id_doswal']; ?>" required>
                    <option value=""> Silahkan Pilih</option>
                      <?php $tb_kls = mysqli_query($koneksi, "SELECT * FROM tb_kelas ");
                        foreach ($tb_kls as $dtg) : 
                      ?>
                        <option value="<?php echo $dtg['id_kelas'] ?>" <?= $dtg['id_kelas'] == $row['id_kelas'] ? 'selected':'' ?>><?php echo $dtg['nama_kelas'] ?></option>
                      <?php endforeach; ?>
                  </select>
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
              <button type="edit" class="btn btn-primary" id ="edit" name = "edit">Save changes</button>
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

<!-- Modal Lihat Detail -->
<?php $no = 0;
    foreach ($user as $row) : $no++; 
?>
      <div class="modal fade" id="modaldetail<?php echo $row["id_doswal"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Biodata Dosen Wali</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
          

                          <div class="row container">
                            <div class="col-12">
                                <ul class="list-group">
                                    <li class="list-group-item"><span class="float-left">NIP/NPAK,NIDN</span><span class="float-right"><b><?= $row['nip_npak']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Nama Pegawai</span><span class="float-right"><b><?= $row['nama_pegawai']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Username</span><span class="float-right"><b><?= $row['username']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Password</span><span class="float-right"><b><?= $row['password']; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Kelas</span><span class="float-right"><b><?= $row['nama_kelas']; ?></b></span></li>
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
<!-- /.modal -->
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

<!-- Select2 -->
<script src="../AdminLTE/plugins/select2/js/select2.full.min.js"></script>

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
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    $('#id_kelas').select2();
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
$('.toastrDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Data berhasil di edit'
      })
    });
  </script>
</body>
</html>