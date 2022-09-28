<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_POST['edit'])){

    // membuat variabel untuk menampung data dari form
    $id_unit = $_POST['id_unit'];
    $id_pegawai = $_POST['id_pegawai'];
    $nama_unit = $_POST['nama_unit'];
    $status = $_POST['status'];

  //(id tidak perlu karena dibikin otomatis)
  $query = "UPDATE tb_unit_kerja SET id_pegawai='$id_pegawai', nama_unit='$nama_unit', status='$status' WHERE id_unit='$id_unit'";

  if (mysqli_query($koneksi,$query) == true) {
    echo "
          <script>
              alert('Data Berhasil Diupdate!');
              document.location.href = 'data_unitkerja.php';
          </script>
        ";
  } else {
    echo "
            <script>
                alert('Data Gagal Diupdate!');
                document.location.href = 'data_unitkerja.php';
            </script>
        ";
  }
  }
?>