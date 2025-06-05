<?php
require_once 'db.php'; // contains DB connection $conn

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    header('Location: login.php?registered=1');
    exit();
} else {
    header('Location: register.php?error=exists');
    exit();
}
?>