<?php 

include '../../koneksi/config.php';

$id_mahasiswa = $_GET["id_mahasiswa"];

function hapus($id_mahasiswa){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_mahasiswa WHERE id_mahasiswa=$id_mahasiswa");
    
    return mysqli_affected_rows($koneksi);
}


if (hapus($id_mahasiswa) > 0 ) {
    echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = '../data_mahasiswa.php';
            </script>
        ";
}
else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = '../data_mahasiswa.php';
            </script>
        ";
}

?>
