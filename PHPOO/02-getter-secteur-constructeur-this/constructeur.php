<?php
class User {
    private $firstName;

    public function __construct($arg){
        echo "classe instanciée, argument en envoyé $arg<br>";
        $this->setFirstName($arg);

        // connection a la BDD
    }

    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }
    public function getFirstName(){
        return $this->firstName;
    }
}

$user = new User('Grégory');
echo "prénom : " . $user->getFirstName() . '<br>';

/*
    la méthode magique __construct() s'execute automatiquement à l'instanciation de la classe, si elle attend un argument, nous devons lui envoyer un argument à l'instanciation de la classe 
    La classe PDO contient un constructeur
    $pdo = new PDO ('mysql;host=localhost)
    __construct est l'equivalent du fichier init.php dans le cshop avec session_start, connextion BDD etc...
*/