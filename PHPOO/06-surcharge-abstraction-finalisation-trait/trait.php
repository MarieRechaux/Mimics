<?php
trait TPanier{
    public $nbProduct = 5;
    public function affichageProduct(){
        return "affichage des produits";
    }
}

trait TUser{
    public function displayUser(){
        return "affichage des membres !";
    }
}

class Site {
    use TPanier, TUser; // utilisation des traits 
}

$site = new Site();
echo $site->affichageProduct();
echo "nombre de produits : " . $site->nbProduct . "<br>";
echo $site->displayUser() . '<br>';

/*
    Les traits ont été inventés pour repousser les limites de l'héritage, c'est une sorte de pensement.
    Une classe ne peut héritée que d'une seule classe à la fois. en revanche, elle peut importer (donc hériter) de plusieurs trait.
    Un trait est un regroupement de méthodes / propriétés pouvant être importés dans une classe.
*/