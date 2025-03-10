<?php
class Panier {
    public $nbProduct; // propriété
    public function addProduct(){ // méthode
        // traitement
        return "L'article a été ajouté<br>";
    }
    protected function removeProduct(){
        return "L'article a été retiré<br>";
    }
    private function displayProduct(){
        return "Voici les articles<br>";
    }
}

// echo $nbProduct; /!\ erreur !! variable undefined
$panier1 = new Panier();
echo '<pre>'; var_dump($panier1); echo '</pre>';
echo '<pre>'; var_dump(get_class_methods($panier1)); echo '</pre>';

$panier1->nbProduct = 5;
echo '<pre>'; var_dump($panier1); echo '</pre>';

echo "il y a " . $panier1->nbProduct . "produits dans le panier";
// echo $panier1->removeProduct();
// echo $panier1->displayProduct();

$panier2 = new Panier();
echo '<pre>'; var_dump($panier2); echo '</pre>';
$panier2->nbProduct = 3;
echo "il y a " . $panier2->nbProduct . "produits dans le panier 2";
echo $panier2->addProduct();

/*
    Une class en PHP est un model, un plan de construction dans laquelle nous pouvons déclarer des propriétés (variables) mais aussi des méthodes (fonctions)
    Pour déployer et utiliser les éléments déclarées dans la classe, nous devons instancier, c'est à dire créer un nouvel exemplaire de la classe grace au mot clé 'new'
    $panier1 est un objet issu de la classe Panier, on se sert de ce qui est déclaré dans la classe à travers l'objet 
    Niveau de vilnérabilité : 
        - public : accesible de partout
        - protected : accessible uniquement dans la classe ou cela a été déclaré et dans les classes héritières 
        - private : accessible uniquement dans la classe ou sela a été déclaré
    
    une classe peut profduire plusieurs object. Nous pouvons donc effecter plusieurs instanciation 'new'
*/
