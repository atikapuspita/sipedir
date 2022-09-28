<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_POST['edit_data'])){

    // membuat variabel untuk menampung data dari form
    $id_pengajuan= $_POST['id_pengajuan'];
    $npm = $_POST['npm'];
    $alasan = $_POST['alasan'];
    $tgl_pengajuan = $_POST['tgl_pengajuan'];
    $nama_ortu = $_POST['nama_ortu'];
    $semester = $_POST['semester'];
    $status_pengajuan = $_POST['status_pengajuan'];
    
    
        //Membuat Variabel untuk menyimpan Foto atau Gambar
        $nama_file = $_FILES['ttd_ortu']['name'];
        $source = $_FILES['ttd_ortu']['tmp_name'];
        $folder = "img/ttd_orangtua";

    //fungsi if untuk mengecek apakah foto di upload atau tidak 
    
    if($nama_file != '')
    {
      move_uploaded_file($source, $folder.$nama_file);

      $update = mysqli_query($koneksi, "UPDATE tb_pengajuan SET id_pengajuan='$id_pengajuan',npm='$npm',alasan='$alasan',
                tgl_pengajuan='$tgl_pengajuan',nama_ortu='$nama_ortu',status_pengajuan='$status_pengajuan',
                ttd_ortu='$nama_file',semester='$semester' WHERE id_pengajuan='$id_pengajuan'");

      if($update) {
        echo "<script> 
              alert ('Data Berhasil di Update'); window.location = 'data_pengajuan.php' </script> ";
      }
      else 
      {
        echo "<script> 
              alert ('Data Gagal di Update'); window.location = 'data_pengajuan.php' </script> ";
      }
    }
    else
    {
      $update = mysqli_query($koneksi, "UPDATE tb_pengajuan SET id_pengajuan='$id_pengajuan',npm='$npm',alasan='$alasan',
                tgl_pengajuan='$tgl_pengajuan',nama_ortu='$nama_ortu',status_pengajuan='$status_pengajuan',semester='$semester' WHERE id_pengajuan='$id_pengajuan'");

      if($update) {
        echo "<script> 
              alert ('Data Berhasil di Update'); window.location = 'data_pengajuan.php' </script> ";
      }
      else 
      {
        echo "<script> 
              alert ('Data Gagal di Update'); window.location = 'data_pengajuan.php' </script> ";
      }
    }

  }
?>