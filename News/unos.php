<?php
session_start();
require_once 'connect.php';
if (!isset($_SESSION['username'])) {
    echo "<script>alert('You need to login first!'); window.location.href='login.php';</script>";
    exit();
}
if ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'reporter') {
    echo "<script>alert('You need to be an admin or reporter to access this page!'); window.location.href='index.php';</script>";
    exit();
}

$article_id = null;
$title = '';
$about = '';
$content = '';
$thumbnail = '';
$category = '';
$archive = 0;

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];
    $sql = "SELECT * FROM news WHERE id = $article_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $about = $row['about'];
        $content = $row['content'];
        $thumbnail = $row['thumbnail'];
        $category = $row['category'];
        $archive = $row['archive'];
    } else {
        echo "<script>alert('Article not found!'); window.location.href='index.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article_id ? 'Edit Article' : 'Make a Post'; ?></title>
    
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
<header id="hd1" class=" text-white text-center">
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
            <div class="container my-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h1><?php echo $article_id ? 'Edit Article' : 'Making a Post'; ?></h1>
                        <form id="newsForm" name="dojmovnik" action="skripta.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($article_id); ?>">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>">
                                <div id="titleError" class="invalid-feedback">Title must be between 5 and 30 characters</div>
                            </div>
                            <div class="form-group">
                                <label for="about">Short news summary (10 to 100 characters):</label>
                                <textarea name="about" id="about" class="form-control" maxlength="100"><?php echo htmlspecialchars($about); ?></textarea>
                                <div id="aboutError" class="invalid-feedback">Short summary must be between 10 and 100 characters</div>
                            </div>
                            <div class="form-group">
                                <label for="content">News content:</label>
                                <textarea name="content" id="content" class="form-control"><?php echo htmlspecialchars($content); ?></textarea>
                                <div id="contentError" class="invalid-feedback">Content cannot be empty</div>
                            </div>
                            <div class="form-group">
                                <label for="pphoto">Thumbnail:</label>
                                <input type="file" accept="image/*" class="form-control-file" name="pphoto" id="pphoto">
                                <?php if ($thumbnail): ?>
                                    <img src="<?php echo htmlspecialchars($thumbnail); ?>" alt="Thumbnail" style="max-width: 100px; margin-top: 10px;">
                                    <input type="hidden" name="existing_thumbnail" value="<?php echo htmlspecialchars($thumbnail); ?>">
                                <?php endif; ?>
                                <div id="fileError" class="invalid-feedback">Please select a file</div>
                            </div>
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control" id="category">
                                    <option value="">Select category</option>
                                    <option value="wildlife" <?php echo $category == 'wildlife' ? 'selected' : ''; ?>>Wild Life</option>
                                    <option value="house_pets" <?php echo $category == 'house_pets' ? 'selected' : ''; ?>>House Pets</option>
                                </select>
                                <div id="categoryError" class="invalid-feedback">Please select a category</div>
                            </div>
                            <div class="form-group">
                                <label>Archive:</label>
                                <input type="checkbox" name="archive" <?php echo $archive ? 'checked' : ''; ?>>
                            </div>
                            <div class="form-group">
                                <button type="reset" class="btn btn-secondary"><a style="color: white; text-decoration: none;" href="<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php'; ?>">Cancel</a></button>
                                <button type="submit" class="prim">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <h2 style="text-align:center">Preview</h2>
                        <div class="card">
                            <img id="image-preview" class="card-img-bottom" src="<?php echo htmlspecialchars($thumbnail); ?>" alt="News Image" style="display: <?php echo $thumbnail ? 'block' : 'none'; ?>;">
                            <div class="card-body category">
                                <h3 id="title-preview" class="card-title"><?php echo htmlspecialchars($title); ?></h3>
                                <p id="about-preview" class="card-text"><?php echo htmlspecialchars($about); ?></p>
                                <p id="content-preview" class="card-text"><?php echo htmlspecialchars($content); ?></p>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function validateForm() {
                let valid = true;

                const titleInput = document.getElementById('title');
                const titleError = document.getElementById('titleError');
                if (titleInput.value.length < 5 || titleInput.value.length > 30) {
                    titleInput.classList.add('is-invalid');
                    titleError.style.display = 'block';
                    valid = false;
                } else {
                    titleInput.classList.remove('is-invalid');
                    titleError.style.display = 'none';
                }

                const aboutInput = document.getElementById('about');
                const aboutError = document.getElementById('aboutError');
                if (aboutInput.value.length < 10 || aboutInput.value.length > 100) {
                    aboutInput.classList.add('is-invalid');
                    aboutError.style.display = 'block';
                    valid = false;
                } else {
                    aboutInput.classList.remove('is-invalid');
                    aboutError.style.display = 'none';
                }

                const contentInput = document.getElementById('content');
                const contentError = document.getElementById('contentError');
                if (contentInput.value.trim() === '') {
                    contentInput.classList.add('is-invalid');
                    contentError.style.display = 'block';
                    valid = false;
                } else {
                    contentInput.classList.remove('is-invalid');
                    contentError.style.display = 'none';
                }

                const categoryInput = document.getElementById('category');
                const categoryError = document.getElementById('categoryError');
                if (categoryInput.value === '') {
                    categoryInput.classList.add('is-invalid');
                    categoryError.style.display = 'block';
                    valid = false;
                } else {
                    categoryInput.classList.remove('is-invalid');
                    categoryError.style.display = 'none';
                }
                const fileInput = document.getElementById('pphoto');
                const fileError = document.getElementById('fileError');
                const existingThumbnail = document.querySelector('input[name="existing_thumbnail"]');
                if (!existingThumbnail && fileInput.value === '') {
                    fileInput.classList.add('is-invalid');
                    fileError.style.display = 'block';
                    valid = false;
                } else {
                    fileInput.classList.remove('is-invalid');
                    fileError.style.display = 'none';
                }

                return valid;
                return valid;
            }

            const form = document.getElementById('newsForm');
            form.addEventListener('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault();
                }
            });
            const articleId = "<?php echo $article_id; ?>";
            if (!articleId) {
                document.getElementById('title-preview').textContent = "Title";
                document.getElementById('about-preview').textContent = "Summary will appear here";
                document.getElementById('content-preview').textContent = "Content will apear here";
            }
        });
    </script>
</body>
</html>
