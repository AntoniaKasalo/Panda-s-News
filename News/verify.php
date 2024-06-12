<?php
session_start();
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $verification_code = $_POST['verification_code'];

    $sql = "SELECT * FROM users WHERE email='$email' AND verification_code='$verification_code'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "UPDATE users SET is_verified=1 WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            echo "Email verified successfully!";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid verification code.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header class="headera text-white text-center">
        <nav class="navbar navbar-expand-lg text-white">
            <div class="container">
                <ul class="navbar-nav mx-auto">
                    <li>
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div id="align">
        <div id="main">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card" style="background-color:#5f694b; color:white;">
                            <div id="register_card" class="card-body">
                                <h2 class="card-title text-center">Email Verification</h2>
                                <form method="post">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="verification_code">Verification Code:</label>
                                        <input type="text" class="form-control" id="verification_code" name="verification_code" required>
                                    </div>
                                    <button type="submit" class="prim btn-block" name="verify">Verify</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white">
        <div>
            <p class="mb-0">&copy; 2024 Panda's News. All rights reserved.</p>
            <p class="mb-0">Antonia Kasalo</p>
            <p><a href="mailto:akasalo@tvz.hr" class="text-white">akasalo@tvz.hr</a></p>
        </div>
    </footer>
</body>
</html>

