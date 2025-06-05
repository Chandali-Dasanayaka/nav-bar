<?php
session_start();
require_once 'db.php'; // Make sure this file contains your DB connection as $conn

// Get user input
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Check if username and password are provided
if (empty($username) || empty($password)) {
    header('Location: login.php?error=missing');
    exit();
}

// Prepare and execute SQL
$stmt = $conn->prepare("SELECT id, password FROM users WHERE username=? OR email=? LIMIT 1");
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 1) {
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();
    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        // Redirect to your "home" or protected page
        header('Location: home.php');
        exit();
    }
}

// If login fails
header('Location: login.php?error=invalid');
exit();
?>