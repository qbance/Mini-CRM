<?php
require "connexion.php";

if (!isset($_POST['id']) || !ctype_digit($_POST['id'])) {
    header("Location: liste.php");
    exit;
}

$id = $_POST['id'];
$stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
$stmt->execute([$id]);

header("Location: liste.php");
exit;
?>