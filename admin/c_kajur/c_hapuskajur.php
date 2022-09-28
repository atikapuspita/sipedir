<?php 

include '../../koneksi/config.php';

$id_kajur = $_GET["id_kajur"];

function hapus($id_kajur){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_kajur WHERE id_kajur='$id_kajur'");
    
    return mysqli_affected_rows($koneksi);
}


if (hapus($id_kajur) > 0) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = '../data_kajur.php';
            </script>
        ";
}
else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = '../data_kajur.php';
            </script>
        ";
}

?>
