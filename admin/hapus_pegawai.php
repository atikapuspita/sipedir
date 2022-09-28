<?php 

include '../koneksi/config.php';

$nip_npak = $_GET["nip_npak"];

function hapus($nip_npak){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_pegawai WHERE nip_npak = '$nip_npak'");
    
    return mysqli_affected_rows($koneksi);
}


if (hapus($nip_npak) > 0 ) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = 'data_pegawai.php';
            </script>
        ";
}
else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = 'data_pegawai.php';
            </script>
        ";
}

?>
