<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function require_login() {
    if (empty($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit;
    }
}


function require_role(array $roles) {

    $currentRole = $_SESSION['user_role'] ?? null;

    if (!$currentRole || !in_array($currentRole, $roles)) {
        http_response_code(403);
        echo "Access denied.";
        exit;
    }
}

function current_user() {
    return [
        'id'   => $_SESSION['user_id']   ?? null,
        'name' => $_SESSION['user_name'] ?? null,
        'role' => $_SESSION['user_role'] ?? null
    ];
}



