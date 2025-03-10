<?php
class Vehicule{
    private static $marque = 'BMW'; // appartien à la classe
    private $couleur = 'noir'; // appartien à l'objet

    public static function setMarque($marque){
        // Vehicule::$marque = $marque
        self::$marque = $marque;
    }

    public static function getMarque(){
        return self::$marque;
    }

    public function setCouleur($couleur){
        $this->couleur = $couleur;
    }

    public function getCouleur(){
        return $this->couleur;
    }
}

$vehicule1 = new Vehicule();
echo "vehicule de marque " . Vehicule::getMarque() . " est de couleur " . $vehicule1->getCouleur() . "<br>";

$vehicule2 = new Vehicule();
$vehicule2->setCouleur('rouge');
echo "vehicule de marque " . Vehicule::getMarque() . " est de couleur " . $vehicule2->getCouleur() . "<br>";

$vehicule3 = new Vehicule();
echo "vehicule de marque " . Vehicule::getMarque() . " est de couleur " . $vehicule3->getCouleur() . "<br>";

$vehicule4 = new Vehicule();
$vehicule4->setMarque('Ferrari');
echo "vehicule de marque " . Vehicule::getMarque() . " est de couleur " . $vehicule4->getCouleur() . "<br>";

$vehicule5 = new Vehicule();
echo "vehicule de marque " . Vehicule::getMarque() . " est de couleur " . $vehicule5->getCouleur() . "<br>";

$vehicule6 = new Vehicule();
echo "vehicule de marque " . Vehicule::getMarque() . " est de couleur " . $vehicule6->getCouleur() . "<br>";
// getMarque() est une methode static, donc qui appartien à la classe, on l'appel par la classe et non par l'objet

/*
    une propriété / méthode static appartien à la classe.
    Si on modifie la valeur d'une propriété static, cela modifie la classe elle même, toute les autres instances auront les modification prise en compte.
    une propriété non static appartien à l'objet, si l'on modifie une propriété, on modifie seulement l'objet en cours. 
    self:: représente la classe à l'intérieur d'elle même
    this-> représente l'objet à l'intérieur de la classe 
*/