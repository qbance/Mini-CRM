<?php
require "auth.php";
requireRole(['admin']);
require "connexion.php";

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$roles_valides = ['admin', 'manager', 'employe'];
$role = in_array($_POST['role'] ?? '', $roles_valides) ? $_POST['role'] : 'employe';

if ($username === '' || $password === '') {
    echo "L'identifiant et le mot de passe sont obligatoires.";
} elseif (strlen($password) < 8) {
    echo "Le mot de passe doit contenir au moins 8 caractères.";
} else {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->fetch()) {
        echo "Cet identifiant est déjà utilisé.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hash, $role]);

        header("Location: utilisateurs.php");
        exit;
    }
}
?>