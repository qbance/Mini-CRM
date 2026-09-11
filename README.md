# Mini CRM

Application web de gestion de contacts (CRM) développée en PHP et MySQL, dans le cadre de mon apprentissage du développement web. Ce projet m'a permis de mettre en pratique le CRUD complet, la sécurisation d'une application PHP/MySQL, la mise en place d'un système d'authentification par rôles, et la gestion d'un dépôt Git en conditions réelles.

**Démo en ligne :** [https://mini-crm.freepage.cc/](https://mini-crm.freepage.cc/)

## Ce que ce projet m'a appris

- Comprendre concrètement pourquoi les requêtes préparées (PDO) empêchent l'injection SQL, et pas seulement "qu'il faut les utiliser"
- Mettre en place une gestion des droits par rôle (Admin / Manager / Utilisateur), et pas juste une simple connexion/déconnexion
- Séparer la configuration sensible (accès base de données) du code versionné
- Structurer un projet PHP de A à Z : base de données, logique métier, affichage, sécurité

## Fonctionnalités

- Système d'authentification sécurisé (connexion / déconnexion, hachage des mots de passe avec `password_hash`)
- Gestion des rôles utilisateurs (Admin, Manager, Utilisateur/Employé)
- Ajout, modification et suppression de contacts (CRUD complet)
- Recherche par nom, prénom, email, téléphone ou entreprise
- Suivi du statut client (Prospect, Client actif, Client inactif, Perdu)
- Export des contacts au format CSV (réservé aux rôles autorisés)
- Interface responsive et épurée


## Stack technique

- **Backend :** PHP 8 (PDO pour l'accès base de données, gestion des sessions)
- **Base de données :** MySQL
- **Frontend :** HTML / CSS (avec icônes SVG et polices Google Fonts)
- **Hébergement :** InfinityFree

## Sécurité

Points mis en place pour sécuriser l'application :

- Requêtes préparées (PDO) sur toutes les interactions avec la base de données, contre l'injection SQL
- Échappement systématique des sorties (`htmlspecialchars`) contre les failles XSS
- Validation des entrées côté serveur (email, champs obligatoires, format des identifiants)
- Whitelist des valeurs autorisées pour le champ statut
- Protection des pages sensibles par vérification des sessions et des rôles (`auth.php`)
- Identifiants de connexion à la base de données séparés du code source (fichier `connexion.php` non versionné)

## Installation en local

**Prérequis :** [XAMPP](https://www.apachefriends.org/) (Apache + PHP + MySQL), ou équivalent.

1. Cloner le dépôt :

   ```bash
   git clone https://github.com/qbance/Mini-CRM.git
   ```

2. Déplacer le dossier dans `htdocs` (ou équivalent selon votre environnement local).

3. Créer la base de données MySQL et importer le fichier SQL fourni (`database.sql` ou équivalent).

4. Copier `connexion.example.php` en `connexion.php` et renseigner vos identifiants de base de données :

   ```php
   <?php
   $host = 'localhost';
   $dbname = 'mini_crm';
   $user = 'root';
   $password = '';
   ```

5. Démarrer Apache et MySQL via XAMPP.

6. Accéder à l'application via `http://localhost/Mini-CRM/`.

## Pistes d'amélioration

- Ajouter des tests automatisés
- Historique des modifications par contact
- Notifications par email lors des relances



  

