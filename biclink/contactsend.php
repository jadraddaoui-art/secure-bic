<?php
require_once __DIR__ . '/config.php';


// statement/bound parameters.
$name    = $_POST['name']    ?? '';
$email   = $_POST['email']   ?? '';
$message = $_POST['message'] ?? '';

$stmt = mysqli_prepare($link, "INSERT INTO `contact`(`name`, `email`, `message`) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $message);
mysqli_stmt_execute($stmt);

header('Location: contact.html');
exit;
