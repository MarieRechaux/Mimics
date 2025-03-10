<?php
class Perso{
    protected function deplacement(){
        return "je suis rapide";
    }

    public function jump(){
        return "je saute haut";
    }
}

class User1 extends Perso{
    public function infoUser(){
        return "je suis Mario, " . $this->deplacement() . " et " . $this->jump() . '<br>';
    }
}

class User2 extends Perso {
    public function infoUser(){
        return "je suis Luigi<br>";
    }

    // redéfinition de la méthode
    public function jump(){
        return "je saute plus haut que Mario<br>";
    }
}

$user1 = new User1();
echo $user1->infoUser();

$user2 = new User2();
echo $user2->infoUser();
echo $user2->jump(); // affiche "je saute plus haut que Mario" et non "je saute haut" car la méthode a été redéfinie dans la classe User2, l'interpreteur cherche d'abord dans la classe mère, la classe User2, et seulement si la méthode n'est pas trouvé, il cherche dans les classes héritières 

/*
    L'héritage permet de disposer ders méthodes et propriétés d'une classe dans une autre.
    Cela évite la redondance, si nous avons des méthodes récurante, plutot que de les redéfinir, on hérite de la classe via le mot clé "extend".
    Il n'ai pas possible d'hériter de plusieurs classes en même temps.
    class User ectends Product, Order --> /!\ erreur !! 
*/