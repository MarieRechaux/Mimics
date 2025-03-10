<?php
class Product {
    private $title;
    private $reference;
    private $price;
    private $stock;
    private $error;

    public function getError(){
        return $this->error;
    }

    public function setTitle($title){
        if(strlen($title) < 5){
            $this->error = "Minimum 5 caractères<br>";
        }else{
            $this->title = $title;
        }
    }

    public function getTitle(){
        return $this->title;
    }

    // -----------------

    public function setReference($reference){
        $this->reference = $reference;
    }

    public function getReference(){
        return $this->reference;
    }

    // ------------------
    
    public function setPrice($price){
        $this->price = $price;
    }

    public function getPrice(){
        return $this->price;
    }

        // ------------------
    
        public function setStock($stock){
            $this->stock = $stock;
        }
    
        public function getStock(){
            return $this->stock;
        }
}

$product = new Product();
$product->setTitle('dedf');
echo $product->getError();

$product->setTitle('Chapeau');
$product->setReference('FR45IO');
$product->setPrice(54);
$product->setStock(15);

echo "Titre : " . $product->getTitle() . '<br>';
echo "Référence : " . $product->getReference() . '<br>';
echo "Prix : " . $product->getPrice() . '<br>';
echo "Stock : " . $product->getStock() . '<br>';

/*
    créer les getteur / setteur afin de renseigner les propriétés privatre déclarées 
    faite en sorte d'afficher un message d'erreur si la taille du titre est inférieur à 5 caractères 
*/

