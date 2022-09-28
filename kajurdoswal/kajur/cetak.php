<!DOCTYPE html>
<html>
    <head>
    <script src="https://kit.fontawesome.com/bd293d113e.js" crossorigin="anonymous"></script>
    <title>
        Laporan Pengunduran Diri
    </title>
    <style type="text/css">
        /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 20px 0px 0px 30px;

            font: 12pt "Times New Roman";
        }
        #tables{
            border-collapse: collapse;
        }
        #tables td, #tables th {
        border: 2px solid black;
        padding: 2px;
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
    </head>

    <body>
    <table width="700">
                <tr>
                    <td><br></td>
                </tr>
                    <tr>
                        <td><img src="../../AdminLTE/dist/img/logo_pnc.png" width="80" height="80"></td>
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

        <?php 
        
        include "../../koneksi/config.php";
        $user = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa INNER JOIN tb_pengajuan ON tb_pengajuan.id_mahasiswa = tb_mahasiswa.id_mahasiswa 
        INNER JOIN tb_kelas ON tb_mahasiswa.id_kelas = tb_kelas.id_kelas INNER JOIN tb_prodi on tb_kelas.id_prodi = tb_prodi.id_prodi INNER JOIN tb_jurusan on tb_jurusan.id_jurusan=tb_prodi.id_jurusan WHERE status_pengajuan = '4' ");
  
        ?>

        <table id="tables" border="1" >
                    <thead>
                      <tr>
                          <th><center>No</center></th>
                          <th><center>NPM</center></th>
                          <th><center>Nama Mahasiswa</center></th>
                          <th><center>Jurusan</center></th>
                          <th><center>Nomor SK</center></th>
                          <th><center>Tanggal Pengajuan</center></th>
                          <th><center>Tahun Akademik</center></th>
                      </tr>
                    </thead>
                  
                    <tbody>
                    <?php $i = 1; ?>
                    
                    <?php foreach ($user as $row) : 
                    $t = substr($row['tgl_pengajuan'],0,4);
                    $b = substr($row['tgl_pengajuan'],5,2);
                    $h = substr($row['tgl_pengajuan'],8,2);
                
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
                      ?>
                            <tr>
                                <td><center><?= $i ?></center></td>
                            <td><?php echo $row['npm']; ?></td>
                            <td><?php echo $row['nama_mhs']; ?></td>
                            <td><?php echo $row['nama_jurusan']; ?></td>
                            <td><?php echo $row["no_sk"]; ?></td>
                            <td><?php echo "<a>". $h." ". $nm. " ". $t. "</a>" ?></td>
                            <td><center><?php echo $row["thn_angkatan"]; ?></center></td>
                          </tr>
                          
                            <?php $i++ ; ?>
  
                      <?php endforeach; ?>
                    </tbody>
                  </table>

            <table width = "700">
                <tr>
                    <td width="700"> </td><br>
                    <td width="400">Cilacap, </td>
                </tr>
                <tr>
                    <td width="700"> </td>
                    <td width="400">Direkur Politeknik Negeri Cilacap</td>
                </tr>
            </table>

                  <table width = "700">
                <tr>
                <td width="700"> </td>
                    <td width="400"><center>
                    <img src="../../admin/img/ttd_pegawai/ttd_dire.png"width="100px" height="100px">
                        <br>Dr. Ir. Aris Tjahyanto, M.Kom.<br>
                        NPAK. 19093876465298746</center>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
		     </table>

    <script>
        window.print();
    </script>
    </body>
</html>