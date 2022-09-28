<?php 

include '../../koneksi/config.php';

$id_prodi = $_GET["id_prodi"];

function hapus($id_prodi){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_prodi WHERE id_prodi=$id_prodi");
    
    return mysqli_affected_rows($koneksi);
}


if (hapus($id_prodi)) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = '../data_prodi.php';
            </script>
        ";
}
else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = '../data_prodi.php';
            </script>
        ";
}

?>
