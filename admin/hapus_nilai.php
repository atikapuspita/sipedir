<?php 

include '../koneksi/config.php';

$id_nilai = $_GET["id_nilai"];

function hapus($id_nilai){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_nilai WHERE id_nilai=$id_nilai");
    
    return mysqli_affected_rows($koneksi);
}


if (hapus($id_nilai) > 0 ) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = 'data_nilai.php';
            </script>
        ";
}
else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = 'data_nilai.php';
            </script>
        ";
}

?>
