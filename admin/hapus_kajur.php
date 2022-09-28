<?php 

include '../koneksi/config.php';

$id_jurusan = $_GET["id_jurusan"];

function hapus($id_jurusan){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_jurusan WHERE id_jurusan=$id_jurusan");
    
    return mysqli_affected_rows($koneksi);
}


if (hapus($id_jurusan)) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = 'data_kajur.php';
            </script>
        ";
}
else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = 'data_kajur.php';
            </script>
        ";
}

?>
