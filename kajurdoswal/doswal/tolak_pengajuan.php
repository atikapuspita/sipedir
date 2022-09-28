<?php
include "../koneksi/config.php";

$id_pengajuan = $_GET['id_pengajuan'];
$nip_npak = $_GET['nip_npak'];

// untuk tolak pengajuan
if (tolak($id_pengajuan, $nip_npak)) {
    echo "
            <script>
                alert('Data Berhasil Diverifikasi!');
                document.location.href = 'data_pengajuan.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('Data Gagal Diverifikasi!');
                document.location.href = 'data_pengajuan.php';
            </script>
        ";
}

// untuk tolak pengajuan 
function tolak($id_pengajuan, $nip_npak)
{
    global $koneksi;
    $tgl = date("Y-m-d");

    mysqli_query($koneksi, "UPDATE tb_pengajuan SET status_pengajuan = '5' WHERE id_pengajuan = '$id_pengajuan'");

    if (mysqli_affected_rows($koneksi) > 0) {
        mysqli_query($koneksi, "INSERT INTO tb_verifikasi (id_pengajuan, nip_npak, tgl_verifikasi) VALUES ('$id_pengajuan','$nip_npak','$tgl')");
        if (mysqli_affected_rows($koneksi) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

?>