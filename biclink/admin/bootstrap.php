<?php
/**
 * admin/bootstrap.php
 * -----------------------------------------------------------------------
 * Shared setup for the admin area: secure session cookie + session start,
 * and the login/logout/CSRF helper functions. This file does NOT enforce
 * that a visitor is logged in - see require_login.php for that. Keeping
 * the two separate means login.php can use these helpers to CREATE a
 * session without being redirected away by its own guard.
 * -----------------------------------------------------------------------
 */

require_once __DIR__ . '/../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,     // JS can't read the session cookie (mitigates XSS cookie theft)
        'samesite' => 'Lax',    // basic CSRF mitigation for the cookie itself
        // 'secure' => true,    // uncomment once the site is served over HTTPS
    ]);
    session_start();
}

const ADMIN_IDLE_TIMEOUT_SECONDS = 1800; // 30 minutes

/** Call this from login.php once the credentials have been verified. */
function admin_login_success(): void
{
    session_regenerate_id(true); // prevent session fixation
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['last_activity']   = time();
}

function admin_logout(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}

function admin_is_logged_in(): bool
{
    return !empty($_SESSION['admin_logged_in']);
}

// -------------------------------------------------------------------------
// CSRF protection helpers for admin forms (add/edit article, add job, ...)
// -------------------------------------------------------------------------
function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/** Stops the script with a 403 if the token in the request doesn't match. */
function csrf_verify(): void
{
    $submitted = $_POST['csrf_token'] ?? $_GET['csrf_token'] ?? '';
    if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $submitted)) {
        http_response_code(403);
        die('Invalid or expired form submission (CSRF check failed). Go back and try again.');
    }
}
