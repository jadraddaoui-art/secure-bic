<?php
require_once __DIR__ . '/require_login.php';
csrf_verify();

const ALLOWED_IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

$titre  = $_POST['titre']  ?? '';
$auteur = $_POST['auteur'] ?? '';
$texte  = $_POST['texte']  ?? '';
$date   = $_POST['date']   ?? '';

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    die('Please choose an image to upload.');
}




$originalName = basename($_FILES["file"]["name"]);
$imageName    = safe_upload_name($originalName, ALLOWED_IMAGE_EXTENSIONS);

if ($imageName === null || @getimagesize($_FILES['file']['tmp_name']) === false) {
    die('Invalid file: only JPG, PNG, GIF, or WEBP images are allowed.');
}

$stmt = mysqli_prepare($link, "INSERT INTO `article`(`titreA`, `auteur`, `texte`, `date`, `image`) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'sssss', $titre, $auteur, $texte, $date, $imageName);
mysqli_stmt_execute($stmt);

$target_dir  = __DIR__ . '/images/Article/';
$target_file = $target_dir . $imageName;

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "The file has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

header('Location: updatepage.php');
exit;
