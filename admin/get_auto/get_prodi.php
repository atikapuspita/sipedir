<?php 
include '../../koneksi/config.php';

$id_jurusan = $_POST['id_jurusan'];
?>

	<select >
	<option value="" >Silahkan Pilih</option>
		<?php 
		$jurusan = mysqli_query($koneksi,"SELECT *
FROM tb_prodi
WHERE id_jurusan ='$id_jurusan' ");

		while($d = mysqli_fetch_array($jurusan)){
			?>
			<option value="<?php echo $d['id_prodi']; ?>"><?php echo $d['nama_prodi']; ?></option>
			<?php 
		}
		?>
	</select>