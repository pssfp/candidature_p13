<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function requireAuth() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

function requireAdmin() {
    requireAuth();
    if (!isAdmin()) {
        header('HTTP/1.0 403 Forbidden');
        exit('Accès interdit');
    }
}

function logout() {
    // Détruire toutes les données de session
    $_SESSION = array();
    
    // Si vous voulez détruire complètement la session, effacez également
    // le cookie de session.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Finalement, détruire la session
    session_destroy();
}