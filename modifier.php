<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Document</title>
    </head>
    <body>
        <h1 class="title-modifier">Modifier le contact</h1>

        <?php
            require "connexion.php";
            $id = $_GET['id'];
            $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
            $stmt->execute([$id]);
            $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="form-container">
            <form method="POST" action="update.php" class="form-ajout">
                <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                <input type="text" name="nom" value="<?= htmlspecialchars($contact['nom']) ?>" required>
                <input type="text" name="prenom" value="<?= htmlspecialchars($contact['prenom']) ?>" required>
                <input type="text" name="email" value="<?= htmlspecialchars($contact['email']) ?>" required>
                <input type="text" name="telephone" value="<?= htmlspecialchars($contact['telephone']) ?>" required>
                <input type="text" name="entreprise" value="<?= htmlspecialchars($contact['entreprise']) ?>" required>
                <button type="submit">Enregistrer les modifications</button>
            </form>
        </div>
    </body>
</html>