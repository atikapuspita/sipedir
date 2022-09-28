<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_POST['edit'])){

    // membuat variabel untuk menampung data dari form
    $id_kelas= $_POST['id_kelas'];
    $id_pegawai = $_POST['id_pegawai'];
    $id_doswal = $_POST['id_doswal'];
    $status = $_POST['status'];

  //(id tidak perlu karena dibikin otomatis)
  $query = "UPDATE tb_doswal SET id_kelas='$id_kelas', id_pegawai='$id_pegawai', status='$status' WHERE id_doswal='$id_doswal'";

  if (mysqli_query($koneksi,$query) == true) {
    echo "
          <script>
              alert('Data Berhasil Diupdate!');
              document.location.href = 'data_doswal.php';
          </script>
        ";
  } else {
    echo "
            <script>
                alert('Data Gagal Diupdate!');
                document.location.href = 'data_doswal.php';
            </script>
        ";
  }
  }
?>