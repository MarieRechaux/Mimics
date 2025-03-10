<?php
class A {
    public function calcul(){
        return 10;
    }
}

// ------------------------------

class B extends A {
    public function calcul(){ //  on redéfinie la méthode
        $nb = parent::calcul();

        //$nb = $this->calcul()
        /*
            surcharge "overdride". Je n'utilise pas $this-calcul() sinon elle sera recursive et la méthode s'appelera en boucle
            parrent:: fonctionne pour appeler une méthode d'une classe parente lors d'une surcharge
        */
        if($nb <= 100) return "$nb est inférieur ou égale à 100<br>";
        else return "$nb est supérieur à 100<br>";
    }
}

$objetB = new B();
echo $objetB->calcul();

/*
    Une surcharge permet de prendre en compte le comportement de la méthode héritée afin d'en bénéficier, 
    tout en apportant un traitement complémentaire.
    contexte => pour la surcharge, si on ne faisait pas ça avec wordpress, on ne pourrais pas mettre à jour le cms car on modofierais directement les fonction du coeur 
*/