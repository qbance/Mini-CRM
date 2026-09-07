<?php
require "connexion.php";

$id = $_POST['id'];
$nom = mb_strtoupper($_POST['nom']);
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$entreprise = $_POST['entreprise'];
if (empty($_POST['nom']) || empty($_POST['prenom'])) {
    echo "Le nom et le prénom sont obligatoires.";
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "L'email n'est pas valide.";
} elseif (empty($_POST['telephone'])){
    echo "Le téléphone est obligatoire";
    } elseif (empty($_POST['entreprise'])){
    echo "L'entreprise est obligatoire";
}else {
$stmt = $pdo->prepare("UPDATE contacts SET nom = ?, prenom = ?, email = ?, telephone = ?, entreprise = ? WHERE id = ?");
$stmt->execute([$nom, $prenom, $email, $telephone, $entreprise, $id]);

header("Location: liste.php");
exit;
}
?>