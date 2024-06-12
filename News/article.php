<?php
session_start();
require_once 'connect.php';

if(isset($_GET['id'])) {
    $article_id = $_GET['id'];

    $sql = "SELECT * FROM news WHERE id=$article_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="hr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $row["title"]; ?></title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <header id="headera" class="bg-dark text-white">
                <div class="header-content">
                    <h1 class="mb-3">Panda's News</h1>
                    <p class="lead">Welcome to the news portal!</p>
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
                            <a class="nav-link" href="unos.php">Make a Post</a>
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
                    <div class="container py-5">
                        <div class="card">
                            <img src="<?php echo $row["thumbnail"]; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row["title"]; ?></h5>
                                <p class="card-text"><?php echo $row["content"]; ?></p>
                                <p class="card-text"><small class="text-muted">Author: <?php echo $row["author"]; ?> | Date: <?php echo $row["created_at"]; ?></small></p>
                                <?php if (isset($_SESSION['role'])): ?>
                                    <?php if ($_SESSION['role'] === 'admin' || $_SESSION['username'] === $row['author']): ?>
                                        <a href="unos.php?id=<?php echo $article_id; ?>" class="prim"style="color:black; text-decoration:none; box-shadow: #7b8579 2px 2px 3px 1px;">Edit</a>
                                        <a href="#" onclick="confirmDelete(<?php echo $article_id; ?>)" class="btn btn-danger" style="color:white; text-decoration:none; box-shadow: #7b8579 2px 2px 3px 1px; margin-left:10px;">Delete</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
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
            function confirmDelete(articleId) {
                if (confirm("Are you sure you want to delete this article?")) {
                    window.location.href = "delete_article.php?id=" + articleId;
                }
            }
            </script>
        </body>
        </html>
        <?php
            } else {
                echo "Article not found.";
            }
        } else {
            echo "Article ID not provided.";
        }

        $conn->close();
        ?>
