<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_GET['edit'])){

    // membuat variabel untuk menampung data dari form
    $id_kelas = $_GET['id_kelas'];
    $nama_kelas = $_GET['nama_kelas'];
    $id_prodi = $_GET['id_prodi'];

  //(id tidak perlu karena dibikin otomatis)
  $query = "UPDATE tb_kelas SET id_prodi='$id_prodi',nama_kelas='$nama_kelas' WHERE id_kelas='$id_kelas'";

  if (mysqli_query($koneksi,$query) == true) {
    echo "
          <script>
              alert('Data Berhasil Diupdate!');
              document.location.href = 'data_kelas.php';
          </script>
        ";
  } else {
    echo "
            <script>
                alert('Data Gagal Diupdate!');
                document.location.href = 'data_kelas.php';
            </script>
        ";
  }
  }
?>