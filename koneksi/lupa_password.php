<?php
include "lupapasswordClass.php";

if (isset($_POST["forgotpass"])) {
    if (lupapassword($_POST) > 0) {
        echo "
            <script>
                alert('Permintaan berhasil, silahkan cek email Anda!');
                document.location.href = 'login.php';
            </script>
        ";
    } else {
        echo "
            <script> 
                alert('Permintaan gagal!');
                document.location.href = 'login.php';
            </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
<?php    include "../AdminLTE/rel.html"; ?>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">

                <a class="h3"><b>FORGOT PASSWORD?</b> </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Masukkan email Anda yang terdaftar untuk mendapatkan tautan untuk mengubah kata sandi.</p>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password Baru">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Konfirmasi Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div> -->
                    <div class="row"><br>
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="forgotpass" class="btn btn-primary btn-block">Kirim</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                    <!-- <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
             b       </a> -->
                </div>
                <!-- /.social-auth-links -->


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
<?php    include "../AdminLTE/script.html"; ?>
</body>

</html>