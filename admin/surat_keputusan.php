<?php 

    include "../koneksi/config.php";
    
    $id_pengajuan = $_GET['id_pengajuan'];
    $query = mysqli_query($koneksi, "SELECT * FROM tb_pengajuan INNER JOIN tb_mahasiswa ON tb_pengajuan.npm = tb_mahasiswa.npm WHERE id_pengajuan = '$id_pengajuan'");
    $data  = mysqli_fetch_array($query);

    $mahasiswa = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa INNER JOIN tb_prodi ON tb_mahasiswa.id_prodi = tb_prodi.id_prodi");
    $mhs  = mysqli_fetch_array($mahasiswa);

    $verifikasi = mysqli_query($koneksi, "SELECT * FROM tb_verifikasi INNER JOIN tb_pengajuan ON tb_verifikasi.id_pengajuan = tb_pengajuan.id_pengajuan");
    $verif  = mysqli_fetch_array($verifikasi);

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
                    <td><center>Keputusan Direktur Politeknik Negeri Cilacap <br></center></td>
                </tr>
                <tr>
                    <td width="70"> </td>
                    <td><center>Nomor : <?php echo $data['no_sk']; ?> <br></center></td>
                </tr>
                <tr>
                    <td width="70"> </td>
                    <td><center>Tentang <br></center></td>
                </tr>
                <tr>
                    <td width="70"> </td>
                    <td><center>Pengunduran Diri Mahasiswa atas nama <?php echo $mhs['nama_mhs']; ?> <br></center></td>
                </tr>
                <tr>
                    <td width="70"> </td>
                    <td><center>Program Studi <?php echo $mhs['nama_prodi']; ?>  <br></center></td>
                </tr>
                <tr>
                    <td width="70"> </td>
                    <td><center>Tahun Akademik <?php echo $mhs['thn_angkatan']; ?> <br></center></td>
                </tr>
                <tr>
                    <td width="70"> </td>
                    <td><center>Direktur Politeknik Negeri Cilacap </center></td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
            </table>

            <table width="700">
                <tr>
                    <td width="50"> </td>
                    <td width="550">Menimbang : </td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">&nbsp;&nbsp;&nbsp;a. Bahwa surat permohonan pengunduran diri <?php echo $mhs['nama_mhs']; ?>  NPM <?php echo $mhs['npm']; ?> mahasiswa </td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Program Studi <?php echo $mhs['nama_prodi']; ?></td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">&nbsp;&nbsp;&nbsp;b. Bahwa sehubung dengan butir a di atas, maka perlu diterbitkan Keputusan &hellip;&hellip;&hellip;.;</td>
                </tr>
            </table>
            
            <table width="700">
                <tr>
                    <br>
                    <td width="50"> </td>
                    <td width="550">Mengingat : </td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">&nbsp;&nbsp;&nbsp;1. Undang - Undang Republik Indonesia Nomor ..... Tentang ..... ;</td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">&nbsp;&nbsp;&nbsp;2. Peraturan Pemerintah Nomor ..... Tentang ..... ;</td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">&nbsp;&nbsp;&nbsp;3. Peraturan Menteri Pendidikan dan Kebudayaan Nomor ...... Tahun ..... Tentang ..... ;</td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">&nbsp;&nbsp;&nbsp;4.	Peraturan Menteri Riset, Teknologi dan Pendidikan Tinggi Nomor ....... Tahun ..... Tentang........ </td>
                </tr>
            </table>

            <table width="700">
                <tr>
                    <td width="50"> </td>
                    <td><center>Memutuskan : </center></td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">Menetapkan : </td>
                </tr>
                <tr>
                    <td width="50"> </td>
                    <td width="550">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Keputusan Direktur Politeknik Negeri Cilacap Tentang Pengunduran Diri Mahasiswa a.n <?php echo $mhs['nama_mhs'] ?> Program Studi <?php echo $mhs['nama_prodi'] ?> Tahun Akademik <?php echo $mhs['thn_angkatan'] ?></td>
                </tr>
            </table>

            <table width="700">
                <tr>
                    <br>
                    <td width="50"> </td>
                    <td width="550">Kesatu : Kepada mahasiswa di bawah ini:</td>
                </tr>
            </table>

            <table width = "700">
                <tr>
                    <td width="135"> </td>
                    <td width="125">Nama</td>
                    <td width="435"><span> : </span> <?php echo $mhs['nama_mhs']; ?></td>
                </tr>
                <tr>
                <td width="135"> </td>
                    <td width="125">NPM</td>
                    <td width="435"><span> : </span><?php echo $mhs['npm']; ?> </td>
                </tr>
                <tr>
                <td width="135"> </td>
                    <td width="125">Program Studi</td>
                    <td width="435"><span> : </span> <?php echo $mhs['nama_prodi']; ?></td>
                </tr>
                <tr>
                <td width="135"> </td>
                    <td width="125">Tingkat/Semester</td>
                    <td width="435"><span> : </span> <?php echo $data['semester']; ?></td>
                </tr>
                <tr>
                <td width="135"> </td>
                    <td width="125">Tahun Akademik</td>
                    <td width="435"><span> :</span> <?php echo $mhs['thn_angkatan']; ?></td>
                </tr>
            </table>
            <table width = "700">
                <tr>
                    <td width="50"> </td>
                    <td width="550">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Diperkenankan mengundurkan diri sebagai mahasiswa Politeknik Negeri Cilacap.</td>
                </tr>
            </table>

            <table width = "700">
                <tr>
                    <td width="50"> </td>
                    <td width="550">Kedua : Mahasiswa yang dimaksud pada diktum kesatu .......</td>
                </tr>
            </table>

            <table width = "700">
                <tr>
                    <td width="50"> </td>
                    <td width="550">Ketiga : Keputusan Direktur ini mulai ...</td>
                </tr>
            </table>

            <table width = "700">
                <tr>
                    <td width="700"> </td>
                    <td width="400">Ditetapkan</td>
                </tr>
                <tr>
                    <td width="700"> </td>
                    <td width="400">Pada Tanggal </td>
                </tr>
                <tr>
                    <td width="700"> </td>
                    <td width="400">Direkur Politeknik Negeri Cilacap</td>
                </tr>
            </table>

            <table width = "700">
                <tr>
                <td width="700"> </td>
                    <td width="400"><center><br><br><br>
                    <!-- <img src="img/ttd_pegawai/ttd_dire.png"width="100px" height="100px"> -->
                        <br>Dr. Ir. Aris Tjahyanto, M.Kom.<br>
                        NIDN. 19093876465298746</center>
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


