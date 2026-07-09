<?php
require_once __DIR__ . '/require_login.php';
csrf_verify();

$titre         = $_POST['titre']         ?? '';
$texte         = $_POST['texte']         ?? '';
$disponibilite = $_POST['disponibilite'] ?? '';
$deadline      = $_POST['deadline']      ?? '';

$stmt = mysqli_prepare($link, "INSERT INTO `emploi`(`titreE`, `description`, `disponibilite`, `deadline`) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'ssss', $titre, $texte, $disponibilite, $deadline);
mysqli_stmt_execute($stmt);

header('Location: updatepage.php');
exit;
