<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_GET['edit'])){

    // membuat variabel untuk menampung data dari form
    $id_prodi = $_GET['id_prodi'];
    $id_jurusan = $_GET['id_jurusan'];
    $nama_prodi = $_GET['nama_prodi'];

  //(id tidak perlu karena dibikin otomatis)
  $query = "UPDATE tb_prodi SET id_jurusan='$id_jurusan', id_prodi='$id_prodi',nama_prodi='$nama_prodi' WHERE id_prodi='$id_prodi'";

  if (mysqli_query($koneksi,$query) == true) {
    echo "
          <script>
              alert('Data Berhasil Diupdate!');
              document.location.href = 'data_prodi.php';
          </script>
        ";
  } else {
    echo "
            <script>
                alert('Data Gagal Diupdate!');
                document.location.href = 'data_prodi.php';
            </script>
        ";
  }
  }
?>