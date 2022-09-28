<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_POST['edit'])){

    $id_pegawai = $_SESSION["id_pegawai"];
    $nama_pegawai = $_POST['nama_pegawai'];
    $username = $_POST['username'];
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

      move_uploaded_file($tmpName, '../admin/img/foto_pegawai/' . $namaFileBaru);
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
      $namaFileBaru = ("ttd_pegawai_baru" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, '../admin/img/ttd_pegawai/' . $namaFileBaru);
      return $namaFileBaru;
    }
    }

    
      $foto_pegawai =upload_foto_pegawai();
    
   
      $ttd_pegawai =upload_ttd_pegawai();
    

  //(id tidak perlu karena dibikin otomatis)
  $query = "UPDATE tb_pegawai SET nama_pegawai='$nama_pegawai',username='$username',
            no_telp_pegawai='$no_telp_pegawai', foto_pegawai='$foto_pegawai', ttd_pegawai='$ttd_pegawai' WHERE id_pegawai='$id_pegawai'";

  if (mysqli_query($koneksi,$query) == true) {
    echo "
          <script>
              alert('Data Berhasil Diupdate!');
              document.location.href = 'profile.php';
          </script>
        ";
  } else {
    echo "
            <script>
                alert('Data Gagal Diupdate!');
                document.location.href = 'profile.php';
            </script>
        ";
  }
  }
?>