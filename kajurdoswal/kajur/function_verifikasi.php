<?php 
 
 include "../../koneksi/config.php";



function verifikasi($data){
    global $koneksi;
    
    $id_pengajuan = htmlspecialchars($data["id_pengajuan"]);
    $id_kajur = htmlspecialchars($data["id_kajur"]);
    $status_verifikasi = htmlspecialchars($data["status_verifikasi"]);
    $alasan_tolak = htmlspecialchars($data["alasan_tolak"]);
    // $status_pengajuan = htmlspecialchars($data["status_pengajuan"]);

    if($status_verifikasi == "Ditolak") {

        $query = "INSERT INTO 
        `tb_verifikasi_kajur`
        ( `id_pengajuan`, `tgl_verifikasi`, `id_kajur`, `status_verifikasi`, `status_pengajuan`, `alasan_tolak`) 
        VALUES ('$id_pengajuan',NOW(),'$id_kajur','$status_verifikasi','5', '$alasan_tolak')";
    
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
        `tb_verifikasi_kajur`
        ( `id_pengajuan`, `tgl_verifikasi`, `id_kajur`, `status_verifikasi`, `status_pengajuan`) 
        VALUES ('$id_pengajuan',NOW(),'$id_kajur','$status_verifikasi','4')";
    
        $result = mysqli_query($koneksi,$query);
        if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
        } else {
            $get_pengajuan = mysqli_query($koneksi,"SELECT * FROM tb_pegawai where jabatan ='0'");
            $data_pengajuan = mysqli_fetch_assoc($get_pengajuan);
            $nomorhp = $data_pengajuan['no_telp_pegawai'];
            // echo    $nomorhp;
            if($nomorhp!=null){
                $phone= preg_replace('/^0?/','62', $nomorhp); 
                    $message = "Terdapat pengajuan pengunduran diri mahasiswa yang telah disetujui Ketua Jurusan, segera upload KHS dan Surat Keputusan di SIAKAD";

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
    
    
};