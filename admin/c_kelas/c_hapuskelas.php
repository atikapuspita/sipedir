<?php 

include '../../koneksi/config.php';

$id_kelas = $_GET["id_kelas"];

function hapus($id_kelas){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_kelas WHERE id_kelas='$id_kelas'");
    
    return mysqli_affected_rows($koneksi);
}


if (hapus($id_kelas)) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = '../data_kelas.php';
            </script>
        ";
}
else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = '../data_kelas.php';
            </script>
        ";
}

?>
