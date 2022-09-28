<?php
  include "../koneksi/config.php";

  include "c_mahasiswa/c_tambahmahasiswa.php";
  include "c_mahasiswa/c_editmahasiswa.php";

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
      
      $user = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_mahasiswa.id_kelas INNER JOIN tb_prodi ON tb_kelas.id_prodi = tb_prodi.id_prodi INNER JOIN tb_jurusan ON tb_prodi.id_jurusan = tb_jurusan.id_jurusan
                         ORDER BY nama_mhs ASC ");
  ?>

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Mahasiswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Mahasiswa</li>
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
                $q = mysqli_query($koneksi, "select * from tb_mahasiswa");
                $j = mysqli_num_rows($q);
              ?>
		        <h3  class="card-title">Data Mahasiswa( <?php echo ($j>0)?$j:0; ?> )</h3><br> -->
            <a data-toggle ="modal" data-target ="#modal-tambah" class = "btn btn-block btn-default" style ="width : 12%"><i class="fas fa-plus-circle"></i>  Tambah Data</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th><center>No</center></th>
                        <th><center>NPM</center></th>
                        <th><center>Nama Mahasiswa</center></th>
                        <th><center>Jurusan</center></th>
                        <th><center>Program Studi</center></th>
                        <th><center>Tahun Akademik</center></th>
                        <th><center>No.Telp</center></th>
                        <th><center>AKSI</center></th>
                    </tr>
                  </thead>
                
                  <tbody>
                    <?php $i = 1; ?>
                    
                    <?php foreach ($user as $row) : ?>
                            <tr>
                                <td><center><?= $i ?></center></td>
                                <td><?php echo $row['npm']; ?></td>
                                <td><?php echo $row['nama_mhs']; ?></td>
                                <td><?php echo $row['nama_jurusan']; ?></td>
                                <td><?php echo $row['nama_prodi']; ?></td>
                                <td><center><?php echo $row['thn_angkatan']; ?></center></td>
                                <td><?php echo $row['no_telp_mhs']; ?></td>
                                <td><center>
                                    <a data-toggle ="modal" data-target="#modaldetail<?php echo $row['npm']; ?>" class = "btn btn-default" title = "Details"> <i class="fas fa-eye"></i> </a>
                                    <a data-toggle ="modal" data-target="#myModal<?php echo $row['npm']; ?>" class = "btn btn-default"title = "Edit"><i class="nav-icon fas fa-edit"></i> </a>
                                    <a href="c_mahasiswa/hapus_mahasiswa.php?id_mahasiswa=<?= $row["id_mahasiswa"]; ?>"class = "btn btn-default" title = "Hapus"><i class="fas fa-trash-alt"></i> </a>                                
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
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Mahasiswa</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method ="post" action ="" enctype="multipart/form-data">
            <div class="modal-body">

            <div class="form-row">
            <div class="form-group col-4">
                  <label>NPM</label>
                  <input name = "npm" type="text" class="form-control" id="npm" placeholder="Ex : 190202035" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required/>
            </div>
            
            <div class="form-group col-4">
                  <label for="nama_mhs">Nama Mahasiswa</label>
                  <input name = "nama_mhs" type="text" class="form-control" id="nama_mhs" placeholder="nama mahasiswa" oninput="this.value = this.value.replace(/[^a-zA-Z., ]/g, '').replace(/(\..*)\./g, '$1');" maxlength="50" required/>
            </div>

            <div class="form-group col-4">
                  <label>Username</label>
                  <input name = "username_mhs" type="text" class="form-control" id="username_mhs" placeholder="username" maxlength="10" required/>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-4">
                  <label>Password</label>
                  <input name = "password_mhs" type="password" class="form-control" id="password_mhs" placeholder="password" maxlength="10" required/>
              </div>
              <div class="form-group col-4">
                <label for="exampleSelectRounded0">Nama Jurusan</label>
                <select type="text" class="form-control" aria-describedby="emailHelp" name="id_jurusan" id="id_jurusan" required>
                  <option value="" > Pilih Jurusan</option>
                  <?php $prodi = mysqli_query($koneksi, "SELECT * FROM tb_jurusan ");
                      foreach ($prodi as $pro) : 
                    ?>
                      <option value="<?php echo $pro['id_jurusan'] ?>" ><?php echo $pro['nama_jurusan'] ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-4">
                <label for="exampleSelectRounded0">Nama Program Studi</label>
                <select type="text" class="form-control" aria-describedby="emailHelp" name="id_prodi" id="id_prodi" required>
                  <option value=""> Pilih Program Studi</option>
                    
                </select>
              </div>


            </div>

            <div class="form-row">
            <div class="form-group col-4">
            <label for="id_kelas">Nama Kelas</label>
              <select type="text" class="form-control" aria-describedby="emailHelp" name="id_kelas" id="id_kelas" required>
                <option value="" > Pilih Kelas</option>
                  
              </select>
            </div>
            <div class="form-group col-4">
              <label for ="jk">Jenis Kelamin</label>
              <select class = "custom-select rounded-0" id ="jk" name ="jk" required>
                <option>Pilih Jenis Kelamin</option>
                <option value = "Laki - Laki">Laki - Laki</option>
                <option value = "Perempuan">Perempuan</option>
              </select>
            </div>          
              <div class="form-group col-4">
                  <label>Tanggal lahir</label>
                  <input name = "ttl" max="<?= date('Y-m-d')?>" type="date" class="form-control" id="ttl" required/>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-4">
                  <label>No.Telp</label>
                  <input name = "no_telp_mhs" type="number" class="form-control" id="no_telp_mhs" placeholder="Ex : 05857468xxxx" maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required/>
              </div>
              
              <div class="form-group col-4">
                  <label for="thn_angkatan">Tahun Akademik</label>
                  <input name = "thn_angkatan" type="text" class="form-control" id="thn_angkatan" placeholder="Ex : 2019/2020" maxlength="10" required/>
              </div>   
              <div class="form-group col-4">
                  <label for="alamat">Alamat</label>
                  <textarea rows="2" input name = "alamat" type="text" class="form-control" id="alamat" placeholder="alamat" maxlength="50" required/></textarea>
              </div>
            </div>

              <div class="form-group">
                    <label>Foto Mahasiswa *</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="foto_mhs" name = "foto_mhs" accept="image/png,image/gif,image/jpeg">
                      </div>
                    </div>
                    <i style="float: left;font-size: 14px;color: red">Tipe file JPEG/JPG/PNG dengan batas max 5 mb</i> <br>
                </div>

                <div class="form-group">
                    <label>Tanda Tangan *</label>
                    <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="form-control" id="ttd_mhs" name = "ttd_mhs" accept="image/png,image/gif,image/jpeg">
                    </div>
                    </div>
                    <i style="float: left;font-size: 14px;color: red">Tipe file JPEG/JPG/PNG dengan batas max 5 mb</i> <br>
                    </div>
                </div>

              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
      <div class="modal fade" id="myModal<?php echo $row['npm']; ?>" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Mahasiswa</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form role="form" action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
           
            <div class="form-row">
              <input type="hidden" name="id_mahasiswa" value="<?= $row['id_mahasiswa']?>">
              <div class="form-group col-4">
                  <label>NPM</label>
                  <input name = "npm" type="text" class="form-control" value="<?php echo $row['npm']; ?>" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required>
              </div>

              <div class="form-grou col-4">
                  <label for="nama_mhs">Nama Mahasiswa</label>
                  <input name = "nama_mhs" type="text" class="form-control" value="<?php echo $row['nama_mhs']; ?>" maxlength="50" oninput="this.value = this.value.replace(/[^a-zA-Z., ]/g, '').replace(/(\..*)\./g, '$1');" required>
              </div>
            
              <div class="form-group col-4">
                  <label>Username</label>
                  <input name = "username_mhs" type="text" class="form-control" value="<?php echo $row['username_mhs']; ?>" maxlength="10" required>
              </div>
            </div>

              <div class="form-row">
              <div class="form-grou col-4">
                  <label>Password</label><span class="text-red">*</span></label>
                  <input type="password" class="form-control" name="password_mhs" placeholder="Password" id="myPassword<?= $row['id_mahasiswa']?>" value="<?php echo $row['password_mhs']; ?>" maxlength="13" required>
                  <input type="checkbox" onclick="myFunction('<?= $row['id_mahasiswa']?>')"> Lihat Password
                </div>
                
                <div class="form-group col-4">
                  <label for="exampleSelectRounded0">Nama Jurusan</label>
                  <select type="text" class="form-control" aria-describedby="emailHelp" name="id_jurusan" onchange="myFunction2('<?=$row['id_mahasiswa']?>')" id="id_jurusan<?=$row['id_mahasiswa']?>" required>
                    <option value="" disabled> Pilih Jurusan</option>
                    <?php $jsns = mysqli_query($koneksi, "SELECT * FROM tb_jurusan ");
                        foreach ($jsns as $pro) : 
                      ?>
                        <option value="<?php echo $pro['id_jurusan'] ?>" <?= $pro['id_jurusan']== $row['id_jurusan'] ? 'selected': '' ?>><?php echo $pro['nama_jurusan'] ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
              <div class="form-group col-4">
                <label for="exampleSelectRounded0">Nama Program Studi</label>
                <select type="text" class="form-control" aria-describedby="emailHelp" name="id_prodi" onchange="myFunction1('<?=$row['id_mahasiswa']?>')" id="id_prodi<?=$row['id_mahasiswa']?>" required>
                  <option> Pilih Program Studi</option>
                    <?php $prodi = mysqli_query($koneksi, "SELECT * FROM tb_prodi where id_prodi = '$row[id_prodi]'");
                      foreach ($prodi as $pro) : 
                    ?>
                      <option value="<?php echo $pro['id_prodi'] ?>" <?= $pro['id_prodi']== $row['id_prodi'] ? 'selected': '' ?>><?php echo $pro['nama_prodi'] ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
              
              <div class="form-group col-4">
                <label for="id_kelas">Nama Kelas</label>
                <select type="text" class="form-control" aria-describedby="emailHelp" name="id_kelas"  id="id_kelas<?=$row['id_mahasiswa']?>" required>
                  <option value="" disabled> Pilih Kelas</option>
                  <?php $klss = mysqli_query($koneksi, "SELECT * FROM tb_kelas where id_prodi = '$row[id_prodi]'");
                      foreach ($klss as $pro) : 
                    ?>
                      <option value="<?php echo $pro['id_kelas'] ?>" <?= $pro['id_kelas']== $row['id_kelas'] ? 'selected': '' ?>><?php echo $pro['nama_kelas'] ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-4">
                  <label>Tanggal lahir</label>
                  <input name = "ttl" type="date" max="<?= date('Y-m-d')?>" class="form-control" value="<?php echo $row['ttl']; ?>" required>
              </div>
              <div class="form-group col-4" >
                  <label for="thn_angkatan">Tahun Akademik</label>
                  <input name = "thn_angkatan" type="text" class="form-control" value="<?php echo $row['thn_angkatan']; ?>" maxlength="10" required>
              </div>

              <div class="form-group col-4">
              <label for ="jk">Jenis Kelamin</label>
              <select class = "custom-select rounded-0" id ="jk" name ="jk" required>
              <option><?php echo $row['jk']; ?></option>
                <option value = "Laki - Laki">Laki - Laki</option>
                <option value = "Perempuan">Perempuan</option>
              </select>
              </div>

              <div class="form-group col-4">
                  <label>No.Telp</label>
                  <input name = "no_telp_mhs" type="number" class="form-control" value="<?php echo $row['no_telp_mhs']; ?>" maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required>
              </div>
              
            <div class="form-group col-4">
                  <label for="alamat">Alamat</label>
                  <input name = "alamat" type="text" class="form-control" value="<?php echo $row['alamat']; ?>" maxlength="50" required>
              </div>
            
              </div>

            <div class ="row">
            <div class="col-lg-6">
           <div class="form-group">
              <label>Foto Mahasiswa</label><br>
              <img src="img/foto_mahasiswa/<?php echo $row['foto_mhs'];?>"alt="Foto" width="100" ><br><br>
              <div class="input-group">
                <div class="custom-file">
                  <input type="hidden" name = "foto_mhs" class="form-control" value="<?php echo $row['foto_mhs']; ?>" >
                  <input type="file" name = "foto_mhs" id="foto_mhs" class="form-control" accept="image/png,image/gif,image/jpeg" />
                </div>
              </div>
                <i style="float: left;font-size: 14px;color: red">Abaikan jika tidak merubah foto</i> <br>
           </div>
            </div>

            <div class="col-lg-6">
            <div class="form-group">
              <label>Tanda Tangan</label><br>
              <img src="img/ttd_mahasiswa/<?php echo $row['ttd_mhs'];?>"alt="Foto" width="100" ><br><br>
                <div class="input-group">
                  <div class="custom-file">
                  <input type="hidden" name = "ttd_mhs" class="form-control" value="<?php echo $row['ttd_mhs']; ?>" >
                  <input type="file" name = "ttd_mhs" id="ttd_mhs" class="form-control" accept="image/png,image/gif,image/jpeg" />
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
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <?php endforeach ?>

      <!-- Modal Lihat Detail -->
      <?php $no = 0;
      foreach ($user as $row) : $no++; ?>
