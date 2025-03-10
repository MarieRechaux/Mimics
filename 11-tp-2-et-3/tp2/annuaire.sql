CREATE DATABASE IF NOT EXISTS repertoire;

USE repertoire;

CREATE TABLE annuaire (
  id_annuaire int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(255) NOT NULL,
  prenom varchar(255) NOT NULL,
  telephone varchar(255) NOT NULL,
  profession varchar(255) NOT NULL,
  ville varchar(255) NOT NULL,
  codepostal int(5) unsigned zerofill NOT NULL,
  adresse varchar(255) NOT NULL,
  date_de_naissance date NOT NULL,
  sexe enum('m','f') NOT NULL,
  description text NOT NULL,
  PRIMARY KEY (id_annuaire)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
