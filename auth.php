<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
function requireRole(array $rolesAutorises) {
    if (!in_array($_SESSION['role'], $rolesAutorises)) {
        header('Location: liste.php');
        exit;
    }
}