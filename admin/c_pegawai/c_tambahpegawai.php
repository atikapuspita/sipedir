<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "../koneksi/config.php";

if(isset($_POST['tambah'])){
  // membuat variabel untuk menampung data dari form
  	$nip_npak = $_POST['nip_npak'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$nama_pegawai = $_POST['nama_pegawai'];
	$jabatan = $_POST['jabatan'];
	$no_telp_pegawai = $_POST['no_telp_pegawai'];

	function upload_foto_pegawai()
    {
      $namaFile   = $_FILES['foto_pegawai']['name'];
      $ukuranFile = $_FILES['foto_pegawai']['size'];
      $error      = $_FILES['foto_pegawai']['error'];
      $tmpName    = $_FILES['foto_pegawai']['tmp_name'];

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
      $namaFileBaru = ("foto_pegawai_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, 'img/foto_pegawai/' . $namaFileBaru);
      return $namaFileBaru;
    }

	function upload_ttd_pegawai()
    {
      $namaFile   = $_FILES['ttd_pegawai']['name'];
      $ukuranFile = $_FILES['ttd_pegawai']['size'];
      $error      = $_FILES['ttd_pegawai']['error'];
      $tmpName    = $_FILES['ttd_pegawai']['tmp_name'];

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
      $namaFileBaru = ("ttd_pegawai_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, 'img/ttd_pegawai/' . $namaFileBaru);
      return $namaFileBaru;
    }

	$foto_pegawai = upload_foto_pegawai();
    if (!$foto_pegawai) {
        return false;
    }

	$ttd_pegawai = upload_ttd_pegawai();
    if (!$ttd_pegawai) {
        return false;
    }

// jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
$query = "INSERT INTO tb_pegawai (`nip_npak`, `username`, `password`, `nama_pegawai`, `jabatan`,`no_telp_pegawai`, `foto_pegawai`, `ttd_pegawai`) VALUES 
          ('$nip_npak', '$username', '$password', '$nama_pegawai', '$jabatan','$no_telp_pegawai', '$foto_pegawai', '$ttd_pegawai')";

$result = mysqli_query($koneksi, $query);
    if(!$result){
      echo "<script>alert('Tambah Data Gagal disimpan.');window.location='data_pegawai.php';</script>";
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Tambah Data Berhasil.');window.location='data_pegawai.php';</script>";
    }

  }
  ?>