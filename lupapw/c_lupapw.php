<?php
session_start();

include '../koneksi/config.php';

$username = $_POST['username'];
$nomorhp = $_POST['nomorhp'];


$login = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE username = '$username' AND no_telp_pegawai = '$nomorhp'");
$login2 = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE username_mhs = '$username' AND no_telp_mhs = '$nomorhp'");
if(mysqli_num_rows($login)>0){
    $data = mysqli_fetch_assoc($login);
    $id_pegawai = $data['id_pegawai'];
    $nama = $data['nama_pegawai'];
    $no_hp = $data['no_telp_pegawai'];
    $password_baru =substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 8);
    $sql = mysqli_query($koneksi, "UPDATE tb_pegawai SET password ='$password_baru' WHERE id_pegawai='$id_pegawai'");
    
    $phone= preg_replace('/^0?/','62', $no_hp); 
    $message = "Assalamualaikum pak/bu ".$nama. ', password anda telah tereset menjadi '.$password_baru.', silahkan login dengan password tersebut.';

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://atik.ta-notif.xyz/message/text?key=123',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => 'id='.$phone.'&message='.$message,
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    header("location:../login/index.php?pesan=sukses_lupa");

}elseif(mysqli_num_rows($login2)>0){
    $data2 = mysqli_fetch_assoc($login2);
    $id_mahasiswa = $data2['id_mahasiswa'];
    $nama = $data2['nama_mahasiswa'];
    $no_hp = $data2['no_telp_mhs'];
    $password_baru =substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 8);
    $sql = mysqli_query($koneksi, "UPDATE tb_mahasiswa SET password ='$password_baru' WHERE id_mahasiswa='$id_mahasiswa'");

    $phone= preg_replace('/^0?/','62', $no_hp); 
    $message = "Assalamualaikum mas/mba ".$nama. ', password anda telah tereset menjadi '.$password_baru.', silahkan login dengan password tersebut.';

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://atik.ta-notif.xyz/message/text?key=123',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => 'id='.$phone.'&message='.$message,
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    header("location:../login/index.php?pesan=sukses_lupa");

}else{
    header("location:index.php?pesan=gagal");
}
 



?>