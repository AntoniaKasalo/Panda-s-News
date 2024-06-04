<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'connect.php';

if(isset($_POST["send"])){
    $admin_password = $_POST['admin_password'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pandas.news.official@gmail.com';
    $mail->Password = 'fiuibczvskngtwld';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('pandas.news.official@gmail.com');

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);

    if ($role == 'user') {
        $verification_code = null;
    } else {
        $verification_code = rand(100000, 999999);
    }

    if ($role == 'admin' && $admin_password != '0806') {
        echo "Invalid admin password.";
    }
    else {
        $sql = "INSERT INTO users (username, password, email, role, verification_code) VALUES ('$username', '$password', '$email', '$role', '$verification_code')";

        if ($conn->query($sql) === TRUE) {
            if ($verification_code !== null) {
                $mail->Subject = "Email verification code";
                $mail->Body = "Your verification code is: $verification_code";
                $mail->send();
                header("Location: verify.php");
                exit();
            }
            echo "Registered successfully!";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>
