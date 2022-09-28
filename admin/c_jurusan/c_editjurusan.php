<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_GET['edit'])){

    // membuat variabel untuk menampung data dari form
    $nama_jurusan = $_GET['nama_jurusan'];
    $id_jurusan = $_GET['id_jurusan'];

  //(id tidak perlu karena dibikin otomatis)
  $query = "UPDATE tb_jurusan SET nama_jurusan='$nama_jurusan' WHERE id_jurusan='$id_jurusan'";

  if (mysqli_query($koneksi,$query) == true) {
    echo "
          <script>
              alert('Data Berhasil Diupdate!');
              document.location.href = 'data_jurusan.php';
          </script>
        ";
  } else {
    echo "
            <script>
                alert('Data Gagal Diupdate!');
                document.location.href = 'data_jurusan.php';
            </script>
        ";
  }
  }
?>