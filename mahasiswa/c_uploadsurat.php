<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_POST['edit'])){

    // membuat variabel untuk menampung data dari form
    $id_pengajuan= $_POST['id_pengajuan'];
    $npm = $_POST['npm'];
    $alasan = $_POST['alasan'];
    $tgl_pengajuan = $_POST['tgl_pengajuan'];
    $nama_ortu = $_POST['nama_ortu'];
    $semester = $_POST['semester'];
    $status_pengajuan = $_POST['status_pengajuan'];
    
    
    function upload_berkas()
    {
      $namaFile   = $_FILES['berkas']['name'];
      $ukuranFile = $_FILES['berkas']['size'];
      $error      = $_FILES['berkas']['error'];
      $tmpName    = $_FILES['berkas']['tmp_name'];

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
      $namaFileBaru = ("berkas_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, '../admin/img/berkas_surat/' . $namaFileBaru);
      return $namaFileBaru;
    }

	$berkas = upload_berkas();
    if (!$berkas) {
        return false;
    }

    $query = "UPDATE tb_pengajuan SET id_pengajuan='$id_pengajuan',npm='$npm',alasan='$alasan',
    tgl_pengajuan='$tgl_pengajuan',nama_ortu='$nama_ortu',status_pengajuan='$status_pengajuan',
    ttd_ortu='$nama_file',semester='$semester', berkas = '$berkas' WHERE id_pengajuan='$id_pengajuan'";

if (mysqli_query($koneksi,$query) == true) {
echo "
  <script>
      alert('Data Berhasil Diupdate!');
      document.location.href = 'data_pengajuan.php';
  </script>";
} else {
echo "
    <script>
        alert('Data Gagal Diupdate!');
        document.location.href = 'data_pengajuan.php';
    </script>";
}
    }
?>