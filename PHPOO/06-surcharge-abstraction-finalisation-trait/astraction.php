<?php
abstract class Joueur {
    public function logIn(){
        return $this->etreMajeur();
    }

    // Les méthodes abstraite n'on pas de corp / de contenu 
    // Pour déclarer les méthodes absttraite, il faut que la classe soit abstraites 
    abstract public function etreMajeur();
    abstract public function devise();
}

class JoueurFr extends Joueur {
    public function etreMajeur(){
        return 18;
    }
    public function devise(){
        return '€';
    }
}

class JoueurUS extends Joueur {
    public function etreMajeur(){
        return 21;
    }
    public function devise(){
        return '$';
    }
}

// $joueur = new Joueur(); /!\ erreur !! Une classe abstraite n'est pas instanciable !

$joueurFr = new JoueurFr();
echo "joueur français de au moins " . $joueurFr->etreMajeur() . " ans avec une devise en " . $joueurFr->devise() . "<br>";

$joueurUs = new JoueurUS();
echo "joueur amériquain de au moins " . $joueurUs->etreMajeur() . " ans avec une devise en " . $joueurUs->devise() . "<br>";

/*
    Lorsque l'on hérite de méthodes abstraites, nous sommes obligé de les redéfinir, c'est imposer une bonne contraintes si les méthodes sont essentielles dans la classe.
    Une classe abstraite n'est pas instanciable.
    Une classe abstraite n'est pas composé uniquement de méthoses abstraites.
*/