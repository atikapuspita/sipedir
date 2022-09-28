<?php 
 
 include "../koneksi/config.php";



function verifikasi($data){
    global $koneksi;
    
    $id_pengajuan = htmlspecialchars($data["id_pengajuan"]);
    $status_verifikasi = htmlspecialchars($data["status_verifikasi"]);
    $alasan_tolak = htmlspecialchars($data["alasan_tolak"]);
    $id_unit = htmlspecialchars($data["id_unit"]);
    // $status_pengajuan = htmlspecialchars($data["status_pengajuan"]);

    if($status_verifikasi == "Ditolak") {

        $query = "INSERT INTO 
        `tb_verifikasi_unit`
        ( `id_pengajuan`, `tgl_verifikasi`, `id_unit`, `status_verifikasi`, `status_pengajuan`, `alasan_tolak`) 
        VALUES ('$id_pengajuan',NOW(),'$id_unit','$status_verifikasi','5', '$alasan_tolak')";
    
        $result = mysqli_query($koneksi,$query);
        if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
        } else {
            $get_pengajuan = mysqli_query($koneksi,"SELECT * FROM tb_pengajuan inner join tb_mahasiswa on tb_mahasiswa.id_mahasiswa=tb_pengajuan.id_mahasiswa WHERE id_pengajuan = '$id_pengajuan'");
            $data_pengajuan = mysqli_fetch_assoc($get_pengajuan);
            $nomorhp = $data_pengajuan['no_telp_mhs'];
            // echo    $nomorhp;
            if($nomorhp!=null){
                $phone= preg_replace('/^0?/','62', $nomorhp); 
                    $message = "Pengajuan pengunduran diri anda di tolak, karena ".$alasan_tolak;

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
            }
          //tampil alert dan akan redirect ke halaman index.php
          //silahkan ganti index.php sesuai halaman yang akan dituju
        echo "<script>alert('Verifikasi Berhasil.');window.location='data_pengajuan.php';</script>";
        }

    }
    else {
        $query = "INSERT INTO 
        `tb_verifikasi_unit`
        ( `id_pengajuan`, `tgl_verifikasi`, `id_unit`, `status_verifikasi`, `status_pengajuan`) 
        VALUES ('$id_pengajuan',NOW(),'$id_unit','$status_verifikasi','3')";
    
        $result = mysqli_query($koneksi,$query);
        if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
        } else {
            $get_pengajuan = mysqli_query($koneksi,"SELECT tb_pegawai.* FROM tb_pengajuan inner join tb_mahasiswa on tb_mahasiswa.id_mahasiswa=tb_pengajuan.id_mahasiswa inner join tb_kelas on tb_kelas.id_kelas=tb_mahasiswa.id_kelas inner join tb_prodi on tb_prodi.id_prodi=tb_kelas.id_prodi inner join tb_jurusan on tb_jurusan.id_jurusan=tb_prodi.id_jurusan inner join tb_kajur on tb_kajur.id_jurusan=tb_jurusan.id_jurusan inner join tb_pegawai on tb_pegawai.id_pegawai=tb_kajur.id_pegawai  where tb_pengajuan.id_pengajuan ='$id_pengajuan'");
            $data_pengajuan = mysqli_fetch_assoc($get_pengajuan);
            $nomorhp = $data_pengajuan['no_telp_pegawai'];
            // echo    $nomorhp;
            if($nomorhp!=null){
                $phone= preg_replace('/^0?/','62', $nomorhp); 
                    $message = "Terdapat pengajuan pengunduran diri mahasiswa yang telah disetujui bagian keuangan, segera cek SIAKAD";

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
        echo "<script>alert('Verifikasi Berhasil.');window.location='data_pengajuan.php';</script>";
        }
    }
    
    
};