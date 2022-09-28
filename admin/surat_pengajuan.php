<?php

include "../koneksi/config.php";

    $id_pengajuan = $_GET['id_pengajuan'];
    $query = mysqli_query($koneksi, "SELECT * FROM tb_pengajuan INNER JOIN tb_mahasiswa ON tb_pengajuan.id_mahasiswa = tb_mahasiswa.id_mahasiswa WHERE id_pengajuan = '$id_pengajuan'");
    $data  = mysqli_fetch_array($query);

    $t = substr($data['tgl_pengajuan'],0,4);
    $b = substr($data['tgl_pengajuan'],5,2);
    $h = substr($data['tgl_pengajuan'],8,2);

        if($b == "01"){
            $nm = "Januari";
        } elseif($b == "02"){
            $nm = "Februari";
        } elseif($b == "03"){
            $nm = "Maret";
        } elseif($b == "04"){
            $nm = "April";
        } elseif($b == "05"){
            $nm = "Mei";
        } elseif($b == "06"){
            $nm = "Juni";
        } elseif($b == "07"){
            $nm = "Juli";
        } elseif($b == "08"){
            $nm = "Agustus";
        } elseif($b == "09"){
            $nm = "September";
        } elseif($b == "10"){
            $nm = "Oktober";
        } elseif($b == "11"){
            $nm = "November";
        } elseif($b == "12"){
            $nm = "Desember";
        }
    $verifikas_jurusan=mysqli_query($koneksi, "SELECT * FROM tb_verifikasi_kajur inner join tb_pengajuan on tb_pengajuan.id_pengajuan=tb_verifikasi_kajur.id_pengajuan inner join tb_mahasiswa on tb_mahasiswa.id_mahasiswa=tb_pengajuan.id_mahasiswa inner join tb_kelas on tb_kelas.id_kelas=tb_mahasiswa.id_kelas inner join tb_prodi on tb_prodi.id_prodi=tb_kelas.id_prodi INNER JOIN tb_jurusan on tb_jurusan.id_jurusan=tb_prodi.id_jurusan WHERE tb_verifikasi_kajur.status_pengajuan='4' AND tb_verifikasi_kajur.id_pengajuan = '$id_pengajuan'");
    $j=mysqli_fetch_array($verifikas_jurusan);
    if($j==null){
        $jurusan = mysqli_query($koneksi, "SELECT * FROM tb_prodi  INNER JOIN tb_kelas on tb_kelas.id_prodi=tb_prodi.id_prodi INNER JOIN tb_mahasiswa ON tb_kelas.id_kelas = tb_mahasiswa.id_kelas INNER JOIN tb_jurusan on tb_jurusan.id_jurusan=tb_prodi.id_jurusan where tb_kelas.id_kelas = '$data[id_kelas]'");
        $j = mysqli_fetch_array($jurusan);
    }


    // $verifikas_dosenwal=mysqli_query($koneksi, "SELECT * FROM tb_verifikasi inner join tb_pegawai on tb_pegawai.id_pegawai=tb_verifikasi.id_pegawai  WHERE tb_verifikasi.status_pengajuan='4' AND tb_verifikasi.id_pengajuan = '$id_pengajuan'");
    // $d=mysqli_fetch_array($verifikas_dosenwal);
    // if($d==null){
    //     $doswal = mysqli_query($koneksi, "SELECT * FROM tb_doswal INNER JOIN tb_kelas on tb_kelas.id_kelas=tb_doswal.id_kelas INNER JOIN tb_mahasiswa ON tb_kelas.id_kelas = tb_mahasiswa.id_kelas where tb_kelas.id_kelas = '$data[id_kelas]'");
    //     $d = mysqli_fetch_array($doswal);
    // }

        // echo $data['id_kelas'];

    $verifikas_dosenwal=mysqli_query($koneksi, "SELECT tb_pegawai.* FROM tb_verifikasi_doswal inner join tb_doswal on tb_verifikasi_doswal.id_doswal=tb_doswal.id_doswal inner join tb_pegawai on tb_pegawai.id_pegawai=tb_doswal.id_pegawai  WHERE tb_verifikasi_doswal.status_pengajuan='1' AND tb_verifikasi_doswal.id_pengajuan = '$id_pengajuan'");
    $p=mysqli_fetch_array($verifikas_dosenwal);
    if($p==null){

        $pegawai = mysqli_query($koneksi, "SELECT tb_pegawai.nama_pegawai,tb_pegawai.nip_npak FROM tb_doswal  INNER JOIN tb_pegawai ON tb_pegawai.id_pegawai = tb_doswal.id_pegawai where tb_doswal.id_kelas = '$data[id_kelas]' AND tb_doswal.status='1'");
        $p = mysqli_fetch_array($pegawai);
    }
    $verifikas_kajur=mysqli_query($koneksi, "SELECT tb_pegawai.* FROM tb_verifikasi_kajur inner join tb_kajur on tb_kajur.id_kajur=tb_verifikasi_kajur.id_kajur inner join tb_pegawai on tb_pegawai.id_pegawai=tb_kajur.id_pegawai  WHERE tb_verifikasi_kajur.status_pengajuan='4' AND tb_verifikasi_kajur.id_pengajuan = '$id_pengajuan'");
    $s=mysqli_fetch_array($verifikas_kajur);
    if($s==null){
        $kajur = mysqli_query($koneksi, "SELECT tb_pegawai.nama_pegawai,tb_pegawai.nip_npak FROM tb_kajur INNER JOIN tb_pegawai on tb_pegawai.id_pegawai=tb_kajur.id_pegawai INNER JOIN tb_jurusan on tb_jurusan.id_jurusan=tb_kajur.id_jurusan INNER JOIN tb_prodi on tb_jurusan.id_jurusan=tb_prodi.id_jurusan INNER JOIN tb_kelas on tb_kelas.id_prodi=tb_prodi.id_prodi  where tb_kelas.id_kelas = '$data[id_kelas]'  AND tb_kajur.status='1'");
        $s = mysqli_fetch_array($kajur);

    }

    $verifikas_keuangan=mysqli_query($koneksi, "SELECT tb_pegawai.* FROM tb_verifikasi_unit inner join tb_unit_kerja on tb_verifikasi_unit.id_unit=tb_unit_kerja.id_unit inner join tb_pegawai on tb_pegawai.id_pegawai=tb_unit_kerja.id_pegawai  WHERE tb_verifikasi_unit.status_pengajuan='3' AND tb_verifikasi_unit.id_pengajuan = '$id_pengajuan'");
    $keu=mysqli_fetch_array($verifikas_keuangan);
    if($keu==null){
        $keuangan = mysqli_query($koneksi, "SELECT tb_pegawai.nama_pegawai,tb_pegawai.nip_npak FROM tb_pegawai inner join tb_unit_kerja on tb_unit_kerja.id_pegawai=tb_pegawai.id_pegawai where tb_pegawai.jabatan='3' AND tb_unit_kerja.status='1'");
        $keu = mysqli_fetch_array($keuangan);

    }

    $verifikas_perpus=mysqli_query($koneksi, "SELECT tb_pegawai.* FROM tb_verifikasi_unit inner join tb_unit_kerja on tb_verifikasi_unit.id_unit=tb_unit_kerja.id_unit inner join tb_pegawai on tb_pegawai.id_pegawai=tb_unit_kerja.id_pegawai  WHERE tb_verifikasi_unit.status_pengajuan='2' AND tb_verifikasi_unit.id_pengajuan = '$id_pengajuan'");
    $pus=mysqli_fetch_array($verifikas_perpus);
    if($pus==null){
        $perpus = mysqli_query($koneksi, "SELECT tb_pegawai.nama_pegawai,tb_pegawai.nip_npak  FROM tb_pegawai inner join tb_unit_kerja on tb_unit_kerja.id_pegawai=tb_pegawai.id_pegawai where tb_pegawai.jabatan='4' AND tb_unit_kerja.status='1'");
        $pus = mysqli_fetch_array($perpus);

    }


    // $dosen = mysqli_query($koneksi, "SELECT * FROM tb_doswal INNER JOIN tb_pegawai ON tb_doswal.nip_npak = tb_pegawai.nip_npak");
    // $s = mysqli_fetch_array($dosen);


