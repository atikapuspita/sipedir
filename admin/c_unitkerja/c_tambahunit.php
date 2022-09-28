<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "../koneksi/config.php";

if(isset($_POST['tambah'])){
  // membuat variabel untuk menampung data dari form
    $nama_unit= $_POST['nama_unit'];
    $id_pegawai = $_POST['id_pegawai'];
    $status = $_POST['status'];

// jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
$query = "INSERT INTO tb_unit_kerja (`nama_unit`,`id_pegawai`,`status`) 
VALUES ('$nama_unit','$id_pegawai', '$status')";

$result = mysqli_query($koneksi, $query);
    if(!$result){
      echo "<script>alert('Tambah Data Gagal disimpan.');window.location='data_unitkerja.php';</script>";
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Tambah Data Berhasil.');window.location='data_unitkerja.php';</script>";
    }

  }
  ?>