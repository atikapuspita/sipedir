<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_POST['upload'])){

    // membuat variabel untuk menampung data dari form
    $id_pengajuan= $_POST['id_pengajuan'];
    $no_sk = $_POST['no_sk'];
    $sklama = $_POST['sklama'];
    $nilailama = $_POST['nilailama'];

    
    function upload_sk()
    {
      $namaFile   = $_FILES['sk']['name'];
      $ukuranFile = $_FILES['sk']['size'];
      $error      = $_FILES['sk']['error'];
      $tmpName    = $_FILES['sk']['tmp_name'];

      // cek apakah tidak ada gambar yang di upload
      if($error === 4) {
        return ("tidak ada file");
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
      $namaFileBaru = ("sk" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, '../pdf/sk/' . $namaFileBaru);
      return $namaFileBaru;
      }
    }


	function upload_nilai()
    {
      $namaFile   = $_FILES['nilai']['name'];
      $ukuranFile = $_FILES['nilai']['size'];
      $error      = $_FILES['nilai']['error'];
      $tmpName    = $_FILES['nilai']['tmp_name'];

      // cek apakah tidak ada gambar yang di upload
      if($error === 4) {
        return ("tidak ada file");
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
      $namaFileBaru = ("nilai" . $nama);
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;

      move_uploaded_file($tmpName, '../pdf/nilai/' . $namaFileBaru);
      return $namaFileBaru;
    }
    }

    if($_FILES['sk']['error'] === 4){
      $sk  = $sklama;
    }else{
      $sk =upload_sk();
    }
    if($_FILES['nilai']['error'] === 4){
      $nilai  = $nilailama;
    }else{
      $nilai =upload_nilai();
    }	


 //fungsi if untuk mengecek apakah foto di upload atau tidak 
 
 $query = "UPDATE tb_pengajuan SET file_sk='$sk',nilai='$nilai', no_sk='$no_sk' WHERE id_pengajuan='$id_pengajuan'";

$result = mysqli_query($koneksi, $query);
    if(!$result){
      echo "<script>alert('Data Gagal Diupload');window.location='data_pengajuan.php';</script>";
    } else {
      $get_pengajuan = mysqli_query($koneksi,"SELECT * FROM tb_pengajuan inner join tb_mahasiswa on tb_mahasiswa.id_mahasiswa=tb_pengajuan.id_mahasiswa WHERE id_pengajuan = '$id_pengajuan'");
            $data_pengajuan = mysqli_fetch_assoc($get_pengajuan);
            $nomorhp = $data_pengajuan['no_telp_mhs'];
            // echo    $nomorhp;
            if($nomorhp!=null){
                $phone= preg_replace('/^0?/','62', $nomorhp); 
                    $message = "Pengajuan anda telah selesai, silahkan cek di SIAKAD";
                    $data= array(
                      'id' => $phone,
                      'btndata' => array(
                        'text'  => $message,
                        'buttons'    => array(
                          array(
                            'type' => 'urlButton',
                            'title' => 'Open browser',
                            'payload' => 'https://localhost/siakad/'
                          ),
                        ),
                        'footerText'  => 'SIAKAD'
                      )
                  );
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://atik.ta-notif.xyz/message/button?key=123',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>json_encode($data)
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
            }
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      // echo "<script>alert('Data Berhasil Diupload');window.location='data_pengajuan.php';</script>";
    }
  }

?>