<?php 

class Vehicule{
    private $litresEssence;

    public function setLitresEssence($litres){
        $this->litresEssence = $litres;
    }
    public function getLitresEssence(){
        return $this->litresEssence;
    }
}

class Pompe{
    private $litresEssence;

    public function setLitresEssence($litres){
        $this->litresEssence = $litres;
    }
    public function getLitresEssence(){
        return $this->litresEssence;
    }

    // on exige en arument un objet issu de la classe vehicule, on type la variable
    public function donnerEssence(Vehicule $v){
        echo '<pre>'; var_dump($v); echo '</pre>';

        $this->setLitresEssence($this->getLitresEssence() - (50 - $v->getLitresEssence()));

        $v->setLitresEssence($v->getLitresEssence() + (50 - $v->getLitresEssence()));
    }
}

$vehicule = new Vehicule();
$vehicule->setLitresEssence(5);
echo "le vehicule contient " . $vehicule->getLitresEssence() . "litres d'éssence<pre>";

$pompe = new Pompe();
$pompe->setLitresEssence(800);
echo "la pompe contient " . $pompe->getLitresEssence() . "litres d'éssence<pre>";
$pompe->donnerEssence($vehicule); // on transmet en argument l'objet issu de la classe vehicule

echo "après ravitaillement le vehicule contient " . $vehicule->getLitresEssence() . "litres d'éssence<pre>";

echo "après ravitaillement la pompe contient " . $pompe->getLitresEssence() . "litres d'éssence<pre>";

/*
UML:
---------------------
|    Vehicule		|
---------------------
|	$litresEssence	|
---------------------
|setlitresEssence() |
|getlitresEssence() |
---------------------

---------------------
|    Pompe   		|
---------------------
|	$litresEssence	|
---------------------
|setlitresEssence() |
|getlitresEssence() |
|donnerEssence()	|
---------------------

1. Création d'un véhicule 1
2. Attribuer un nombre de litres d'essence au vehicule 1 : 5
3. Afficher le nombre de litres d'essence du vehicule 1
4. Création d'une pompe
5. Attribuer un nombre de litres d'essence à la pompe : 800
6. Afficher le nombre de litres d'essence de la pompe
7. la pompe donne de l'essence en faisant le plein (50L) à la voiture1
8. Afficher le nombre de litres d'essence pour la voiture1 après ravitaillement
9. Afficher nombre de litres d'essence restant pour la pompe
10. Faire en sorte que le véhicule ne puisse pas contenir plus de 50L d'essence (limite reservoir).
*/
