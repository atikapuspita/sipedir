<?php 
 
 include "../koneksi/config.php";



function verifikasi($data){
    global $koneksi;
    
    $id_pengajuan = htmlspecialchars($data["id_pengajuan"]);
    $id_pegawai = htmlspecialchars($data["id_pegawai"]);
    $status_verifikasi = htmlspecialchars($data["status_verifikasi"]);
    $alasan_tolak = htmlspecialchars($data["alasan_tolak"]);
    // $status_pengajuan = htmlspecialchars($data["status_pengajuan"]);

    if($status_verifikasi == "Ditolak") {

        $query = "INSERT INTO 
        `tb_verifikasi`
        ( `id_pengajuan`, `tgl_verifikasi`, `id_pegawai`, `status_verifikasi`, `status_pengajuan`, `alasan_tolak`) 
        VALUES ('$id_pengajuan',NOW(),'$id_pegawai','$status_verifikasi','5', '$alasan_tolak')";
    
        $result = mysqli_query($koneksi,$query);
        if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
        } else {
          //tampil alert dan akan redirect ke halaman index.php
          //silahkan ganti index.php sesuai halaman yang akan dituju
        echo "<script>alert('Verifikasi Berhasil.');window.location='data_pengajuan.php';</script>";
        }

    }
    else {
        $query = "INSERT INTO 
        `tb_verifikasi`
        ( `id_pengajuan`, `tgl_verifikasi`, `id_pegawai`, `status_verifikasi`, `status_pengajuan`) 
        VALUES ('$id_pengajuan',NOW(),'$id_pegawai','$status_verifikasi','3')";
    
        $result = mysqli_query($koneksi,$query);
        if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
        } else {
          //tampil alert dan akan redirect ke halaman index.php
          //silahkan ganti index.php sesuai halaman yang akan dituju
        echo "<script>alert('Verifikasi Berhasil.');window.location='data_pengajuan.php';</script>";
        }
    }
    
    
};