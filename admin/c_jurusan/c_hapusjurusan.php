<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../../koneksi/config.php";

  if(isset($_GET['hapus'])){

    $id_jurusan = $_GET['id_jurusan'];

  //(id tidak perlu karena dibikin otomatis)
  $query = "DELETE FROM tb_jurusan WHERE id_jurusan='$id_jurusan'";

  if (mysqli_query($koneksi,$query) == true) {
    echo "
          <script>
              alert('Data Berhasil Dihapus!');
              document.location.href = '../data_jurusan.php';
          </script>
        ";
  } else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = '../data_jurusan.php';
            </script>
        ";
  }
  }
?>