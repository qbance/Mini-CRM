<?php
require "auth.php";
requireRole(['admin']);
require "connexion.php";

$utilisateurs = $pdo->query("SELECT id, username, role, created_at FROM users")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Utilisateurs - Mini CRM</title>
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    </head>
    <body>
                <div class="header-bar">
            <h1 class="title">Mini CRM</h1>
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

        <div class="main-container">
            <form method="POST" action="creer_utilisateur.php" class="form-ajout">
                <h2>Créer un utilisateur</h2>
                <input type="text" name="username" placeholder="Identifiant" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <select name="role" required>
                    <option value="employe">Utilisateur</option>
                    <option value="manager">Manager</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit">Créer</button>
            </form>
                        <div class="colonne-tableau">
                <h2>Comptes existants</h2>
                <table>
                    <tr>
                        <th>Identifiant</th>
                        <th>Rôle</th>
                        <th>Créé le</th>
                    </tr>

                    <?php foreach ($utilisateurs as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['username']) ?></td>
                        <td><?= htmlspecialchars(ucfirst($u['role'])) ?></td>
                        <td><?= htmlspecialchars($u['created_at']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </body>
</html>