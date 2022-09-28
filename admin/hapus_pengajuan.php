<?php 

include '../koneksi/config.php';

$id_pengajuan = $_GET["id_pengajuan"];

function hapus($id_pengajuan){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_pengajuan WHERE id_pengajuan=$id_pengajuan");
    
    return mysqli_affected_rows($koneksi);
}


if (hapus($id_pengajuan) > 0 ) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = 'data_pengajuan.php';
            </script>
        ";
}
else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = 'data_pengajuan.php';
            </script>
        ";
}

?>
