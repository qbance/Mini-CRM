<?php require "auth.php"; ?>
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
        <div class="header-bar">
    <h1 class="title">Mini CRM</h1>
    <?php if ($_SESSION['role'] === 'admin'): ?>
    <a href="utilisateurs.php" class="btn-users" title="Gérer les utilisateurs">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
    </a>
<?php endif; ?>
    <div class="user-badge">
        <div class="user-avatar"><?= htmlspecialchars(mb_strtoupper(mb_substr($_SESSION['username'], 0, 1))) ?></div>
        <div class="user-info">
            <span class="user-name"><?= htmlspecialchars($_SESSION['username']) ?></span>
            <span class="user-role"><?= htmlspecialchars(ucfirst($_SESSION['role'])) ?></span>
        </div>
        <a href="logout.php" class="btn-logout-icon" title="Déconnexion" aria-label="Déconnexion">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
        </a>
    </div>
</div>

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
                <?php if (in_array($_SESSION['role'], ['admin', 'manager'])): ?>
                <a href="export_csv.php<?= $recherche !== '' ? '?recherche=' . urlencode($recherche) : '' ?>" class="btn-export">Exporter en CSV</a>
                <?php endif; ?>
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

