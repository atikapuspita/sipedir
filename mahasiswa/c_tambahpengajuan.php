<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "../koneksi/config.php";

if(isset($_POST['tambah'])){
  // membuat variabel untuk menampung data dari form
  
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $alasan = $_POST['alasan'];
    $tgl_pengajuan = $_POST['tgl_pengajuan'];
    $nama_ortu = $_POST['nama_ortu'];
    $semester = $_POST['semester'];
    $status_pengajuan = $_POST['status_pengajuan'];
    $usermhs = $_SESSION["id_mahasiswa"];
    

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
      $ekstensiValid = ['jpg','jpeg','png'];
      $ekstensi      = explode('.', $namaFile);
      $ekstensi      = strtolower(end($ekstensi));
      if(!in_array($ekstensi, $ekstensiValid)) {
        echo "<script> 
        alert ('Tolong upload file dengan format (JPG/JPEG/PNG)');
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

      move_uploaded_file($tmpName, '../admin/img/ttd_orangtua/' . $namaFileBaru);
      return $namaFileBaru;
    }
    function upload_berkas_pedukung()
    {
      $namaFile   = $_FILES['berkas']['name'];
      $ukuranFile = $_FILES['berkas']['size'];
      $error      = $_FILES['berkas']['error'];
      $tmpName    = $_FILES['berkas']['tmp_name'];

      // cek apakah tidak ada gambar yang di upload
      // if($error === 4) {
      //   echo "<script> 
      //   alert ('Pilih File Terlebih Dahulu');
      //   </script>";
      //   return false;
      // }

      //cek apa yang boleh di upload
      $namaFileBaru="";
      if($namaFile!=null){

        $ekstensiValid = ['pdf'];
        $ekstensi      = explode('.', $namaFile);
        $ekstensi      = strtolower(end($ekstensi));
        if(!in_array($ekstensi, $ekstensiValid)) {
          echo "<script> 
          alert ('Tolong upload file dengan format (PDF)');
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
  
        move_uploaded_file($tmpName, '../pdf/berkas/' . $namaFileBaru);
      }
      return $namaFileBaru;
    }
    function upload_srt_ortu(){
      $namaFile   = $_FILES['srt_ortu']['name'];
      $ukuranFile = $_FILES['srt_ortu']['size'];
      $error      = $_FILES['srt_ortu']['error'];
      $tmpName    = $_FILES['srt_ortu']['tmp_name'];

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
        alert ('Tolong upload file surat persetujuan orang tua dengan format PDF');
        </script>";
        return false;
      }

      //cek ukuran file
      if($ukuranFile > 50000000) {
        echo "<script> 
        alert ('Ukuran File surat persetujuan orang tua Terlalu Besar (Max 5 mb)');
        </script>";
        return false;
      }

      //berhasil dengan pemberian nama baru
      $nama = uniqid();
      $namaFileBaru = ("srt_ortu" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, '../pdf/orangtua/' . $namaFileBaru);
      return $namaFileBaru;
    }
	$ttd_ortu = upload_ttd_ortu();
  $berkas_pendukung = upload_berkas_pedukung();
  $srt_ortu = upload_srt_ortu();
    if (!$ttd_ortu) {
        return false;
    }
    if (!$srt_ortu) {
        return false;
    }
    if(!$berkas_pendukung) {
        $berkas_pendukung="";
    }

// jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
$query = "INSERT INTO tb_pengajuan (`id_mahasiswa`, `alasan`, `tgl_pengajuan`, `nama_ortu`,`status_pengajuan`,`ttd_ortu`,`semester`,`berkas_pendukung`,`surat_persetujuan_ortu`) 
         VALUES ('$id_mahasiswa', '$alasan', '$tgl_pengajuan', '$nama_ortu','0', '$ttd_ortu', '$semester', '$berkas_pendukung','$srt_ortu')";

$result = mysqli_query($koneksi, $query);
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
          " - ".mysqli_error($koneksi));
    } else {
            $get_pengajuan = mysqli_query($koneksi,"SELECT * FROM tb_doswal join tb_kelas on tb_kelas.id_kelas=tb_doswal.id_kelas join tb_mahasiswa on tb_mahasiswa.id_kelas=tb_kelas.id_kelas join tb_pegawai on tb_pegawai.id_pegawai=tb_doswal.id_pegawai WHERE tb_mahasiswa.id_mahasiswa = '$id_mahasiswa' AND tb_doswal.status=1");
            $data_pengajuan = mysqli_fetch_assoc($get_pengajuan);
            $nomorhp = $data_pengajuan['no_telp_pegawai'];

            $user = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$usermhs'");
            $user_login = mysqli_fetch_array($user);
            $nomerhpmhs = $user_login['no_telp_mhs'];
            // echo    $nomorhp;
            if($nomorhp!=null){
                $phone= preg_replace('/^0?/','62', $nomorhp); 
                $message = "Terdapat pengajuan pengunduran diri mahasiswa, segera cek SIAKAD";

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://atik.ta-notif.xyz/message/text?key=123',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'id='.$phone.'&message='.$message,
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                // echo $response;
            }

            if($nomerhpmhs!=null){
                $phone= preg_replace('/^0?/','62', $nomerhpmhs); 
                $message = "Pengajuanmu berhasil diajukan, menunggu konfirmasi dari dosen wali";

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://atik.ta-notif.xyz/message/text?key=123',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'id='.$phone.'&message='.$message,
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                // echo $response;
            }
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Tambah Data Berhasil.');window.location='data_pengajuan.php';</script>";
    }

  }
  ?>