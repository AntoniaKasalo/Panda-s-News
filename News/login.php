<?php
session_start();
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $admin_password = $_POST['admin_password'];
    $redirect_to = isset($_POST['redirect']) ? $_POST['redirect'] : 'index.php';

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            if ($user['role'] == 'admin' && $admin_password != '0806') {
                echo "Invalid admin password.";
            } elseif ($user['verification_code'] != NULL) {
                if ($user['is_verified'] == 0) {
                    echo "Please verify your email first.";
                }
                else{
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    header("Location: $redirect_to");
                    exit();
                }
            } else {
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header("Location: $redirect_to");
                exit();
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="skripta2.js" defer></script>
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
            <div class="container" >
                <div class="row justify-content-center" >
                    <div class="col-md-6">
                        <div class="card" style="background-color:#5f694b; color:white;">
                            <div id="register_card" class="card-body">
                                <h2 class="card-title text-center">Login</h2>
                                <form method="post" action="login.php">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_password">Admin Password (if logging in as admin):</label>
                                        <input type="password" class="form-control" id="admin_password" name="admin_password">
                                    </div>
                                    <input type="hidden" name="redirect" value="<?php echo isset($_GET['redirect']) ? htmlspecialchars($_GET['redirect']) : 'index.php'; ?>">
                                    <button type="submit" class="prim btn-block" name="login">Login</button>
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
