<?php
session_start();
require_once 'connect.php';

function fetchNews($conn, $category) {
    $sql = "SELECT id, title, about, thumbnail FROM news WHERE category='$category' AND archive = 0 ORDER BY id DESC LIMIT 3";
    $result = $conn->query($sql);
    return $result;
}

$wildlife_news = fetchNews($conn, 'wildlife');
$house_pets_news = fetchNews($conn, 'house_pets');

$conn->close();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal News Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header id="headera" class="bg-dark text-white">
        <div class="header-content">
            <h1 class="mb-3">Panda's News</h1>
            <p class="lead">Welcome to the News portal!</p>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg">
        <div class="containern">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="WildLife.php">Wild Life</a>
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
        <div id="main">
            <div id="wildlife" class="container py-5">
                <h2 class="mb-4 category">Wild Life</h2>
                <div class="row">
                    <?php
                    if ($wildlife_news->num_rows > 0) {
                        while($row = $wildlife_news->fetch_assoc()) {
                            echo '<div class="col-lg-4 mb-4">';
                            echo '<a href="article.php?id='.$row["id"].'" class="card-link">';
                            echo '<div class="card">';
                            echo '<img src="'.$row["thumbnail"].'" class="card-img-top" alt="...">';
                            echo '<div class="card-body category">';
                            echo '<h3 class="card-title">'.$row["title"].'</h3>';
                            echo '<p class="card-text">'.$row["about"].'</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "No news found.";
                    }
                    ?>
                </div>
            </div>

            <div id="pets" class="container py-5">
                <h2 class="mb-4 category">House Pets</h2>
                <div class="row">
                    <?php
                    if ($house_pets_news->num_rows > 0) {
                        while($row = $house_pets_news->fetch_assoc()) {
                            echo '<div class="col-lg-4 mb-4">';
                            echo '<a href="article.php?id='.$row["id"].'" class="card-link">';
                            echo '<div class="card">';
                            echo '<img src="'.$row["thumbnail"].'" class="card-img-top" alt="...">';
                            echo '<div class="card-body category">';
                            echo '<h3 class="card-title">'.$row["title"].'</h3>';
                            echo '<p class="card-text">'.$row["about"].'</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "No news found.";
                    }
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
