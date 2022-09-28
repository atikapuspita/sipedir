<?php
  include "../koneksi/config.php";

  include "c_pegawai/c_tambahpegawai.php";
  include "c_pegawai/c_editpegawai.php";

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
    
    $user = mysqli_query($koneksi, "SELECT * FROM tb_pegawai");
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pegawai</li>
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
              <!-- <?php
                $q = mysqli_query($koneksi, "select * from tb_pegawai");
                $j = mysqli_num_rows($q);
              ?>
		        <h3  class="card-title">Data Pegawai ( <?php echo ($j>0)?$j:0; ?> )</h3><br> -->
            <a data-toggle ="modal" data-target ="#modal-tambah" class = "btn btn-default" style ="width : 12%"><i class="fas fa-plus-circle"></i>  Tambah Data</a> 
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th><center>No</center></th>
                      <th><center>NIP/NPAK, NIDN</center></th>
                      <th><center>Nama Pegawai</center></th>
                      <th><center>Jabatan</center></th>
                      <th><center>No. Telp</center></th>
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
                                <?php 
                                if ($row['jabatan'] == "0") {
                                    $jabatan = "Admin";
                                } else {
                                  if ($row['jabatan'] == "1") {
                                      $jabatan = "Dosen Wali";

                                  } elseif ($row['jabatan'] == "2") {
                                      $jabatan = "Ketua Jurusan";

                                  } elseif ($row['jabatan'] == "3") {
                                    $jabatan = "Bagian Keuangan";
                                   
                                } elseif ($row['jabatan'] == "4") {
                                      $jabatan = "Perpustakaan";
                                      
                                  } elseif ($row['jabatan'] == "5") {
                                      $jabatan = "Wakil Direktur I";
                                      
                                  }elseif ($row['jabatan'] == "6") {
                                      $jabatan = "Ketua Jurusan dan Dosen Wali";
                                     
                                  } else {
                                      $jabatan = "Status not found"; 
                                  }
                              } ?>
                                
                                <td><?php echo "$jabatan"; ?></td>
                                <td><?php echo $row["no_telp_pegawai"]; ?></td>
                                <td><center>
                                    <a data-toggle ="modal" data-target="#modaldetail<?php echo $row['nip_npak']; ?>" class = "btn btn-default" title="Detail"><i class="far fa-eye"></i></a> 
                                    <a data-toggle ="modal" data-target="#myModal<?php echo $row['nip_npak']; ?>" class = "btn btn-default"title="Edit" ><i class="nav-icon fas fa-edit"></i> </a>
                                    <a href="hapus_pegawai.php?nip_npak=<?= $row['nip_npak']; ?>"class = "btn btn-default"title="Hapus"><i class="fas fa-trash-alt"></i> </a>                                
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
              <h4 class="modal-title">Tambah Data Pegawai</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method ="post" action ="" enctype="multipart/form-data">
            <div class="modal-body">
            <div class="form-row">
              <div class="form-group  col-6">
                  <label>NIP / NPAK, NIDN</label>
                  <input name = "nip_npak" type="text" class="form-control" id="nip_npak" placeholder="Ex : 1901020290393456"  maxlength="20" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"  required/>
              </div>

              <div class="form-group col-6">
                  <label for="nama_pegawai">Nama Pegawai</label>
                  <input name = "nama_pegawai" type="text" class="form-control" id="nama_pegawai" placeholder="nama pegawai" maxlength="50" oninput="this.value = this.value.replace(/[^a-zA-Z., ]/g, '').replace(/(\..*)\./g, '$1');" required/>
              </div>
            </div>

            <div class="form-row">
            <div class="form-group  col-6">
                  <label>Username</label>
                  <input name = "username" type="text" class="form-control" id="username" placeholder="username" maxlength="10" required/>
              </div>

              <div class="form-group col-6">
                  <label>Password</label>
                  <input name = "password" type="password" class="form-control" id="password" placeholder="password" maxlength="10" required/>
              </div>
            </div>

            <div class="form-row col-12">
              <div class="form-group col-6">
                <label for ="status_doswal">Jabatan</label>
                <select class = "custom-select rounded-0" id ="jabatan" name ="jabatan" required>
                  <option value="">--- Pilih Jabatan ---</option>
                  <option value = "0">Admin</option>
                  <option value = "1">Dosen Wali</option>
                  <option value = "2">Ketua Jurusan</option>
                  <option value = "3">Bagian Keuangan</option>
                  <option value = "4">Perpustakaan</option>
                  <option value = "5">Wakil Direktur I</option>
                  <option value = "6">Ketua Jurusan dan Dosen Wali</option>
                  </select>
              </div>

              <div class="form-group col-6">
                  <label>No.Telp</label>
                  <input name = "no_telp_pegawai" type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="no_telp_pegawai" placeholder="Ex : 0856xxx" maxlength="13" required/>
              </div>
            </div> 

              <div class="form-group">
                    <label>Foto Pegawai *</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="foto_pegawai" name = "foto_pegawai" accept="image/png,image/gif,image/jpeg">
                      </div>
                    </div>
                    <i style="float: left;font-size: 14px;color: red">Tipe file JPEG/JPG/PNG dengan batas max 5 mb</i> <br>
                </div>

                <div class="form-group">
                    <label>Tanda Tangan *</label>
                    <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="form-control" id="ttd_pegawai" name = "ttd_pegawai" accept="image/png,image/gif,image/jpeg">
                    </div>
                    </div>
                    <i style="float: left;font-size: 14px;color: red">Tipe file JPEG/JPG/PNG dengan batas max 5 mb</i> <br>
                    </div>
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

       <!-- / modal edit  -->
      <?php $no = 0;
      foreach ($user as $row) : $no++; ?>
      <div class="modal fade" id="myModal<?php echo $row['nip_npak']; ?>" role="dialog">
        <div class="modal-dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Pegawai</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form role="form" action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
            <?php
              $id_pegawai=$row['id_pegawai'];
              $result= mysqli_query($koneksi, "SELECT * FROM tb_pegawai where id_pegawai='$id_pegawai'");                
              while ($bio= mysqli_fetch_array($result)) {
            ?>
            
            <div class="form-row">
              <input type="hidden" name="id_pegawai" value="<?php echo $bio['id_pegawai']; ?>">
            <div class="form-group col-6">
                  <label>NIP/NPAK, NIDN</label>
                  <input name = "nip_npak" type="text" class="form-control" value="<?php echo $bio['nip_npak']; ?>" maxlength="20" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required/>
              </div>

              <div class="form-group col-6">
                  <label>Nama Pegawai</label>
                  <input name = "nama_pegawai" type="text" class="form-control" value="<?php echo $bio['nama_pegawai']; ?>" maxlength="50" oninput="this.value = this.value.replace(/[^a-zA-Z., ]/g, '').replace(/(\..*)\./g, '$1');" required/>
              </div>
              </div>

              <div class="form-row">
              <div class="form-group col-6">
                  <label>Username</label>
                  <input name = "username" type="text" class="form-control" value="<?php echo $bio['username']; ?>" maxlength="10" required/>
              </div>
              
              <div class="form-group col-6">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password" id="myPassword<?php echo $bio['id_pegawai']; ?>" value="<?php echo $bio['password']; ?>" maxlength="10" required/>
                  <input type="checkbox" onclick="myFunction('<?php echo $bio['id_pegawai']; ?>')"> Lihat Password
              </div>
              </div>

              <div class="form-row">
                <div class="form-group col-6">
                <label for ="jabatan">Jabatan</label>
                <select class = "custom-select rounded-0" id ="jabatan" name ="jabatan" required>
                  <option value = "0" <?php echo $bio['jabatan']==0 ? 'selected': ''; ?>>Admin</option>
                  <option value = "1" <?php echo $bio['jabatan']==1 ? 'selected': ''; ?>>Dosen Wali</option>
                  <option value = "2" <?php echo $bio['jabatan']==2 ? 'selected': ''; ?>>Ketua Jurusan</option>
                  <option value = "3" <?php echo $bio['jabatan']==3 ? 'selected': ''; ?>>Bagian Keuangan</option>
                  <option value = "4" <?php echo $bio['jabatan']==4 ? 'selected': ''; ?>>Perpustakaan</option>
                  <option value = "5" <?php echo $bio['jabatan']==5 ? 'selected': ''; ?>>Wakil Direktur I</option>
                  <option value = "6" <?php echo $bio['jabatan']==6 ? 'selected': ''; ?>>Ketua Jurusan dan Dosen Wali</option>
                  </select>
              </div>

              <div class="form-group col-6">
                  <label>No.Telp</label>
                  <input name = "no_telp_pegawai" type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" value="<?php echo $bio['no_telp_pegawai']; ?>"  maxlength="13" required/>
              </div>
              </div>

              <div class = "row">
                <div class="col-lg-6">
              <div class="form-group">
                    <label>Foto Pegawai</label><br>
                    <img src="img/foto_pegawai/<?php echo $bio['foto_pegawai'];?>"alt="Foto" width="80" ><br><br>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="hidden" name = "foto_pegawai" class="form-control" value="<?php echo $bio['foto_pegawai']; ?>" >
                        <input type="file" name = "foto_pegawai" id="foto_pegawai" class="form-control" accept="image/png,image/gif,image/jpeg" />
                      </div>
                    </div>
                    <i style="float: left;font-size: 14px;color: red">Tipe file JPEG/JPG/PNG dengan batas max 5 mb</i> <br>
                    </div>
                </div>

                <div class="col-lg-6">
              <div class="form-group">
                <label>Tanda Tangan</label><br>
                <img src="img/ttd_pegawai/<?php echo $bio['ttd_pegawai'];?>"alt="ttd" width="80" ><br><br>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="hidden" name = "ttd_pegawai" class="form-control" value="<?php echo $bio['ttd_pegawai']; ?>" >
                      <input type="file" name = "ttd_pegawai" id="ttd_pegawai" class="form-control" accept="image/png,image/gif,image/jpeg"/>
                    </div>
                  </div>
                  <i style="float: left;font-size: 14px;color: red">Tipe file JPEG/JPG/PNG dengan batas max 5 mb</i> <br>
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
              </div>
      <?php endforeach ?>

      <!-- Modal Lihat Detail -->
      <?php $no = 0;
      foreach ($user as $row) : $no++; ?>
<div class="modal fade" id="modaldetail<?php echo $row['nip_npak']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Biodata Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
            <?php
              $nip_npak=$row['nip_npak'];
              $result= mysqli_query($koneksi, "SELECT * FROM tb_pegawai where nip_npak='$nip_npak'");                
              while ($bio= mysqli_fetch_array($result)) {
            ?>
                <div class="row container">
                            <div class="col d-flex align-items-center">
                                <img src="img/ttd_pegawai/<?php echo $row['ttd_pegawai'];?>" alt="Foto" width="250" class="rounded-circle">
                            </div>
                            <div class="col-7">
                                <ul class="list-group">
                                    <li class="list-group-item"><span class="float-left">NIP/NPAK, NIDN</span><span class="float-right"><b><?= $row["nip_npak"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Nama Lengkap</span><span class="float-right"><b><?= $row["nama_pegawai"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Username</span><span class="float-right"><b><?= $row["username"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Password</span><span class="float-right"><b><?= $row["password"]; ?></b></span></li>
                                    <?php 
                                if ($row['jabatan'] == "0") {
                                    $jabatan = "Admin";
                                } else {
                                  if ($row['jabatan'] == "1") {
                                      $jabatan = "Dosen Wali";

                                  } elseif ($row['jabatan'] == "2") {
                                      $jabatan = "Ketua Jurusan";

                                  } elseif ($row['jabatan'] == "3") {
                                    $jabatan = "Bagian Keuangan";
                                   
                                }  elseif ($row['jabatan'] == "4") {
                                      $jabatan = "Perpustakaan";
                                      
                                  } elseif ($row['jabatan'] == "5") {
                                      $jabatan = "Wakil Direktur I";
                                      
                                  } elseif ($row['jabatan'] == "6") {
                                    $jabatan = "Direktur";
                                    
                                } elseif ($row['jabatan'] == "7") {
                                      $jabatan = "Ketua Jurusan dan Dosen Wali";
                                     
                                  } else {
                                      $jabatan = "Status not found"; 
                                  }
                              } ?>
                                    <li class="list-group-item"><span class="float-left">Jabatan</span><span class="float-right"><b><?= $jabatan ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">No. Telp</span><span class="float-right"><b><?= $row["no_telp_pegawai"]; ?></b></span></li>
                                </ul>
                            </div>
                        </div>
 
              <?php
                  }
              ?>

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

<script>
              function myFunction(id) {
              var x = document.getElementById("myPassword"+id);
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
            </script>



</body>
</html>