CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    entreprise VARCHAR(150) NOT NULL,
    statut ENUM('Prospect', 'Client actif', 'Client inactif', 'Perdu') NOT NULL DEFAULT 'Prospect',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);