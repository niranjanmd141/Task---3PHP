<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}
header("Location: dashboard.php");
exit();