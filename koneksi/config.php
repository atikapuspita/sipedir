<?php 
//koneksi ke database
// $koneksi = mysqli_connect("localhost","u1542826_atika","magangsukses2021","u1542826_siakad");
$koneksi = mysqli_connect("localhost","root","","siakad");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>