<?php
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;

include 'PHPMailer/Exception.php';
include 'PHPMailer/PHPMailer.php';
include 'PHPMailer/SMTP.php';

function lupapassword($data)
{
    global $conn;
    $email = $data["email"];
    $p_sql = mysqli_query($conn, "SELECT nip FROM tb_pengguna WHERE email = '$email'");
    $token = md5(rand('10000', '999999'));

    if (mysqli_num_rows($p_sql) > 0) {
        $query = mysqli_query($conn, "UPDATE tb_pengguna set token = '$token' WHERE email = '$email'");

        if ($query) {
            //Instantiation and passing `true` enables exceptions
            $url = 'https://' . $_SERVER['SERVER_NAME'] . '/siakad/login/lupa_password.php?token=' . $token . '&email=' . $email;
            $output = '<div>Silahkan mengklik link dibawah ini untuk mengaktifkan akun anda <br><br>' . $url . '</div>';
            $mail = new PHPMailer();

            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'tugasakhirku87@gmail.com'; //SMTP username
            $mail->Password = 'tugasakhirku87'; //SMTP password
            $mail->SMTPSecure = 'tls'; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            //Kalau ini pilihan, silahkan sesuai keinginan anda....
            $mail->setFrom('tugasakhirku87@gmail.com', 'Localhost');
            $mail->addAddress($email, ''); //Add a recipient
            /*
            $mail->addAddress('ellen@example.com'); //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
            */

            //Attachments
            /*
            $mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name
            */

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Verifikasi Ganti Password';
            $mail->Body = $output;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if ($mail->send()) {
                //Jika berhasil
                return true;
            } else {
                //Jika PHP Mailer Gagal
                return false;
            }
        }
    }
    //jika email tidak ada di database   
    else {
        return false;
    }
}

function ganti_password($data)
{
    global $conn;

    $email = $data['email'];
    $password = $data['password'];
    $Repassword = $data['Repassword'];
    $token = $data['token'];


    // cek email ada di tabel mana
    // cek token ada tidak di tabel
    $p = mysqli_query($conn, "SELECT email, token FROM tb_pengguna WHERE email='$email'");
    $data_p = mysqli_fetch_assoc($p);

    // cek password == konfirmasi password tidak
    if ($password != $Repassword) {
        return false;
    } else {
        // jika email ada di tabel pengguna dan token ada di tabel pengguna sesuai email
        if ((mysqli_num_rows($p) > 0) and ($token == $data_p['token'])) {
            $baru = "UPDATE tb_pengguna SET password='$password', token='' WHERE email = '$email'";
            $query = mysqli_query($conn, $baru);
            return  mysqli_affected_rows($conn);
        }
        else {
            return false;
        }
    }
}