<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "../koneksi/config.php";

if(isset($_POST['tambah'])){
  // membuat variabel untuk menampung data dari form
  	$id_pengajuan = $_POST['id_pengajuan'];
    $npm = $_POST['npm'];
    $alasan = $_POST['alasan'];
    $tgl_pengajuan = $_POST['tgl_pengajuan'];
    $nama_ortu = $_POST['nama_ortu'];
    $semester = $_POST['semester'];
    $status_pengajuan = $_POST['0'];

  //Membuat Variabel untuk menyimpan Foto atau Gambar
  
  function upload_ttd_ortu()
  {
    $namaFile   = $_FILES['ttd_ortu']['name'];
    $ukuranFile = $_FILES['ttd_ortu']['size'];
    $error      = $_FILES['ttd_ortu']['error'];
    $tmpName    = $_FILES['ttd_ortu']['tmp_name'];

    // cek apakah tidak ada gambar yang di upload
    if($error === 4) {
      echo "<script> 
      alert ('Pilih File Terlebih Dahulu');
      </script>";
      return false;
    }

    //cek apa yang boleh di upload
    $ekstensiValid = ['pdf'];
    $ekstensi      = explode('.', $namaFile);
    $ekstensi      = strtolower(end($ekstensi));
    if(!in_array($ekstensi, $ekstensiValid)) {
      echo "<script> 
      alert ('Tolong upload file dengan format (pdf)');
      </script>";
      return false;
    }

    //cek ukuran file
    if($ukuranFile > 50000000) {
      echo "<script> 
      alert ('Ukuran File Terlalu Besar (Max 5 mb)');
      </script>";
      return false;
    }

    //berhasil dengan pemberian nama baru
    $nama = uniqid();
    $namaFileBaru = ("ttd_ortu_baru" . $nama);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;

    move_uploaded_file($tmpName, 'img/ttd_orangtua/' . $namaFileBaru);
    return $namaFileBaru;
  }


$ttd_ortu = upload_ttd_ortu();
  if (!$ttd_ortu) {
      return false;
  }

// jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
$query = "INSERT INTO tb_pengajuan (`id_pengajuan`, `npm`, `alasan`, `tgl_pengajuan`, `nama_ortu`,`status_pengajuan`,`ttd_ortu`,`semester`) 
         VALUES ('$id_pengajuan', '$npm', '$alasan', '$tgl_pengajuan', '$nama_ortu','0', '$ttd_ortu', '$semester')";

$result = mysqli_query($koneksi, $query);
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
          " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Tambah Data Berhasil.');window.location='data_pengajuan.php';</script>";
    }

  }
  ?>