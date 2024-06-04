<?php
session_start();
session_destroy();

$redirect_to = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';

header("Location: $redirect_to");
exit();
?>

