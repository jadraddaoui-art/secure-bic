<?php
require_once __DIR__ . '/require_login.php';
csrf_verify();
header("Content-Type: text/html; charset=utf-8");


$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($link, "DELETE FROM `emploi` WHERE `idE` = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

header('Location: afficherEmploi.php');
exit;
