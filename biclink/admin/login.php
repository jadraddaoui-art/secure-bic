<?php
/**
 * admin/login.php
 * -----------------------------------------------------------------------
 * Fixes vs. the original:
 *  1. SQL INJECTION: the email/password were concatenated directly into
 *     the SQL string ("... where mail='$email' ..."). Anyone could type
 *     something like  ' OR '1'='1  as the email and log in as admin
 *     without knowing a password. Now uses a parameterized/prepared query.
 *  2. NO SESSION WAS EVER CREATED: on a successful password check the code
 *     only did header('Location: updatepage.html') - it never recorded
 *     "this browser is now logged in" anywhere. That is the root cause of
 *     the whole admin area being open to anyone: every admin page could be
 *     opened directly with no session to check against. Now a real
 *     session is created via admin_login_success().
 *  3. Basic brute-force throttling: after 5 failed attempts from the same
 *     session, force a short wait before trying again.
 *  4. Credentials are pulled from the shared config.php instead of being
 *     duplicated here.
 * -----------------------------------------------------------------------
 */

require_once __DIR__ . '/bootstrap.php'; // also starts the session + gives us $link

const MAX_LOGIN_ATTEMPTS = 5;
const LOCKOUT_SECONDS     = 60;

// Simple per-session throttle to slow down password guessing.
if (
    !empty($_SESSION['login_attempts']) &&
    $_SESSION['login_attempts'] >= MAX_LOGIN_ATTEMPTS &&
    (time() - ($_SESSION['login_last_attempt'] ?? 0)) < LOCKOUT_SECONDS
) {
    header('Location: indexlogin.html?locked=1');
    exit;
}

$email = trim($_POST['email'] ?? '');
$pwd   = trim($_POST['pass'] ?? '');

$stmt = mysqli_prepare($link, "SELECT * FROM admin WHERE mail = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row    = $result ? mysqli_fetch_assoc($result) : null;

// Supports both a modern hashed password (password_hash()) and, for
// backward-compatibility with the existing database, a plain-text column.
// Recommendation: migrate the `password` column to store password_hash()
// output and remove the plain-text fallback below.
$passwordOk = false;
if ($row) {
    $stored = $row['password'];
    if (password_get_info($stored)['algo'] !== null) {
        $passwordOk = password_verify($pwd, $stored);
    } else {
        $passwordOk = hash_equals($stored, $pwd);
    }
}

if ($row && $passwordOk) {
    $_SESSION['login_attempts'] = 0;
    admin_login_success();
    header('Location: updatepage.php');
    exit;
}

$_SESSION['login_attempts']    = ($_SESSION['login_attempts'] ?? 0) + 1;
$_SESSION['login_last_attempt'] = time();
header('Location: indexlogin.html?error=1');
exit;
