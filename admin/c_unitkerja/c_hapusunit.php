<?php 

include '../../koneksi/config.php';

$id_unit = $_GET["id_unit"];

function hapus($id_unit){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_unit_kerja WHERE id_unit='$id_unit'");
    
    return mysqli_affected_rows($koneksi);
}


if (hapus($id_unit) > 0) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = '../data_unitkerja.php';
            </script>
        ";
}
else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = '../data_unitkerja.php';
            </script>
        ";
}

?>
