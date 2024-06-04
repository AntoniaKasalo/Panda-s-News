<?php
session_start();
require_once 'connect.php';

$sql = "SELECT * FROM news WHERE category='wildlife' ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Life News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header id="headera" class="headera bg-dark text-white">
        <div class="header-content">
            <h1 class="mb-3">Wild Life News</h1>
            <p class="lead">Latest news from the wild life!</p>
        </div>
    </header>
    <nav class="navb1 navbar navbar-expand-lg">
        <div class="containern">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="HousePets.php">House Pets</a>
                </li>
            </ul>
        </div>
        <div id="login">
        <?php if (isset($_SESSION['username'])): ?>
                    <div class="nav-item1">
                        <a class="nav-link" href="unos.php?redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Make a Post</a>
                    </div>
                    <div class="nav-item2">
                        <a onclick="showToast()" class="nav-link" href="logout.php?redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Log Out</a>
                    </div>
                <?php else: ?>
                    <div class="nav-item1">
                        <a class="nav-link" href="register.php">Register</a>
                    </div>
                    <div class="nav-item2">
                        <a class="nav-link" href="login.php?redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Login</a>
                    </div>
                <?php endif; ?>
        </div>
    </nav>

    <div id="align">
        <div id="main" >
            <div class="container py-5">
                <div class="row">
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="col-lg-4 mb-4">';
                            echo '<div class="card">';
                            echo '<a href="article.php?id='.$row["id"].'"><img src="'.$row["thumbnail"].'" class="card-img-top" alt="..."></a>';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title"><a href="article.php?id='.$row["id"].'">'.$row["title"].'</a></h5>';
                            echo '<p class="card-text">'.$row["about"].'</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "No news found.";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    

    <footer class="text-white">
        <div>
            <p class="mb-0">&copy; 2024 Panda's News. Sva prava pridržana.</p>
            <p class="mb-0">Antonia Kasalo</p>
            <p><a href="mailto:akasalo@tvz.hr" class="text-white">akasalo@tvz.hr</a></p>
        </div>
    </footer>
    <script>
        function showToast(){
            alert("User logged out!");
        }
    </script>
</body>
</html>
