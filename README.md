
# Mini CRM

  

Application web de gestion de contacts (CRM) développée en PHP et MySQL, dans le cadre de mon apprentissage du développement web. Ce projet m'a permis de mettre en pratique le CRUD complet, la sécurisation d'une application PHP/MySQL, et la gestion d'un dépôt Git en conditions réelles.

  

**Démo en ligne :** https://mini-crm.freepage.cc


## Fonctionnalités

  

- Ajout, modification et suppression de contacts (CRUD complet)

- Recherche par nom, prénom, email, téléphone ou entreprise

- Suivi du statut client (Prospect, Client actif, Client inactif, Perdu)

- Export des contacts au format CSV

- Interface responsive

  

## Stack technique

  

-  **Backend :** PHP 8 (PDO pour l'accès base de données)

-  **Base de données :** MySQL

-  **Frontend :** HTML / CSS

-  **Hébergement :** InfinityFree

  

## Sécurité

  

Points mis en place pour sécuriser l'application :

  

- Requêtes préparées (PDO) sur toutes les interactions avec la base de données, contre l'injection SQL

- Échappement systématique des sorties (`htmlspecialchars`) contre les failles XSS

- Validation des entrées côté serveur (email, champs obligatoires, format des identifiants)

- Whitelist des valeurs autorisées pour le champ statut (pas de confiance aveugle dans les données envoyées par l'utilisateur)

- Identifiants de connexion à la base de données séparés du code source (fichier `connexion.php` non versionné, voir installation)

- Gestion des erreurs de connexion sans exposition de détails techniques à l'utilisateur

  

## Installation en local

  

**Prérequis :** [XAMPP](https://www.apachefriends.org/) (Apache + PHP + MySQL), ou équivalent.

  

1. Cloner le dépôt :

```bash

git clone https://github.com/qbance/Mini-CRM.git

```

  

2. Placer le dossier dans `htdocs` (ex : `C:\xampp\htdocs\mini-crm`)

  

3. Créer la base de données via phpMyAdmin, puis exécuter le script SQL fourni dans `database.sql`

  

4. Dupliquer `connexion.example.php` en `connexion.php` et renseigner vos identifiants de base de données locale :

```php

$host = 'localhost';

$dbname = 'mini_crm';

$username = 'root';

$password = '';

```

  

5. Lancer Apache et MySQL depuis le panneau XAMPP

  

6. Accéder à l'application via `http://localhost/mini-crm/`

  

## Structure du projet

  

```

mini-crm/

├── connexion.example.php # Modèle de config BDD (à dupliquer)

├── index.php # Redirection vers liste.php

├── liste.php # Page principale (liste, recherche, ajout)

├── ajouter.php # Traitement de l'ajout

├── modifier.php # Formulaire de modification

├── update.php # Traitement de la modification

├── supprimer.php # Traitement de la suppression

├── export_csv.php # Export CSV

└── style.css # Feuille de style

```

  

## Pistes d'amélioration

  

- Authentification pour protéger l'accès en écriture

- Historique des interactions par contact

- Pagination pour les grandes listes de contacts

- Statistiques (nombre de contacts par statut, taux de conversion)

  

## Auteur

  

Quentin BANCE — projet réalisé dans le cadre d'une formation en développement web. 

  

