<?php
  include "../koneksi/config.php";

  include "c_kelas/c_tambahkelas.php";
  include "c_kelas/c_editkelas.php";

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
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE/dist/css/adminlte.min.css">
  <link href="https://code.jquery.com/ui/1.11.2/themes/black-tie/jquery-ui.css" rel="stylesheet"/>


</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php
      include "header_admin.php";
      include "sidebar_admin.php";
      
      $user = mysqli_query($koneksi, "SELECT * FROM tb_kelas join tb_prodi on tb_prodi.id_prodi=tb_kelas.id_prodi");
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kelas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Kelas</li>
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
              
              <a data-toggle ="modal" data-target ="#modal-tambah" class = "btn btn-block btn-default" style ="width : 12%"><i class="fas fa-plus-circle"></i>  Tambah Data</a>
                  
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th><center>No</center></th>
                          <th><center>Nama Prodi</center></th>
                          <th><center>Nama Kelas</center></th>
                          <th><center>Aksi</center></th>
                      </tr>
                    </thead>
                  
                    <tbody>
                      <?php $i = 1; ?>
                      
                      <?php foreach ($user as $row) : ?>
                          <tr>
                            <td><center><?= $i ?></center></td>
                            <td><?php echo $row['nama_prodi']; ?></td>
                            <td><?php echo $row['nama_kelas']; ?></td>
                            <td><center>
                                <a data-toggle ="modal" data-target="#myModal<?php echo $row['id_kelas']; ?>" class = "btn btn-default" title="Edit"><i class="fas fa-edit"></i> </a>
                                <a href="c_kelas/c_hapuskelas.php?id_kelas=<?= $row["id_kelas"]; ?>" class = "btn btn-default" title="Hapus"><i class="fas fa-trash-alt"></i> </a>                                
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
          <h4 class="modal-title">Tambah Data Kelas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method ="post" action ="">
          <div class="modal-body">
          <div class="form-group">
                <label for="id_prodi">Nama Prodi</label>
                <select class = "custom-select rounded-0" id ="id_prodi" name ="id_prodi" required>
                    <?php 
                        $result= mysqli_query($koneksi, "SELECT * FROM tb_prodi");                
                        while ($prodi= mysqli_fetch_array($result)) {
                    ?>
                    <option value = "<?=$prodi['id_prodi']?>" ><?= $prodi['nama_prodi'] ?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group">
              <label for ="nama_jurusan">Nama Kelas</label>
                <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" maxlength="100" required/>
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
  <div class="modal fade" id="myModal<?php echo $row['id_kelas']; ?>" role="dialog">
    <div class="modal-dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data Kelas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>

          <form role="form" action="" method="get">
            <div class="modal-body">
             

            <div class="form-group"hidden>
              <input name = "id_kelas" type="text" class="form-control" value="<?php echo $row['id_kelas']; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="id_jurusan">Nama Prodi</label>
                <select class = "custom-select rounded-0" id ="id_prodi" name ="id_prodi" required>
                    <?php 
                        $result= mysqli_query($koneksi, "SELECT * FROM tb_prodi");                
                        while ($jrs= mysqli_fetch_array($result)) {
                    ?>
                    <option value = "<?=$jrs['id_prodi']?>" <?=$jrs['id_prodi']==$row['id_prodi']? 'selected':''?>><?= $jrs['nama_prodi'] ?></option>
                    <?php }?>
                </select>
            </div>

            <div class="form-group">
              <label for ="nama_kelas">Nama Kelas</label>
              <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" value="<?=$row['nama_kelas']; ?>" maxlength="100" required/>
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