<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "../koneksi/config.php";

if(isset($_POST['tambah'])){
  // membuat variabel untuk menampung data dari form
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
      $namaFile   = $_FILES['foto_mhs']['name'];
      $ukuranFile = $_FILES['foto_mhs']['size'];
      $error      = $_FILES['foto_mhs']['error'];
      $tmpName    = $_FILES['foto_mhs']['tmp_name'];

      // cek apakah tidak ada gambar yang di upload
      if($error === 4) {
        echo "<script> 
        alert ('Pilih Foto Terlebih Dahulu');
        </script>";
        return false;
      }

      //cek apa yang boleh di upload
      $ekstensiValid = ['jpg','jpeg','png'];
      $ekstensi      = explode('.', $namaFile);
      $ekstensi      = strtolower(end($ekstensi));
      if(!in_array($ekstensi, $ekstensiValid)) {
        echo "<script> 
        alert ('Tolong upload Foto dengan format (JPG/JPEG/PNG)');
        </script>";
        return false;
      }

      //cek ukuran file
      if($ukuranFile > 5000000) {
        echo "<script> 
        alert ('Ukuran Foto Terlalu Besar (Max 5 mb)');
        </script>";
        return false;
      }

      //berhasil dengan pemberian nama baru
      $nama = uniqid();
      $namaFileBaru = ("foto_mhs_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, 'img/foto_mahasiswa/' . $namaFileBaru);
      return $namaFileBaru;
    }

	function upload_ttd_mhs()
    {
      $namaFile   = $_FILES['ttd_mhs']['name'];
      $ukuranFile = $_FILES['ttd_mhs']['size'];
      $error      = $_FILES['ttd_mhs']['error'];
      $tmpName    = $_FILES['ttd_mhs']['tmp_name'];

      // cek apakah tidak ada gambar yang di upload
      if($error === 4) {
        echo "<script> 
        alert ('Pilih Tanda Tangan Terlebih Dahulu');
        </script>";
        return false;
      }

      //cek apa yang boleh di upload
      $ekstensiValid = ['jpg','jpeg','png'];
      $ekstensi      = explode('.', $namaFile);
      $ekstensi      = strtolower(end($ekstensi));
      if(!in_array($ekstensi, $ekstensiValid)) {
        echo "<script> 
        alert ('Tolong upload Tanda Tangan dengan format (JPG/JPEG/PNG)');
        </script>";
        return false;
      }

      //cek ukuran file
      if($ukuranFile > 5000000) {
        echo "<script> 
        alert ('Ukuran Tanda Tangan Terlalu Besar (Max 5 mb)');
        </script>";
        return false;
      }

      //berhasil dengan pemberian nama baru
      $nama = uniqid();
      $namaFileBaru = ("ttd_mhs_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, 'img/ttd_mahasiswa/' . $namaFileBaru);
      return $namaFileBaru;
    }

	$foto_mhs = upload_foto_mhs();
    if (!$foto_mhs) {
        return false;
    }

	$ttd_mhs = upload_ttd_mhs();
    if (!$ttd_mhs) {
        return false;
    }

// jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
$query = "INSERT INTO tb_mahasiswa (`npm`, `id_kelas`, `username_mhs`, `password_mhs`, `nama_mhs`, `jk`, `thn_angkatan`, 
         `alamat`, `no_telp_mhs`, `foto_mhs`,`ttd_mhs`,`ttl`) 
         VALUES ('$npm', '$id_kelas', '$username_mhs', '$password_mhs', '$nama_mhs', '$jk', '$thn_angkatan',
         '$alamat', '$no_telp_mhs','$foto_mhs', '$ttd_mhs','$ttl')";

$result = mysqli_query($koneksi, $query);
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
          " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Tambah Data Berhasil.');window.location='data_mahasiswa.php';</script>";
    }

  }
  ?>