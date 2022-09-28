<?php

  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_POST['edit_data'])){
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $npm = $_POST['npm'];
    $id_kelas = $_POST['id_kelas'];
    
    $username_mhs = $_POST['username_mhs'];
    $password_mhs = $_POST['password_mhs'];
    $nama_mhs = $_POST['nama_mhs'];
    $jk = $_POST['jk'];
    $thn_angkatan = $_POST['thn_angkatan'];
    $alamat = $_POST['alamat'];
    $no_telp_mhs = $_POST['no_telp_mhs'];
    $ttl = $_POST['ttl'];
    
    
    function upload_foto_mhs()
    {
      $fotoLama = $_POST['foto_mhs'];
      $namaFile   = $_FILES['foto_mhs']['name'];
      $ukuranFile = $_FILES['foto_mhs']['size'];
      $error      = $_FILES['foto_mhs']['error'];
      $tmpName    = $_FILES['foto_mhs']['tmp_name'];

      // cek apakah tidak ada gambar yang di upload
      if($error === 4) {
        return  $fotoLama;
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
        return  $fotoLama;
      }

      //cek ukuran file
      if($ukuranFile > 5000000) {
        echo "<script> 
        alert ('Ukuran File Terlalu Besar (Max 5 mb)');
        </script>";
        return  $fotoLama;
      }

      //berhasil dengan pemberian nama baru
      $nama = uniqid();
      $namaFileBaru = ("foto_mhs_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, 'img/foto_mahasiswa/' . $namaFileBaru);
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
        return $ttdLama;
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
        return $ttdLama;
      }

      //cek ukuran file
      if($ukuranFile > 5000000) {
        echo "<script> 
        alert ('Ukuran File Terlalu Besar (Max 5 mb)');
        </script>";
        return $ttdLama;
      }

      //berhasil dengan pemberian nama baru
      $nama = uniqid();
      $namaFileBaru = ("ttd_mhs_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, 'img/ttd_mahasiswa/' . $namaFileBaru);
      return $namaFileBaru;
    }
    }

    
      $foto_mhs =upload_foto_mhs();
   
      $ttd_mhs =upload_ttd_mhs();
    


 //fungsi if untuk mengecek apakah foto di upload atau tidak 
 
 $query = "UPDATE tb_mahasiswa SET npm='$npm',username_mhs='$username_mhs',password_mhs='$password_mhs',
 nama_mhs='$nama_mhs',jk='$jk',thn_angkatan='$thn_angkatan',alamat='$alamat',no_telp_mhs='$no_telp_mhs',
 foto_mhs='$foto_mhs',ttd_mhs='$ttd_mhs', ttl='$ttl', id_kelas='$id_kelas' WHERE id_mahasiswa='$id_mahasiswa'";

$result = mysqli_query($koneksi, $query);
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
          " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Ubah Data Berhasil.');window.location='data_mahasiswa.php';</script>";
    }
  }

?>