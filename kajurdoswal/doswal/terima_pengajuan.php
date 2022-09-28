<?php 

	include "../koneksi/config.php";

	$id_pengajuan = $_POST['id_pengajuan'];
    $nip_npak = $_POST['nip_npak'];
    $jabatan = $_POST['jabatan'];

function terima($id_pengajuan, $nip_npak, $jabatan)
{
    global $koneksi;
    // date_default_timezone_set('Asia/Jakarta');
    // $jam = date('G:i:s'); //akan menampilkan 18:07:10 WIB
    $tgl = date('Y-m-d');

    // verifikasi dosen wali
    if ($jabatan == "Dosen Wali") {
        mysqli_query($koneksi, "UPDATE tb_pengajuan SET status_pengajuan = '1' WHERE id_pengajuan = '$id_pengajuan'");

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
    // verifikasi ketua jurusan
    elseif ($jabatan == "Ketua Jurusan") {
        mysqli_query($koneksi, "UPDATE tb_pengajuan SET status_pengajuan = '2' WHERE id_pengajuan = '$id_pengajuan'");

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
    // verifikasi wadir1
    elseif ($jabatan == "Wakil Direktur 1") {
        mysqli_query($koneksi, "UPDATE tb_pengajuan SET status_pengajuan = '3' WHERE id_pengajuan = '$id_pengajuan'");

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
    // verifikasi BAAK
    elseif ($jabatan == "Admin") {
        mysqli_query($koneksi, "UPDATE tb_pengajuan SET status_pengajuan = '4' WHERE id_pengajuan = '$id_pengajuan'");

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
    } else {
        return false;
    }
}

// untuk ACC pengajuan
if (terima($id_pengajuan, $nip_npak, $jabatan)) {
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

?>