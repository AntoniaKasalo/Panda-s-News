<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['username'])) {
    echo "<script>alert('You need to login first!'); window.location.href='login.php';</script>";
    exit();
}
$username = $_SESSION['username'];


$title = $conn->real_escape_string($_POST['title']);
$about = $conn->real_escape_string($_POST['about']);
$content = $conn->real_escape_string($_POST['content']);
$category = $conn->real_escape_string($_POST['category']);
$archive = isset($_POST['archive']) ? 1 : 0;

$target_dir = "Slike/";
$target_file = $target_dir . basename($_FILES["pphoto"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));



$article_id = isset($_POST['id']) ? intval($_POST['id']) : null;
    if ($article_id) {
    // Fetch the existing thumbnail
    $sql = "SELECT thumbnail FROM news WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $article_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $existing_thumbnail = $row['thumbnail'];

    // Prepare the update statement
    $sql = "UPDATE news SET title = ?, about = ?, content = ?, category = ?, archive = ?";
    $params = [$title, $about, $content, $category, $archive];

    // Check if a new file was uploaded
    if ($_FILES["pphoto"]["tmp_name"] && getimagesize($_FILES["pphoto"]["tmp_name"])) {
        if (move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_file)) {
            $sql .= ", thumbnail = ?";
            $params[] = $target_file;
        } else {
            echo "<script>alert('Failed to upload new image.'); window.location.href='unos.php?id=$article_id';</script>";
            exit();
        }
    } else {
        $target_file = $existing_thumbnail;
    }

    $sql .= " WHERE id = ?";
    $params[] = $article_id;

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($params) - 1) . 'i', ...$params);

    if ($stmt->execute()) {
        echo "<script>alert('Article updated successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Failed to update article.'); window.location.href='unos.php?id=$article_id';</script>";
    }

} elseif (move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_file)) {
    $check = getimagesize($_FILES["pphoto"]["tmp_name"]);
    if($check !== false){
        $sql = "INSERT INTO news (title, about, content, category, thumbnail, author, archive) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssi', $title, $about, $content, $category, $target_file, $username, $archive);

        if ($stmt->execute()) {
            echo "<script>alert('New article created successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Failed to create article.'); window.location.href='unos.php';</script>";
        }
    }
    else {
        echo "<script>alert('File is not an image or there was an error uploading your file.'); window.location.href='unos.php';</script>";
    } 
} 

$conn->close();
?>
