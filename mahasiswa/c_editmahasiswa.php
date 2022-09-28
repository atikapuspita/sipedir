<?php

  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_POST['edit_data'])){

    // membuat variabel untuk menampung data dari form
    $npm = $_POST['npm'];
    
    $username_mhs = $_POST['username_mhs'];
    $nama_mhs = $_POST['nama_mhs'];
    
    
    $alamat = $_POST['alamat'];
    $no_telp_mhs = $_POST['no_telp_mhs'];
    
    
    function upload_foto_mhs()
    {
      $fotoLama = $_POST['foto_mhs'];
      $namaFile   = $_FILES['foto_mhs']['name'];
      $ukuranFile = $_FILES['foto_mhs']['size'];
      $error      = $_FILES['foto_mhs']['error'];
      $tmpName    = $_FILES['foto_mhs']['tmp_name'];

      // cek apakah tidak ada gambar yang di upload
      if($error === 4) {
        return $fotoLama;
      }
      else {

      //cek apa yang boleh di upload
      $ekstensiValid = ['jpg','jpeg','png'];
      $ekstensi      = explode('.', $namaFile);
      $ekstensi      = strtolower(end($ekstensi));
      if(!in_array($ekstensi, $ekstensiValid)) {
        echo "<script> 
        alert ('Tolong upload file dengan format (JPG/JPEG/PNG)');
        </script>";
        return $fotoLama;
      }

      //cek ukuran file
      if($ukuranFile > 5000000) {
        echo "<script> 
        alert ('Ukuran File Terlalu Besar (Max 5 mb)');
        </script>";
        return $fotoLama;
      }

      //berhasil dengan pemberian nama baru
      $nama = uniqid();
      $namaFileBaru = ("foto_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, '../admin/img/foto_mahasiswa/' . $namaFileBaru);
      return $namaFileBaru;
      }
    }


	function upload_ttd_mhs()
    {
      $ttdLama = $_POST['ttd_mhs'];
      $namaFile   = $_FILES['ttd_mhs']['name'];
      $ukuranFile = $_FILES['ttd_mhs']['size'];
      $error      = $_FILES['ttd_mhs']['error'];
      $tmpName    = $_FILES['ttd_mhs']['tmp_name'];

      // cek apakah tidak ada gambar yang di upload
      if($error === 4) {
        return  $ttdLama;
      }
      else {
      //cek apa yang boleh di upload
      $ekstensiValid = ['jpg','jpeg','png'];
      $ekstensi      = explode('.', $namaFile);
      $ekstensi      = strtolower(end($ekstensi));
      if(!in_array($ekstensi, $ekstensiValid)) {
        echo "<script> 
        alert ('Tolong upload file dengan format (JPG/JPEG/PNG)');
        </script>";
        return  $ttdLama;
      }

      //cek ukuran file
      if($ukuranFile > 5000000) {
        echo "<script> 
        alert ('Ukuran File Terlalu Besar (Max 5 mb)');
        </script>";
        return  $ttdLama;
      }

      //berhasil dengan pemberian nama baru
      $nama = uniqid();
      $namaFileBaru = ("ttd_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, '../admin/img/ttd_mahasiswa/' . $namaFileBaru);
      return $namaFileBaru;
    }
    }

    
      $foto_mhs =upload_foto_mhs();
    
    
      $ttd_mhs =upload_ttd_mhs();
    


 //fungsi if untuk mengecek apakah foto di upload atau tidak 
 
 $query = "UPDATE tb_mahasiswa SET username_mhs='$username_mhs',
 nama_mhs='$nama_mhs',alamat='$alamat',no_telp_mhs='$no_telp_mhs',
 foto_mhs='$foto_mhs',ttd_mhs='$ttd_mhs' WHERE npm='$npm'";

$result = mysqli_query($koneksi, $query);
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
          " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Ubah Data Berhasil.');window.location='profile.php';</script>";
    }
  }

?>