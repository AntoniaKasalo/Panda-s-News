<?php
session_start();
require_once 'connect.php';

if (isset($_SESSION['username']) && isset($_GET['id'])) {
    $article_id = $_GET['id'];
    $username = $_SESSION['username'];

    $sql = "SELECT author FROM news WHERE id=$article_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $author = $row['author'];

        if ($_SESSION['role'] === 'admin' || $author === $username) {
            $sql = "DELETE FROM news WHERE id=$article_id";
            if ($conn->query($sql) === TRUE) {
                echo "Article deleted successfully.";
                header("Location: index.php");
            } else {
                echo "Error deleting article: " . $conn->error;
            }
        } else {
            echo "You do not have permission to delete this article.";
        }
    } else {
        echo "Article not found.";
    }
} else {
    echo "You must be logged in to delete an article.";
}

$conn->close();
?>
