<?php
function inclusionAutomatique($nonDeLaClasse){
    require_once($nonDeLaClasse . ".class.php");
    echo "on passe dans inclusionAutomatique<br>";
    echo "require_once($nonDeLaClasse.class.php);<br>";
}

spl_autoload_register('inclusionAutomatique');

/*
    sql_autoload_register : fonction prédéfinie permettant d'executer une fonction lorsque l'interpréteur voit passer le mot clé 'new' dans le code.
    Le nom de la classe à droite du 'new' est récupéré et transmit automatiquement à la fonction inclusionAutomatique (un peu à la manière d'une méthode magique).
    Il est indispensable de respecter une convention de nommage sur les fichiers pour que l'autoload fonctionne.
    Ici le nom de la classe (ex : A) correspond au nom du fichier (A.class.php). 
*/