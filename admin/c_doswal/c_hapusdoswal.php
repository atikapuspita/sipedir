<?php 

include '../../koneksi/config.php';

$id_doswal = $_GET["id_doswal"];

function hapus($id_doswal){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_doswal WHERE id_doswal='$id_doswal'");
    
    return mysqli_affected_rows($koneksi);
}


if (hapus($id_doswal) > 0) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = '../data_doswal.php';
            </script>
        ";
}
else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = '../data_doswal.php';
            </script>
        ";
}

?>
