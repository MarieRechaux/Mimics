<?php
class User {
    private $firstName;
    private $lastName;

    public function setFirstName($formFirstName){
        if(is_string($formFirstName)){
            $this->firstName = $formFirstName;
        }else{
            trigger_error("Is not a string", E_USER_WARNING);
        }
    }

    public function getFirstName(){
        return $this->firstName;
    }

    // -------------------------------
    public function setLastName($formLastName){
        if(is_string($formLastName)){
            $this->lastName = $formLastName;

            $lastName = $formLastName;
        }else{
            trigger_error("Is not a string", E_USER_WARNING);
        }
    }

    public function getLastName(){
        return $this->lastName;
    }
}

$user = new User();
echo '<pre>'; var_dump($user); echo '</pre>';
// $user->firstName = 'vpidfhfhbo^fjvo'
$user->setFirstName(1245);
$user->setFirstName("Grégory");
$user->setLastName("LACROIX");

echo "prénom : " . $user->getFirstName() . '<br>';
echo "nom : " . $user->getLastName() . '<br>';

$user2 = new User();
echo "prénom2 : " . $user2->getFirstName() . '<br>'; // cette ligne n'affiche aucun prénom car c'est une nouvelle instance, un nouvel exemplaire de la classe user

$user2->setLastName('Thomas');
echo "nom2 : " . $user2->getLasttName() . '<br>';

/*
    PHP est un language assez permissif, il faut donc prévoir autant de setteurs que de propriétés afin de controler l'intégralité des données et de ne pas se retrouver avec n'importe quelle valeur à l'intérieur.
    Si nous avons 25 propriétés, nous aurons 25 setteurs /getteurs 
    $this représente l'objet (en cours) à l'intérieur de la classe 
    Mettre les propriétés en private permet d'éviter qu'il soient modifiés dans le ode (il s'agit d'une bonne contrainte).
    Ainsi il faut passer par un setteur qui peu contenir des controles, cela permet une vérification avant d'accepter d'afficher la valeur.
    Le getteur permet de retourner la donnée finale (pas d'argument dans la fonction)
*/