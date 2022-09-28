<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include "../koneksi/config.php";

  if(isset($_GET['edit'])){

    // membuat variabel untuk menampung data dari form
    $id_pegawai= $_GET['id_pegawai'];
    $passwordLama = $_GET['passwordLama'];

//fungsi if untuk mengecek apakah foto di upload atau tidak 

// if($passwordLama != '')
// {
//   $update = mysqli_query($koneksi, "UPDATE tb_pegawai password='$password' WHERE id_pegawai='$id_pegawai'");
//   if($update) {
//     echo "<script> 
//           alert ('Data Berhasil di Update'); window.location = 'profile_admin.php' </script> ";
//   }
//   else 
//   {
//     echo "<script> 
//           alert ('Data Gagal di Update'); window.location = 'profile_admin.php' </script> ";
//   }
// }
// else
// {
//   $update = mysqli_query($koneksi, "UPDATE tb_pegawai password='$password' WHERE id_pegawai='$id_pegawai'");
//   if($update) {
//     echo "<script> 
//           alert ('Data Berhasil di Update'); window.location = 'profile_admin.php' </script> ";
//   }
//   else 
//   {
//     echo "<script> 
//           alert ('Data Gagal di Update'); window.location = 'profile_admin.php' </script> ";
//   }
// }

$cekPassword = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_pegawai = '$id_pegawai' and password='$passwordLama' ");
if($cekPassword -> num_rows > 0) {
  $password1 = $_GET['password1'];
  $password2 = $_GET['password2'];

  // $password = md5($_GET['password']);

  if(!empty($password1 && $password2)){
    if($password1 == $password2){
      $sql = mysqli_query($koneksi, "UPDATE tb_pegawai SET password ='$password1' WHERE id_pegawai='$id_pegawai'");
      echo "<script> 
                alert ('Data Berhasil di Update'); window.location = 'profile_admin.php' </script> ";
    }
    else {
      echo "<script> 
          alert ('Password Gagal di Update, Password baru tidak sama'); window.location = 'profile_admin.php' </script> ";
    }
  }else{
    echo "<script> 
          alert ('Password Gagal di Update, Password baru kosong'); window.location = 'profile_admin.php' </script> ";
  }
}
  
  }
?>