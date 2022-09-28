<!-- ##################################### MODAL DETAIL ################################################ -->
<?php
    include "../koneksi/config.php";

?>

<div class="modal fade" id="modaltimeline<?php echo $d['id_pengajuan'];?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Riwayat Pengajuan</h4>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">History</span>
              </div>
              <div>
                  <i class="fas fa-clock bg-gray"></i>
                  <div class="timeline-item" style="width: 700px;">
                  <h3 class="timeline-header no-border"> Belum Konfirmasi</i>
                  <div class="timeline-body"></div>
                </div>
              </div>
          <?php
                             $pro = $d['id_pengajuan'];

                             $alus = mysqli_query($koneksi, "SELECT * FROM
                                        tb_verifikasi_doswal INNER JOIN tb_doswal ON tb_verifikasi_doswal.id_doswal = tb_doswal.id_doswal inner join tb_pegawai on tb_pegawai.id_pegawai=tb_doswal.id_pegawai
                                        WHERE tb_verifikasi_doswal.id_pengajuan = '$pro'
                                        ORDER BY status_pengajuan ASC;");
                                                foreach ($alus as $rows) : 

                                                    if ($rows["status_pengajuan"] == "1") {
                                                        $proses = "Verifikasi Dosen Wali";
                                                    } elseif ($rows["status_pengajuan"] == "2") {
                                                        $proses = "Verifikasi Ketua Jurusan";
                                                    } elseif ($rows["status_pengajuan"] == "3") {
                                                        $proses = "Verifikasi Bagian Keuangan";
                                                    } elseif ($rows["status_pengajuan"] == "4") {
                                                        $proses = "Verifikasi Bagian Perpustakaan";
                                                    } elseif ($rows["status_pengajuan"] == "5") {
                                                        $proses = "Verifikasi Wakil Direktur I";
                                                    } elseif ($rows["status_pengajuan"] == "6") {
                                                        $proses = "Verifikasi BAAK";
                                                    }elseif ($rows["status_pengajuan"] == "7") {
                                                        $proses = "Sudah Diterima";
                                                    }

                                                    if ($rows["status_verifikasi"] == "Ditolak") {
                                                        $icon = "far fa-clock";
                                                        $warna = "danger";
                                                        $waktu = "Menolak Pengajuan";
                                                        $subjek = $rows["nip_npak"];
                                                    } elseif ($rows["status_verifikasi"] == "Diverifikasi") {
                                                        $icon = "fas fa-check";
                                                        $warna = "info";
                                                        $waktu = "Melakukan Verifikasi";
                                                        $subjek = $rows["nip_npak"];
                                                    }else {
                                                        $icon = "far fa-times-circle";
                                                        $warna = "seccondary";
                                                        $waktu = "Belum Konfirmasi";
                                                        $subjek = $rows["nip_npak"];
                                                    }

                              ?>
                              <!-- Timelime example  -->

                                  <!-- The time line -->
                                  <div class="timeline">
                                    <!-- timeline time label -->
                                    <!-- timeline item -->
                                    <div>
                                      <i class="fas fa-user bg-<?=$warna?>"></i>
                                      <div class="timeline-item" style="width: 700px;">
                                        <span class="time"><i class="fas fa-clock"></i>
                                          <?=$rows['tgl_verifikasi']?></span
                                        >
                                        <h3 class="timeline-header no-border">Sudah Diverifikasi
                                        </h3>
                                        <div class="timeline-body"><?=$rows ['nama_pegawai']; ?> <?=$waktu?>
                                      </div>
                                      </div>
                                    </div>

                                    <?php
                                    endforeach;
                                    $alus = mysqli_query($koneksi, "SELECT * FROM
                                    tb_verifikasi_unit INNER JOIN tb_unit_kerja ON tb_verifikasi_unit.id_unit = tb_unit_kerja.id_unit inner join tb_pegawai on tb_pegawai.id_pegawai=tb_unit_kerja.id_pegawai
                                    WHERE tb_verifikasi_unit.id_pengajuan = '$pro'
                                    ORDER BY status_pengajuan ASC;");
                                            foreach ($alus as $rows) : 

                                                if ($rows["status_pengajuan"] == "1") {
                                                    $proses = "Verifikasi Dosen Wali";
                                                } elseif ($rows["status_pengajuan"] == "2") {
                                                    $proses = "Verifikasi Ketua Jurusan";
                                                } elseif ($rows["status_pengajuan"] == "3") {
                                                    $proses = "Verifikasi Bagian Keuangan";
                                                } elseif ($rows["status_pengajuan"] == "4") {
                                                    $proses = "Verifikasi Bagian Perpustakaan";
                                                } elseif ($rows["status_pengajuan"] == "5") {
                                                    $proses = "Verifikasi Wakil Direktur I";
                                                } elseif ($rows["status_pengajuan"] == "6") {
                                                    $proses = "Verifikasi BAAK";
                                                }elseif ($rows["status_pengajuan"] == "7") {
                                                    $proses = "Sudah Diterima";
                                                }

                                                if ($rows["status_verifikasi"] == "Ditolak") {
                                                    $icon = "far fa-clock";
                                                    $warna = "danger";
                                                    $waktu = "Menolak Pengajuan";
                                                    $subjek = $rows["nip_npak"];
                                                } elseif ($rows["status_verifikasi"] == "Diverifikasi") {
                                                    $icon = "fas fa-check";
                                                    $warna = "warning";
                                                    $waktu = "Melakukan Verifikasi";
                                                    $subjek = $rows["nip_npak"];
                                                }else {
                                                    $icon = "far fa-times-circle";
                                                    $warna = "seccondary";
                                                    $waktu = "Belum Konfirmasi";
                                                    $subjek = $rows["nip_npak"];
                                                }

                            ?>
                                  <!-- Timelime example  -->

                                      <!-- The time line -->
                                      <div class="timeline">
                                        <!-- timeline time label -->
                                        <!-- timeline item -->
                                        <div>
                                          <i class="fas fa-user bg-<?=$warna?>"></i>
                                          <div class="timeline-item" style="width: 700px;">
                                            <span class="time"><i class="fas fa-clock"></i>
                                              <?=$rows['tgl_verifikasi']?></span
                                            >
                                            <h3 class="timeline-header no-border">Sudah Diverifikasi
                                            </h3>
                                            <div class="timeline-body"><?=$rows ['nama_pegawai']; ?> <?=$waktu?>
                                          </div>
                                          </div>
                                        </div>

                                        <?php
                                endforeach;
                            
                                $alus = mysqli_query($koneksi, "SELECT * FROM
                                tb_verifikasi_kajur INNER JOIN tb_kajur ON tb_verifikasi_kajur.id_kajur = tb_kajur.id_kajur inner join tb_pegawai on tb_pegawai.id_pegawai=tb_kajur.id_pegawai
                                WHERE tb_verifikasi_kajur.id_pengajuan = '$pro'
                                ORDER BY status_pengajuan ASC;");
                                        foreach ($alus as $rows) : 

                                            if ($rows["status_pengajuan"] == "1") {
                                                $proses = "Verifikasi Dosen Wali";
                                            } elseif ($rows["status_pengajuan"] == "2") {
                                                $proses = "Verifikasi Ketua Jurusan";
                                            } elseif ($rows["status_pengajuan"] == "3") {
                                                $proses = "Verifikasi Bagian Keuangan";
                                            } elseif ($rows["status_pengajuan"] == "4") {
                                                $proses = "Verifikasi Bagian Perpustakaan";
                                            } elseif ($rows["status_pengajuan"] == "5") {
                                                $proses = "Verifikasi Wakil Direktur I";
                                            } elseif ($rows["status_pengajuan"] == "6") {
                                                $proses = "Verifikasi BAAK";
                                            }elseif ($rows["status_pengajuan"] == "7") {
                                                $proses = "Sudah Diterima";
                                            }

                                            if ($rows["status_verifikasi"] == "Ditolak") {
                                                $icon = "far fa-clock";
                                                $warna = "danger";
                                                $waktu = "Menolak Pengajuan";
                                                $subjek = $rows["nip_npak"];
                                            } elseif ($rows["status_verifikasi"] == "Diverifikasi") {
                                                $icon = "fas fa-check";
                                                $warna = "primary";
                                                $waktu = "Melakukan Verifikasi";
                                                $subjek = $rows["nip_npak"];
                                            }else {
                                                $icon = "far fa-times-circle";
                                                $warna = "seccondary";
                                                $waktu = "Belum Konfirmasi";
                                                $subjek = $rows["nip_npak"];
                                            }

?>
  <!-- Timelime example  -->

      <!-- The time line -->
      <div class="timeline">
        <!-- timeline time label -->
        <!-- timeline item -->
        <div>
          <i class="fas fa-user bg-<?=$warna?>"></i>
          <div class="timeline-item" style="width: 700px;">
            <span class="time"><i class="fas fa-clock"></i>
              <?=$rows['tgl_verifikasi']?></span
            >
            <h3 class="timeline-header no-border">Pengajuan di Terima
            </h3>
            <div class="timeline-body"><?=$rows ['nama_pegawai']; ?> <?=$waktu?>
          </div>
          </div>
        </div>

        <?php
                            endforeach;
                        ?>
                
            </div>
          </div>
          </div>
          </div>
      </div>

          <!-- /.modal-content -->
        </div>


  <!-- ALASAN DI TOLAK  -->
</div>
