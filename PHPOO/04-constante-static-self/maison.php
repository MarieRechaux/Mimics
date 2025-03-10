<?php
class Maison{
    private static $nbPiece = 7; // appartient à la classe
    public static $espaceTerrain = '500m²'; // appartient à la classe
    public $couleur = 'blanche'; // appartient à l'objet
    const HAUTEUR = '10m'; // appartient à la classe
    private $nbPorte = 10; // appartient à l'objet

    // appartient à la classe
    public static function getNbPiece(){
        return self::$nbPiece;
    }

    public static function getEspaceTerrain(){
        return self::$espaceTerrain;
    }

    public function getCouleur(){
        return $this->couleur;
    }

    // appartient à l'objet
    public function getNbPorte(){
        return $this->nbPorte;
    }
    
}

/*
    1. Afficher le nombre de pièces 
    2. Afficher l'espace terrain
    3. Afficher la hauteur
    4. Afficher la couleur
    5. Afficher le nombre de portes
*/

$maison1 = new Maison();

echo "la maison a " . Maison::getNbPiece() . " pièces<br>";
echo "la maison fait " . Maison::getEspaceTerrain() . "<br>";
echo "la maison est " . $maison1->getCouleur() . "<br>";
echo "la maison fait " . Maison::HAUTEUR . " de hauteur<br>";
echo "la maison possède " . $maison1->getNbPorte() . " portes<br>";
