<?php 
include '../../koneksi/config.php';

$id_prodi = $_POST['id_prodi'];
?>

	<select >
	<option value="">Silahkan Pilih</option>
		<?php 
		$kelas = mysqli_query($koneksi,"SELECT *
FROM tb_kelas
WHERE id_prodi ='$id_prodi' ");

		while($d = mysqli_fetch_array($kelas)){
			?>
			<option value="<?php echo $d['id_kelas']; ?>"><?php echo $d['nama_kelas']; ?></option>
			<?php 
		}
		?>
	</select>