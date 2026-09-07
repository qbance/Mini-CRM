<?php
$host = 'sqlXXX.infinityfree.com';
$dbname = 'votre_nom_de_bdd';
$username = 'votre_utilisateur';
$password = 'votre_mot_de_passe';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>