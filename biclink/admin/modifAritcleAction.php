<?php
require_once __DIR__ . '/require_login.php';
csrf_verify();
header("Content-Type: text/html; charset=utf-8");

const ALLOWED_IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

$id     = (int) ($_POST['id'] ?? 0);
$titre  = $_POST['titre']  ?? '';
$auteur = $_POST['auteur'] ?? '';
$texte  = $_POST['texte']  ?? '';
$date   = $_POST['date']   ?? '';

$hasNewFile = isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK;
$imageName  = null;

if ($hasNewFile) {
    // ARBITRARY FILE UPLOAD FIX: the original trusted the uploaded file's
    // extension completely and saved it under its original name inside a
    // publicly-served folder - an attacker could upload "shell.php" and
    // then browse to it to execute code on the server. We now:
    //   1. only allow known image extensions
    //   2. verify the file is really a decodable image (not a renamed .php)
    //   3. save it under a random generated name (also avoids overwriting
    //      another article's image if two files share the same name)
    $originalName = basename($_FILES['file']['name']);
    $imageName    = safe_upload_name($originalName, ALLOWED_IMAGE_EXTENSIONS);

    if ($imageName === null || @getimagesize($_FILES['file']['tmp_name']) === false) {
        die('Invalid file: only JPG, PNG, GIF, or WEBP images are allowed.');
    }
}

if ($imageName !== null) {
    $stmt = mysqli_prepare($link, "UPDATE `article` SET `titreA`=?, `auteur`=?, `texte`=?, `date`=?, `image`=? WHERE `idA`=?");
    mysqli_stmt_bind_param($stmt, 'sssssi', $titre, $auteur, $texte, $date, $imageName, $id);
} else {
    $stmt = mysqli_prepare($link, "UPDATE `article` SET `titreA`=?, `auteur`=?, `texte`=?, `date`=? WHERE `idA`=?");
    mysqli_stmt_bind_param($stmt, 'ssssi', $titre, $auteur, $texte, $date, $id);
}
mysqli_stmt_execute($stmt);

if ($imageName !== null) {
    $target_dir  = __DIR__ . '/images/Article/';
    $target_file = $target_dir . $imageName;
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

header('Location: afficherarticle.php');
exit;
