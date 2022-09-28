<?php
session_start();

include '../koneksi/config.php';

$username = $_POST['username'];
$password = $_POST['password'];


$login = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE username = '$username' AND password = '$password'");
$cek = mysqli_num_rows($login);

$data = mysqli_fetch_assoc($login);
$id_pegawai = $data['id_pegawai'];

$login2 = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE username_mhs = '$username' AND password_mhs = '$password'");
$cek2 = mysqli_num_rows($login2);

$data2 = mysqli_fetch_assoc($login2);
$id_mahasiswa = $data2['id_mahasiswa'];

    if ($cek2 > 0) {

        $_SESSION['username_mhs'] = $username;
        $_SESSION['password_mhs'] = $password;
        $_SESSION['id_mahasiswa'] = $id_mahasiswa;

        header("location:../mahasiswa/index.php");
    } 
    
    elseif($cek > 0 ){

    if ($data['jabatan'] == '0') {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_pegawai'] = $id_pegawai;

        header("location:../admin/index.php");
    } elseif ($data['jabatan'] == '1') {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_pegawai'] = $id_pegawai;
        
        header("location:../doswal/index.php");
    } elseif ($data['jabatan'] == '2') {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_pegawai'] = $id_pegawai;
        
        header("location:../kajur/index.php");
    }elseif ($data['jabatan'] == '3') {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_pegawai'] = $id_pegawai;
        
        header("location:../keuangan/index.php");
    }elseif ($data['jabatan'] == '4') {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_pegawai'] = $id_pegawai;
        
        header("location:../perpustakaan/index.php");
    }elseif ($data['jabatan'] == '5') {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_pegawai'] = $id_pegawai;
        
        header("location:../wadir/index.php");
    } elseif ($data['jabatan'] == '6') {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['id_pegawai'] = $id_pegawai;
        
        header("location:../kajurdoswal/index.php");
    }
     else {
        header("location:../login?pesan=gagal");
    }
}
else {
    header("location:../login?pesan=gagal");
}