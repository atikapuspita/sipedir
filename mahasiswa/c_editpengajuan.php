<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_POST['edit_data'])){

    // membuat variabel untuk menampung data dari form
    $id_pengajuan= $_POST['id_pengajuan'];
    $alasan = $_POST['alasan'];
    $tgl_pengajuan = $_POST['tgl_pengajuan'];
    $nama_ortu = $_POST['nama_ortu'];
    $semester = $_POST['semester'];
    
    
    function upload_ttd_ortu()
    {
      $ttdLama = $_POST['ttd_ortu'];
      $namaFile   = $_FILES['ttd_ortu']['name'];
      $ukuranFile = $_FILES['ttd_ortu']['size'];
      $error      = $_FILES['ttd_ortu']['error'];
      $tmpName    = $_FILES['ttd_ortu']['tmp_name'];

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
        if($ukuranFile > 50000000) {
          echo "<script> 
          alert ('Ukuran File Terlalu Besar (Max 5 mb)');
          </script>";
          return $ttdLama;
        }

        //berhasil dengan pemberian nama baru
        $nama = uniqid();
        $namaFileBaru = ("ttd_ortu_baru" . $nama);
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensi;

        move_uploaded_file($tmpName, '../admin/img/ttd_orangtua/' . $namaFileBaru);
        return $namaFileBaru;
      }
    }

    function upload_berkas()
    {
      $berkasLama = $_POST['berkas'];
      $namaFile   = $_FILES['berkas']['name'];
      $ukuranFile = $_FILES['berkas']['size'];
      $error      = $_FILES['berkas']['error'];
      $tmpName    = $_FILES['berkas']['tmp_name'];

      // cek apakah tidak ada gambar yang di upload
      if($error === 4) {
        return $berkasLama;
      }
      else {
        //cek apa yang boleh di upload
        $ekstensiValid = ['pdf'];
        $ekstensi      = explode('.', $namaFile);
        $ekstensi      = strtolower(end($ekstensi));
        if(!in_array($ekstensi, $ekstensiValid)) {
          echo "<script> 
          alert ('Tolong upload file dengan format (PDF)');
          </script>";
          return $berkasLama;
        }

        //cek ukuran file
        if($ukuranFile > 50000000) {
          echo "<script> 
          alert ('Ukuran File Terlalu Besar (Max 5 mb)');
          </script>";
          return $berkasLama;
        }

        //berhasil dengan pemberian nama baru
        $nama = uniqid();
        $namaFileBaru = ("berkas_baru" . $nama);
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensi;

        move_uploaded_file($tmpName, '../pdf/berkas/' . $namaFileBaru);
        return $namaFileBaru;
      }
    }
    function upload_ortu()
    {
      $ortuLama = $_POST['ortu'];
      $namaFile   = $_FILES['ortu']['name'];
      $ukuranFile = $_FILES['ortu']['size'];
      $error      = $_FILES['ortu']['error'];
      $tmpName    = $_FILES['ortu']['tmp_name'];

      // cek apakah tidak ada gambar yang di upload
      if($error === 4) {
        return $ortuLama;
      }
      else {
        //cek apa yang boleh di upload
        $ekstensiValid = ['pdf'];
        $ekstensi      = explode('.', $namaFile);
        $ekstensi      = strtolower(end($ekstensi));
        if(!in_array($ekstensi, $ekstensiValid)) {
          echo "<script> 
          alert ('Tolong upload file Surat Persetujuan Orang Tua dengan format (PDF)');
          </script>";
          return $ortuLama;
        }

        //cek ukuran file
        if($ukuranFile > 50000000) {
          echo "<script> 
          alert ('Ukuran File Surat Persetujuan Orang Tua Terlalu Besar (Max 5 mb)');
          </script>";
          return $ortuLama;
        }

        //berhasil dengan pemberian nama baru
        $nama = uniqid();
        $namaFileBaru = ("srt_ortu" . $nama);
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensi;

        move_uploaded_file($tmpName, '../pdf/orangtua/' . $namaFileBaru);
        return $namaFileBaru;
      }
    }
   
      $ttd_ortu =upload_ttd_ortu();
   
    
      $berkas =upload_berkas();

      $ortu =upload_ortu();

    $query = "UPDATE tb_pengajuan SET 
    tgl_pengajuan='$tgl_pengajuan',nama_ortu='$nama_ortu',
    ttd_ortu='$ttd_ortu',semester='$semester', berkas_pendukung='$berkas', alasan='$alasan', surat_persetujuan_ortu='$ortu' WHERE id_pengajuan='$id_pengajuan'";

$result = mysqli_query($koneksi, $query);
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
          " - ".mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Ubah Data Berhasil.');window.location='data_pengajuan.php';</script>";
    }
  }

?>