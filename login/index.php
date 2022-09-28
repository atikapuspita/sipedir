<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIAKAD PNC | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<?php
        if (isset($_GET['pesan'])) {
          if ($_GET['pesan'] == "gagal") {
            echo "<script>alert('Username Atau Password Salah'); document.location.href = 'index.php'; </script>";
          } else if ($_GET['pesan'] == "logout") {
            echo "<script>alert('Telah Berhasil logout'); document.location.href = 'index.php'; </script>";
          }else if($_GET['pesan'] == "sukses_lupa"){
            echo "<script>alert('Password Baru Berhasil dikirim'); document.location.href = 'index.php'; </script>";
          }
        }
      ?>
<div class="login-box" style="width: 420px">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
    <center>
      <br><img src="../AdminLTE/dist/img/logo_pnc.png" alt="Foto" width="80px" class="rounded-circle">
    </center><br>
      <a  class="h4"><b>Sistem Informasi Akademik <br>PNC</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Log in to start SIAKAD</p>

      <form action="cek_login.php" method="post">
        <div class="input-group mb-3">
          <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-2">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <!-- <p class="mb-1">
        <a href="lupa_password.php">Lupa Password</a>
        </p> -->

        <div class="row ">
          <div class="col-12 text-right mb-2">
              <a class="text-dark" href="../lupapw">Lupa password</a>
            </div>
          <div class="col-6">
            <a href="../" class="btn btn-danger">Kembali</a>
          </div>
          <div class="col-6 text-right">
            <button type="submit" class="btn btn-primary">Log In</button>
          </div>
        </div>
          <!-- /.col -->
        
      </form>
    </div>
  </div>
    <!-- /.card-body -->
</div>
  <!-- /.card -->

<!-- /.login-box -->

<!-- jQuery -->
<script src="../AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
</body>
</html>
