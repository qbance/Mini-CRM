<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mini CRM</title>
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">Mini CRM</h1>

            <?php
                require "connexion.php";

                $recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : '';

                if ($recherche !== '') {
                    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ? OR telephone LIKE ? OR entreprise LIKE ?");
                    $stmt->execute(["%$recherche%", "%$recherche%", "%$recherche%",  "%$recherche%",  "%$recherche%" ]);
                    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $contacts = $pdo->query("SELECT * FROM contacts")->fetchAll(PDO::FETCH_ASSOC);
                } 
            ?>

        <div class="main-container">
            <form method="POST" action="ajouter.php" class="form-ajout">
                <h2>Ajouter</h2>
                    <input type="text" name="nom" placeholder="Nom" required>
                    <input type="text" name="prenom" placeholder="Prénom" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="telephone" placeholder="Téléphone" required>
                    <input type="text" name="entreprise" placeholder="Entreprise" required>
                    <select name="statut" required>
                        <option value="Prospect">Prospect</option>
                        <option value="Client actif">Client actif</option>
                        <option value="Client inactif">Client inactif</option>
                        <option value="Perdu">Perdu</option>
                        </select>
                    <button type="submit">Ajouter</button>
            </form>
        
            <div class="colonne-tableau">
                <form method="GET" action="liste.php" style="margin-bottom: 15px;" class="filter">
                    <input type="text" name="recherche" placeholder="Filtrer..." value="<?= htmlspecialchars($recherche) ?>">
                    <button type="submit">Filtrer</button>
                </form>
                <h2>Liste de résultats</h2>
                <a href="export_csv.php<?= $recherche !== '' ? '?recherche=' . urlencode($recherche) : '' ?>" class="btn-export">Exporter en CSV</a>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>E-mail</th>
                        <th>Téléphone</th>
                        <th>Entreprise</th>
                        <th>Date de création</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>

                    <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= htmlspecialchars($contact['nom']) ?></td>
                        <td><?= htmlspecialchars($contact['prenom']) ?></td>
                        <td><?= htmlspecialchars($contact['email']) ?></td>
                        <td><?= htmlspecialchars($contact['telephone']) ?></td>
                        <td><?= htmlspecialchars($contact['entreprise']) ?></td>
                        <td><?= htmlspecialchars($contact['date_creation']) ?></td>
                        <td><span class="badge badge-<?= strtolower(str_replace(' ', '-', $contact['statut'])) ?>"><?= htmlspecialchars($contact['statut']) ?></span></td>
                        <td>
                            <form method="GET" action="modifier.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                                <button type="submit">Modifier</button>
                            </form>
                            <form method="POST" action="supprimer.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </body>
</html>

