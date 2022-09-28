<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_POST['edit'])){

    // membuat variabel untuk menampung data dari form
    $id_kajur = $_POST['id_kajur'];
    $id_jurusan= $_POST['id_jurusan'];
    $id_pegawai = $_POST['id_pegawai'];
    $status = $_POST['status'];

  //(id tidak perlu karena dibikin otomatis)
  $query = "UPDATE tb_kajur SET id_pegawai='$id_pegawai', id_jurusan='$id_jurusan', status='$status' WHERE id_kajur='$id_kajur'";

  if (mysqli_query($koneksi,$query) == true) {
    echo "
          <script>
              alert('Data Berhasil Diupdate!');
              document.location.href = 'data_kajur.php';
          </script>
        ";
  } else {
    echo "
            <script>
                alert('Data Gagal Diupdate!');
                document.location.href = 'data_kajur.php';
            </script>
        ";
  }
  }
?>