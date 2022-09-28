<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_GET['edit'])){

    // membuat variabel untuk menampung data dari form
    $npm= $_GET['npm'];
    $passwordLama = $_GET['passwordLama'];

// if($passwordLama != '')
// {
//   $update = mysqli_query($koneksi, "UPDATE tb_mahasiswa SET npm='$npm',password_mhs='$password_mhs' WHERE npm='$npm'");
//   if($update) {
//     echo "<script> 
//           alert ('Data Berhasil di Update'); window.location = 'profile.php' </script> ";
//   }
//   else 
//   {
//     echo "<script> 
//           alert ('Data Gagal di Update'); window.location = 'profile.php' </script> ";
//   }
// }
// else
// {
//   $update = mysqli_query($koneksi, "UPDATE tb_mahasiswa SET npm='$npm',password_mhs='$password_mhs' WHERE npm='$npm'");
//   if($update) {
//     echo "<script> 
//           alert ('Data Berhasil di Update'); window.location = 'profile.php' </script> ";
//   }
//   else 
//   {
//     echo "<script> 
//           alert ('Data Gagal di Update'); window.location = 'profile.php' </script> ";
//   }
// }

$cekPassword = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE password_mhs = '$passwordLama' ");
if($cekPassword -> num_rows > 0) {
  $password1 = $_GET['password1'];
  $password2 = $_GET['password2'];

  //$password = md5($_GET['password']);

if(!empty($password1 && $password2)){
    if($password1 == $password2){
      $sql = mysqli_query($koneksi, "UPDATE tb_mahasiswa SET password_mhs ='$password1' WHERE npm='$npm'");
      echo "<script> 
                alert ('Data Berhasil di Update'); window.location = 'profile.php' </script> ";
    }
    else {
      echo "<script> 
          alert ('Password Gagal di Update, Password baru tidak sama'); window.location = 'profile.php' </script> ";
    }
  }else{
    echo "<script> 
          alert ('Password Gagal di Update, Password baru kosong'); window.location = 'profile.php' </script> ";
  }
}
  
  }
?>