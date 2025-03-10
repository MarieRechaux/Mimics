CREATE DATABASE tchat;

USE tchat;

CREATE TABLE commentaire (
    id_commentaire INT(11) PRIMARY KEY AUTO_INCREMENT,
    pseudo VARCHAR(255) NOT NULL,
    dateEnregistrement DATETIME DEFAULT CURRENT_TIMESTAMP,
    message LONGTEXT NOT NULL
);

CREATE USER 'user_tchat'@'localhost' IDENTIFIED BY 'tchat28!';

GRANT ALL PRIVILEGES ON 
