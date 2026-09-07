<?php
require "connexion.php";

$id = $_POST['id'];
$stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
$stmt->execute([$id]);

header("Location: liste.php");
exit;
?>