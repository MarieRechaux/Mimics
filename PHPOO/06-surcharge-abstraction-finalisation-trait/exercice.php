<?php
abstract class Vehicule{
    final public function demarrer(){
        return "je démarre";
    }

    abstract public function carburant();

    public function nbTestObligatoire(){
        return 100;
    }
}

class Peugeot extends Vehicule {

    public function nbTestObligatoire(){
        $nbTest = parent::nbTestObligatoire() + 70;
        return $nbTest;
    }

    public function carburant(){
        return 'essence';
    }
}

class Renault extends Vehicule {
    public function carburant(){
        return 'diesel';
    }

    public function nbTestObligatoire(){
        $nbTest = parent::nbTestObligatoire() + 30;
        return $nbTest;
    }
}

$peugeot = new Peugeot();
echo "Peugeot > " . $peugeot->demarrer() . "<br>";
echo "Peugeot > " . $peugeot->carburant() . "<br>";
echo "Peugeot > " . $peugeot->nbTestObligatoire() . " tests<hr>";

$renault = new Renault();
echo "Renault > " . $renault->demarrer() . "<br>";
echo "Renault > " . $renault->carburant() . "<br>";
echo "Renault > " . $renault->nbTestObligatoire() . " tests<br>";

/*
    1.	Faire en sorte de ne pas avoir d'objet Vehicule. 
    2. 	Obligation pour la Renault et la Peugeot de posséder la même méthode demarrer() qu'un Véhicule de base .
    3.	Obligation pour la Renault de déclarer un carburant diesel et pour la Peugeot de déclarer un carburant essence (exemple: return 'diesel'; -ou- return 'essence';). 
    4.	La Renault doit effectuer 30 tests de + qu'un véhicule de base. 
    5.	La Peugeot doit effectuer 70 tests de + qu'un véhicule de base. 
    6.	Effectuer les affichages nécessaire.
*/