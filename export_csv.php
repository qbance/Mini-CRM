<?php
require "connexion.php";

$recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : '';

if ($recherche !== '') {
    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ? OR telephone LIKE ? OR entreprise LIKE ?");
    $stmt->execute(["%$recherche%", "%$recherche%", "%$recherche%", "%$recherche%", "%$recherche%"]);
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $contacts = $pdo->query("SELECT * FROM contacts")->fetchAll(PDO::FETCH_ASSOC);
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=contacts_' . date('Y-m-d') . '.csv');

$output = fopen('php://output', 'w');
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
fputcsv($output, ['Nom', 'Prenom', 'Email', 'Telephone', 'Entreprise', 'Statut', 'Date de creation'], ';');

foreach ($contacts as $contact) {
    fputcsv($output, [
        $contact['nom'],
        $contact['prenom'],
        $contact['email'],
        $contact['telephone'],
        $contact['entreprise'],
        $contact['statut'],
        $contact['date_creation']
    ], ';');
}

fclose($output);
exit;
?>