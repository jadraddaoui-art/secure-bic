<?php
require_once __DIR__ . '/config.php';

const ALLOWED_DOC_EXTENSIONS = ['pdf', 'doc', 'docx'];

$name  = $_POST['name']  ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$type  = $_POST['type']  ?? '';




$letterName = null;
$cvName     = null;

if (isset($_FILES['message']) && $_FILES['message']['error'] === UPLOAD_ERR_OK) {
    $letterName = safe_upload_name(basename($_FILES['message']['name']), ALLOWED_DOC_EXTENSIONS);
}
if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
    $cvName = safe_upload_name(basename($_FILES['cv']['name']), ALLOWED_DOC_EXTENSIONS);
}

if ($letterName === null || $cvName === null) {
    die('Invalid file: only PDF, DOC, or DOCX files are allowed for the CV and cover letter.');
}

$stmt = mysqli_prepare($link, "INSERT INTO `candidature`(`name`, `email`, `phone`, `type`, `cv`, `message`) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'ssssss', $name, $email, $phone, $type, $cvName, $letterName);
mysqli_stmt_execute($stmt);

$target_dir = __DIR__ . '/cv/';
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

if (move_uploaded_file($_FILES['cv']['tmp_name'], $target_dir . $cvName)) {
    echo "The file has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

if (move_uploaded_file($_FILES['message']['tmp_name'], $target_dir . $letterName)) {
    echo "The file has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

header('Location: recrutement.php');
exit;
