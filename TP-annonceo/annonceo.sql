-- mysql -h localhost -u root

CREATE DATABASE Annonceo;

USE Annonceo;

CREATE TABLE categorie (
    id_categorie INT(3) NOT NULL AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    motcles TEXT NOT NULL,
    PRIMARY KEY (id_categorie) 
) ENGINE=InnoDB;

CREATE TABLE photo (
    id_photo INT(3) NOT NULL AUTO_INCREMENT,
    photo1 VARCHAR(255) NOT NULL,
    photo2 VARCHAR(255) NOT NULL,
    photo3 VARCHAR(255) NOT NULL,
    photo4 VARCHAR(255) NOT NULL,
    photo5 VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_photo) 
) ENGINE=InnoDB;

CREATE TABLE annonce (
    id_annonce INT(3) NOT NULL AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description_courte VARCHAR(255) NOT NULL,
    description_longue TEXT NOT NULL,
    prix VARCHAR(25) NOT NULL,
    photo VARCHAR(200) NOT NULL,
    pays VARCHAR(20) NOT NULL,
    ville VARCHAR(20) NOT NULL,
    adress VARCHAR(50) NOT NULL,
    cp INT(5) NOT NULL,
    membre_id INT(3) NOT NULL FOREIGN KEY,
    photo_id INT(3) NOT NULL FOREIGN KEY,
    categorie_id INT(3) NOT NULL FOREIGN KEY,
    date_enregistrement DATETIME,
    PRIMARY KEY (id_annonce) 
) ENGINE=InnoDB;

CREATE TABLE commentaire (
    id_commentaire INT(3) NOT NULL AUTO_INCREMENT,
    membre_id INT(3) NOT NULL FOREIGN KEY,
    annonce_id INT(3) NOT NULL FOREIGN KEY,
    commentaire TEXT NOT NULL,
    date_enregistrement DATETIME,
    PRIMARY KEY (id_commentaire) 
) ENGINE=InnoDB;

CREATE TABLE annonce (
    id_annonce INT(3) NOT NULL AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description_courte VARCHAR(255) NOT NULL,
    description_longue TEXT NOT NULL,
    prix VARCHAR(25) NOT NULL,
    photo VARCHAR(200) NOT NULL,
    pays VARCHAR(20) NOT NULL,
    ville VARCHAR(20) NOT NULL,
    adress VARCHAR(50) NOT NULL,
    cp INT(5) NOT NULL,
    membre_id INT(3) NOT NULL FOREIGN KEY,
    photo_id INT(3) NOT NULL FOREIGN KEY,
    categorie_id INT(3) NOT NULL FOREIGN KEY,
    date_enregistrement DATETIME,
    PRIMARY KEY (id_annonce) 
) ENGINE=InnoDB;

CREATE TABLE note (
    id_note INT(3) NOT NULL AUTO_INCREMENT,
    membre_id1 INT(3) NOT NULL FOREIGN KEY,
    membre_id2 INT(3) NOT NULL FOREIGN KEY,
    note INT(3) NOT NULL,
    avis TEXT NOT NULL,
    date_enregistrement DATETIME,
    PRIMARY KEY (id_note) 
) ENGINE=InnoDB;