<div class="modal fade" id="modaldetail<?php echo $row['npm']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Biodata Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
            <?php
              $npm=$row['npm'];
              $result= mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa where npm='$npm'");                
              while ($bio= mysqli_fetch_array($result)) {
                ?>

              <div class="row container">
                            <div class="col d-flex align-items-center">
                                <img src="img/ttd_mahasiswa/<?php echo $row['ttd_mhs'];?>" alt="Foto" width="200" class="rounded-circle">
                            </div>
                            <div class="col-8">
                                <ul class="list-group">
                                    <li class="list-group-item"><span class="float-left">NPM</span><span class="float-right"><b><?= $row["npm"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Nama</span><span class="float-right"><b><?= $row["nama_mhs"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Username</span><span class="float-right"><b><?= $row["username_mhs"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Password</span><span class="float-right"><b><?= $row["password_mhs"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Jenis Kelamin</span><span class="float-right"><b><?= $row["jk"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Jurusan</span><span class="float-right"><b><?= $row["nama_jurusan"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Kelas</span><span class="float-right"><b><?= $row["nama_kelas"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Tahun Akademik</span><span class="float-right"><b><?= $row["thn_angkatan"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">Alamat</span><span class="float-right"><b><?= $row["alamat"]; ?></b></span></li>
                                    <li class="list-group-item"><span class="float-left">No.Telephone</span><span class="float-right"><b><?= $row["no_telp_mhs"]; ?></b></span></li>
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
  $(document).ready(function(){
    $("#id_prodi").on("change", function(){
      var id_prodi = $("#id_prodi").val();
      
      var data = "id_prodi="+id_prodi;
				$.ajax({
					type: 'POST',
					url: "get_auto/get_kelas.php",
					data: data,
					success: function(hasil) {
            console.log(hasil);
            $("#id_kelas").html(hasil);
					}
				});
    });
    $("#id_jurusan").on("change", function(){
      var id_jurusan = $("#id_jurusan").val();
      $('#id_prodi').find('option').remove().end().append('<option value="">Silahkan Pilih</option>').val('');
      $('#id_kelas').find('option').remove().end().append('<option value="">Silahkan Pilih</option>').val('');
      
      var data = "id_jurusan="+id_jurusan;
				$.ajax({
					type: 'POST',
					url: "get_auto/get_prodi.php",
					data: data,
					success: function(hasil) {
            console.log(hasil);
            $("#id_prodi").html(hasil);
					}
				});
    });
    });
</script>
<script>
function myFunction1(p) {
	
      var id_prodi = $("#id_prodi"+p).val();
      
      
      
      var data = "id_prodi="+id_prodi;
				$.ajax({
					type: 'POST',
					url: "get_auto/get_kelas.php",
					data: data,
					success: function(hasil) {
            console.log(hasil);
            $("#id_kelas"+p).html(hasil);
					}
				});
   
}
function myFunction2(p) {

      var id_jurusan = $("#id_jurusan"+p).val();
      $('#id_prodi'+p).find('option').remove().end().append('<option value="">Silahkan Pilih</option>').val('');
      $('#id_kelas'+p).find('option').remove().end().append('<option value="">Silahkan Pilih</option>').val('');
      var data = "id_jurusan="+id_jurusan;
				$.ajax({
					type: 'POST',
					url: "get_auto/get_prodi.php",
					data: data,
					success: function(hasil) {
            console.log(hasil);
            $("#id_prodi"+p).html(hasil);
					}
				});
 
}
</script>
</body>
</html>