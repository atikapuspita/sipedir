<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_POST['edit_data'])){

    // membuat variabel untuk menampung data dari form
    $id_pegawai=$_POST['id_pegawai'];
    $nip_npak= $_POST['nip_npak'];
    $username = $_POST['username'];
    // $password = $_POST['password'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $jabatan = $_POST['jabatan'];
    $no_telp_pegawai = $_POST['no_telp_pegawai'];
    
    
    function upload_foto_pegawai()
    {
      $fotoLama = $_POST['foto_pegawai'];
      $namaFile   = $_FILES['foto_pegawai']['name'];
      $ukuranFile = $_FILES['foto_pegawai']['size'];
      $error      = $_FILES['foto_pegawai']['error'];
      $tmpName    = $_FILES['foto_pegawai']['tmp_name'];

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
      $namaFileBaru = ("foto_pegawai_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, 'img/foto_pegawai/' . $namaFileBaru);
      return $namaFileBaru;
      }
    }


	function upload_ttd_pegawai()
    {
      $ttdLama = $_POST['ttd_pegawai'];
      $namaFile   = $_FILES['ttd_pegawai']['name'];
      $ukuranFile = $_FILES['ttd_pegawai']['size'];
      $error      = $_FILES['ttd_pegawai']['error'];
      $tmpName    = $_FILES['ttd_pegawai']['tmp_name'];

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
      $namaFileBaru = ("ttd_pegawai_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, 'img/ttd_pegawai/' . $namaFileBaru);
      return $namaFileBaru;
    }
    }

   
      $foto_pegawai =upload_foto_pegawai();
    
      $ttd_pegawai =upload_ttd_pegawai();
    


 //fungsi if untuk mengecek apakah foto di upload atau tidak 
 
 $query = "UPDATE tb_pegawai SET nip_npak='$nip_npak',username='$username',
            nama_pegawai='$nama_pegawai',no_telp_pegawai='$no_telp_pegawai',
            foto_pegawai='$foto_pegawai',ttd_pegawai='$ttd_pegawai' WHERE id_pegawai='$id_pegawai'";

$result = mysqli_query($koneksi, $query);
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
          " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data Berhasil Diupdate.');window.location='profile_admin.php';</script>";
    }
  }

?>