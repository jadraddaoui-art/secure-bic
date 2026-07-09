<?php
/**
 * admin/require_login.php
 * -----------------------------------------------------------------------
 * Include this at the very top of every admin page that should require a
 * logged-in session (article/job listing & editing, dashboard, etc).
 *
 * BEFORE this fix: no admin page checked for a login session at all (and
 * login.php never even created one). That's why anyone who knew/guessed
 * the URL of e.g. ajouterarticle.html could publish articles with no
 * credentials whatsoever. Every affected page now starts with:
 *     require __DIR__ . '/require_login.php';
 * -----------------------------------------------------------------------
 */

require_once __DIR__ . '/bootstrap.php';

if (!admin_is_logged_in()) {
    header('Location: indexlogin.html');
    exit;
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > ADMIN_IDLE_TIMEOUT_SECONDS)) {
    admin_logout();
    header('Location: indexlogin.html?timeout=1');
    exit;
}
$_SESSION['last_activity'] = time();
