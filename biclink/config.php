<?php

if (isset($_SERVER['SCRIPT_FILENAME']) && realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__) {
    http_response_code(403);
    die('Direct access not permitted.');
}

// ---- Basic hardening headers, sent on every page that includes this file ----
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: strict-origin-when-cross-origin');

// ---- Error handling: never show raw errors to visitors -----------------
// (Flip 'display_errors' to '1' temporarily on a dev/staging copy only.)
// Errors are sent to your host's default PHP error log (not a file inside
// the website itself) so there's nothing extra to expose to visitors.
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

// ---- Database credentials -----------------------------------------------
// TODO: move this file above the web root if your hosting allows it.
// Direct browser access is already blocked above via plain PHP (no
// .htaccess needed), so this is safe even on hosts with unusual PHP setups.
$serveurBD      = "biclinkcmg931.mysql.db";
$nomUtilisateur = "biclinkcmg931";
$motDePasse     = "BICLINKcmg1";
$baseDeDonnees  = "biclinkcmg931";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $link = mysqli_connect($serveurBD, $nomUtilisateur, $motDePasse, $baseDeDonnees);
    $link->set_charset('utf8mb4');
} catch (\mysqli_sql_exception $e) {
    error_log('DB connection failed: ' . $e->getMessage());
    http_response_code(503);
    die('Service temporarily unavailable. Please try again later.');
}

/**
 * Escape a value for safe HTML output. Use this around EVERY piece of
 * data that came from the database or from user input before printing
 * it into a page, to prevent stored/reflected XSS.
 */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Build a safe, collision-proof filename for an uploaded file while
 * keeping its original extension. Prevents path traversal, overwriting
 * other users' files, and "double extension" tricks (e.g. cv.php.pdf).
 *
 * $allowedExtensions - lowercase list of extensions allowed, e.g. ['pdf','docx']
 * Returns null if the extension is not allowed.
 */
function safe_upload_name(string $originalName, array $allowedExtensions): ?string
{
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExtensions, true)) {
        return null;
    }
    return bin2hex(random_bytes(16)) . '.' . $ext;
}
