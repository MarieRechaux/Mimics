<?php
function search($tab, $elem) {
    if (!is_array($tab)) {
        throw new Exception("Vous devez envoyer un ARRAY");
    }

    if (sizeof($tab) <= 0) {
        throw new Exception("Vous devez envoyer un ARRAY avec du contenu");
    }

    $position = array_search($elem, $tab);
    return $position;
}

$perso = ['Mario', 'Luigi', 'Bowser', 'Toad', 'Peach'];

try{
    // blac d'essai. on va tenter d'executer les instructions suivantes dans le try 
    echo "Luigi ce trouve à la position : <strong>" . search($perso, "Luigi") . "</strong><br>";
    echo "Toad ce trouve à la position : <strong>" . search($perso, "Toad") . "</strong><br>";
    echo "Peach ce trouve à la position : <strong>" . search("jojfp", "Toad") . "</strong><br>";
    echo "traitement..."; // cette ligne ne sort pas, il n'y a aucune raison de continuer les traitements si une erreur est levée, car les prochains traitements étaient peut-être dépendant de celui qui a dysfonctioné 
} catch (Exception $e) {
    // bloc de capture, On va attraper les exceptions
    // echo '<pre>'; print_r($e); echo '</pre>';
    // echo '<pre>'; print_r(get_class_methods($e)); echo '</pre>';

    echo "<div style='background: #ff4c4c; padding: 10px; color: white; width: 400px; margine: 0 auto; border-radius: 5px'>"; 
    echo "<p>Fichier : " . $e->getFile() . "</p>"; 
    echo "<p>ligne : " . $e->getLine() . "</p>"; 
    echo "<p>Message : " . $e->getMessage() . "</p>"; 
    echo '</div>';
}

// ----------------------------------

echo "<hr>";

try {
    $connect_db = new PDO('mysql:host=localhost;dbname=ngngngn', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ]);
} catch (PDOException $e) {
    // echo '<pre>'; print_r(get_class_methods($e)); echo '</pre>';

    echo "<div style='background: #ff4c4c; padding: 10px; color: white; width: 400px; margine: 0 auto; border-radius: 5px'>"; 
    echo "<p>Fichier : " . $e->getFile() . "</p>"; 
    echo "<p>ligne : " . $e->getLine() . "</p>"; 
    echo "<p>Message : " . $e->getMessage() . "</p>"; 
    echo '</div>';
}