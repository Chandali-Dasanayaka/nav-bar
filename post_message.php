<?php
session_start();
require_once 'db.php'; // Make sure $conn is set up

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$book_id = isset($_GET['book_id']) ? intval($_GET['book_id']) : 1;
$user_id = $_SESSION['user_id'];
$content = trim($_POST['message'] ?? '');

if ($content !== '') {
    $stmt = $conn->prepare("INSERT INTO comments (book_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $book_id, $user_id, $content);
    $stmt->execute();
}

header("Location: message_thread.php?book_id=$book_id");
exit();
?>