?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://kit.fontawesome.com/bd293d113e.js" crossorigin="anonymous"></script>
    <title></title>
    <style type="text/css">
        /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;

            font: 12pt "Times New Roman";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;

            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;

            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;

            height: 297mm;
            outline: 2cm white;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
    <style type="text/css">
   .left    { text-align: left;}
   .right   { text-align: right;}
   .center  { text-align: center;}
   .justify { text-align: justify;}
</style>

<style>
.parent {
        position: relative;
        top: 0;
        left: 0;
      }
      .image1 {
        position: relative;
        top: 0;
        left: 0;
      }
      .image2 {
        position: absolute;
        top: 0;
        left: 210px;
      }
    </style>

</head>

<body>
    <center>
        <table width="700">
                <tr>
                    <td><br></td>
                </tr>
                    <tr>
                        <td><img src="../AdminLTE/dist/img/logo_pnc.png" width="80" height="80"></td>
                        <td><center>
                            <font size="4"> KEMENTRIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI<br></font>
                            <font size="4"><strong>POLITEKNIK NEGERI CILACAP</strong><br></font>
                            <font size="2">Jalan Dr.Soetomo No.1, Sidakaya - CILACAP 53212 Jawa Tengah<br>
                                Telepon: (0282)533329, Fax: (0282)537992<br>
                                Laman: www.politeknikcilacap.ac.id, Email: sekretariat@pnc.ac.id</font>
                        </center></td>			
                    </tr>
                    <tr>
                        <td colspan="2"><b><hr size="3px"></b></td>
                    </tr>
            </table>

            <table>
                <tr>
                    <td width="70"> </td>
                    <td><center> <b>PERMOHONAN PENGUNDURAN DIRI</center></b></td>
                </tr>
            </table>
            <table width="700">
                <tr>
                    <br>
                    <td width="50"> </td>
                    <td width="550">Kepada Yth.</td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">Direktur</td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">Politeknik Negeri Cilacap</td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">Di - Tempat</td>
                </tr>
                <tr>
                    <td style="height: 10px;"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td width="50"> </td>
                    <td width="630">Yang bertanda tangan di bawah ini :</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td width="125">Nama</td>
                    <td width="435"><span> : </span> <?php echo $data['nama_mhs']; ?></td>
                </tr>
                <tr>
                    <td width="125">NPM</td>
                    <td width="435"><span> : </span><?php echo $data['npm']; ?> </td>
                </tr>
                <tr>
                    <td width="125">Kelas/Semester</td>
                    <td width="435"><span> : </span> <?php echo $j['nama_kelas']; ?> / <?php echo $data['semester']; ?></td>
                </tr>
                <tr>
                    <td width="125">Jurusan</td>
                    <td width="435"><span> : </span> <?php echo $j['nama_jurusan']; ?></td>
                </tr>
                <tr>
                    <td width="125">No Telp/HP</td>
                    <td width="435"><span> :</span> <?php echo $data['no_telp_mhs']; ?></td>
                </tr>
                <tr>
                    <td width="125">Alamat Lengkap</td>
                    <td width="435"><span> :</span> <?php echo $data['alamat']; ?></td>
                </tr>
                <tr>
                    <td style="height: 10px;"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Dengan ini mengajukan permohonan pengunduran diri sebagai mahasiswa Politeknik Negeri Cilacap 
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        karena <?php echo $data['alasan']; ?>
                    </td>
                </tr>
                <tr>
                    <td style="height: 10px;"></td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Demikian surat permohonan ini kami sampaikan, atas perhatian dan kebijakannya kami ucapkan
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        terima kasih
                    </td>
                </tr>
 
            </table>
            <table>
                <tr>
                <td width="625" class = "right">Cilacap, <?php echo  "<a>". $h." ". $nm. " ". $t. "</a>" ?></td>
                </tr>
            </table>
            <table>
                <tr>
					<td width="400"><center>Mengetahui<br>Orang Tua/Wali</center></td>
                    <td width="300"><center>Pemohon</center></td>
                </tr>
                <tr>
					<td width="50"><center>
                    
                            <!-- <img class="image1" src="img/materai.jpg" width="70px" height="50"> -->
                            <img src="img/ttd_orangtua/<?php echo $data['ttd_ortu'];?>" width="50" height="50px">
                        <br>
                        <?php echo $data['nama_ortu']; ?></center>
                    </td>
                    <td width="300"><center>
                        <img src="img/ttd_mahasiswa/<?php echo $data['ttd_mhs'];?>"width="50px" height="50px">
                        <br>
                        <?php echo $data['nama_mhs']; ?></center>
                    </td>
                </tr>
		     </table>

             <table>
 
				<tr>
                    <td><center>Menyetujui,</center><br></td>
                </tr>

            </table>
            <table>
                <tr>
					<td width="400"><center>Keuangan</center></td>
                    <td width="300"><center>Perpustakaan</center></td>
                </tr>
                <tr>
					<td width="400"><center><br>
                    <?php if(!empty($keu['ttd_pegawai'])) {?>
                    <img src="img/ttd_pegawai/<?php echo $keu['ttd_pegawai'];?>"width="50px" height="50px">
                        <br>
                        <?php }else{echo '<div style="height:50px" ></div>';} ?>
                    <?php echo $keu['nama_pegawai']; ?><br>
                        NIP/NIDN. <?php echo $keu['nip_npak']; ?></center>
                    </td>
                    <td width="300"><center><br>
                    <?php if(!empty($pus['ttd_pegawai'])) {?>
                    <img src="img/ttd_pegawai/<?php echo $pus['ttd_pegawai'];?>"width="50px" height="50px">
                        <br>
                        <?php }else{echo '<div style="height:50px" ></div>';} ?>
                    <?php echo $pus['nama_pegawai']; ?><br>
                    NIP/NIDN. <?php echo $pus['nip_npak']; ?></center>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
		     </table>
             <table>
                <tr>
					<td width="400"><center>Kepala Jurusan/Prodi<br><?php echo $j['nama_jurusan']; ?></center></td>
                    <td width="300"><center>Wali Dosen</center></td>
                </tr>
                <tr>
					<td width="400"><center><br>
                    <?php if(!empty($s['ttd_pegawai'])) {?>
                    <img src="img/ttd_pegawai/<?php echo $s['ttd_pegawai'];?>"width="50px" height="50px">
                        <br>
                        <?php }else{echo '<div style="height:50px" ></div>';} ?>
                    <?php echo $s['nama_pegawai']; ?><br>
                    NIP/NIDN. <?php echo $s['nip_npak']; ?></center>
                    </td>
                    <td width="300"><center><br>
                    <?php if(!empty($p['ttd_pegawai'])) {?>
                    <img src="img/ttd_pegawai/<?php echo $p['ttd_pegawai'];?>"width="50px" height="50px">
                        <br>
                        <?php }else{echo '<div style="height:50px" ></div>';} ?>
                    <?php echo $p['nama_pegawai']; ?><br>
                    NIP/NIDN. <?php echo $p['nip_npak']; ?></center>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
		     </table>
             

             
             
    </center>

    <script>
        window.print();
    </script>
</body>

</html>


